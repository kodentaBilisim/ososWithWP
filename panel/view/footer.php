<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script>
                2022 © Özel Sektör Öğretmenleri Sendikası
            </div>
        </div>
    </div>
</footer>
</div>
<!-- end main content-->

</div>
<!-- JAVASCRIPT -->
<script src="view/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="view/assets/libs/simplebar/simplebar.min.js"></script>
<script src="view/assets/libs/node-waves/waves.min.js"></script>
<script src="view/assets/libs/feather-icons/feather.min.js"></script>
<script src="view/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="view/assets/js/plugins.js"></script>


<!--datatable js-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="view/assets/js/pages/datatables.init.js"></script>
<!-- Sweet Alerts js -->
<script src="view/assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->
<script src="view/assets/js/pages/sweetalerts.init.js"></script>
<!-- dropzone min -->
<script src="view/assets/libs/dropzone/dropzone-min.js"></script>

<!-- filepond js -->
<script src="view/assets/libs/filepond/filepond.min.js"></script>
<script src="view/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
<script src="view/assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js"></script>
<script src="view/assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js"></script>
<script src="view/assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js"></script>

<script src="view/assets/js/pages/form-file-upload.init.js"></script>
<!-- App js -->
<script src="view/assets/js/app.js"></script>
<script src="view/assets/js/formAction.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>


    $(document).ready(function () {
        $('table#personel').DataTable({dom:"Bfrtip",buttons:["copy","csv","excel","print","pdf"]});

        //$('table#istifa').DataTable({dom:"Bfrtip",buttons:["copy","csv","excel","print","pdf"]});
    });

    $(document).ready(function () {
        $('table#example2').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.2.1/i18n/tr.json',
            },
        });
    });


</script>



</body>
</html>
