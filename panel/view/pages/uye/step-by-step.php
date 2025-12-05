<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">OTOMATİK AİDAT TALİMATI</h4></div>
            </div>

        </div>
        <div class="row">

            <div class="col-12">


                <?php


                if (isset($_GET['step'])) {
                    include 'talimat-pages/' . $_GET['step'] . '.php';
                }


                ?>


            </div>
        </div>
    </div>
</div>

