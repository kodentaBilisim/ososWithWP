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
    <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/style1.css">
    <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/font/stylesheet.css">


    <link rel="apple-touch-icon" sizes="152x152" href="/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/fav/favicon-16x16.png">
    <link rel="manifest" href="/fav/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">


	<?php


	if ( is_404() ) {

		echo '<meta property="og:image" content="https://www.tekgida.org.tr/wp-content/uploads/2021/02/resimyok.jpg" />
	<meta property="og:image:width" content="850" />
	<meta property="og:image:height" content="425" />
	<meta property="og:image:type" content="image/jpeg" />';

	}

	$sosyal = true;

	if ( is_front_page() ) {

		echo '<title>TEKGIDA-İŞ SENDİKASI / Emeğin Gücü - Emekçinin Evidir</title>';

	} else {
		echo '<title>';
		wp_title( '' );
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
                    <img src="<?php bloginfo( 'template_url' ); ?>/img/turkis.png" class="img-fluid">
                </a>

                <a target="_blank" href="http://www.iuf.org/">
                    <img src="<?php bloginfo( 'template_url' ); ?>/img/iuf.png" class="img-fluid">
                </a>

                <a target="_blank" href="http://www.effat.org/en">
                    <img src="<?php bloginfo( 'template_url' ); ?>/img/effat.png" class="img-fluid">
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
                    <a href="/"><img src="https://www.tekgida.org.tr/wp-content/uploads/2022/04/logo-7.png"
                                     class="img-fluid"></a>
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

							$args = array(
								'posts_per_page' => - 1,
								'post_status'    => 'publish',
								'post_type'      => 'isyeri',
								'orderby'        => 'date',
								'order'          => 'DESC'

							);


							$the_query = new WP_Query( $args );

							$i    = 0;
							$html = '';
							if ( $the_query->have_posts() ) {

								while ( $the_query->have_posts() ) {
									$the_query->the_post();

									if ( empty( get_the_post_thumbnail_url( $post->ID, 'full' ) ) ) {

										continue;

									}


									$html .= '<div class="post medium-post" style="float: left; padding-right: 15px; background-color: transparent;">';
									$html .= '<div class="entry-header">';
									$html .= '<div class="entry-thumbnail">';
									$html .= '<a href="http://' . get_field( 'url', $post->ID ) . '" target="_blank">';
									$html .= '<img class="img-responsive marqu" src="' . get_the_post_thumbnail_url( $post->ID, 'full' ) . '" alt="' . get_the_title() . '">';
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
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/turkis.png" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-md-5 col-3 mt-2">
                        <a target="_blank" href="http://www.iuf.org/">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/iuf.png" class="img-fluid">
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 offset-3">
                        <a target="_blank" href="http://www.effat.org/en">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/effat.png" class="img-fluid">
                        </a>
                    </div>
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
				$menu_name = 'menu-2';
				$locations = get_nav_menu_locations();
				$menu      = wp_get_nav_menu_object( $locations[ $menu_name ] );
				$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );


				function buildTree( array &$elements, $parentId = 0 ) {
					$branch = array();
					foreach ( $elements as &$element ) {
						if ( $element->menu_item_parent == $parentId ) {
							$children = buildTree( $elements, $element->ID );
							if ( $children ) {
								$element->children = $children;
							}

							$branch[ $element->ID ] = $element;
							unset( $element );
						}
					}

					return $branch;
				}

				$menu = buildTree( $menuitems, $parentId = 0 );

				?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav w-100 d-flex">

						<?php

						function child( $child, $id ) {
							echo '<ul class="submenu dropdown-menu" style="display:none" id="parent-' . $id . '">';
							foreach ( $child as $item ) {
								if ( isset( $item->children ) ) {
									$childsub = true;
								} else {
									$childsub = false;
								}
								echo '
<li class="nav-item submenu-li" data-id="' . $item->ID . '"><a class="dropdown-item" href="' . $item->url . '"> ' . $item->title . ' </a>
';
								if ( $childsub ) {
									child( $item->children, $item->ID );
								}
								echo '
</li>
';
							}
							echo '
</ul>
';
						}

						foreach (
							$menu

							as $item
						) {

							if ( $item->ID == 59111 ) {


								$childrensayi = count( $item->children );

								?>
                                <li class="nav-item dropdown has-megamenu">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Teşkilat
                                        Yapısı</a>
                                    <div class="dropdown-menu megamenu">
                                        <ul>
                                            <div class="row">

												<?php


												foreach ( $item->children as $childe ) { ?>


													<?php
													//var_dump($childe);
													$p     = 0;
													$l     = 0;
													$objle = count( $childe->children );

													if ( $childe->title == 'Şubeler' ) {

														?>
														<?php
														foreach ( $childe->children as $itemc ) {

															if ( $p == 0 ) { ?>

                                                                <div class="col-sm-3">

															<?php } ?>


                                                            <li>
                                                                <a href="<?= $itemc->url ?>"><?= $itemc->title ?></a>
                                                            </li>

															<?php
															$p ++;
															$l ++;

															if ( $p == 7 or $objle == $l ) {
																$p = 0;
																?>
                                                                </div>


																<?php

															}

														} ?>

													<?php } else { ?>
														<?php
														foreach ( $childe->children as $itemc ) {

															if ( $p == 0 ) { ?>

                                                                <div class="col-sm-3">

															<?php } ?>


                                                            <li>
                                                                <a href="https://www.tekgida.org.tr/iletisim/genel-merkez/"><?= $itemc->title ?></a>
                                                            </li>

															<?php
															$p ++;
															$l ++;

															if ( $objle == $l ) {
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

								if ( isset( $item->children ) ) {
									$child    = true;
									$li_class = 'class="nav-item dropdown ' . $megamenu . ' "';
									$a_class  = 'class="nav-link dropdown-toggle" data-toggle="dropdown"';
									$a_href   = '#';
								} else {
									$child    = false;
									$li_class = 'class="nav-item flex-fill"';
									$a_class  = 'class="nav-link"';
									$a_href   = $item->url;
								}

								echo '
		                    <li ' . $li_class . '>
		                    ';
								echo '
		                    <a ' . $a_class . ' href="' . $a_href . '">' . $item->title . '</a>
';

								if ( $child ) {

									echo '
<ul class="dropdown-menu">
';
									foreach ( $item->children as $child1 ) {
										if ( isset( $child1->children ) ) {
											$childsub = true;
											$ahref_1  = '#';
										} else {
											$childsub = false;
										}
										echo '
<li class="nav-item submenu-li" data-url="' . $child1->url . '" data-id="' . $child1->ID . '"><a class="dropdown-item submenu1" href="' . $child1->url . '"> ' . $child1->title . ' </a>
';

										if ( $childsub ) {
											child( $child1->children, $child1->ID );
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
    <div class="duyuru">
		<?php echo do_shortcode( '[hsas-shortcode group="" speed="11" direction="left" gap="50"]' ); ?>
    </div>
</header>
