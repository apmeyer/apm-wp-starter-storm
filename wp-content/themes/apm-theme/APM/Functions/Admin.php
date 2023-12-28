<?php

namespace APM_Functions\Admin;

/**
 * This file is all about customizing the WordPress admin.
 *
 * Tasks include:
 * -- Customizing the menu order
 * -- Adding "Patterns" as a menu option
 * -- Adding theme menu location references
 */

function init(): void {

    add_filter( 'custom_menu_order', 'APM_Functions\Admin\set_custom_menu_order' );
    add_filter( 'menu_order', 'APM_Functions\Admin\set_custom_menu_order' );
    add_action( 'admin_menu', 'APM_Functions\Admin\add_patterns_to_admin_menu' );

}


/**
 * Customize the order of items in the WordPress admin menu
 */
function set_custom_menu_order( $menu_ord ): array|bool {

    if ( !$menu_ord ) return true;

    return array(
        'index.php',                // Dashboard
        'separator1',               // First separator
        'edit.php',                 // Posts
        'edit.php?post_type=page',
        'gf_edit_forms',
        'upload.php',               // Media
        'separator2',
        // 'acf_config',            // custom acf page
        'themes.php',               // Appearance
        'plugins.php',
        'users.php',
        'tools.php',
        'options-general.php',      // Settings
        'separator-last',           // Last separator
    );
}


/**
 * Add "Patterns" to WordPress admin menu so that it can be
 * viewed like any other custom post type.
 */
function add_patterns_to_admin_menu(): void {

    add_menu_page( 'Patterns', 'Patterns', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22 );

}
