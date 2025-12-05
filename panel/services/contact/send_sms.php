<?php

// Kullanıcı bilgilerini sms ayar

require_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';

if(isset($_GET['Firma']) AND !isset($_GET['User'])){

    $FirmaID = $_GET['Firma'];
    $Config = smsconfig();


    $xml = $Config['header'];

    $filter = array(
        'status' => $_GET['status'],
        'ders' => $_GET['ders']
    );

    if($filter['ders'] != NULL){

        $Personeller = PersonelFilterSMS($filter,$FirmaID);

    }else{


        $Personeller = Tum_personel($FirmaID);

    }


    $i = 0;
    foreach ($Personeller as $personel){


		if(empty($personel['telefon'])){
			continue;
		}
        $xml .= '
<mp><msg><![CDATA[Sayın '. $personel['name'] .', '. smscontent($FirmaID) .'  Kullanıcı Adınız: '.$personel['username'].' Şifreniz: '. base64_decode($personel['passbase64']) .' - LİNK: '.my_server_url().']]></msg><no>'.$personel['telefon'].'</no></mp>';
        $db->update('personel')
            ->where('id',$personel['id'])
            ->set([
                'sms_status' => 1
            ]);
    }


    $xml .= $Config['footer'];
    $Result = XMLPOST($Config['url'], $xml);

    smskotaupdate($FirmaID, count($Personeller));

   echo $Result;

}if(isset($_GET['User']) AND !isset($_GET['Firma'])){

    $Personel = PersonelMeta($_GET['User']);
    $Config = smsconfig();
    $xml = $Config['header'];

    $xml .= '
<mp><msg><![CDATA[Sayın '. $Personel['name'] .', '.smscontent($Personel['firma']).'  Kullanıcı Adınız: '.$Personel['username'].' Şifreniz: '. base64_decode($Personel['passbase64']) .' - Link: '.my_server_url().'  ]]></msg><no>'.$Personel['telefon'].'</no></mp>
';

    $db->update('personel')
        ->where('id',$_GET['User'])
        ->set([
            'sms_status' => 1
        ]);

    $xml .= $Config['footer'];
    $Result = XMLPOST($Config['url'], $xml);
    $kota = smskotaupdate($Personel['firma'], 1);
    $array = array('result'=>$Result,'kota'=>$kota);

    echo json_encode($array);

}

