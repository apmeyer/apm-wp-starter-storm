<?php

namespace APM_Functions\ACF;

/**
 * This file is all about customizing the WordPress admin.
 *
 * Tasks include:
 * -- Customizing the menu order
 * -- Adding "Patterns" as a menu option
 * -- Adding theme menu location references
 */

function init(): void {

    add_filter( 'acf/get_post_types', 'APM_Functions\ACF\add_post_types_to_acf', 10, 1 );

}


/**
 * Add the wp_block post type to the post type options in ACF fields
 * that allow for post type selection. The wp_block post type is used
 * for block patterns.
 */
function add_post_types_to_acf( $array ) {

    $array[] = 'wp_block';

    return $array;

}