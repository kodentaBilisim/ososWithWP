<?php /* Template Name: İŞYERİ TEST*/ ?>
	<?php get_header(); ?>
	<section id="content">
		
        <div class="container content">
		
			<?php 
				
				$args=array(
				'posts_per_page' => -1,
				'post_status' => 'publish',
				'post_type' => 'isyeri',
				'orderby' => 'date',
				'order'   => 'DESC'
				
				);
				
				
				$the_query = new WP_Query( $args );
				
				$i = 0;
				$html = '';
				if ( $the_query->have_posts() ) {
					
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						
						if(empty(get_the_post_thumbnail_url($post->ID, 'full'))){
							
							continue;
							
						}
						
					 
					
					
									
									$html .= '<div class="post medium-post" style="float: left; padding-right: 15px; background-color: transparent;">';
										$html .=  '<div class="entry-header">';
											$html .= '<div class="entry-thumbnail">';
												$html .= '<a href="http://'. get_field('url', $post->ID).'" target="_blank">';
													$html .= '<img class="img-responsive marqu" src="' .get_the_post_thumbnail_url($post->ID, 'full').'" alt="'.get_the_title().'">';
													$html .= '</a>';
											$html .= '</div>';
										$html .=  '</div>';
									$html .= '</div>';
								
					  
					}
					
				}
				
				echo $html;
				
				wp_reset_postdata();
				
			?>
				
			</div>
			
			
			</section>
				<?php get_footer(); ?>				