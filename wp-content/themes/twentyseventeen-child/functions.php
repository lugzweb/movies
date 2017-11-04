<?php

define( 'TEXTDOMAIN', 'testwp');

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

require_once get_theme_file_path( '/inc/custom-posts.php' );
