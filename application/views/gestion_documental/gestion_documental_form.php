<div>
        <!-- <h2 style="margin-top:0px">Gestion_documental <?php echo $button ?></h2> -->
        <h5 class="text-right" style="margin-top:0px"><?php echo $page ?></h5>
        <hr>
        <form action="<?php echo $action; ?>" method="post">
        <div class="row">
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Nombre_GesDoc">Nombre GesDoc <?php echo form_error('Nombre_GesDoc') ?></label>
                <input type="text" class="form-control" name="Nombre_GesDoc" id="Nombre_GesDoc" placeholder="Nombre GesDoc" value="<?php echo $Nombre_GesDoc; ?>" />
            </div>
	    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <label for="Descripcion_GesDoc">Descripcion GesDoc <?php echo form_error('Descripcion_GesDoc') ?></label>
            <textarea class="form-control" rows="3" name="Descripcion_GesDoc" id="Descripcion_GesDoc" placeholder="Descripcion GesDoc"><?php echo $Descripcion_GesDoc; ?></textarea>
        </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="NombreInterno_GesDoc">NombreInterno GesDoc <?php echo form_error('NombreInterno_GesDoc') ?></label>
                <input type="text" class="form-control" name="NombreInterno_GesDoc" id="NombreInterno_GesDoc" placeholder="NombreInterno GesDoc" value="<?php echo $NombreInterno_GesDoc; ?>" />
            </div>
	    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <label for="Ubicacion_GesDoc">Ubicacion GesDoc <?php echo form_error('Ubicacion_GesDoc') ?></label>
            <textarea class="form-control" rows="3" name="Ubicacion_GesDoc" id="Ubicacion_GesDoc" placeholder="Ubicacion GesDoc"><?php echo $Ubicacion_GesDoc; ?></textarea>
        </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Formato_GesDoc">Formato GesDoc <?php echo form_error('Formato_GesDoc') ?></label>
                <input type="text" class="form-control" name="Formato_GesDoc" id="Formato_GesDoc" placeholder="Formato GesDoc" value="<?php echo $Formato_GesDoc; ?>" />
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Tamanio_GesDoc">Tamanio GesDoc <?php echo form_error('Tamanio_GesDoc') ?></label>
                <input type="text" class="form-control" name="Tamanio_GesDoc" id="Tamanio_GesDoc" placeholder="Tamanio GesDoc" value="<?php echo $Tamanio_GesDoc; ?>" />
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="FechaRegistro_GesDoc">FechaRegistro GesDoc <?php echo form_error('FechaRegistro_GesDoc') ?></label>
                <input type="text" class="form-control" name="FechaRegistro_GesDoc" id="FechaRegistro_GesDoc" placeholder="FechaRegistro GesDoc" value="<?php echo $FechaRegistro_GesDoc; ?>" />
            </div>
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_Afi">Afiliado <?php echo form_error('Id_Afi') ?></label>
            <select name="Id_Afi" id="Id_Afi" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
                <?php
                foreach($all_afiliado as $afiliado)
                { 
                    $print_value =  $afiliado->Id_Afi;
                    $selected = ($afiliado->Id_Afi==$Id_Afi) ? 'selected':'';
                    echo '<option value="'.$afiliado->Id_Afi.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>
        </div>
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_Aut">Autorizaciones <?php echo form_error('Id_Aut') ?></label>
            <select name="Id_Aut" id="Id_Aut" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
                <?php
                foreach($all_autorizaciones as $autorizaciones)
                { 
                    $print_value =  $autorizaciones->Id_Aut;
                    $selected = ($autorizaciones->Id_Aut==$Id_Aut) ? 'selected':'';
                    echo '<option value="'.$autorizaciones->Id_Aut.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>
        </div>
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_Con">Contratos <?php echo form_error('Id_Con') ?></label>
            <select name="Id_Con" id="Id_Con" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
                <?php
                foreach($all_contratos as $contratos)
                { 
                    $print_value =  $contratos->Id_Con;
                    $selected = ($contratos->Id_Con==$Id_Con) ? 'selected':'';
                    echo '<option value="'.$contratos->Id_Con.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>
        </div>
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_Per">Persona <?php echo form_error('Id_Per') ?></label>
            <select name="Id_Per" id="Id_Per" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
                <?php
                foreach($all_persona as $persona)
                { 
                    $print_value =  $persona->Id_Per;
                    $selected = ($persona->Id_Per==$Id_Per) ? 'selected':'';
                    echo '<option value="'.$persona->Id_Per.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>
        </div>
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_PerAut">Pertinencia Autorizacion <?php echo form_error('Id_PerAut') ?></label>
            <select name="Id_PerAut" id="Id_PerAut" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
                <?php
                foreach($all_pertinencia_autorizacion as $pertinencia_autorizacion)
                { 
                    $print_value =  $pertinencia_autorizacion->Id_PerAut;
                    $selected = ($pertinencia_autorizacion->Id_PerAut==$Id_PerAut) ? 'selected':'';
                    echo '<option value="'.$pertinencia_autorizacion->Id_PerAut.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>
        </div>
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_Usu">Usuario <?php echo form_error('Id_Usu') ?></label>
            <select name="Id_Usu" id="Id_Usu" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
                <?php
                foreach($all_usuario as $usuario)
                { 
                    $print_value =  $usuario->Id_Usu;
                    $selected = ($usuario->Id_Usu==$Id_Usu) ? 'selected':'';
                    echo '<option value="'.$usuario->Id_Usu.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>
        </div></div><hr>
<div class="row justify-content-between">
    <div class="col-12"></div>
    <div class="col-12 text-right">
	    <input type="hidden" name="Id_GesDoc" value="<?php echo $Id_GesDoc; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('gestion_documental') ?>" class="btn btn-danger">Cancelar</a>
    </div>
</div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
    