<div>
        <!-- <h2 style="margin-top:0px">Roles <?php echo $button ?></h2> -->
        <h5 class="text-right" style="margin-top:0px"><?php echo $page ?></h5>
        <hr>
        <form action="<?php echo $action; ?>" method="post">
        <div class="row">
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Descripcion_Rol">Descripcion Rol <?php echo form_error('Descripcion_Rol') ?></label>
                <input type="text" class="form-control" name="Descripcion_Rol" id="Descripcion_Rol" placeholder="Descripcion Rol" value="<?php echo $Descripcion_Rol; ?>" />
            </div></div><hr>
<div class="row justify-content-between">
    <div class="col-12"></div>
    <div class="col-12 text-right">
	    <input type="hidden" name="Id_Rol" value="<?php echo $Id_Rol; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('roles') ?>" class="btn btn-danger">Cancelar</a>
    </div>
</div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    