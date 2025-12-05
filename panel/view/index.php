<?php

include 'sidebar_data.php';
include 'header.php';

if (!$_GET['page']) {
    include server_root_dir() . '/view/pages/' . $_SESSION['UserType'] . '/home.php';
} else {

    $pageName = $_GET['page'];


    $file = server_root_dir() . '/view/pages/' . $_SESSION['UserType'] . '/' . $pageName . '.php';

    if (!file_exists($file)) {

        if ($_SESSION['UserType'] == 'admin') {
            $fileCommon = server_root_dir() . '/view/pages/common/' . $pageName . '.php';

            if (!file_exists($fileCommon)) {

                include server_root_dir() . '/view/404.php';
            } else {
                include $fileCommon;
            }
        } else {

            include server_root_dir() . '/view/404.php';
        }


    } else {
        include $file;
    }
}


include 'footer.php';
