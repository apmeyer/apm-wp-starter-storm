<?php

namespace APM_Functions\Block_Editor;

/**
 * This file is all about customizing theme blocks and styles used in the
 * block editor (Gutenberg)
 *
 * Tasks include:
 * -- Registering block pattern categories
 * -- Registering block styles which may include some inline css output
 * -- Adding editor styles
 * -- Potentially assigning default layouts based on post type
 * -- Potentially enqueueing individual block styles
 *
 * Note: Block Patterns are not registered here, but are registered
 * individually from the theme/patterns directory.
 */

function init(): void {

    add_action( 'init', 'APM_Functions\Block_Editor\register_block_pattern_categories' );
    add_action( 'init', 'APM_Functions\Block_Editor\register_block_styles' );

    add_editor_style( 'assets/dist/css/editor.min.css' );

    // Unused
    // add_action( 'init', 'APM_Functions\Block_Editor\storm_block_stylesheets' );
    // add_filter( 'default_content', 'APM_Functions\Block_Editor\assign_default_post_type_layout', 10, 2 );

    // Opting in to separate loading of block assets with this filter
    // @see https://make.wordpress.org/core/2021/07/01/block-styles-loading-enhancements-in-wordpress-5-8/
    // add_filter( 'should_load_separate_core_block_assets', '__return_true' );

}


/**
 * Prepare some categories for organization custom blocks in the block
 * editor left sidebar block picker
 */
function register_block_pattern_categories(): void {

    register_block_pattern_category(
        'apm-layouts',
        array(
            'label'       => _x( 'Layouts', 'Block pattern category' ),
            'description' => __( 'Full layouts.', 'apm-theme' ),
        )
    );

    register_block_pattern_category(
        'apm-sections',
        array(
            'label'       => _x( 'Sections', 'Block pattern category' ),
            'description' => __( 'Full-width or large sections of a layout.', 'apm-theme' ),
        )
    );

    register_block_pattern_category(
        'apm-components',
        array(
            'label'       => _x( 'Components', 'Block pattern category' ),
            'description' => __( 'Bits and pieces that may be a part of a section or layout, or could be used separately.', 'apm-theme' ),
        )
    );

}


/**
 * Add custom block styles. These appear as selectable style options
 * when editing block styles. When selected, a CSS class name is added
 * to the block. Styles are either applied inline if defined, or must
 * be included elsewhere in theme/block stylesheets. Some "!important"
 * declarations may be necessary.
 */
function register_block_styles(): void {

    register_block_style(
        'core/buttons', [
            'name'         => 'small-buttons',
            'label'        => __( 'Small', 'APM' ),
            'inline_style' => '
               .is-style-small-buttons .wp-element-button {
                    padding: .25rem .75rem !important;
                    font-size: var(--wp--preset--font-size--ps);
                }
            '
        ]
    );

}


/**
 * Checks the theme templates directory for a file and uses the block code
 * as the default template for new posts of the given type.
 * A clever approach with kudos to:
 * @see https://github.com/WordPress/gutenberg/issues/33379
 */
function assign_default_post_type_layout( $content, $post ) {

    $file_path = null;

    switch( $post->post_type ) {

        case 'page':
            $file_path = get_theme_file_path( 'layouts/page-layout-b.php' );
            break;

        case 'event':
            $file_path = get_theme_file_path( 'layouts/event-layout-a.php' );
            break;

        case 'story':
            $file_path = get_theme_file_path( 'layouts/story-layout-a.php' );
            break;

        case 'resource':
            $file_path = get_theme_file_path( 'layouts/resource-layout-a.php' );
            break;

    }

    if ( $file_path && file_exists( $file_path ) ) $content = file_get_contents( $file_path );

    return $content;

}


function enqueue_block_stylesheets(): void {

    // These should only output when the blocks are used
    wp_enqueue_block_style(
        'core/spacer',
        array(
            'handle' => 'apm-spacer-block',
            'src'    => get_parent_theme_file_uri( 'assets/dist/css/apm-block-spacer.css' ),
            'ver'    => wp_get_theme( get_template() )->get( 'Version' ),
            'path'   => get_parent_theme_file_path( 'assets/dist/css/apm-block-spacer.css' ),
        )
    );

}