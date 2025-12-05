<?php

$kisiMeta = $db->from('users')->where('id', $_GET['id'])->first();


?>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Üye Bilgileri</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Üyeler</a></li>
                            <li class="breadcrumb-item active">Üye Bilgileri</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-3">Üye Bilgileri</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                            <tr>
                                <th class="ps-0" scope="row">ePosta:</th>
                                <td class="text-muted"><?= $kisiMeta['email'] ?></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div><!-- end card body -->
            </div>

        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Yetki Değiştir</h5>
                    <?php

                    $iller = '';

                    foreach ($db->from('il')->orderBy('id', 'ASC')->all() as $il) {

                        if (in_array($il['id'], json_decode($kisiMeta['yetki']))) {
                            $check = 'checked';
                        } else {
                            $check = '';
                        }

                        $iller .= '<div class="row mb-3"> 	<div class="col-lg-3">
 						<label for="editor" class="form-label">' . $il['name'] . '</label>
 						</div>
						<div class="col-lg-9">
						<div class="form-check form-switch form-switch-lg" dir="ltr">
						<input type="checkbox" class="form-check-input" id="il_' . $il['id'] . '" name="il_' . $il['id'] . '" ' . $check . '>
						</div>
						</div>
						   
					</div>';
                    }


                    echo createForm(array(
                        'id' => 'serialize',
                        'buttonText' => 'Kaydet',
                        'elements' => array(
                            array(
                                'type' => 'custom',
                                'value' => $iller,
                            ),
                            array(
                                'type' => 'hidden',
                                'name' => 'postUrl',
                                'value' => 'users/chmod',
                            ),
                            array(
                                'type' => 'hidden',
                                'name' => 'userID',
                                'value' => $_GET['id'],
                            ),
                        )
                    ));

                    ?>


                </div><!-- end card body -->
            </div><!-- end card -->

        </div>

    </div>
</div>
</div>
