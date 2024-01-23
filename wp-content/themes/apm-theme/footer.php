        </div><?php // closes #mainContent div in header.php ?>

        <?php

            // Check for ACF, then get block pattern for site footer
            // A block pattern can be selected under Appearance > Theme Settings > Patterns Tab
            if ( function_exists( 'get_field' ) ) {
                $footer = get_field( 'site_pattern_footer', 'option' );
                if ( $footer ) {
                    echo '<footer  class="wp-site-blocks is-layout-flow">';
                    APM_Functions\Block_Editor\the_block_pattern( $footer );
                    echo '</footer>';
                }
            }

        ?>

        <?php wp_footer(); ?>
    </body>
</html>