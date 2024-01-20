<?php

/**
 * APM Slider Block
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *            This is either the post ID currently being displayed inside a query loop,
 *            or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

$slides = [ 'Slide 1', 'Slide 2', 'Slide 3' ]

?>

<?php if ( !empty( $slides ) ) : ?>

    <div class="apm-slider <?php // Add general block classes class ?>">
        <div class="apm-slider__inner-container">

            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php foreach( $slides as $slide ) : ?>
                        <div class="swiper-slide"><?php esc_html_e( $slide ); ?></div>
                    <?php endforeach; ?>
                </div>
            </div>

            <button class="swiper-button swiper-button-prev">
                <span class="screen-reader-text"><?php _e( 'Previous', 'apm-blocks' ); ?></span>
            </button>

            <button class="swiper-button swiper-button-next">
                <span class="screen-reader-text"><?php _e( 'Next', 'apm-blocks' ); ?></span>
            </button>

            <div class="swiper-pagination"></div>

        </div>
    </div>

<?php elseif ( is_admin() ) : ?>

    <p class="admin-instructions">
        <?php _e( 'Add some slides using the sidebar controls, or switch this block to edit mode.', 'apm-blocks' ); ?>
    </p>

<?php endif; ?>
