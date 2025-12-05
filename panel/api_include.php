<?php


session_start();

require_once '../../env.php';

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


