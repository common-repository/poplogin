<?php

/**
 * @package    Poplogin
 * @subpackage poplogin/includes
 * @since      1.0.0
 * @author     tradesouthwest <tradesouthwest@gmail.com>
 */

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Set the domain and register the hook with WordPress.
     *
     * @since    1.0.0
     * @slug     poplogin
     */
    function poplogin_load_plugin_textdomain() {

	$plugin_dir = basename( dirname(__FILE__) ) .'/languages';
    load_plugin_textdomain( 'poplogin', false, $plugin_dir );

    }
    add_action('plugins_loaded', 'poplogin_load_plugin_textdomain');

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
    
     function poplogin_define_admin_scripts() {
         wp_enqueue_style( 'thickbox' );
         wp_enqueue_style( 'wp-media' );
     }
     add_action( 'admin_enqueue_scripts', 'poplogin_define_admin_scripts' );
    */
     
    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     */
    function poplogin_define_public_scripts() {
        wp_register_style( 'poplogin', POPLOGIN_URL . 'lib/poplogin-public.css' );
        
        wp_enqueue_script( 'poplogin', POPLOGIN_URL . 'lib/poplogin-public.js', 
                     array( 'jquery' ), POPLOGIN_VER, true);
        wp_enqueue_style( 'poplogin' );
    }
    add_action( 'wp_enqueue_scripts', 'poplogin_define_public_scripts' );
    
    /**
     * Add the admin area.
     */
    if( is_admin() ) :  
    require_once plugin_dir_path(dirname(__FILE__)) . 'admin/poplogin-tswplugin-admin.php';
    endif;
    /**
     * Add the public-facing side of the site.
     */
    require_once plugin_dir_path(dirname(__FILE__)) . 'public/poplogin-tswplugin-public.php';

