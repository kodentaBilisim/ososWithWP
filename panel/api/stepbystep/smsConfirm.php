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
            $uyeTalimat = uyeTalimat($_SESSION['UserID']);
            $uyeTalimatData = json_decode($uyeTalimat['data'], true);

            $uyeTalimatData['sms'][] = json_decode($smsCode['value'], true);

            $db->update('talimat')
                ->where('id', $uyeTalimat['id'])
                ->set([
                    'data' => json_encode($uyeTalimatData)
                ]);

            echo pageReturn(array('operation' => 'redirect', 'location' => '/panel/?page=step-by-step&step=kart-bilgileri', 'data' => $v));

        }else{
            echo pageReturn(array('operation' => 'none', "hata"=>"GÜVENLİK KODU HATALI!", 'data' => $v));

        }



}