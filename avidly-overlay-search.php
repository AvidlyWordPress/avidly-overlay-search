<?php
/**
 * Plugin Name:       Accessible Overlay Search
 * Description:       Accessible overlay search dialog.
 * Version:           1.1.0
 * Author:            Avidly
 * Author URI:        https://avidly.fi
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       overlay-search
 * Domain Path:       /languages
 *
 * @package           Overlay_Search
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'OVERLAY_SEARCH_VERSION', '2.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-overlay-search-activator.php
 */
function activate_overlay_search() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-overlay-search-activator.php';
	Overlay_Search_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-overlay-search-deactivator.php
 */
function deactivate_overlay_search() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-overlay-search-deactivator.php';
	Overlay_Search_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_overlay_search' );
register_deactivation_hook( __FILE__, 'deactivate_overlay_search' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-overlay-search.php';
require plugin_dir_path( __FILE__ ) . '/functions.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
function run_overlay_search() {

	$plugin = new Overlay_Search();
	$plugin->run();

}
run_overlay_search();
