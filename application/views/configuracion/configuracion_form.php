<div>
        <!-- <h2 style="margin-top:0px">Configuracion <?php echo $button ?></h2> -->
        <h5 class="text-right" style="margin-top:0px"><?php echo $page ?></h5>
        <hr>
        <form action="<?php echo $action; ?>" method="post">
        <div class="row">
	    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label class="required" for="key_Conf">Nombre <?php echo form_error('key_Conf') ?></label>
                <input type="text" class="form-control" name="key_Conf" id="key_Conf" placeholder="Key Conf" value="<?php echo $key_Conf; ?>" required />
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label class="required" for="Value_Conf">Valor<?php echo form_error('Value_Conf') ?></label>
                <input type="text" class="form-control" name="Value_Conf" id="Value_Conf" placeholder="Value Conf" value="<?php echo $Value_Conf; ?>"  required/>
            </div>
	    
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label class="required" for="Id_ConfTip">Configuracion Tipo <?php echo form_error('Id_ConfTip') ?></label>
            <select name="Id_ConfTip" id="Id_ConfTip" class="form-control selectpicker" data-live-search="true" required>
                <option value="">Seleccione</option>
                <?php
                foreach($all_configuracion_tipo as $configuracion_tipo)
                { 
                    $print_value =  $configuracion_tipo->Nombre_ConfTip;
                    $selected = ($configuracion_tipo->Id_ConfTip==$Id_ConfTip) ? 'selected':'';
                    echo '<option value="'.$configuracion_tipo->Id_ConfTip.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>
        </div>
            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="Descripcion_Conf">Descripcion <?php echo form_error('Descripcion_Conf') ?></label>
                <textarea class="form-control" name="Descripcion_Conf" id="Descripcion_Conf" placeholder="Descripcion"><?php echo $Descripcion_Conf; ?></textarea>
            </div>
        </div>
        <hr>
<div class="row justify-content-between">
    <div class="col-12"></div>
    <div class="col-12 text-right">
	    <input type="hidden" name="Id_Conf" value="<?php echo $Id_Conf; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('configuracion') ?>" class="btn btn-danger">Cancelar</a>
    </div>
</div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    