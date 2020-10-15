
<div class="card">
    <form action="<?php echo $action; ?>" method="post">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Termino_pago </h2> -->
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
                <label for="Nombre_TerPag"><?=t('Nombre_TerPag'); ?> <?php echo form_error('Nombre_TerPag') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Nombre_TerPag" id="Nombre_TerPag" placeholder="Nombre" value="<?php echo $Nombre_TerPag; ?>" />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Dias_TerPag"><?=t('Dias_TerPag'); ?> <?php echo form_error('Dias_TerPag') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="number" min="0" class="form-control" name="Dias_TerPag" id="Dias_TerPag" placeholder="Dias a aplicar" value="<?php echo $Dias_TerPag; ?>" />
                </div>
            </div>
            <?php /* ?>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Estado_TerPag"><?=t('Estado_TerPag'); ?> <?php echo form_error('Estado_TerPag') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Estado_TerPag" id="Estado_TerPag" placeholder="Estado TerPag" value="<?php echo $Estado_TerPag; ?>" />
                </div>
            </div>
            <?php */ ?>
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label class="required" for="Estado_TerPag"><?=t('Estado_TerPag'); ?> <?php echo form_error('Estado_TerPag') ?></label><br>
                <?php 
                $Activo=""; $Inactivo="";
                if ($Estado_TerPag == 'Activo') {
                    $Activo = 'checked';
                } elseif ($Estado_TerPag == 'Inactivo') {
                    $Inactivo = 'checked';
                }
                ?>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="Estado_TerPag_Activo" name="Estado_TerPag" required value="Activo" <?php echo $Activo ?> >
                    <label class="custom-control-label" for="Estado_TerPag_Activo">Activo</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="Estado_TerPag_Inactivo" name="Estado_TerPag" required value="Inactivo" <?php echo $Inactivo ?>>
                    <label class="custom-control-label" for="Estado_TerPag_Inactivo">Inactivo</label>
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="FechaRegistro_TerPag"><?=t('FechaRegistro_TerPag'); ?> <?php echo form_error('FechaRegistro_TerPag') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="FechaRegistro_TerPag" id="FechaRegistro_TerPag" placeholder="FechaRegistro TerPag" value="<?php echo $FechaRegistro_TerPag; ?>" readonly />
                </div>
            </div>
		</div>
    </div>

    <div class="card-footer text-right">
        
	    <input type="hidden" name="Id_TerPag" value="<?php echo $Id_TerPag; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('termino_pago') ?>" class="btn btn-danger">Cancelar</a>
    </div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    