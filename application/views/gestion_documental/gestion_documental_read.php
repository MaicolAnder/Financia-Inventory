
        <!-- <h2 style="margin-top:0px">Gestion_documental Read</h2> -->
        <h4 class="text-right" style="margin-top:0px"><?php echo $page ?></h4>
        <div class="table-responsive">
        <table class="table table-condensed table-bordered table-fixed">
	    <tr><td>Nombre GesDoc</td><td><?php echo $Nombre_GesDoc; ?></td></tr>
	    <tr><td>Descripcion GesDoc</td><td><?php echo $Descripcion_GesDoc; ?></td></tr>
	    <tr><td>NombreInterno GesDoc</td><td><?php echo $NombreInterno_GesDoc; ?></td></tr>
	    <tr><td>Ubicacion GesDoc</td><td><?php echo $Ubicacion_GesDoc; ?></td></tr>
	    <tr><td>Formato GesDoc</td><td><?php echo $Formato_GesDoc; ?></td></tr>
	    <tr><td>Tamanio GesDoc</td><td><?php echo $Tamanio_GesDoc; ?></td></tr>
	    <tr><td>FechaRegistro GesDoc</td><td><?php echo $FechaRegistro_GesDoc; ?></td></tr>
	    <tr><td>Id Usu</td><td><?php echo $Id_Usu; ?></td></tr>
	    <tr><td>Id Per</td><td><?php echo $Id_Per; ?></td></tr>
	    <tr><td>Id PerAut</td><td><?php echo $Id_PerAut; ?></td></tr>
	    <tr><td>Id Afi</td><td><?php echo $Id_Afi; ?></td></tr>
	    <tr><td>Id Aut</td><td><?php echo $Id_Aut; ?></td></tr>
	    <tr><td>Id Con</td><td><?php echo $Id_Con; ?></td></tr>
	</table>
        </div>
    <div class="row justify-content-between">
        <div class="col-12"></div>    
        <div class="col-12 text-right">
            <a href="<?php echo site_url($this->view) ?>" class="btn btn-danger">Cancelar </a> <a href="<?php echo site_url($this->view.'/update/'.$id_update) ?>" class="btn btn-info">Actualizar</a>
        </div>
    </div>
        <?php $this->load->view('footer'); ?>