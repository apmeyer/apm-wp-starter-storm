<?php get_header(); ?>
    <main id="main" class="main wp-site-blocks is-layout-flow">
        <?php

            // Typical loop to get post content
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();
                    the_content();
                }
            }

            // 404 error check and check for ACF, then get block pattern for 404 page
            // A block pattern can be selected under Appearance > Theme Settings > Patterns Tab
            if ( is_404() && function_exists( 'get_field' ) ) {
                APM_Functions\Block_Editor\the_block_pattern( get_field( 'site_pattern_404', 'option' ) );
            }

        ?>
    </main>
<?php get_footer(); ?>