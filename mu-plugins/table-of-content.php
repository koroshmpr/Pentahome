<?php
// table of contents
/**
 * Automatically add IDs to headings such as <h2></h2>
 */
function auto_id_headings($content)
{
    $content = preg_replace_callback('/(\<h[1-6](.*?))\>(.*)(<\/h[1-6]>)/i', function ($matches) {
        if (!stripos($matches[0], 'id=')) {
            $matches[0] = $matches[1] . $matches[2] . ' id="' . sanitize_title($matches[3]) . '">' . $matches[3] . $matches[4];
        }
        return $matches[0];
    }, $content);
    return $content;
}

add_filter('the_content', 'auto_id_headings');

function get_toc($content, $from_tag = 1, $to_tag = 6)
{
    // get headlines
    $headings = get_headings($content, $from_tag, $to_tag);

    // parse toc
    ob_start();
    echo "<div class='table-of-contents'>";
    parse_toc($headings, 0, 0);
    echo "</div>";
    return ob_get_clean();
}

function parse_toc($headings, $index, $recursive_counter)
{
    // prevent errors
    if ($recursive_counter > 60 || !count($headings)) return;

    // get all needed elements
    $last_element = $index > 0 ? $headings[$index - 1] : NULL;
    $current_element = $headings[$index];
    $next_element = NULL;
    if ($index < count($headings) && isset($headings[$index + 1])) {
        $next_element = $headings[$index + 1];
    }

    // end recursive calls
    if ($current_element == NULL) return;

    // get all needed variables
    $tag = intval($headings[$index]["tag"]);
    $id = $headings[$index]["id"];
    $classes = $headings[$index]["classes"] ?? array();
    $name = $headings[$index]["name"];

    // element not in toc
    if (isset($current_element["classes"]) && $current_element["classes"] && in_array("nitoc", $current_element["classes"])) {
        parse_toc($headings, $index + 1, $recursive_counter + 1);
        return;
    }

    // parse toc begin or toc subpart begin
    if ($last_element == NULL) echo "<ul>";
    if ($last_element != NULL && $last_element["tag"] < $tag) {
        for ($i = 0; $i < $tag - $last_element["tag"]; $i++) {
            echo "<ul class='ms-2'>";
        }
    }

    // build li class
    $li_classes = " class='my-2'";
    if (isset($current_element["classes"]) && $current_element["classes"] && in_array("toc-bold", $current_element["classes"])) $li_classes = " class='bold'";

    // parse line begin
    echo "<li" . $li_classes . " data-id='" . $id . "'>";

    // only parse name, when li is not bold
    if (isset($current_element["classes"]) && $current_element["classes"] && in_array("toc-bold", $current_element["classes"])) {
        echo $name;
    } else {
        echo "<a class='text-decoration-none fs-6' rel='noindex' href='#" . $id . "'>" . $name . "</a>";
    }
    if ($next_element && intval($next_element["tag"]) > $tag) {
        parse_toc($headings, $index + 1, $recursive_counter + 1);
    }

    // parse line end
    echo "</li>";

    // parse next line
    if ($next_element && intval($next_element["tag"]) == $tag) {
        parse_toc($headings, $index + 1, $recursive_counter + 1);
    }

    // parse toc end or toc subpart end
    if ($next_element == NULL || ($next_element && $next_element["tag"] < $tag)) {
        echo "</ul>";
        if ($next_element && $tag - intval($next_element["tag"]) >= 2) {
            echo "</li>";
            for ($i = 1; $i < $tag - intval($next_element["tag"]); $i++) {
                echo "</ul>";
            }
        }
    }

    // parse top subpart
    if ($next_element != NULL && $next_element["tag"] < $tag) {
        parse_toc($headings, $index + 1, $recursive_counter + 1);
    }
}

function get_headings($content, $from_tag = 1, $to_tag = 6)
{
    $headings = array();
    preg_match_all("/<h([" . $from_tag . "-" . $to_tag . "])([^<]*)>(.*)<\/h[" . $from_tag . "-" . $to_tag . "]>/", $content, $matches);

    for ($i = 0; $i < count($matches[1]); $i++) {
        $headings[$i]["tag"] = $matches[1][$i];
        // get id
        $att_string = $matches[2][$i];
        preg_match("/id=\"([^\"]*)\"/", $att_string, $id_matches);
        $headings[$i]["id"] = $id_matches[1];
        // get classes
        $att_string = $matches[2][$i];
        preg_match_all("/class=\"([^\"]*)\"/", $att_string, $class_matches);
        for ($j = 0; $j < count($class_matches[1]); $j++) {
            $headings[$i]["classes"] = explode(" ", $class_matches[1][$j]);
        }
        $headings[$i]["name"] = strip_tags($matches[3][$i]);
    }
    return $headings;
}

// TOC (from webdeasy.de)
function toc_shortcode($atts)
{
    // Extract shortcode attributes
    $atts = shortcode_atts(
        array(
            'from_tag' => 1,
            'to_tag' => 6,
        ),
        $atts,
        'TOC'
    );

    // Get content with auto IDs
    $content = auto_id_headings(get_the_content());

    // Return the TOC with specified heading range
    return get_toc($content, $atts['from_tag'], $atts['to_tag']);
}

add_shortcode('TOC', 'toc_shortcode');

//[TOC from_tag="2" to_tag="3"]