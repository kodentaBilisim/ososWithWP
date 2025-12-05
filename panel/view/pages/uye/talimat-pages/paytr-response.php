<?php

$userCart = $db->from('cart')
    ->where('user', $_SESSION['UserID'])
    ->orderBy('id', 'DESC')
    ->first();

$cartResponse = json_decode($userCart['response'], true);
if ($cartResponse['status'] == 'success') {



    ?>
    <div class="d-flex justify-content-center">
        <div aria-labelledby="swal2-title" aria-describedby="swal2-html-container"
             class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog"
             aria-live="assertive"
             aria-modal="true" style="display: grid;">
            <ul class="swal2-progress-steps" style="display: none;"></ul>
            <div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
                <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
                <div class="swal2-success-ring"></div>
                <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
            </div>
            <img class="swal2-image" style="display: none;">
            <h2 class="swal2-title" id="swal2-title" style="display: block;">ÖDEME İŞLEMİ BAŞARILI</h2>
            <div class="swal2-html-container" id="swal2-html-container" style="display: block;">
                Ödeme Tutarı: <?= $cartResponse['payment_amount'] / 100 ?> TL

            </div>

            <div class="swal2-actions" style="display: flex;">
                <div class="swal2-loader"></div>
                <a href="/panel" class="swal2-confirm btn btn-primary w-xs me-2 mt-2"
                   style="display: inline-block;" aria-label="">ANASAYFAYA DÖN
                </a>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="d-flex justify-content-center">

        <div aria-labelledby="swal2-title" aria-describedby="swal2-html-container"
             class="swal2-popup swal2-modal swal2-icon-error swal2-show" tabindex="-1" role="dialog"
             aria-live="assertive"
             aria-modal="true" style="display: grid;">

            <div class="swal2-icon swal2-error swal2-icon-show" style="display: flex;"><span class="swal2-x-mark">
    <span class="swal2-x-mark-line-left"></span>
    <span class="swal2-x-mark-line-right"></span>
  </span>
            </div>
            <img class="swal2-image" style="display: none;">
            <h2 class="swal2-title" id="swal2-title" style="display: block;">ÖDEME BAŞARISIZ</h2>
            <div class="swal2-html-container" id="swal2-html-container" style="display: block;">
                <p><?= $cartResponse['failed_reason_msg'] ?></p>
                Ödeme Tutarı: <?= $cartResponse['payment_amount'] / 100 ?> TL
            </div>
            <div class="swal2-actions" style="display: flex;">
                <div class="swal2-loader"></div>
                <a href="/panel/?page=step-by-step&step=kart-bilgileri" type="button" class="swal2-confirm btn btn-primary w-xs mt-2" style="display: inline-block;"
                        aria-label="">YENİDEN DENE
                </a>
                <button type="button" class="swal2-deny" style="display: none;" aria-label="">No</button>
            </div>
        </div>
    </div>
    <?php
}

