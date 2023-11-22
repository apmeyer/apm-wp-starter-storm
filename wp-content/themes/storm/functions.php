<?php

//Disable emojis in WordPress
add_action( 'init', 'storm_disable_emojis' );
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function storm_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'storm_disable_emojis_tinymce' );
}

function storm_disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

function my_theme_enqueue_styles() {
    wp_enqueue_style( 'theme', get_template_directory_uri() . '/assets/dist/css/theme.css' );
}

