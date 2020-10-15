<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Empresa List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nombre Emp</th>
		<th>DigitoVerificacion Emp</th>
		<th>Correo Emp</th>
		<th>Direccion Emp</th>
		<th>Telefono Emp</th>
		<th>TelCelular Emp</th>
		<th>Nit Emp</th>
		<th>Id Mun</th>
		<th>Id EmpTip</th>
		<th>CodigoIPS Emp</th>
		<th>CodigoSedeIPS Emp</th>
		<th>CodigoPrestador Emp</th>
		<th>Sede Emp</th>
		
            </tr><?php
            foreach ($empresa_data as $empresa)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $empresa->Nombre_Emp ?></td>
		      <td><?php echo $empresa->DigitoVerificacion_Emp ?></td>
		      <td><?php echo $empresa->Correo_Emp ?></td>
		      <td><?php echo $empresa->Direccion_Emp ?></td>
		      <td><?php echo $empresa->Telefono_Emp ?></td>
		      <td><?php echo $empresa->TelCelular_Emp ?></td>
		      <td><?php echo $empresa->Nit_Emp ?></td>
		      <td><?php echo $empresa->Id_Mun ?></td>
		      <td><?php echo $empresa->Id_EmpTip ?></td>
		      <td><?php echo $empresa->CodigoIPS_Emp ?></td>
		      <td><?php echo $empresa->CodigoSedeIPS_Emp ?></td>
		      <td><?php echo $empresa->CodigoPrestador_Emp ?></td>
		      <td><?php echo $empresa->Sede_Emp ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>