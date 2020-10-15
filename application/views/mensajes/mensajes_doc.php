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
        <h2>Mensajes List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Asunto Men</th>
		<th>Mensaje Men</th>
		<th>FechaRegistro Men</th>
		<th>FechaVisto Men</th>
		<th>DestinatarioEmail Men</th>
		<th>Estado Men</th>
		<th>Masivo Men</th>
		<th>Id MenTip</th>
		
            </tr><?php
            foreach ($mensajes_data as $mensajes)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $mensajes->Asunto_Men ?></td>
		      <td><?php echo $mensajes->Mensaje_Men ?></td>
		      <td><?php echo $mensajes->FechaRegistro_Men ?></td>
		      <td><?php echo $mensajes->FechaVisto_Men ?></td>
		      <td><?php echo $mensajes->DestinatarioEmail_Men ?></td>
		      <td><?php echo $mensajes->Estado_Men ?></td>
		      <td><?php echo $mensajes->Masivo_Men ?></td>
		      <td><?php echo $mensajes->Id_MenTip ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>