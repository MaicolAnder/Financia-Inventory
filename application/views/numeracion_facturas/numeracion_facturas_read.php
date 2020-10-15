
<div class="card">
    <!-- <form> -->
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Numeracion_facturas Read</h2> -->
        <h5 class="text-left" style="margin-top:0px"><?php echo $page ?> <i class="fas fa-angle-down" style="float: right;"></i></h5>
    </div>
    <div class="card-body">
        <!-- <h6 class="card-title">Titulo <i class="fas fa-sort-alpha-down"></i></h6> -->
        <!-- <p class="card-text">Best ugg boots on the planet. Free shipping, 24/7 customer service.</p>-->
        <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label class="required" for="Id_Con"><?=t('Nombre_NumFac'); ?> <?php echo form_error('Nombre_NumFac') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Nombre_NumFac" id="Nombre_NumFac" placeholder="" value="<?=$Nombre_NumFac; ?>" readonly/>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Prefijo_NumFac'); ?> <?php echo form_error('Prefijo_NumFac') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Prefijo_NumFac" id="Prefijo_NumFac" placeholder="" value="<?=$Prefijo_NumFac; ?>" readonly/>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Numero_NumFac"><?=t('Numero_NumFac'); ?> <?php echo form_error('Numero_NumFac') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Numero_NumFac" id="Numero_NumFac" placeholder="" value="<?=$Numero_NumFac; ?>" readonly/>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label class="required" for="Id_Con"><?=t('Resolucion_NumFac'); ?> <?php echo form_error('Resolucion_NumFac') ?></label>
                    <textarea class="form-control" name="Resolucion_NumFac" id="Resolucion_NumFac" readonly><?=$Resolucion_NumFac; ?></textarea>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Activo_NumFac'); ?> <?php echo form_error('Activo_NumFac') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Activo_NumFac" id="Activo_NumFac" placeholder="" value="<?=$Activo_NumFac; ?>" readonly/>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Defecto_NumFac'); ?> <?php echo form_error('Defecto_NumFac') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Defecto_NumFac" id="Defecto_NumFac" placeholder="" value="<?=$Defecto_NumFac; ?>" readonly/>
                    </div>
                </div>
	
        </div>
    </div>

    <div class="card-footer text-right">
        <a href="<?php echo site_url($this->view) ?>" class="btn btn-danger">Cancelar </a>
        <a href="<?php echo site_url($this->view.'/update/'.$id_update) ?>" class="btn btn-info">Actualizar</a>
    </div>
    <!--</form>-->
</div>
<?php $this->load->view('footer'); ?>