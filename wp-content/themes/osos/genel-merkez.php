<?php /* Template Name: Genel Merkez */ ?>
<?php get_header(); ?>
<section id="content">

        <div class="container content">

            <h2>Teşkilat Yapısı <span>Genel Merkez</span></h2>

            <div class="kurul">

                <h3 class="title">YÖNETİCİLER</h3>
                <div class="row">

                    <div class="kurul-uye">

                        <img src="http://tekgida.org.tr/adres_resim/125/genelmerkez_mustafaturkel_125.jpg" class="img-fluid">
                        <div class="uye-unvan"><span>Mustafa TÜRKEL</span></div>
                        <div class="uye-isim">Genel Başkan</div>

                    </div>
                    <div class="kurul-uye">

                        <img src="http://www.tekgida.org.tr/adres_resim/125/Mustafa-Akyurek-tekgida_125.jpg" class="img-fluid">
                        <div class="uye-unvan"> <span>Mustafa AKYÜREK </span></div>
                        <div class="uye-isim">Genel Sekreter</div>

                    </div>
                    <div class="kurul-uye">

                        <img src="http://www.tekgida.org.tr/adres_resim/125/Ali-BUKULMEZ-Baskan_141_125.jpg" class="img-fluid">
                        <div class="uye-unvan"><span>Alİ BÜKÜLMEZ</span></div>
                        <div class="uye-isim">Genel Malİ Sekreter</div>

                    </div>
                    <div class="kurul-uye">

                        <img src="http://www.tekgida.org.tr/adres_resim/125/genelmerkez_ibrahimoren_125.jpg" class="img-fluid">
                        <div class="uye-unvan"><span>İbrahİm ÖREN</span></div>
                        <div class="uye-isim">Genel Teşkİlatlanma Sekreterİ</div>

                    </div>
                    <div class="kurul-uye">

                        <img src="http://www.tekgida.org.tr/adres_resim/125/genelmerkez_kemalkose_125.jpg" class="img-fluid">
                        <div class="uye-unvan"><span>Kemal KÖSE</span></div>
                        <div class="uye-isim">Genel Eğİtİm Sekreterİ</div>

                    </div>
                </div>
            </div>
            <div class="kurul">

                <h3 class="title">DENETİM KURULU</h3>
                <div class="row">

                    <div class="kurul-uye">

                        <img src="http://www.tekgida.org.tr/adres_resim/125/HikmetYildirim_125.jpg" class="img-fluid">
                        <div class="uye-unvan"><span> Hİkmet YILDIRIM</span> </div>
                        <div class="uye-isim">Denetİm Kurulu Asİl Üyesİ</div>

                    </div>
                    <div class="kurul-uye">

                        <img src="http://www.tekgida.org.tr/adres_resim/125/g%C3%BCrkanA%C4%9Fg%C3%BC%C3%A7_125.jpg" class="img-fluid">
                        <div class="uye-unvan"><span>Gürkan AĞGÖÇ</span></div>
                        <div class="uye-isim">Denetİm Kurulu Asİl Üyesİ</div>

                    </div>
                    <div class="kurul-uye">

                        <img src="http://www.tekgida.org.tr/adres_resim/125/MetinDavulcu_125.jpg" class="img-fluid">
                        <div class="uye-unvan"> <span>Metİn DAVULCU</span> </div>
                        <div class="uye-isim">Denetİm Kurulu Asİl Üyesİ</div>

                    </div>

                </div>
            </div>
            <div class="kurul">

                <h3 class="title">DİSİPLİN KURULU</h3>
                <div class="row">

                    <div class="kurul-uye">

                        <img src="http://www.tekgida.org.tr/adres_resim/125/isa_akin_125.jpg" class="img-fluid">
                        <div class="uye-unvan"><span>İsa AKIN</span></div>
                         <div class="uye-isim">Dİsİplİn Kurulu Asİl Üyesİ </div>

                    </div>
                    <div class="kurul-uye">

                        <img src="http://www.tekgida.org.tr/adres_resim/125/sinan_kocak_125.jpg" class="img-fluid">
                        <div class="uye-unvan"><span> Sİnan KOÇAK </span></div>
                         <div class="uye-isim">Dİsİplİn Kurulu Asİl Üyesİ </div>

                    </div>
                    <div class="kurul-uye">

                        <img src="http://www.tekgida.org.tr/adres_resim/125/murat_yildirim_125.jpg" class="img-fluid">
                        <div class="uye-unvan"><span>Murat YILDIRIM </span></div>
                        <div class="uye-isim">Dİsİplİn Kurulu Asİl Üyesİ </div>

                    </div>

                </div>
            </div>
            <div class="adres">
                <h6>Tekgıda-İş Sendikası Genel Merkezi İletişim Bilgileri</h6>
               <p><span>Telefon:</span> <?php echo get_field('telefon', $post->ID); ?></p>
                <p><span>Adres:</span> <?php echo get_field('adres', $post->ID); ?></p>
                <p><span>Faks:</span>  <?php echo get_field('faks', $post->ID); ?></p>
                <p><span>E-Posta:</span> <?php echo get_field('e-posta', $post->ID); ?></p>
            </div>
        </div>


    </section>
<?php get_footer(); ?>