<?php


$userMeta     = sgk_meta($_GET['id']);

$SGKUye = listSGKUye($_GET['id']);
$SGKIstifa = listSGKUye($_GET['id'],0);


?>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Firma Bilgileri</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kurumlar</a></li>
                            <li class="breadcrumb-item active">Firma Bilgileri</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

		<?php if ( ! $userMeta ){ ?>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Hatalı Alt Firma ID'si</h4>
                        </div><!-- end card header -->
                    </div>
                </div>
            </div>
		<?php }else{ ?>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-tabs mb-3" role="tablist">

				<?php
				$tabs = [
					[ 'name' => 'giris', 'Title' => 'Firma Bilgileri', 'active' => true ],
					[ 'name' => 'uye', 'Title' => 'Üyeler', 'active' => false ],
					[ 'name' => 'istifa', 'Title' => 'İstifalar', 'active' => false ],
				];
				?>
				<?php foreach ( $tabs as $tab ): ?>
                    <li class="nav-item">
                        <a id="id<?= $tab['name'] ?>" class="nav-link <?= ( $tab['active'] == true ? 'active' : '' ); ?>" data-bs-toggle="tab"
                           href="#<?= $tab['name'] ?>" role="tab" aria-selected="false">
							<?= $tab['Title'] ?>
                        </a>
                    </li>
				<?php endforeach; ?>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">

				<?php foreach ( $tabs as $tab ):

					include 'tabs/' . $tab['name'] . '.php';

				endforeach; ?>

            </div>
        </div>
    </div>
</div>

<?php } ?>
</div>
</div>
