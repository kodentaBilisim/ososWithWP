<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once '../api_include.php';

switch ($requestMethod) {
    case 'POST':


        $v = $_POST;

        $db->update('odemeler')
            ->where('referans',$v['referans'])
            ->set([
                'user' => $v['kisi']
            ]);


        echo pageReturn(array('operation' => 'reload', 'data' => $v));


}