
<div class="card">
    <!-- <form> -->
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Cuentas Read</h2> -->
        <h5 class="text-left" style="margin-top:0px"><?php echo $page ?> <i class="fas fa-angle-down" style="float: right;"></i></h5>
    </div>
    <div class="card-body">
        <!-- <h6 class="card-title">Titulo <i class="fas fa-sort-alpha-down"></i></h6> -->
        <!-- <p class="card-text">Best ugg boots on the planet. Free shipping, 24/7 customer service.</p>-->
        <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Nombre_Cue'); ?> <?php echo form_error('Nombre_Cue') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Nombre_Cue" id="Nombre_Cue" placeholder="" value="<?=$Nombre_Cue; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Cuenta_Cue'); ?> <?php echo form_error('Cuenta_Cue') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Cuenta_Cue" id="Cuenta_Cue" placeholder="" value="<?=$Cuenta_Cue; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Consecutivo_Cue'); ?> <?php echo form_error('Consecutivo_Cue') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Consecutivo_Cue" id="Consecutivo_Cue" placeholder="" value="<?=$Consecutivo_Cue; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('FechaRegistro_Cue'); ?> <?php echo form_error('FechaRegistro_Cue') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="FechaRegistro_Cue" id="FechaRegistro_Cue" placeholder="" value="<?=$FechaRegistro_Cue; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Id_NatCue'); ?> <?php echo form_error('Id_NatCue') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Id_NatCue" id="Id_NatCue" placeholder="" value="<?=$Id_NatCue; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Id_CueEst'); ?> <?php echo form_error('Id_CueEst') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Id_CueEst" id="Id_CueEst" placeholder="" value="<?=$Id_CueEst; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Id_CueTip'); ?> <?php echo form_error('Id_CueTip') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Id_CueTip" id="Id_CueTip" placeholder="" value="<?=$Id_CueTip; ?>" readonly/>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Id_Cue_CuentaPadre"><?=t('Id_Cue_CuentaPadre'); ?> <?php echo form_error('Id_Cue_CuentaPadre') ?></label>
                    <select name="Id_Cue_CuentaPadre" id="Id_Cue_CuentaPadre" class="form-control selectpicker" data-live-search="true" disabled>
                        <option value="">Seleccione</option>
                        <?php
                        foreach($all_cuentas as $cuentas)
                        { 
                            $print_value =  $cuentas->Cuenta_Cue;
                            $selected = ($cuentas->Id_Cue==$Id_Cue_CuentaPadre) ? 'selected':'';
                            echo '<option value="'.$cuentas->Id_Cue.'"  '.$selected.'> '.$print_value.'</option>';
                        } ?>
                    </select>
                </div>
	
        </div>
    </div>

    <div class="card-footer text-right">
        <a href="<?php echo site_url($this->view) ?>" class="btn btn-danger">Cancelar </a>
        <?php /* ?>
        <a href="<?php echo site_url($this->view.'/update/'.$id_update) ?>" class="btn btn-info">Actualizar</a> <?php */ ?>
    </div>
    <!--</form>-->
</div>
<?php $this->load->view('footer'); ?>