<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once '../api_include.php';

switch ($requestMethod) {
    case 'POST':


        $v = $_POST;

        $smsCode = $db->from('kisiMeta')
            ->where('kisi', $_SESSION['UserID'])
            ->where('meta', 'smsConfirm')
            ->first();


        if (json_decode($smsCode['value'], true)['smsCode'] == $v['smsConfirmCode']) {

            $db->update('talimat')->where('user', $_SESSION['UserID'])->set([
                'status' => 1
            ]);


            echo pageReturn(array('operation' => 'redirect', 'location' => '/panel', 'data' => $v));

        }else{
            echo pageReturn(array('operation' => 'none', "hata"=>"GÜVENLİK KODU HATALI!", 'data' => $v));

        }



}