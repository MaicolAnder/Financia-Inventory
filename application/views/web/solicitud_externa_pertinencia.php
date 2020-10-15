

<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <div class="jumbotron">
                <?php if (!$usuario_encontrado) { ?>
                <h2>
                    Solicitud de autorización de servicios de salud
                </h2>
                
                <form id="form_searh" action="<?php echo $action; ?>" method="post">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                            <div style="margin-top: 4px"  id="message">
                                <?php echo $this->session->userdata('message') <> '' ? '<div class="alert alert-success" role="alert"><strong>Información! </strong>'.$this->session->userdata('message').'</div>' : ''; ?>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
                            <label class="required" for="Id_PerTipId">Tipo documento <?php echo form_error('Id_PerTipId') ?></label>
                            <select name="Id_PerTipId" id="Id_PerTipId" required class="form-control selectpicker" data-live-search="true" required>
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
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <label class="required" for="Id_Afi_Solicitud">Número identificación <?php echo form_error('Id_Afi_Solicitud') ?></label>
                            <div class="input-group">
                                <input type="search" name="Id_Afi_Solicitud" id="Id_Afi_Solicitud" class="form-control" placeholder="Número de identificación" required>
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-secondary" id="btn_search">
                                        <i class="fas fa-search"></i> Buscar
                                    </button> 
                                    <button class="btn btn-info" onclick="javascript:location.reload();">
                                        <i class="fas fa-sync-alt"></i> Borrar
                                    </button> 
                                </div>
                            </div>
                        </div>
                        

                    </div><hr>
                    <small>Ingrese los datos solicitados</small>
                </form>
                <!-- 
                <p>
                    <a class="btn btn-primary btn-large" href="#">Learn more</a>
                </p> -->
    <?php } else { ?>
    

    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <thead>
                <th>Identificacion</th>
                <th>Primer Nombre</th>
                <th>Segundo Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>   <!--
                <th>Autorización</th>    
                <th>Radicado</th> -->
                <th>Estado</th>              
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $Identificacion_Per; ?></td>
                    <td><?php echo $Nombre1_Per; ?></td>
                    <td><?php echo $Nombre2_Per; ?></td>
                    <td><?php echo $Apeliido1_Per; ?></td>
                    <td><?php echo $Apellido2_Per; ?></td> <?php /* ?>
                    <td><?php echo $NumeroAutorizacion_Per; ?></td>
                    <td><?php echo $NumeroRadicado_Per; ?></td> <?php */ ?>
                    <td><?php echo $Nombre_EstServ; ?></td>
                </tr>
            </tbody>
        </table>
        <hr>
        <div class="row">
            <input type="hidden" name="Id_Afi" id="Id_Afi" value="<?php echo $Id_Afi; ?>">
            <?php /* ?>
            <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <label for="Id_AutOri"><?=t('Id_AutOri'); ?> <?php echo form_error('Id_AutOri') ?></label>
                <select name="Id_AutOri" id="Id_AutOri" class="form-control selectpicker" data-live-search="true">
                    <option value="">Seleccione</option>
                    <?php
                    foreach($all_autorizacion_origen as $autorizacion_origen)
                    { 
                        $print_value =  $autorizacion_origen->Nombre_AutOri;
                        $selected = ($autorizacion_origen->Id_AutOri==$Id_AutOri) ? 'selected':'';
                        echo '<option value="'.$autorizacion_origen->Id_AutOri.'"  '.$selected.'> '.$print_value.'</option>';
                    } ?>
                </select>
            </div> <?php */ ?>
            <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                <label class="required" for="Id_Emp_Solicitud">IPS Solicitante <?php echo form_error('Id_Emp_Solicitud') ?></label>
                <select name="Id_Emp_Solicitud" id="Id_Emp_Solicitud" class="form-control selectpicker" data-live-search="true" required>
                    <option value="">Seleccione</option>
                    <?php
                    foreach($all_empresa as $empresa)
                    { 
                        $print_value =  "(".$empresa->Nit_Emp.") ".$empresa->Nombre_Emp;
                        $selected = ($empresa->Id_Emp==$Id_Emp_Solicitud) ? 'selected':'';
                        echo '<option value="'.$empresa->Id_Emp.'"  '.$selected.'> '.$print_value.'</option>';
                    } ?>
                </select>
            </div>   
            
        </div>
        <!-- <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12"> -->
        <fieldset class="container-fluid">
            <legend>Anexo de documentos</legend>
            <div class="" id="upload_file">
                <?php if (isset($documentos_listar)) { ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed" width="100%">
                        <thead>
                            <th>#</th>
                            <th>Nombre documento</th>
                            <th>Descripción</th>
                            <th>Fecha registro</th>
                            <th>ver</th>                    
                        </thead>
                        <tbody>
                            <?php 
                            $i = 1;
                            foreach ($documentos_listar as $key ) {
                                $file = site_url().'assets/uploads/pertinencia/'.$key->NombreInterno_GesDoc.$key->Formato_GesDoc?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=($key->Nombre_GesDoc!='') ? $key->Nombre_GesDoc : 'No se ha registrado ninguna observación' ;?></td>
                                    <td><?=$key->Descripcion_GesDoc?></td>
                                    <td><?=$key->FechaRegistro_GesDoc?></td>
                                    <td><button class="btn btn-primary"  onclick="window.location='<?=$file?>'" ><i class="fas fa-search"></button></td>
                                    
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php } else { ?>
                <div class="table-responsive">
                    <table class="table-condensed table-fixed" width="100%">
                        <tr>
                            <th>Archivo</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                        </tr>
                        <?php 
                        $j=0;
                        $NumDocs = (int) get_global_var('NumeroDoc_SolicitudPertinencia');
                        while ($j < $NumDocs) {
                            switch ($j) {
                                case '0':
                                    $msg = "Historia clínica";
                                    $descripcion = "";
                                    break;
                                case '1':
                                    $msg = "Orden médica";
                                    $descripcion = "";
                                    break;
                                case '2':
                                    $msg = "Soporte SOAT";
                                    $descripcion = "";
                                    break;
                                
                                default:
                                    $msg = "Documentos de soporte";
                                    $descripcion = "";
                                    break;
                            } ?>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="File_Upload" name="File_Upload[]" required>
                                            <label class="custom-file-label" for="File_Upload">Seleccione archivo</label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="Nombre_GesDoc[]" id="Nombre_GesDoc" placeholder="Nombre" value="<?php echo $Identificacion_Per." ".$msg; ?>" readonly />
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="Descripcion_GesDoc[]" id="Descripcion_GesDoc" value="<?php echo $msg ?>"  />
                                    </div>
                                </td>
                            </tr>
                        <?php 
                        $j++;
                        }
                        ?>
                    </table>
                </div>
            <small>* Adjunte história clínica, Ordén médica y soporte SOAT si lo requiere en formato PDF de hasta 2MB<br><br></small>
            <?php } ?>
        </div>
    </fieldset>
        
        
    <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> -->
    <fieldset class="container-fluid">
        <legend>Observaciones</legend>
        <?php if (isset($observaciones_listar)) { ?>
        <div class="table-responsive">
            <table class="table table-fixed table-bordered table-condensed" width="100%">
                <thead>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Anotación</th>
                    <th>Observaciones</th>
                    <th>Fecha y hora</th>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    foreach ($observaciones_listar as $key ) { 
                        $Persona = $this->Usuario_model->get_foreing_Id_Per($total_r, array('Id_Usu'=>$key->Id_Usu));
                        ?>
                        <tr>
                            <td><?=$i++?></td>
                            <td><?php echo 
                        $Persona[0]->Nombre1_Per." ".
                        $Persona[0]->Nombre2_Per." ".
                        $Persona[0]->Apeliido1_Per." ".
                        $Persona[0]->Apellido2_Per ?></td>
                            <td><?=$key->Observacion_AutRes;?></td>
                            <td><?=($key->Observacion_AutObs!='') ? $key->Observacion_AutObs : 'No se ha registrado ninguna observación' ;?></td>   
                            <td><?=$key->Fecha_AutRes?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="Nombre_PerObs" class="required">Observación <?php echo form_error('Nombre_PerObs') ?></label>
                <textarea  class="form-control" name="Nombre_PerObs" id="Nombre_PerObs" placeholder="Agregar nueva observación" required><?php echo $Nombre_PerObs; ?></textarea>
            </div> 
        </div>
    </fieldset>
    <!-- </div> -->
        
        
    <div class="row">
            

        <?php if (isset($medico_autorizador)): ?>
            <?php /* ?>
            <div class="form-group col-xs-12 col-sm-4 col-md-6 col-lg-4">
                <label>Pagos compartidos por el afiliado</label><br>
                <div class="custom-control custom-control-inline">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="ExoneracionPagosCompartidos_PerAut" id="ExoneracionPagosCompartidos_PerAut" placeholder="ExoneradoPagoCompartido" value="<?php echo $ExoneracionPagosCompartidos_PerAut; ?>" <?php echo ($ExoneracionPagosCompartidos_PerAut == 1) ? 'checked' : ''; ?>>
                        <label class="custom-control-label" for="ExoneracionPagosCompartidos_PerAut">Exonerado de Pago Compartido <?php echo form_error('ExoneracionPagosCompartidos_PerAut') ?></label>
                    </div>
                </div>
            </div>
            <div class="form-group col-xs-12 col-sm-4 col-md-6 col-lg-4">
                <label class="required" for="Id_PerAutEst">Nuevo Estado <?php echo form_error('Id_PerAutEst') ?></label>
                <select name="Id_PerAutEst" id="Id_PerAutEst" class="form-control selectpicker" data-live-search="true" required>
                    <option value="">Seleccione</option>
                    <?php
                    foreach($all_pertinencia_autorizacion_estado as $pertinencia_autorizacion_estado)
                    { 
                        $print_value =  $pertinencia_autorizacion_estado->NombrePerAutEst;
                        $selected = ($pertinencia_autorizacion_estado->Id_PerAutEst==$Id_PerAutEst) ? 'selected':'';
                        echo '<option value="'.$pertinencia_autorizacion_estado->Id_PerAutEst.'"  '.$selected.'> '.$print_value.'</option>';
                    } ?>
                </select>
            </div>
            
            <div class="form-group col-xs-12 col-sm-4 col-md-6 col-lg-4" id="div_Id_PerAutRev">
                <label for="Id_PerAutRev">Causales de negación del servicio <?php echo form_error('Id_PerAutRev') ?></label>
                <select name="Id_PerAutRev" id="Id_PerAutRev" class="form-control selectpicker" data-live-search="true">
                    <option value="">Seleccione</option>
                    <?php
                    if (!empty($all_pertinencia_autorizacion_revision)) {
                        foreach($all_pertinencia_autorizacion_revision as $pertinencia_autorizacion_revision)
                        { 
                            $print_value =  $pertinencia_autorizacion_revision->Nombre_PerAutRev;
                            $selected = ($pertinencia_autorizacion_revision->Id_PerAutRev==$Id_PerAutRev) ? 'selected':'';
                            echo '<option value="'.$pertinencia_autorizacion_revision->Id_PerAutRev.'"  '.$selected.'> '.$print_value.'</option>';
                        }
                    }
                     ?>
                </select>
            </div>

            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6" id="div_Id_CauExnPag">
                <label for="Id_CauExnPag">Causales Exoneracion Pagos Compartidos <?php echo form_error('Id_CauExnPag') ?></label>
                <select name="Id_CauExnPag" id="Id_CauExnPag" class="form-control selectpicker" data-live-search="true">
                    <option value="">Seleccione</option>
                    <?php
                    foreach($all_causales_exoneracion_pagos_compartidos as $causales_exoneracion_pagos_compartidos)
                    { 
                        $print_value =  $causales_exoneracion_pagos_compartidos->Nombre_CauExnPag;
                        $selected = ($causales_exoneracion_pagos_compartidos->Id_CauExnPag==$Id_CauExnPag) ? 'selected':'';
                        echo '<option value="'.$causales_exoneracion_pagos_compartidos->Id_CauExnPag.'"  '.$selected.'> '.$print_value.'</option>';
                    } ?>
                </select>
            </div>
            <?php */ ?>
        <?php endif ?>
    </div>

        <hr>

        <div class="row justify-content-between">
            <div class="col-12"></div>
            <div class="col-12 text-right">
                <input type="hidden" name="Id_Aut" value="<?php echo $Id_Aut; ?>" /> 
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                <a href="<?php echo site_url('web') ?>" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </form>
            <?php } ?>
            </div> 
        </div>
    </div>
</div>