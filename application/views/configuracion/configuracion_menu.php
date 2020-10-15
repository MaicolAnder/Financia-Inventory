
    <!-- <h2 style="margin-top:0px">Configuracion Read</h2> -->
    <h4 class="text-right" style="margin-top:0px"><?php echo $page ?></h4>
    <div class="container">
        <div class="row">
             <div class="col-xl-3 col-md-6 mb-3 mb-lg-0">
                <div class="border rounded panel-white">
                    <div class="d-flex border-bottom p-3 w-100 align-items-center">
                        <h3 class="h5 mr-auto mb-0">General</h3>
                        <p class="badge badge-success mb-0">New</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <a href="<?php echo site_url('configuracion/global_varibales'); ?>"><li class="list-group-item">Variable y consecutivos</li></a>                    
                        <a href="<?php echo site_url('roles'); ?>"><li class="list-group-item">Roles</li></a>
                        <a href="<?php echo site_url('permiso'); ?>"><li class="list-group-item">Permisos</li></a>                    
                        <a href="<?php echo site_url('idioma_traductor'); ?>"><li class="list-group-item">Traducción de etiquetas</li></a>
                    </ul>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3 mb-lg-0">
                <div class="border rounded panel-white">
                    <div class="d-flex border-bottom p-3 w-100 align-items-center">
                        <h3 class="h5 mr-auto mb-0">Datos</h3>
                        <p class="badge badge-success mb-0">New</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <a href="<?php echo site_url('termino_pago'); ?>"><li class="list-group-item"><?=t('Id_TerPag')?></li></a>
                        <a href="<?php echo site_url('metodo_pago'); ?>"><li class="list-group-item"><?=t('Id_MetPag')?></li></a>
                        <a href="<?php echo site_url('retenciones'); ?>"><li class="list-group-item"><?=t('Id_Ret')?></li></a>

                    </ul>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3 mb-lg-0">
                <div class="border rounded panel-white">
                    <div class="d-flex border-bottom p-3 w-100 align-items-center">
                        <h3 class="h5 mr-auto mb-0">Numeración</h3>
                        <p class="badge badge-success mb-0">2 items</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <a href="<?php echo site_url('numeracion_documentos'); ?>"><li class="list-group-item"><?=t('Id_NumDoc')?></li></a>
                        <a href="<?php echo site_url('numeracion_facturas'); ?>"><li class="list-group-item"><?=t('Id_NumFac')?></li></a>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php /*  ?>
    <div class="row justify-content-between">
        <div class="col-12"></div>    
        <div class="col-12 text-right">
            <a href="<?php echo site_url($this->view) ?>" class="btn btn-danger">Cancelar </a> <a href="<?php echo site_url($this->view.'/update/'.$id_update) ?>" class="btn btn-info">Actualizar</a>
        </div>
    </div> 
    <?php */ ?>
        <?php $this->load->view('footer'); ?>