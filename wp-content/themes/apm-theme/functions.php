<?php

$theme = wp_get_theme();
define( "APM_THEME_VERSION", $theme->get( 'Version' ) );

require_once(get_template_directory().'/apm/classes/site-header-nav-walker.php');
require_once(get_template_directory().'/apm/functions/cleanup.php');
require_once(get_template_directory().'/apm/functions/admin.php');
require_once(get_template_directory().'/apm/functions/theme.php');
require_once(get_template_directory().'/apm/functions/acf.php');
require_once(get_template_directory().'/apm/functions/block-editor.php');

APM_Functions\Cleanup\init();
APM_Functions\Admin\init();
APM_Functions\Theme\init();
APM_Functions\ACF\init();
APM_Functions\Block_Editor\init();

// ------------------------------------------------------------------------------------------------

if ( !function_exists('write_log') ) {

    // Only for local debugging
    if ( wp_get_environment_type() !== 'local' ) return;

    function write_log( $log ) {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
    }

}
