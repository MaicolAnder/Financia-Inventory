
<div class="card">
    <form action="<?php echo $action; ?>" method="post">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Bancos </h2> -->
        <h5 class="text-left" style="margin-top:0px"><?php echo $page ?> <i class="fas fa-angle-down" style="float: right;"></i></h5>
    </div>
    <div class="text-center" style="margin-top: 0px"  id="message">              
        <?php echo $this->session->userdata('message') <> '' ? '<div class="alert alert-info alert-dismissible fade show" role="alert" style="border-radius: .0rem;"><strong>'.$this->session->userdata('message').'</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' : ''; ?>
    </div>
    <div class="card-body">
        <!-- <h6 class="card-title">Titulo <i class="fas fa-sort-alpha-down"></i></h6> -->
        <!-- <p class="card-text">Best ugg boots on the planet. Free shipping, 24/7 customer service.</p>-->
        <div class="row">
        
	    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label for="NombreCuenta_Ban" class="required"><?=t('NombreCuenta_Ban'); ?> <?php echo form_error('NombreCuenta_Ban') ?></label>
            <div class="input-group-prepend group-ico">
                <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                <input type="text" class="form-control" name="NombreCuenta_Ban" id="NombreCuenta_Ban" placeholder="Nombre" required value="<?php echo $NombreCuenta_Ban; ?>" />
            </div>
        </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="NumeroCuenta_Ban"><?=t('NumeroCuenta_Ban'); ?> <?php echo form_error('NumeroCuenta_Ban') ?></label>
            <div class="input-group-prepend group-ico">
                <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                <input type="text" class="form-control" name="NumeroCuenta_Ban" id="NumeroCuenta_Ban" placeholder="Número cuenta" value="<?php echo $NumeroCuenta_Ban; ?>" />
            </div>
        </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="SaldoInicial_Ban" class="required"><?=t('SaldoInicial_Ban'); ?> <?php echo form_error('SaldoInicial_Ban') ?></label>
            <div class="input-group-prepend group-ico">
                <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                <input type="number" step="any" class="form-control" name="SaldoInicial_Ban" id="SaldoInicial_Ban" placeholder="Saldo inicial" required value="<?php echo $SaldoInicial_Ban; ?>" />
            </div>
        </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="FechaBanco"><?=t('FechaBanco'); ?> <?php echo form_error('FechaBanco') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="date" class="form-control" name="FechaBanco" id="FechaBanco" placeholder="Fecha" value="<?php echo $FechaBanco; ?>" />
                </div>
            </div>
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_BanEst" class="required"><?=t('Id_BanEst'); ?> <?php echo form_error('Id_BanEst') ?></label>
            <select name="Id_BanEst" id="Id_BanEst" class="form-control selectpicker" data-live-search="true" required>
                <option value="">Seleccione</option>
                <?php
                foreach($all_banco_estado as $banco_estado)
                { 
                    $print_value =  $banco_estado->Nombre_BanEst;
                    $selected = ($banco_estado->Id_BanEst==$Id_BanEst) ? 'selected':'';
                    echo '<option value="'.$banco_estado->Id_BanEst.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>
        </div>
        
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_TipCueBan" class="required"><?=t('Id_TipCueBan'); ?> <?php echo form_error('Id_TipCueBan') ?></label>
            <select name="Id_TipCueBan" id="Id_TipCueBan" class="form-control selectpicker" data-live-search="true" required>
                <option value="">Seleccione</option>
                <?php
                foreach($all_tipo_cuenta_banco as $tipo_cuenta_banco)
                { 
                    $print_value =  $tipo_cuenta_banco->Nombre_TipCueBan;
                    $selected = ($tipo_cuenta_banco->Id_TipCueBan==$Id_TipCueBan) ? 'selected':'';
                    echo '<option value="'.$tipo_cuenta_banco->Id_TipCueBan.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>
        </div>

        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="FechaRegistro"><?=t('FechaRegistro'); ?> <?php echo form_error('FechaRegistro') ?></label>
            <div class="input-group-prepend group-ico">
                <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                <input type="text" class="form-control" name="FechaRegistro" id="FechaRegistro" placeholder="Fecha registro" value="<?php echo $FechaRegistro; ?>" readonly />
            </div>
        </div>
	    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <label for="Descripcion_Ban"><?=t('Descripcion_Ban'); ?> <?php echo form_error('Descripcion_Ban') ?></label>
            <textarea class="form-control" rows="3" name="Descripcion_Ban" id="Descripcion_Ban" placeholder="Descripcion"><?php echo $Descripcion_Ban; ?></textarea>
        </div>
            <input type="hidden" class="form-control" name="Primary_Usu" id="Primary_Usu" placeholder="Primary Usu" value="<?php echo $Primary_Usu; ?>" />
		
        
	</div>
    </div>

    <div class="card-footer text-right">
        
	    <input type="hidden" name="Id_Ban" value="<?php echo $Id_Ban; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('bancos') ?>" class="btn btn-danger">Cancelar</a>
    </div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    