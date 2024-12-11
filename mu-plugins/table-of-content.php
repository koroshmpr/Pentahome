<?php
// Automatically add IDs to headings such as <h2></h2>
function auto_id_headings($content) {
    $content = preg_replace_callback('/(\<h[1-6](.*?))\>(.*)(<\/h[1-6]>)/i', function ($matches) {
        // Check if ID is not already set
        if (!stripos($matches[0], 'id=')) {
            $matches[0] = $matches[1] . $matches[2] . ' id="' . sanitize_title($matches[3]) . '">' . $matches[3] . $matches[4];
        }
        return $matches[0];
    }, $content);
    return $content;
}

add_filter('the_content', 'auto_id_headings');

// Generate the Table of Contents
function get_toc($content, $from_tag, $to_tag, $sideBar) {
    // Base classes for TOC
    $toc_classes = 'table-of-contents bg-primary bg-opacity-10 shadow-sm p-3';

    // Add sticky classes if sidebar is true
    if ($sideBar) {
        $toc_classes .= ' ';
    }
    if (!$sideBar) {
        $toc_classes .= ' mt-4 col-lg-10';
    }

    // Parse TOC
    ob_start();
    echo "<div class='" . esc_attr($toc_classes) . "'>";
    echo '<p class="fw-bold fs-5 my-3 text-primary">'. get_field('toc_title' , 'option') ?? 'آنچه در این مطلب می‌خوانید!'.'</p>';
    parse_toc(get_headings($content, $from_tag, $to_tag), 0, 0);
    echo "</div>";
    return ob_get_clean();
}

// Parse the headings into a TOC structure
function parse_toc($headings, $index, $recursive_counter) {
    if ($recursive_counter > 60 || !count($headings)) return;

    $last_element = $index > 0 ? $headings[$index - 1] : NULL;
    $current_element = $headings[$index];
    $next_element = $headings[$index + 1] ?? NULL;

    if ($current_element == NULL) return;

    $tag = intval($headings[$index]["tag"]);
    $id = $headings[$index]["id"];
    $name = $headings[$index]["name"];

    if ($last_element == NULL) echo "<ul>";
    if ($last_element && $last_element["tag"] < $tag) {
        for ($i = 0; $i < $tag - $last_element["tag"]; $i++) {
            echo "<ul class='ps-1'>";
        }
    }

    echo "<li class='my-2' data-id='" . esc_attr($id) . "'>";
    echo "<a class='text-decoration-none lazy small' rel='noindex' href='javascript:void(0)' data-scroll-id='" . esc_attr($id) . "'>" . esc_html($name) . "</a>";

    if ($next_element && intval($next_element["tag"]) > $tag) {
        parse_toc($headings, $index + 1, $recursive_counter + 1);
    }

    echo "</li>";

    if ($next_element && intval($next_element["tag"]) == $tag) {
        parse_toc($headings, $index + 1, $recursive_counter + 1);
    }

    if (!$next_element || ($next_element && $next_element["tag"] < $tag)) {
        echo "</ul>";
    }
}


// Extract headings from content
function get_headings($content, $from_tag, $to_tag) {
    $headings = [];
    preg_match_all("/<h([" . $from_tag . "-" . $to_tag . "])([^<]*)>(.*)<\/h[" . $from_tag . "-" . $to_tag . "]>/", $content, $matches);

    for ($i = 0; $i < count($matches[1]); $i++) {
        $headings[$i]["tag"] = $matches[1][$i];
        $att_string = $matches[2][$i];

        // Match ID if it's available in the heading tag
        preg_match("/id=\"([^\"]*)\"/", $att_string, $id_matches);
        $headings[$i]["id"] = $id_matches[1] ?? sanitize_title($matches[3][$i]);

        // Handle any classes within the heading tag
        preg_match_all("/class=\"([^\"]*)\"/", $att_string, $class_matches);
        $headings[$i]["classes"] = $class_matches[1][0] ?? [];

        // Clean up the heading name
        $headings[$i]["name"] = strip_tags($matches[3][$i]);
    }
    return $headings;
}

// Shortcode for the TOC
function toc_shortcode($atts) {
    // Retrieve options for the Table of Content
    $sideBar = get_field('sidebar', 'option');
    $tableOfContent = get_field('table_of_content', 'option');
    $from_tag = $tableOfContent['min-heading'] ?? 2;
    $to_tag = $tableOfContent['max-heading'] ?? 4;

    // Merge default values with user-defined shortcode attributes
    $atts = shortcode_atts(
        array(
            'from_tag' => $from_tag,
            'to_tag' => $to_tag,
            'sideBar' => $sideBar,
        ),
        $atts,
        'TOC'
    );

    // Get content and process headings
    $content = auto_id_headings(get_the_content());
    return get_toc($content, $atts['from_tag'], $atts['to_tag'], $atts['sideBar']);
}

add_shortcode('TOC', 'toc_shortcode');

// Example usage:
// [TOC from_tag="2" to_tag="4" sideBar="true"]