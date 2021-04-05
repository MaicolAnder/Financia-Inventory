
<div class="card">
    <form action="<?php echo $action; ?>" method="post" id="formDocument">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Documento </h2> -->
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
                <h6 class="card-title"><i class="fas fa-sort-alpha-down"></i> Detalles del documento</h6>
            </div>
            <div class="card-text row">
                <?php 
                if ($type=='income' || $type=='quotes' || $type=='referrals') {
                    $txt_Id_Per = 'Id_Per_income';
                } else {
                    $txt_Id_Per = 'Id_Per_expenses';
                }
                ?>
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label for="Id_Per" class="required"><?=t($txt_Id_Per) ; ?> <?php echo form_error('Id_Per') ?></label>
                    <select name="Id_Per" id="Id_Per" class="form-control selectpicker" data-live-search="true" required> <?php
                        if ($Id_Per != '') {
                            $persona = $this->Persona_model->get_by_id($Id_Per);
                            $print_value =  "(".$persona->Identificacion_Per.") ".$persona->Nombre1_Per." ".$persona->Nombre2_Per." ".$persona->Apeliido1_Per." ".$persona->Apellido2_Per;
                            echo '<option value="'.$persona->Id_Per.'"  selected> '.$print_value.'</option>';
                        }
                        

                     /* ?>
                        <option value="">Seleccione</option>
                        <?php
                        foreach($all_persona as $persona)
                        { 
                            $print_value =  "(".$persona->Identificacion_Per.") ".$persona->Nombre1_Per." ".$persona->Nombre2_Per." ".$persona->Apeliido1_Per." ".$persona->Apellido2_Per;
                            $selected = ($persona->Id_Per==$Id_Per) ? 'selected':'';
                            echo '<option value="'.$persona->Id_Per.'"  '.$selected.'> '.$print_value.'</option>';
                        } ?>*/ ?>
                    </select>
                    
                </div>			
    			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Numero_Doc" class="required"><?=t('Numero_Doc'); ?> <?php echo form_error('Numero_Doc') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Numero_Doc" id="Numero_Doc" placeholder="<?=t('Numero_Doc'); ?>" value="<?php echo $Numero_Doc; ?>" required />
                    </div>
                </div>
    			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="FechaDocumento_Doc" class="required"><?=t('FechaDocumento_Doc'); ?> <?php echo form_error('FechaDocumento_Doc') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="date" class="form-control" name="FechaDocumento_Doc" id="FechaDocumento_Doc" placeholder="FechaDocumento Doc" value="<?php echo $FechaDocumento_Doc; ?>" required/>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Id_TerPag" class="required"><?=t('Id_TerPag'); ?> <?php echo form_error('Id_TerPag') ?></label>
                    <select name="Id_TerPag" id="Id_TerPag" class="form-control selectpicker" data-live-search="true" required>
                        <option value="">Seleccione</option>
                        <?php
                        foreach($all_termino_pago as $termino_pago)
                        { 
                            $print_value =  $termino_pago->Nombre_TerPag;
                            $selected = ($termino_pago->Id_TerPag==$Id_TerPag) ? 'selected':'';
                            echo '<option data-value="'.$termino_pago->Dias_TerPag.'" value="'.$termino_pago->Id_TerPag.'"  '.$selected.'> '.$print_value.'</option>';
                        } ?>
                    </select>
                </div>
    			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="FechaVencimiento_Doc"><?=t('FechaVencimiento_Doc'); ?> <?php echo form_error('FechaVencimiento_Doc') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="date" class="form-control" name="FechaVencimiento_Doc" id="FechaVencimiento_Doc" placeholder="FechaVencimiento Doc" value="<?php echo $FechaVencimiento_Doc; ?>" />
                    </div>
                </div>

                <?php if ($Editar) { ?>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Id_DocTip"><?=t('Id_DocTip'); ?> <?php echo form_error('Id_DocTip') ?></label>
                    <select name="Id_DocTip" id="Id_DocTip" class="form-control selectpicker" disabled data-live-search="true">
                        <option value="">Seleccione</option>
                        <?php
                        foreach($all_documento_tipo as $documento_tipo)
                        { 
                            $print_value =  $documento_tipo->Nombre_DocTip;
                            $selected = ($documento_tipo->Id_DocTip==$Id_DocTip) ? 'selected':'';
                            echo '<option value="'.$documento_tipo->Id_DocTip.'"  '.$selected.'> '.$print_value.'</option>';
                        } ?>
                    </select>
                </div>
                    
                <?php } else { ?>
                    <input type="hidden" name="Id_DocTip" id="Id_DocTip" value="<?=$Id_DocTip;?>">
                <?php } ?>
                <?php /* ?>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="IvaIncluido_Doc"><?=t('IvaIncluido_Doc'); ?> <?php echo form_error('IvaIncluido_Doc') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="IvaIncluido_Doc" id="IvaIncluido_Doc" placeholder="IvaIncluido Doc" value="<?php echo $IvaIncluido_Doc; ?>" />
                    </div>
                </div> <?php */ ?>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Id_ListPre"><?=t('Id_ListPre'); ?> <?php echo form_error('Id_ListPre') ?></label>
                    <select name="Id_ListPre" id="Id_ListPre" class="form-control selectpicker" data-live-search="true">
                        <option value="">Seleccione</option>
                        <?php
                        foreach($all_lista_precios as $lista_precios)
                        { 
                            $print_value =  $lista_precios->Nombre_ListPre;
                            $selected = ($lista_precios->Id_ListPre==$Id_ListPre) ? 'selected':'';
                            echo '<option value="'.$lista_precios->Id_ListPre.'"  '.$selected.'> '.$print_value.'</option>';
                        } ?>
                    </select>
                </div>
                <?php if (!$Editar) { ?>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="" for="IvaIncluido_Doc"><?=t('IvaIncluido_Doc'); ?> <?php echo form_error('IvaIncluido_Doc') ?></label><br>
                    <?php 
                    $Activo=""; $Inactivo="";
                    if ($IvaIncluido_Doc == '1') {
                        $Activo = 'checked';
                    } elseif ($IvaIncluido_Doc == '0') {
                        $Inactivo = 'checked';
                    }
                    ?>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="IvaIncluido_Doc_Activo" name="IvaIncluido_Doc"  value="1" <?php echo $Activo ?> >
                        <label class="custom-control-label" for="IvaIncluido_Doc_Activo">Si</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="IvaIncluido_Doc_Inactivo" name="IvaIncluido_Doc"  value="0" <?php echo $Inactivo ?>>
                        <label class="custom-control-label" for="IvaIncluido_Doc_Inactivo">No</label>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
            <!--- Here is details -->
        <div class="table-responsive-md">
            <table class="table table-cell table-hover table-condensed table-sm" width="100%">
                <thead class="text-center">
                    <th class="text-center color-danger"><i class="fas fa-times-circle"></i></th>
                    <th style="width: 300px;"><?=t('Id_Ite'); ?></th>
                    <?php
                    if ($type == 'expenses' || $type == 'purchase_order') { ?>
                        <th style="width: 120px;"><?=t('Id_Med'); ?></th>
                        <th style="width: 120px;"><?=t('Id_Bod'); ?></th>
                    <?php }
                    ?>
                    <th style="width: 150px;"><?=t('Costo_Kar'); ?></th>
                    <th style="width: 60px;"><?=t('Descuento_Kar'); ?></th>
                    <th style="width: 100px;"><?=t('Id_Imp'); ?></th>
                    <th style="width: 100px;"><?=t('Cantidad_Kar'); ?></th>
                    <th><?=t('Observacion_Kar'); ?></th>
                    <th style="width: 150px;"><?=t('Subtotal'); ?></th>                  
                    <?php if ($type=='income' || $type=='quotes' || $type=='referrals') { ?>
                        <th title="¿Aceptado?"><?=t('Aceptado_Kar'); ?></th>
                    <?php } ?>
                </thead>
                <tbody id="itemsbody">
                    <?php 
                    // Editar documentos para tipos 1 & 2;
                    if ($Editar) {
                        $kardex = $this->Kardex_model->get_all('*', ['Id_Doc'=>$Id_Doc], ['Id_kar'=>'ASC']);
                        foreach ($kardex as $k) { ?>
                            <tr class="tr" id="tr_<?=$k->Id_kar;?>">
                                <td class="text-center align-middle color-danger delete"><i class="fas fa-times-circle" title="Eliminar de la lista"></i></td>
                                <td>
                                    <input type="hidden" name="Id_Ite[]" id="Id_Ite_<?=$k->Id_kar;?>" value="<?=$k->Id_Ite;?>" required>
                                    <input class="form-control item cell-formar-sum" type="search" id="item_value_<?=$k->Id_kar;?>" name="item_value[]" placeholder="Nombre o código de item" autocomplete="off" value="<?=$this->Items_model->get_by_id($k->Id_Ite)->Nombre_Ite;?>" required>
                                </td>
                                <?php if ($type == 'expenses' || $type == 'purchase_order') { ?>
                                <td>
                                    <select name="Id_Med[]" id="Id_Med_<?=$k->Id_kar;?>" class="form-control selectpicker cell-formar-sum" data-live-search="true">
                                        <option value="">Seleccione</option>
                                        <?php
                                        foreach($all_medidas as $medidas)
                                        { 
                                            $print_value =  $medidas->Nombre_Med;
                                            $selected = ($medidas->Id_Med==$this->Items_model->get_by_id($k->Id_Ite)->Id_Med) ? 'selected':'';
                                            echo '<option value="'.$medidas->Id_Med.'"  '.$selected.'> '.$print_value.'</option>';
                                        } ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="Id_Bod[]" id="Id_Bod_<?=$k->Id_kar;?>" class="form-control selectpicker cell-formar-sum" data-live-search="true">
                                        <option value="">Seleccione</option>
                                        <?php
                                        foreach($all_bodegas as $bodegas)
                                        { 
                                            $print_value =  $bodegas->Nombre_Bod;
                                            $selected = ($bodegas->Id_Bod==$this->Items_model->get_by_id($k->Id_Ite)->Id_Bod) ? 'selected':'';
                                            echo '<option value="'.$bodegas->Id_Bod.'"  '.$selected.'> '.$print_value.'</option>';
                                        } ?>
                                    </select>
                                </td>
                                <?php } ?>
                                <td><input class="form-control text-right cell-formar-sum" type="number" min="0" step="1" id="costo_<?=$k->Id_kar;?>" name="costo[]" placeholder="$ 0.00" value="<?=$k->Costo_Kar;?>" required></td>
                                <td><input class="form-control text-right cell-formar-sum" type="number" min="0" step="any" id="descuento_<?=$k->Id_kar;?>" name="descuento[]" placeholder="0 %" value="<?=$k->Descuento_Kar;?>"></td>
                                <td>
                                    <select name="Id_Imp[]" id="Id_Imp_<?=$k->Id_kar;?>" class="form-control selectpicker cell-formar-sum" data-live-search="true" multiple data-selected-text-format="count">
                                        <?php
                                        $r = $this->Impuestos_kardex_model->get_all('*', ['Id_kar'=>$k->Id_kar]);
                                        // ver_array($r);
                                        $Id_Imp = array();
                                        if ($r) {
                                            foreach ($r as $x) {
                                                array_push($Id_Imp, $x->Id_Imp);
                                            }
                                        }
                                        foreach($all_impuestos as $impuestos)
                                        { 
                                            $print_value =  $impuestos->Nombre_Imp." (".$impuestos->Valor_Imp."%)";
                                            $selected = (in_array($impuestos->Id_Imp, $Id_Imp)) ? 'selected':'';
                                            echo '<option data-value="'.$impuestos->Valor_Imp.'" value="'.$impuestos->Id_Imp.'"  '.$selected.'> '.$print_value.'</option>';
                                        } ?>
                                    </select>
                                </td>
                                <td><input class="form-control text-right cell-formar-sum" type="number" min="0" step="any" id="cantidad_<?=$k->Id_kar;?>" name="cantidad[]" placeholder="Cant." value="<?=$k->Cantidad_Kar;?>" required></td>
                                <td><input class="form-control cell-formar-sum" type="text" id="observacion_<?=$k->Id_kar;?>" name="observacion[]" value="<?=$k->Observacion_Kar;?>"></td>
                                <td><input class="form-control text-right subtotal cell-formar-sum" type="number" step="any" name="subtotal" id="subtotal_<?=$k->Id_kar;?>" placeholder="$0.00" readonly></td>
                                <?php if ($type=='income' || $type=='quotes') { ?>
                                <td class="text-center align-middle"><input class="radio-ci" type="checkbox" id="ok_<?=$k->Id_kar;?>" name="ok[]" title="¿Aceptado?"></td>
                            <?php } ?>
                            </tr>
                        <?php }                         
                    } else { 
                    // Al crear un nuevo documento para tipos 1 & 2;
                        ?>
                        <tr class="tr" id="tr_0">
                            <td class="text-center align-middle color-danger delete"><i class="fas fa-times-circle" title="Eliminar de la lista"></i></td>
                            <td>
                                <input type="hidden" name="Id_Ite[]" id="Id_Ite_0" value="" required>
                                <input class="form-control item cell-formar-sum" type="search" id="item_value_0" name="item_value[]" placeholder="Nombre o código de item" autocomplete="off" value="<?=NULL?>" required>
                            </td>
                            <?php if ($type == 'expenses' || $type == 'purchase_order') { ?>
                            <td>
                                <select name="Id_Med[]" id="Id_Med_0" class="form-control selectpicker cell-formar-sum" data-live-search="true">
                                    <option value="">Seleccione</option>
                                    <?php
                                    foreach($all_medidas as $medidas)
                                    { 
                                        $print_value =  $medidas->Nombre_Med;
                                        $selected = ($medidas->Id_Med==$Id_Med) ? 'selected':'';
                                        echo '<option value="'.$medidas->Id_Med.'"  '.$selected.'> '.$print_value.'</option>';
                                    } ?>
                                </select>
                            </td>
                            <td>
                                <select name="Id_Bod[]" id="Id_Bod_0" class="form-control selectpicker cell-formar-sum" data-live-search="true">
                                    <option value="">Seleccione</option>
                                    <?php
                                    foreach($all_bodegas as $bodegas)
                                    { 
                                        $print_value =  $bodegas->Nombre_Bod;
                                        $selected = ($bodegas->Id_Bod==$Id_Bod) ? 'selected':'';
                                        echo '<option value="'.$bodegas->Id_Bod.'"  '.$selected.'> '.$print_value.'</option>';
                                    } ?>
                                </select>
                            </td>
                            <?php } ?>
                            <td><input class="form-control text-right cell-formar-sum" type="number" min="0" step="1" id="costo_0" name="costo[]" placeholder="$ 0.00" value="<?=NULL?>" required></td>
                            <td><input class="form-control text-right cell-formar-sum" type="number" min="0" step="any" id="descuento_0" name="descuento[]" placeholder="0 %" value="<?=NULL?>"></td>
                            <td>
                                <select name="Id_Imp[]" id="Id_Imp_0" class="form-control selectpicker cell-formar-sum" data-live-search="true" multiple data-selected-text-format="count">
                                    <?php
                                    foreach($all_impuestos as $impuestos)
                                    { 
                                        $print_value =  $impuestos->Nombre_Imp." (".$impuestos->Valor_Imp."%)";
                                        $selected = (in_array($impuestos->Id_Imp, $Id_Imp)) ? 'selected':'';
                                        echo '<option data-value="'.$impuestos->Valor_Imp.'" value="'.$impuestos->Id_Imp.'"  '.$selected.'> '.$print_value.'</option>';
                                    } ?>
                                </select>
                            </td>
                            <td><input class="form-control text-right cell-formar-sum" type="number" min="0" step="any" id="cantidad_0" name="cantidad[]" placeholder="Cant." required></td>
                            <td><input class="form-control cell-formar-sum" type="text" id="observacion_0" name="observacion[]"></td>
                            <td><input class="form-control text-right subtotal cell-formar-sum" type="number" step="any" name="subtotal" id="subtotal_0" placeholder="$0.00" readonly></td>
                            <?php if ($type=='income' || $type=='quotes' || $type=='referrals') { ?>
                            <td class="text-center align-middle"><input class="radio-ci" type="checkbox" id="ok_0" name="ok[]" title="¿Aceptado?"></td>
                        <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!--
        <div class="text-right">
            <button class="btn btn-info" type="button" id="add"><i class="fas fa-plus-circle"></i> Agregar nueva fila</button>
        </div> -->
        <div class="col-12 container">
                <div class="text-center color-sidebar row">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <strong>SUB TOTAL</strong>
                        <h4 id="subtotal">$0.00</h4>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <strong>IMPUESTOS</strong>
                        <h4 id="impuestos">$0.00</h4>
                    </div>

                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <strong>DESCUENTO</strong>
                        <h4 id="descuento">$0.00</h4>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <strong>TOTAL DOCUMENTO</strong>
                        <input type="hidden" id="txxr001">
                        <h4 id="total">$0.00</h4>
                    </div>
                </div>
                <div class="text-right">
                    <br>
                    <button class="btn btn-info" type="button" id="add"><i class="fas fa-plus-circle"></i> Agregar nueva fila</button>
                </div>
            </div>
                

            <!--- Here is details -->
        <div class="section-panel">    
            <div class="with-all">
                <h6 class="card-title"><i class="fas fa-sort-alpha-down"></i> Observación y costos</h6>
            </div>
            <div class="card-text row">
    			<div class="col-xs-12 col-md-12 col-sm-12 row">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label for="Observacion_Doc"><?=t('Observacion_Doc'); ?> <?php echo form_error('Observacion_Doc') ?></label>
                        <textarea class="form-control" rows="3" name="Observacion_Doc" id="Observacion_Doc" placeholder="<?=t('Observacion_Doc'); ?>"><?php echo $Observacion_Doc; ?></textarea>
                    </div>
                    <?php if ($Editar) { ?>
                    <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <label for="Id_DocEst"><?=t('Id_DocEst'); ?> <?php echo form_error('Id_DocEst') ?></label>
                        <select name="Id_DocEst" id="Id_DocEst" class="form-control selectpicker" data-live-search="true">
                            <option value="">Seleccione</option>
                            <?php
                            foreach($all_documento_estado as $documento_estado)
                            { 
                                $print_value =  $documento_estado->Nombre_DocEst;
                                $selected = ($documento_estado->Id_DocEst==$Id_DocEst) ? 'selected':'';
                                echo '<option value="'.$documento_estado->Id_DocEst.'"  '.$selected.'> '.$print_value.'</option>';
                            } ?>
                        </select>
                    </div>
                    <?php } else { ?>
                        <input type="hidden" name="Id_DocEst" id="Id_DocEst" value="<?=$Id_DocEst;?>">
                    <?php } ?>
                
                    <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
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
                    <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <label for="FechaRegistro_Doc"><?=t('FechaRegistro_Doc'); ?> <?php echo form_error('FechaRegistro_Doc') ?></label>
                        <div class="input-group-prepend group-ico">
                            <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                            <input type="text" class="form-control" name="FechaRegistro_Doc" id="FechaRegistro_Doc" placeholder="<?=t('FechaRegistro_Doc'); ?>" value="<?php echo $FechaRegistro_Doc; ?>" readonly />
                        </div>
                    </div>         
                </div>
<!--
                <div class="col-xs-12 col-md-5 col-sm-5">
                    <table class="table table-borderless table-sm text-right" width="100%">
                        <tr>
                            <td><strong>SUB TOTAL</strong></td>
                            <td><h4 id="subtotal">$0.00</h4></td>
                        </tr>
                        <tr>
                            <td><strong>DESCUENTO</strong></td>
                            <td><h4 id="descuento">$0.00</h4></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #212529;">
                            <td><strong>IMPUESTOS</strong></td>
                            <td><h4 id="impuestos">$0.00</h4></td>
                        </tr>
                        <tr>
                            <td><strong>TOTAL A PAGAR</strong></td>
                            <td><h4 id="total">$0.00</h4></td>
                        </tr>
                    </table>
                </div> -->
		</div>
    </div>
    </div>
    <div class="card-footer text-right">
        <input type="hidden" name="payments" id="payments" value="0">
        <input type="hidden" name="json" id="json" value="">
        <input type="hidden" name="type" value="<?=$type;?>">
	    <input type="hidden" name="Id_Doc" value="<?php echo $Id_Doc; ?>" />
        <?php if (($Editar==true) || ($type != 'quotes') || ($type != 'referrals')): ?>
        <button type="button" class="btn btn-info" id="paysave"><i class="fas fa-cash-register"></i> <?php echo $button ?> y pagar</button>           
        <?php endif ?>       
	    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> <?php echo $button ?></button>
	    <a href="<?php echo site_url('documento/listar/'.$type) ?>" class="btn btn-danger"><i class="fas fa-undo"></i> Cancelar</a>
    </div>
	</form>
</div>
<?php $this->load->view('footer'); ?>    
<script type="text/javascript">
    <?php if ($Editar) { ?>
        modSubtotales();
    <?php } ?>
    const typeExpence = '<?=$type;?>';

    $(document).ready(function() {
        // Termino de pago.
        document.getElementById("Id_TerPag").onchange = function() {
            var TP = document.getElementById("Id_TerPag");
            var TPval = TP.options[TP.selectedIndex].dataset.value;
            f = FechaAdicion('<?=date("Y-m-d")?>', '+'+TPval, 'd');
            document.getElementById('FechaVencimiento_Doc').value = f;
            console.log(f);
        }

        $('#Id_Per').select2({
            width: '100% !important',
            
            placeholder: 'Seleccione un contacto',
            ajax: {
                url: '<?php echo site_url('getresult/getcontact/'.$type.'/'.$Id_Per); ?>',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    }); 
    $(document).on('keydown', '.item', function(event) {
        var id = this.id;
        $('#' + id).autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?=site_url('getresult/getItems')?>",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term, list: $('#Id_ListPre').val(), type:'<?=$type;?>'
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                $(this).val(ui.item.label); // display the selected text
                var item = ui.item.value; // selected id to input
                var data = ui.item.data;
                var splitid = id.split('_');
                var i = splitid[2];
                <?php if ($type == 'expenses' || $type == 'purchase_order') { ?>
                    if (data.Id_Med) { document.getElementById('Id_Med_' + i).value = data.Id_Med; }
                    if (data.Id_Bod) { document.getElementById('Id_Bod_' + i).value = data.Id_Bod; }
                <?php } ?>
                if (data.Id_Ite) { document.getElementById('Id_Ite_' + i).value = data.Id_Ite; }
                if (data.PrecioVenta) { document.getElementById('costo_' + i).value = data.PrecioVenta; }
                if (data.Id_Imp) { $('#Id_Imp_' + i).selectpicker('val', data.Id_Imp.split(",")); }
                document.getElementById("cantidad_" + i).focus();
                $('.selectpicker').selectpicker('refresh');
                return false;
            }


        });
    });
    $(document).on('click', '.delete', function (event) {
        event.preventDefault();
        $(this).closest('tr').remove();
        modSubtotales();
    });
    $(document).on('change', '.cell-formar-sum', function(event) {
        modSubtotales();
    });
    $(document).on('click', '#paysave', function(event) {
        event.preventDefault();
        var $frm =  $("#formDocument");
        $frm.validate();
        if($frm.valid()){
            document.getElementById('payments').value = 1;
            // payments
            cargar();
            $frm.submit();
        } else {
            mensaje('Complete todos los campos obligatorios');
        }
    });
    
    $(document).on('click', '#add', function(event) {
        // Get last id
        var i = 0;
        var split_id = 0;
        var lastname_id = $('.tr').last().attr('id');
        if (lastname_id) {
            split_id = lastname_id.split('_');
            i = Number(split_id[1]) + 1;
        }
        var head = '<tr class="tr" id="tr_'+i+'">'+
            '<td class="text-center align-middle color-danger delete"><i class="fas fa-times-circle" title="Eliminar de la lista"></i></td>'+
            '<td>'+
                '<input type="hidden" name="Id_Ite[]" id="Id_Ite_'+i+'" value="" required>'+
                '<input class="form-control item cell-formar-sum" type="search" id="item_value_'+i+'" name="item_value[]" placeholder="Nombre o código de item" autocomplete="off" value="<?=NULL?>" required>'+
            '</td>';
        var body1 = '<td>'+
            '<select name="Id_Med[]" id="Id_Med_'+i+'" class="form-control selectpicker cell-formar-sum" data-live-search="true">'+
                        '<option value="">Seleccione</option>'+
                    <?php
                    foreach($all_medidas as $medidas)
                    { 
                        $print_value =  $medidas->Nombre_Med;
                        $selected =  '';
                        echo '\'<option value="'.$medidas->Id_Med.'"  '.$selected.'> '.$print_value.'</option>\'+';
                    } ?>
            '</select> </td>'+
            '<td> <select name="Id_Bod[]" id="Id_Bod_'+i+'" class="form-control selectpicker cell-formar-sum" data-live-search="true"> <option value="">Seleccione</option>'+
                    <?php
                    foreach($all_bodegas as $bodegas)
                    { 
                        $print_value =  $bodegas->Nombre_Bod;
                        $selected = '';
                        echo '\'<option value="'.$bodegas->Id_Bod.'"  '.$selected.'> '.$print_value.'</option>\'+';
                    } ?>
            '</select></td>';
        var body2 = '<td><input class="form-control text-right cell-formar-sum" type="number" min="0" step="1" id="costo_'+i+'" name="costo[]" placeholder="$ 0.00" value="<?=NULL?>" required></td>'+
            '<td><input class="form-control text-right cell-formar-sum" type="number" min="0" step="any" id="descuento_'+i+'" name="descuento[]" placeholder="0 %" value="<?=NULL?>"></td>'+
            '<td><select name="Id_Imp[]" id="Id_Imp_'+i+'" class="form-control selectpicker cell-formar-sum" data-live-search="true" multiple data-selected-text-format="count">'+
                    <?php
                    foreach($all_impuestos as $impuestos)
                    { 
                        $print_value =  $impuestos->Nombre_Imp." (".$impuestos->Valor_Imp."%)";
                        $selected = '';
                        echo '\'<option data-value="'.$impuestos->Valor_Imp.'" value="'.$impuestos->Id_Imp.'"  '.$selected.'> '.$print_value.'</option>\'+';
                    } ?>
                '</select></td>'+
            '<td><input class="form-control text-right cell-formar-sum" type="number" min="0" step="any" id="cantidad_'+i+'" name="cantidad[]" placeholder="Cant." required></td>'+
            '<td><input class="form-control cell-formar-sum" type="text" id="observacion_'+i+'" name="observacion[]"></td>'+
            '<td><input class="form-control text-right subtotal cell-formar-sum" type="number" step="any" name="subtotal" id="subtotal_'+i+'" placeholder="$0.00" readonly></td>';
        var body3 = '<td class="text-center align-middle"><input class="radio-ci" type="checkbox" id="ok_'+i+'" name="ok[]" title="¿Aceptado?"></td>';
        var body4 = '</tr>';
        html = head+body1+body2;
        if (typeExpence=='expenses' || typeExpence=='purchase_order') {
            html = head+body1+body2+body4;
        } 
        if (typeExpence=='income' || typeExpence=='quotes' || typeExpence=='referrals') {
            html = head+body2+body3+body4;
        }
        $('#itemsbody').append(html);
        document.getElementById("item_value_" + i).focus();
        modSubtotales();
        $('.selectpicker').selectpicker('refresh');

    });

function modSubtotales() {
    var Costo     = document.getElementsByName("costo[]");
    var Descuento = document.getElementsByName("descuento[]");
    var Cantidad  = document.getElementsByName("cantidad[]");
    const Impuesto = Array.from( document.getElementsByName("Id_Imp[]") );

    for (var i = 0; i < Costo.length; i++) {
        cantidad = (Cantidad[i].value) ? parseFloat(Cantidad[i].value) : null ;
        costo    = (Costo[i].value) ? parseFloat(Costo[i].value) : null ;
        var total =  0;
        var impuesto = 0;
        if (costo !== null && cantidad !== null) {
            DataSet = Impuesto[i].selectedOptions;
            for (var o = 0; o < DataSet.length; o++) {
                impuesto = impuesto + parseFloat(DataSet[o].dataset.value);

            }
            // console.log(DataSet);

            subtotal = costo * cantidad;
            descuento = (Descuento[i].value) ? (subtotal * parseFloat(Descuento[i].value))/100 : 0 ;
            subtotal_descuento = subtotal - descuento;
            impuesto_valor = (impuesto!=0) ? (subtotal_descuento * impuesto)/100 : 0 ;
            total  = (subtotal_descuento + impuesto_valor);
        }
        document.getElementsByName("subtotal")[i].value = parseFloat(total.toFixed(2));
    }
    calcularTotales();
}

function calcularTotales() {
    var sub = document.getElementsByName("subtotal");
    var Costo     = document.getElementsByName("costo[]");
    var Descuento = document.getElementsByName("descuento[]");
    var Cantidad  = document.getElementsByName("cantidad[]");
    const Impuesto = Array.from( document.getElementsByName("Id_Imp[]") );

    var totalT = 0;
    var descuentoT = 0;
    var total_impuestoT = 0;
    var subtotalT = 0;
    var ArrayImpuesto = Array();
    for (var i = 0; i < sub.length; i++) {
        cantidad = (Cantidad[i].value) ? parseFloat(Cantidad[i].value) : null ;
        costo    = (Costo[i].value) ? parseFloat(Costo[i].value) : null ;
        if (costo !== null && cantidad !== null) {
            var impuesto = 0
            var Rows = [];
            DataSet = Impuesto[i].selectedOptions;
            for (var o = 0; o < DataSet.length; o++) {
                impuesto = impuesto + parseFloat(DataSet[o].dataset.value);
                Rows[o] = parseFloat(DataSet[o].value);
            }
            ArrayImpuesto[i] = Rows;
            subtotal  = costo * cantidad;
            descuento = (Descuento[i].value) ? (subtotal * parseFloat(Descuento[i].value))/100 : 0 ;
            subtotal_descuento = subtotal - descuento;
            impuesto_valor = (impuesto!=0) ? (subtotal_descuento * impuesto)/100 : 0 ;
            total  = (subtotal_descuento + impuesto_valor);

            subtotalT = subtotalT + subtotal;
            descuentoT = descuentoT + descuento;
            total_impuestoT = total_impuestoT + impuesto_valor;
            totalT = totalT + parseFloat(document.getElementsByName("subtotal")[i].value);
        }
        
    }
    // var JsonOk = JSON.stringify(ArrayImpuesto);
    document.getElementById('json').setAttribute('value', JSON.stringify(ArrayImpuesto));
    $("#subtotal").html("$ " + format_moneda(parseFloat(subtotalT),2));
    $("#descuento").html("$ " + format_moneda(parseFloat(descuentoT),2));
    $("#impuestos").html("$ " + format_moneda(parseFloat(total_impuestoT),2));
    $("#total").html("$ " + format_moneda(parseFloat(totalT),2));
}


</script>