<?php

/**
 * @link              https://github.com/hellomohsinkhan
 * @since             1.0.0
 * @package           Insert_post_from_front_end
 *
 * @wordpress-plugin
 * Plugin Name:       Insert post from front-end with featured image
 * Plugin URI:        https://github.com/hellomohsinkhan/insert-post-from-front-end
 * Description:       This plugin is created for insert post from front-end, Using this plugin we can insert any type of post from front-end with featured image.
 * Version:           1.0.0
 * Author:            Mohsin Khan
 * Author URI:        https://github.com/hellomohsinkhan
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       insert_post_from_front_end
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-insert_post_from_front_end-activator.php
 */
function activate_insert_post_from_front_end() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-insert_post_from_front_end-activator.php';
	Insert_post_from_front_end_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-insert_post_from_front_end-deactivator.php
 */
function deactivate_insert_post_from_front_end() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-insert_post_from_front_end-deactivator.php';
	Insert_post_from_front_end_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_insert_post_from_front_end' );
register_deactivation_hook( __FILE__, 'deactivate_insert_post_from_front_end' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-insert_post_from_front_end.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_insert_post_from_front_end() {

	$plugin = new Insert_post_from_front_end();
	$plugin->run();

}
run_insert_post_from_front_end();
