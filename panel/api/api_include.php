<?php


session_start();
ini_set( 'display_errors', 'on' );
//error_reporting( E_ERROR );
error_reporting( E_ALL );
require_once '/var/www/html/panel/env.php';

require_once server_root_dir() . '/config/db.php';

require_once server_root_dir() . '/functions.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ( $requestMethod ) {
	case 'POST':
		if ( ! isset( $_FILES ) ) {
			checkFormTokenSession( $_POST['token'] );
		}
		unset( $_POST['postUrl'] );
		unset( $_POST['upload'] );
}


