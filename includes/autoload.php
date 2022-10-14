<?php
/**
 * Autoload this includes/ folder.
 */

namespace Code_Block_Editor;

\spl_autoload_register(
	function( $class_name ) {

		if ( false === \strpos( $class_name, 'Code_Block_Editor\\' ) ) {
			return;
		}

		$class_name = \str_replace( 'Code_Block_Editor\\', '', $class_name );
		$class_name = \str_replace( '\\', '/', $class_name );
		$path       = \plugin_dir_path( __FILE__ );

		require_once $path . $class_name . '.php';

	}
);
