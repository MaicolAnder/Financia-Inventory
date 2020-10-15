
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
            <?php // ver_array($this->uri->segment(3)); ?>
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
                            <label for="Id_DocEst"><?=t('Id_DocEst'); ?> <?php echo form_error('Id_DocEst') ?></label>
                            <select name="Id_DocEst" id="Id_DocEst" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_documento_estado as $documento_estado)
                                { 
                                    $print_value =  $documento_estado->Nombre_DocEst;
                                    $selected = '';
                                    if (isset($Id_DocEst)) {
                                        $selected = ($documento_estado->Id_DocEst==$Id_DocEst) ? 'selected':'';
                                    }
                                    echo '<option value="'.$documento_estado->Id_DocEst.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_DocTip"><?=t('Id_DocTip'); ?> <?php echo form_error('Id_DocTip') ?></label>
                            <select name="Id_DocTip" id="Id_DocTip" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_documento_tipo as $documento_tipo)
                                { 
                                    $print_value =  $documento_tipo->Nombre_DocTip;
                                    $selected = '';
                                    if (isset($Id_DocTip)) {
                                        $selected = ($documento_tipo->Id_DocTip==$Id_DocTip) ? 'selected':'';
                                    }
                                    echo '<option value="'.$documento_tipo->Id_DocTip.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		<?php /* ?>
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_Per"><?=t('Id_Per'); ?> <?php echo form_error('Id_Per') ?></label>
                            <select name="Id_Per" id="Id_Per" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_persona as $persona)
                                { 
                                    $print_value =  $persona->Identificacion_Per;
                                    $selected = '';
                                    if (isset($Id_Per)) {
                                        $selected = ($persona->Id_Per==$Id_Per) ? 'selected':'';
                                    }
                                    echo '<option value="'.$persona->Id_Per.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		*/ ?>
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_TerPag"><?=t('Id_TerPag'); ?> <?php echo form_error('Id_TerPag') ?></label>
                            <select name="Id_TerPag" id="Id_TerPag" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_termino_pago as $termino_pago)
                                { 
                                    $print_value =  $termino_pago->Nombre_TerPag;
                                    $selected = '';
                                    if (isset($Id_TerPag)) {
                                        $selected = ($termino_pago->Id_TerPag==$Id_TerPag) ? 'selected':'';
                                    }
                                    echo '<option value="'.$termino_pago->Id_TerPag.'"  '.$selected.'> '.$print_value.'</option>';
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
                        <th><?=t('Numero_Doc'); ?></th>
                        <th><?=t('Id_DocEst'); ?></th>
                        <th>Total</th>
                        <th><?=t('FechaDocumento_Doc'); ?></th>
                        <th><?=t('Id_TerPag'); ?></th>
                        <th><?=t('FechaVencimiento_Doc'); ?></th>
                        <th><?=t('Id_DocTip'); ?></th>
                        <th><?=t('Id_Usu'); ?></th>
                		<th><?=t('FechaRegistro_Doc'); ?></th>
		
                    </tr>
                </thead>
                <tbody>
	    
                </tbody>
                <tfoot>
                    <tr>
                        <td>#</td>
                        <td><i class="fas fa-eye"></i></td>
                        <td><i class="fas fa-cash-register"></i></td>
                        <td><i class="fas fa-cog"></i></td>
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
                            "data": "Id_Doc",
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
                        },
                        {"data": "Id_Per"}, {"data": "Numero_Doc"},{"data": "Id_DocEst"},{"data": "total_doc"},{"data": "FechaDocumento_Doc"},{"data": "Id_TerPag"},{"data": "FechaVencimiento_Doc"},{"data": "Id_DocTip"},{"data": "Id_Usu"},{"data": "FechaRegistro_Doc"}
                        
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