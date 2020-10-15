
<div class="card">
    <form action="<?php echo $action; ?>" method="post">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Naturaleza_cuenta </h2> -->
        <h5 class="text-left" style="margin-top:0px"><?php echo $page ?> <i class="fas fa-angle-down" style="float: right;"></i></h5>
    </div>
    <div class="text-center" style="margin-top: 0px"  id="message">              
        <?php echo $this->session->userdata('message') <> '' ? '<div class="alert alert-info alert-dismissible fade show" role="alert" style="border-radius: .0rem;"><strong>'.$this->session->userdata('message').'</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' : ''; ?>
    </div>
    <div class="card-body">
        <!-- <h6 class="card-title">Titulo <i class="fas fa-sort-alpha-down"></i></h6> -->
        <!-- <p class="card-text">Best ugg boots on the planet. Free shipping, 24/7 customer service.</p>-->
        <div class="row">
        
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Nombre_NatCue"><?=t('Nombre_NatCue'); ?> <?php echo form_error('Nombre_NatCue') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Nombre_NatCue" id="Nombre_NatCue" placeholder="Nombre NatCue" value="<?php echo $Nombre_NatCue; ?>" />
                </div>
            </div>
		</div>
    </div>

    <div class="card-footer text-right">
        
	    <input type="hidden" name="Id_NatCue" value="<?php echo $Id_NatCue; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('naturaleza_cuenta') ?>" class="btn btn-danger">Cancelar</a>
    </div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    