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


                            $args = array('posts_per_page' => 4, 'post_status' => 'publish', 'orderby' => 'date', 'order' => 'DESC', 'category_name' => 'genel-baskandan',);


                            $the_query = new WP_Query($args);


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


                                    ?>

                                    <div class="col-12 col-md-3">

                                        <div class="widget-items">

                                            <a href="<?php the_permalink(); ?>"
                                               style="text-decoration: none; color: inherit;">
                                                <div class="imgup">
                                                    <img class="img-fluid"
                                                         src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>"
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

                        $args = array('posts_per_page' => 5, 'post_status' => 'publish', 'orderby' => 'date', 'order' => 'DESC', 'category_name' => 'egitim-haberleri',);


                        $the_query = new WP_Query($args);

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

                                    $post1 = '<div class="col-12 col-md-6">

										<div class="widget-items">

										<div class="imgup">

										<img src="' . get_the_post_thumbnail_url($post->ID) . '" class="img-fluid">
										</div>
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<h3>' . $title . '</h3>
										</a>
										<div class="col-12 p-0 pb-3 m-0 spot">
										<p>' . $excerpt . '</p>
										</div>
										</div>

										</div>';

                                    $g++;

                                } elseif ($g == 2) {

                                    $post2 = '<div class="col-12 col-md-6">

										<div class="widget-items">



										<div class="imgup">

										<img src="' . get_the_post_thumbnail_url($post->ID) . '" class="img-fluid">
										</div>

										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<h6>' . $title . '</h6>
										</a>

										</div>

										</div>';


                                    $g++;

                                } elseif ($g == 3) {

                                    $post3 = '<div class="col-12 col-md-6">

										<div class="widget-items">

										<div class="imgup">

										<img src="' . get_the_post_thumbnail_url($post->ID) . '" class="img-fluid">
										</div>
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<h6>' . $title . '</h6>
										</a>

										</div>

										</div>';


                                    $g++;
                                } elseif ($g == 4) {

                                    $post4 = '<div class="col-12 col-md-6">

										<div class="widget-items">

										<div class="imgup">

										<img src="' . get_the_post_thumbnail_url($post->ID) . '" class="img-fluid">
										</div>
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<h6>' . $title . '</h6>
										</a>

										</div>

										</div>';


                                    $g++;
                                } elseif ($g == 5) {

                                    $post5 = '<div class="col-12 col-md-6">

										<div class="widget-items">

										<div class="imgup">

										<img src="' . get_the_post_thumbnail_url($post->ID) . '" class="img-fluid">
										</div>
										<a href="' . $url . '" style="text-decoration: none; color: inherit;">
										<h6>' . $title . '</h6>
										</a>

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


                            $args = array('posts_per_page' => 8, 'post_status' => 'publish', 'orderby' => 'date', 'order' => 'DESC', 'category_name' => 'orgutlenme-grev-ve-eylemlerden-haberler',);


                            $the_query = new WP_Query($args);

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


                                    ?>

                                    <div class="col-12 col-md-3">

                                        <div class="widget-items">

                                            <a href="<?php the_permalink(); ?>"
                                               style="text-decoration: none; color: inherit;">
                                                <div class="imgup">
                                                    <img class="img-fluid"
                                                         src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>"
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


                                    <?php $g++;
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

                                $args = array('posts_per_page' => 12, 'post_status' => 'publish', 'orderby' => 'date', 'order' => 'DESC', 'category_name' => 'foto-galeri-anasayfa',);


                                $query = new WP_Query($args);


                                $i = 0;
                                if ($query->have_posts()) {
                                    while ($query->have_posts()) {
                                        $query->the_post();
                                        $link = '';
                                        $url = get_field('link', $post->ID);
                                        if (!empty($url)) {

                                            $link = $url;

                                        } else {

                                            $link = get_the_permalink();

                                        }

                                        ?>
                                        <div class="carousel-item <?php if ($i == 0) {
                                            echo 'active';
                                            $i++;
                                        } ?>">
                                            <a href="<?php echo $link; ?>" target="_blank">
                                                <img style="max-height: 468px;" class="d-block w-100"
                                                     src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>"
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
font-family: Montserrat Bold;">TEKGIDA TV</a></div>
                    <div class="widget-content video">

                        <div class="row">
                            <?php


                            $args = array('posts_per_page' => 4, 'post_status' => 'publish', 'orderby' => 'date', 'order' => 'DESC', 'cat' => 16,);


                            $the_query = new WP_Query($args);

                            $g = 1;
                            if ($the_query->have_posts()) {

                            while ($the_query->have_posts()) {
                            $the_query->the_post();
                            $title = get_the_title();

                            $video_url = '';
                            $videocode2 = '';
                            $videocode = '';

                            $video_url = get_field('youtube', $post->ID);

                            $videocode = explode('https://youtu.be/', $video_url);

                            $videocode2 = $videocode[1];
                            if ($g == 1){


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

                                <?php $g++;
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
                                    $g++;
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


                            $args = array('posts_per_page' => 4, 'post_status' => 'publish', 'orderby' => 'date', 'order' => 'DESC', 'category_name' => 'uluslararasi-iliskiler',);


                            $the_query = new WP_Query($args);


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


                                    ?>

                                    <div class="col-12 col-md-3">

                                        <div class="widget-items">

                                            <a href="<?php the_permalink(); ?>"
                                               style="text-decoration: none; color: inherit;">
                                                <div class="imgup">
                                                    <img class="img-fluid"
                                                         src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>"
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


                            $args = array('posts_per_page' => 4, 'post_status' => 'publish', 'orderby' => 'date', 'order' => 'DESC', 'category_name' => 'kadin-komisyonu',);


                            $the_query = new WP_Query($args);


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


                                    ?>

                                    <div class="col-12 col-md-3">

                                        <div class="widget-items">

                                            <a href="<?php the_permalink(); ?>"
                                               style="text-decoration: none; color: inherit;">
                                                <div class="imgup">
                                                    <img class="img-fluid"
                                                         src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>"
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


                            $args = array('posts_per_page' => 4, 'post_status' => 'publish', 'orderby' => 'date', 'order' => 'DESC', 'category_name' => 'sosyal-guvenlik-kosesi',);


                            $the_query = new WP_Query($args);

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


                                    ?>

                                    <div class="col-12 col-md-3">

                                        <div class="widget-items">

                                            <a href="<?php the_permalink(); ?>"
                                               style="text-decoration: none; color: inherit;">
                                                <div class="imgup">
                                                    <img class="img-fluid"
                                                         src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>"
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


                                    <?php $g++;
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