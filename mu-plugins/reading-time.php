<?php
// Function to calculate the estimated reading time
function calculate_reading_time() {
    // Get the post content without outputting it
    $content = get_the_content();

    // Strip HTML tags from the content
    $content = strip_tags($content);

    // Use preg_split to count words, which works better for multi-language content
    $word_count = count(preg_split('/\s+/', $content, -1, PREG_SPLIT_NO_EMPTY));

    // Calculate the reading time (assuming an average reading speed of 200 words per minute)
    $reading_time = ceil($word_count / 200);

    // Ensure a minimum reading time of 1 minute
    return max($reading_time, 1);
}

// Shortcode function to display the reading time
function reading_time_shortcode() {
    $reading_time = calculate_reading_time();

    // Display the estimated reading time (e.g., "3 min read")
    return $reading_time;
}

// Register the shortcode
add_shortcode('reading_time', 'reading_time_shortcode');
