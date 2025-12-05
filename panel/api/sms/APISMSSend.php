<?php

require_once '../api_include.php';


switch ( $requestMethod ) {
	case 'GET':
		$KampanyaID = $_GET['id'];

		// GÖNDERİLECEK TELEFON NUMARALARI
		$telefonlar = array();
		$smsmeta    = smsmeta( $KampanyaID );
		$i          = 0;
		foreach ( $smsmeta as $item ) {

			$telefonlar[ $i ] = $item['telefon'];
			$i ++;
		}
		// GÖNDERİLECEK TELEFON NUMARALARI

		//ZAMANLAMA KONTROL
		$senddate = kampanyameta( $KampanyaID, 'senddate' );
		//ZAMANLAMA KONTROL


		//MESAJ İÇERİĞİ
		$mesaj     = kampanyameta( $KampanyaID, 'mesaj' );
		$mesajmeta = kampanyameta( $KampanyaID, 'user' );


		//İMZA
		$mesaj = str_replace( '…', '...', $mesaj );
		//MESAJ İÇERİĞİ
        $telefonlar[] = '5050566774';
        $telefonlar[] = '5414363412';
		$response = $netgsm->send( $mesaj, $telefonlar, $KampanyaID, $senddate );

		if ( $response['basari'] ) {
			$db->update( 'kampanya' )->where( 'id', $KampanyaID )->set( [
					'campaignId' => $response['basari']
				] );
			echo json_encode( array( 'operation' => 'none', 'status' => 'success' ) );
		} else {
			$db->update( 'kampanya' )->where( 'id', $KampanyaID )->set( [
					'campaignId' => $response['hata']
				] );
			echo json_encode( array( 'operation' => 'none', 'hata' => $response['mesaj'] ) );
		}


		$Data['value'] = array( 'kampanyaid' => $KampanyaID, 'result' => $response );
		$Data['type']  = 'mesaj-gonderimi';
		//$Data['user']  = username( $_SESSION['UserID'] );
		//PersonelLogs( $Data );
		break;
}
