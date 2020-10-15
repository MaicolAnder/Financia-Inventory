<style type="text/css">
    #inventory-invoice{
    padding: 30px;
}
#inventory-invoice a{text-decoration:none ! important;}
.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding:3px 2px 3px 4px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th{
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px;
    border:1px solid #fff;
}
.invoice table td{
    border:1px solid #fff;
}
.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .tax,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #17a2b8
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #17a2b8;
    color: #fff
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
</style>
<div class="card">
    <!-- <form> -->
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Transacciones Read</h2> -->
        <h5 class="text-left" style="margin-top:0px"><?php echo $page ?> <i class="fas fa-angle-down" style="float: right;"></i></h5>
    </div>
    <div class="card-body">
        <!-- <h6 class="card-title">Titulo <i class="fas fa-sort-alpha-down"></i></h6> -->
        <!-- <p class="card-text">Best ugg boots on the planet. Free shipping, 24/7 customer service.</p>-->
        
<div id="invoice">
    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Imprimir</button>
            <!-- <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button> -->
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto" id="invoice_print">
        <div style="min-width: 600px">
            <!-- <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="#">
                            <img src="http://workspace1.weavers-web.com/dabacars/public/images/ftr-logo.png" data-holder-rendered="true" />
                        </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="invoice-id">Comprobante: 4734594676</h2>
                        <div class="date"><strong>Fecha:</strong> 01/01/2020</div>
                        <div class="date"><strong>Estado:</strong> Pending</div>
                    </div>
                </div>
            </header> -->
            <main>
                <div class="row contacts">
                    <!-- 
                    <div class="col-3 invoice-to">
                        <a target="_blank" href="#">
                            <img src="http://workspace1.weavers-web.com/dabacars/public/images/ftr-logo.png" data-holder-rendered="true" />
                        </a>
                    </div>
                    <div class="col-3 invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to">John Doe</h2>
                        <div class="address">796 Silver Harbour, TX 79273, US</div>
                        <div class="email"><a href="mailto:johndoe@example.com">john@example.com</a></div>
                    </div>
                    <div class="col-3 invoice-details">
                        <h3 class="invoice-id">Pick Up</h3>
                        <div class="date">00:00 23 Jul 2020</div>
                        <div class="date">Marrakech, Marrakech</div>
                    </div>
                    <div class="col-3 invoice-details">
                        <h3 class="invoice-id">Drop Off</h3>
                        <div class="date">00:00 26 Jul 2020</div>
                        <div class="date">Marrakech, Marrakech</div>
                    </div> -->
                    <div class="col-md-2">
                        <img src="<?=site_url('assets/img/logos/facturacion_Financia.png');?>" width=80%">
                    </div>
                    <div class="col-md-4">
                        <p class="font-weight-bold mb-2 invoice-id"><?=t('Id_Per');?></p>
                        <p class="mb-0"><small class="text-muted">Nombres:</small> <?=$Nombres;?></p>
                        <p class="mb-0"><small class="text-muted">Direcció:</small> <?=$Direccion_Per;?></p>
                        <p class="mb-0"><small class="text-muted">Municipio:</small> <?=$Nombre_Num;?></p>
                        <p class="mb-0"><small class="text-muted">Tel:</small> <?=$TelCelular_Per;?></p>
                    </div>
                    <div class="col-md-3 text-left">
                        <p class="font-weight-bold mb-1 invoice-id">Transacción</p>
                        <p class="mb-0"><small class="text-muted">Tipo:</small> <span class="badge badge-warning"><?=$Nombre_TranTip;?></span></p>
                        <p class="mb-0"><small class="text-muted">No.</small> <?=$Numero_Tran;?></p>
                        <p class="mb-0"><small class="text-muted">Fecha</small> <?=date('Y-m-d', strtotime($Fecha_Tran));?></p>
                    </div>

                    <div class="col-md-3 text-right">
                        <p class="font-weight-bold mb-2 invoice-id">Detalle</p>
                        <p class="mb-0"><small class="text-muted">Por:</small> <?=$Id_Usu;?></p>
                        <p class="mb-0"><small class="text-muted">Registro</small> <?=date('Y-m-d H:m:s', strtotime($FechaRegistro_Tran));?></p>
                        <p class="mb-0"><small class="text-muted">Estado:</small> <span class="badge badge-info"><?=$Nombre_TranEst;?></span></p>
                        
                    </div>
                </div>
                <?php //ver_array($d);
                echo "<br>".$DocumentoAsociado_Tran;
                $total_impuesto = 0;
                $subtotal_docu = 0;
                $total = 0;
                 ?>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">Detalle</th>
                            <th class="text-center">Cant.</th>
                            <th class="text-center">Subtotal</th>
                            <th class="text-center">Impuesto(%)</th>
                            <th class="text-center">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($d)): ?>
                            <?php foreach ($d as $n => $v): ?>
                                <tr>
                                    <td class="no"><?php echo $n+1 ?></td>
                                    <td class="text-left">
                                        <h3>
                                        <?php
                                        $nombre = "";
                                        $tipo = "";
                                        $imp = 0;
                                        $i = "";
                                        $sub_total = $v->Cantidad_TranDet * $v->Valor_TranDet;
                                        $subtotal_docu = $subtotal_docu + $sub_total;
                                        if ($imp != NULL) {
                                            $i = $this->Impuestos_model->get_by_id($v->Id_Imp)->Valor_Imp;
                                            $imp = ($sub_total * intval($i))/100;
                                            $total_impuesto = $total_impuesto + $imp;
                                        }
                                        if ($DocumentoAsociado_Tran == 1) {
                                            $tipo = "Documento";
                                            $nombre = $this->Documento_model->get_by_id($v->Id_Doc)->Numero_Doc;
                                        } else {
                                            $tipo = "Cuenta";
                                            $nombre = $this->Cuentas_model->get_by_id($v->Id_Cue)->Nombre_Cue;
                                        }

                                        $total = $total + ($sub_total + $imp);

                                        ?>
                                        <a target="" href="#">
                                        <?php echo $nombre ?>
                                        </a>
                                        </h3>
                                        <p><?php echo $tipo; ?></p>
                                    </td>
                                    <td class="qty"><?php echo number_format($v->Cantidad_TranDet,0) ?></td>
                                    <td class="unit"><?php echo number_format($v->Valor_TranDet,2) ?></td>
                                    <td><?php echo $i; ?></td>
                                    <td class="total"><?php echo number_format($sub_total + $imp,2); ?></td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <?php echo "No hay registros"; ?>
                        <?php endif ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">IMPUESTOS</td>
                            <td>$ <?php echo number_format($total_impuesto,2); ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td>$ <?php echo number_format($subtotal_docu,2) ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>$ <?php echo number_format($total,2); ?></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice"></div>
                </div>
            </main>
            <footer>
                Invoice was created on a computer and is valid without the signature and seal.
            </footer>
        </div>
    </div>
</div>
    </div>

    <div class="card-footer text-right">
        <a href="<?php echo site_url($this->view) ?>" class="btn btn-danger">Cancelar </a>
        <?php /* ?>
        <a href="<?php echo site_url($this->view.'/update/'.$id_update) ?>" class="btn btn-info">Actualizar</a>
        <?php */ ?>
    </div>
    <!--</form>-->
</div>
<?php $this->load->view('footer'); ?>
<script type="text/javascript">
     $('#printInvoice').click(function(){
        Popup($('#invoice_print')[0].outerHTML);
        function Popup(data) 
        {
            window.print();
            return true;
        }
    });
</script>