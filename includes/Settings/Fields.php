<?php

/**
 * Settings fields rendering.
 *
 * @package code-block-editor
 */

namespace Code_Block_Editor\Settings;

use Code_Block_Editor\Data;

/**
 * Settings fields rendering.
 */
class Fields {

	/**
	 * Render the languages field
	 *
	 * @param  array $args Field arguments.
	 *
	 * @return void
	 */
	public static function languages( $args ) {

		$options = \get_option( $args['option_name'] );

		foreach ( $args['options'] as $language_key => $language_value ) {

			printf(
				'<div>
					<input type="checkbox" id="%1$s" name="%2$s" value="%3$s" %4$s>
					<label for="%1$s">%5$s</label>
				</div>',
				\esc_attr( 'code-block-editor-language-' . $language_key ),
				\esc_attr( $args['option_name'] . '[]' ),
				\esc_attr( $language_key ),
				\checked(
					in_array( $language_key, $options ),
					true,
					false
				),
				\esc_html( $language_value['name'] )
			);

		}

	}

	/**
	 * Render the line numbers field
	 *
	 * @param  array $args Field arguments.
	 *
	 * @return void
	 */
	public static function line_numbers( $args ) {

		printf(
			'<div>
				<input type="checkbox" id="%1$s" name="%2$s" value="%3$s" %4$s>
				<label for="%1$s">%5$s</label>
			</div>',
			\esc_attr( 'code-block-editor-line-numbers' ),
			\esc_attr( $args['option_name'] ),
			\esc_attr( 1 ),
			\checked(
				(bool) \get_option( $args['option_name'] ),
				true,
				false
			),
			\esc_html__( 'Enable Line Numbers?', 'code-block-editor' )
		);

	}

	/**
	 * Render the frontend theme field.
	 *
	 * @param  array $args Field arguments.
	 *
	 * @return void
	 */
	public static function frontend_theme( $args ) {

		$option = \get_option( $args['option_name'] );

		$options = [];
		foreach ( Data::frontend_themes() as $theme_key => $theme_value ) {
			$options[] = sprintf(
				'<option value="%s" %s>%s</option>',
				\esc_attr( $theme_key ),
				\selected( $option === $theme_key, true, false ),
				\esc_html( $theme_value )
			);
		}

		printf(
			'<div>
				<div>
					<label for="%1$s">%4$s</label>
				</div>
				<select type="checkbox" id="%1$s" name="%2$s">
					%3$s
				</select>
			</div>',
			\esc_attr( 'code-block-editor-frontend-theme' ),
			\esc_attr( $args['option_name'] ),
			implode( '', $options ),
			\esc_html__( 'Frontend Theme:', 'code-block-editor' )
		);

	}

	/**
	 * Render the backend theme field.
	 *
	 * @param  array $args Field arguments.
	 *
	 * @return void
	 */
	public static function backend_theme( $args ) {

		$option = \get_option( $args['option_name'] );

		$options = [];
		foreach ( Data::backend_themes() as $theme_key => $theme_value ) {
			$options[] = sprintf(
				'<option value="%s" %s>%s</option>',
				\esc_attr( $theme_key ),
				\selected( $option === $theme_key, true, false ),
				\esc_html( $theme_value )
			);
		}

		printf(
			'<div>
				<div>
					<label for="%1$s">%4$s</label>
				</div>
				<select type="checkbox" id="%1$s" name="%2$s">
					%3$s
				</select>
			</div>',
			\esc_attr( 'code-block-editor-backend-theme' ),
			\esc_attr( $args['option_name'] ),
			implode( '', $options ),
			\esc_html__( 'Admin (block editor) Theme:', 'code-block-editor' )
		);

	}

}
