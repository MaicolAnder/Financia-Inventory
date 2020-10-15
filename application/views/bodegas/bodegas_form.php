
<div class="card">
    <form action="<?php echo $action; ?>" method="post">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Bodegas </h2> -->
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
                <label for="Nombre_Bod" class="required"><?=t('Nombre_Bod'); ?> <?php echo form_error('Nombre_Bod') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Nombre_Bod" id="Nombre_Bod" placeholder="Nombre" value="<?php echo $Nombre_Bod; ?>" required />
                </div>
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Codigo_Bod"><?=t('Codigo_Bod'); ?> <?php echo form_error('Codigo_Bod') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Codigo_Bod" id="Codigo_Bod" placeholder="Código" value="<?php echo $Codigo_Bod; ?>" />
                </div>
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Direccion_Bod"><?=t('Direccion_Bod'); ?> <?php echo form_error('Direccion_Bod') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Direccion_Bod" id="Direccion_Bod" placeholder="Direccion" value="<?php echo $Direccion_Bod; ?>" />
                </div>
            </div>
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_BodEst" class="required"><?=t('Id_BodEst'); ?> <?php echo form_error('Id_BodEst') ?></label>
            <select name="Id_BodEst" id="Id_BodEst" class="form-control selectpicker" data-live-search="true" required>
                <option value="">Seleccione</option>
                <?php
                foreach($all_bodega_estado as $bodega_estado)
                { 
                    $print_value =  $bodega_estado->Nombre_BodEst;
                    $selected = ($bodega_estado->Id_BodEst==$Id_BodEst) ? 'selected':'';
                    echo '<option value="'.$bodega_estado->Id_BodEst.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>
        </div>
	    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <label for="Descripcion_Bod"><?=t('Descripcion_Bod'); ?> <?php echo form_error('Descripcion_Bod') ?></label>
            <textarea class="form-control" rows="3" name="Descripcion_Bod" id="Descripcion_Bod" placeholder="Descripcion"><?php echo $Descripcion_Bod; ?></textarea>
        </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="FechaRegistro_Bod"><?=t('FechaRegistro_Bod'); ?> <?php echo form_error('FechaRegistro_Bod') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="FechaRegistro_Bod" id="FechaRegistro_Bod" placeholder="" value="<?php echo $FechaRegistro_Bod; ?>" readonly />
                </div>
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="FechaCreacion_Bod"><?=t('FechaCreacion_Bod'); ?> <?php echo form_error('FechaCreacion_Bod') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="date" class="form-control" name="FechaCreacion_Bod" id="FechaCreacion_Bod" placeholder="Fecha Creacion" value="<?php echo $FechaCreacion_Bod; ?>" />
                </div>
            </div>
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_BodTip"><?=t('Id_BodTip'); ?> <?php echo form_error('Id_BodTip') ?></label>
            <select name="Id_BodTip" id="Id_BodTip" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
                <?php
                foreach($all_bodega_tipo as $bodega_tipo)
                { 
                    $print_value =  $bodega_tipo->Nombre_BodTip;
                    $selected = ($bodega_tipo->Id_BodTip==$Id_BodTip) ? 'selected':'';
                    echo '<option value="'.$bodega_tipo->Id_BodTip.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>
        </div>
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_Usu"><?=t('Id_Usu'); ?> <?php echo form_error('Id_Usu') ?></label>
            <select name="Id_Usu" id="Id_Usu" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
                <?php
                foreach($all_usuario as $usuario)
                { 
                    $print_value =  $usuario->Usuario_Usu;
                    $selected = ($usuario->Id_Usu==$Id_Usu) ? 'selected':'';
                    echo '<option value="'.$usuario->Id_Usu.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>
        </div>
	</div>
    </div>

    <div class="card-footer text-right">
        
	    <input type="hidden" name="Id_Bod" value="<?php echo $Id_Bod; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('bodegas') ?>" class="btn btn-danger">Cancelar</a>
    </div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    