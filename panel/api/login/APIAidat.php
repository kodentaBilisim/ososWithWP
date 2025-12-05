<?php

session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/panel/env.php';

require_once server_root_dir().'/config/db.php';

require_once server_root_dir().'/functions.php';

if ($_POST) {

    $veri = $_POST['query'];
    $tckno = $veri['tckno'];
    $tel = $veri['tel'];
    if(empty($tel) OR empty($tckno)){
        echo 0;
        exit;
    }


	$LoginCheck = $db->from('kisiler')
        ->where('tc',$tckno)
        ->where('telefon',$tel)
        ->where('durum',1)
        ->where('ek',0)
        ->first();

    if ($LoginCheck) {


            $_SESSION['UserID'] = $LoginCheck['id'];
            $_SESSION['UserType'] = 'uye';


        echo $_SESSION['UserID'];

    } else {

        echo 0;

    }

}
