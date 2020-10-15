
<div class="card">
    <form action="<?php echo $action; ?>" method="post">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Numeracion_documentos </h2> -->
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
                <label for="Inicial_NumDoc"><?=t('Inicial_NumDoc'); ?> <?php echo form_error('Inicial_NumDoc') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Inicial_NumDoc" id="Inicial_NumDoc" placeholder="Inicial NumDoc" value="<?php echo $Inicial_NumDoc; ?>" />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Siguiente_NumDoc"><?=t('Siguiente_NumDoc'); ?> <?php echo form_error('Siguiente_NumDoc') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Siguiente_NumDoc" id="Siguiente_NumDoc" placeholder="Siguiente NumDoc" value="<?php echo $Siguiente_NumDoc; ?>" />
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Primary_Usu"><?=t('Primary_Usu'); ?> <?php echo form_error('Primary_Usu') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Primary_Usu" id="Primary_Usu" placeholder="Primary Usu" value="<?php echo $Primary_Usu; ?>" />
                </div>
            </div>
		
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Id_DocTip"><?=t('Id_DocTip'); ?> <?php echo form_error('Id_DocTip') ?></label>
                <select name="Id_DocTip" id="Id_DocTip" class="form-control selectpicker" data-live-search="true">
                    <option value="">Seleccione</option>
                    <?php
                    foreach($all_documento_tipo as $documento_tipo)
                    { 
                        $print_value =  $documento_tipo->Id_DocTip;
                        $selected = ($documento_tipo->Id_DocTip==$Id_DocTip) ? 'selected':'';
                        echo '<option value="'.$documento_tipo->Id_DocTip.'"  '.$selected.'> '.$print_value.'</option>';
                    } ?>
                </select>
            </div>
		
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Id_TranTip"><?=t('Id_TranTip'); ?> <?php echo form_error('Id_TranTip') ?></label>
                <select name="Id_TranTip" id="Id_TranTip" class="form-control selectpicker" data-live-search="true">
                    <option value="">Seleccione</option>
                    <?php
                    foreach($all_transaccion_tipo as $transaccion_tipo)
                    { 
                        $print_value =  $transaccion_tipo->Id_TranTip;
                        $selected = ($transaccion_tipo->Id_TranTip==$Id_TranTip) ? 'selected':'';
                        echo '<option value="'.$transaccion_tipo->Id_TranTip.'"  '.$selected.'> '.$print_value.'</option>';
                    } ?>
                </select>
            </div>
		</div>
    </div>

    <div class="card-footer text-right">
        
	    <input type="hidden" name="Id_NumDoc" value="<?php echo $Id_NumDoc; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('numeracion_documentos') ?>" class="btn btn-danger">Cancelar</a>
    </div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    