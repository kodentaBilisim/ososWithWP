<?php

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'GET':


		$data = $db->update( 'kisiler' )->where( 'rand', $_GET['rnd'], '!=' )->set([
			'durum' => 0
		]);


/*		$data = $db->from( 'kisiler' )->where( 'rand', $_GET['rnd'], '!=' )->all();*/

		var_dump($data);


}
