<?php get_header(); ?>
<section id="content">

	<div class="container">


		<h2 class="cat-title"><?php single_cat_title(); ?></h2>

		<div class="row">
			<?php if(have_posts()) : ?>
			<?php while(have_posts()) : the_post();

			$img = gorsel($post->ID, 'full');



			// if(strstr($img, " ")){
			//
			// 	continue;
			//
			//
			// }


			?>
			<div class="col-12 col-md-3 my-3">

				<div class="widget-items">

					<a href="<?php the_permalink(); ?>" style="text-decoration: none; color: inherit;">
						<div class="imgup">
							<img class="img-fluid" src="<?php echo gorsel($post->ID, 'full');?>" alt="<?php the_title(); ?>">
						</div>
					</a>
					
					<p><?php echo get_the_date('d.m.Y'); ?></p>

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

			<?php endwhile; ?>

			<?php endif; ?>

		</div>
		<div class="row">
			<div class="col-12">
				<?php wpbeginner_numeric_posts_nav(); ?>
			</div>
		</div>
	</div>


</section>
<?php get_footer(); ?>
