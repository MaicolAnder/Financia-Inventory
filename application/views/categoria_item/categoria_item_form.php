
<div class="card">
    <form action="<?php echo $action; ?>" method="post">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Categoria_item </h2> -->
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
                <label for="Nombre_CatIte"><?=t('Nombre_CatIte'); ?> <?php echo form_error('Nombre_CatIte') ?></label>
                <div class="required" class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Nombre_CatIte" id="Nombre_CatIte" placeholder="Nombre" value="<?php echo $Nombre_CatIte; ?>" required/>
                </div>
            </div>
	    
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label class="required" for="Estado_CatIte"><?=t('Estado_CatIte'); ?> <?php echo form_error('Estado_CatIte') ?></label><br>
            <?php 
            $Activo=""; $Inactivo="";
            if ($Estado_CatIte == 'Activo') {
                $Activo = 'checked';
            } elseif ($Estado_CatIte == 'Inactivo') {
                $Inactivo = 'checked';
            }
            ?>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="Estado_CatIte_Activo" name="Estado_CatIte" required value="Activo" <?php echo $Activo ?> >
                <label class="custom-control-label" for="Estado_CatIte_Activo">Activo</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="Estado_CatIte_Inactivo" name="Estado_CatIte" required value="Inactivo" <?php echo $Inactivo ?>>
                <label class="custom-control-label" for="Estado_CatIte_Inactivo">Inactivo</label>
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="FechaRegistro_CatIte"><?=t('FechaRegistro_CatIte'); ?> <?php echo form_error('FechaRegistro_CatIte') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="FechaRegistro_CatIte" id="FechaRegistro_CatIte" placeholder="" value="<?php echo $FechaRegistro_CatIte; ?>" readonly />
                </div>
            </div>
	</div>
    </div>

    <div class="card-footer text-right">
        
	    <input type="hidden" name="Id_CatIte" value="<?php echo $Id_CatIte; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('categoria_item') ?>" class="btn btn-danger">Cancelar</a>
    </div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    