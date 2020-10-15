
<div class="card">
    <form action="<?php echo $action; ?>" method="post">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Documento_observaciones </h2> -->
        <h5 class="text-left" style="margin-top:0px"><?php echo $page ?> <i class="fas fa-angle-down" style="float: right;"></i></h5>
    </div>
    <div class="text-center" style="margin-top: 0px"  id="message">              
        <?php echo $this->session->userdata('message') <> '' ? '<div class="alert alert-info alert-dismissible fade show" role="alert" style="border-radius: .0rem;"><strong>'.$this->session->userdata('message').'</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' : ''; ?>
    </div>
    
    <div class="card-body">
        <?php if ($mensaje != '') { ?>
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
          <?=$mensaje?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    <?php } ?>
        <div class="row">        
			<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="Nombre_DocObs"><?=t('Nombre_DocObs'); ?> <?php echo form_error('Nombre_DocObs') ?></label>
                <textarea class="form-control" rows="3" name="Nombre_DocObs" id="Nombre_DocObs" placeholder="<?=$placeholder?>"><?php echo $Nombre_DocObs; ?></textarea>
            </div>
		</div>
    </div>

    <div class="card-footer text-right">
        <input type="hidden" name="type" value="<?=$type;?>">
        <input type="hidden" name="id" value="<?=$id;?>">
	    <input type="hidden" name="Id_DocObs" value="<?php echo $Id_DocObs; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('documento/listar/'.$type) ?>" class="btn btn-danger">Cancelar</a>
    </div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    