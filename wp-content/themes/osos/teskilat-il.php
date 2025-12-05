<?php /* Template Name: TEŞKİLAT */ ?>
<?php get_header();
	
	global $post;

	
	?>
<section id="content">

        <div class="container content">
            
            <h2>Teşkilat Yapısı <br><span><?php the_title(); ?></span></h2>

            <?php the_content(); ?>
            
           
            <div class="adres">
                <h6><strong><?php the_title(); ?> İletişim Bilgileri</strong>
</h6>
                <p><span>Telefon:</span> <?php echo get_field('telefon', $post->ID); ?></p>
                <p><span>Adres:</span> <?php echo get_field('adres', $post->ID); ?></p>
                <p><span>Faks:</span>  <?php echo get_field('faks', $post->ID); ?></p>
                <p><span>E-Posta:</span> <?php echo get_field('e-posta', $post->ID); ?></p>
            </div>
        </div>


    </section>
<?php get_footer(); ?>