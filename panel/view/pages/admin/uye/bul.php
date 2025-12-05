<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Üye Ara</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">İşlemler</a></li>
                            <li class="breadcrumb-item active">Üye Ara</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">


            <div class="card">
                <div class="card-body">
					<?php


					echo createForm(
						[
							'buttonText' => 'Ara',
							'btnclass' => 'btn-primary',
							'elements' => [
								[
									'type' => 'text',
									'name' => 'name',
									'label' => 'Ad Soyad',
									'required' => true,
									'value' => $_GET['name']
								],
								[
									'type' => 'hidden',
									'name' => 'id',
									'value' => $_GET['id']
								],
								[
									'type' => 'hidden',
									'name' => 'page',
									'value' => 'uye/bul'
								],
								[
									'type' => 'hidden',
									'name' => 'ara',
									'value' => true
								]
							]
						]
					);


					?>
                </div>
            </div>

			<?php if ($_GET['ara']):


				?>
                <div class="card">
                    <div class="card-body">
						<?php


						$kisiara = $db->from('kisiler')->like('name', $_GET['name'])->all();


						?>

                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                               style="width:100%">
                            <thead>

                            <tr>
                                <th>İsim Soyisim</th>
                                <th>il</th>
                                <th></th>
                            </tr>


                            </thead>
                            <tbody>

							<?php


							foreach ($kisiara as $kisi) {


								?>

                                <tr>
                                    <td><?= $kisi['name'] ?></td>
                                    <td><?= ilgetirbyID($kisi['il']) ?></td>
                                    <td>



                                        <a target="_blank"
                                           href="?page=uye/odeme-ayrinti&id=<?= $kisi['id'] ?>"
                                           class="btn btn-info  ">Ayrıntıları Göster
                                        </a>


                                    </td>




                                </tr>
							<?php } ?>

                            </tbody>
                        </table>


                    </div>
                </div>
			<?php endif; ?>

        </div>
    </div>
</div>

