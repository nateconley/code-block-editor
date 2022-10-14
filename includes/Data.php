<?php

/**
 * Helper class containing data in static methods.
 *
 * @package code-block-editor
 */

namespace Code_Block_Editor;

/**
 * Helper class containing data in static methods.
 */
class Data {

	/**
	 * Retrieve language data.
	 *
	 * Languages are shared by both Prism and Codemirror, so we must store
	 * the slugs for both.
	 *
	 * @return array The language data as an associative array.
	 */
	public static function languages() {

		return [
			'css' => [
				'name'            => __( 'CSS/Scss', 'code-block-editor' ),
				'codemirror_slug' => 'css',
				'codemirror_val'  => 'css',
				'prism_slug'      => 'scss',
			],
			'html' => [
				'name'            => __( 'HTML', 'code-block-editor' ),
				'codemirror_slug' => 'htmlmixed',
				'codemirror_val'  => 'htmlmixed',
				'prism_slug'      => 'markup-templating',
			],
			'javascript' => [
				'name'            => __( 'JavaScript', 'code-block-editor' ),
				'codemirror_slug' => 'javascript',
				'codemirror_val'  => 'javascript',
				'prism_slug'      => 'javascript',
			],
			'json' => [
				'name'            => __( 'JSON', 'code-block-editor' ),
				'codemirror_slug' => 'javascript',
				'codemirror_val'  => 'application/ld+json',
				'prism_slug'      => 'json',
			],
			'markdown' => [
				'name'            => __( 'Markdown', 'code-block-editor' ),
				'codemirror_slug' => 'markdown',
				'codemirror_val'  => 'text/x-markdown',
				'prism_slug'      => 'markdown',
			],
			'php' => [
				'name'            => __( 'PHP', 'code-block-editor' ),
				'codemirror_slug' => 'php',
				'codemirror_val'  => 'text/x-php',
				'prism_slug'      => 'php',
			],
			'shell' => [
				'name'            => __( 'Shell', 'code-block-editor' ),
				'codemirror_slug' => 'shell',
				'codemirror_val'  => 'text/x-sh',
				'prism_slug'      => 'shell-session',
			],
		];

	}

	/**
	 * Retrieve a list frontend themes.
	 *
	 * @return array The frontend themes.
	 */
	public static function frontend_themes() {

		return [
			'coy'            => __( 'Coy', 'code-block-editor' ),
			'dark'           => __( 'Dark', 'code-block-editor' ),
			'funky'          => __( 'Funky', 'code-block-editor' ),
			'okaidia'        => __( 'Okaidia', 'code-block-editor' ),
			'solarizedlight' => __( 'Solarized Light', 'code-block-editor' ),
			'tomorrow'       => __( 'Tomorrow', 'code-block-editor' ),
			'twilight'       => __( 'Twilight', 'code-block-editor' ),
		];

	}

	/**
	 * Retrieve a list frontend themes.
	 *
	 * @return array The backend themes.
	 */
	public static function backend_themes() {

		return [
			'cm-s-default' => __( 'Default', 'code-block-editor' ),
			'material'     => __( 'Material', 'code-block-editor' ),
			'xq-light'     => __( 'XQ Light', 'code-block-editor' ),
		];

	}

}
