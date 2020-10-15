<div>
        <h2 style="margin-top:0px">Administrador de tablas</h2>
        <div class="table-responsive">
        	<table class="table table-fixed table-condensed" id="table-crud">
        		<thead>
        			<th>#</th>
        			<th>Nombre</th>
        			<th>Registro</th>
        			<th>link</th>
        		</thead>
        		<tbody>
        			<?php 
        			$val = 1;
        			foreach ($tables as $value) {?>
        				<tr>
        					<td><?=$val; ?></td>
        					<td><?=$value['TABLE_NAME']; ?></td>
        					<td><?=$value['TABLE_ROWS']; ?></td>
        					<td><a class="btn btn-primary" href="<?=site_url().'crud/'.$value['TABLE_NAME']; ?>">ver tabla</a> </td>
        				</tr>

		        	<?php $val++;
		        } ?>
        		</tbody>
        	</table>
        	
        </div>
        <?php 
         ?>

</div>
<?php $this->load->view('footer'); ?>    
 <script type="text/javascript">
	$(document).ready(function() {
	    
	    var table = $('#table-crud').DataTable({
	    	"paging":   true,
	        "ordering": true,
	        "info":     true,
	        //dom: 'Brtipf', // f
		    buttons: [
		        // 'pdf',
		        // 'excel',
		        // 'print'
		    ]
	    });
 
		// #myInput is a <input type="text"> element
		// $('#Search').on( 'keyup', function () {
		//     table.search( this.value ).draw();
		// } );
	} );
</script>