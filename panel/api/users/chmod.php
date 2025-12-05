<?php

require_once '../api_include.php';

switch ($requestMethod) {
    case 'POST':

        $v = $_POST;
        $yetki = [];

        foreach ($v as $key => $value) {
            $ill = explode('_', $key);

            if ($ill[0] == 'il' and $value == 'on') {
                $yetki[] = $ill[1];
            }

        }

        $db->update('users')->where('id', $v['userID'])
            ->set([
                'yetki' => json_encode($yetki)
            ]);


        echo pageReturn(array('operation' => 'reload', 'data' => $v));


}
