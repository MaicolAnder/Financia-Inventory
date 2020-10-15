
<div class="card">
    <form action="<?php echo $action; ?>" method="post">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Persona </h2> -->
        <h5 class="text-left" style="margin-top:0px"><?php echo $page ?> <i class="fas fa-angle-down" style="float: right;"></i></h5>
    </div>
    <div class="text-center" style="margin-top: 0px"  id="message">              
        <?php echo $this->session->userdata('message') <> '' ? '<div class="alert alert-info alert-dismissible fade show" role="alert" style="border-radius: .0rem;"><strong>'.$this->session->userdata('message').'</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' : ''; ?>
    </div>
    <div class="card-body">
        <!-- <h6 class="card-title">Titulo <i class="fas fa-sort-alpha-down"></i></h6> -->
        <!-- <p class="card-text">Best ugg boots on the planet. Free shipping, 24/7 customer service.</p>-->
        <div class="section-panel">    
            <div class="with-all">
                <h6 class="card-title"><i class="fas fa-sort-alpha-down"></i> Información básica</h6>
            </div>
            <div class="card-text row">

                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_PerTipId"><?=t('Id_PerTipId'); ?> <?php echo form_error('Id_PerTipId') ?></label>
                    <select name="Id_PerTipId" id="Id_PerTipId" class="form-control selectpicker" data-live-search="true" required>
                        <option value="">Seleccione</option>
                        <?php
                        foreach($all_persona_tipo_identificacion as $persona_tipo_identificacion)
                        { 
                            $print_value =  "(".$persona_tipo_identificacion->Codigo_PerTipId.") ".$persona_tipo_identificacion->Descripcion_PerTipId;
                            $selected = ($persona_tipo_identificacion->Id_PerTipId==$Id_PerTipId) ? 'selected':'';
                            echo '<option value="'.$persona_tipo_identificacion->Id_PerTipId.'"  '.$selected.'> '.$print_value.'</option>';
                        } ?>
                    </select>
                </div>
                
        	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Identificacion_Per"><?=t('Identificacion_Per'); ?> <?php echo form_error('Identificacion_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Identificacion_Per" id="Identificacion_Per" placeholder="Identificación" value="<?php echo $Identificacion_Per; ?>" />
                    </div>
                </div>
        	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Nombre1_Per"><?=t('Nombre1_Per'); ?> <?php echo form_error('Nombre1_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Nombre1_Per" id="Nombre1_Per" placeholder="<?=t('Nombre1_Per'); ?>" required value="<?php echo $Nombre1_Per; ?>" />
                    </div>
                </div>
        	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Nombre2_Per"><?=t('Nombre2_Per'); ?> <?php echo form_error('Nombre2_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Nombre2_Per" id="Nombre2_Per" placeholder="<?=t('Nombre2_Per'); ?>" value="<?php echo $Nombre2_Per; ?>" />
                    </div>
                </div>
        	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Apeliido1_Per"><?=t('Apeliido1_Per'); ?> <?php echo form_error('Apeliido1_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Apeliido1_Per" id="Apeliido1_Per" placeholder="<?php echo form_error('Apeliido1_Per') ?>" value="<?php echo $Apeliido1_Per; ?>" />
                    </div>
                </div>
        	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Apellido2_Per"><?=t('Apellido2_Per'); ?> <?php echo form_error('Apellido2_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Apellido2_Per" id="Apellido2_Per" placeholder="<?=t('Apellido2_Per'); ?>" value="<?php echo $Apellido2_Per; ?>" />
                    </div>
                </div>
        	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Telefono_Per"><?=t('Telefono_Per'); ?> <?php echo form_error('Telefono_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Telefono_Per" id="Telefono_Per" placeholder="<?=t('Telefono_Per'); ?>" value="<?php echo $Telefono_Per; ?>" />
                    </div>
                </div>
        	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="TelCelular_Per"><?=t('TelCelular_Per'); ?> <?php echo form_error('TelCelular_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="TelCelular_Per" id="TelCelular_Per" placeholder="<?=t('TelCelular_Per'); ?>" value="<?php echo $TelCelular_Per; ?>" />
                    </div>
                </div>
        	    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label for="Correo_Per"><?=t('Correo_Per'); ?> <?php echo form_error('Correo_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="email" class="form-control" name="Correo_Per" id="Correo_Per" placeholder="E-mail" value="<?php echo $Correo_Per; ?>" />
                    </div>
                </div>
        	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Direccion_Per"><?=t('Direccion_Per'); ?> <?php echo form_error('Direccion_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Direccion_Per" id="Direccion_Per" placeholder="Direccion Per" value="<?php echo $Direccion_Per; ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="section-panel">    
            <div class="with-all">
                <h6 class="card-title"><i class="fas fa-sort-alpha-down"></i> Información adicional</h6>
            </div>
            <div class="card-text row">
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_PerTip"><?=t('Id_PerTip'); ?> <?php echo form_error('Id_PerTip') ?></label>
                    <select name="Id_PerTip" id="Id_PerTip" class="form-control selectpicker" data-live-search="true" required>
                        <option value="">Seleccione</option>
                        <?php
                        foreach($all_persona_tipo as $persona_tipo)
                        { 
                            $print_value =  $persona_tipo->Descripcion_PerTip;
                            $selected = ($persona_tipo->Id_PerTip==$Id_PerTip) ? 'selected':'';
                            echo '<option value="'.$persona_tipo->Id_PerTip.'"  '.$selected.'> '.$print_value.'</option>';
                        } ?>
                    </select>
                </div>

                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_PerEst"><?=t('Id_PerEst'); ?> <?php echo form_error('Id_PerEst') ?></label>
                    <select name="Id_PerEst" id="Id_PerEst" class="form-control selectpicker" data-live-search="true" required>
                        <option value="">Seleccione</option>
                        <?php
                        foreach($all_persona_estado as $persona_estado)
                        { 
                            $print_value =  $persona_estado->Estado_PerEst;
                            $selected = ($persona_estado->Id_PerEst==$Id_PerEst) ? 'selected':'';
                            echo '<option value="'.$persona_estado->Id_PerEst.'"  '.$selected.'> '.$print_value.'</option>';
                        } ?>
                    </select>
                </div>

               <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Celular_Per"><?=t('Celular_Per'); ?> <?php echo form_error('Celular_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Celular_Per" id="Celular_Per" placeholder="<?=t('Celular_Per'); ?>" value="<?php echo $Celular_Per; ?>" />
                    </div>
                </div>

    	       <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="FechaNacimiento_Per"><?=t('FechaNacimiento_Per'); ?> <?php echo form_error('FechaNacimiento_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="date" class="form-control" name="FechaNacimiento_Per" id="FechaNacimiento_Per" placeholder="FechaNacimiento Per" value="<?php echo $FechaNacimiento_Per; ?>" />
                    </div>
                </div>
    	       <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="FechaRegistro_Per"><?=t('FechaRegistro_Per'); ?> <?php echo form_error('FechaRegistro_Per') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="FechaRegistro_Per" id="FechaRegistro_Per" placeholder="FechaRegistro Per" value="<?php echo $FechaRegistro_Per; ?>" readonly />
                    </div>
                </div>
            <?php /* ?>
    	       <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Primary_Usu"><?=t('Primary_Usu'); ?> <?php echo form_error('Primary_Usu') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Primary_Usu" id="Primary_Usu" placeholder="Primary Usu" value="<?php echo $Primary_Usu; ?>" />
                    </div>
                </div>
    		<?php */ ?>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Id_Emp"><?=t('Id_Emp'); ?> <?php echo form_error('Id_Emp') ?></label>
                    <select name="Id_Emp" id="Id_Emp" class="form-control selectpicker" data-live-search="true">
                        <option value="">Seleccione</option>
                        <?php
                        foreach($all_empresa as $empresa)
                        { 
                            $print_value =  $empresa->Nombre_Emp;
                            $selected = ($empresa->Id_Emp==$Id_Emp) ? 'selected':'';
                            echo '<option value="'.$empresa->Id_Emp.'"  '.$selected.'> '.$print_value.'</option>';
                        } ?>
                    </select>
                </div>
        		
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Id_Mun"><?=t('Id_Mun'); ?> <?php echo form_error('Id_Mun') ?></label>
                    <select name="Id_Mun" id="Id_Mun" class="form-control selectpicker" data-live-search="true">
                        <option value="">Seleccione</option>
                        <optgroup label="">
                            
                        </optgroup>
                        <?php
                        foreach($all_municipio as $municipio)
                        { 
                            $departamento = $this->Departamento_model->get_by_id($municipio->Id_Dep);
                            $print_value =  $municipio->Nombre_Num." (".$departamento->Nombre_Dep.")";
                            $selected = ($municipio->Id_Mun==$Id_Mun) ? 'selected':''; 

                            
                            echo '<option value="'.$municipio->Id_Mun.'"  '.$selected.'> '.$print_value.'</option>';
                        } ?>
                    </select>
                </div>
        		
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Id_PerGen"><?=t('Id_PerGen'); ?> <?php echo form_error('Id_PerGen') ?></label>
                    <select name="Id_PerGen" id="Id_PerGen" class="form-control selectpicker" data-live-search="true">
                        <option value="">Seleccione</option>
                        <?php
                        foreach($all_persona_genero as $persona_genero)
                        { 
                            $print_value =  "(".$persona_genero->Codigo_PerGen.") ".$persona_genero->Descripcion_PerGen;
                            $selected = ($persona_genero->Id_PerGen==$Id_PerGen) ? 'selected':'';
                            echo '<option value="'.$persona_genero->Id_PerGen.'"  '.$selected.'> '.$print_value.'</option>';
                        } ?>
                    </select>
                </div>
        		
                
            </div>
        </div>
	<!-- End card -->	
	</div>
    <div class="card-footer text-right">
        
	    <input type="hidden" name="Id_Per" value="<?php echo $Id_Per; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('persona') ?>" class="btn btn-danger">Cancelar</a>
    </div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    