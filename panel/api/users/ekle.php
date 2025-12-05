<?php

require_once '../api_include.php';

switch ($requestMethod) {
    case 'POST':

        $v = $_POST;

        $pass = randomPassword();


        $db->insert('users')
            ->set([
                'username' => $v['email'],
                'email' => $v['email'],
                'password' => md5($pass),
                'passbase64' => base64_encode($pass),
                'type' => 'user',
                'create_date' => date('Y-m-d H:i:s'),
                'yetki' => json_encode([])
            ]);

        echo pageReturn( array(
            'operation' => 'redirect',
            'location'  => '?page=user/duzenle&id=' . $db->lastInsertId(),
            'sleep'     => '0',
            'data'      => $v
        ) );

}
