<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once '../api_include.php';

switch ($requestMethod) {
    case 'POST':


        $v = $_POST;
        srand(time());
        $cartID = rand();


        $data = [
            'sepet' => [
                ["Öğretmen Sendikası Aidat", $v['tutar'], 1]
            ]
        ];


        $db->insert('cart')
            ->set([
                'user' => $v['uyeID'],
                'data' => json_encode($data),
                'response' => json_encode([]),
                'date' => date('Y-m-d H:i:s'),
                'tutar' => $v['tutar'],
                'referans' => $cartID
            ]);


        echo pageReturn(array('operation' => 'redirect', 'location'=>'?page=kart-ile-odeme&cartid='.$cartID, 'data' => $v));


}