<div>
        <!-- <h2 style="margin-top:0px">Permiso <?php echo $button ?></h2> -->
        <h5 class="text-right" style="margin-top:0px"><?php echo $page ?></h5>
        <hr>
        <form action="<?php echo $action; ?>" method="post">
        <div class="row">
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Descripcion_Perm">Descripcion Perm <?php echo form_error('Descripcion_Perm') ?></label>
                <input type="text" class="form-control" name="Descripcion_Perm" id="Descripcion_Perm" placeholder="Descripcion Perm" value="<?php echo $Descripcion_Perm; ?>" />
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Acceso_Perm">Acceso Perm <?php echo form_error('Acceso_Perm') ?></label>
                <input type="text" class="form-control" name="Acceso_Perm" id="Acceso_Perm" placeholder="Acceso Perm" value="<?php echo $Acceso_Perm; ?>" />
            </div></div><hr>
<div class="row justify-content-between">
    <div class="col-12"></div>
    <div class="col-12 text-right">
	    <input type="hidden" name="Id_Perm" value="<?php echo $Id_Perm; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('permiso') ?>" class="btn btn-danger">Cancelar</a>
    </div>
</div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    