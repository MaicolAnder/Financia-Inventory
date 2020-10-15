<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>  
        <div style="width: 100%; padding: 2rem;">
            <footer class="container-fluid">
                <small>Desging by: Maicol A. Tunubalá. <a href=""> www.margunsoft.com,</a>  <?=date('Y')?> | Page rendered in <strong>{elapsed_time}</strong> seconds.</small>
            </footer>
        </div>
    </div>
</div>
<?=js('jquery.min.js')?>
<?=js('popper.min.js')?>
<?=js('bootstrap.min.js')?>
<!--
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script> -->

<?=js('fontawesome.min.js')?>
<?=js('jquery.mCustomScrollbar.concat.min.js')?>
<?=js('pdfmake.min.js')?>
<?=js('vfs_fonts.js')?>
<?=js('solid.js')?>
<?=js('desing.js')?>
<?=js('datatables.min.js')?>
<?=js('jquery.dataTables.min.js')?>
<?=js('dataTables.bootstrap4.min.js')?>
<?=js('bootstrap-select.min.js')?>
<?=js('jquery.form.js')?>
<?=js('jquery.validate.min.js')?>
<?=js('additional-methods.min.js')?>
<?=js('bootbox.all.min.js')?> 
<?=js('notify.js')?>
<?=js('gijgo.min.js')?>
<?=js('jquery-ui.js')?>
<?=js('select2.min.js')?> 
<?=js('chart.min.js')?> 

<script type="text/javascript">
    $(document).ready(function () {
        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $("#table_body").mCustomScrollbar({
            theme: "minimal"
        });

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar, #content, #header-nav').toggleClass('active');
            $('#navbar-content').toggleClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
        $(window).scroll(function() {
            /*height in pixels when the navbar becomes non opaque*/
            if($(this).scrollTop() > 50) {
                $('.opaque-navbar').addClass('opaque');
            } else {
                $('.opaque-navbar').removeClass('opaque');
            }
        });
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        $("label.required").append('<span class="red-star"> *</span>');
        // $("legend").prepend('<i class="fas fa-align-justify"></i> ')
    });
    /*
    jQuery(document).ready(function() {
        jQuery("[required]").after("<span class='required'>*</span>");
    });
    */
    // $(document).ready(function() { $('body').bootstrapMaterialDesign(); }); -->
</script>

