<?php

return [
    'dependencies' => is_admin() ? [ 'wp-blocks', 'acf-input' ] : [],
    'version' => APM_BLOCKS_PLUGIN_VERSION
];