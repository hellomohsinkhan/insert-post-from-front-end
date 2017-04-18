<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/hellomohsinkhan
 * @since      1.0.0
 *
 * @package    Insert_post_from_front_end
 * @subpackage Insert_post_from_front_end/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Insert_post_from_front_end
 * @subpackage Insert_post_from_front_end/includes
 * @author     Mohsin Khan <hellomohsinkhan@gmail.com>
 */
class Insert_post_from_front_end_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'insert_post_from_front_end',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
