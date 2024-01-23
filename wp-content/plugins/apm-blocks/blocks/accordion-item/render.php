<?php

/**
 * APM Accordion Item Block
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *            This is either the post ID currently being displayed inside a query loop,
 *            or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

if ( !isset( $block ) ) $block = null;

?>

<div class="<?php esc_attr_e( APM_Blocks\get_wp_block_classes( $block, 'apm-accordion-item' ) ) ?>"
     id="<?php esc_attr_e( APM_Blocks\get_block_id( $block ) ); ?>">
    <InnerBlocks
        class="apm-accordion-item__inner-container"
        template="<?php esc_attr_e( wp_json_encode( APM_Blocks\Accordion_Item\get_inner_blocks_template() ) ); ?>" />
</div>