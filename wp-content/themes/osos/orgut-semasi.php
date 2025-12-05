<?php
/* Template Name: Teşkilat Şeması ve İşyerleri */


get_header(); ?>
<section id="content">

    <div class="container content">

        <h2><?php the_title(); ?></h2>
		<?php


		$Response = wp_remote_get( 'http://sms.tekgida.org.tr/uploads/' . $_GET['type'] . '.json' );


		if ( $_GET['type'] == 'sube' ):
			?>

            <div id="accordion">
				<?php

				$i = 0;


				foreach ( json_decode( $Response['body'], true ) as $item ):

					?>

                    <div class="card">
                        <div class="card-header degrade" id="heading<?= $i ?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link text-white" data-toggle="collapse" data-target="#collapse<?= $i ?>"
                                        aria-expanded="true" aria-controls="collapse<?= $i ?>">
									<?php echo $item['name']; ?>
                                </button>
                            </h5>
                        </div>

                        <div id="collapse<?= $i ?>" class="collapse" aria-labelledby="heading<?= $i ?>"
                             data-parent="#accordion">
                            <div class="card-body">

                                <div class="row kurul">
									<?php 
									
									if(isset($item)):
									
									foreach ( $item['kisiler'] as $kisi ): ?>
								
									<div class="kurul-uye">

			 
			<img style="max-height: 138px;" src="https://st4.depositphotos.com/11634452/41441/v/600/depositphotos_414416680-stock-illustration-picture-profile-icon-male-icon.jpg" class="img-fluid ">
			
			<div class="uye-unvan">  <span><?= $kisi['name'] ?></span></div>
			<div class="uye-isim"><?= $kisi['title'] ?></div>
<div class="text-center"><?= $kisi['phone'] ?></div>
			</div>
				
									
                                     
									<?php endforeach; 
									
									endif;
									?>
                                </div>


                            </div>
                        </div>
                    </div>

					<?php $i ++; endforeach; ?>
            </div>
		<?php elseif ( $_GET['type'] == 'firma' ): ?>


            <div id="accordion">
				<?php

				$i = 0;


				foreach ( json_decode( $Response['body'], true ) as $item ):


					?>

                    <div class="card">
                       <div class="card-header degrade" id="heading<?= $i ?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link text-white" data-toggle="collapse" data-target="#collapse<?= $i ?>"
                                        aria-expanded="true" aria-controls="collapse<?= $i ?>">
									<?php echo $item['name']; ?>
                                </button>
                            </h5>
                        </div>

                        <div id="collapse<?= $i ?>" class="collapse" aria-labelledby="heading<?= $i ?>"
                             data-parent="#accordion">
                            <div class="card-body">

                                <div class="row kurul">
									<?php foreach ( $item['isyeri'] as $isyeri ): ?>


										<?php if ( isset($isyeri['kisiler']) AND count( $isyeri['kisiler'] ) > 0 ): ?>
                                            <div class="col-12">
                                                <h5 class="text-center"><?= $isyeri['name'] ?></h5>
                                            </div>
											<?php foreach ( $isyeri['kisiler'] as $kisi ): ?>
                                               <div class="kurul-uye">

			 
			<img style="max-height: 138px;" src="https://st4.depositphotos.com/11634452/41441/v/600/depositphotos_414416680-stock-illustration-picture-profile-icon-male-icon.jpg" class="img-fluid ">
			
			<div class="uye-unvan">  <span><?= $kisi['name'] ?></span></div>
			<div class="uye-isim"><?= $kisi['title'] ?></div>
<div class="text-center"><?= $kisi['phone'] ?></div>
			</div>
											<?php endforeach; ?>
										<?php endif; ?>
									<?php endforeach; ?>
                                </div>


                            </div>
                        </div>
                    </div>

					<?php $i ++; endforeach; ?>
            </div>


		<?php endif; ?>
    </div>

</section>
<?php get_footer(); ?>
