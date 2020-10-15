<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$resources['page'] = (isset($page)) ? $page : '' ;
$resources['module'] = (isset($module)) ? $module : '' ;
$this->load->view('header.php',$resources); 
?>
<div class="row">
    <div class="col-md-3 col-sm-12">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-warning with-all btn-lg" href="<?=site_url('mensajes/create')?>"><i class="fas fa-comments"></i> Nuevo mensaje</a>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="<?=site_url('mensajes')?>" >Bandeja de entrada
                        <span class="badge badge-primary badge-pill">14</span></a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="<?=site_url('mensajes/tasks')?>" >Tareas pendientes
                        <span class="badge badge-primary badge-pill">2</span></a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="<?=site_url('mensajes/public')?>" >Mensajes públicos
                        <span class="badge badge-primary badge-pill">1</span></a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="<?=site_url('mensajes/borrados')?>" >Eliminados
                        <span class="badge badge-primary badge-pill">2</span></a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                       <a href="<?=site_url('mensajes/contactos')?>" >Contactos
                        <span class="badge badge-primary badge-pill">1</span></a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <div class="col-md-9 col-sm-12">
        <?php 
        if(isset($_view) && $_view){
            $this->load->view($_view);
        }
        ?>
    </div>
</div>
<?php $this->load->view('footer'); ?>