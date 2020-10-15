
<div class="card">
    <form action="<?php echo $action; ?>" method="post">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Metodo_pago </h2> -->
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
                <label for="Nombre_MetPag"><?=t('Nombre_MetPag'); ?> <?php echo form_error('Nombre_MetPag') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Nombre_MetPag" id="Nombre_MetPag" placeholder="<?=t('Nombre_MetPag'); ?>" value="<?php echo $Nombre_MetPag; ?>" />
                </div>
            </div>
            <?php /* ?>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Estado_MePag"><?=t('Estado_MePag'); ?> <?php echo form_error('Estado_MePag') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Estado_MePag" id="Estado_MePag" placeholder="Estado MePag" value="<?php echo $Estado_MePag; ?>" />
                </div>
            </div> */ ?>
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label class="required" for="Estado_MePag"><?=t('Estado_MePag'); ?> <?php echo form_error('Estado_MePag') ?></label><br>
                <?php 
                $Activo=""; $Inactivo="";
                if ($Estado_MePag == 'Activo') {
                    $Activo = 'checked';
                } elseif ($Estado_MePag == 'Inactivo') {
                    $Inactivo = 'checked';
                }
                ?>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="Estado_MePag_Activo" name="Estado_MePag" required value="Activo" <?php echo $Activo ?> >
                    <label class="custom-control-label" for="Estado_MePag_Activo">Activo</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="Estado_MePag_Inactivo" name="Estado_MePag" required value="Inactivo" <?php echo $Inactivo ?>>
                    <label class="custom-control-label" for="Estado_MePag_Inactivo">Inactivo</label>
                </div>
            </div>

			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="FechaRegistro"><?=t('FechaRegistro'); ?> <?php echo form_error('FechaRegistro') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="FechaRegistro" id="FechaRegistro" placeholder="FechaRegistro" value="<?php echo $FechaRegistro; ?>" readonly />
                </div>
            </div>
            <?php /* ?>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Primary_Usu"><?=t('Primary_Usu'); ?> <?php echo form_error('Primary_Usu') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Primary_Usu" id="Primary_Usu" placeholder="Primary Usu" value="<?php echo $Primary_Usu; ?>" />
                </div>
            </div> <?php */ ?>
		</div>
    </div>

    <div class="card-footer text-right">
        
	    <input type="hidden" name="Id_MetPag" value="<?php echo $Id_MetPag; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('metodo_pago') ?>" class="btn btn-danger">Cancelar</a>
    </div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    