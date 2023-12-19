<header class="site-header-wrap">
    <div class="site-header has-utility-menu" id="siteHeader">
        <div class="site-header__inner-container">

            <?php echo get_custom_logo(); ?>

            <nav class="site-nav" id="siteNav">
                <button class="site-nav__button" aria-expanded="false" aria-controls="mobileMenuWrap" id="mobileMenuButton">
                    <span class="screen-reader-text"><?php _e( 'Menu', 'apm-theme' ) ?></span>
                    <span aria-hidden="true" class="apm-hamburger"><span></span></span>
                </button>
                <div class="site-nav__inner-container" id="mobileMenuWrap">
                    <div class="site-nav__menus">
                        <?php wp_nav_menu( [
                            'menu' => 'main-menu',
                            'menu_class' => 'wp-main-menu',
                            'menu_id' => 'main_nav_menu',
                            'container' => 'div',
                            'container_class' => 'main-menu slide-in-menu',
                            'fallback_cb' => false
                        ] ); ?>
                        <?php wp_nav_menu( [
                            'menu' => 'utility-menu',
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