<?php
function latin_theme_scripts() {
    $theme_uri = get_template_directory_uri();
    
    // Enqueue the landing page styles and scripts
    wp_enqueue_style('latin-main-css', $theme_uri . '/assets/style.css', array(), '1.0');
    wp_enqueue_script('latin-main-js', $theme_uri . '/assets/app.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'latin_theme_scripts');

// Disable admin bar for non-admins to keep frontend clean
add_filter('show_admin_bar', '__return_false');
