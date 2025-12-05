<div class="tab-pane <?= ( $tab['active'] == true ? 'active' : '' ); ?>" id="<?= $tab['name'] ?>" role="tabpanel">
	<div class="row">
		<div class="col-xxl-12 col-md-12">
			<div class="card">
                <div class="card-header">
                    <h5 class="card-title">Üyeler</h5>
                </div>
				<div class="card-body">
                    <div class="card-body">
                        <table id="personel"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                            <thead>

                            <tr>
                                <th>Üye Adı</th>
                                <th>TELEFON</th>
                                <th>CİNSİYET</th>
                                <th>TC</th>
                                <th>İL</th>
                                <th>Üyelik Tarihi</th>
                                <th></th>
                            </tr>


                            </thead>
                            <tbody>

							<?php

                            $i = 0;
							foreach ( $SGKUye as $uye ) {

                            if($uye['durum'] == 0){
                                continue;
                            }


								?>

                                <tr>
                                    <td><?= $uye['name'] ?></td>
                                    <td><?= $uye['telefon'] ?></td>
                                    <td><?= $uye['cinsiyet'] ?></td>
                                    <td><?= $uye['tc'] ?></td>
                                    <td><?= $uye['il'] ?></td>
                                    <td data-sort="<?=strtotime($uye['uyelikTarihi'])?>"><?= date('d.m.Y',strtotime($uye['uyelikTarihi'])) ?></td>
                                    <td>


                                            <a target="_blank"
                                               href="uye/ayrinti&id=<?= $uye['id'] ?>"
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
