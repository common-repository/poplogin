<?php

/**
 * The uninstall functionality of the plugin.
 *
 * @package    Poplogin
 * @subpackage poplogin/public
 * @author     tradesouthwest <tradesouthwest@gmail.com>
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'poplogin_settings_plugin_activated' );

