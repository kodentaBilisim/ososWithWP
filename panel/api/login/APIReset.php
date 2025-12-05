<?php


session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/env.php';

require_once server_root_dir() . '/config/db.php';

require_once server_root_dir() . '/functions.php';

if ( $_POST ) {

	$veri       = $_POST['query'];
	$usercode   = $veri['usercode'];
	$emailortel = $veri['emailortel'];
	$usercode   = trim( $usercode );


	$LoginCheck = $db->from( 'users' )
	                 ->where( 'username', $usercode )
	                 ->first();

	$password = randomPassword();
	$db->update( 'users' )
	   ->where( 'id', $LoginCheck['id'] )
	   ->set( [
		   'password'   => md5( $password ),
		   'passbase64' => base64_encode( $password )
	   ] );

	$userMeta = userMeta( $LoginCheck['id'] );


	if ( $emailortel == $userMeta['GSM'] ) {

		$MesajContent = 'MisafirUS kullanıcı bilgileriniz - Kullanıcı Adı: ' . $userMeta['username'] . ' Şifre: ' . base64_decode( $userMeta['passbase64'] ) . ' https://misafirus.com';
		$data         = sendSMSSingleUser( $LoginCheck['id'], $MesajContent );

		echo 'sms';


	} elseif ( $emailortel == $userMeta['email'] ) {

		if ( $userMeta['type'] == 'firma' ) {
			$Template = $db->from( 'mailsablon' )
			               ->where( 'id', 1 )
			               ->first();

			$content = $Template['tr'];
			$content = str_replace( '##FIRMA##', $userMeta['name'], $content );
		} elseif ( $userMeta['type'] == 'taseron' ) {
			$Template = $db->from( 'mailsablon' )
			               ->where( 'id', 1 )
			               ->first();

			$content = $Template['tr'];
			$content = str_replace( '##FIRMA##', $userMeta['name'], $content );
		}


		$content = str_replace( '##FIRMA##', $userMeta['name'], $content );
		$content = str_replace( '##URL##', $scriptConfig['mainURL'], $content );
		$content = str_replace( '##USERNAME##', $userMeta['username'], $content );
		$content = str_replace( '##PASSWORD##', base64_decode( $userMeta['passbase64'] ), $content );

		$emailstatus = sendmail( $userMeta['email'], 'USDANISMANLIK KULLANICI BİLGİLERİ', $content );
		echo 'mail';


	} else {

		echo 0;

	}


}
