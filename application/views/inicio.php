<div class="container-fluid row" style="padding-bottom: 5px;">

	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		<h4>Bienvenido. </h4>
		<h4><?php echo $Per_Nombres; ?></h4>

	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		<br><br>
		<h4 class="text-right"><?php echo $fecha; ?></h4>
	</div>

	<div class="text-center col-12" style="margin-top: 0px" id="message">
		<?php echo $this->session->userdata('message') <> '' ? '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: .0rem;"><strong>' . $this->session->userdata('message') . '</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' : ''; ?>
	</div>
	<div class="col-12">
		<section class="py-4">
			<div class="">
				<div class="row">
					<div class="col-xl-3 col-md-6 mb-3 mb-lg-0">
						<div class="border rounded panel-white">
							<div class="d-flex border-bottom p-3 w-100 align-items-center">
								<h3 class="h5 mr-auto mb-0"><?= t('income') ?></h3>
								<p class="badge badge-success mb-0">Mensual</p>
							</div>
							<p class="px-3 pt-4 h3">108,200</p>
							<div class="d-flex px-3 w-100">
								<p class="mr-auto">Total <?= t('income') ?></p>
								<p class="text-success d-flex align-items-center"><img src="placeholder/icons/level-up.svg" height="20" width="20" alt=""> 82%</p>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-md-6 mb-3 mb-lg-0">
						<div class="border rounded panel-white">
							<div class="d-flex border-bottom p-3 w-100 align-items-center">
								<h3 class="h5 mr-auto mb-0"><?= t('expenses') ?></h3>
								<p class="badge badge-success mb-0">Mensual</p>
							</div>
							<p class="px-3 pt-4 h3">128,430</p>
							<div class="d-flex px-3 w-100">
								<p class="mr-auto">New <?= t('expenses') ?></p>
								<p class="text-success d-flex align-items-center"><img src="placeholder/icons/level-up.svg" height="20" width="20" alt=""> 32%</p>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-md-6 mb-3 mb-lg-0">
						<div class="border rounded panel-white">
							<div class="d-flex border-bottom p-3 w-100 align-items-center">
								<h3 class="h5 mr-auto mb-0">Visits</h3>
								<p class="badge badge-success mb-0">Today</p>
							</div>
							<p class="px-3 pt-4 h3">81,248</p>
							<div class="d-flex px-3 w-100">
								<p class="mr-auto">New visits</p>
								<p class="text-success d-flex align-items-center"><img src="placeholder/icons/level-up.svg" height="20" width="20" alt=""> 24%</p>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-md-6">
						<div class="border rounded panel-white">
							<div class="d-flex border-bottom p-3 w-100 align-items-center">
								<h3 class="h5 mr-auto mb-0">User activity</h3>
								<p class="badge badge-danger mb-0">Today</p>
							</div>
							<p class="px-3 pt-4 h3">2,341</p>
							<div class="d-flex px-3 w-100">
								<p class="mr-auto">Used app more than once</p>
								<p class="text-danger d-flex align-items-center"><img src="placeholder/icons/level-down.svg" height="20" width="20" alt=""> 42%</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h5 class="text-left" style="margin-top:0px">Estilo 1 <i class="fas fa-angle-down" style="float: right;"></i></h5>
			</div>
			<div class="card-body">
				<section class="py-4">
					<div class="container-fluid">
						<div class="row">
							<div class="col-xl-4">
								<h2>Welcome Piper</h2>
								<p>You have 2 messages and 3 notifications.</p>
								<div class="table-responsive">
									<table class="table">
										<tbody>
											<tr>
												<td>1</td>
												<td>Read developers CV !!!</td>
												<td>10:00am</td>
											</tr>
											<tr>
												<td>2</td>
												<td>Meeting with Russ Hanneman</td>
												<td>10:15am</td>
											</tr>
											<tr>
												<td>3</td>
												<td>Verify current Weismann score</td>
												<td>11:00am</td>
											</tr>
											<tr>
												<td>4</td>
												<td>Call back to Gavin Belson</td>
												<td>11:38am</td>
											</tr>
											<tr>
												<td>5</td>
												<td>Richard call me! / Gavin</td>
												<td>11:48am</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-xl-5"><img class="mt-5 img-fluid" src="placeholder/pictures/bg_16-9.svg?primary=007bff" alt="">
								<div class="row mt-3 flex-row text-center text-sm-left">
									<div class="col-sm-4">
										<h3>$ 108,200</h3>
										<p>Sales report</p>
									</div>
									<div class="col-sm-4">
										<h3>$ 120,521</h3>
										<p>Cost of operation</p>
									</div>
									<div class="col-sm-4">
										<h3>- $ 12,321</h3>
										<p>Net income</p>
									</div>
								</div>
							</div>
							<div class="col-xl-3 mt-5">
								<h3>PiperNet progress</h3>
								<p class="lead">You're asigned to two projects</p>
								<div class="d-flex text-center">
									<figure class="col-6"><a href="#"><img class="rounded-circle img-fluid" src="placeholder/pictures/bg_circle.svg?primary=007bff" alt=""></a>
										<figcaption class="mt-3"><a href="#">Infrastructure</a></figcaption>
									</figure>
									<figure class="col-6"><a href="#"><img class="rounded-circle img-fluid" src="placeholder/pictures/bg_circle.svg?primary=007bff" alt=""></a>
										<figcaption class="mt-3"><a href="#">Compression</a></figcaption>
									</figure>
								</div>
								<p>Decentralized, secure, private. The Pied Piper Net is on it's way to revolutionize every smartphone, PC, and smart-fridge near you.</p>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>


	</div>

	<div class="card-padding col-xs-12 col-sm-12 col-md-3 col-lg-3">
		<h1><i class="fas fa-stethoscope fa-5x"></i>| ProSalud </h1>
	</div>

</div>
<?php $this->load->view('footer.php');  ?>
<script type="text/javascript">


</script>