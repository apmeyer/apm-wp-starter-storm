<?php

namespace APM_Functions\Theme;

function init(): void {

    enable_or_disable_native_theme_support();

    add_action( 'wp_enqueue_scripts', 'APM_Functions\Theme\enqueue_theme_styles' );
    add_action( 'wp_enqueue_scripts', 'APM_Functions\Theme\dequeue_styles_and_scripts', 99 );
    add_action( 'wp_footer', 'APM_Functions\Theme\inject_into_footer' );
    add_action( 'init', 'APM_Functions\Theme\register_menu_locations' );
    add_filter( 'body_class', 'APM_Functions\Theme\add_body_classes' );
    add_action( 'add_html_classes', 'APM_Functions\Theme\add_html_classes' );

    add_filter( 'gform_confirmation_anchor', '__return_true' );

}

function enable_or_disable_native_theme_support(): void {

    add_theme_support( 'editor-styles' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
    add_theme_support( 'custom-logo' );

    remove_theme_support( 'core-block-patterns' );

}

/**
 * Some of these styles and scripts will instead be
 * output in the footer.
 */
function dequeue_styles_and_scripts(): void {

    // wp_dequeue_style( 'global-styles' );
    wp_dequeue_style( 'gform_basic' );
    wp_dequeue_style( 'gform_theme' );
    wp_dequeue_style( 'gform_theme_ie11' );
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );

}

function enqueue_theme_styles(): void {

    wp_enqueue_style( 'theme', get_template_directory_uri().'/assets/dist/css/theme.min.css', [], APM_THEME_VERSION );
    wp_enqueue_script( 'theme', get_template_directory_uri().'/assets/dist/js/theme.min.js', [], APM_THEME_VERSION, true );

}

function register_menu_locations(): void {

    register_nav_menu( 'main-menu', 'Main Menu' );
    register_nav_menu( 'utility-menu', 'Utility Menu' );

}

/**
 * Output some styles and scripts at the bottom of the page
 */
function inject_into_footer(): void {

    wp_enqueue_style( 'gform_basic' );
    wp_enqueue_style( 'gform_theme' );
    wp_enqueue_style( 'gform_theme_ie11' );

    wp_enqueue_style( 'wp-block-library' );
    wp_enqueue_style( 'wp-block-library-theme' );
    wp_enqueue_style( 'APM-no-js', get_template_directory_uri() . '/assets/dist/css/no-js.min.css', array(), APM_THEME_VERSION );
    wp_enqueue_style( 'APM-gravity-forms', get_template_directory_uri() . '/assets/dist/css/gravity-forms.min.css', array( 'gform_theme' ), APM_THEME_VERSION );

}

function add_body_classes($classes ): array {

    // if ( get_field( 'post_header_overlap' ) ) {
    // 	$classes[] = 'has-header-overlap';
    // }

    return $classes;

}

function add_html_classes(): void {

    // $classes = [];

    // if ( is_post_type_archive( 'timeline' ) ) {
    // 	$classes[] = 'is-post-type-archive-timeline-html';
    // }

//    if ( count( $classes ) ) {
//        echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
//    }

}

function get_html_classes(): void {

    do_action( 'add_html_classes' );

}