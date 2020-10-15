
<div class="card">
    <!-- <form> -->
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Persona Read</h2> -->
        <h5 class="text-left" style="margin-top:0px"><?php echo $page ?> <i class="fas fa-angle-down" style="float: right;"></i></h5>
    </div>
    <div class="card-body">
        <!-- <h6 class="card-title">Titulo <i class="fas fa-sort-alpha-down"></i></h6> -->
        <!-- <p class="card-text">Best ugg boots on the planet. Free shipping, 24/7 customer service.</p>-->
        <div class="row">
                
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Nombre1_Per'); ?> <?php echo form_error('Nombre1_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Nombre1_Per" id="Nombre1_Per" placeholder="" value="<?=$Nombre1_Per; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Nombre2_Per'); ?> <?php echo form_error('Nombre2_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Nombre2_Per" id="Nombre2_Per" placeholder="" value="<?=$Nombre2_Per; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Apeliido1_Per'); ?> <?php echo form_error('Apeliido1_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Apeliido1_Per" id="Apeliido1_Per" placeholder="" value="<?=$Apeliido1_Per; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Apellido2_Per'); ?> <?php echo form_error('Apellido2_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Apellido2_Per" id="Apellido2_Per" placeholder="" value="<?=$Apellido2_Per; ?>" readonly/>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Identificacion_Per'); ?> <?php echo form_error('Identificacion_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Identificacion_Per" id="Identificacion_Per" placeholder="" value="<?=$Identificacion_Per; ?>" readonly/>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Id_PerTipId'); ?> <?php echo form_error('Id_PerTipId') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Id_PerTipId" id="Id_PerTipId" placeholder="" value="<?=$Id_PerTipId; ?>" readonly/>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Telefono_Per'); ?> <?php echo form_error('Telefono_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Telefono_Per" id="Telefono_Per" placeholder="" value="<?=$Telefono_Per; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('TelCelular_Per'); ?> <?php echo form_error('TelCelular_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="TelCelular_Per" id="TelCelular_Per" placeholder="" value="<?=$TelCelular_Per; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label class="required" for="Id_Con"><?=t('Correo_Per'); ?> <?php echo form_error('Correo_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Correo_Per" id="Correo_Per" placeholder="" value="<?=$Correo_Per; ?>" readonly/>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Id_PerGen'); ?> <?php echo form_error('Id_PerGen') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Id_PerGen" id="Id_PerGen" placeholder="" value="<?=$Id_PerGen; ?>" readonly/>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('FechaNacimiento_Per'); ?> <?php echo form_error('FechaNacimiento_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="FechaNacimiento_Per" id="FechaNacimiento_Per" placeholder="" value="<?=$FechaNacimiento_Per; ?>" readonly/>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Id_PerTip'); ?> <?php echo form_error('Id_PerTip') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Id_PerTip" id="Id_PerTip" placeholder="" value="<?=$Id_PerTip; ?>" readonly/>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Id_PerEst'); ?> <?php echo form_error('Id_PerEst') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Id_PerEst" id="Id_PerEst" placeholder="" value="<?=$Id_PerEst; ?>" readonly/>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Direccion_Per'); ?> <?php echo form_error('Direccion_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Direccion_Per" id="Direccion_Per" placeholder="" value="<?=$Direccion_Per; ?>" readonly/>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Celular_Per'); ?> <?php echo form_error('Celular_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Celular_Per" id="Celular_Per" placeholder="" value="<?=$Celular_Per; ?>" readonly/>
                    </div>
                </div>
                
                
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Id_Mun'); ?> <?php echo form_error('Id_Mun') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Id_Mun" id="Id_Mun" placeholder="" value="<?=$Id_Mun; ?>" readonly/>
                    </div>
                </div>

                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Id_Emp'); ?> <?php echo form_error('Id_Emp') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Id_Emp" id="Id_Emp" placeholder="" value="<?=$Id_Emp; ?>" readonly/>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('FechaRegistro_Per'); ?> <?php echo form_error('FechaRegistro_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="FechaRegistro_Per" id="FechaRegistro_Per" placeholder="" value="<?=$FechaRegistro_Per; ?>" readonly/>
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