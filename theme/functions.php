<?php

//assets
add_action("wp_enqueue_scripts", function() {
    wp_enqueue_style("style", get_template_directory_uri() . "/dist/main.css", false,  filemtime( dirname( __FILE__ ) . '/dist/main.css' ),);
    wp_enqueue_style('font', "https://fonts.googleapis.com/css?Open+Sans:400,400i,700%7C?subset=cyrillic");
	wp_enqueue_style('boo', "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css");

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri() . "/assets/scripts/libs/jquery.min.js", array(), null, true );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script("bootstrap", "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js");
    wp_enqueue_script("main", get_template_directory_uri() . "/dist/main.js", array('jquery'), filemtime( dirname( __FILE__ ) . '/dist/main.js' ), true);

    // if ( is_single()) {
    //     wp_enqueue_script( 'comment-reply' );
    // }
});
//deregister wp-block-library
add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );
function wps_deregister_styles() {
    wp_dequeue_style( 'wp-block-library' );
}
//register menu
// register_nav_menus( array(
//     'header_menu' => 'Верхнее меню',
// ));
//add image thumbnail
//add_image_size("bigImage", 888, 576, true);
//add_image_size("smallImage", 88, 69, true);

//stop creating thumbnails
function addImageInsertOverride($sizes){
	unset( $sizes['thumbnail']);
	unset( $sizes['medium']);
	unset( $sizes['large']);
	return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'addImageInsertOverride' );


//only localhost
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    //setting mailpit for mail testing
    add_action('phpmailer_init', 'setup');
    function setup($phpmailer)
    {
        $phpmailer->Host = 'mailpit';
        $phpmailer->Port = 1025;
        $phpmailer->IsSMTP();
    }

    // show wp_mail() errors
    add_action('wp_mail_failed', 'onMailError', 10, 1);
    function onMailError($wp_error)
    {
        echo "<pre>";
        print_r($wp_error);
        echo "</pre>";
    }
    //debug http_api in debug.log
    function templ_http_api_debug_logger( $response, $context, $class, $parsed_args, $url ) {
        error_log( 'http_api_debug: '.$url );
    }
    add_action('http_api_debug', 'templ_http_api_debug_logger', 10, 5);
}

/**
 * Disable forced checking for new WP, plugins, and theme versions in the admin panel,
 * so that it doesn't slow down when you haven't visited for a long time and then visit...
 * All checks will happen unnoticed through cron or when you visit the "Dashboard > Updates" page.
 *
 */
if( is_admin() ){
    // disable update checks when entering the admin panel...
    remove_action( 'admin_init', '_maybe_update_core' );
    remove_action( 'admin_init', '_maybe_update_plugins' );
    remove_action( 'admin_init', '_maybe_update_themes' );

    // disable update checks when entering a special page in the admin panel...
    remove_action( 'load-plugins.php', 'wp_update_plugins' );
    remove_action( 'load-themes.php', 'wp_update_themes' );

    // leave forced checking when entering the updates page...
    //remove_action( 'load-update-core.php', 'wp_update_plugins' );
    //remove_action( 'load-update-core.php', 'wp_update_themes' );

    // leave forced checking when entering the "Update/Install Plugin" or "Update/Install Theme" page - it doesn't interfere...
    //remove_action( 'load-update.php', 'wp_update_plugins' );
    //remove_action( 'load-update.php', 'wp_update_themes' );

    // don't touch the cron event, it will be used to check for updates - everything is fine here!
    //remove_action( 'wp_version_check', 'wp_version_check' );
    //remove_action( 'wp_update_plugins', 'wp_update_plugins' );
    //remove_action( 'wp_update_themes', 'wp_update_themes' );

    /**
     * disable the need to update the browser in the console - we always use top browsers!
     * this check happens once a week...
     */
    add_filter( 'pre_site_transient_browser_'. md5( $_SERVER['HTTP_USER_AGENT'] ), '__return_empty_array' );
}