<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once '../api_include.php';

switch ($requestMethod) {
    case 'POST':





        $db->update('talimat')
            ->where('user',$_SESSION['UserID'])
            ->set([
                'status' => 0,
                'lastPayment' => date('Y-m-d H:i:s')
            ]);



        echo pageReturn(array('operation' => 'redirect', 'location' => '/panel', 'data' => $v));




}