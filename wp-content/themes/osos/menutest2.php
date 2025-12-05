<?php /* Template Name: Menu test2 */ ?>
<?php include 'testmenu2.php' ?>
<section id="content">

    <div class="container content">

        <h2><?php the_title(); ?></h2>
		<?php the_content(); ?>

    </div>


</section>
<footer>

    <div class="footer-top">
        <div class="container">

            <div class="row">
                <div class="col-md-4 col-12">

                    <h4>Hakkımızda</h4>
                    <p>Türkiye işçi hareketinin önemli bir parçasını oluşturan Tekgıda-İş Sendikası 13 Nisan 1952
                        yılında 9 sendikanın bir araya gelerek federasyon oluşturması ile kurulmuştur.
                        Tekgıda-İş Sendikası kimliğini ve gücünü XIX. yüzyılın ikinci yarısından itibaren örgütlenme
                        sürecine giren tütün ve gıda işçilerinin mücadeleci geleneğinden almaktadır.</p>

                </div>
                <div class="col-md-4 col-12">
                    <h4>Amaç ve Hedefler</h4>
                    <p>Tekgıda-İş sendikası kurulduğu tarihten itibaren Türk çalışma hayatı içerisinde etkin bir şekilde
                        var olmuş ve çalışma yaşamının ciddi ve süregelen sorunlarına her zaman çözüm arayan, üreten ve
                        bu çözümleri de başarıyla hayata geçiren lider bir sendika olma kimliği ile ön plana
                        çıkmıştır.</p>
                </div>
                <div class="col-md-4 col-12">

                    <h4>Adres Bilgilerimiz
                    </h4>
                    <p>Tekgıda-İş Sendikası Genel Merkezi</p>

                    <p><?php echo get_field( 'adres', 3276 ); ?></p>

                    <p>Telefon : <?php echo get_field( 'telefon', 3276 ); ?> </p>

                    <p>Faks : <?php echo get_field( 'faks', 3276 ); ?></p>

                    <p><?php echo get_field( 'e-posta', 3276 ); ?></p>

                </div>
            </div>
        </div>


    </div>
    <div class="footerlogo">

        <img src="http://tekgida.org.tr/wp-content/uploads/2020/12/logo.png">

    </div>
    <div class="footer-bottom">

        <div class="container">

            <div class="row">
                <div class="col-md-3 col-12 text-center text-md-left">

                    <h4>HAKKIMIZDA</h4>
					<?php wp_nav_menu( array( 'theme_location' => 'footer-1' ) ); ?>
                </div>
                <div class="col-md-3 col-12 text-center text-md-left">

                    <h4>FAALİYETLER</h4>
					<?php wp_nav_menu( array( 'theme_location' => 'footer-2' ) ); ?>
                </div>
                <div class="col-md-3 col-12 text-center text-md-left">

                    <h4>BİLDİRİ VE HABERLER</h4>
					<?php wp_nav_menu( array( 'theme_location' => 'footer-3' ) ); ?>
                </div>
                <div class="col-md-3 col-12 text-center text-md-left" style="align-items: center; display: grid;">

                    <h4>BİZE ULAŞIN</h4>
                    <p>Görüşleriniz bizim için önemlidir</p>
                    <a type="button" class="btn btn-footer" href="/iletisim#formgonder">HEMEN GÖNDER</a>
                    <ul class="footer-social mt-1">
                        <li><a href="https://www.facebook.com/tekgida"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://twitter.com/tekgida"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="http://instagram.com/tekgidais"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="https://www.youtube.com/channel/UC7mb8F2I5Qacri_uev1Ajbg"><i
                                        class="fab fa-youtube"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/tekg%C4%B1da-i%C5%9F-sendikas%C4%B1/"><i
                                        class="fab fa-linkedin"></i></a></li>

                    </ul>
                </div>
            </div>
        </div>


    </div>
    <div class="footer-copyright">

        <p>Tekgıda-İş Sendikası - Bilgi İşlem Servisi © <?php echo date( "Y" ); ?></p>

    </div>

    <div class="modal" id="sosyalmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="margin-top:20%">

            <div class="modal-content p-2 pt-1">
                <div class="modal-header p-0 d-flex justify-content-end" style="border: none;">

                    <a onclick="modalclose1()" style="font-size: 30px; cursor: pointer;"><i
                                class="fas fa-times-circle"></i></a>

                </div>
                <h4 style="font-family: Montserrat Bold;" class="text-center">Sizi sosyal medya hesaplarımızda da görmek
                    isteriz</h4>
                <div class="modal-body">
                    <div class="footer-bottom" style="background:#FFF;">
                        <ul class="footer-social mt-1 d-block">
                            <li class="mb-1">

                                <div class="row">

                                    <div class="col-1 offset-3">

                                        <a target="_blank" style="color:#0077b5" href="http://tekgida.is/wpc">
                                            <img style="max-width: 30px"
                                                 src="https://www.tekgida.org.tr/wp-content/themes/tekgidais/img/facebook.png">
                                        </a>

                                    </div>
                                    <div class="col-6 offset-1">

                                        <a target="_blank" style="color:#3b5998" href="http://tekgida.is/wpc">
                                            <span style="font-size: 16px; margin-left:2px">@tekgida</span></a>

                                    </div>
                                </div>

                            </li>
                            <li class="mb-1">

                                <div class="row">

                                    <div class="col-1 offset-3">

                                        <a target="_blank" style="color:#0077b5" href="http://tekgida.is/saQ">
                                            <img style="max-width: 30px"
                                                 src="https://www.tekgida.org.tr/wp-content/themes/tekgidais/img/twitter.png">
                                        </a>

                                    </div>
                                    <div class="col-6 offset-1">

                                        <a target="_blank" style="color:#1da1f2" href="http://tekgida.is/saQ">
                                            <span style="font-size: 16px; margin-left:2px">@tekgida</span></a>

                                    </div>
                                </div>

                            </li>
                            <li class="mb-1">

                                <div class="row">

                                    <div class="col-1 offset-3">

                                        <a target="_blank" style="color:#0077b5" href="http://tekgida.is/FfU">
                                            <img style="max-width: 30px"
                                                 src="https://www.tekgida.org.tr/wp-content/themes/tekgidais/img/instagram.png">
                                        </a>

                                    </div>
                                    <div class="col-6 offset-1">

                                        <a target="_blank" style="color:#f56040" href="http://tekgida.is/FfU">
                                            <span style="font-size: 16px; margin-left:2px">@tekgidais</span></a>

                                    </div>
                                </div>

                            </li>
                            <li class="mb-1">

                                <div class="row">

                                    <div class="col-1 offset-3">

                                        <a target="_blank" style="color:#0077b5" href="http://tekgida.is/4dr">
                                            <img style="max-width: 30px"
                                                 src="https://www.tekgida.org.tr/wp-content/themes/tekgidais/img/youtube.png">
                                        </a>

                                    </div>
                                    <div class="col-6 offset-1">

                                        <a target="_blank" style="color:#ff0000" href="http://tekgida.is/4dr">
                                            <span style="font-size: 16px; margin-left:2px">TEKGIDA TV</span></a>

                                    </div>
                                </div>

                            </li>


                            <li class="mb-1">
                                <div class="row">

                                    <div class="col-1 offset-3">


                                        <a target="_blank" style="color:#0077b5" href="http://tekgida.is/6sm">
                                            <img style="max-width: 30px"
                                                 src="https://www.tekgida.org.tr/wp-content/themes/tekgidais/img/linkedin.png">
                                        </a>

                                    </div>
                                    <div class="col-6 offset-1">


                                        <a target="_blank" style="color:#0077b5" href="http://tekgida.is/6sm">
                                            <span style="font-size: 16px; margin-left:2px">Tekgıda-İş</span></a>

                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>


</footer>
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script type="text/javascript">
    /// some script

    // jquery ready start
    $(document).ready(function () {
        // jQuery code
        let ta = '';
        //////////////////////// Prevent closing from click inside dropdown
        $(document).on('click', '.dropdown-menu', function (e) {
            e.preventDefault();
            e.stopPropagation();
        });


        // make it as accordion for smaller screens
        if ($(window).width() < 992) {
            $('.dropdown-menu a').click(function (e) {

                if ($(this).next('.submenu').length) {
                    $(this).next('.submenu').toggle();
                }
                $('.dropdown').on('hide.bs.dropdown', function () {
                    $(this).find('.submenu').hide();
                })
            });
        }
        $(document).on('click', '.dropdown-menu', function (e) {
            e.preventDefault();
           console.log(e.target.attributes.href.value);
            if(e.target.attributes.href.value != '#'){
                window.location.href = e.target.href;
            }
        });


    }); // jquery end
</script>
<style type="text/css">
    @media (min-width: 992px) {
        .dropdown-menu .dropdown-toggle:after {
            border-top: .3em solid transparent;
            border-right: 0;
            border-bottom: .3em solid transparent;
            border-left: .3em solid;
        }

        .dropdown-menu .dropdown-menu {
            margin-left: 0;
            margin-right: 0;
        }

        .dropdown-menu li {
            position: relative;
        }

        .nav-item .submenu {
            position: absolute;
            left: 100%;
            top: -7px;
        }

        .nav-item .submenu-left {
            right: 100%;
            left: auto;
        }

        .dropdown-menu > li:hover {
            background-color: #f1f1f1
        }

        .dropdown-menu > li:hover > .submenu {
            display: block;
        }
    }
</style>
<script>


    $('li.nav-item.submenu-li').mouseover(function () {

        if ($(window).width() > 992) {

            $('.submenu').css("display", "none");
            $('#parent-' + $(this).attr("data-id")).css("display", "block");
            console.log($(this).attr("data-id"))
        }
    });

    function modalopen(id) {


        $('#myModal-' + id).modal('show');


    }

    function modalclose1() {


        $('#sosyalmodal').modal('hide');


    }

    function modalclose(id) {

        $('#myModal-' + id).modal('hide');

        $('.youtube-iframe').each(function (index) {
            $(this).attr('src', $(this).attr('src'));

        });
    }


</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<!-- Global site tag (gtag.js) - Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-93666244-1"></script>

<script>

    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());


    gtag('config', 'UA-93666244-1');

</script>

<!--

	<?php wp_nav_menu( array( 'theme_location' => 'footer-1' ) ); ?>

	-->


<?php echo wp_footer(); ?>
<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.cookie.js"></script>
<?php if ( $post->ID != 57398 ) { ?>
    <script>

        $(document).ready(function () {


            if ($.cookie('modal_shown') == null) {
                $.cookie('modal_shown', 'yes', {expires: 1, path: '/'});
                $('#sosyalmodal').modal('show');
            }


        });


        function getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        $(document).ready(function () {

            let like = getCookie("<?php echo $post->ID; ?>");

            if (like == 1 || $.cookie('modal_shown') == 1) {

                document.getElementById("likeicon").classList.add('fa-check');
                document.getElementById("likeicon").classList.remove('fa-thumbs-up');
                document.getElementById("likebutton1").classList.add('liked');
                document.getElementById("likebutton1").disabled = true;

            }


        });

        async function like(POSTID) {

            await jQuery.ajax({
                type: "post",
                dataType: "json",
                url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
                data: {
                    action: 'like',
                    text: POSTID,
                },
                success: function (msg) {

                    console.log(msg.like)
                    document.getElementById("likebutton").innerHTML = msg.like;
                    document.getElementById("likeicon").classList.add('fa-check');
                    document.getElementById("likeicon").classList.remove('fa-thumbs-up');
                    document.getElementById("likebutton1").classList.add('liked');
                    document.getElementById("likebutton1").disabled = true;
                    document.cookie = POSTID + "=1";
                    $.cookie(POSTID, 1, {expires: 365, path: '/'});


                }
            });

        }


    </script>
<?php } ?>
<script type='text/javascript'
        src='http://tekgida.org.tr/wp-content/plugins/lightbox-gallery/js/jquery.colorbox.js?ver=5.6'
        id='colorbox-js'></script>
<script type='text/javascript'
        src='http://tekgida.org.tr/wp-content/plugins/lightbox-gallery/js/jquery.tooltip.js?ver=5.6'
        id='tooltip-js'></script>
<script type='text/javascript'
        src='http://tekgida.org.tr/wp-content/plugins/lightbox-gallery/lightbox-gallery.js?ver=5.6'
        id='lightbox-gallery-js'></script>
</body></html>



