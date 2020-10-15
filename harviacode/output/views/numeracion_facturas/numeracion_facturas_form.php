
<div class="card">
    <form action="<?php echo $action; ?>" method="post">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Numeracion_facturas </h2> -->
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
                <label for="Nombre_NumFac"><?=t('Nombre_NumFac'); ?> <?php echo form_error('Nombre_NumFac') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Nombre_NumFac" id="Nombre_NumFac" placeholder="Nombre NumFac" value="<?php echo $Nombre_NumFac; ?>" />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Prefijo_NumFac"><?=t('Prefijo_NumFac'); ?> <?php echo form_error('Prefijo_NumFac') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Prefijo_NumFac" id="Prefijo_NumFac" placeholder="Prefijo NumFac" value="<?php echo $Prefijo_NumFac; ?>" />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Numero_NumFac"><?=t('Numero_NumFac'); ?> <?php echo form_error('Numero_NumFac') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Numero_NumFac" id="Numero_NumFac" placeholder="Numero NumFac" value="<?php echo $Numero_NumFac; ?>" />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="Resolucion_NumFac"><?=t('Resolucion_NumFac'); ?> <?php echo form_error('Resolucion_NumFac') ?></label>
                <textarea class="form-control" rows="3" name="Resolucion_NumFac" id="Resolucion_NumFac" placeholder="Resolucion NumFac"><?php echo $Resolucion_NumFac; ?></textarea>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Activo_NumFac"><?=t('Activo_NumFac'); ?> <?php echo form_error('Activo_NumFac') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Activo_NumFac" id="Activo_NumFac" placeholder="Activo NumFac" value="<?php echo $Activo_NumFac; ?>" />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Defecto_NumFac"><?=t('Defecto_NumFac'); ?> <?php echo form_error('Defecto_NumFac') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Defecto_NumFac" id="Defecto_NumFac" placeholder="Defecto NumFac" value="<?php echo $Defecto_NumFac; ?>" />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Primary_Usu"><?=t('Primary_Usu'); ?> <?php echo form_error('Primary_Usu') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Primary_Usu" id="Primary_Usu" placeholder="Primary Usu" value="<?php echo $Primary_Usu; ?>" />
                </div>
            </div>
		</div>
    </div>

    <div class="card-footer text-right">
        
	    <input type="hidden" name="Id_NumFac" value="<?php echo $Id_NumFac; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('numeracion_facturas') ?>" class="btn btn-danger">Cancelar</a>
    </div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    