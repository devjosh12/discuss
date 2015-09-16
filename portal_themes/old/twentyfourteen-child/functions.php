<?php 
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'twentyfourteen', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'twentyfourteen-child',
        get_stylesheet_directory_uri() . '/style.css',
        array('twentyfourteen')
    );
}
?>