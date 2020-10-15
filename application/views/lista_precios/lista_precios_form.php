
<div class="card">
    <form action="<?php echo $action; ?>" method="post">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Lista_precios </h2> -->
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
            <label for="Nombre_ListPre"><?=t('Nombre_ListPre'); ?> <?php echo form_error('Nombre_ListPre') ?></label>
            <div class="input-group-prepend group-ico">
                <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                <input type="text" class="form-control" name="Nombre_ListPre" id="Nombre_ListPre" placeholder="Nombre" value="<?php echo $Nombre_ListPre; ?>" />
            </div>
        </div>
            <?php /* ?>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Estado_ListPre"><?=t('Estado_ListPre'); ?> <?php echo form_error('Estado_ListPre') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Estado_ListPre" id="Estado_ListPre" placeholder="Estado ListPre" value="<?php echo $Estado_ListPre; ?>" />
                </div>
            </div> <?php */ ?>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Valor_Incremento"><?=t('Valor_Incremento'); ?> <?php echo form_error('Valor_Incremento') ?></label>
            <div class="input-group-prepend group-ico">
                <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                <input type="number" step="any" min="0" class="form-control" name="Valor_Incremento" id="Valor_Incremento" placeholder="$25.000.00" value="<?php echo $Valor_Incremento; ?>" />
            </div>
        </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Porcentaje_Incremento"><?=t('Porcentaje_Incremento'); ?> <?php echo form_error('Porcentaje_Incremento') ?></label>
            <div class="input-group-prepend group-ico">
                <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                <input type="number" step="any" min="0" class="form-control" name="Porcentaje_Incremento" id="Porcentaje_Incremento" placeholder="20%" value="<?php echo $Porcentaje_Incremento; ?>" />
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label class="required" for="Estado_ListPre"><?=t('Estado_ListPre'); ?> <?php echo form_error('Estado_ListPre') ?></label><br>
            <?php 
            $Activo=""; $Inactivo="";
            if ($Estado_ListPre == 'Activo') {
                $Activo = 'checked';
            } elseif ($Estado_ListPre == 'Inactivo') {
                $Inactivo = 'checked';
            }
            ?>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="Estado_ListPre_Activo" name="Estado_ListPre" required value="Activo" <?php echo $Activo ?> >
                <label class="custom-control-label" for="Estado_ListPre_Activo">Activo</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="Estado_ListPre_Inactivo" name="Estado_ListPre" required value="Inactivo" <?php echo $Inactivo ?>>
                <label class="custom-control-label" for="Estado_ListPre_Inactivo">Inactivo</label>
            </div>
        </div>
	</div>
    </div>

    <div class="card-footer text-right">
        
	    <input type="hidden" name="Id_ListPre" value="<?php echo $Id_ListPre; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('lista_precios') ?>" class="btn btn-danger">Cancelar</a>
    </div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    