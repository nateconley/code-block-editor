<?php

/**
 * Plugin Name:       Code Block Editor
 * Plugin URI:        https://www.github.com/nateconley/code-block-editor/
 * Description:       A block for displaying code snippets
 * Version:           1.0
 * Requires at least: 6.0.2
 * Requires PHP:      7.2
 * Author:            Nate Conley
 * Author URI:        https://www.nateconley.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       code-block-editor
 *
 * @package code-block-editor
 */

namespace Code_Block_Editor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define constants for use within this plugin.
 */
define( 'CODE_BLOCK_EDITOR_VERSION', '1.0' );
define( 'CODE_BLOCK_EDITOR_PATH', \plugin_dir_path( __FILE__ ) );
define( 'CODE_BLOCK_EDITOR_VIEWS', CODE_BLOCK_EDITOR_PATH . 'views/' );
define( 'CODE_BLOCK_EDITOR_URL', \plugin_dir_url( __FILE__ ) );
define( 'CODE_BLOCK_EDITOR_DIST', CODE_BLOCK_EDITOR_URL . 'dist/' );

if ( ! function_exists( 'init' ) ) {

	/**
	 * Initialize the plugin by requiring classes.
	 *
	 * @return void
	 */
	function init() {

		require_once CODE_BLOCK_EDITOR_PATH . 'includes/autoload.php';

		Block::init();
		Settings::init();

	}

	init();

}
