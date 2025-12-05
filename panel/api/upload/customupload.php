<?php


include '../api_include.php';


switch ( $requestMethod ) {
	case 'POST':
		if ( ! isset( $_FILES['files'] ) or empty( $_FILES['files'] ) ) {
			echo pageReturn( array(
				'operation' => 'none',
				'hata'      => 'Dosya Yüklenemedi!',
			) );
			die();
		}

		$countfiles = count( $_FILES['files']['name'] );
		$files_arr  = array();
		for ( $index = 0; $index < $countfiles; $index ++ ) {

			$dosyaUzantisi = pathinfo( $_FILES['files']['name'][ $index ], PATHINFO_EXTENSION );
			$fileUUID      = uuidgenerate();

			$dosyaUzantisi = pathinfo( $_FILES['files']['name'][ $index ], PATHINFO_EXTENSION );
			$file          = $fileUUID . '.' . $dosyaUzantisi;
			$target_dir    = server_root_dir() . 'docs/';
			$target_file   = $target_dir . basename( $file );
			if ( move_uploaded_file( $_FILES['files']["tmp_name"][ $index ], $target_file ) ) {
				chmod( $target_file, 0777 );
				$files_arr[] = $file;
			}


			//$fileURL = uploadFileCustom( $_FILES['file'], $fileUUID );


		}

		echo pageReturn( array(
			'operation' => 'none',
			'uuid'      => $files_arr,
		) );
		die();

}
