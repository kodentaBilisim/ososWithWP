<?php /* Template Name: test */ ?>
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
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css?v=<?php echo rand(5, 5000); ?>">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/font/stylesheet.css">


    <link rel="apple-touch-icon" sizes="152x152" href="/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/fav/favicon-16x16.png">
    <link rel="manifest" href="/fav/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">


    <?php


    if (is_front_page()) {

        echo '<title>TEKGIDA-İŞ SENDİKASI / Emeğin Gücü - Emekçinin Evidir</title>';

    } else {
        echo '<title>';
        wp_title('');
        echo '</title>';
    }

    ?>

    <?php wp_head(); ?>
    <link rel="stylesheet" type="text/css"
          href="http://tekgida.org.tr/wp-content/plugins/lightbox-gallery/lightbox-gallery.css"/>
</head>

<body>
<header>
    <div class="container-fluid top-bar">

        <div class="row m-0 w-100">

            <div class="col-4 barlogo d-flex d-lg-none">

                <a target="_blank" href="http://www.turkis.org.tr/">
                    <img src="<?php bloginfo('template_url'); ?>/img/turkis.png" class="img-fluid">
                </a>

                <a target="_blank" href="http://www.iuf.org/">
                    <img src="<?php bloginfo('template_url'); ?>/img/iuf.png" class="img-fluid">
                </a>

                <a target="_blank" href="http://www.effat.org/en">
                    <img src="<?php bloginfo('template_url'); ?>/img/effat.png" class="img-fluid">
                </a>

            </div>


            <div class="text-center text-md-right col-lg-12 col-8 p-0">
                <div class="slogan">
                    Emeğin Gücü, Emekçinin Yanındayız...
                </div>
            </div>
        </div>
    </div>

    <div class="container top-bar-2">


        <div class="row my-4">

            <div class="col-4 col-lg-2 d-flex text-center justify-content-center align-items-center">
                <div class="logo">
                    <a href="/"><img src="http://tekgida.org.tr/wp-content/uploads/2020/12/logo.png" class="img-fluid"></a>
                </div>
            </div>
            <div class="col-8 d-block d-lg-none text-center justify-content-center align-items-center">
                <span class="site-title" style="font-size:30px">TEKGIDA-İŞ SENDİKASI</span>
            </div>
            <div class="col-12 col-lg-7 mt-2">
                <div class="row d-none d-lg-flex">
                    <div class="col-12 d-flex justify-content-center">
                        <span class="site-title">TEKGIDA-İŞ SENDİKASI</span>
                    </div>
                </div>
                <div class="row">
                    <div id="latest-news1" style="width: 100%; overflow: hidden;" class="mh">
                        <div style="width: 100000px; margin-left: 0px; animation: 63.0833s linear 0s infinite normal none running marqueeAnimation-69281370;"
                             class="js-marquee-wrapper">


                            <?php

                            $args = array('posts_per_page' => -1, 'post_status' => 'publish', 'post_type' => 'isyeri', 'orderby' => 'date', 'order' => 'DESC'

                            );


                            $the_query = new WP_Query($args);

                            $i = 0;
                            $html = '';
                            if ($the_query->have_posts()) {

                                while ($the_query->have_posts()) {
                                    $the_query->the_post();

                                    if (empty(get_the_post_thumbnail_url($post->ID, 'full'))) {

                                        continue;

                                    }


                                    $html .= '<div class="post medium-post" style="float: left; padding-right: 15px; background-color: transparent;">';
                                    $html .= '<div class="entry-header">';
                                    $html .= '<div class="entry-thumbnail">';
                                    $html .= '<a href="http://' . get_field('url', $post->ID) . '" target="_blank">';
                                    $html .= '<img class="img-responsive marqu" src="' . get_the_post_thumbnail_url($post->ID, 'full') . '" alt="' . get_the_title() . '">';
                                    $html .= '</a>';
                                    $html .= '</div>';
                                    $html .= '</div>';
                                    $html .= '</div>';


                                }

                            }


                            wp_reset_postdata();

                            ?>


                            <div class="js-marquee" style="margin-right: 20px; float: left;">

                                <?php echo $html; ?>


                            </div>
                            <div class="js-marquee" style="margin-right: 20px; float: left;">

                                <?php echo $html; ?>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-2 offset-md-1 p-0 d-none d-lg-block">


                <div class="row">

                    <div class="col-md-5 offset-md-1 col-3 mt-2">
                        <a target="_blank" href="http://www.turkis.org.tr/">
                            <img src="<?php bloginfo('template_url'); ?>/img/turkis.png" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-md-5 col-3 mt-2">
                        <a target="_blank" href="http://www.iuf.org/">
                            <img src="<?php bloginfo('template_url'); ?>/img/iuf.png" class="img-fluid">
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 offset-3">
                        <a target="_blank" href="http://www.effat.org/en">
                            <img src="<?php bloginfo('template_url'); ?>/img/effat.png" class="img-fluid">
                        </a>
                    </div>
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
                $menu_name = 'menu-1';
                $locations = get_nav_menu_locations();
                $menu = wp_get_nav_menu_object($locations[$menu_name]);
                $menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));
                ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav w-100 d-flex">
                        <?php

                        foreach ($menuitems

                        as $item){

                        $link = $item->url;
                        $title = $item->title;

                        if (!$item->menu_item_parent){


                        if ($sub == 1){ ?>
                    </ul>
                    </li>
                    <?php }

                    $sub = 0;

                    if ($item->ID == 52741 or $item->ID == 52791 or $item->ID == 52749){
                    ?>

                    <li class="nav-item   flex-fill">
                        <a class="nav-link" href="#" data-toggle="dropdown">

                            <?php echo $title; ?>
                        </a>
                        <?php
                        }elseif ($item->ID == 52794){
                        $mega = 1;
                        ?>
                    <li class="nav-item dropdown has-megamenu">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"><?php echo $title; ?></a>
                        <div class="dropdown-menu megamenu">
                            <div class="row">
                                <?php

                                $row = 0;

                                }else{

                                if ($item->ID == 52796) {
                                    echo '</div>
									</div>';
                                }

                                ?>


                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown">

                            <?php echo $title; ?>
                        </a>
                        <?php

                        }

                        ?>

                        <?php }else{

                        $title = mb_strtoupper_tr($item->title);

                        ?>

                        <?php if ($item->menu_item_parent == 52794){


                            ?>


                            <?php

                            if ($row == 0) {

                                echo '<div class="col-sm-3"><ul>';
                                echo '<li><a href="' . $link . '">' . $title . '</a></li>';
                                $row++;

                            } elseif ($row == 6 and $temsil == 0) {

                                echo '<li><a href="' . $link . '">' . $title . '</a></li>
											</ul>
										</div>';
                                $row = 0;

                            } else {

                                if ($item->ID == 52775) {
                                    $temsil = 1;
                                    echo '</ul></div>';
                                    echo '<div class="col-sm-3"><ul>';
                                    echo '<li><a href="' . $link . '">' . $title . '</a></li>';
                                    $row++;

                                } else {


                                    echo '<li><a href="' . $link . '">' . $title . '</a></li>';
                                    $row++;
                                }
                            }

                            ?>


                            <?php

                        }else{ ?>

                        <?php if ($sub == 0){
                        $sub = 1; ?>
                        <ul class="dropdown-menu">
                            <?php } ?>

                            <li><a class="dropdown-item"
                                   href="<?php echo $link ?>"><?php echo $title; ?></a></li>


                            <?php

                            }
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
    <div class="duyuru">
        <?php echo do_shortcode('[hsas-shortcode group="" speed="11" direction="left" gap="50"]'); ?>
    </div>
</header>
<section id="content">

    <div class="container content">

        <h2><?php the_title(); ?></h2>
        <?php


        $like = get_post_meta($post->ID,'like');

        ?>

        <button id="likebutton1" class="btn btn-primary" onclick="like(<?php echo $post->ID; ?>)" ><i id="likeicon" class="fas fa-thumbs-up"></i> BEĞEN <span id="likebutton"><?php echo $like[0]; ?></span></button>


    </div>
    </section>
<footer>

    <div class="footer-top">
        <div class="container">

            <div class="row">
                <div class="col-md-4 col-12">

                    <h4>Hakkımızda</h4>
                    <p>Türkiye işçi hareketinin önemli bir parçasını oluşturan Tekgıda-İş Sendikası 13 Nisan 1952
                        yılında 9 sendikanın bir araya gelerek federasyon oluşturması ile kurulmuştur.
                        Tekgıda-İş Sendikası kimliğini ve gücünü XIX. yüzyılın ikinci yarısından itibaren örgütlenme
                        sürecine giren tütün ve gıda işçilerinin mücadeleci geleneğinden almaktadır.</p>

                </div>
                <div class="col-md-4 col-12">
                    <h4>Amaç ve Hedefler</h4>
                    <p>Türkiye işçi hareketinin önemli bir parçasını oluşturan Tekgıda-İş Sendikası 13 Nisan 1952
                        yılında 9 sendikanın bir araya gelerek federasyon oluşturması ile kurulmuştur.
                        Tekgıda-İş Sendikası kimliğini ve gücünü XIX. yüzyılın ikinci yarısından itibaren örgütlenme
                        sürecine giren tütün ve gıda işçilerinin mücadeleci geleneğinden almaktadır.</p>

                </div>
                <div class="col-md-4 col-12">

                    <h4>Adres Bilgilerimiz
                    </h4>
                    <p>Tekgıda-İş Sendikası Genel Merkezi</p>

                    <p><?php echo get_field('adres', 3276); ?></p>

                    <p>Telefon : <?php echo get_field('telefon', 3276); ?> </p>

                    <p>Faks : <?php echo get_field('faks', 3276); ?></p>

                    <p><?php echo get_field('e-posta', 3276); ?></p>

                </div>
            </div>
        </div>


    </div>
    <div class="footerlogo">

        <img src="http://tekgida.org.tr/wp-content/uploads/2020/12/logo.png">

    </div>
    <div class="footer-bottom">

        <div class="container">

            <div class="row">
                <div class="col-md-3 col-12 text-center text-md-left">

                    <h4>HAKKIMIZDA</h4>
                    <?php wp_nav_menu(array('theme_location' => 'footer-1')); ?>
                </div>
                <div class="col-md-3 col-12 text-center text-md-left">

                    <h4>FAALİYETLER</h4>
                    <?php wp_nav_menu(array('theme_location' => 'footer-2')); ?>
                </div>
                <div class="col-md-3 col-12 text-center text-md-left">

                    <h4>BİLDİRİ VE HABERLER</h4>
                    <?php wp_nav_menu(array('theme_location' => 'footer-3')); ?>
                </div>
                <div class="col-md-3 col-12 text-center text-md-left" style="align-items: center; display: grid;">

                    <h4>BİZE ULAŞIN</h4>
                    <p>Görüşleriniz bizim için önemlidir</p>
                    <a type="button" class="btn btn-footer" href="/iletisim#formgonder">HEMEN GÖNDER</a>
                    <ul class="footer-social mt-1">
                        <li><a href="https://www.facebook.com/tekgida"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://twitter.com/tekgida"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="http://instagram.com/tekgidais"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="https://www.youtube.com/channel/UC7mb8F2I5Qacri_uev1Ajbg"><i
                                        class="fab fa-youtube"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/tekg%C4%B1da-i%C5%9F-sendikas%C4%B1/"><i
                                        class="fab fa-linkedin"></i></a></li>

                    </ul>
                </div>
            </div>
        </div>


    </div>
    <div class="footer-copyright">

        <p>Tekgıda-İş Sendikası © 2020</p>

    </div>
</footer>
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script>

    function modalopen(id) {


        $('#myModal-' + id).modal('show');


    }

    function modalclose(id) {

        $('#myModal-' + id).modal('hide');

        $('.youtube-iframe').each(function (index) {
            $(this).attr('src', $(this).attr('src'));

        });
    }


</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<!-- Global site tag (gtag.js) - Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-93666244-1"></script>

<script>

    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());


    gtag('config', 'UA-93666244-1');

</script>

<!--

	<?php wp_nav_menu(array('theme_location' => 'footer-1')); ?>

	-->


<script>


    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for(let i = 0; i <ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    $( document ).ready(function() {

        let like = getCookie("<?php echo $post->ID; ?>");

        if(like == 1){

            document.getElementById("likeicon").classList.add('fa-check');
            document.getElementById("likeicon").classList.remove('fa-thumbs-up');
            document.getElementById("likebutton1").classList.add('liked');
            document.getElementById("likebutton1").disabled = true;

        }



    });

    async function like(POSTID) {

        await jQuery.ajax({
            type: "post",
            dataType: "json",
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            data: {
                action: 'like',
                text: POSTID,
            },
            success: function (msg) {

                console.log(msg.like)
                document.getElementById("likebutton").innerHTML = msg.like;
                document.getElementById("likeicon").classList.add('fa-check');
                document.getElementById("likeicon").classList.remove('fa-thumbs-up');
                document.getElementById("likebutton1").classList.add('liked');
                document.getElementById("likebutton1").disabled = true;
                document.cookie = POSTID+"=1";


            }
        });

    }


</script>

<?php echo wp_footer(); ?>
<script type='text/javascript'
        src='http://tekgida.org.tr/wp-content/plugins/lightbox-gallery/js/jquery.colorbox.js?ver=5.6'
        id='colorbox-js'></script>
<script type='text/javascript'
        src='http://tekgida.org.tr/wp-content/plugins/lightbox-gallery/js/jquery.tooltip.js?ver=5.6'
        id='tooltip-js'></script>
<script type='text/javascript'
        src='http://tekgida.org.tr/wp-content/plugins/lightbox-gallery/lightbox-gallery.js?ver=5.6'
        id='lightbox-gallery-js'></script>
</body>
</html>


