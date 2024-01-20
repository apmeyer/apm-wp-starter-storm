<?php

namespace APM_Functions\Classes;

use Walker_Nav_Menu;

class Site_Header_Nav_Walker extends Walker_Nav_Menu {

    // Displays start of an element. E.g '<li> Item Name'

    // @see Walker::start_el()
    function start_el( &$output, $item, $depth=0, $args=array(), $id = 0 ) {

        $item_id = 'menu_item_'.$item->object_id;
        $object  = $item->object;
        $type    = $item->type;
        $title   = $item->title;
        $url     = $item->url;
        $icon    = get_field( 'menu_item_icon', $item );
        $target  = '_self';

        if ( !empty( $item->target ) ) $target = $item->target;
        if ( !empty( $icon ) ) $item->classes[] = 'has-icon';

        $output .= '<li class="' . implode( ' ', $item->classes ) . '" id="' . $item_id . '">';
        $output .= '<a class="menu-item__link bypass-default-style" href="' . $url . '" target="'.$target.'">';

        if ( $icon ) $output .= '<span class="menu-item__icon">' . $icon . '</span>';

        $output .= '<span class="menu-item__text">' . $title . '</span>';
        $output .= '</a>';

        // closing li excluded intentionally
    }


}