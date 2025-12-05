<?php get_header(); ?>
<section id="manset" class="my-3">
    <div class="container">
        <div class="row">

            <div class="col-md-9 col-12">
                <div class="mansetgradient"></div>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators mb-0">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="7"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="8"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="9"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="10"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="11"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="12"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="13"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="14"></li>
                    </ol>
                    <div class="carousel-inner">

						<?php

						$args = array(
							'posts_per_page' => 16,
							'post_status'    => 'publish',
							'orderby'        => 'date',
							'order'          => 'DESC',
							'category_name'  => 'manset',
						);


						$the_query = new WP_Query( $args );

						$i = 0;
						$k = 0;
						if ( $the_query->have_posts() ) {

							while ( $the_query->have_posts() ) {
								$the_query->the_post();

								if ( $i < 15 ) {
									update_field( 'manset', '1', $post->ID );
									?>

                                    <div class="carousel-item <?php if ( $k == 0 ) {
										echo 'active';
									}
									$k ++; ?>">
                                        <a href="<?php the_permalink(); ?>"
                                           style="text-decoration: none; color: inherit;">
                                            <img class="d-block w-100 mansetimg"
                                                 src="<?php echo gorsel( $post->ID ); ?>" alt="<?php the_title(); ?>">
                                        </a>
                                        <div class="kaynak-img">
                                            <img src="<?php echo get_field( 'gorsel_ustu_kaynak' ); ?>">
                                        </div>
                                        <div class="carousel-caption justify-content-center align-items-end d-none d-md-flex">
                                            <a href="<?php the_permalink(); ?>"
                                               style="text-decoration: none; color: inherit;">
                                                <h2><?php the_title(); ?></h2>
                                            </a>
                                        </div>
                                        <div class="carousel-caption justify-content-center align-items-end d-md-none d-flex mobilcap">
                                            <a href="<?php the_permalink(); ?>"
                                               style="text-decoration: none; color: inherit;">
                                                <h2><?php the_title(); ?></h2>
                                            </a>
                                        </div>
                                    </div>
									<?php
									$i ++;


								} else {

									update_field( 'manset', '0', $post->ID );


								}


							}


						}

						?>

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>


            </div>
            <div class="col-md-3 col-12">

                <div class="socialmedia mt-1 mt-md-0">
                    <ul class="labels">
                        <li><a href="https://www.facebook.com/tekgida" target="_blank"><img
                                        src="<?php bloginfo( 'template_url' ); ?>/img/facebook.png"></a></li>
                        <li><a href="https://twitter.com/tekgida" target="_blank"><img
                                        src="<?php bloginfo( 'template_url' ); ?>/img/twitter.png"></a></li>
                        <li><a href="http://instagram.com/tekgidais" target="_blank"><img
                                        src="<?php bloginfo( 'template_url' ); ?>/img/instagram.png"></a></li>
                        <li><a href="https://www.youtube.com/channel/UC7mb8F2I5Qacri_uev1Ajbg" target="_blank"><img
                                        src="<?php bloginfo( 'template_url' ); ?>/img/youtube.png"></a></li>
                        <li><a href="https://www.linkedin.com/company/tekg%C4%B1da-i%C5%9F-sendikas%C4%B1/"
                               target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/img/linkedin.png"></a>
                        </li>

                    </ul>
                </div>
                <div class="baskandan">
                    <div class="baskandan-content">
                        <div style="width: 100%;"><a href="https://www.tekgida.org.tr/genel-baskanimizin-sendikamizin-70-kurulus-yili-mesaji-2-59473/"
                                                     style="text-decoration: none; color: inherit;">
                            <img src="https://www.tekgida.org.tr/wp-content/uploads/2022/04/baskan.jpg" class="img-fluid">
                            </a>
                        </div>
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

                            <div class="carousel-inner">



                                <div class="carousel-item active">
                                    <div class="carousel-caption">
                                        <a href="https://www.tekgida.org.tr/genel-baskanimizin-sendikamizin-70-kurulus-yili-mesaji-2-59473/"
                                           style="text-decoration: none; color: inherit;">
                                            <h5 class="text-title mt-2" style="display: flex;
align-items: center;
justify-content: center;
font-family: Montserrat Medium;
font-size: 18px;">
                                                GENEL BAŞKANIMIZIN SENDİKAMIZIN 70. KURULUŞ YILI MESAJI
                                            </h5>
                                        </a>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-12">

                <div class="widget">
                    <div class="widget-title degrade"><a href="category/bildiri-ve-haberler/tis-haberleri"
                                                         style="text-decoration: none; color: inherit;">
                            TİS HABERLERİ
                        </a>
                    </div>
                    <div class="widget-content">

						<?php

						$args = array(
							'posts_per_page' => 20,
							'post_status'    => 'publish',
							'orderby'        => 'date',
							'order'          => 'DESC',
							'category_name'  => 'tis-haberleri',


						);


						$the_query = new WP_Query( $args );


						$g = 1;
						if ( $the_query->have_posts() ) {

							while ( $the_query->have_posts() ) {


								$the_query->the_post();


								$title = get_the_title();
								if ( has_excerpt() ) {
									$excerpt = get_the_excerpt();
								} else {
									$excerpt = '';
								}

								$url       = get_the_permalink();
								$authorid  = get_the_author_meta( 'ID' );
								$authorurl = get_the_author_meta( 'nickname', $authorid );

								if ( $g == 1 ) {


									$post1 = '<div class="col-12 col-md-8">

										<div class="widget-items">
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<img src="' . get_the_post_thumbnail_url( $post->ID ) . '" class="img-fluid">
										<h3>' . $title . '</h3>
										</a>
										<div class="col-12 p-0 m-0 spot">
										<p style="min-height: 67px;">' . $excerpt . '</p>

										</div>
										</div>

										</div>';


									$g ++;
								} elseif ( $g == 2 ) {


									$post2 = '<div class="widget-items mb-1">
										<div class="row p-0 m-0">


										<div class="col-12 p-0 m-0  d-flex justify-content-center align-items-center">
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">

										<img src="' . get_the_post_thumbnail_url( $post->ID ) . '" class="img-fluid">

										</a>
										</div>
										</div>
										<div class="row p-0 m-0  d-flex justify-content-center align-items-center">

										<div class="col-12 p-0 m-0 spot">

										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<h6>' . $title . '</h6>
										</a>


										</div>
										</div>

										</div>';


									$g ++;
								} elseif ( $g == 3 ) {


									$post3 = '<div class="widget-items mb-1">
										<div class="row p-0 m-0">


										<div class="col-12 p-0 m-0  d-flex justify-content-center align-items-center">
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<img src="' . get_the_post_thumbnail_url( $post->ID ) . '" class="img-fluid">
										</a>
										</div>
										</div>
										<div class="row p-0 m-0  d-flex justify-content-center align-items-center">

										<div class="col-12 p-0 m-0 spot">

										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<h6>' . $title . '</h6>
										</a>


										</div>
										</div>

										</div>';

									$g ++;
								} elseif ( $g == 4 ) {


									$post4 = '<div class="col-12 col-md-4">
										<div class="widget-items mb-1">
										<div class="row p-0 m-0">
										<div class="col-12 p-0 m-0  d-flex justify-content-center align-items-center">
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<img src="' . get_the_post_thumbnail_url( $post->ID ) . '" class="img-fluid">
										</a>
										</div>
										<div class="col-12 p-0 m-0 d-flex justify-content-center align-items-center">
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<h6>' . $title . '</h6>
										</a>
										</div>

										</div>
										<div class="row p-0 m-0  d-flex justify-content-center align-items-center">
										<div class="col-12 p-0 m-0 spot">
										<p>' . $excerpt . '</p>
										</div>
										</div>

										</div>
										</div>';

									$g ++;
								} elseif ( $g == 5 ) {


									$post5 = '<div class="col-12 col-md-4">
										<div class="widget-items mb-1">
										<div class="row p-0 m-0">
										<div class="col-12 p-0 m-0  d-flex justify-content-center align-items-center">
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<img src="' . get_the_post_thumbnail_url( $post->ID ) . '" class="img-fluid">
										</a>
										</div>
										<div class="col-12 p-0 m-0 d-flex justify-content-center align-items-center">
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<h6>' . $title . '</h6>
										</a>
										</div>

										</div>
										<div class="row p-0 m-0  d-flex justify-content-center align-items-center">
										<div class="col-12 p-0 m-0 spot">
										<p>' . $excerpt . '</p>
										</div>
										</div>

										</div>
										</div>';

									$g ++;
								} elseif ( $g == 6 ) {


									$post6 = '<div class="col-12 col-md-4">
										<div class="widget-items mb-1">
										<div class="row p-0 m-0">
										<div class="col-12 p-0 m-0  d-flex justify-content-center align-items-center">
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<img src="' . get_the_post_thumbnail_url( $post->ID ) . '" class="img-fluid">
										</a>
										</div>
										<div class="col-12 p-0 m-0 d-flex justify-content-center align-items-center">
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<h6>' . $title . '</h6>
										</a>
										</div>

										</div>
										<div class="row p-0 m-0  d-flex justify-content-center align-items-center">
										<div class="col-12 p-0 m-0 spot">
										<p>' . $excerpt . '</p>
										</div>
										</div>

										</div>
										</div>';

									$g ++;
								}
							}

						}

						wp_reset_postdata();

						?>

                        <div class="row">

							<?php echo $post1; ?>
                            <div class="col-12 col-md-4 pl-md-0">

								<?php echo $post2; ?>
								<?php echo $post3; ?>


                            </div>

                        </div>
                        <div class="row mt-3">
							<?php echo $post4 ?>
							<?php echo $post5; ?>
							<?php echo $post6; ?>

                        </div>
                    </div>


                </div>
            </div>
            <div class="col-md-3 col-12 sidebar" style="margin-top:20px">

                <div class="sidebar-widget">
                    <div class="sidebar-widget-content">
                        <div class="baskandan">
                            <div class="baskandan-content">
                                <div class="logo">
                                    <img src="http://www.tekgida.org.tr/images/akademi.png" class="img-fluid">
                                </div>

                                <h5 class="text-center mt-2">SENDİKA AKADEMİSİ</h5><h5 class="text-center mt-2">SENDİKA AKADEMİSİ</h5>

                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

                                    <div class="carousel-inner">


					                    <?php

					                    $args = array(
						                    'posts_per_page' => 5,
						                    'post_status'    => 'publish',
						                    'orderby'        => 'date',
						                    'order'          => 'DESC',
						                    'category_name'  => 'sendika-akademisi',
					                    );


					                    $the_query = new WP_Query( $args );

					                    $i = 0;
					                    if ( $the_query->have_posts() ) {

						                    while ( $the_query->have_posts() ) {
							                    $the_query->the_post();

							                    if ( empty( get_the_post_thumbnail_url( $post->ID, 'full' ) ) ) {

								                    continue;

							                    }

							                    ?>

                                                <div class="carousel-item <?php if ( $i == 0 ) {
								                    echo 'active';
							                    }
							                    $i ++; ?>">
                                                    <a href="<?php the_permalink(); ?>"
                                                       style="text-decoration: none; color: inherit;">
                                                        <img class="d-block w-100 baskandanimg"
                                                             src="<?php echo get_the_post_thumbnail_url( $post->ID, 'full' ); ?>"
                                                             alt="<?php the_title(); ?>">
                                                    </a>
                                                    <div class="carousel-caption">
                                                        <a href="<?php the_permalink(); ?>"
                                                           style="text-decoration: none; color: inherit;">
                                                            <p class="title text-title"><?php the_title(); ?></p>
                                                        </a>
                                                    </div>
                                                </div>
							                    <?php
						                    }


					                    }

					                    wp_reset_postdata();

					                    ?>


                                    </div>
                                    <ol class="carousel-indicators" style="margin-bottom: -22px;">
					                    <?php
					                    $k = 0;
					                    $i --;
					                    while ( $i > - 1 ) {

						                    echo '<li data-target="#carouselExampleControls" data-slide-to="' . $k . '"></li>';

						                    $k ++;
						                    $i --;
					                    }

					                    ?>


                                    </ol>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
                <!--<div class="sidebar-widget">
                    <div class="sidebar-widget-title">
                        KIDEM TAZMİNATI
                    </div>
                    <div class="sidebar-widget-content">
                        <a href="/kidem-tazminatima-dokunma/">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/kidem.jpg" class="img-fluid">
                        </a>
                    </div>

                </div>-->
                <div class="sidebar-widget">
                    <div class="sidebar-widget-title">
                        E-DEVLET
                    </div>
                    <div class="sidebar-widget-content">
                        <a href="/tekgida-is-sendikasina-nasil-uye-olurum/">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/sendika.jpg" class="img-fluid">
                        </a>
                    </div>

                </div>
                <div class="sidebar-widget">
                    <div class="sidebar-widget-title">
                        TESİS
                    </div>
                    <div class="sidebar-widget-content">
                        <a href="/labranda-lebedos-princess-seferihisar-tatil-koyu/">
                            <img src="<?php bloginfo( 'template_url' ); ?>/img/lebedos2.jpg" class="img-fluid">
                        </a>
                    </div>

                </div>


            </div>
        </div>
    </div>
</section>


<section>
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="widget">
                    <div class="widget-title degrade">
                        <a href="category/bildiri-ve-haberler/genel-baskandan"
                           style="text-decoration: none; color: inherit;">GENEL BAŞKANDAN
                        </a></div>
                    <div class="widget-content">

                        <div class="row">


							<?php


							$args = array(
								'posts_per_page' => 4,
								'post_status'    => 'publish',
								'orderby'        => 'date',
								'order'          => 'DESC',
								'category_name'  => 'genel-baskandan',
							);


							$the_query = new WP_Query( $args );


							if ( $the_query->have_posts() ) {

								while ( $the_query->have_posts() ) {

									$the_query->the_post();
									$title = get_the_title();
									if ( has_excerpt() ) {
										$excerpt = get_the_excerpt();
									} else {
										$excerpt = '';
									}
									$url       = get_the_permalink();
									$authorid  = get_the_author_meta( 'ID' );
									$authorurl = get_the_author_meta( 'nickname', $authorid );


									?>

                                    <div class="col-12 col-md-3">

                                        <div class="widget-items">

                                            <a href="<?php the_permalink(); ?>"
                                               style="text-decoration: none; color: inherit;">
                                                <div class="imgup">
                                                    <img class="img-fluid"
                                                         src="<?php echo get_the_post_thumbnail_url( $post->ID, 'full' ); ?>"
                                                         alt="<?php the_title(); ?>">
                                                </div>
                                            </a>

                                            <a href="<?php the_permalink(); ?>"
                                               style="text-decoration: none; color: inherit;">
                                                <h6><?php the_title(); ?></h6>
                                            </a>

                                            <div class="row p-0 m-0  d-flex justify-content-center align-items-center">
                                                <div class="col-12 p-0 m-0 spot">
                                                    <p><?php the_excerpt(); ?></p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


								<?php }
							}
							wp_reset_postdata(); ?>


                        </div>

                    </div>


                </div>
            </div>

        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="widget">
                    <div class="widget-title degrade">
                        <a href="category/bildiri-ve-haberler/egitim-haberleri"
                           style="text-decoration: none; color: inherit;">
                            EĞİTİM HABERLERİ
                        </a>
                    </div>
                    <div class="widget-content">


						<?php

						$args = array(
							'posts_per_page' => 5,
							'post_status'    => 'publish',
							'orderby'        => 'date',
							'order'          => 'DESC',
							'category_name'  => 'egitim-haberleri',
						);


						$the_query = new WP_Query( $args );

						$g = 1;
						if ( $the_query->have_posts() ) {

							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								$title = get_the_title();
								if ( has_excerpt() ) {
									$excerpt = get_the_excerpt();
								} else {
									$excerpt = '';
								}
								$url       = get_the_permalink();
								$authorid  = get_the_author_meta( 'ID' );
								$authorurl = get_the_author_meta( 'nickname', $authorid );

								if ( $g == 1 ) {

									$post1 = '<div class="col-12 col-md-6">

										<div class="widget-items">

										<div class="imgup">

										<img src="' . get_the_post_thumbnail_url( $post->ID ) . '" class="img-fluid">
										</div>
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<h3>' . $title . '</h3>
										</a>
										<div class="col-12 p-0 pb-3 m-0 spot">
										<p>' . $excerpt . '</p>
										</div>
										</div>

										</div>';

									$g ++;

								} elseif ( $g == 2 ) {

									$post2 = '<div class="col-12 col-md-6">

										<div class="widget-items">



										<div class="imgup">

										<img src="' . get_the_post_thumbnail_url( $post->ID ) . '" class="img-fluid">
										</div>

										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<h6>' . $title . '</h6>
										</a>

										</div>

										</div>';


									$g ++;

								} elseif ( $g == 3 ) {

									$post3 = '<div class="col-12 col-md-6">

										<div class="widget-items">

										<div class="imgup">

										<img src="' . get_the_post_thumbnail_url( $post->ID ) . '" class="img-fluid">
										</div>
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<h6>' . $title . '</h6>
										</a>

										</div>

										</div>';


									$g ++;
								} elseif ( $g == 4 ) {

									$post4 = '<div class="col-12 col-md-6">

										<div class="widget-items">

										<div class="imgup">

										<img src="' . get_the_post_thumbnail_url( $post->ID ) . '" class="img-fluid">
										</div>
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<h6>' . $title . '</h6>
										</a>

										</div>

										</div>';


									$g ++;
								} elseif ( $g == 5 ) {

									$post5 = '<div class="col-12 col-md-6">

										<div class="widget-items">

										<div class="imgup">

										<img src="' . get_the_post_thumbnail_url( $post->ID ) . '" class="img-fluid">
										</div>
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<h6>' . $title . '</h6>
										</a>

										</div>

										</div>';


									$g ++;
								}
							}
						}
						wp_reset_postdata();
						?>

                        <div class="row">

							<?php echo $post1; ?>
                            <div class="col-12 col-md-6">

                                <div class="row">

									<?php echo $post2; ?>

									<?php echo $post3; ?>

                                </div>
                                <div class="row mt-2">

									<?php echo $post4; ?>

									<?php echo $post5; ?>


                                </div>
                            </div>

                        </div>

                    </div>


                </div>
            </div>

        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="widget">
                    <div class="widget-title degrade">
                        <a href="category/bildiri-ve-haberler/orgutlenme-grev-ve-eylemlerden-haberler"
                           style="text-decoration: none; color: inherit;">
                            ÖRGÜTLENME GREV VE EYLEMLERDEN HABERLER
                        </a>
                    </div>
                    <div class="widget-content">

                        <div class="row">


							<?php


							$args = array(
								'posts_per_page' => 8,
								'post_status'    => 'publish',
								'orderby'        => 'date',
								'order'          => 'DESC',
								'category_name'  => 'orgutlenme-grev-ve-eylemlerden-haberler',
							);


							$the_query = new WP_Query( $args );

							$g = 1;
							if ( $the_query->have_posts() ) {

								while ( $the_query->have_posts() ) {


									$the_query->the_post();
									$title = get_the_title();
									if ( has_excerpt() ) {
										$excerpt = get_the_excerpt();
									} else {
										$excerpt = '';
									}
									$url = get_the_permalink();


									?>

                                    <div class="col-12 col-md-3">

                                        <div class="widget-items">

                                            <a href="<?php the_permalink(); ?>"
                                               style="text-decoration: none; color: inherit;">
                                                <div class="imgup">
                                                    <img class="img-fluid"
                                                         src="<?php echo get_the_post_thumbnail_url( $post->ID, 'full' ); ?>"
                                                         alt="<?php the_title(); ?>">
                                                </div>
                                            </a>

                                            <a href="<?php the_permalink(); ?>"
                                               style="text-decoration: none; color: inherit;">
                                                <h6><?php the_title(); ?></h6>
                                            </a>

                                            <div class="row p-0 m-0  d-flex justify-content-center align-items-center">
                                                <div class="col-12 p-0 m-0 spot">
                                                    <p><?php the_excerpt(); ?></p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


									<?php $g ++;
								}
							}
							wp_reset_postdata(); ?>


                        </div>

                    </div>


                </div>
            </div>

        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="widget">
                    <div class="widget-title degrade"><a style="min-height: 40px;
color: #FFF;
display: flex;
align-items: center;
padding-left: 3%;
font-family: Montserrat Bold;" href="#">FOTO GALERİ</a></div>
                    <div class="widget-content galeri">

                        <div id="carouselExampleControls2" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">

								<?php

								$args = array(
									'posts_per_page' => 12,
									'post_status'    => 'publish',
									'orderby'        => 'date',
									'order'          => 'DESC',
									'category_name'  => 'foto-galeri-anasayfa',
								);


								$query = new WP_Query( $args );


								$i = 0;
								if ( $query->have_posts() ) {
									while ( $query->have_posts() ) {
										$query->the_post();
										$link = '';
										$url  = get_field( 'link', $post->ID );
										if ( ! empty( $url ) ) {

											$link = $url;

										} else {

											$link = get_the_permalink();

										}

										?>
                                        <div class="carousel-item <?php if ( $i == 0 ) {
											echo 'active';
											$i ++;
										} ?>">
                                            <a href="<?php echo $link; ?>" target="_blank">
                                                <img style="max-height: 468px;" class="d-block w-100"
                                                     src="<?php echo get_the_post_thumbnail_url( $post->ID, 'full' ); ?>"
                                                     alt="<?php the_title(); ?>">
                                                <div class="carousel-caption">

                                                    <h2><?php the_title(); ?></h2>

                                                </div>
                                        </div>
										<?php
									}

									wp_reset_postdata();
								}
								?>

                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls2" role="button"
                               data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls2" role="button"
                               data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="widget">
                    <div class="widget-title degrade"><a style="min-height: 40px;
color: #FFF;
display: flex;
align-items: center;
padding-left: 3%;
font-family: Montserrat Bold;" href="https://www.tekgida.org.tr/tekgida-tv/">TEKGIDA TV</a></div>
                    <div class="widget-content video">

                        <div class="row">
							<?php


							$args = array(
								'posts_per_page' => 4,
								'post_status'    => 'publish',
								'orderby'        => 'date',
								'order'          => 'DESC',
								'cat'            => 16,
							);


							$the_query = new WP_Query( $args );

							$g = 1;
							if ( $the_query->have_posts() ) {

							while ( $the_query->have_posts() ) {
							$the_query->the_post();
							$title = get_the_title();

							$video_url  = '';
							$videocode2 = '';
							$videocode  = '';

							$video_url = get_field( 'youtube', $post->ID );

							$videocode = explode( 'https://youtu.be/', $video_url );

							$videocode2 = $videocode[1];
							if ( $g == 1 ){


							?>
                            <div class="col-12 col-md-9" onclick="modalopen(<?php echo $post->ID ?>);">

                                <div class="widget-items video d-none d-md-block">

                                    <img style="width: 100%;
object-fit: cover;
max-height: 450px;" class="img-fluid videopoint" src="https://i1.ytimg.com/vi/<?php echo $videocode2; ?>/hqdefault.jpg"
                                         alt="<?php the_title(); ?>">
                                    <div class="video-title w-100">
                                        <h3><?php echo $title; ?></h3>
                                    </div>
                                    <div class="video-icon">
                                        <span><i class="fas fa-play"></i></span>
                                    </div>
                                </div>
                                <div class="widget-items video mb-1 d-block d-md-none">
                                    <div class="row p-0 m-0">


                                        <div class="col-12 p-0 m-0">
                                            <img class="img-fluid videopoint"
                                                 src="https://i1.ytimg.com/vi/<?php echo $videocode2; ?>/hqdefault.jpg"
                                                 alt="<?php the_title(); ?>">
                                            <div class="video-title side">
                                                <h6><?php echo $title; ?></h6>
                                            </div>
                                            <div class="video-icon side">
                                                <span><i class="fas fa-play"></i></span>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="modal fade myModal2" id="myModal-<?php echo $post->ID ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="close"
                                                        onclick="modalclose(<?php echo $post->ID ?>);" title="Close"><i
                                                            class="fas fa-times"></i></span></button>

                                            </div>
                                            <div class="modal-body" id="slider">
                                                <div class="responsive-youtube2">
                                                    <iframe class="youtube-iframe"
                                                            src="https://www.youtube.com/embed/<?php echo $videocode2; ?>"
                                                            frameborder="0"
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                            allowfullscreen></iframe>
                                                </div>
                                                <!--end modal-body--></div>

                                            <div class="modal-footer">

                                                <!--end modal-footer--></div>
                                            <!--end modal-content--></div>
                                        <!--end modal-dialoge--></div>
                                    <!--end myModal--></div>
                            </div>
                            <div class="col-12 col-md-3">

								<?php $g ++;
								} else {

									?>

                                    <div class="widget-items video mb-1" onclick="modalopen(<?php echo $post->ID ?>);">
                                        <div class="row p-0 m-0">


                                            <div class="col-12 p-0 m-0">
                                                <img class="img-fluid w-100  h146"
                                                     src="https://i1.ytimg.com/vi/<?php echo $videocode2; ?>/hqdefault.jpg"
                                                     alt="<?php the_title(); ?>">

                                                <div class="video-title videopoint side">
                                                    <h6><?php echo $title; ?></h6>
                                                </div>
                                                <div class="video-icon side">
                                                    <span><i class="fas fa-play"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade myModal2" id="myModal-<?php echo $post->ID ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">

                                                        <button type="button" class="close"
                                                                onclick="modalclose(<?php echo $post->ID ?>);"
                                                                title="Close"><i class="fas fa-times"></i></span>
                                                        </button>

                                                    </div>
                                                    <div class="modal-body" id="slider">
                                                        <div class="responsive-youtube2">
                                                            <iframe class="youtube-iframe"
                                                                    src="https://www.youtube.com/embed/<?php echo $videocode2; ?>"
                                                                    frameborder="0"
                                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                                    allowfullscreen></iframe>

                                                            <!--end modal-body--></div>
                                                        <!--end modal-body--></div>

                                                    <div class="modal-footer">

                                                        <!--end modal-footer--></div>
                                                    <!--end modal-content--></div>
                                                <!--end modal-dialoge--></div>
                                            <!--end myModal--></div>

                                    </div>
									<?php
									$g ++;
								}

								}
								} ?>
                            </div>


                        </div>

                    </div>


                </div>
            </div>

        </div>
    </div>
</section>


<section>
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="widget">
                    <div class="widget-title degrade">
                        <a href="category/bildiri-ve-haberler/uluslararasi-iliskiler"
                           style="text-decoration: none; color: inherit;">ULUSLARARASI İLİŞKİLER
                        </a></div>
                    <div class="widget-content">

                        <div class="row">


							<?php


							$args = array(
								'posts_per_page' => 4,
								'post_status'    => 'publish',
								'orderby'        => 'date',
								'order'          => 'DESC',
								'category_name'  => 'uluslararasi-iliskiler',
							);


							$the_query = new WP_Query( $args );


							if ( $the_query->have_posts() ) {

								while ( $the_query->have_posts() ) {

									$the_query->the_post();
									$title = get_the_title();
									if ( has_excerpt() ) {
										$excerpt = get_the_excerpt();
									} else {
										$excerpt = '';
									}
									$url       = get_the_permalink();
									$authorid  = get_the_author_meta( 'ID' );
									$authorurl = get_the_author_meta( 'nickname', $authorid );


									?>

                                    <div class="col-12 col-md-3">

                                        <div class="widget-items">

                                            <a href="<?php the_permalink(); ?>"
                                               style="text-decoration: none; color: inherit;">
                                                <div class="imgup">
                                                    <img class="img-fluid"
                                                         src="<?php echo get_the_post_thumbnail_url( $post->ID, 'full' ); ?>"
                                                         alt="<?php the_title(); ?>">
                                                </div>
                                            </a>

                                            <a href="<?php the_permalink(); ?>"
                                               style="text-decoration: none; color: inherit;">
                                                <h6><?php the_title(); ?></h6>
                                            </a>

                                            <div class="row p-0 m-0  d-flex justify-content-center align-items-center">
                                                <div class="col-12 p-0 m-0 spot">
                                                    <p><?php the_excerpt(); ?></p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


								<?php }
							}
							wp_reset_postdata(); ?>


                        </div>

                    </div>


                </div>
            </div>

        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="widget">
                    <div class="widget-title degrade">
                        <a href="category/bildiri-ve-haberler/kadin-komisyonu"
                           style="text-decoration: none; color: inherit;">KADIN KOMİSYONU
                        </a></div>
                    <div class="widget-content">

                        <div class="row">

							<?php


							$args = array(
								'posts_per_page' => 4,
								'post_status'    => 'publish',
								'orderby'        => 'date',
								'order'          => 'DESC',
								'category_name'  => 'kadin-komisyonu',
							);


							$the_query = new WP_Query( $args );


							if ( $the_query->have_posts() ) {

								while ( $the_query->have_posts() ) {


									$the_query->the_post();
									$title = get_the_title();
									if ( has_excerpt() ) {
										$excerpt = get_the_excerpt();
									} else {
										$excerpt = '';
									}
									$url       = get_the_permalink();
									$authorid  = get_the_author_meta( 'ID' );
									$authorurl = get_the_author_meta( 'nickname', $authorid );


									?>

                                    <div class="col-12 col-md-3">

                                        <div class="widget-items">

                                            <a href="<?php the_permalink(); ?>"
                                               style="text-decoration: none; color: inherit;">
                                                <div class="imgup">
                                                    <img class="img-fluid"
                                                         src="<?php echo get_the_post_thumbnail_url( $post->ID, 'full' ); ?>"
                                                         alt="<?php the_title(); ?>">
                                                </div>
                                            </a>

                                            <a href="<?php the_permalink(); ?>"
                                               style="text-decoration: none; color: inherit;">
                                                <h6><?php the_title(); ?></h6>
                                            </a>

                                            <div class="row p-0 m-0  d-flex justify-content-center align-items-center">
                                                <div class="col-12 p-0 m-0 spot">
                                                    <p><?php the_excerpt(); ?></p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


								<?php }
							}
							wp_reset_postdata(); ?>
                        </div>

                    </div>


                </div>
            </div>

        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="widget">
                    <div class="widget-title degrade">
                        <a href="category/bildiri-ve-haberler/sosyal-guvenlik-kosesi"
                           style="text-decoration: none; color: inherit;">
                            SOSYAL GÜVENLİK KÖŞESİ
                        </a>
                    </div>
                    <div class="widget-content">

                        <div class="row">

							<?php


							$args = array(
								'posts_per_page' => 4,
								'post_status'    => 'publish',
								'orderby'        => 'date',
								'order'          => 'DESC',
								'category_name'  => 'sosyal-guvenlik-kosesi',
							);


							$the_query = new WP_Query( $args );

							$g = 1;
							if ( $the_query->have_posts() ) {

								while ( $the_query->have_posts() ) {


									$the_query->the_post();
									$title = get_the_title();
									if ( has_excerpt() ) {
										$excerpt = get_the_excerpt();
									} else {
										$excerpt = '';
									}
									$url       = get_the_permalink();
									$authorid  = get_the_author_meta( 'ID' );
									$authorurl = get_the_author_meta( 'nickname', $authorid );


									?>

                                    <div class="col-12 col-md-3">

                                        <div class="widget-items">

                                            <a href="<?php the_permalink(); ?>"
                                               style="text-decoration: none; color: inherit;">
                                                <div class="imgup">
                                                    <img class="img-fluid"
                                                         src="<?php echo get_the_post_thumbnail_url( $post->ID, 'full' ); ?>"
                                                         alt="<?php the_title(); ?>">
                                                </div>
                                            </a>

                                            <a href="<?php the_permalink(); ?>"
                                               style="text-decoration: none; color: inherit;">
                                                <h6><?php the_title(); ?></h6>
                                            </a>

                                            <div class="row p-0 m-0  d-flex justify-content-center align-items-center">
                                                <div class="col-12 p-0 m-0 spot">
                                                    <p><?php the_excerpt(); ?></p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


									<?php $g ++;
								}
							}
							wp_reset_postdata(); ?>
                        </div>


                    </div>


                </div>
            </div>

        </div>
    </div>
</section>
<?php get_footer(); ?>
