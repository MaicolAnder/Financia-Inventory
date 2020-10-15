<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Margun software">
    <meta name="keywords" content="Pro salud, Margun Software, Autorizaciones de salud, Pertinencias médicas">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Pro salud, Margun software, margunsoft.com">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <meta name="description" content="Software en la nube para autorizaciones médicas de salud, afliación y registro, contratacion con IPS, pertinencias médicas internas y externas.">
      

    <title>Solicitud de pertinencia | ProSalud</title>
    <?= css('bootstrap.min.css') ?>
    <?= css('fontawesome.min.css') ?>
    <?= css('all.min.css') ?>
    <?= css('datatables.min.css') ?>
    <?= css('bootstrap-select.min.css') ?>
    <?= css('jquery.mCustomScrollbar.min.css') ?>
    <?= css('jquery-ui.css') ?>
    <style type="text/css">
        .red-star{
    color: red;
}
    </style>
</head>
<body background="<?php // echo img_url().'app/mbr-1920x1225.jpg'; ?>">
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-dark bg-dark fixed-top">                 
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="navbar-toggler-icon"></span>
        </button> <a class="navbar-brand" href="#">Pro Salud</a>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="navbar-nav"> 
                <!--
                <li class="nav-item active">
                     <a class="nav-link" href="#">Bienvenido <span class="sr-only">(current)</span></a>
                </li>
                
                <li class="nav-item">
                     <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown">Dropdown link</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                         <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider">
                        </div> <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </li>
            </ul>
            
            <form class="form-inline">
                <input class="form-control mr-sm-2" type="text" /> 
                <button class="btn btn-primary my-2 my-sm-0" type="submit">
                    Search
                </button>
            </form> -->
            <ul class="navbar-nav ml-md-auto">
                <li class="nav-item active">
                     <a class="nav-link" href="<?php echo site_url('auth') ?>">Ingresar <span class="sr-only">(current)</span></a>
                </li> <!--
                <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown">Dropdown link</a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                         <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider">
                        </div> <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </li> -->
            </ul>
        </div>
    </nav>
    <div style="margin-top: 65px;">
<?php                 
if(isset($_view) && $_view){
    $this->load->view("".$_view);
} ?>
    </div>
<div class="footer container-fluid">
    <address>
         <strong>Margun software.</strong><br /> Soluciones tecnlógicas <br /> Popayán, Colombia <?php echo date('Y') ?> CA 94107<br /> <abbr title="Phone">P:</abbr> (123) 456-7890
    </address>
</div>
</body>
<?=js('jquery.min.js')?>
<?=js('popper.min.js')?>
<?=js('bootstrap.min.js')?>
<?=js('fontawesome.min.js')?>
<?=js('jquery.mCustomScrollbar.concat.min.js')?>
<?=js('bootstrap-select.min.js')?>
<?=js('jquery.form.js')?>
<?=js('jquery.validate.min.js')?>
<?=js('additional-methods.min.js')?>
<?=js('bootbox.all.min.js')?> 
<?=js('notify.js')?>
<?=js('jquery-ui.js')?>
<?=js('select2.min.js')?>
<script type="text/javascript">
    $(document).ready(function () {
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        $(window).scroll(function() {
            /*height in pixels when the navbar becomes non opaque*/
            if($(this).scrollTop() > 50) {
                $('.opaque-navbar').addClass('opaque');
            } else {
                $('.opaque-navbar').removeClass('opaque');
            }
        });
        $("label.required").append('<span class="red-star"> *</span>');
    });
</script>