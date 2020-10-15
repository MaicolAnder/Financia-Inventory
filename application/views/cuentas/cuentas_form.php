
<div class="card">
    <form action="<?php echo $action; ?>" method="post">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Cuentas </h2> -->
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
                <label for="Nombre_Cue"><?=t('Nombre_Cue'); ?> <?php echo form_error('Nombre_Cue') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Nombre_Cue" id="Nombre_Cue" placeholder="Nombre Cue" value="<?php echo $Nombre_Cue; ?>" />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Cuenta_Cue"><?=t('Cuenta_Cue'); ?> <?php echo form_error('Cuenta_Cue') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Cuenta_Cue" id="Cuenta_Cue" placeholder="Cuenta Cue" value="<?php echo $Cuenta_Cue; ?>" />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Consecutivo_Cue"><?=t('Consecutivo_Cue'); ?> <?php echo form_error('Consecutivo_Cue') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Consecutivo_Cue" id="Consecutivo_Cue" placeholder="Consecutivo" value="<?php echo $Id_Cue; ?>" />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="FechaRegistro_Cue"><?=t('FechaRegistro_Cue'); ?> <?php echo form_error('FechaRegistro_Cue') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="FechaRegistro_Cue" id="FechaRegistro_Cue" placeholder="FechaRegistro Cue" value="<?php echo $FechaRegistro_Cue; ?>" readonly/>
                </div>
            </div>
		
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Id_CueEst"><?=t('Id_CueEst'); ?> <?php echo form_error('Id_CueEst') ?></label>
                <select name="Id_CueEst" id="Id_CueEst" class="form-control selectpicker" data-live-search="true">
                    <option value="">Seleccione</option>
                    <?php
                    foreach($all_cuenta_estado as $cuenta_estado)
                    { 
                        $print_value =  $cuenta_estado->Nombre_CueEst;
                        $selected = ($cuenta_estado->Id_CueEst==$Id_CueEst) ? 'selected':'';
                        echo '<option value="'.$cuenta_estado->Id_CueEst.'"  '.$selected.'> '.$print_value.'</option>';
                    } ?>
                </select>
            </div>
		
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Id_CueTip"><?=t('Id_CueTip'); ?> <?php echo form_error('Id_CueTip') ?></label>
                <select name="Id_CueTip" id="Id_CueTip" class="form-control selectpicker" data-live-search="true">
                    <option value="">Seleccione</option>
                    <?php
                    foreach($all_cuenta_tipo as $cuenta_tipo)
                    { 
                        $print_value =  $cuenta_tipo->Nombre_CueTip;
                        $selected = ($cuenta_tipo->Id_CueTip==$Id_CueTip) ? 'selected':'';
                        echo '<option value="'.$cuenta_tipo->Id_CueTip.'"  '.$selected.'> '.$print_value.'</option>';
                    } ?>
                </select>
            </div>
		
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Id_Cue_CuentaPadre"><?=t('Id_Cue_CuentaPadre'); ?> <?php echo form_error('Id_Cue_CuentaPadre') ?></label>
                <select name="Id_Cue_CuentaPadre" id="Id_Cue_CuentaPadre" class="form-control selectpicker" data-live-search="true">
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
		
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Id_NatCue"><?=t('Id_NatCue'); ?> <?php echo form_error('Id_NatCue') ?></label>
                <select name="Id_NatCue" id="Id_NatCue" class="form-control selectpicker" data-live-search="true">
                    <option value="">Seleccione</option>
                    <?php
                    foreach($all_naturaleza_cuenta as $naturaleza_cuenta)
                    { 
                        $print_value =  $naturaleza_cuenta->Nombre_NatCue;
                        $selected = ($naturaleza_cuenta->Id_NatCue==$Id_NatCue) ? 'selected':'';
                        echo '<option value="'.$naturaleza_cuenta->Id_NatCue.'"  '.$selected.'> '.$print_value.'</option>';
                    } ?>
                </select>
            </div>
		</div>
    </div>

    <div class="card-footer text-right">
        
	    <input type="hidden" name="Id_Cue" value="<?php echo $Id_Cue; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('cuentas') ?>" class="btn btn-danger">Cancelar</a>
    </div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    