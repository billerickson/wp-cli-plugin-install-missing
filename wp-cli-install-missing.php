<?php
/**
 * Plugin Name: WP CLI Install Missing
 * Plugin URI:  https://github.com/billerickson/wp-cli-install-missing
 * Description: Using wp cli, install any plugins that are "active" but missing.
 * Version:     0.1.0
 * Author:      Bill Erickson
 * Author URI:  http://www.billerickson.net
 * License: GPL v2.0
 */

if ( ! ( defined('WP_CLI') && WP_CLI ) )
	return;
	

/**
 * Installs any plugins that are active but missing
 *
 * ## OPTIONS
 *
 * [--dry-run]
 * : Run the search and show report, but don't install missing plugins
 */
function be_wpcli_install_missing( $args, $assoc_args ) {

	// Active Plugins
	$response = WP_CLI::launch_self( 'plugin list', array(), array( 'format' => 'json', 'status' => 'active' ), false, true );
	$active = json_decode( $response->stdout );
	$active = wp_list_pluck( $active, 'name' );
	
	// Installed Plugins
	$installed = get_option( 'active_plugins' );
	foreach( $installed as &$plugin ) {
		$plugin = strstr( $plugin, '/', true );
	}
		
	// Missing Plugins
	$missing = array_diff( $installed, $active );

	// No Missing Plugins			
	if( empty( $missing ) ) {

		WP_CLI::log( 'No missing plugins' );
		exit;
		
	}
	
	// Display list of Missing Plugins	
	WP_CLI::log( 'The following plugins are missing:' );
	foreach( $missing as $plugin ) {
		WP_CLI::log( $plugin );
	}
	
	// Quit here for dry run
	$dry_run = isset( $assoc_args['dry-run'] ) && (bool) $assoc_args['dry-run'] ? true : false;
	if( $dry_run ) {
		exit;
	}
		
	// Install plugins
	WP_CLI::log( 'Installing plugins...' );
	foreach( $missing as $plugin ) {
		$response = WP_CLI::launch_self( 'plugin install', array( $plugin ), array(), false, true );
		WP_CLI::log( $response->stdout );
	}
}
WP_CLI::add_command( 'plugin install-missing', 'be_wpcli_install_missing' );