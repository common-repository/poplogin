<?php
/**
  
 * Plugin Name:       PopLogin
 * Plugin URI:        http://themes.tradesouthwest.com/plugins/
 * Description:       Plugin Description
 * Version:           1.0.0
 * Author:            Tradesouthwest
 * Author URI:        http://tradesouthwest.com
 * Text Domain:       poplogin
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (!defined('POPLOGIN_VER')) { define('POPLOGIN_VER', '1.0.0'); }

if (!defined('POPLOGIN_URL')) { define( 'POPLOGIN_URL', plugin_dir_url(__FILE__)); }

/*----------------------------------------------------------------------------*
 * * * ATTENTION! * * *
 * FOR DEVELOPMENT ONLY
 * SHOULD BE DISABLED ON PRODUCTION
 * poplogin poplogin-tswplugin Poplogin_Tswplugin
 *----------------------------------------------------------------------------*/
//error_reporting(E_ALL);
//ini_set('display_errors', );
/*----------------------------------------------------------------------------*/
/**
 * The code that runs during plugin activation.
 * This action is
 */
function activate_poplogin_tswplugin() {
    $t=time();
    $time = date("Y-m-d",$t);
    add_option( 'poplogin_settings_plugin_activated', $time );
    return false;
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-all-in-one-paypal-for-woocommerce-deactivator.php
 */
function deactivate_poplogin_tswplugin() {
    delete_option( 'poplogin_settings_plugin_activated' );
    return false;
}

register_activation_hook(__FILE__, 'activate_poplogin_tswplugin');
register_deactivation_hook(__FILE__, 'deactivate_poplogin_tswplugin');
//register_uninstall_hook( __FILE__, 'uninstall' );
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/poplogin-tswplugin.php';

