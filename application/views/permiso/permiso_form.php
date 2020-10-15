
<div class="card">
    <form action="<?php echo $action; ?>" method="post">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Permiso </h2> -->
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
                <label for="Descripcion_Perm"><?=t('Descripcion_Perm'); ?> <?php echo form_error('Descripcion_Perm') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Descripcion_Perm" id="Descripcion_Perm" placeholder="Descripcion Perm" value="<?php echo $Descripcion_Perm; ?>" />
                </div>
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Acceso_Perm"><?=t('Acceso_Perm'); ?> <?php echo form_error('Acceso_Perm') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Acceso_Perm" id="Acceso_Perm" placeholder="Acceso Perm" value="<?php echo $Acceso_Perm; ?>" />
                </div>
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Controlador_Perm"><?=t('Controlador_Perm'); ?> <?php echo form_error('Controlador_Perm') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Controlador_Perm" id="Controlador_Perm" placeholder="Controlador Perm" value="<?php echo $Controlador_Perm; ?>" />
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
        
	    <input type="hidden" name="Id_Perm" value="<?php echo $Id_Perm; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('permiso') ?>" class="btn btn-danger">Cancelar</a>
    </div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    