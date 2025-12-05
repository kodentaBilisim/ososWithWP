<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once '../api_include.php';

switch ($requestMethod) {
    case 'POST':


        $v = $_POST;

        if (empty($v['amount']) or $v['amount'] < 1) {
            echo pageReturn(array('operation' => 'none', 'hata' => 'TUTAR BOŞ VEYA SIFIR OLAMAZ', 'data' => $v));

        } else {


            $v['date'] = time();
            $v['ip'] = userIP();


            $talimatCheck = $db->from('talimat')
                ->where('user', $v['uyeID'])
                ->first();


            $v['sms'] = false;


            if ($talimatCheck) {


                $db->update('talimat')->where('id', $talimatCheck['id'])->set([
                    'gun' => $v['day'],
                    'data' => json_encode($v),
                    'status' => 0
                ]);


            } else {
                $db->insert('talimat')
                    ->set([
                        'gun' => $v['day'],
                        'data' => json_encode($v),
                        'user' => $v['uyeID'],
                        'status' => 0,
                        'lastPayment' => date('Y-m-d H:i:s')
                    ]);
            }


            echo pageReturn(array('operation' => 'redirect', 'location' => '/panel/?page=step-by-step&step=smsConfirm', 'data' => $v));

        }
}