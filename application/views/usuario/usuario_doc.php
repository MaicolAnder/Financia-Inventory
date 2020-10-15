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
        <h2>Usuario List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Contrasena Usu</th>
		<th>Email Usu</th>
		<th>UltimoAcceso Usu</th>
		<th>UltimaContrasena Usu</th>
		<th>KeyPago Usu</th>
		<th>Id Per</th>
		<th>Id UsuEst</th>
		<th>Id Rol</th>
		
            </tr><?php
            foreach ($usuario_data as $usuario)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $usuario->Contrasena_Usu ?></td>
		      <td><?php echo $usuario->Email_Usu ?></td>
		      <td><?php echo $usuario->UltimoAcceso_Usu ?></td>
		      <td><?php echo $usuario->UltimaContrasena_Usu ?></td>
		      <td><?php echo $usuario->KeyPago_Usu ?></td>
		      <td><?php echo $usuario->Id_Per ?></td>
		      <td><?php echo $usuario->Id_UsuEst ?></td>
		      <td><?php echo $usuario->Id_Rol ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>