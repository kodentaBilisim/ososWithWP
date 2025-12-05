<?php

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':

		$v = $_POST;

		$userMetaGet = userMeta( $v['UserID'] );

			if ( ! listPersonelSGK( $v['UserID'] ) ):

				$delete = $db->delete( 'remember' )->where( 'user', $v['UserID'] )->done();
				$delete = $db->delete( 'relation' )->where( 'firma', $v['UserID'] )->done();
				$delete = $db->delete( 'relation' )->where( 'taseron', $v['UserID'] )->done();
				$delete = $db->delete( 'talep' )->where( 'taseron', $v['UserID'] )->done();
				$delete = $db->delete( 'talep' )->where( 'talepFrom', $v['UserID'] )->done();
				$delete = $db->delete( 'notes' )->where( 'user', $v['UserID'] )->done();;
				$delete = $db->delete( 'KKD' )->where( 'user', $v['UserID'] )->done();
				if ( $userMetaGet ) {
					foreach ( userDocumentCheck( $v['UserID'] ) as $userDoc ) {
						dokumanDelete( $userDoc['uuid'] );
					}

					$permisson = $db->delete( 'permission' )->where( 'userID', $v['UserID'] )->done();
					$remember  = $db->delete( 'remember' )->where( 'user', $v['UserID'] )->done();
					$remember  = $db->delete( 'personelDers' )->where( 'personel_id', $v['UserID'] )->done();

				}
				$talimat = $db->from( 'talep' )->where( 'taseron', $v['UserID'] )->or_where( 'talepFrom', $v['UserID'] )->all();

				foreach ( $talimat as $item ) {
					$remember = $db->delete( 'talimatPersonel' )->where( 'talimat', $item['id'] )->done();
				}

				$userMeta    = $db->delete( 'userMeta' )->where( 'user', $v['UserID'] )->done();
				$talep = $db->delete( 'users' )->where( 'id', $v['UserID'] )->done();
				echo pageReturn( array(
					'operation' => 'reload',
					'data'      => $v
				) );
				else:


					echo pageReturn( array(
						'operation' => 'none',
						'data'      => $v,
						'hata'      => 'Firmaya Kayıtlı Personel Mevcut. Öncelikle Tüm Personelleri Silin!'
					) );


		endif;
}
