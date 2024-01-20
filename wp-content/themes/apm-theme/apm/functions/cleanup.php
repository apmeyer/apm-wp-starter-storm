<?php

/**
 * These Functions are all about disabling or otherwise tailoring
 * native WordPress features for security, performance, and
 * admin de-cluttering.
 */

namespace APM_Functions\Cleanup;

function init(): void {

    remove_default_head_tags();

    add_action( 'init', 'APM_Functions\Cleanup\disable_emojis' );
    add_action( 'admin_init', 'APM_Functions\Cleanup\remove_dashboard_meta_boxes' );
    add_action( 'wp_enqueue_scripts', 'APM_Functions\Cleanup\enqueue_global_styles_custom_css_fix' );

}

/*
 * Temporary fix for theme.json block CSS not outputting in hybrid themes
 *
 * As of 1/9/23 this is still necessary. 😕
 *
 * @see https://developer.wordpress.org/news/2023/04/21/per-block-css-with-theme-json/#comment-1448
 * @see https://github.com/WordPress/gutenberg/issues/52644
 **/
function enqueue_global_styles_custom_css_fix(): void {

    if ( ! wp_theme_has_theme_json() ) return;

    // Don't enqueue Customizer's custom CSS separately.
    remove_action( 'wp_head', 'wp_custom_css_cb', 101 );

    $custom_css  = wp_get_custom_css();
    $custom_css .= wp_get_global_styles_custom_css();

    if ( ! empty( $custom_css ) ) wp_add_inline_style( 'global-styles', $custom_css );
}

function remove_default_head_tags(): void {
    remove_action( 'wp_head', 'feed_links_extra', 3 );
    remove_action( 'wp_head', 'feed_links', 2 );
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'index_rel_link' );
    remove_action( 'wp_head', 'parent_post_rel_link_wp_head' );
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );
    remove_action( 'wp_head', 'start_post_rel_link' );
    remove_action( 'wp_head', 'rest_output_link_wp_head' );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
}

function disable_emojis(): void {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'APM_Functions\Cleanup\disable_emojis_tinymce' );
}

function disable_emojis_tinymce( $plugins ): array {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

function remove_dashboard_meta_boxes(): void {

    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    // remove_meta_box('metabox-id', 'post_type', 'side/main');

}