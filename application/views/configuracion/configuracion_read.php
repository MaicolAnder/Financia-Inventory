
        <!-- <h2 style="margin-top:0px">Configuracion Read</h2> -->
        <h4 class="text-right" style="margin-top:0px"><?php echo $page ?></h4>
        <div class="table-responsive">
        <table class="table table-condensed table-bordered table-fixed">
	    <tr><td>Key Conf</td><td><?php echo $key_Conf; ?></td></tr>
	    <tr><td>Value Conf</td><td><?php echo $Value_Conf; ?></td></tr>
	    <tr><td>Descripcion Conf</td><td><?php echo $Descripcion_Conf; ?></td></tr>
	    <tr><td>Id ConfTip</td><td><?php echo $Id_ConfTip; ?></td></tr>
	</table>
        </div>
    <div class="row justify-content-between">
        <div class="col-12"></div>    
        <div class="col-12 text-right">
            <a href="<?php echo site_url($this->view) ?>" class="btn btn-danger">Cancelar </a> <a href="<?php echo site_url($this->view.'/update/'.$id_update) ?>" class="btn btn-info">Actualizar</a>
        </div>
    </div>
        <?php $this->load->view('footer'); ?>