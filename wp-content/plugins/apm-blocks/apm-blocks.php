<?php

/*
Plugin Name: APM Blocks
Author: apmeyer llc
Plugin URI: https://apmeyer.com
Description: Custom blocks for a custom theme.
Version: 1.0.0
Text Domain: apm-blocks
License: Released under the MIT License
Copyright: 2024 apmeyer llc
*/

namespace APM_Blocks;

define( "APM_BLOCKS_PLUGIN_NAME", __( 'APM Blocks', 'apm-blocks' ) );
define( "APM_BLOCKS_PLUGIN_FILE", __FILE__ );
define( "APM_BLOCKS_PLUGIN_VERSION", '1.0.0' );
define( "APM_BLOCKS_PLUGIN_DIRECTORY", __DIR__ );
define( "APM_BLOCKS_PLUGIN_URL", plugin_dir_url( __FILE__ ) );
define( "APM_BLOCKS_PLUGIN_PATH", plugin_dir_path( APM_BLOCKS_PLUGIN_FILE ) );


/**
 * Custom blocks are dependent on the ACF plugin being present and active.
 * We'll check for the existence of an ACF function before setting up these custom blocks.
 */
if ( function_exists( 'get_field' ) ) {

    add_filter( 'block_categories_all', 'APM_Blocks\add_block_categories', 10, 2 );
    add_action( 'init', 'APM_Blocks\register_blocks', 5 );
    add_action( 'wp_enqueue_scripts', 'APM_Blocks\register_shared_assets' );
    add_action( 'admin_enqueue_scripts', 'APM_Blocks\register_shared_assets' );
    add_action( 'template_redirect', 'APM_Blocks\add_custom_block_css_to_head_when_block_is_in_content' );

    // Include block functions files for active blocks
    foreach ( get_active_blocks() as $block ) {
        $path = APM_BLOCKS_PLUGIN_PATH . '/blocks/' . $block['name'] . '/functions.php';
        if ( file_exists( $path ) ) require_once( $path );
    }

} else {

    add_action( 'admin_notices', function() {

        $screen = get_current_screen();

        if ( isset( $screen->base ) && $screen->base === 'plugins' ) {
            wp_admin_notice(
                sprintf( __( 'The %s plugin depends on the Advanced Custom Fields (ACF) Pro plugin. Install and activate ACF Pro to use %s.', 'apm-blocks' ), APM_BLOCKS_PLUGIN_NAME, APM_BLOCKS_PLUGIN_NAME ),
                [
                    'type' => 'warning',
                    'dismissible' => true
                ]
            );
        }

    } );

}


/**
 * @return array
 */
function get_active_blocks(): array {

    return [
        [
            'name' => 'slider',
            'style-dependencies' => [ 'swiper' ]
        ]
    ];

}


/**
 * Registers active blocks, and also enqueues block scripts for the backend.
 *
 * Enqueueing for the backend here is doing things a little differently than the standard of specifying
 * stylesheets in the block's block.json file. This is to account for how we're also doing things a
 * little differently on the frontend, where we're outputting block styles inline in the header only
 * when the block is actually included in the content. All in the name of performance.
 *
 * @return void
 */
function register_blocks(): void {

    foreach ( get_active_blocks() as $block ) {
        $path = APM_BLOCKS_PLUGIN_DIRECTORY . '/blocks/' . $block['name'];
        if ( file_exists( $path ) ) {
            register_block_type( $path );
            if ( is_admin() ) wp_enqueue_style( 'apm-block-'.$block['name'], plugin_dir_url( __FILE__ ) . 'blocks/' . $block['name'] . '/assets/dist/style.css', [ 'swiper' ], APM_BLOCKS_PLUGIN_VERSION );
        }
    }

}


/**
 * @param $categories
 * @param $post
 *
 * @return array
 */
function add_block_categories( $categories, $post ): array {

    return array_merge(
        $categories,
        array(
            array(
                'slug'  => 'apm-blocks',
                'title' => 'Custom Blocks',
            ),
        )
    );

}


/**
 * @return void
 */
function register_shared_assets(): void {

    wp_register_script( 'swiper', plugin_dir_url( __FILE__ ) .'shared-assets/vendor/swiper/swiper-bundle.min.js', [], APM_BLOCKS_PLUGIN_VERSION, true );
    wp_register_style( 'swiper', plugin_dir_url( __FILE__ ) .'shared-assets/vendor/swiper/swiper-bundle.min.css', [], APM_BLOCKS_PLUGIN_VERSION );

}


/**
 * @return void
 */
function add_custom_block_css_to_head_when_block_is_in_content(): void {

    $head_css = '';

    foreach ( get_active_blocks() as $block ) {
        $file = APM_BLOCKS_PLUGIN_DIRECTORY . '/blocks/' . $block['name'] . '/assets/dist/style.css';
        if ( file_exists( $file ) && has_block( 'acf/'.$block['name'] ) ) {
            if ( isset( $block['style-dependencies'] ) && is_array( $block['style-dependencies'] ) ) {
                foreach ( $block['style-dependencies'] as $dependency ) { wp_enqueue_style( $dependency ); }
            }
            $head_css .= wp_strip_all_tags( file_get_contents( $file ) );
        }
    }

    if ( !empty( $head_css ) ) {
        add_action( 'wp_head', function() use ( $head_css ) {
            echo '<!-- Begin custom block css -->';
            echo '<style>' . $head_css . '</style>';
            echo '<!-- End custom block css -->';
        } );
    }

}