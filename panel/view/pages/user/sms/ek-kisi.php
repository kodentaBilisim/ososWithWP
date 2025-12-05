<?php

if ( isset( $_GET['ara'] ) ) {

	if ( $_GET['type'] == 'isim' ) {

		$Kurumlar =
			$db->from( 'kisiler' )
			   ->like( 'name', $_GET['ara'] )
			   ->all();

	} elseif ( $_GET['type'] == 'telefon' ) {

		$Kurumlar = $db->from( 'kisiler' )
		               ->like( 'telefon', $_GET['ara'] )
		               ->all();

	}


}

?>

<div id="page-title">
    <h2>Kişiler</h2>
    <p>Yönetim Paneli > Kişiler</p>
</div>
<section class="users-list-wrapper">
    <div class="users-list-filter px-1">

    </div>
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form method="get" class="form">
                        <div class="row justify-content-md-center">
                            <div class="col-md-4">
                                <div class="form-body">
                                    <div class="form-group">

                                        <select class="form-control" id="type" name="type">

                                            <option value="isim">Ad Soyad</option>
                                            <option value="telefon">Telefon</option>

                                        </select>
                                        <label for="username" class="mt-1">Arama Yeri</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-body">
                                    <div class="form-group">

                                        <input type="text" class="form-control" name="ara" id="ara"
                                               required>
                                        <label for="username" class="mt-1">Arama</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-body">
                                    <div class="form-group d-flex align-items-center justify-content-center">
                                        <button type="submit" class="btn btn-success"
                                                required>ARA
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="page" value="sms/ek-kisi">
                        <input type="hidden" name="kampanya" value="<?= $_GET['kampanya'] ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

if ( isset( $_GET['ara'] ) ) {

	$kampanya = $db->from( 'kampanya' )->where( 'id', $_GET['kampanya'] )->first();

	$EKLİSTE = json_decode( $kampanya['ek'], true );

	?>

    <script>


        async function eklekisi(kisi, kampanya) {

            await $.get('api/APISMSKisiEkle.php?kisi=' + kisi + '&kampanya=' + kampanya, function (data) {

                obj = JSON.parse(data);

                console.log(obj)

               if(obj.proses === 'ekle'){
                    $('#btn-'+obj.user).html('KALDIR');
                    $('#btn-'+obj.user).removeClass("btn-success").addClass("btn-danger");
                }else{
                    $('#btn-'+obj.user).html('EKLE');
                    $('#btn-'+obj.user).removeClass("btn-danger").addClass("btn-success");
                }



            });

        }

    </script>
    <section class="users-list-wrapper">
        <div class="users-list-filter px-1">

        </div>
        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <!-- datatable start -->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration" id="data-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>İsim</th>
                                    <th>Telefon</th>
                                    <th>Firma</th>
                                    <th>İşyeri</th>
                                    <th>Şube</th>
                                    <th></th>


                                </tr>
                                </thead>
                                <tbody>
								<?php


								foreach ( $Kurumlar as $veri ) {

									$UserListId   = $veri["id"];
									$UserListName = $veri["name"];


									?>
                                    <tr id="silbtn-<?php echo $veri["id"]; ?>-1">
                                        <td><?php echo $UserListId; ?></td>
                                        <td><?php echo $UserListName; ?></td>
                                        <td><?php echo $veri["telefon"]; ?></td>
                                        <td><?php echo get_meta_firma( $veri["firma"], 'name' ); ?></td>
                                        <td><?php echo get_meta_isyeri( $veri["isyeri"], 'name' ); ?></td>
                                        <td><?php echo get_meta_sube( $veri["sube"], 'name' ); ?></td>

										<?php

										if ( in_array( $veri['id'], $EKLİSTE ) ) {
											?>
                                            <td>
                                                <an id="btn-<?= $veri["id"] ?>"
                                                    onclick="eklekisi('<?php echo $veri["id"]; ?>','<?= $_GET['kampanya'] ?>')"
                                                    class="btn btn-danger">KALDIR
                                                </an>
                                            </td>

											<?php
										} else {

											?>
                                            <td>
                                                <an id="btn-<?= $veri["id"] ?>"
                                                    onclick="eklekisi('<?php echo $veri["id"]; ?>','<?= $_GET['kampanya'] ?>')"
                                                    class="btn btn-success">EKLE
                                                </an>
                                            </td>
											<?php

										}

										?>


                                    </tr>
									<?php


								}

								?>

                                </tbody>
                            </table>
                        </div>
                        <!-- datatable ends -->
                    </div>
                </div>
            </div>
        </div>
    </section>
	<?php

}

?>
