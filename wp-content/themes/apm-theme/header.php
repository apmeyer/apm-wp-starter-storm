<!doctype html>
<html lang="en" <?php APM_Functions\Theme\get_html_classes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script>
        document.documentElement.classList.remove('no-js');
        document.documentElement.classList.add('js');
    </script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <a href="#mainContent" class="screen-reader-text"><?php _e( 'Skip to main content', 'apm-theme' ); ?></a>

<!--    <div style="background-color: salmon; color: #ffffff; padding: .5rem 1rem; font-size: var(--wp--preset--font-size--ps); line-height: 1.2;">-->
<!--        Lorem ipsum dolor sit amet, consectetur adipiscing elit.-->
<!--    </div>-->

    <?php get_template_part( 'parts/site-header' ); ?>

    <div class="content-wrap" id="mainContent">
