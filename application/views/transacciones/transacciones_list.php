
    <div class="card">
        <div class="card-header">
            <h5 style="float: left;"><?php echo $page ?></h5>
            <div class="btn-group dropright" style="float: right;">
                <?php echo anchor(site_url(strtolower($module).'/create/'.$type), '<i class="fas fa-plus-circle"></i>', 'title="Crear nuevo" class="btn btn-link color-dark"'); ?>
                <button class="btn btn-link color-dark" data-toggle="collapse" data-target="#action_filter_collapse" id="btn_filter_active" title="Mostrar más filtros">
                    <i class="fas fa-filter"></i>
                </button>
                <button type="button" class="btn btn-link color-dark dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Menú opciones">
                    <span class="sr-only">Toggle Dropright</span>
                    <i class="fas fa-cog"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item primary" href="<?php echo site_url(strtolower($module).'/create/'.$type) ?>"><i class="btn-outline-dark fas fa-plus-circle"></i> Nuevo registro</a>
                    <div class="dropdown-divider"></div>
		<a class="dropdown-item primary" href="<?php echo site_url(strtolower($module).'/excel') ?>"><i class="btn-outline-success fas fa-file-excel fa-lg"></i> Generar Excel</a>
	 
                </div>
            </div>
        </div>
        <div class="text-center" style="margin-top: 0px"  id="message">              
            <?php echo $this->session->userdata('message') <> '' ? '<div class="alert alert-info alert-dismissible fade show" role="alert" style="border-radius: .0rem;"><strong>'.$this->session->userdata('message').'</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' : ''; ?>
        </div>
        <div class="card-body row">
            <div class="col-md-5 text-left">
                <div class="input-group mb-3">
                    <input type="search" class="form-control" placeholder="Buscar" aria-label="Username" aria-describedby="Search" id="Search">
                    <div class="input-group-prepend">
                        <button class="btn btn-secondary" id="btn_search" title="Buscar">
                            <i class="fas fa-search"></i>
                        </button> 
                        <button class="btn btn-primary" onclick="javascript:location.reload();" title="Recargar">
                            <i class="fas fa-sync-alt"></i>
                        </button> 
                    </div>
                </div>
            </div> 
            <div class="form-group col-md-3 text-center"></div>
            <div class="col-md-4 text-right"></div>
            <div id="action_filter_collapse" class="collapse col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form id="form_filter_collapse" class="row" method="post">
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_Ban"><?=t('Id_Ban'); ?> <?php echo form_error('Id_Ban') ?></label>
                            <select name="Id_Ban" id="Id_Ban" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_bancos as $bancos)
                                { 
                                    $print_value =  $bancos->NombreCuenta_Ban;
                                    $selected = '';
                                    if (isset($Id_Ban)) {
                                        $selected = ($bancos->Id_Ban==$Id_Ban) ? 'selected':'';
                                    }
                                    echo '<option value="'.$bancos->Id_Ban.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_Per"><?=t('Id_Per'); ?> <?php echo form_error('Id_Per') ?></label>
                            <select name="Id_Per" id="Id_Per" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_persona as $persona)
                                { 
                                    $print_value =  "(".$persona->Identificacion_Per.") ".$persona->Nombre1_Per." ".$persona->Nombre2_Per." ".$persona->Apeliido1_Per." ".$persona->Apellido2_Per;
                                    $selected = '';
                                    if (isset($Id_Per)) {
                                        $selected = ($persona->Id_Per==$Id_Per) ? 'selected':'';
                                    }
                                    echo '<option value="'.$persona->Id_Per.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_TranEst"><?=t('Id_TranEst'); ?> <?php echo form_error('Id_TranEst') ?></label>
                            <select name="Id_TranEst" id="Id_TranEst" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_transaccion_estado as $transaccion_estado)
                                { 
                                    $print_value =  $transaccion_estado->Nombre_TranEst;
                                    $selected = '';
                                    if (isset($Id_TranEst)) {
                                        $selected = ($transaccion_estado->Id_TranEst==$Id_TranEst) ? 'selected':'';
                                    }
                                    echo '<option value="'.$transaccion_estado->Id_TranEst.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_TranTip"><?=t('Id_TranTip'); ?> <?php echo form_error('Id_TranTip') ?></label>
                            <select name="Id_TranTip" id="Id_TranTip" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_transaccion_tipo as $transaccion_tipo)
                                { 
                                    $print_value =  $transaccion_tipo->Nombre_TranTip;
                                    $selected = '';
                                    if (isset($Id_TranTip)) {
                                        $selected = ($transaccion_tipo->Id_TranTip==$Id_TranTip) ? 'selected':'';
                                    }
                                    echo '<option value="'.$transaccion_tipo->Id_TranTip.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_Tran_TransaccionParcial"><?=t('Id_Tran_TransaccionParcial'); ?> <?php echo form_error('Id_Tran_TransaccionParcial') ?></label>
                            <select name="Id_Tran_TransaccionParcial" id="Id_Tran_TransaccionParcial" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_transacciones as $transacciones)
                                { 
                                    $print_value =  $transacciones->Numero_Tran;
                                    $selected = '';
                                    if (isset($Id_Tran)) {
                                        $selected = ($transacciones->Id_Tran==$Id_Tran_TransaccionParcial) ? 'selected':'';
                                    }
                                    echo '<option value="'.$transacciones->Id_Tran.'"  '.$selected.'> '.$print_value.'</option>';
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
                                    $selected = '';
                                    if (isset($Id_Usu)) {
                                        $selected = ($usuario->Id_Usu==$Id_Usu) ? 'selected':'';
                                    }
                                    echo '<option value="'.$usuario->Id_Usu.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
	
                </form>
            </div>
        </div>
        <div class="container-fluid table-responsive">
            <table id="mytable" class="table table-fixed table-condensed table-hover table-sm" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><i class="fas fa-eye"></i></th>
                        <th><i class="fas fa-cash-register"></i></th>
                        <th><i class="fas fa-cog"></i></th>
                        <th><?=t('Id_Per'); ?></th>
                		<th><?=t('Numero_Tran'); ?></th>
                        <th><?=t('Id_TranEst'); ?></th>
                        <th>Total</th>
                        <th><?=t('Id_Ban'); ?></th>
                        <th><?=t('Id_TranTip'); ?></th>
                		<th><?=t('Fecha_Tran'); ?></th>
                		<th><?=t('DocumentoAsociado_Tran'); ?></th>
                		<th><?=t('Id_Tran_TransaccionParcial'); ?></th>
                        <th><?=t('Id_Usu'); ?></th>
                        <th><?=t('FechaRegistro_Tran'); ?></th>
		
                    </tr>
                </thead>
                <tbody>
	    
                </tbody>
                <tfoot>
                    <tr>
                        <td>#</td>
                        <th><i class="fas fa-eye"></i></th>
                        <th><i class="fas fa-cash-register"></i></th>
                        <th><i class="fas fa-cog"></i></th>
                		<td></td>
                		<td></td>
                		<td></td>
                		<td></td>
                		<td></td>
                		<td></td>
                		<td></td>
                		<td></td>
                		<td></td>
                		<td></td>
		                <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
</div>
        <?php $this->load->view('footer'); ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#mytable").dataTable({
                	scrollCollapse: true,
                	scrollX: true,
                    initComplete: function() {
                        var api = this.api();
                        $('#Search')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                        $('#btn_search').on('click', function(event) {
                            api.search($('#Search').val()).draw();
                        });
                        $('select.selectpicker').on('change click', function () {
                            api.search($('#Search').val()).draw();
                        } );
                        // [2,3,4,5,6,7,8,9,10,11,12,13] //Columnnas de la tabla
                        this.api().columns([5]).every( function (i) {
                            var column = this;
                            var select = $('<select><option value="">Ver todos</option></select>')
                                .appendTo( $(column.footer()).empty() )
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    column
                                        .search( val ? val : '', true, false )
                                        .draw();
                                } );
             
                            column.data().unique().sort().each( function ( d, j ) {
                                select.append( '<option value="'+d+'">'+d+'</option>' )
                            } );
                        } );
                    },
                    dom: 'riltp', // f
                    "language": {
                        "url": "<?php echo site_url() ?>assets/js/spanish.json"
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {
                        "url": "<?php echo site_url(strtolower($module).'/json/'.$type) ?>", 
                        "type": "POST",
                        "data": function(d) {
                            d.filter_dataForm = JSON.stringify($('#form_filter_collapse').serializeArray());
                            d.search_dataForm = $('#Search').val();
                        }
                    },
                    columns: [
                        {
                            "data": "Id_Tran",
                            "orderable": false
                        },
                        {
                            "data" : "ver",
                            "orderable": false,
                            "className" : "text-center"
                        },
                        {
                            "data" : "pago",
                            "orderable": false,
                            "className" : "text-center"
                        },
                        {
                            "data" : "opciones",
                            "orderable": false,
                            "className" : "text-center"
                        },{"data": "Id_Per"},
                        {"data": "Numero_Tran"},{"data": "Id_TranEst"},{"data": "total"},{"data": "Id_Ban"},{"data": "Id_TranTip"},{"data": "Fecha_Tran"},{"data": "DocumentoAsociado_Tran"},{"data": "Id_Tran_TransaccionParcial"},{"data": "Id_Usu"},{"data": "FechaRegistro_Tran"}
                        
                    ],
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });
        </script>
    </body>
</html>