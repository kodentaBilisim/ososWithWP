<div class="tab-pane <?= ( $tab['active'] == true ? 'active' : '' ); ?>" id="<?= $tab['name'] ?>" role="tabpanel">
    <div class="row">
        <div class="col-xxl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">İşyerleri</h5>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                               style="width:100%">
                            <thead>

                            <tr>
                                <th>İşyeri Adı</th>
                                <th>ÜYE SAYISI</th>
                                <th></th>
                            </tr>


                            </thead>
                            <tbody>

							<?php  foreach ( $db->from('sgk')->where('il',$_GET['id'])->all() as $isyeri ) {


                                $firma = $db->from('firma')->where('id',$isyeri['firma'])->first();


                                ?>

                                <tr>
                                    <td><?= $firma  ['name'] ?><pre><?=$isyeri['sgk']?><br><?=str_replace('    ','',$isyeri['adres'])?></pre></td>
                                    <td><?= count( listPersonelSGK( $isyeri['id'] ) ) ?></td>
                                    <td>
                                        <a class="btn btn-success" role="button"
                                           href="?page=firma/duzenle&id=<?= $firma['id'] ?>">AYRINTI</a>
                                    </td>


                                </tr>
							<?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div>
    </div>
</div>
