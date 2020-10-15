<style type="text/css">
.box_1{
    background: #eee;
}

input[type="checkbox"].checkbox-switch{
    font-size: 1.1rem;
    -webkit-appearance: none;
       -moz-appearance: none;
            appearance: none;
    width: 3.8em;
    height: 1.6em;
    background: #ddd;
    border-radius: 3em;
    position: relative;
    cursor: pointer;
    outline: none;
    -webkit-transition: all .2s ease-in-out;
    transition: all .2s ease-in-out;
  }
  
  input[type="checkbox"].checkbox-switch:checked{
    background: #0ebeff;
  }
  
  input[type="checkbox"].checkbox-switch:after{
    position: absolute;
    content: "";
    width: 1.5em;
    height: 1.5em;
    border-radius: 50%;
    background: #fff;
    -webkit-box-shadow: 0 0 .25em rgba(0,0,0,.3);
            box-shadow: 0 0 .25em rgba(0,0,0,.3);
    -webkit-transform: scale(.7);
            transform: scale(.7);
    left: 0;
    -webkit-transition: all .2s ease-in-out;
    transition: all .2s ease-in-out;
  }
  
  input[type="checkbox"].checkbox-switch:checked:after{
    left: calc(100% - 1.5em);
  }
/* Switch 4 Specific Style End */
</style>
<script type="text/javascript">
    const type_doc = '<?php $type; ?>';
</script>

<div class="card">
    <form action="<?php echo $action; ?>" method="post" id="formTransaction">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Transacciones </h2> -->
        <h5 class="text-left" style="margin-top:0px"><?php echo $page ?> <i class="fas fa-angle-down" style="float: right;"></i></h5>
    </div>
    <div class="text-center" style="margin-top: 0px"  id="message">              
        <?php echo $this->session->userdata('message') <> '' ? '<div class="alert alert-info alert-dismissible fade show" role="alert" style="border-radius: .0rem;"><strong>'.$this->session->userdata('message').'</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' : ''; ?>
    </div>
    <div class="card-body">
        <!-- <h6 class="card-title">Titulo</h6> -->
        <!-- <p class="card-text">Best ugg boots on the planet. Free shipping, 24/7 customer service.</p>-->
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label class="required" for="Id_Per"><?=t('Id_Per'); ?> <?php echo form_error('Id_Per') ?></label>
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
                <label class="required" for="Numero_Tran"><?=t('Numero_Tran'); ?> <?php echo form_error('Numero_Tran') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Numero_Tran" id="Numero_Tran" placeholder="<?=t('Numero_Tran'); ?>" value="<?php echo $Numero_Tran; ?>" required/>
                </div>
            </div>
			<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label class="required" for="Fecha_Tran"><?=t('Fecha_Tran'); ?> <?php echo form_error('Fecha_Tran') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="date" class="form-control" name="Fecha_Tran" id="Fecha_Tran" placeholder="Fecha Tran" value="<?php echo $Fecha_Tran; ?>" required />
                </div>
            </div>
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label class="required" for="Id_Ban"><?=t('Id_Ban'); ?> <?php echo form_error('Id_Ban') ?></label>
                <select name="Id_Ban" id="Id_Ban" class="form-control selectpicker" data-live-search="true" required>
                    <option value="">Seleccione</option>
                    <?php
                    foreach($all_bancos as $bancos)
                    { 
                        $print_value =  $bancos->NombreCuenta_Ban.' ['.$bancos->NumeroCuenta_Ban.']';
                        $selected = ($bancos->Id_Ban==$Id_Ban) ? 'selected':'';
                        echo '<option value="'.$bancos->Id_Ban.'"  '.$selected.'> '.$print_value.'</option>';
                    } ?>
                </select>
            </div>
        <?php /* ?>
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Id_TranEst"><?=t('Id_TranEst'); ?> <?php echo form_error('Id_TranEst') ?></label>
                <select name="Id_TranEst" id="Id_TranEst" class="form-control selectpicker" data-live-search="true">
                    <option value="">Seleccione</option>
                    <?php
                    foreach($all_transaccion_estado as $transaccion_estado)
                    { 
                        $print_value =  $transaccion_estado->Nombre_TranEst;
                        $selected = ($transaccion_estado->Id_TranEst==$Id_TranEst) ? 'selected':'';
                        echo '<option value="'.$transaccion_estado->Id_TranEst.'"  '.$selected.'> '.$print_value.'</option>';
                    } ?>
                </select>
            </div>
        <?php /* ?>
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Id_TranTip"><?=t('Id_TranTip'); ?> <?php echo form_error('Id_TranTip') ?></label>
                <select name="Id_TranTip" id="Id_TranTip" class="form-control selectpicker" data-live-search="true">
                    <option value="">Seleccione</option>
                    <?php
                    foreach($all_transaccion_tipo as $transaccion_tipo)
                    { 
                        $print_value =  $transaccion_tipo->Nombre_TranTip;
                        $selected = ($transaccion_tipo->Id_TranTip==$Id_TranTip) ? 'selected':'';
                        echo '<option value="'.$transaccion_tipo->Id_TranTip.'"  '.$selected.'> '.$print_value.'</option>';
                    } ?>
                </select>
            </div> <?php */ ?>
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="DocumentoAsociado_Tran"><?=t('DocumentoAsociado_Tran'); ?> <?php echo form_error('DocumentoAsociado_Tran') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="checkbox" class="form-control checkbox-switch" name="DocumentoAsociado_Tran" id="DocumentoAsociado_Tran" placeholder="DocumentoAsociado Tran" value="<?php echo $DocumentoAsociado_Tran; ?>" <?php echo ($DocumentoAsociado_Tran==1)?'checked' : '' ; ?> />
                </div>
            </div>
            
            <?php if ($Editar) { ?>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Id_Usu"><?=t('Id_Usu'); ?> <?php echo form_error('Id_Usu') ?></label>
                    <select name="Id_Usu" id="Id_Usu" class="form-control selectpicker" data-live-search="true" disabled>
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
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="FechaRegistro_Tran"><?=t('FechaRegistro_Tran'); ?> <?php echo form_error('FechaRegistro_Tran') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="FechaRegistro_Tran" id="FechaRegistro_Tran" placeholder="FechaRegistro Tran" value="<?php echo $FechaRegistro_Tran; ?>" readonly />
                    </div>
                </div>
            <?php } ?>
            <div class="col-12 table-responsive-sm" id="nodoc">
                <table class="table table-sm table-hover table-cell" width="100%">
                    <thead class="text-left" id="itemsHead">
                        <th class="text-center color-danger"><i class="fas fa-times-circle"></i></th>

                        <?php if ($DocumentoAsociado_Tran == 1): ?>
                            <th class="doc"><?=t('Id_Doc'); ?></th>
                        <?php else: ?>
                            <th><?=t('Id_Cue'); ?></th>
                            <th><?=t('Id_Imp'); ?></th>
                        <?php endif ?>
                        <th><?=t('Cantidad_TranDet'); ?></th>
                        <th><?=t('Valor_TranDet'); ?></th>
                        <th><?=t('Observaciones_TranDet'); ?></th>                        
                        <th><?=t('Subtotal'); ?></th>
                    </thead>
                    <tbody id="itemsbody">
                        <tr class="tr" id="tr_0">
                            <td class="text-center align-middle color-danger delete">
                                <i class="fas fa-times-circle">
                                <input type="hidden" name="checking[]" value="1" required>
                            </td>
                        <?php if ($DocumentoAsociado_Tran == 1): ?>
                            <td class="doc">
                                <input type="hidden" class="form-control selectpicker cell-formar-sum" name="Id_Doc[]" value="<?=(isset($Id_Doc))?$Id_Doc:'';?>" required>
                                <input type="text" class="form-control selectpicker cell-formar-sum" name="Id_DocValue[]" value="<?=(isset($Numero_Doc))?$Numero_Doc:'';?>" autofocus="autofocus" required>
                                <input type="hidden" name="Id_Imp[]" id="Id_Imp_0" class="form-control selectpicker cell-formar-sum">        
                            </td>
                        <?php else: ?>
                            <td>
                                <select name="Id_Cue[]" id="Id_Cue_0" class="form-control selectpicker cell-formar-sum" data-live-search="true" required>
                                    <option value="">Seleccione</option>
                                    <?php
                                    ListadoCuentas('', ['Id_NatCue'=>[$Id_NatCue]]); ?>
                                </select>
                            </td>
                            <td>
                                <select name="Id_Imp[]" id="Id_Imp_0" class="form-control selectpicker cell-formar-sum" data-live-search="true">
                                    <option value="">Seleccione</option>
                                    <?php
                                    foreach($all_impuestos as $impuestos)
                                    { 
                                        $print_value = $impuestos->Nombre_Imp." ".$impuestos->Valor_Imp."%";
                                        $selected = '';
                                        if (isset($Id_Imp)) {
                                            $selected = ($impuestos->Id_Imp==$Id_Imp) ? 'selected':'';
                                        }
                                        echo '<option data-value="'.$impuestos->Valor_Imp.'"  value="'.$impuestos->Id_Imp.'"  '.$selected.'> '.$print_value.'</option>';
                                    } ?>
                                </select>
                            </td>
                        <?php endif ?>
                            
                            <td><input type="number" min="0" step="any" class="form-control text-right cell-formar-sum" name="cantidad[]" id="cantidad_0" value="1" required></td>
                            <td><input type="number" step="any" <?=($valor!='')?'max="'.$valor.'"':'';?> class="form-control text-right cell-formar-sum" name="valor[]" id="valor_0" placeholder="$0.00" value="<?=(isset($valor))?$valor:'';?>" required></td>
                            <td><input type="text" class="form-control" name="observacion[]" id="observacion_0"></td>
                            <td><input class="form-control text-right subtotal cell-formar-sum" type="text" name="subtotal[]" id="subtotal_0" placeholder="$0.00" readonly value="<?=($valor != '')?number_format($valor,2):'';?>" required></td>
                        </tr>
                    </tbody>
                </table>

                
            </div>
            <div class="col-12 container">
                <div class="text-center color-sidebar row">
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <strong>SUB TOTAL</strong>
                        <h4 id="subtotal">$0.00</h4>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <strong>IMPUESTOS</strong>
                        <h4 id="impuestos">$0.00</h4>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <strong>TOTAL TRANSACCIÓN</strong>
                        <input type="hidden" id="txxr001">
                        <h4 id="total">$0.00</h4>
                    </div>
                </div>
                <div class="text-right">
                    <br>
                    <button class="btn btn-info" type="button" id="add"><i class="fas fa-plus-circle"></i> Agregar nueva fila</button>
                </div>
            </div>
            <div class="col-12 form-group">
                <fieldset>
                    <legend><h4>AGREGAR PAGO</h4> </legend>
                    <div class="">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <?php
                                foreach($all_metodo_pago as $metodo_pago)
                                { ?>
                                    <li class="nav-item" style="margin: .25rem" title="Seleccione para pagar">
                                        <a class="btn btn-outline-info nav-link" id="pills-home-<?php echo $metodo_pago->Id_MetPag; ?>" data-toggle="pill" href="#pills-pay-<?php echo $metodo_pago->Id_MetPag; ?>" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo $metodo_pago->Nombre_MetPag; ?></a>
                                    </li>
                            <?php } ?>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                            <?php
                                foreach($all_metodo_pago as $metodo_pago)
                                { ?>
                                <div class="tab-pane fade show" id="pills-pay-<?php echo $metodo_pago->Id_MetPag; ?>" role="tabpanel" aria-labelledby="pills-home-<?php echo $metodo_pago->Id_MetPag; ?>">
                                    <div class="row text-right">
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            <strong><h6>Realizar pago con <?php echo $metodo_pago->Nombre_MetPag; ?></h6></strong>
                                            <input type="hidden" name="Id_MetPag[]" value="<?php echo $metodo_pago->Id_MetPag; ?>">
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            
                                            <div class="input-group-prepend group-ico">
                                                <i class="fas fa-sort-numeric-down text-muted inputIco"></i>
                                                <input type="number" step="any" min="0" class="form-control pay-metod text-right" name="Valor_Pag[]" id="Valor_Pag_<?php echo $metodo_pago->Id_MetPag; ?>" placeholder="$ 0.00" autofocus="autofocus" value="<?php echo $Valor_Pag; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            </div>
                            <div class="text-right">
                                <br>
                                <h6 id="paymetod-detail">
                                    
                                </h6>
                            </div>
                    </div>
                </fieldset>
            </div>
            
            <div class="form-group col-xs-12 col-sm-7 col-md-7 col-lg-7">
                <label for="NotaVisible_Tran"><?=t('NotaVisible_Tran'); ?> <?php echo form_error('NotaVisible_Tran') ?></label>
                <textarea class="form-control" rows="3" name="NotaVisible_Tran" id="NotaVisible_Tran" placeholder="<?=t('NotaVisible_Tran'); ?>"><?php echo $NotaVisible_Tran; ?></textarea>
            </div>
            <div class="form-group col-xs-12 col-sm-5 col-md-5 col-lg-5 text-right">
                <h5 class="color-danger" id="DiferenciaPago"></h5>
                <div class="color-sidebar">
                    <strong>TOTAL A PAGAR</strong>
                    <h3 id="totalPagado">$0.00</h3>
                    <input type="hidden" id="txxr002" value="">
                </div>
            </div>
            
		
		</div>
    </div>

    <div class="card-footer text-right">
        <input type="hidden" name="type" id="type" value="<?=$type;?>">
        <input type="hidden" name="Id_DocTip" value="<?=$Id_DocTip;?>">
	    <input type="hidden" name="Id_Tran" value="<?php echo $Id_Tran; ?>" /> 
	    <button type="submit" class="btn btn-primary" id="submit10001"><i class="fas fa-save"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('transacciones/listar/'.$type) ?>" class="btn btn-danger"><i class="fas fa-undo"></i> Cancelar</a>
    </div>
	</form>
</div>

<!-- The Modal -->
<div class="modal" id="documentsModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-check-circle color-success"></i> Seleccione documentos de <?=$name;?></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-hover table-condesed table-sm" id="mytable" width="100%">
                    <thead>
                        <th>#</th>
                        <th>Agregar</th>
                        <th><?=t('Id_Per'); ?></th>
                        <th><?=t('Numero_Doc'); ?></th>
                        <th><?=t('Id_DocEst'); ?></th>
                        <th>Total</th>
                        <th><?=t('Id_TerPag'); ?></th>
                        <th><?=t('FechaDocumento_Doc'); ?></th>
                        <th><?=t('FechaRegistro_Doc'); ?></th>
                        <th><?=t('FechaVencimiento_Doc'); ?></th>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<?php $this->load->view('footer'); ?>   
<script type="text/javascript">
$(document).ready(function() {
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
    // Delete items on change contact
    $('#Id_Per').change(function(event) {
        if (this.value != '') {
            $('#itemsbody').empty();
            $('#add').click();
        }
    });
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
    var check = document.getElementById('DocumentoAsociado_Tran'); 
    if (check.value == 0) {
        var head = '<tr class="tr" id="tr_'+i+'">'+
            '<td class="text-center align-middle color-danger delete"><i class="fas fa-times-circle"><input type="hidden" name="checking[]" value="1" required></td>'+
            '<td>'+
                '<select name="Id_Cue[]" id="Id_Cue_'+i+'" class="form-control selectpicker cell-formar-sum" data-live-search="true" required>'+
                    '<option value="">Seleccione</option>'+
                    <?php ListadoCuentas('', ['Id_NatCue'=>[$Id_NatCue]], true); ?>
                '</select>'+
            '</td>'+
            '<td>'+
                '<select name="Id_Imp[]" id="Id_Imp_'+i+'" class="form-control selectpicker cell-formar-sum" data-live-search="true">' +
                    '<option value="">Seleccione</option>' +
                    <?php
                    foreach($all_impuestos as $impuestos)
                    { 
                        $print_value = $impuestos->Nombre_Imp." ".$impuestos->Valor_Imp."%";
                        $selected = '';
                        if (isset($Id_Imp)) {
                            $selected = ($impuestos->Id_Imp==$Id_Imp) ? 'selected':'';
                        }
                        echo '\'<option data-value="'.$impuestos->Valor_Imp.'" value="'.$impuestos->Id_Imp.'"  '.$selected.'> '.$print_value.'</option>\'+';
                    } ?>
                '</select>'+
            '</td>'+
            '<td><input type="number" min="0" step="any" class="form-control text-right cell-formar-sum" name="cantidad[]" id="cantidad_'+i+'" value="1" required></td>' +
            '<td><input type="number" step="any" class="form-control text-right cell-formar-sum" name="valor[]" id="valor_'+i+'" placeholder="$0.00" required></td>' +
            '<td><input type="text" class="form-control cell-formar-sum" name="observacion[]" id="observacion_'+i+'"></td>'+
            '<td><input class="form-control text-right subtotal cell-formar-sum" type="text" step="any" name="subtotal[]" value="0" id="subtotal_'+i+'" placeholder="$0.00" required readonly></td>';
        var body = '</tr>';
        html = head+body;
        $('#itemsbody').append(html);
        document.getElementById("valor_" + i).focus();
    } else {
        validar_asociacion(false);
    }
    modSubtotales();
    $('.selectpicker').selectpicker('refresh');
});

$(document).on('change', 'Id_Cue, Id_Doc', function(event) {
    id = this.id;
    console.log('clicked '+ id);
    if (this.value!='') {
        s = id.split('_');
        document.getElementById("valor_" + s[2]).focus();
    }
});
$(document).on('click', '#submit10001', function(event) {
    event.preventDefault();
    modPayMetods();
    items = document.getElementsByName("valor[]");
    ValorTransaccion = document.getElementById('txxr001').value;
    ValorPago = document.getElementById('txxr002').value;
    if (ValorTransaccion == 0) {
        mensaje('La transacción no tiene registros o tiene valores en 0.00');
    } else {
        if (items.length > 0) {
            if (ValorTransaccion == ValorPago) {
                var $frm =  $("#formTransaction");
                $frm.validate();
                if($frm.valid()){
                    cargar();
                    $frm.submit();
                } else {
                    mensaje('Complete todos los campos obligatorios');
                }
                
            } else {
                mensaje('Existe una diferencia entre el valor de la transacción y el valor a pagar');
            }
        } else {
            mensaje('La transacción no tiene registros para contabilizar');
        }
    }
});
$(document).on('blur', '.pay-metod, .cell-formar-sum', function(event) {
    modPayMetods();
});

function add_DetailDoc(id, numero, valor) {
    var i = 0;
    var split_id = 0;
    var lastname_id = $('.tr').last().attr('id');
    if (lastname_id) {
        split_id = lastname_id.split('_');
        i = Number(split_id[1]) + 1;
    }

    if (id!='' && numero!='' && valor!='') {
        var html = '<tr class="tr" id="tr_'+i+'">'+
            '<td class="text-center align-middle color-danger delete">'+
                '<i class="fas fa-times-circle">'+
                '<input type="hidden" name="checking[]" value="1" required>'+
            '</td>'+
            '<td class="doc">'+
                '<input type="hidden" class="form-control selectpicker cell-formar-sum" name="Id_Doc[]" value="'+id+'" required>'+
                '<input type="text" class="form-control selectpicker cell-formar-sum" name="Id_DocValue[]" value="'+numero+'" autofocus="autofocus" required>'+
                '<input type="hidden" name="Id_Imp[]" id="Id_Imp_'+i+'" class="form-control selectpicker cell-formar-sum">'+       
            '</td>'+
            '<td><input type="number" min="0" step="any" class="form-control text-right cell-formar-sum" name="cantidad[]" id="cantidad_'+i+'" value="1" required></td>'+
            '<td><input type="number" step="any" max="'+valor+'" class="form-control text-right cell-formar-sum" name="valor[]" id="valor_'+i+'" placeholder="$0.00" value="'+valor+'" required></td>'+
            '<td><input type="text" class="form-control" name="observacion[]" id="observacion_'+i+'"></td>'+
            '<td><input class="form-control text-right subtotal cell-formar-sum" type="text" name="subtotal[]" id="subtotal_'+i+'" placeholder="$0.00" readonly required></td>'+
        '</tr>';
        $('#itemsbody').append(html);
        modSubtotales();
        $('.selectpicker').selectpicker('refresh');

    }
}
function modPayMetods() {
    modSubtotales();
    var Valores = document.getElementsByName("Valor_Pag[]");
    $("#paymetod-detail").empty();
    var TotalPagado = 0;
    for (var i = 0; i < Valores.length; i++) {
        valor = (Valores[i].value) ? parseFloat(Valores[i].value) : null ;
        if(valor !== null) {
            id = Valores[i].id;
            metod = $('#pills-home-'+id.split('_')[2]).text();
            $('#paymetod-detail').prepend('<span class="badge badge-danger m-1 p-1">'+metod+':  '+format_moneda(valor,2)+'</span>');
            TotalPagado = TotalPagado + valor;
        }
    }
    ValorTransaccion = document.getElementById('txxr001').value;
    if (TotalPagado != parseFloat(ValorTransaccion)) {
        rs = parseFloat(ValorTransaccion) - parseFloat(TotalPagado);
        var diff = 'Diferencia';
        if (rs > 0) {
            diff = "Falta por pago ";
        } 
        if(rs < 0) {
            diff = "Pago de más ";
        }
        $("#DiferenciaPago").html(diff + " $ " + format_moneda(parseFloat(rs),2));
    } else {
        $("#DiferenciaPago").html("");
    }
    document.getElementById('txxr002').value = TotalPagado;
    $("#totalPagado").html("$ " + format_moneda(parseFloat(TotalPagado),2));
}
function modSubtotales() {
    var Valor      = document.getElementsByName("valor[]");
    var Cantidad   = document.getElementsByName("cantidad[]");
    const Impuesto = document.getElementsByName("Id_Imp[]");

    var ValorTotal = 0;
    var ImpuestoTotal = 0;
    var SubTotal = 0;
    for (var i = 0; i < Valor.length; i++) {
        cantidad = (Cantidad[i].value) ? parseFloat(Cantidad[i].value) : null ;
        valor    = (Valor[i].value) ? parseFloat(Valor[i].value) : null ;
        if (Impuesto[i].value=='') {
            impuesto = null;
        } else {
            impuesto    = (Impuesto[i].selectedOptions[0].dataset.value) ? parseFloat(Impuesto[i].selectedOptions[0].dataset.value) : null ;
        }
        // impuesto    = (Impuesto[i].selectedOptions[0].dataset.value) ? parseFloat(Impuesto[i].selectedOptions[0].dataset.value) : null ;
        if (valor !== null && cantidad !== null) {
            subtotal = valor * cantidad;
            SubTotal = SubTotal + subtotal;
            if (impuesto !== null) {
                valor_impuesto = subtotal*impuesto/100;
                ImpuestoTotal = ImpuestoTotal + valor_impuesto;
                subtotal = subtotal + valor_impuesto;
            }
            ValorTotal = ValorTotal + subtotal;
        }
        document.getElementsByName("subtotal[]")[i].value = format_moneda(parseFloat(subtotal),2);
    }
    document.getElementById('txxr001').value = ValorTotal;
    $("#subtotal").html("$ " + format_moneda(parseFloat(SubTotal),2));
    $("#impuestos").html("$ " + format_moneda(parseFloat(ImpuestoTotal),2));
    $("#total").html("$ " + format_moneda(parseFloat(ValorTotal),2));
}

</script>