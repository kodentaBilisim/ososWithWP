<div class="tab-pane <?= ( $tab['active'] == true ? 'active' : '' ); ?>" id="<?= $tab['name'] ?>" role="tabpanel">
	<div class="row">
		<div class="col-xxl-12 col-md-12">
			<div class="card">
				<div class="card-body">
                    <div class="card-body">
                        <table id="personel"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                            <thead>

                            <tr>
                                <th>SGK Kodu</th>
                                <th>Üye</th>
                                <th>İl</th>
                                <th></th>
                            </tr>


                            </thead>
                            <tbody>

							<?php

                            $i = 0;
							foreach ( listSGKFirma($_GET['id']) as $personel ) {

								?>

                                <tr>
                                    <td><?= $personel['unvan'] ?><pre><?=$personel['sgk']?><br><?=str_replace('    ','',$personel['adres'])?></pre></td>
                                    <td><?= count( listPersonelSGK( $personel['id'] ) ) ?></td>
                                    <td><?= ilgetirbyID($personel['il']) ?></td>

                                    <td>
                                            <a target="_blank"
                                               href="?page=sgk/ayrinti&id=<?= $personel['id'] ?>"
                                               class="btn btn-info  ">Ayrıntıları Göster
                                            </a>
                                    </td>

                                </tr>
							<?php  $i++; } ?>

                            </tbody>
                        </table>
                    </div>
				</div><!-- end card body -->
			</div><!-- end card -->
		</div>
	</div>
</div>
