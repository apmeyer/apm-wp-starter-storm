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
<body <?php body_class( 'is-at-top' ); ?>>
    <?php wp_body_open(); ?>

    <a href="#mainContent" class="screen-reader-text"><?php _e( 'Skip to main content', 'apm-theme' ); ?></a>

    <?php // Announcement bar would go here. Mobile menu bottom padding must account for it with extra bottom padding for scrolling. ?>

    <?php get_template_part( 'parts/site-header' ); ?>

    <div class="content-wrap" id="mainContent">
