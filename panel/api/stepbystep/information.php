<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once '../api_include.php';

switch ($requestMethod) {
    case 'POST':


        $v = $_POST;
        $v['date'] = time();
        $v['ip'] = userIP();

        $db->insert('kisiMeta')
            ->set([
                'meta' => 'stepInformation',
                'kisi' => $v['uyeID'],
                'rand' => 0,
                'value' => json_encode([
                    'IP' => $v['ip'],
                    'date' => time()
                ])
            ]);



        echo pageReturn(array('operation' => 'redirect', 'location' => '/panel/?page=step-by-step&step=aidat-bilgileri', 'data' => $v));


}