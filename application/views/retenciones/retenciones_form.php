
<div class="card">
    <form action="<?php echo $action; ?>" method="post">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Retenciones </h2> -->
        <h5 class="text-left" style="margin-top:0px"><?php echo $page ?> <i class="fas fa-angle-down" style="float: right;"></i></h5>
    </div>
    <div class="text-center" style="margin-top: 0px"  id="message">              
        <?php echo $this->session->userdata('message') <> '' ? '<div class="alert alert-info alert-dismissible fade show" role="alert" style="border-radius: .0rem;"><strong>'.$this->session->userdata('message').'</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' : ''; ?>
    </div>
    <div class="card-body">
        <!-- <h6 class="card-title">Titulo <i class="fas fa-sort-alpha-down"></i></h6> -->
        <!-- <p class="card-text">Best ugg boots on the planet. Free shipping, 24/7 customer service.</p>-->
        <div class="row">
        
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Nombre_Ret"><?=t('Nombre_Ret'); ?> <?php echo form_error('Nombre_Ret') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Nombre_Ret" id="Nombre_Ret" placeholder="Nombre Ret" value="<?php echo $Nombre_Ret; ?>" />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Porcentaje_Ret"><?=t('Porcentaje_Ret'); ?> <?php echo form_error('Porcentaje_Ret') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Porcentaje_Ret" id="Porcentaje_Ret" placeholder="Porcentaje Ret" value="<?php echo $Porcentaje_Ret; ?>" />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="Descripcion_Ret"><?=t('Descripcion_Ret'); ?> <?php echo form_error('Descripcion_Ret') ?></label>
                <textarea class="form-control" rows="3" name="Descripcion_Ret" id="Descripcion_Ret" placeholder="Descripcion Ret"><?php echo $Descripcion_Ret; ?></textarea>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="FechaRegistro_Ret"><?=t('FechaRegistro_Ret'); ?> <?php echo form_error('FechaRegistro_Ret') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="FechaRegistro_Ret" id="FechaRegistro_Ret" placeholder="FechaRegistro Ret" value="<?php echo $FechaRegistro_Ret; ?>" />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Estado_Ret"><?=t('Estado_Ret'); ?> <?php echo form_error('Estado_Ret') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Estado_Ret" id="Estado_Ret" placeholder="Estado Ret" value="<?php echo $Estado_Ret; ?>" />
                </div>
            </div>
		
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Id_Cue_Ventas"><?=t('Id_Cue_Ventas'); ?> <?php echo form_error('Id_Cue_Ventas') ?></label>
                <select name="Id_Cue_Ventas" id="Id_Cue_Ventas" class="form-control selectpicker" data-live-search="true">
                    <option value="">Seleccione</option>
                    <?php
                    foreach($all_cuentas as $cuentas)
                    { 
                        $print_value =  $cuentas->Id_Cue;
                        $selected = ($cuentas->Id_Cue==$Id_Cue_Ventas) ? 'selected':'';
                        echo '<option value="'.$cuentas->Id_Cue.'"  '.$selected.'> '.$print_value.'</option>';
                    } ?>
                </select>
            </div>
		
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Id_Cue_Compras"><?=t('Id_Cue_Compras'); ?> <?php echo form_error('Id_Cue_Compras') ?></label>
                <select name="Id_Cue_Compras" id="Id_Cue_Compras" class="form-control selectpicker" data-live-search="true">
                    <option value="">Seleccione</option>
                    <?php
                    foreach($all_cuentas as $cuentas)
                    { 
                        $print_value =  $cuentas->Id_Cue;
                        $selected = ($cuentas->Id_Cue==$Id_Cue_Compras) ? 'selected':'';
                        echo '<option value="'.$cuentas->Id_Cue.'"  '.$selected.'> '.$print_value.'</option>';
                    } ?>
                </select>
            </div>
		
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Id_RetTip"><?=t('Id_RetTip'); ?> <?php echo form_error('Id_RetTip') ?></label>
                <select name="Id_RetTip" id="Id_RetTip" class="form-control selectpicker" data-live-search="true">
                    <option value="">Seleccione</option>
                    <?php
                    foreach($all_retencion_tipo as $retencion_tipo)
                    { 
                        $print_value =  $retencion_tipo->Id_RetTip;
                        $selected = ($retencion_tipo->Id_RetTip==$Id_RetTip) ? 'selected':'';
                        echo '<option value="'.$retencion_tipo->Id_RetTip.'"  '.$selected.'> '.$print_value.'</option>';
                    } ?>
                </select>
            </div>
		</div>
    </div>

    <div class="card-footer text-right">
        
	    <input type="hidden" name="Id_Ret" value="<?php echo $Id_Ret; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('retenciones') ?>" class="btn btn-danger">Cancelar</a>
    </div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    