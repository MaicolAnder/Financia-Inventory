<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Financia">
    <meta name="author" content="Financia">
    <meta name="keywords" content="Financia">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/logos/facturacion_Financia') ?>.png" />

    <title><?= $page ?> - Facturación Financia</title>
    <?= css('bootstrap.min.css') ?>
    <!--
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">  -->
    <?= css('fontawesome.min.css') ?>
    <?= css('all.min.css') ?>
    <?= css('datatables.min.css') ?>
    <?= css('bootstrap-grid.min.css') ?>
    <?= css('bootstrap-reboot.min.css') ?>
    <?= css('bootstrap-select.min.css') ?>
    <?= css('jquery.mCustomScrollbar.min.css') ?>
    <?= css('dataTables.bootstrap4.min.css') ?>
    <?= css('site-demos.css') ?>
    <?= css('gijgo.min.css') ?>
    <?= css('animate.css') ?>
    <?= css('select2.min.css') ?>
    <?= css('jquery-ui.css') ?>
    <?= css('desing.css') ?>
    <?= css('chart.min.css') ?>
    <script type="text/javascript">
        const base_url = '<?= site_url(); ?>';
    </script>

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="active">
            <div class="sidebar-header">
                <h3>
                    <div class="text-center">
                        <div class="text-center" onclick="window.location.href='<?php echo site_url(); ?>'">
                            <img style="width: 50%" src="<?php echo site_url(); ?>assets/img/users/user.png" class="img-circle" alt="User Image">
                        </div>
                        <p style="font-size: 1.2rem">
                            <?php
                            echo $this->session->userdata('nombres'); ?>
                            <br>
                            <small style="font-size: .85rem;"><?php echo $this->session->userdata('Email_Usu'); ?></small>
                        </p>
                    </div>
                </h3>
                <strong><img src="<?php echo base_url('assets/img/logos/facturacion_Financia') ?>.png" style="width: 55px;"></strong>
            </div>

            <ul class="list-unstyled components nav navbar-nav">

                <?php 
                $menu = $this->session->userdata('menu');
                // ver_array($menu);
                ?>
                <?php // if (in_array('ventas', $menu)): ?>
                    <li class="nav-item">
                        <a href="#menuIngreso" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle <?php echo (($this->uri->segment(1)=='documento'||$this->uri->segment(1)=='transacciones') &&($this->uri->segment(3)=='income' || $this->uri->segment(3)=='quotes')) ? 'active-menu' : '' ;?>"><i class="fas fa-chalkboard-teacher"></i> Ventas</a>
                        <ul class="collapse list-unstyled dropdown nav-submenu" id="menuIngreso">
                            <li>
                                <a class="" href="<?php echo site_url('documento/create/income'); ?>">Crear factura de venta</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('transacciones/create/income'); ?>">Crear nuevo Ingreso</a>
                            </li>
                            <li><div class="dropdown-divider" style="margin: .0rem 0;"></div></li>
                            <li>
                                <a href="<?php echo site_url('documento/listar/income'); ?>">Listado facturas de ventas</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('transacciones/listar/income'); ?>">Listado de Ingresos</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('documento/quotes/income'); ?>">Listado de cotizaciones</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('documento/listar/referrals'); ?>">Listado de remisiones</a>
                            </li>

                            <li>
                                <a href="<?php echo site_url(); ?>">Listado de nota de crédito</a>
                            </li>
                            
                        </ul>
                    </li>
                <?php // endif ?>
                <?php //if (in_array('compras', $menu)): ?>
                    <li class="nav-item">
                        <a href="#menuCompras" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle <?php echo (($this->uri->segment(1)=='documento'||$this->uri->segment(1)=='transacciones') && $this->uri->segment(3)=='expenses') ? 'active-menu' : '' ;?>"><i class="fas fa-cart-plus"></i> Compras</a>
                        <ul class="collapse list-unstyled nav-submenu" id="menuCompras">
                            <li>
                                <a href="<?php echo site_url('documento/create/expenses'); ?>">Crear factura de compra</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('transacciones/create/expenses'); ?>">Crear pagos/Egresos</a>
                            </li>
                            <li><div class="dropdown-divider" style="margin: .0rem 0;"></div></li>
                            <li>
                                <a href="<?php echo site_url('documento/listar/expenses'); ?>">Listado facturas de compra</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('transacciones/listar/expenses'); ?>">Listado de egresos</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('documento/listar/purchase_order'); ?>">Listado de órdenes de compra</a>
                            </li>

                            <li>
                                <a href="<?php echo site_url('documento/nota-credito'); ?>">Listado de nota de débito</a>
                            </li>
                        </ul>
                    </li>
                <?php //endif ?>
                <?php //if (in_array('inventario', $menu)): ?>
                    <li class="nav-item">
                    <a href="#menuInventarios" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link  <?php echo ($this->uri->segment(1)=='items') ? 'active-menu' : '' ;?>"><i class="fas fa-network-wired"></i> Inventario</a>
                    <ul class="collapse list-unstyled nav-submenu" id="menuInventarios">
                        <li>
                            <a href="<?= site_url('items/create'); ?>">Nuevo item</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('items'); ?>">Listado de items</a>
                        </li>
                        <li>
                            <a href="<?= site_url('items/ajuste-inventario'); ?>">Ajuste inventario</a>
                        </li>
                        <li>
                            <a href="<?= site_url('categoria_item'); ?>">Categoria de items</a>
                        </li>
                        <li>
                            <a href="<?= site_url('bodegas'); ?>">Listado de bodegas</a>
                        </li>
                        <li>
                            <a href="<?= site_url('lista_precios'); ?>">Listado de precios</a>
                        </li>
                    </ul>
                </li>
                <?php // endif ?> 
                <?php // if (in_array('contactos', $menu)): ?>
                    <li class="nav-item">
                    <a href="#menuContactos" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle <?php echo ($this->uri->segment(1)=='persona') ? 'active-menu' : '' ;?>"><i class="fas fa-users"></i> Contactos</a>
                    <ul class="collapse list-unstyled nav-submenu" id="menuContactos">
                        <li>
                            <a href="<?php echo site_url('persona/create/cliente'); ?>">Nuevo cliente</a>
                        </li>
                        <li>
                            <a href="<?= site_url('persona/create/proveedor'); ?>">Nuevo proveedor</a>
                        </li>
                        <li>
                            <a href="<?= site_url('persona'); ?>">Todos los contactos</a>
                        </li>
                    </ul>
                </li>
                <?php // endif ?>                
                <?php // if (in_array('bancos', $menu)): ?>
                    <li class="nav-item">
                        <a href="#menuBancos" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle <?php echo ($this->uri->segment(1)=='bancos') ? 'active-menu' : '' ;?>"><i class="fas fa-list-alt"></i> Bancos</a>
                        <ul class="collapse list-unstyled nav-submenu" id="menuBancos">
                            <li>
                                <a href="<?php echo site_url('bancos/create'); ?>"><span class="fas fa-dot-circle"></span> Nuevo banco</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('bancos'); ?>"><span class="fas fa-dot-circle"></span> Listado de bancos</a>
                            </li>
                        </ul>
                    </li>
                <?php // endif ?>
                <?php // if (in_array('contabilidad', $menu)): ?>
                    <li class="nav-item">
                        <a href="#menuContabilidad" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle <?php echo ($this->uri->segment(1)=='cuentas' || $this->uri->segment(1)=='impuestos') ? 'active-menu' : '' ;?>"><i class="fas fa-laptop-medical"></i> Contabilidad</a>
                        <ul class="collapse list-unstyled nav-submenu" id="menuContabilidad">
                            <li>
                                <a href="<?php echo site_url('cuentas'); ?>">Catalogo de cuentas</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('cuentas'); ?>">Saldos iniciales]</a>
                            </li>
                            <li>
                                <a href="<?= site_url('cuentas'); ?>">Asientos contables</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('cuentas'); ?>">Información exógena</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('impuestos'); ?>">Impuestos</a>
                            </li>

                        </ul>
                    </li>
                <?php // endif ?>
                <?php //if (in_array('reportes', $menu)): ?>
                    <li class="nav-item">
                        <a href="#reportes" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle <?php echo ($this->uri->segment(1)=='reportes') ? 'active-menu' : '' ;?>"><i class="fas fa-list-alt"></i> Reportes</a>
                        <ul class="collapse list-unstyled nav-submenu" id="reportes">
                            <li>
                                <a href="<?php echo site_url('reportes'); ?>">Listado de reportes</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('reportes/create'); ?>">Crear nuevo reporte</a>
                            </li>
                        </ul>
                    </li>
                <?php //endif ?>
            </ul>
            <ul class="list-unstyled CTAs">
                <li>
                    <a href="<?php echo site_url('pos') ?>" class="download">Ventas POS</a>
                </li>
                <li>
                    <a href="<?php echo site_url('auth/logout') ?>" class="article">Cerrar sessión</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="active">
            <nav class="navbar navbar-expand-md navbar-light bg-light active" id="header-nav">
                <div class="container-fluid">

                    <!-- <button type="button" id="sidebarCollapse" class="btn btn-link">
                        <!-- <i class="fas fa-align-justify"></i>
                    </button> -->
                    <i id="sidebarCollapse" title="Mostra/Ocultar" class="fas fa-chevron-circle-left fa-2x color-danger"></i>
                    <button class="btn btn-primary d-inline-block d-md-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdownNotifiaciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell fa-lg color-danger"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownNotifiaciones" style="padding: .0rem 0;">
                                    <div class="card-header text-center">
                                        <h6 class="card-title">Notificaciones</h6>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <i class="fas fa-bell fa-lg color-success"></i> <strong>De Carito,</strong> mensaje leído</li>
                                        <li class="list-group-item">
                                            <i class="fas fa-bell fa-lg color-warning"></i> <strong>De Carito,</strong> mensaje no leído</li></li>
                                        <li class="list-group-item">
                                            <i class="fas fa-bell fa-lg color-warning"></i> <strong>De Carito,</strong> mensaje no leído</li></li>
                                        <li class="list-group-item">
                                            <i class="fas fa-bell fa-lg color-success"></i> <strong>De Carito,</strong> mensaje leído</li>
                                        <li class="list-group-item">
                                            <i class="fas fa-bell fa-lg color-warning"></i> <strong>De Carito,</strong> mensaje no leído</li></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdownMensajes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-envelope fa-lg color-warning"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMensajes" style="padding: .0rem 0;">
                                    <div class="card-header text-center">
                                        <h6 class="card-title">Mensajes</h6>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <i class="fas fa-envelope-open-text fa-lg color-success"></i> <strong>De Carito,</strong> mensaje leído</li>
                                        <li class="list-group-item">
                                            <i class="fas fa-envelope-open fa-lg color-warning"></i> <strong>De Carito,</strong> mensaje no leído</li></li>
                                        <li class="list-group-item">
                                            <i class="fas fa-envelope-open fa-lg color-warning"></i> <strong>De Carito,</strong> mensaje no leído</li></li>
                                        <li class="list-group-item">
                                            <i class="fas fa-envelope-open-text fa-lg color-success"></i> <strong>De Carito,</strong> mensaje leído</li>
                                        <li class="list-group-item">
                                            <i class="fas fa-envelope-open fa-lg color-warning"></i> <strong>De Carito,</strong> mensaje no leído</li></li>
                                    </ul>
                                    <div class="card-footer background-color-warning">
                                        <a href="<?=site_url('mensajes');?>"><h6 class="text-center"><i class="fas fa-inbox"></i> Ver bandeja de entrada</h6></a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="dropdown show dropleft w-300">
                                <a class="" href="#" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false" title="Ver menú">
                                    <i class="btn-outline-primary fas fa-user-circle fa-2x"></i></a>
                                    <div class="dropdown-menu w-300" aria-labelledby="dropdownMenuLink">
                                        <form class="px-4 py-3 w-300">
                                            <!-- User image -->
                                            <li class="user-header text-center">
                                                <img style="width: 160px" src="<?php echo site_url(); ?>assets/img/users/user.png" class="img-circle" alt="User ventas Financia"><br>
                                                <p>
                                                    <?php
                                                    echo $this->session->userdata('nombres') . "
                                                                    "; ?>
                                                    
                                                    <div class="dropdown-divider"></div>
                                                    <?php
                                                    echo $this->session->userdata('Email_Usu') . "<br><small>";
                                                    echo $this->session->userdata('Descripcion_Rol') . "<br>"; ?>
                                                    Popayán. <?php echo date('Y'); ?></small>
                                                </p>
                                            </li>
                                            <div class="dropdown-divider"></div>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <button type="button" onclick="window.location='<?php echo site_url('usuario') ?>'" class="btn btn-secondary">Usuarios</button>
                                                <button type="button" class="btn btn-secondary" onclick="window.location='<?php echo site_url('configuracion') ?>'">Ajustes</button>
                                            </div>
                                            <li class="user-footer text-center">
                                                <br>
                                                    <a href="<?php echo site_url('auth/logout') ?>">
                                                        Salir <i class="fas fa-sign-in-alt"></i>
                                                    </a>
                                            </li> 
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="breadcrumb-nav">
                <nav aria-label="breadcrumb">
                    <?php
                    $label_header = $module;
                    $segmet = $this->uri->segment(3);
                    $array_segmet = array('expenses','income', 'quotes', 'referrals');
                    if (in_array($segmet, $array_segmet)) {
                        $module = $module."/listar/".$this->uri->segment(3);
                        $label_header = $this->uri->segment(3);
                    }
                    ?>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url() . strtolower($module); ?>"><?=ucfirst(label($label_header)) ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?=$page;?></li>
                    </ol>
                </nav>        
            </div>
            <!-- CONTENIDO -->
            <div class="container-fluid content-body">