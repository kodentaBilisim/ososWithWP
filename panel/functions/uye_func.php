<?php

function kisiGetir( $meta, $value ) {

	global $db;


	$User = $db->from( 'kisiler' )->where( $meta, $value )->first();

	if($User){
		$KisiMeta = $db->from( 'kisiMeta' )->where( 'kisi', $User['id'] )->all();

		foreach ( $KisiMeta as $meta ) {
			if ( isset( $User[ $meta['meta'] ] ) and ! is_array( $User[ $meta['meta'] ] ) ) {
				$gecici                  = $User[ $meta['meta'] ];
				$User[ $meta['meta'] ]   = array();
				$User[ $meta['meta'] ][] = $gecici;
				$User[ $meta['meta'] ][] = $meta['value'];
			} elseif ( isset( $User[ $meta['meta'] ] ) ) {
				if ( is_array( $User[ $meta['meta'] ] ) ) {
					$User[ $meta['meta'] ][] = $meta['value'];
				}
			} else {
				$User[ $meta['meta'] ] = $meta['value'];
			}
		}

		return $User;
	}else{
		return false;
	}


}


function kisiGetirSingle( $id ) {

	global $db;


	$User = $db->from( 'kisiler' )->where( 'id', $id )->first();

	if($User){
		$KisiMeta = $db->from( 'kisiMeta' )->where( 'kisi', $User['id'] )->all();

		foreach ( $KisiMeta as $meta ) {
			if ( isset( $User[ $meta['meta'] ] ) and ! is_array( $User[ $meta['meta'] ] ) ) {
				$gecici                  = $User[ $meta['meta'] ];
				$User[ $meta['meta'] ]   = array();
				$User[ $meta['meta'] ][] = $gecici;
				$User[ $meta['meta'] ][] = $meta['value'];
			} elseif ( isset( $User[ $meta['meta'] ] ) ) {
				if ( is_array( $User[ $meta['meta'] ] ) ) {
					$User[ $meta['meta'] ][] = $meta['value'];
				}
			} else {
				$User[ $meta['meta'] ] = $meta['value'];
			}
		}

		return $User;
	}else{
		return false;
	}


}

function ilgetirbyID($id){

	$iller = ['TR','ADANA','ADIYAMAN','AFYONKARAHİSAR','AĞRI','AMASYA','ANKARA','ANTALYA','ARTVİN','AYDIN','BALIKESİR','BİLECİK','BİNGÖL','BİTLİS','BOLU','BURDUR','BURSA','ÇANAKKALE','ÇANKIRI','ÇORUM','DENİZLİ','DİYARBAKIR','EDİRNE','ELAZIĞ','ERZİNCAN','ERZURUM','ESKİŞEHİR','GAZİANTEP','GİRESUN','GÜMÜŞHANE','HAKKARİ','HATAY','ISPARTA','MERSİN','İSTANBUL','İZMİR','KARS','KASTAMONU','KAYSERİ','KIRKLARELİ','KIRŞEHİR','KOCAELİ','KONYA','KÜTAHYA','MALATYA','MANİSA','KAHRAMANMARAŞ','MARDİN','MUĞLA','MUŞ','NEVŞEHİR','NİĞDE','ORDU','RİZE','SAKARYA','SAMSUN','SİİRT','SİNOP','SİVAS','TEKİRDAĞ','TOKAT','TRABZON','TUNCELİ','ŞANLIURFA','UŞAK','VAN','YOZGAT','ZONGULDAK','AKSARAY','BAYBURT','KARAMAN','KIRIKKALE','BATMAN','ŞIRNAK','BARTIN','ARDAHAN','IĞDIR','YALOVA','KARABÜK','KİLİS','OSMANİYE','DÜZCE',];



	return $iller[$id];

}

function ilgetir(){

	$iller = ['İLİ OLMAYAN','ADANA','ADIYAMAN','AFYONKARAHİSAR','AĞRI','AMASYA','ANKARA','ANTALYA','ARTVİN','AYDIN','BALIKESİR','BİLECİK','BİNGÖL','BİTLİS','BOLU','BURDUR','BURSA','ÇANAKKALE','ÇANKIRI','ÇORUM','DENİZLİ','DİYARBAKIR','EDİRNE','ELAZIĞ','ERZİNCAN','ERZURUM','ESKİŞEHİR','GAZİANTEP','GİRESUN','GÜMÜŞHANE','HAKKARİ','HATAY','ISPARTA','MERSİN','İSTANBUL','İZMİR','KARS','KASTAMONU','KAYSERİ','KIRKLARELİ','KIRŞEHİR','KOCAELİ','KONYA','KÜTAHYA','MALATYA','MANİSA','KAHRAMANMARAŞ','MARDİN','MUĞLA','MUŞ','NEVŞEHİR','NİĞDE','ORDU','RİZE','SAKARYA','SAMSUN','SİİRT','SİNOP','SİVAS','TEKİRDAĞ','TOKAT','TRABZON','TUNCELİ','ŞANLIURFA','UŞAK','VAN','YOZGAT','ZONGULDAK','AKSARAY','BAYBURT','KARAMAN','KIRIKKALE','BATMAN','ŞIRNAK','BARTIN','ARDAHAN','IĞDIR','YALOVA','KARABÜK','KİLİS','OSMANİYE','DÜZCE',];



	return $iller;

}
