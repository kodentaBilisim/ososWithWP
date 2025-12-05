<?php

function smsmeta($KampanyaID)
{


	global $db;
	$KampanyaMeta = $db->from('kampanya')->where('id', $KampanyaID)->first();
	$Filter = json_decode($KampanyaMeta['data'], true);
	$FilterEK = json_decode($KampanyaMeta['ek'], true);

	if (!isset($Filter['cinsiyet']) or empty($Filter['cinsiyet'])) {

		$Cinsiyet = array('E','K',0);

	} else {

		$Cinsiyet = $Filter['cinsiyet'];

	}

	if (isset($Filter['subeler'])) {

		if(!in_array(72,$Filter['gorevler']) AND in_array(50,$Filter['gorevler'])){
			$Filter['gorevler'][] = 72;
		}

//
//		$sgklarSQL = $db->from('sgk')->in('sube',$Filter['subeler'])->all();
//
//		$SGK = [];
//
//		foreach ($sgklarSQL as $itemSGK){
//			$SGK[] = $itemSGK['id'];
//		}


		$Count = $db->from('kisiler')->in('il', $Filter['subeler'], '=', '||')->in('gorev', $Filter['gorevler'], '=', '||')->in('cinsiyet', $Cinsiyet, '=', '||')->all();

		$Count1 = $db->from('kisiler')->in('il', $Filter['subeler'], '=', '||')->in('temsilci', $Filter['gorevler'], '=', '||')->in('cinsiyet', $Cinsiyet, '=', '||')->all();

		$Count = array_merge($Count, $Count1);

		$Count = array_unique($Count, SORT_REGULAR);

	} elseif (isset($Filter['firmalar'])) {


		$CustomFilter = $Filter;

		if(!in_array(72,$Filter['gorevfirma']) AND in_array(50,$Filter['gorevfirma'])){
			$CustomFilter['gorevfirma'][] = 72;
		}




		$FirmaKisiler = $db->from('kisiler')
		                   ->in('sgk', $Filter['firmalar'], '=', '||')
		                   ->in('gorev', $CustomFilter['gorevfirma'], '=', '||')
		                   ->in('cinsiyet', $Cinsiyet, '=', '||')
		                   ->all();


		$Subeler = $db->from('sgk')
		              ->select('sube')
		              ->in('id', $Filter['firmalar'], '=', '||')
		              ->all();

		$Subeler1 = array();

		foreach ($Subeler as $item) {

			array_push($Subeler1, $item['sube']);

		}

		$SubeKisiler = $db->from('kisiler')
		                  ->where('gorev', 50, '!=')
		                  ->where('gorev', 72, '!=')
		                  ->in('sube', $Subeler1, '=', '||')
		                  ->in('gorev', $Filter['gorevfirma'], '=', '||')
		                  ->in('cinsiyet', $Cinsiyet, '=', '||')->all();

		$TümKisiler = array_merge($FirmaKisiler, $SubeKisiler);


		//ÜST YÖNETİM

		$SubeKisiler = $db->from('kisiler')
		                  ->where('gorev', 10, '<')
		                  ->in('gorev', $Filter['gorevfirma'], '=', '||')
		                  ->all();
		$TümKisiler = array_merge($TümKisiler, $SubeKisiler);


		//ÜST YÖNETİM

		$Count1 = $db->from('kisiler')->in('sgk', $Filter['firmalar'], '=', '||')
		             ->in('temsilci', $Filter['gorevfirma'], '=', '||')
		             ->in('cinsiyet', $Cinsiyet, '=', '||')->all();
		$Count = array_merge($TümKisiler, $Count1);
		$Count = array_unique($Count, SORT_REGULAR);



	}

	foreach ($FilterEK as $item){

		$FirmaKisiler = $db->from('kisiler')
		                   ->where('id', $item)
		                   ->first();
		if(!in_array($item,$Count) AND $FirmaKisiler){
			$Count[] = $FirmaKisiler;
		}
	}

	return $Count;

}


function kampanyameta($KampanyaID, $type)
{
	global $db;
	if ($type == 'count') {
		$KampanyaMeta = $db->from('kampanya')->where('id', $KampanyaID)->first();

		if ($KampanyaMeta['user'] != 0) {



			return count(smsmeta($KampanyaID));
		} else {

			return 0;

		}


	} elseif ($type == 'mesaj') {
		$KampanyaMeta = $db->from('kampanya')->where('id', $KampanyaID)->first();
		return $KampanyaMeta['mesaj'];

	} elseif ($type == 'senddate') {
		$KampanyaMeta = $db->from('kampanya')->where('id', $KampanyaID)->first();
		return $KampanyaMeta['senddate'];

	}elseif ($type == 'user') {
		$KampanyaMeta = $db->from('kampanya')->where('id', $KampanyaID)->first();
		return $KampanyaMeta['user'];

	}

}

function kampanyafilter($KampanyaID)
{


	global $db;
	$KampanyaMeta = $db->from('kampanya')->where('id', $KampanyaID)->first();
	return json_decode($KampanyaMeta['data'], true);


}


function kampanyadetay($ID)
{


	$Token = json_decode(loginmesajussu(), true);

	$Token = 'token:' . $Token['token'];

	$arraydata = array($Token, "Content-Type: application/json");
	$url = 'https://mesajussu.turkcell.com.tr/api/api/integration/v1/campaign/get/one/' . $ID;
	$make_call = callAPIGET('GET', $url, '0', $arraydata);
	$response = json_decode($make_call, true);
	return $response;
}
