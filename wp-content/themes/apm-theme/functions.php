<?php

$theme = wp_get_theme();
define( "APM_THEME_VERSION", $theme->get( 'Version' ) );

require_once(get_template_directory().'/APM/Functions/Cleanup.php');
require_once(get_template_directory().'/APM/Functions/Admin.php');
require_once(get_template_directory().'/APM/Functions/Theme.php');
require_once(get_template_directory().'/APM/Functions/Block-Editor.php');

APM_Functions\Cleanup\init();
APM_Functions\Admin\init();
APM_Functions\Theme\init();
APM_Functions\Block_Editor\init();


/*
 * Temporary fix for theme.json block CSS not outputting in hybrid themes
 * @see https://developer.wordpress.org/news/2023/04/21/per-block-css-with-theme-json/#comment-1448
 **/
function wp_enqueue_global_styles_custom_css_fix() {

    if ( ! wp_theme_has_theme_json() ) return;

    // Don't enqueue Customizer's custom CSS separately.
    remove_action( 'wp_head', 'wp_custom_css_cb', 101 );

    $custom_css  = wp_get_custom_css();
    $custom_css .= wp_get_global_styles_custom_css();

    if ( ! empty( $custom_css ) ) wp_add_inline_style( 'global-styles', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles_custom_css_fix' );


if (!function_exists('write_log')) {

    function write_log($log) {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }

}