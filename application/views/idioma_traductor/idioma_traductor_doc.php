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
        <h2>Idioma_traductor List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Idi</th>
		<th>CampoOriginal IdiTRad</th>
		<th>Traduccion IdiTrad</th>
		
            </tr><?php
            foreach ($idioma_traductor_data as $idioma_traductor)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $idioma_traductor->Id_Idi ?></td>
		      <td><?php echo $idioma_traductor->CampoOriginal_IdiTRad ?></td>
		      <td><?php echo $idioma_traductor->Traduccion_IdiTrad ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>