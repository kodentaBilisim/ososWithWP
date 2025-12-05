<?php get_header(); ?>
<?php gt_set_post_view(); ?>
<section id="content">
    <div class="container ">
        <div class="row">
            <div class="col-md-9 col-12 content">
                <div class="row">
                    <div class="tarih col-8"><i class="far fa-clock mr-2"></i><?php the_time('d F Y') ?></div>
                    <div class="sosyal col-4 d-flex justify-content-end">

                        <ul class="post-social mt-1">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
                                   target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li>
                                <a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?> &url=<?php the_permalink(); ?>"
                                   target="_blank"><i class="fab fa-twitter"></i></a></li>

                        </ul>

                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mt-2">
                        <h5><?php the_title(); ?></h5>
                    </div>
                    <div class="col-12 mt-2 haber">

                        <?php if (has_excerpt()) {
                            the_excerpt();
                        } else {
                            echo '';
                        } ?>
                    </div>
                    <div class="col-12 mt-2">
                        <?php

                        $video_url = get_field('youtube', $post->ID);


                        if (!empty($video_url)) {

                            $varmi = strstr($video_url, "https://youtu.be/");

                            if ($varmi == false) {
                                $videocode = explode('https://www.youtube.com/embed/', $video_url);
                                $videocode2 = explode('?rel=0', $videocode[1]);

                                $videocode2 = $videocode2[0];

                            } else {
                                $videocode = explode('https://youtu.be/', $video_url);

                                $videocode2 = $videocode[1];

                            }

                            ?>
                            <div class="responsive-youtube2">
                                <iframe class="youtube-iframe"
                                        src="https://www.youtube.com/embed/<?php echo $videocode2; ?>" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>

                                <!--end modal-body--></div>
                            <?php

                        } elseif (get_field('onecikanhaber') != 'hayir') {


                            ?>
                            <div class="imgup">
                                <img class="img-fluid" src="<?php echo gorsel($post->ID, 'full'); ?>"
                                     alt="<?php the_title(); ?>">

                            </div>
                            <?php

                        }


                        ?>

                    </div>
                    <div class="col-12 mt-2 haber">

                        <?php the_content(); ?>
                    </div>

                </div>

            </div>

            <div class="col-md-3 col-12 sidebar" style="margin-top:20px">
                <div class=" sidebar-widget socialmedia mt-1 mt-md-0">
                    <ul class="labels">
                        <li><a href="#" target="_blank"><img src="<?php bloginfo('template_url'); ?>/img/facebook.png"></a>
                        </li>
                        <li><a href="#" target="_blank"><img
                                        src="<?php bloginfo('template_url'); ?>/img/twitter.png"></a></li>
                        <li><a href="#" target="_blank"><img src="<?php bloginfo('template_url'); ?>/img/instagram.png"></a>
                        </li>
                        <li><a href="#" target="_blank"><img
                                        src="<?php bloginfo('template_url'); ?>/img/youtube.png"></a></li>
                        <li><a href="#" target="_blank"><img src="<?php bloginfo('template_url'); ?>/img/linkedin.png"></a>
                        </li>

                    </ul>
                </div>
                <div class="sidebar-widget">
                    <div class="sidebar-widget-title">
                        TABAN MAAŞ
                    </div>
                    <div class="sidebar-widget-content">
                        <a href="/kidem-tazminatima-dokunma/">
                            <img src="<?php bloginfo('template_url'); ?>/img/kidem.jpg" class="img-fluid">
                        </a>
                    </div>

                </div>
                <div class="sidebar-widget">
                    <div class="sidebar-widget-title">
                        E-DEVLET
                    </div>
                    <div class="sidebar-widget-content">
                        <a href="/tekgida-is-sendikasina-nasil-uye-olurum/">
                            <img src="<?php bloginfo('template_url'); ?>/img/sendika.jpg" class="img-fluid">
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
            <div class="col-12 p-0">

                <div class="widget">
                    <div class="widget-title degrade">DİĞER HABERLER</div>
                    <div class="widget-content">

                        <div class="row">

                            <?php


                            $q = get_related_category_posts();
                            if ($q->have_posts()) {

                                while ($q->have_posts()) {
                                    $q->the_post();
                                    $title = get_the_title();
                                    $excerpt = get_the_excerpt();
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
                                                         src="<?php echo gorsel($post->ID, 'full'); ?>"
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
<?php get_footer(); ?>
