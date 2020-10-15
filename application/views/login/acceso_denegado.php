<div class="panel-white">
	<h5 class="text-right" style="margin-top:0px"><?php echo $page ?></h5>
	<hr>
		<div class="row container">
			<h2>No tienes acceso a este módulo</h2>
		</div>
		<br>
		<div class="justify-content-between">
			<div class="col-12"></div>
			<div class="col-12 text-right">
				<button type="button" class="btn btn-danger" onclick="window.location='<?php echo site_url() ?>'" >Volver al inicio</button>
			</div>
		</div>
	<hr>
</div>
<?php $this->load->view('footer'); ?>
<script>
	// Add the following code if you want the name of the file appear on select
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
</script>