<?php

/**
 * Sanitization for the settings fields.
 *
 * @package code-block-editor
 */

namespace Code_Block_Editor\Settings;

/**
 * Sanitization for the settings fields.
 */
class Sanitize {

	/**
	 * Sanitize the languages field.
	 *
	 * @param  array $languages The raw languages.
	 * @return array
	 */
	public static function sanitize_languages( $languages ) {

		// TODO: check against Data::languages() array.

		// Languages cannot be empty.
		if ( ! is_array( $languages ) || empty( $languages ) ) {
			return array_keys( self::languages() );
		}

		return array_map( '\sanitize_text_field', $languages );
	}

	/**
	 * Sanitize the line numbers field.
	 *
	 * @param  bool $value The line number checkbox value.
	 * @return bool
	 */
	public static function line_numbers( $value ) {

		return $value ? true : false;

	}

	/**
	 * Sanitize the frontend theme field.
	 *
	 * @param  string $value Theme slug.
	 * @return string
	 */
	public static function frontend_theme( $value ) {

		// TODO: check against Data::frontend_themes() array.

		return sanitize_text_field( $value );

	}

	/**
	 * Sanitize the backend theme field.
	 *
	 * @param  string $value Theme slug.
	 * @return string
	 */
	public static function backend_theme( $value ) {

		// TODO: check against Data::backend_themes() array.

		return sanitize_text_field( $value );

	}

}
