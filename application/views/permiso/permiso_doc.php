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
        <h2>Permiso List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Descripcion Perm</th>
		<th>Acceso Perm</th>
		
            </tr><?php
            foreach ($permiso_data as $permiso)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $permiso->Descripcion_Perm ?></td>
		      <td><?php echo $permiso->Acceso_Perm ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>