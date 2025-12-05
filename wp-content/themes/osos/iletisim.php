<?php /* Template Name: İLETİŞİM */ ?>
<?php get_header(); ?>
<section id="content">
	
	<div class="container content">
        
		<h2><?php the_title(); ?></h2>
		
		<div style="position:relative;overflow:hidden;">
			
			<a href="https://yandex.com.tr/harita/org/tek_gida_is_sendikasi_genel_merkezi/1040548258/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Tek Gıda İş Sendikası Genel Merkezi</a>
			
			
		<iframe src="https://yandex.com.tr/map-widget/v1/-/CCUEBOhW8B" style="width:100%" height="400" allowfullscreen="true" style="position:relative;"></iframe></div>
		
		
        
	</div>
	<div class="container">
		
		<div class="row">
			<?php
				
				$args = array(
				'post_type'      => 'page',
				'posts_per_page' => -1,
				'post_parent'    => $post->ID,
				'order'          => 'ASC',
				'orderby'        => 'date'
				);
				
				
				$parent = new WP_Query( $args );
				$i = 1;
			if ( $parent->have_posts() ) : ?>
			
			<?php while ( $parent->have_posts() ) : $parent->the_post(); 
				
				if($i == 2){

					$style = 'margin-right: 1%;margin-left: 1%;';
					$i++;
					}else{
					 $style = '';
					$i++;
					}
					
					if($i == 3){

					$i = 0;
					}
				
				?>
			
			<div class="col-md-4 col-12 mb-3 p-3 adresler" style="background: #FFF; border-radius: 6px; word-wrap: break-word; <?php echo $style; ?>" >
				
				<h3><?php the_title(); ?></h3>
				<p><strong>Adres:</strong> <?php echo get_field('adres', $post->ID); ?> </p>
				<p><strong>E-Posta:</strong> <?php echo get_field('e-posta', $post->ID); ?> </p>
				<p><strong>Telefon:</strong> <?php echo get_field('telefon', $post->ID); ?> </p>
				<p><strong>Fax:</strong> <?php echo get_field('faks', $post->ID); ?> </p>
				<p><strong><a href="<?php echo get_field('harita', $post->ID); ?>" target="_blank"></strong></a> </p>
			</div>
			
			<?php endwhile; ?>
			
			<?php endif; wp_reset_postdata(); ?>
		
		<?php /*	
		<div class="mesajform" id="formgonder">
			<h2>Mesaj Gönderin</h2>
			<?php the_content(); ?>
		</div>
		<?php */ ?>
		</div>
		
	</div>
	
	
	
</section>
<?php get_footer(); ?>