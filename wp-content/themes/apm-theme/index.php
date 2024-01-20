<?php get_header(); ?>
    <main id="main" class="wp-site-blocks is-layout-flow">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        <?php endif;?>
    </main>
<?php get_footer(); ?>