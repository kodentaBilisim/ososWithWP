<div class="tab-pane <?= ( $tab['active'] == true ? 'active' : '' ); ?>" id="<?= $tab['name'] ?>" role="tabpanel">
    <div class="row">
        <div class="col-xxl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">İstifalar</h5>
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
                                <th>ÜYELİK TARİHİ</th>
                                <th>İSTİFA TARİHİ</th>
                                <th>ÇIKIŞ TARİHİ</th>
                                <th></th>
                            </tr>


                            </thead>
                            <tbody>

							<?php foreach ( subeSGKList( $_GET['id'] ) as $isyeri ):

								foreach ( listPersonelSGK( $isyeri['id'], 0, ['cikisTarihi',date( 'Y-m-d H:i:s' ),'>']) as $personel ):


									?>

                                    <tr>
                                        <td><?= $personel['name'] ?></td>
                                        <td><?= $personel['telefon'] ?></td>
                                        <td><?= $personel['cinsiyet'] ?></td>
                                        <td><?= $personel['tc'] ?></td>
                                        <td data-sort="<?= strtotime( $personel['uyelikTarihi'] ) ?>"><?= date( 'd.m.Y', strtotime( $personel['uyelikTarihi'] ) ) ?></td>
                                        <td data-sort="<?= strtotime( $personel['istifaTarihi'] ) ?>"><?= date( 'd.m.Y H:m:s', strtotime( $personel['istifaTarihi'] ) ) ?></td>
                                        <td data-sort="<?= strtotime( $personel['cikisTarihi'] ) ?>"><?= date( 'd.m.Y', strtotime( $personel['cikisTarihi'] ) ) ?></td>
                                        <td>


                                            <a target="_blank"
                                               href="?page=uye/ayrinti&id=<?= $personel['id'] ?>"
                                               class="btn btn-info  ">Ayrıntıları Göster
                                            </a>


                                        </td>


                                    </tr>
								<?php endforeach; ?>
							<?php endforeach; ?>


                            </tbody>
                        </table>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div>
    </div>
</div>
