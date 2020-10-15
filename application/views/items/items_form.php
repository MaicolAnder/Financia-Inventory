
<div class="card">
    <form action="<?php echo $action; ?>" method="post">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Items </h2> -->
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
        
    	        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label for="Nombre_Ite" class="required"><?=t('Nombre_Ite'); ?> <?php echo form_error('Nombre_Ite') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Nombre_Ite" id="Nombre_Ite" placeholder="Nombre" required value="<?php echo $Nombre_Ite; ?>" />
                    </div>
                </div>
    	        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Referencia_Ite"><?=t('Referencia_Ite'); ?> <?php echo form_error('Referencia_Ite') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Referencia_Ite" id="Referencia_Ite" placeholder="Referencia" value="<?php echo $Referencia_Ite; ?>" />
                    </div>
                </div>
    	        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Serie_Ite"><?=t('Serie_Ite'); ?> <?php echo form_error('Serie_Ite') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Serie_Ite" id="Serie_Ite" placeholder="" value="<?php echo $Serie_Ite; ?>" />
                    </div>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Id_Mar"><?=t('Id_Mar'); ?> <?php echo form_error('Id_Mar') ?></label>
                    <select name="Id_Mar" id="Id_Mar" class="form-control selectpicker" data-live-search="true" data-header='<button class="btn btn-link" onclick="Add_Id_Met()"><i class="fas fa-plus-circle"></i> Nueva registro</button>' data-size="10">
                        <option value="">Seleccione</option>
                        <?php
                        foreach($all_marcas as $marcas)
                        { 
                            $print_value =  $marcas->Nombre_Mar;
                            $selected = ($marcas->Id_Mar==$Id_Mar) ? 'selected':'';
                            echo '<option value="'.$marcas->Id_Mar.'"  '.$selected.'> '.$print_value.'</option>';
                        } ?>
                    </select>
                </div>
                
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Id_Med"><?=t('Id_Med'); ?> <?php echo form_error('Id_Med') ?></label>
                    <select name="Id_Med" id="Id_Med" class="form-control selectpicker" data-live-search="true" data-header='<button class="btn btn-link" onclick="Add_Id_Met()"><i class="fas fa-plus-circle"></i> Nueva registro</button>' data-size="10">

                        <option value="">Seleccione</option>
                        <?php
                        foreach($all_medidas as $medidas)
                        { 
                            $print_value =  $medidas->Nombre_Med;
                            $selected = ($medidas->Id_Med==$Id_Med) ? 'selected':'';
                            echo '<option value="'.$medidas->Id_Med.'"  '.$selected.'> '.$print_value.'</option>';
                        } ?>
                    </select>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Id_CatIte"><?=t('Id_CatIte'); ?> <?php echo form_error('Id_CatIte') ?></label>
                    <select name="Id_CatIte" id="Id_CatIte" class="form-control selectpicker" data-live-search="true" data-header='<button class="btn btn-link" onclick="Add_Id_Met()"><i class="fas fa-plus-circle"></i> Nueva registro</button>' data-size="10">
                        <option value="">Seleccione</option>
                        <?php
                        foreach($all_categoria_item as $categoria_item)
                        { 
                            $print_value =  $categoria_item->Nombre_CatIte;
                            $selected = ($categoria_item->Id_CatIte==$Id_CatIte) ? 'selected':'';
                            echo '<option value="'.$categoria_item->Id_CatIte.'"  '.$selected.'> '.$print_value.'</option>';
                        } ?>
                    </select>
                </div>
                
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Id_IteEst" class="required"><?=t('Id_IteEst'); ?> <?php echo form_error('Id_IteEst') ?></label>
                    <select name="Id_IteEst" id="Id_IteEst" class="form-control selectpicker" data-live-search="true" required>
                        <option value="">Seleccione</option>
                        <?php
                        foreach($all_item_estado as $item_estado)
                        { 
                            $print_value =  $item_estado->Nombre_IteEst;
                            $selected = ($item_estado->Id_IteEst==$Id_IteEst) ? 'selected':'';
                            echo '<option value="'.$item_estado->Id_IteEst.'"  '.$selected.'> '.$print_value.'</option>';
                        } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="section-panel">    
            <div class="with-all">
                <h6 class="card-title"><i class="fas fa-sort-alpha-down"></i> Información contable</h6>
            </div>
            <div class="card-text row">
                
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Id_IteTip" class="required"><?=t('Id_IteTip'); ?> <?php echo form_error('Id_IteTip') ?></label>
                    <select name="Id_IteTip" id="Id_IteTip" class="form-control selectpicker" data-live-search="true" required>
                        <option value="">Seleccione</option>
                        <?php
                        foreach($all_item_tipo as $item_tipo)
                        { 
                            $print_value =  $item_tipo->Nombre_IteTip;
                            $selected = ($item_tipo->Id_IteTip==$Id_IteTip) ? 'selected':'';
                            echo '<option value="'.$item_tipo->Id_IteTip.'"  '.$selected.'> '.$print_value.'</option>';
                        } ?>
                    </select>
                </div>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Id_Imp"><?=t('Id_Imp'); ?> <?php echo form_error('Id_Imp') ?></label>
                    <select name="Id_Imp[]" id="Id_Imp" class="form-control selectpicker Id_Imp" data-live-search="true" multiple>
                        <?php
                        foreach($all_impuestos as $impuestos)
                        { 
                            $print_value =  $impuestos->Nombre_Imp." (".$impuestos->Valor_Imp."%)";
                            $selected = (in_array($impuestos->Id_Imp, $Id_Imp)) ? 'selected':'';
                            echo '<option data-value="'.$impuestos->Valor_Imp.'" value="'.$impuestos->Id_Imp.'"  '.$selected.'> '.$print_value.'</option>';
                        } ?>
                    </select>
                </div>
                <?php /* ?>
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Inventariable_Ite"><?=t('Inventariable_Ite'); ?> <?php echo form_error('Inventariable_Ite') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="radio" class="form-control" name="Inventariable_Ite" id="Inventariable_Ite" placeholder="Inventariable Ite" value="<?php echo $Inventariable_Ite; ?>" onclick="return false;" />
                    </div>
                </div>
                <?php */ ?>
                <div class="table-div">
                    <div class="all-with">
                        <p><i class="fas fa-sort-alpha-down"></i> <strong>Precio de venta del <?=t('Id_Ite');?></strong></p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover table-bordered table-sm" width="100%">
                            <thead>
                                <th>#</th>
                                <th><?=t('Nombre_ListPre');?></th>
                                <th><?=t('Valor_Incremento');?></th>
                                <th><?=t('Porcentaje_Incremento');?></th>
                                <th><?=t('PrecioVenta');?> Sin <?=t('Id_Imp'); ?></th>
                                <th>Precio Final</th>
                            </thead>
                            <tbody>
                            <?php
                            // ver_array($all_lista_precios);
                            if (count($all_lista_precios)>0) {
                                $counter = 1;
                                foreach ($all_lista_precios as $key) {
                                    $val = '';
                                    if (!empty($Id_ListPre)) {
                                        foreach ($Id_ListPre as $precio) {
                                            if ($key->Id_ListPre==$precio['Id_ListPre']) {
                                                $val = $precio['PrecioVenta'];
                                            }
                                        }
                                     } 
                                    
                                    ?>
                                <tr title="Ingrese el precio de venta para esta lista de precio">
                                    <td><?=$counter++;?>
                                        <input type="hidden" name="Id_ListPre[]" value="<?=$key->Id_ListPre?>">
                                    </td>
                                    <td><?=$key->Nombre_ListPre;?></td>
                                    <td class="text-right"><?=number_format($key->Valor_Incremento,2);?></td>
                                    <td class="text-right"><?=$key->Porcentaje_Incremento;?> %</td>
                                    <td class="text-right"><input class="form-control text-right precio_venta" type="number" step="any" min="0" name="PrecioVenta[]" id="PrecioVenta_<?=$counter;?>" value="<?=$val;?>" placeholder="<?=t('PrecioVenta')?>"></td>
                                    <td>
                                        <input class="form-control" type="text" name="precioFinal" id="PrecioVentaFinal_<?=$counter;?>" readonly></td>
                                </tr>   
                            <?php }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php /* ?>
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
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="PrecioVenta"><?=t('PrecioVenta'); ?> <?php echo form_error('PrecioVenta') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="PrecioVenta" id="PrecioVenta" placeholder="<?=t('PrecioVenta'); ?>" value="<?php echo $PrecioVenta; ?>" />
                    </div>
                </div> <?php */ ?>
            </div>
        </div>
        <div class="section-panel">    
            <div class="with-all">
                <h6 class="card-title"><i class="fas fa-sort-alpha-down"></i> Información adicional</h6>
            </div>
            <div class="card-text row">
                
                <input type="hidden" class="form-control" name="Primary_Usu" id="Primary_Usu" placeholder="Primary Usu" value="<?php echo $Primary_Usu; ?>" />
        		
                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="Id_Bod"><?=t('Id_Bod'); ?> <?php echo form_error('Id_Bod') ?></label>
                    <select name="Id_Bod" id="Id_Bod" class="form-control selectpicker" data-live-search="true" data-header='<button class="btn btn-link" onclick="Add_Id_Met()"><i class="fas fa-plus-circle"></i> Nueva registro</button>' data-size="10">
                        <option value="">Seleccione</option>
                        <?php
                        foreach($all_bodegas as $bodegas)
                        { 
                            $print_value =  $bodegas->Nombre_Bod;
                            $selected = ($bodegas->Id_Bod==$Id_Bod) ? 'selected':'';
                            echo '<option value="'.$bodegas->Id_Bod.'"  '.$selected.'> '.$print_value.'</option>';
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

                <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label for="FechaRegistro_Ite"><?=t('FechaRegistro_Ite'); ?> <?php echo form_error('FechaRegistro_Ite') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="FechaRegistro_Ite" id="FechaRegistro_Ite" placeholder="FechaRegistro Ite" value="<?php echo $FechaRegistro_Ite; ?>" readonly />
                    </div>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label for="Imagen_Item"><?=t('Imagen_Item'); ?> <?php echo form_error('Imagen_Item') ?></label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="Imagen_Item" id="Imagen_Item">
                        <label class="custom-file-label" for="Imagen_Item">Choose file</label>
                    </div>
                </div>
               <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label for="Observacion_Ite"><?=t('Observacion_Ite'); ?> <?php echo form_error('Observacion_Ite') ?></label>
                    <textarea class="form-control" rows="3" name="Observacion_Ite" id="Observacion_Ite" placeholder="<?=t('Observacion_Ite'); ?>"><?php echo $Observacion_Ite; ?></textarea>
                </div>
	        </div>
        </div>
    </div>

    <div class="card-footer text-right">
        
        <input type="hidden" name="Id_Ite" value="<?php echo $Id_Ite; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('items') ?>" class="btn btn-danger">Cancelar</a>
    </div>
</form>
</div>
<?php $this->load->view('footer'); ?>    
<script type="text/javascript">
    $(document).on('blur', '.precio_venta', function(event) {
        precioVenta();
        // .Id_Imp        
    });
    $(document).on('change', '.Id_Imp', function(event) {
        precioVenta();
        // .Id_Imp        
    });

    function precioVenta() {
        var Precio = document.getElementsByName('PrecioVenta[]');
        var Impuesto = Array.from( document.getElementsByName("Id_Imp[]") );
        for (var i = 0; i < Precio.length; i++) {
            var id = Precio[i].id;
            var impuesto = 0;
            var precioFinal = 0;
            var precio = (Precio[i].value) ? parseFloat(Precio[i].value) : null ;
            if (precio != null) {
                DataSet = Impuesto[0].selectedOptions;
                for (var o = 0; o < DataSet.length; o++) {
                    impuesto = impuesto + parseFloat(DataSet[o].dataset.value);
                }
                ip = precio * (impuesto/100);
                precioFinal = precio + parseFloat(ip);
                document.getElementById("PrecioVentaFinal_" + id.split('_')[1]).value = format_moneda(precioFinal,2);
            }
        }

        
        
        
    }
    function Add_Id_Met() {
        alert('Este es un test');
    }

</script>