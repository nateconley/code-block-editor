<?php

/**
 * Settings page and options.
 *
 * @package code-block-editor
 */

namespace Code_Block_Editor;

use \Code_Block_Editor\Data;
use \Code_Block_Editor\Settings\Fields;
use \Code_Block_Editor\Settings\Sanitize;

/**
 * Settings page and options.
 */
class Settings {

	/**
	 * Initialize this class by hooking into WordPress.
	 *
	 * @return void
	 */
	public static function init() {

		\add_action( 'admin_menu', [ __CLASS__, 'options_page' ] );
		\add_action( 'admin_init', [ __CLASS__, 'register_settings' ] );

	}

	public static function options_page() {

		\add_options_page(
			esc_html__( 'Code Block Editor', 'code-block-editor' ),
			esc_html__( 'Code Block Editor', 'code-block-editor' ),
			'manage_options',
			'code-block-editor',
			[ __CLASS__, 'view' ]
		);

	}

	/**
	 * Register settings section, settings, and fields.
	 *
	 * @return void
	 */
	public static function register_settings() {

		\add_settings_section(
			'code-block-editor-settings',
			'',
			'__return_empty_string',
			'code-block-editor'
		);

		/**
		 * Languages settings and field.
		 */
		\register_setting(
			'code-block-editor',
			'code_block_editor_languages',
			[
				'type'              => 'array',
				'sanitize_callback' => [ '\Code_Block_Editor\Settings\Sanitize', 'sanitize_languages' ],
				'default'           => array_keys( Data::languages() ),
			]
		);

		\add_settings_field(
			'code_block_editor_languages',
			esc_html__( 'Languages', 'code-block-editor' ),
			[ '\Code_Block_Editor\Settings\Fields', 'languages' ],
			'code-block-editor',
			'code-block-editor-settings',
			[
				'option_name' => 'code_block_editor_languages',
				'options'     => Data::languages(),
			]
		);

		/**
		 * Line numbers checkbox.
		 */
		\register_setting(
			'code-block-editor',
			'code_block_editor_line_numbers',
			[
				'type'              => 'boolean',
				'sanitize_callback' => [ '\Code_Block_Editor\Settings\Sanitize', 'line_numbers' ],
				'default'           => true,
			]
		);

		\add_settings_field(
			'code_block_editor_line_numbers',
			esc_html__( 'Line Numbers', 'code-block-editor' ),
			[ '\Code_Block_Editor\Settings\Fields', 'line_numbers' ],
			'code-block-editor',
			'code-block-editor-settings',
			[
				'option_name' => 'code_block_editor_line_numbers',
			]
		);

		/**
		 * Frontend theme setting and field.
		 */
		\register_setting(
			'code-block-editor',
			'code_block_editor_frontend_theme',
			[
				'type'              => 'string',
				'sanitize_callback' => [ '\Code_Block_Editor\Settings\Sanitize', 'frontend_theme' ],
				'default'           => array_keys( Data::frontend_themes() )[0],
			]
		);

		\add_settings_field(
			'code_block_editor_frontend_theme',
			esc_html__( 'Frontend Theme', 'code-block-editor' ),
			[ '\Code_Block_Editor\Settings\Fields', 'frontend_theme' ],
			'code-block-editor',
			'code-block-editor-settings',
			[
				'option_name' => 'code_block_editor_frontend_theme',
			]
		);

		/**
		 * Admin theme setting and field.
		 */
		\register_setting(
			'code-block-editor',
			'code_block_editor_backend_theme',
			[
				'type'              => 'string',
				'sanitize_callback' => [ '\Code_Block_Editor\Settings\Sanitize', 'backend_theme' ],
				'default'           => array_keys( Data::backend_themes() )[0],
			]
		);

		\add_settings_field(
			'code_block_editor_backend_theme',
			esc_html__( 'Admin (block editor) Theme', 'code-block-editor' ),
			[ '\Code_Block_Editor\Settings\Fields', 'backend_theme' ],
			'code-block-editor',
			'code-block-editor-settings',
			[
				'option_name' => 'code_block_editor_backend_theme',
			]
		);

	}

	/**
	 * The view for the options page as a whole.
	 *
	 * @return void
	 */
	public static function view() {

		require_once CODE_BLOCK_EDITOR_VIEWS . 'options.php';

	}

}
