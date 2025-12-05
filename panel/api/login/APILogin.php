<?php

session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/panel/env.php';

require_once server_root_dir().'/config/db.php';

require_once server_root_dir().'/functions.php';

if ($_POST) {

    $veri = $_POST['query'];
    $usercode = $veri['usercode'];
    $password = md5($veri['password']);
    $usercode = trim($usercode);

	$LoginCheck = $db->from('users')
        ->where('username',$usercode)
        ->where('password',$password)
        ->all();

    if (count($LoginCheck) > 0) {

        foreach ($LoginCheck as $item) {
            $_SESSION['UserID'] = $item['id'];
            $_SESSION['UserType'] = $item['type'];
            $_SESSION['yetki'] = $item['yetki'];
        }

        echo $_SESSION['UserID'];

    } else {

        echo 0;

    }

}
