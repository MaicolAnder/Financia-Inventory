
<div class="card">
    <!-- <form> -->
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Bodegas Read</h2> -->
        <h5 class="text-left" style="margin-top:0px"><?php echo $page ?> <i class="fas fa-angle-down" style="float: right;"></i></h5>
    </div>
    <div class="card-body">
        <!-- <h6 class="card-title">Titulo <i class="fas fa-sort-alpha-down"></i></h6> -->
        <!-- <p class="card-text">Best ugg boots on the planet. Free shipping, 24/7 customer service.</p>-->
        <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Nombre_Bod'); ?> <?php echo form_error('Nombre_Bod') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Nombre_Bod" id="Nombre_Bod" placeholder="" value="<?=$Nombre_Bod; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Codigo_Bod'); ?> <?php echo form_error('Codigo_Bod') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Codigo_Bod" id="Codigo_Bod" placeholder="" value="<?=$Codigo_Bod; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Direccion_Bod'); ?> <?php echo form_error('Direccion_Bod') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Direccion_Bod" id="Direccion_Bod" placeholder="" value="<?=$Direccion_Bod; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Descripcion_Bod'); ?> <?php echo form_error('Descripcion_Bod') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Descripcion_Bod" id="Descripcion_Bod" placeholder="" value="<?=$Descripcion_Bod; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('FechaRegistro_Bod'); ?> <?php echo form_error('FechaRegistro_Bod') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="FechaRegistro_Bod" id="FechaRegistro_Bod" placeholder="" value="<?=$FechaRegistro_Bod; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('FechaCreacion_Bod'); ?> <?php echo form_error('FechaCreacion_Bod') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="FechaCreacion_Bod" id="FechaCreacion_Bod" placeholder="" value="<?=$FechaCreacion_Bod; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Id_BodTip'); ?> <?php echo form_error('Id_BodTip') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Id_BodTip" id="Id_BodTip" placeholder="" value="<?=$Id_BodTip; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Id_BodEst'); ?> <?php echo form_error('Id_BodEst') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Id_BodEst" id="Id_BodEst" placeholder="" value="<?=$Id_BodEst; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Id_Usu'); ?> <?php echo form_error('Id_Usu') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Id_Usu" id="Id_Usu" placeholder="" value="<?=$Id_Usu; ?>" readonly/>
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