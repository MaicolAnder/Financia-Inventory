<div>
        <!-- <h2 style="margin-top:0px">Empresa <?php echo $button ?></h2> -->
        <h2 class="text-right" style="margin-top:0px"><?php echo $page ?></h2>
        <hr>
        <form action="<?php echo $action; ?>" method="post">
        <div class="row">
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Nombre_Emp">Nombre <?php echo form_error('Nombre_Emp') ?></label>
                <input type="text" class="form-control" name="Nombre_Emp" id="Nombre_Emp" placeholder="Nombre" required value="<?php echo $Nombre_Emp; ?>" />
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="DigitoVerificacion_Emp">Digito Verificación <?php echo form_error('DigitoVerificacion_Emp') ?></label>
                <input type="text" class="form-control" name="DigitoVerificacion_Emp" id="DigitoVerificacion_Emp" placeholder="Digito de verificación" value="<?php echo $DigitoVerificacion_Emp; ?>" />
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Correo_Emp">Correo <?php echo form_error('Correo_Emp') ?></label>
                <input type="email" class="form-control" name="Correo_Emp" id="Correo_Emp" placeholder="Correo" value="<?php echo $Correo_Emp; ?>" />
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Direccion_Emp">Dirección <?php echo form_error('Direccion_Emp') ?></label>
                <input type="text" class="form-control" name="Direccion_Emp" id="Direccion_Emp" placeholder="Direccion" value="<?php echo $Direccion_Emp; ?>" />
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Telefono_Emp">Telefono <?php echo form_error('Telefono_Emp') ?></label>
                <input type="text" class="form-control" name="Telefono_Emp" id="Telefono_Emp" placeholder="Teléfono" value="<?php echo $Telefono_Emp; ?>" />
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="TelCelular_Emp">Celular <?php echo form_error('TelCelular_Emp') ?></label>
                <input type="text" class="form-control" name="TelCelular_Emp" id="TelCelular_Emp" placeholder="Celular Emp" value="<?php echo $TelCelular_Emp; ?>" />
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Nit_Emp">Nit <?php echo form_error('Nit_Emp') ?></label>
                <input type="text" class="form-control" name="Nit_Emp" id="Nit_Emp" placeholder="Nit" required value="<?php echo $Nit_Emp; ?>" />
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="CodigoIPS_Emp">Codigo IPS <?php echo form_error('CodigoIPS_Emp') ?></label>
                <input type="text" class="form-control" name="CodigoIPS_Emp" id="CodigoIPS_Emp" placeholder="Codigo IPS" value="<?php echo $CodigoIPS_Emp; ?>" />
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="CodigoSedeIPS_Emp">Codigo Sede IPS <?php echo form_error('CodigoSedeIPS_Emp') ?></label>
                <input type="text" class="form-control" name="CodigoSedeIPS_Emp" id="CodigoSedeIPS_Emp" placeholder="Codigo Sede IPS" value="<?php echo $CodigoSedeIPS_Emp; ?>" />
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="CodigoPrestador_Emp">Codigo Prestador <?php echo form_error('CodigoPrestador_Emp') ?></label>
                <input type="text" class="form-control" name="CodigoPrestador_Emp" id="CodigoPrestador_Emp" placeholder="Código prestador" value="<?php echo $CodigoPrestador_Emp; ?>" />
            </div>
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Sede_Emp">Sede empresa <?php echo form_error('Sede_Emp') ?></label>
            <select name="Sede_Emp" id="Sede_Emp" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
                <?php
                foreach($all_empresa as $empresa)
                { 
                    $print_value =  $empresa->Nombre_Emp." (".$empresa->Nit_Emp.")";
                    $selected = ($empresa->Id_Emp==$Sede_Emp) ? 'selected':'';
                    echo '<option value="'.$empresa->Id_Emp.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>
        </div>
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_EmpTip">Tipo empresa <?php echo form_error('Id_EmpTip') ?></label>
            <select name="Id_EmpTip" id="Id_EmpTip" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
                <?php
                foreach($all_empresa_tipo as $empresa_tipo)
                { 
                    $print_value =  $empresa_tipo->Nombre_EmpTip;
                    $selected = ($empresa_tipo->Id_EmpTip==$Id_EmpTip) ? 'selected':'';
                    echo '<option value="'.$empresa_tipo->Id_EmpTip.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>
        </div>
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_Mun">Municipio <?php echo form_error('Id_Mun') ?></label>
            <select name="Id_Mun" id="Id_Mun" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
                <?php
                foreach($all_municipio as $municipio)
                { 
                    $print_value =  $municipio->Nombre_Num;
                    $selected = ($municipio->Id_Mun==$Id_Mun) ? 'selected':'';
                    echo '<option value="'.$municipio->Id_Mun.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>
        </div></div><hr>
<div class="row justify-content-between">
    <div class="col-4"></div>
    <div class="col-4 text-right">
	    <input type="hidden" name="Id_Emp" value="<?php echo $Id_Emp; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('empresa') ?>" class="btn btn-danger">Cancelar</a>
    </div>
</div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    