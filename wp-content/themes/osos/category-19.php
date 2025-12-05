<?php get_header(); 
	
	
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
					$query->the_post(); ?>
					<div class="col-12 col-md-3 my-3">
						
						<div class="widget-items">
							
							<a href="<?php the_permalink(); ?>" style="text-decoration: none; color: inherit;">
								<div class="imgup">
									<img class="img-fluid" src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="<?php the_title(); ?>">
								</div>
							</a>
							
							<a href="<?php the_permalink(); ?>" style="text-decoration: none; color: inherit;">
								<h6><?php the_title(); ?>-</h6>
							</a>
							
							
						</div>
						
					</div>
					
					<?php
					}
					echo '<div class="col-6 sayfalama">';
            previous_posts_link( '< Sonraki Haberler' );
			echo '</div><div class="col-6 text-right sayfalama">';
			 next_posts_link( 'Önceki Haberler >', $query->max_num_pages );
					echo '</div';
					
					wp_reset_postdata();
				}
			?>
			
		</div>
	</div>
	
	
</section>
<?php get_footer(); ?>