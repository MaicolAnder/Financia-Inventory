<script>
    function printDiv(nombreDiv) {
     /*var contenido= document.getElementById(nombreDiv).innerHTML;
     var contenidoOriginal= document.body.innerHTML;
     document.body.innerHTML = contenido;
     window.print();
     document.body.innerHTML = contenidoOriginal;*/
     printJS({
        printable: nombreDiv,
        type: 'html',
        targetStyles: ['*']
    })
     
}
</script>
<div class="card">
    <!-- <form> -->
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Documento Read</h2> -->
        <h5 class="text-left" style="margin-top:0px"><?php echo $page ?><i class="fas fa-angle-down" style="float: right;"></i></h5>
    </div>
    <div class="text-center" style="margin-top: 0px"  id="message">              
    <?php echo $this->session->userdata('message') <> '' ? '<div class="alert alert-info alert-dismissible fade show" role="alert" style="border-radius: .0rem;"><strong>'.$this->session->userdata('message').'</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' : ''; ?>
    </div>
    <div>
        <button type="button" class="btn btn-success" onclick="printDiv('areaImprimir')" value="Documento">Imprimir</button>
    </div>
    <div class="card-body">
        
        <div id="areaImprimir" class="container" >
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <!-- <div class="row p-5">
                                <div class="col-md-6">
                                    <img src="http://via.placeholder.com/400x90?text=logo">
                                </div>
                            </div> -->

                            <div class="row pb-2 p-2">
                                <div class="col-md-2 col-xs-2 text-center">
                                    <img src="<?=site_url('assets/img/logos/facturacion_Financia.png');?>" width=80%">
                                </div>
                                <div class="col-md-5 col-xs-5">
                                    <p class="font-weight-bold mb-2"><?=t('Id_Per');?></p>
                                    <p class="mb-0"><small class="text-muted">Nombres:</small> <?=$Nombres;?></p>
                                    <p class="mb-0"><small class="text-muted">Direcció:</small> <?=$Direccion_Per;?></p>
                                    <p class="mb-0"><small class="text-muted">Municipio:</small> <?=$Nombre_Num;?></p>
                                    <p class="mb-0"><small class="text-muted">Tel:</small> <?=$TelCelular_Per;?></p>
                                </div>
                                <div class="col-md-5 col-xs-5 text-left">
                                    <p class="font-weight-bold mb-1">Documento</p>
                                    <p class="mb-0"><small class="text-muted">Tipo:</small> <span class="badge badge-warning"><?=$Nombre_DocTip;?></span>
                                    <small class="text-muted">No.</small> <?=$Numero_Doc;?></p>
                                    <p class="mb-0"><small class="text-muted">Termino pago:</small> <?=$Nombre_TerPag;?></p>
                                    <p class="mb-0"><small class="text-muted">Fecha</small> <?=date('Y-m-d', strtotime($FechaDocumento_Doc));?>
                                    <small class="text-muted">Vencimiento</small> <?=date('Y-m-d', strtotime($FechaVencimiento_Doc));?></p>
                                    <p class="mb-0"><small class="text-muted">Estado:</small> <span class="badge badge-info"><?=$Nombre_DocEst;?></span></p>
                                </div>
                                <div class="col-md-12 col-xs-12 text-center">
                                    <p class="font-weight-bold mb-2">Detalle Por:</small> <?=$Id_Usu;?></p>
                                </div>
                            </div>

                            <div class="row p-1">
                                <div class="col-md-12 col-xs-12 table-responsive">
                                    <table class="table table-hover">
                                        <thead class="text-center">
                                            <th >#</th>
                                            <th ><?=t('Id_Ite'); ?></th>
                                            <?php
                                            if ($type == 'expenses') { ?>
                                                <th ><?=t('Id_Med'); ?></th>
                                                <th ><?=t('Id_Bod'); ?></th>
                                            <?php }
                                            ?>
                                            <th ><?=t('Costo_Kar'); ?></th>
                                            <th ><?=t('Descuento_Kar'); ?></th>
                                            <th ><?=t('Id_Imp'); ?></th>
                                            <th ><?=t('Cantidad_Kar'); ?></th>
                                            <th><?=t('Observacion_Kar'); ?></th>
                                            <th ><?=t('Subtotal'); ?></th>                  
                                            <?php if ($type == 'income') { ?>
                                                <th><?=t('Aceptado_Kar'); ?></th>
                                            <?php } ?>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $total = 0;
                                            $descuentos = 0;
                                            $impuestos = 0;
                                            $sub_total = 0;
                                            foreach ($kardex as $coun => $k) {
                                                $sum_impuesto = 0;
                                                $sum_subtotal = $k->Costo_Kar * $k->Cantidad_Kar;
                                                
                                                $descuento = $sum_subtotal * $k->Descuento_Kar/100;
                                                $descuentos = $descuentos + $descuento;

                                                $imp = $this->Impuestos_kardex_model->get_foreing_Id_Imp('*', ['impuestos_kardex.Id_kar'=>$k->Id_kar]);
                                                if ($imp) {
                                                    foreach ($imp as $v) {
                                                        $sum_impuesto = $sum_impuesto + $v->Valor_Imp;
                                                    }
                                                }
                                                $impuesto = ($sum_subtotal - $descuento) * $sum_impuesto/100;
                                                $impuestos = $impuestos + $impuesto;
                                                $subtotal = $sum_subtotal - $descuento + $impuesto;
                                                $sub_total = $sub_total + $sum_subtotal;
                                                $total = $total + $subtotal;
                                             ?>
                                            <tr>
                                                <td><?=$coun + 1;?></td>
                                                <td>
                                                    <?php echo $this->Items_model->get_by_id($k->Id_Ite)->Nombre_Ite; ?>
                                                </td>
                                                <?php if ($type == 'expenses') { ?>
                                                <td>
                                                    <?php echo $this->Items_model->get_by_id($k->Id_Ite)->Nombre_Ite; ?>
                                                </td>
                                                <td>
                                                    <?php echo $this->Items_model->get_by_id($k->Id_Ite)->Nombre_Ite; ?>
                                                </td>
                                                <?php } ?>
                                                <td class="text-right">
                                                    <?php echo number_format($k->Costo_Kar,2); ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php echo ($k->Descuento_Kar)?$k->Descuento_Kar:0; ?>%
                                                </td>
                                                <td>
                                                    <?php 
                                                    if ($imp) {
                                                        foreach ($imp as $v) {
                                                            echo $v->Nombre_Imp." ".$v->Valor_Imp."%<br>";
                                                        }
                                                    } ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php echo number_format($k->Cantidad_Kar,0); ?>
                                                </td>
                                                <td>
                                                    <?php echo $k->Observacion_Kar; ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php echo number_format($subtotal,2); ?>
                                                </td>
                                                <?php if ($type == 'income') { ?>
                                                <td class="text-center align-middle">
                                                    <?php echo $k->Id_Med; ?>
                                                </td>
                                                <?php } ?>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                                <div class="py-3 px-5 text-right">
                                    <div class="mb-2">Total</div>
                                    <div class="h2 font-weight-light">$<?php echo number_format($total,2); ?></div>
                                </div>

                                <div class="py-3 px-5 text-right">
                                    <div class="mb-2">Descuento</div>
                                    <div class="h2 font-weight-light">$<?=number_format($descuentos,2); ?></div>
                                </div>
                                
                                <div class="py-3 px-5 text-right">
                                    <div class="mb-2">Impuesto</div>
                                    <div class="h2 font-weight-light">$<?=number_format($impuestos,2); ?></div>
                                </div>

                                <div class="py-3 px-5 text-right">
                                    <div class="mb-2">Sub total</div>
                                    <div class="h2 font-weight-light">$<?php echo number_format($sub_total,2); ?></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <br>
                                <p class="mb-0"><small class="text-muted"><?=t('Observacion_Doc'); ?>:</small> <?php echo ($Observacion_Doc != '')?$Observacion_Doc:'Sin observaciones'; ?></p><br>
                                <?php //  $this->load->view('documento/docu') ?>
                                <div class="form-group col-12">
                                    <label for="Observacion_Doc"><?=t('Observacion_Doc'); ?> </label>
                                    <div class="input-group-prepend group-ico">
                                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                                        <textarea class="form-control" name="FechaRegistro_Cue" id="FechaRegistro_Cue" placeholder="Registrar nota (No visible en documento impreso)"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Invoice -->
    </div>

    <div class="card-footer text-right">
        <?php
        // echo $Id_DocEst;
        if ($Id_DocEst == 1): ?>
            <a href="<?php echo site_url($this->view.'/update/'.$id_update) ?>" class="btn btn-info"><i class="fas fa-save"></i> Actualizar</a>
        <?php endif ?>
        <a href="<?php echo site_url($this->view.'/listar/'.$type) ?>" class="btn btn-danger"><i class="fas fa-undo"></i> Cancelar </a>        
    </div>
    <!--</form>-->
</div>
<?php $this->load->view('footer'); ?>