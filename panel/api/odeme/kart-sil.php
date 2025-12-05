<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once '../api_include.php';

switch ($requestMethod) {
    case 'POST':


        $v = $_POST;


       $db->delete('kisiMeta')
           ->where('meta','utoken')
           ->where('kisi',$v['uyeID'])
           ->done();


       $db->update('talimat')
           ->where('user',$v['uyeID'])
           ->set([
               'status' => 0,
               'lastPayment' => date('Y-m-d H:i:s')
           ]);

        echo pageReturn(array('operation' => 'reload', 'data' => $v));


}