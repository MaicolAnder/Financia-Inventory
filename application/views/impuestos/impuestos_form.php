
<div class="card">
    <form action="<?php echo $action; ?>" method="post">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Impuestos </h2> -->
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
                <label class="required" for="Nombre_Imp"><?=t('Nombre_Imp'); ?> <?php echo form_error('Nombre_Imp') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Nombre_Imp" id="Nombre_Imp" placeholder="Nombre" required value="<?php echo $Nombre_Imp; ?>" />
                </div>
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label class="required" for="Valor_Imp"><?=t('Valor_Imp'); ?> <?php echo form_error('Valor_Imp') ?></label>
            <div class="input-group-prepend group-ico">
                <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                <input type="text" class="form-control" name="Valor_Imp" id="Valor_Imp" placeholder="Porcentaje impuesto (%)" required value="<?php echo $Valor_Imp; ?>" />
            </div>
        </div>
            <?php /* ?>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Estado_Imp"><?=t('Estado_Imp'); ?> <?php echo form_error('Estado_Imp') ?></label>
            <div class="input-group-prepend group-ico">
                <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                <input type="text" class="form-control" name="Estado_Imp" id="Estado_Imp" placeholder="Estado Imp" value="<?php echo $Estado_Imp; ?>" />
            </div>
        </div> <?php */ ?>

        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label class="required" for="Estado_Imp"><?=t('Estado_Imp'); ?> <?php echo form_error('Estado_Imp') ?></label><br>
            <?php 
            $Activo=""; $Inactivo="";
            if ($Estado_Imp == 'Activo') {
                $Activo = 'checked';
            } elseif ($Estado_Imp == 'Inactivo') {
                $Inactivo = 'checked';
            }
            ?>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="Estado_Imp_Activo" name="Estado_Imp" required value="Activo" <?php echo $Activo ?> >
                <label class="custom-control-label" for="Estado_Imp_Activo">Activo</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="Estado_Imp_Inactivo" name="Estado_Imp" required value="Inactivo" <?php echo $Inactivo ?>>
                <label class="custom-control-label" for="Estado_Imp_Inactivo">Inactivo</label>
            </div>
        </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="FechaRegistro_Imp"><?=t('FechaRegistro_Imp'); ?> <?php echo form_error('FechaRegistro_Imp') ?></label>
            <div class="input-group-prepend group-ico">
                <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                <input type="text" class="form-control" name="FechaRegistro_Imp" id="FechaRegistro_Imp" placeholder="FechaRegistro Imp" value="<?php echo $FechaRegistro_Imp; ?>" readonly />
            </div>
        </div>
	</div>
    </div>

    <div class="card-footer text-right">
        
	    <input type="hidden" name="Id_Imp" value="<?php echo $Id_Imp; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('impuestos') ?>" class="btn btn-danger">Cancelar</a>
    </div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    