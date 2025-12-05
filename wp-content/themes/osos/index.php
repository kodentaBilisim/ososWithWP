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

                        $args = array('posts_per_page' => 16, 'post_status' => 'publish', 'orderby' => 'date', 'order' => 'DESC', 'category_name' => 'manset',);


                        $the_query = new WP_Query($args);

                        $i = 0;
                        $k = 0;
                        if ($the_query->have_posts()) {

                            while ($the_query->have_posts()) {
                                $the_query->the_post();

                                if ($i < 15) {
                                    update_field('manset', '1', $post->ID);
                                    ?>

                                    <div class="carousel-item <?php if ($k == 0) {
                                        echo 'active';
                                    }
                                    $k++; ?>">
                                        <a href="<?php the_permalink(); ?>"
                                           style="text-decoration: none; color: inherit;">
                                            <img class="d-block w-100 mansetimg"
                                                 src="<?php echo gorsel($post->ID); ?>" alt="<?php the_title(); ?>">
                                        </a>

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
                                    $i++;


                                } else {

                                    update_field('manset', '0', $post->ID);


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
                <div class="widget my-4">
                    <div class="widget-title degrade">
                        <a href="category/taban-maas"
                           style="text-decoration: none; color: inherit;">
                            TABAN MAAŞ
                        </a>
                    </div>
                    <div class="widget-content">
                        <?php

                        $the_query = new WP_Query([
                            'posts_per_page' => 20,
                            'post_status' => 'publish',
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'category_name' => 'taban-maas'
                        ]);
                        $g = 1;
                        if ($the_query->have_posts()) {
                            while ($the_query->have_posts()) {
                                $the_query->the_post();
                                $title = get_the_title();
                                if (has_excerpt()) {
                                    $excerpt = get_the_excerpt();
                                } else {
                                    $excerpt = '';
                                }
                                $url = get_the_permalink();
                                $authorid = get_the_author_meta('ID');
                                $authorurl = get_the_author_meta('nickname', $authorid);
                                if ($g == 1) {
                                    $post1 = '<div class="col-12 col-md-8">

										<div class="widget-items">
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<img src="' . get_the_post_thumbnail_url($post->ID) . '" class="img-fluid">
										<h3>' . $title . '</h3>
										</a>
										<div class="col-12 p-0 m-0 spot">
										<p style="min-height: 67px;">' . $excerpt . '</p>

										</div>
										</div>

										</div>';


                                    $g++;
                                } elseif ($g == 2) {
                                    $post2 = '<div class="widget-items mb-1">
										<div class="row p-0 m-0">


										<div class="col-12 p-0 m-0  d-flex justify-content-center align-items-center">
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">

										<img src="' . get_the_post_thumbnail_url($post->ID) . '" class="img-fluid">

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
                                    $g++;
                                } elseif ($g == 3) {
                                    $post3 = '<div class="widget-items mb-1">
										<div class="row p-0 m-0">
										<div class="col-12 p-0 m-0  d-flex justify-content-center align-items-center">
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<img src="' . get_the_post_thumbnail_url($post->ID) . '" class="img-fluid">
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
                                    $g++;
                                } elseif ($g == 4) {
                                    $post4 = '<div class="col-12 col-md-4">
										<div class="widget-items mb-1">
										<div class="row p-0 m-0">
										<div class="col-12 p-0 m-0  d-flex justify-content-center align-items-center">
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<img src="' . get_the_post_thumbnail_url($post->ID) . '" class="img-fluid">
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

                                    $g++;
                                } elseif ($g == 5) {
                                    $post5 = '<div class="col-12 col-md-4">
										<div class="widget-items mb-1">
										<div class="row p-0 m-0">
										<div class="col-12 p-0 m-0  d-flex justify-content-center align-items-center">
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<img src="' . get_the_post_thumbnail_url($post->ID) . '" class="img-fluid">
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
                                    $g++;
                                } elseif ($g == 6) {
                                    $post6 = '<div class="col-12 col-md-4">
										<div class="widget-items mb-1">
										<div class="row p-0 m-0">
										<div class="col-12 p-0 m-0  d-flex justify-content-center align-items-center">
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<img src="' . get_the_post_thumbnail_url($post->ID) . '" class="img-fluid">
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
                                    $g++;
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
                        <a target="_blank"
                           href="http://ogretmensendikasi.org/2024/03/30/tabanmaasibekliyoruz/">
                            <img src="http://ogretmensendikasi.org/wp-content/uploads/2024/03/imza-kampanyasi.jpg"
                                 class="img-fluid">
                        </a>
                    </div>
                </div>
                <div class="socialmedia mt-1 mt-md-0">
                    <ul class="labels">
                        <li><a href="#" target="_blank"><img
                                        src="<?php bloginfo('template_url'); ?>/img/facebook.png"></a></li>
                        <li><a href="#" target="_blank"><img
                                        src="<?php bloginfo('template_url'); ?>/img/twitter.png"></a></li>
                        <li><a href="#" target="_blank"><img
                                        src="<?php bloginfo('template_url'); ?>/img/instagram.png"></a></li>
                        <li><a href="#" target="_blank"><img
                                        src="<?php bloginfo('template_url'); ?>/img/youtube.png"></a></li>
                        <li><a href="#"
                               target="_blank"><img src="<?php bloginfo('template_url'); ?>/img/linkedin.png"></a>
                        </li>

                    </ul>
                </div>

                <div class="sidebar-widget">
                    <div class="sidebar-widget-title">
                        NASIL ÜYE OLURUM?
                    </div>
                    <div class="sidebar-widget-content">
                        <a href="/ogretmen-sendikasina-nasil-uye-olurum/">
                            <img src="/wp-content/uploads/2024/03/0330.jpg" class="img-fluid">
                        </a>
                    </div>

                </div>
            </div>


        </div>
    </div>
    </div>
</section>


<?php get_footer(); ?>
