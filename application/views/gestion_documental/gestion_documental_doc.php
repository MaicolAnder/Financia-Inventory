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
        <h2>Gestion_documental List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nombre GesDoc</th>
		<th>Descripcion GesDoc</th>
		<th>NombreInterno GesDoc</th>
		<th>Ubicacion GesDoc</th>
		<th>Formato GesDoc</th>
		<th>Tamanio GesDoc</th>
		<th>FechaRegistro GesDoc</th>
		<th>Id Usu</th>
		<th>Id Per</th>
		<th>Id PerAut</th>
		<th>Id Afi</th>
		<th>Id Aut</th>
		<th>Id Con</th>
		
            </tr><?php
            foreach ($gestion_documental_data as $gestion_documental)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $gestion_documental->Nombre_GesDoc ?></td>
		      <td><?php echo $gestion_documental->Descripcion_GesDoc ?></td>
		      <td><?php echo $gestion_documental->NombreInterno_GesDoc ?></td>
		      <td><?php echo $gestion_documental->Ubicacion_GesDoc ?></td>
		      <td><?php echo $gestion_documental->Formato_GesDoc ?></td>
		      <td><?php echo $gestion_documental->Tamanio_GesDoc ?></td>
		      <td><?php echo $gestion_documental->FechaRegistro_GesDoc ?></td>
		      <td><?php echo $gestion_documental->Id_Usu ?></td>
		      <td><?php echo $gestion_documental->Id_Per ?></td>
		      <td><?php echo $gestion_documental->Id_PerAut ?></td>
		      <td><?php echo $gestion_documental->Id_Afi ?></td>
		      <td><?php echo $gestion_documental->Id_Aut ?></td>
		      <td><?php echo $gestion_documental->Id_Con ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>