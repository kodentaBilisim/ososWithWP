<?php get_header(); 
	
	$category = get_queried_object();
	$catid = $category->term_id;
	
	
	if($catid > 19 AND $catid < 28){
		
	?>
	
	<section id="content">
		
		<div class="container">
			
			
			<h2 class="cat-title"><?php single_cat_title(); ?></h2>
			
			<div class="row">
				
				<?php
					
					$category = get_queried_object();
					$catslug = $category->slug;
					$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
					$args=array(
					'posts_per_page' => 12,
					'paged'         => $paged, 
					'post_status' => 'publish',
					'orderby' => 'date',
					'order'   => 'DESC',
					'category_name' => $catslug,
					);
					
					
					$query = new WP_Query( $args );
					
					
					
					if($query->have_posts()) {
						while ($query->have_posts()) { 
							$query->the_post(); 
							$link = '';
							$url = get_field('link', $post->ID);
							if(!empty($url)){
								
								$link = $url;
								
								}else{
								
								$link = get_the_permalink();
								
							}
							
						?>
						<div class="col-12 col-md-4 my-3">
							
							<div class="widget-items">
								
								<a href="<?php echo $link; ?>" target="_blank" style="text-decoration: none; color: inherit;">
									<div class="imgup">
										<img class="img-fluid" src="<?php echo gorsel($post->ID, 'full');?>" alt="<?php the_title(); ?>">
									</div>
								</a>
								
								<a target="_blank" href="<?php echo $link; ?>" style="text-decoration: none; color: inherit;">
									<h6><?php the_title(); ?></h6>
								</a>
								
								
							</div>
							
						</div>
						
						<?php
						}
						// echo '<div class="col-6 sayfalama">';
						// previous_posts_link( '< Sonraki Haberler' );
						// echo '</div><div class="col-6 text-right sayfalama">';
						// next_posts_link( 'Önceki Haberler >', $query->max_num_pages );
						// echo '</div';
						
						
						
						wp_reset_postdata();
					}
				?>
				 
			</div>
			<div class="row">
			<div class="col-12">
				<?php wpbeginner_numeric_posts_nav(); ?>
			</div>
		</div>
		</div>
		
		
	</section>
	
	<?php
		
		}elseif($catid == 16 OR $catid == 31 OR $catid == 18 OR $catid == 17 OR $catid == 34 OR $catid == 30 OR $catid == 32 OR $catid == 29 OR $catid == 33){
		
	?>
	
	<section id="content">
		
		<div class="container">
			
			
			<h2 class="cat-title"><?php single_cat_title(); ?></h2>
			
			<div class="row">
				
				<?php
					
					$category = get_queried_object();
					$catslug = $category->slug;
					$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
					$args=array(
					'posts_per_page' => 12,
					'paged'         => $paged, 
					'post_status' => 'publish',
					'orderby' => 'date',
					'order'   => 'DESC',
					'category_name' => $catslug,
					);
					
					
					$the_query = new WP_Query( $args );
					
					$g = 1;
					if ( $the_query->have_posts() ) {
						
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							$title = get_the_title();
							
							$video_url = '';
							$videocode2 = '';
							$videocode = '';
							
							$video_url = get_field('youtube',$post->ID);
							
							$varmi = strstr($video_url, "https://youtu.be/");
							
							if($varmi == false){
								$videocode = explode('https://www.youtube.com/embed/', $video_url);
								$videocode2 = explode('?rel=0', $videocode[1]);
								
								$videocode2 = $videocode2[0];
								
								}else{
								$videocode = explode('https://youtu.be/', $video_url);
								
								$videocode2 = $videocode[1];
								
							}
							
							
							
							
						?>
						
						<div class="col-12 col-md-3">
							
							<div class="widget-items">
								
								<div onclick="modalopen(<?php echo $post->ID ?>);">
									<div class="imgup videopoint d-flex justify-content-center ">
										<img class="img-fluid " src="https://i1.ytimg.com/vi/<?php echo $videocode2; ?>/hqdefault.jpg" alt="<?php the_title(); ?>">
										
									</div>
									<h6 clasS="text-center"><?php  echo $title; ?></h6>
								</div>
								
								
								
								
							</div>
							
						</div>
						<div class="modal fade myModal2" id="myModal-<?php echo $post->ID ?>">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										
									<button type="button" class="close" onclick="modalclose(<?php echo $post->ID ?>);" title="Close"> <i class="fas fa-times"></i></span></button>
									
								</div>
								<div class="modal-body" id="slider">
									<div class="responsive-youtube2">
										<iframe class="youtube-iframe" src="https://www.youtube.com/embed/<?php echo $videocode2; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
										
									<!--end modal-body--></div>
								<!--end modal-body--></div>
								
								<div class="modal-footer">
									
								<!--end modal-footer--></div>
							<!--end modal-content--></div>
						<!--end modal-dialoge--></div>
					<!--end myModal--></div>
					<?php
					}
					 
					wp_reset_postdata();
				}
			?>
			
		</div>
		<div class="row">
			<div class="col-12">
				<?php wpbeginner_numeric_posts_nav(); ?>
			</div>
		</div>
	</div>
	
	
</section>

<?php
	
	}else{
	
	
?>
<section id="content">
	
	<div class="container">
		
		
		<h2 class="cat-title"><?php single_cat_title(); ?></h2>
		
		<div class="row">
			
			<?php
				
				
				$catslug = $category->slug;
				$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
				$args=array(
				'posts_per_page' => 12,
				'paged'         => $paged, 
				'post_status' => 'publish',
				'orderby' => 'date',
				'order'   => 'DESC',
				'category_name' => $catslug,
				);
				
				
				$query = new WP_Query( $args );
				
				
				if($query->have_posts()) {
					while ($query->have_posts()) { 
					$query->the_post(); ?>
					<div class="col-12 col-md-3 my-3">
						
						<div class="widget-items category">
							
							<a href="<?php the_permalink(); ?>" style="text-decoration: none; color: inherit;">
								<div class="imgup">
									<img class="img-fluid" src="<?php echo gorsel($post->ID, 'full');?>" alt="<?php the_title(); ?>">
								</div>
							</a>
							
							<a href="<?php the_permalink(); ?>" style="text-decoration: none; color: inherit;">
								<h6><?php the_title(); ?></h6>
							</a>
							
							<div class="row p-0 m-0  d-flex justify-content-center align-items-center">
								<div class="col-12 p-0 m-0 spot">
									<p><?php the_excerpt(); ?></p>
								</div>
							</div>
						</div>
						
					</div>
					
					<?php
					}
					
					wp_reset_postdata();
				}
			?>
			
		</div>
		<div class="row">
			<div class="col-12">
				<?php wpbeginner_numeric_posts_nav(); ?>
			</div>
		</div>
	</div>
	
	
</section>
<?php } get_footer(); ?>