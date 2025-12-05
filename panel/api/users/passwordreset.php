<?php

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':

		$v = $_POST;

		$password = randomPassword();


		$db->update('users')
			->where('id', $v['userID'])
			->set([
				'password' => md5($password),
				'passbase64' => base64_encode($password)
			]);

		echo pageReturn( array( 'operation' => 'none', 'sleep' => '0', 'data' => $v ) );

}
