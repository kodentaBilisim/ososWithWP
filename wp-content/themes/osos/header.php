<!doctype html>
<html lang="tr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css?v=<?=rand(9999,9999999)?>">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/font/stylesheet.css?v=<?=rand(9999,9999999)?>">
    <title><?php wp_title('-', true, 'right'); ?><?php bloginfo('name'); ?></title>


    <link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_url'); ?>/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_url'); ?>/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_url'); ?>/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php bloginfo('template_url'); ?>/favicon/site.webmanifest">
    <link rel="mask-icon" href="<?php bloginfo('template_url'); ?>/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">


    <?php wp_head(); ?>
    <link rel="stylesheet" type="text/css"
          href="/wp-content/plugins/lightbox-gallery/lightbox-gallery.css"/>
</head>

<body>
<header>
    <div class="container-fluid top-bar">
        <div class="row m-0 w-100">
            <div class="d-flex justify-content-center justify-content-md-end  text-center text-md-right col-lg-12 col-12 p-0">
                <div class="slogan">
                    ÖĞRETMEN SENDİKASI İLE GÜÇLÜ!
                </div>
            </div>
        </div>
    </div>

    <div class="container top-bar-2">

        <div class="row my-4">
            <div class="col-4 col-lg-2 d-flex text-center justify-content-center align-items-center">
                <div class="logo">
                    <a href="/">
                        <img src="/wp-content/uploads/2024/03/osos_logo.png"
                                class="img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-8 d-flex  text-center justify-content-center align-items-center">
                <span class="site-title" style="font-size:30px">ÖZEL SEKTÖR ÖĞRETMENLERİ SENDİKASI</span>
            </div>
        </div>
    </div>
    </div>
    <div class="container-fluid degrade topborder">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <?php
                $menu_name = 'menu-2';
                $locations = get_nav_menu_locations();
                $menu = wp_get_nav_menu_object($locations[$menu_name]);
                $menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));


                $menu = buildTree($menuitems, $parentId = 0);

                ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav w-100 d-flex">

                        <?php

                        function child($child, $id)
                        {
                            echo '<ul class="submenu dropdown-menu" style="display:none" id="parent-' . $id . '">';
                            foreach ($child as $item) {
                                if (isset($item->children)) {
                                    $childsub = true;
                                } else {
                                    $childsub = false;
                                }
                                echo '
<li class="nav-item submenu-li" data-id="' . $item->ID . '"><a class="dropdown-item" href="' . $item->url . '"> ' . $item->title . ' </a>
';
                                if ($childsub) {
                                    child($item->children, $item->ID);
                                }
                                echo '
</li>
';
                            }
                            echo '
</ul>
';
                        }

                        foreach ($menu

                                 as $item) {

                            if ($item->ID == 59111) {


                                $childrensayi = count($item->children);

                                ?>
                                <li class="nav-item dropdown has-megamenu">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Teşkilat
                                        Yapısı</a>
                                    <div class="dropdown-menu megamenu">
                                        <ul>
                                            <div class="row">

                                                <?php


                                                foreach ($item->children as $childe) { ?>


                                                    <?php
                                                    //var_dump($childe);
                                                    $p = 0;
                                                    $l = 0;
                                                    $objle = count($childe->children);

                                                    if ($childe->title == 'Şubeler') {

                                                        ?>
                                                        <?php
                                                        foreach ($childe->children as $itemc) {

                                                            if ($p == 0) { ?>

                                                                <div class="col-sm-3">

                                                            <?php } ?>


                                                            <li>
                                                                <a href="<?= $itemc->url ?>"><?= case_converter($itemc->title, 'u') ?></a>
                                                            </li>

                                                            <?php
                                                            $p++;
                                                            $l++;

                                                            if ($p == 7 or $objle == $l) {
                                                                $p = 0;
                                                                ?>
                                                                </div>


                                                                <?php

                                                            }

                                                        } ?>

                                                    <?php } else { ?>
                                                        <?php
                                                        foreach ($childe->children as $itemc) {

                                                            if ($p == 0) { ?>

                                                                <div class="col-sm-3">

                                                            <?php } ?>


                                                            <li>
                                                                <a href="<?= $itemc->url ?>"><?= case_converter($itemc->title, 'u') ?></a>
                                                            </li>

                                                            <?php
                                                            $p++;
                                                            $l++;

                                                            if ($objle == $l) {
                                                                $p = 0;
                                                                ?>
                                                                </div>


                                                                <?php

                                                            }

                                                        } ?>
                                                    <?php } ?>
                                                <?php } ?>


                                            </div>
                                        </ul>
                                    </div>
                                </li>


                                <?php

                            } else {
                                $megamenu = '';

                                if (isset($item->children)) {
                                    $child = true;
                                    $li_class = 'class="nav-item dropdown ' . $megamenu . ' "';
                                    $a_class = 'class="nav-link dropdown-toggle" data-toggle="dropdown"';
                                    $a_href = '#';
                                } else {
                                    $child = false;
                                    $li_class = 'class="nav-item flex-fill"';
                                    $a_class = 'class="nav-link"';
                                    $a_href = $item->url;
                                }

                                echo '
		                    <li ' . $li_class . '>
		                    ';
                                echo '
		                    <a ' . $a_class . ' href="' . $a_href . '">' . $item->title . '</a>
';

                                if ($child) {

                                    echo '
<ul class="dropdown-menu">
';
                                    foreach ($item->children as $child1) {
                                        if (isset($child1->children)) {
                                            $childsub = true;
                                            $ahref_1 = '#';
                                        } else {
                                            $childsub = false;
                                        }
                                        echo '
<li class="nav-item submenu-li" data-url="' . $child1->url . '" data-id="' . $child1->ID . '"><a class="dropdown-item submenu1" href="' . $child1->url . '"> ' . case_converter($child1->title, 'u') . ' </a>
';

                                        if ($childsub) {
                                            child($child1->children, $child1->ID);
                                        }

                                        echo '
</li>
';
                                    }

                                    echo '
</ul>
';
                                }

                                echo '
</li>
';

                            }
                        }

                        ?>
                        <li class="nav-item dropdown has-megamenu">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> Arama </a>
                            <div class="dropdown-menu megamenu">

                                <!-- Search form -->
                                <form id="searchform" method="get" action="/"
                                      class="form-inline d-flex justify-content-center md-form form-sm mt-0">
                                    <i class="fas fa-search" aria-hidden="true"></i>
                                    <input class="form-control form-control-sm ml-3 w-75" type="text" name="s"
                                           placeholder="Arama"
                                           aria-label="Search">
                                </form>

                            </div> <!-- dropdown-mega-menu.// -->
                        </li>
                    </ul>

                </div>
            </nav>

        </div>
    </div>
</header>
