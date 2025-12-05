<?php

ini_set( 'display_errors', 'on' );
//error_reporting( E_ERROR );
error_reporting( E_ALL );
include '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':


		if(!isset($_FILES['file']) OR empty($_FILES['file'])){
			echo pageReturn( array(
				'operation' => 'none',
				'hata' => 'Dosya Yüklenemedi1!',

			) );
			die();
		}


		$dosyaUzantisi = pathinfo( $_FILES['file']['name'], PATHINFO_EXTENSION );

		$fileURL = uploadFile( $_FILES['file'] );

		if ( ! isset( $fileURL['hata'] ) ){
			$db->insert( 'files' )
			   ->set( [
				'url'  => $fileURL['fileurl'],
				'name' => $fileURL['fileName'],
				'type' => $fileURL['type'],
				'time' => date( 'Y-m-d H:i:s' )
			] );


			echo pageReturn( array(
				'operation' => 'none',
				'fileUrl'   => $fileURL['fileurl'],
				'fileName'  => $fileURL['fileName'],
				'fileID'    => $db->lastId(),
				'data'      => $fileURL
			) );

		}else{
			echo pageReturn( array(
				'operation' => 'none',
				'hata' => 'Dosya Yüklenemedi!',
			) );
		}


}
