
<div class="card">
    <form action="<?php echo $action; ?>" method="post">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Idioma_traductor </h2> -->
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
                <label for="CampoOriginal_IdiTRad"><?=t('CampoOriginal_IdiTRad'); ?> <?php echo form_error('CampoOriginal_IdiTRad') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="CampoOriginal_IdiTRad" id="CampoOriginal_IdiTRad" placeholder="CampoOriginal IdiTRad" value="<?php echo $CampoOriginal_IdiTRad; ?>" />
                </div>
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Traduccion_IdiTrad"><?=t('Traduccion_IdiTrad'); ?> <?php echo form_error('Traduccion_IdiTrad') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Traduccion_IdiTrad" id="Traduccion_IdiTrad" placeholder="Traduccion IdiTrad" value="<?php echo $Traduccion_IdiTrad; ?>" />
                </div>
            </div>
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_Idi"><?=t('Id_Idi'); ?> <?php echo form_error('Id_Idi') ?></label>
            <select name="Id_Idi" id="Id_Idi" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
                <?php
                foreach($all_idioma as $idioma)
                { 
                    $print_value =  $idioma->Id_Idi;
                    $selected = ($idioma->Id_Idi==$Id_Idi) ? 'selected':'';
                    echo '<option value="'.$idioma->Id_Idi.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>
        </div>
	</div>
    </div>

    <div class="card-footer text-right">
        
	    <input type="hidden" name="Id_IdiTrad" value="<?php echo $Id_IdiTrad; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('idioma_traductor') ?>" class="btn btn-danger">Cancelar</a>
    </div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    