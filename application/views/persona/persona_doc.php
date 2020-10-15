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
        <h2>Persona List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Identificacion Per</th>
		<th>Nombre1 Per</th>
		<th>Nombre2 Per</th>
		<th>Apeliido1 Per</th>
		<th>Apellido2 Per</th>
		<th>Telefono Per</th>
		<th>TelCelular Per</th>
		<th>Correo Per</th>
		<th>Direccion Per</th>
		<th>Comuna Per</th>
		<th>ZonaResidencia Per</th>
		<th>FechaNacimiento Per</th>
		<th>FechaRegistro Per</th>
		<th>Celular Per</th>
		<th>Id PerTipId</th>
		<th>Id PerGen</th>
		<th>Id Mun</th>
		<th>Id PerEst</th>
		<th>Id PerTip</th>
		<th>Id Emp</th>
		<th>Id GrupPob</th>
		<th>Id Disc</th>
		<th>Id Per Familiar</th>
		<th>Id ParenPer</th>
		<th>Id Etnia</th>
		
            </tr><?php
            foreach ($persona_data as $persona)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $persona->Identificacion_Per ?></td>
		      <td><?php echo $persona->Nombre1_Per ?></td>
		      <td><?php echo $persona->Nombre2_Per ?></td>
		      <td><?php echo $persona->Apeliido1_Per ?></td>
		      <td><?php echo $persona->Apellido2_Per ?></td>
		      <td><?php echo $persona->Telefono_Per ?></td>
		      <td><?php echo $persona->TelCelular_Per ?></td>
		      <td><?php echo $persona->Correo_Per ?></td>
		      <td><?php echo $persona->Direccion_Per ?></td>
		      <td><?php echo $persona->Comuna_Per ?></td>
		      <td><?php echo $persona->ZonaResidencia_Per ?></td>
		      <td><?php echo $persona->FechaNacimiento_Per ?></td>
		      <td><?php echo $persona->FechaRegistro_Per ?></td>
		      <td><?php echo $persona->Celular_Per ?></td>
		      <td><?php echo $persona->Id_PerTipId ?></td>
		      <td><?php echo $persona->Id_PerGen ?></td>
		      <td><?php echo $persona->Id_Mun ?></td>
		      <td><?php echo $persona->Id_PerEst ?></td>
		      <td><?php echo $persona->Id_PerTip ?></td>
		      <td><?php echo $persona->Id_Emp ?></td>
		      <td><?php echo $persona->Id_GrupPob ?></td>
		      <td><?php echo $persona->Id_Disc ?></td>
		      <td><?php echo $persona->Id_Per_Familiar ?></td>
		      <td><?php echo $persona->Id_ParenPer ?></td>
		      <td><?php echo $persona->Id_Etnia ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>