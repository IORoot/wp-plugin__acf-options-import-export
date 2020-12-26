<?php

add_action( 'plugins_loaded', function() {
    do_action('register_andyp_plugin', [
        'title'     => 'ACF Data Import/Export',
        'icon'      => 'database-export',
        'color'     => '#242424',
        'path'      => __FILE__,
    ]);
} );