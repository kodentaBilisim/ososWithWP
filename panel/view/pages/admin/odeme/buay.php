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
                                <th>TC</th>
                                <th>İL</th>
                                <th>TUTAR</th>
                                <th>TALİMAT TARİHİ</th>
                                <th></th>

                            </tr>


                            </thead>
                            <tbody>

                            <?php


                            $ilUye = $db->from('odemeler')
                                ->where('date',date('Y-m-01 00:00:00'),">")
                                ->where('date',date('Y-m-t 23:59:59'),"<")
                                ->all();

                            foreach ($ilUye as $personel):


                                $talimatData = json_decode($personel['data'], true);
                                $personelData = uyeMeta($personel['user']);


                                ?>

                                <tr>
                                    <td><?= $personelData['name'] ?></td>
                                    <td><?= $personelData['telefon'] ?></td>
                                    <td><?= $personelData['tc'] ?></td>
                                    <td><?= ilgetirbyID($personelData['il']) ?></td>
                                    <td><?= $personel['tutar'] ?> TL</td>


                                    <td data-sort="<?= strtotime($personel['date']) ?>"><?= date('d.m.Y H:i:s', strtotime($personel['date'])) ?></td>
                                    <td>


                                        <a target="_blank"
                                           href="?page=uye/ayrinti&id=<?= $personel['user'] ?>"
                                           class="btn btn-info  ">Ayrıntıları Göster
                                        </a>


                                    </td>

                                </tr>
                            <?php endforeach; ?>


                            </tbody>
                        </table>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div>
    </div>