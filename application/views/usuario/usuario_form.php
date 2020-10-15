
<div class="card">
    <form action="<?php echo $action; ?>" method="post">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Usuario </h2> -->
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
                <label for="Usuario_Usu"><?=t('Usuario_Usu'); ?> <?php echo form_error('Usuario_Usu') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Usuario_Usu" id="Usuario_Usu" placeholder="Usuario Usu" value="<?php echo $Usuario_Usu; ?>" />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="Contrasena_Usu"><?=t('Contrasena_Usu'); ?> <?php echo form_error('Contrasena_Usu') ?></label>
                <textarea class="form-control" rows="3" name="Contrasena_Usu" id="Contrasena_Usu" placeholder="Contrasena Usu"><?php echo $Contrasena_Usu; ?></textarea>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="UltimoAcceso_Usu"><?=t('UltimoAcceso_Usu'); ?> <?php echo form_error('UltimoAcceso_Usu') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="UltimoAcceso_Usu" id="UltimoAcceso_Usu" placeholder="UltimoAcceso Usu" value="<?php echo $UltimoAcceso_Usu; ?>" />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="UltimaContrasena_Usu"><?=t('UltimaContrasena_Usu'); ?> <?php echo form_error('UltimaContrasena_Usu') ?></label>
                <textarea class="form-control" rows="3" name="UltimaContrasena_Usu" id="UltimaContrasena_Usu" placeholder="UltimaContrasena Usu"><?php echo $UltimaContrasena_Usu; ?></textarea>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="KeyPago_Usu"><?=t('KeyPago_Usu'); ?> <?php echo form_error('KeyPago_Usu') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="KeyPago_Usu" id="KeyPago_Usu" placeholder="KeyPago Usu" value="<?php echo $KeyPago_Usu; ?>" />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Email_Usu"><?=t('Email_Usu'); ?> <?php echo form_error('Email_Usu') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Email_Usu" id="Email_Usu" placeholder="Email Usu" value="<?php echo $Email_Usu; ?>" />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="KeyRecoverPassword_Usu"><?=t('KeyRecoverPassword_Usu'); ?> <?php echo form_error('KeyRecoverPassword_Usu') ?></label>
                <textarea class="form-control" rows="3" name="KeyRecoverPassword_Usu" id="KeyRecoverPassword_Usu" placeholder="KeyRecoverPassword Usu"><?php echo $KeyRecoverPassword_Usu; ?></textarea>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="FechaRegistro_Usu"><?=t('FechaRegistro_Usu'); ?> <?php echo form_error('FechaRegistro_Usu') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="FechaRegistro_Usu" id="FechaRegistro_Usu" placeholder="FechaRegistro Usu" value="<?php echo $FechaRegistro_Usu; ?>" />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Primary_Usu"><?=t('Primary_Usu'); ?> <?php echo form_error('Primary_Usu') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Primary_Usu" id="Primary_Usu" placeholder="Primary Usu" value="<?php echo $Primary_Usu; ?>" />
                </div>
            </div>
		
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Id_Per"><?=t('Id_Per'); ?> <?php echo form_error('Id_Per') ?></label>
                <select name="Id_Per" id="Id_Per" class="form-control selectpicker" data-live-search="true">
                    <option value="">Seleccione</option>
                    <?php
                    foreach($all_persona as $persona)
                    { 
                        $print_value =  $persona->Id_Per;
                        $selected = ($persona->Id_Per==$Id_Per) ? 'selected':'';
                        echo '<option value="'.$persona->Id_Per.'"  '.$selected.'> '.$print_value.'</option>';
                    } ?>
                </select>
            </div>
		
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Id_Rol"><?=t('Id_Rol'); ?> <?php echo form_error('Id_Rol') ?></label>
                <select name="Id_Rol" id="Id_Rol" class="form-control selectpicker" data-live-search="true">
                    <option value="">Seleccione</option>
                    <?php
                    foreach($all_roles as $roles)
                    { 
                        $print_value =  $roles->Id_Rol;
                        $selected = ($roles->Id_Rol==$Id_Rol) ? 'selected':'';
                        echo '<option value="'.$roles->Id_Rol.'"  '.$selected.'> '.$print_value.'</option>';
                    } ?>
                </select>
            </div>
		
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Id_UsuEst"><?=t('Id_UsuEst'); ?> <?php echo form_error('Id_UsuEst') ?></label>
                <select name="Id_UsuEst" id="Id_UsuEst" class="form-control selectpicker" data-live-search="true">
                    <option value="">Seleccione</option>
                    <?php
                    foreach($all_usuario_estado as $usuario_estado)
                    { 
                        $print_value =  $usuario_estado->Id_UsuEst;
                        $selected = ($usuario_estado->Id_UsuEst==$Id_UsuEst) ? 'selected':'';
                        echo '<option value="'.$usuario_estado->Id_UsuEst.'"  '.$selected.'> '.$print_value.'</option>';
                    } ?>
                </select>
            </div>
		</div>
    </div>

    <div class="card-footer text-right">
        
	    <input type="hidden" name="Id_Usu" value="<?php echo $Id_Usu; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('usuario') ?>" class="btn btn-danger">Cancelar</a>
    </div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    