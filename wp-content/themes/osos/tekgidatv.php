<?php /* Template Name: Tek Gıda TV */ ?>
<?php get_header(); ?>
<section id="content">
	
	<div class="container content">
		
		<h2>Tekgıda TV</h2>
		
		
		<section>
			<div class="container">
				<div class="row">
					<div class="col-12">
						
						<div class="widget">
							<div class="widget-title degrade">
								<a href="/category/tekgida-tv/genel-baskandan-tekgida-tv/" style="text-decoration: none; color: inherit;">
									GENEL BAŞKANDAN
								</a>
							</div>
							<div class="widget-content">
								
								<div class="row">
									
									
									<?php 
										
										
										$args=array(
										'posts_per_page' => 4,
										'post_status' => 'publish',
										'orderby' => 'date',
										'order'   => 'DESC',
										'cat' => 17,
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
															<img class="img-fluid" src="https://i1.ytimg.com/vi/<?php echo $videocode2; ?>/hqdefault.jpg" alt="<?php the_title(); ?>">
															
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
										
										<?php } 
										
									} ?>
									
									
									
									
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
								<a href="/category/tekgida-tv/tekgida-is-sendikasi-mucadele-gecmisinden-kareler/" style="text-decoration: none; color: inherit;">
									Tekgıda-İş Sendikası Mücadele Geçmişinden Kareler
								</a>
							</div>
							<div class="widget-content">
								
								<div class="row">
									
									
									<?php 
										
										
										$args=array(
										'posts_per_page' => 12,
										'post_status' => 'publish',
										'orderby' => 'date',
										'order'   => 'DESC',
										'cat' => 32,
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
														<div class="imgup d-flex justify-content-center ">
															<img class="img-fluid" src="https://i1.ytimg.com/vi/<?php echo $videocode2; ?>/hqdefault.jpg" alt="<?php the_title(); ?>">
															
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
										
										<?php } 
										
									} ?>
									
									
									
									
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
								<a href="/category/tekgida-tv/eylemlerden-haberler/" style="text-decoration: none; color: inherit;">
									Eylemlerden Haberler
								</a>
							</div>
							<div class="widget-content">
								
								<div class="row">
									
									
									<?php 
										
										
										$args=array(
										'posts_per_page' => 8,
										'post_status' => 'publish',
										'orderby' => 'date',
										'order'   => 'DESC',
										'cat' => 18,
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
														<div class="imgup d-flex justify-content-center ">
															<img class="img-fluid" src="https://i1.ytimg.com/vi/<?php echo $videocode2; ?>/hqdefault.jpg" alt="<?php the_title(); ?>">
															
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
										
										<?php } 
										
									} ?>
									
									
									
									
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
								<a href="/category/tekgida-tv/toplu-is-sozlesmeleri/" style="text-decoration: none; color: inherit;">
									Toplu İş Sözleşmeleri
								</a>
							</div>
							<div class="widget-content">
								
								<div class="row">
									
									
									<?php 
										
										
										$args=array(
										'posts_per_page' => 8,
										'post_status' => 'publish',
										'orderby' => 'date',
										'order'   => 'DESC',
										'cat' => 29,
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
														<div class="imgup d-flex justify-content-center ">
															<img class="img-fluid" src="https://i1.ytimg.com/vi/<?php echo $videocode2; ?>/hqdefault.jpg" alt="<?php the_title(); ?>">
															
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
										
										<?php } 
										
									} ?>
									
									
									
									
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
								<a href="/category/tekgida-tv/egitim-videolari/" style="text-decoration: none; color: inherit;">
									Eğitim Videoları
								</a>
							</div>
							<div class="widget-content">
								
								<div class="row">
									
									
									<?php 
										
										
										$args=array(
										'posts_per_page' => 8,
										'post_status' => 'publish',
										'orderby' => 'date',
										'order'   => 'DESC',
										'cat' => 31,
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
														<div class="imgup d-flex justify-content-center ">
															<img class="img-fluid" src="https://i1.ytimg.com/vi/<?php echo $videocode2; ?>/hqdefault.jpg" alt="<?php the_title(); ?>">
															
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
										
										<?php } 
										
									} ?>
									
									
									
									
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
								<a href="/category/tekgida-tv/uzmanina-sor/" style="text-decoration: none; color: inherit;">
									Uzmanına Sor
								</a>
							</div>
							<div class="widget-content">
								
								<div class="row">
									
									
									<?php 
										
										
										$args=array(
										'posts_per_page' => 8,
										'post_status' => 'publish',
										'orderby' => 'date',
										'order'   => 'DESC',
										'cat' => 33,
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
														<div class="imgup d-flex justify-content-center ">
															<img class="img-fluid" src="https://i1.ytimg.com/vi/<?php echo $videocode2; ?>/hqdefault.jpg" alt="<?php the_title(); ?>">
															
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
										
										<?php } 
										
									} ?>
									
									
									
									
							</div>
							
						</div>
						
						
					</div>
				</div>
				
			</div>
		</div>
	</section>
</div>





</section>
<?php get_footer(); ?>												