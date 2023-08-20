<?php

// include_once('system/icontroller.php');
// include_once('system/router.php');
// include_once('system/istorage.php');
// include_once('system/filestorage.php');

// include_once('articles/controller.php');


spl_autoload_register( function ($name) {
	$path = str_replace( '\\', '/', $name ) . '.php';
	echo "<pre>";
	print_r( $name );
	echo "</pre>";

	if ( file_exists( $path ) ) {
		include_once( $path );
	}
} );