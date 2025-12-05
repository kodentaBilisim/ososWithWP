<?php

require_once '../api_include.php';

switch ($requestMethod) {
    case 'POST':

        $v = $_POST;


        $uyeMeta = uyeMeta($v['uyeID']);

        if (isset($uyeMeta['adresEx'])) {
            $db->update('kisiMeta')
                ->where('kisi', $v['uyeID'])
                ->where('meta', 'adresEx')
                ->set([
                    'value' => $v['adresEx']
                ]);
        } else {
            $db->insert('kisiMeta')
                ->set([
                    'value' => $v['adresEx'],
                    'kisi' => $v['uyeID'],
                    'meta' => 'adresEx',
                    'rand' => 0
                ]);
        }


        $db->update('kisiler')
            ->where('id', $v['uyeID'])
            ->set([
                'ePosta' => $v['ePosta']
            ]);


        echo pageReturn(array(
            'operation' => 'reload'
        ));

}
