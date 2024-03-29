<?php
/**
 * .site-header-wrap | handles sticky positioning and static height on scroll - is 0px wide
 * .site-header | handles side padding and overall width
 * .site-header__inner-container | handles constrained centering of content
 *
 * .site-nav |
 *
 */
?>
<header class="site-header-wrap" id="siteHeaderWrap">
    <div class="site-header has-utility-menu" id="siteHeader">
        <div class="site-header__inner-container">

            <?php echo get_custom_logo(); ?>

            <nav class="site-nav" id="siteNav">
                <button class="site-nav__button" aria-expanded="false" aria-controls="mobileMenuWrap" id="mobileMenuButton">
                    <span class="screen-reader-text"><?php _e( 'Menu', 'apm-theme' ) ?></span>
                    <span aria-hidden="true" class="hamburger-icon"><span></span></span>
                </button>
                <div class="site-nav__inner-container" id="mobileMenuWrap">
                    <div class="site-nav__menus">
                        <?php wp_nav_menu( [
                            'menu' => 'site-header-main-menu',
                            'menu_class' => 'wp-main-menu',
                            'menu_id' => 'main_nav_menu',
                            'container' => 'div',
                            'container_class' => 'main-menu slide-in-menu',
                            'fallback_cb' => false,
                            // 'walker' => new APM_Functions\Classes\Site_Header_Nav_Walker
                        ] ); ?>
                        <?php wp_nav_menu( [
                            'menu' => 'site-header-utility-menu',
                            'menu_class' => 'wp-utility-menu',
                            'menu_id' => 'utility_nav_menu',
                            'container' => 'div',
                            'container_class' => 'utility-menu slide-in-menu',
                            'fallback_cb' => false,
                            'depth' => 1
                        ] ); ?>
                    </div>
                </div>
            </nav>

        </div>
    </div>
</header>