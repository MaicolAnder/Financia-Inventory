
<div class="card">
    <!-- <form> -->
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Impuestos Read</h2> -->
        <h5 class="text-left" style="margin-top:0px"><?php echo $page ?> <i class="fas fa-angle-down" style="float: right;"></i></h5>
    </div>
    <div class="card-body">
        <!-- <h6 class="card-title">Titulo <i class="fas fa-sort-alpha-down"></i></h6> -->
        <!-- <p class="card-text">Best ugg boots on the planet. Free shipping, 24/7 customer service.</p>-->
        <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Nombre_Imp'); ?> <?php echo form_error('Nombre_Imp') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Nombre_Imp" id="Nombre_Imp" placeholder="" value="<?=$Nombre_Imp; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Valor_Imp'); ?> <?php echo form_error('Valor_Imp') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Valor_Imp" id="Valor_Imp" placeholder="" value="<?=$Valor_Imp; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Estado_Imp'); ?> <?php echo form_error('Estado_Imp') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Estado_Imp" id="Estado_Imp" placeholder="" value="<?=$Estado_Imp; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('FechaRegistro_Imp'); ?> <?php echo form_error('FechaRegistro_Imp') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="FechaRegistro_Imp" id="FechaRegistro_Imp" placeholder="" value="<?=$FechaRegistro_Imp; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Primary_Usu'); ?> <?php echo form_error('Primary_Usu') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Primary_Usu" id="Primary_Usu" placeholder="" value="<?=$Primary_Usu; ?>" readonly/>
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