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
        <h2>Configuracion List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Key Conf</th>
		<th>Value Conf</th>
		<th>Descripcion Conf</th>
		<th>Id ConfTip</th>
		
            </tr><?php
            foreach ($configuracion_data as $configuracion)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $configuracion->key_Conf ?></td>
		      <td><?php echo $configuracion->Value_Conf ?></td>
		      <td><?php echo $configuracion->Descripcion_Conf ?></td>
		      <td><?php echo $configuracion->Id_ConfTip ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>