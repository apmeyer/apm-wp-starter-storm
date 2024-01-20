<?php

return [
    'dependencies' => is_admin() ? [ 'swiper', 'wp-blocks', 'acf-input' ] : [ 'swiper' ],
    'version' => APM_BLOCKS_PLUGIN_VERSION
];