
        <!-- <h2 style="margin-top:0px">Empresa Read</h2> -->
        <h2 class="text-right" style="margin-top:0px"><?php echo $page ?></h2>
        <div class="table-responsive">
        <table class="table table-condensed table-bordered table-fixed">
	    <tr><td>Nombre Emp</td><td><?php echo $Nombre_Emp; ?></td></tr>
	    <tr><td>DigitoVerificacion Emp</td><td><?php echo $DigitoVerificacion_Emp; ?></td></tr>
	    <tr><td>Correo Emp</td><td><?php echo $Correo_Emp; ?></td></tr>
	    <tr><td>Direccion Emp</td><td><?php echo $Direccion_Emp; ?></td></tr>
	    <tr><td>Telefono Emp</td><td><?php echo $Telefono_Emp; ?></td></tr>
	    <tr><td>TelCelular Emp</td><td><?php echo $TelCelular_Emp; ?></td></tr>
	    <tr><td>Nit Emp</td><td><?php echo $Nit_Emp; ?></td></tr>
	    <tr><td>Id Mun</td><td><?php echo $Id_Mun; ?></td></tr>
	    <tr><td>Id EmpTip</td><td><?php echo $Id_EmpTip; ?></td></tr>
	    <tr><td>CodigoIPS Emp</td><td><?php echo $CodigoIPS_Emp; ?></td></tr>
	    <tr><td>CodigoSedeIPS Emp</td><td><?php echo $CodigoSedeIPS_Emp; ?></td></tr>
	    <tr><td>CodigoPrestador Emp</td><td><?php echo $CodigoPrestador_Emp; ?></td></tr>
	    <tr><td>Sede Emp</td><td><?php echo $Sede_Emp; ?></td></tr>
	</table>
        </div>
        <div><a href="<?php echo site_url($this->view) ?>" class="btn btn-danger">Cancelar </a> <a href="<?php echo site_url($this->view.'/update/'.$id_update) ?>" class="btn btn-info">Actualizar</a></div>
        <?php $this->load->view('footer'); ?>