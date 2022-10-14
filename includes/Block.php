<?php

/**
 * WordPress block and related functionality.
 *
 * @package code-block-editor
 */

namespace Code_Block_Editor;

use \Code_Block_Editor\Data;

/**
 * WordPress block and related functionality.
 */
class Block {

	/**
	 * Initialize this class by hooking into WordPress.
	 *
	 * @return void
	 */
	public static function init() {

		\add_action( 'wp_enqueue_scripts', [ __CLASS__, 'register_prism' ] );
		\add_action( 'admin_enqueue_scripts', [ __CLASS__, 'register_codemirror' ] );
		\add_action( 'init', [ __CLASS__, 'register_block' ] );

	}

	/**
	 * Register the block for this plugin.
	 *
	 * @return void
	 */
	public static function register_block() {

		$script_deps = [
			'wp-block-editor',
			'wp-blocks',
			'wp-components',
			'wp-element',
			'wp-i18n',
		];

		\wp_register_script(
			'code-block-editor-block',
			CODE_BLOCK_EDITOR_DIST . 'src/js/block/index.js',
			$script_deps,
			CODE_BLOCK_EDITOR_VERSION,
			true
		);

		$style_deps = [ 'code-block-editor-codemirror-core' ];
		$theme = \get_option( 'code_block_editor_backend_theme' );
		if ( 'cm-s-default' !== $theme ) {
			$style_deps[] = 'code-block-editor-codemirror-theme-' . $theme;
		}

		\wp_register_style(
			'code-block-editor-block',
			CODE_BLOCK_EDITOR_DIST . 'src/css/block.css',
			$style_deps,
			CODE_BLOCK_EDITOR_VERSION,
			'all'
		);

		// Localize vars for use in the block.
		$languages = \get_option( 'code_block_editor_languages' );
		$language_data = Data::languages();
		$available_languages = [];
		foreach ( $languages as $language ) {
			$available_languages[ $language ] = [
				'name'           => $language_data[ $language ]['name'],
				'codemirror_val' => $language_data[ $language ]['codemirror_val'],
			];
		}

		\wp_localize_script(
			'code-block-editor-block',
			'CODE_BLOCK_EDITOR_VARS',
			[
				'languages'   => $available_languages,
				'lineNumbers' => \get_option( 'code_block_editor_line_numbers' ),
				'theme'       => $theme,
			]
		);

		\register_block_type(
			'code-block-editor/code-block-editor',
			[
				'editor_script'   => 'code-block-editor-block',
				'editor_style'    => 'code-block-editor-block',
				'attributes'      => [
					'language' => [
						'type'    => 'string',
						'default' => $languages[0],
					],
					'code' => [
						'type'    => 'string',
						'default' => '',
					],
				],
				'render_callback' => [ __CLASS__, 'render_block' ]
			]
		);

	}

	/**
	 * Register the CodeMirror (admin) themes.
	 *
	 * @return void
	 */
	public static function register_codemirror() {

		// Default core styles.
		\wp_register_style(
			'code-block-editor-codemirror-core',
			CODE_BLOCK_EDITOR_DIST . 'node_modules/codemirror/lib/codemirror.css',
			[],
			CODE_BLOCK_EDITOR_VERSION,
			'all'
		);

		$themes = array_keys( Data::backend_themes() );

		foreach ( $themes as $theme ) {

			// The default theme is included in the core css file.
			if ( 'cm-s-default' === $theme ) {
				continue;
			}

			\wp_register_style(
				'code-block-editor-codemirror-theme-' . $theme,
				CODE_BLOCK_EDITOR_DIST . 'node_modules/codemirror/theme/' . $theme . '.css',
				[],
				CODE_BLOCK_EDITOR_VERSION,
				'all'
			);
		}

	}

	/**
	 * Register all of the Prism.js scripts (frontend view).
	 *
	 * @return void
	 */
	public static function register_prism() {

		// Prism core.
		\wp_register_script(
			'code-block-editor-prism-core',
			CODE_BLOCK_EDITOR_DIST . 'src/js/prism/prism.js',
			[],
			CODE_BLOCK_EDITOR_VERSION,
			true
		);

		\wp_register_style(
			'code-block-editor-prism-core',
			CODE_BLOCK_EDITOR_DIST . 'src/css/prism/prism.css',
			[],
			CODE_BLOCK_EDITOR_VERSION,
			'all'
		);

		// Line numbers.
		\wp_register_script(
			'code-block-editor-prism-line-numbers',
			CODE_BLOCK_EDITOR_DIST . 'src/js/prism/line-numbers.js',
			[],
			CODE_BLOCK_EDITOR_VERSION,
			true
		);

		\wp_register_style(
			'code-block-editor-prism-line-numbers',
			CODE_BLOCK_EDITOR_DIST . 'src/css/prism/line-numbers.css',
			[],
			CODE_BLOCK_EDITOR_VERSION,
			'all'
		);

		// All of the different available languages.
		$languages = \wp_list_pluck( Data::languages(), 'prism_slug' );

		foreach ( $languages as $language ) {
			\wp_register_script(
				'code-block-editor-prism-language-' . $language,
				CODE_BLOCK_EDITOR_DIST . 'src/js/prism/' . $language . '.js',
				[],
				CODE_BLOCK_EDITOR_VERSION,
				true
			);
		}

		// All of the different available themes.
		$themes = array_keys( Data::frontend_themes() );

		foreach ( $themes as $theme ) {
			\wp_register_style(
				'code-block-editor-prism-theme-' . $theme,
				CODE_BLOCK_EDITOR_DIST . 'src/css/prism/' . $theme . '.css',
				[],
				CODE_BLOCK_EDITOR_VERSION,
				'all'
			);
		}

	}

	/**
	 * Render the block in PHP and selectively enqueue scripts.
	 *
	 * @return void
	 */
	public static function render_block( $attributes ) {

		\wp_enqueue_script( 'code-block-editor-prism-core' );
		\wp_enqueue_style( 'code-block-editor-prism-core' );

		// Are line numbers on?
		$line_numbers = \get_option( 'code_block_editor_line_numbers' ) ? true : false;
		if ( $line_numbers ) {
			\wp_enqueue_script( 'code-block-editor-prism-line-numbers' );
			\wp_enqueue_style( 'code-block-editor-prism-line-numbers' );
		}

		// What language?
		$language = $attributes['language'];
		$language_class = Data::languages()[ $language ]['prism_slug'];
		\wp_enqueue_script( 'code-block-editor-prism-language-' . $language_class );

		// What theme?
		$theme = \get_option( 'code_block_editor_frontend_theme' );
		\wp_enqueue_style( 'code-block-editor-prism-theme-' . $theme );

		return sprintf(
			'<pre class="language-%s %s"><code>%s</code></pre>',
			\esc_attr( $language ),
			$line_numbers ? 'line-numbers' : '',
			\esc_html( $attributes['code'] )
		);

	}

}
