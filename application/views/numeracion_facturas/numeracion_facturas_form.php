
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
        
			<div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label for="Nombre_NumFac" class="required"><?=t('Nombre_NumFac'); ?> <?php echo form_error('Nombre_NumFac') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Nombre_NumFac" id="Nombre_NumFac" placeholder="Nombre" value="<?php echo $Nombre_NumFac; ?>" required />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Prefijo_NumFac" class="required"><?=t('Prefijo_NumFac'); ?> <?php echo form_error('Prefijo_NumFac') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Prefijo_NumFac" id="Prefijo_NumFac" placeholder="Prefijo" value="<?php echo $Prefijo_NumFac; ?>" required />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Numero_NumFac" class="required"><?=t('Numero_NumFac'); ?> <?php echo form_error('Numero_NumFac') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="number" class="form-control" name="Numero_NumFac" id="Numero_NumFac" placeholder="Numero" min="0" step="1" value="<?php echo $Numero_NumFac; ?>" required />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="Resolucion_NumFac"><?=t('Resolucion_NumFac'); ?> <?php echo form_error('Resolucion_NumFac') ?></label>
                <textarea class="form-control" rows="3" name="Resolucion_NumFac" id="Resolucion_NumFac" placeholder="Resolucion"><?php echo $Resolucion_NumFac; ?></textarea>
            </div>
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label class="required" for="Activo_NumFac"><?=t('Activo_NumFac'); ?> <?php echo form_error('Activo_NumFac') ?></label><br>
                <?php 
                $Activo=""; $Inactivo="";
                if ($Activo_NumFac == 'Activo') {
                    $Activo = 'checked';
                } elseif ($Activo_NumFac == 'Inactivo') {
                    $Inactivo = 'checked';
                }
                ?>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="Activo_NumFac_Activo" name="Activo_NumFac" required value="Activo" <?php echo $Activo ?> >
                    <label class="custom-control-label" for="Activo_NumFac_Activo">Activo</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="Activo_NumFac_Inactivo" name="Activo_NumFac" required value="Inactivo" <?php echo $Inactivo ?>>
                    <label class="custom-control-label" for="Activo_NumFac_Inactivo">Inactivo</label>
                </div>
            </div>

            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label class="required" for="Defecto_NumFac"><?=t('Defecto_NumFac'); ?> <?php echo form_error('Defecto_NumFac') ?></label><br>
                <?php 
                $Activo=""; $Inactivo="";
                if ($Defecto_NumFac == 'Activo') {
                    $Activo = 'checked';
                } elseif ($Defecto_NumFac == 'Inactivo') {
                    $Inactivo = 'checked';
                }
                ?>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="Defecto_NumFac_Activo" name="Defecto_NumFac" required value="Activo" <?php echo $Activo ?> >
                    <label class="custom-control-label" for="Defecto_NumFac_Activo">Activo</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="Defecto_NumFac_Inactivo" name="Defecto_NumFac" required value="Inactivo" <?php echo $Inactivo ?>>
                    <label class="custom-control-label" for="Defecto_NumFac_Inactivo">Inactivo</label>
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
    