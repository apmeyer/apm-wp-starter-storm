<?php get_header(); ?>
    <div id="main" class="wp-site-blocks is-layout-constrained">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        <?php endif;?>
    </div>
<?php get_footer(); ?>