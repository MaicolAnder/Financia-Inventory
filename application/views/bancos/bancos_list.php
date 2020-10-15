
    <div class="card">
        <div class="card-header">
            <h5 style="float: left;"><?php echo $page ?></h5>
            <div class="btn-group dropright" style="float: right;">
                <?php echo anchor(site_url(strtolower($module).'/create'), '<i class="fas fa-plus-circle"></i>', 'title="Crear nuevo" class="btn btn-link color-dark"'); ?>
                <button class="btn btn-link color-dark" data-toggle="collapse" data-target="#action_filter_collapse" id="btn_filter_active" title="Mostrar más filtros">
                    <i class="fas fa-filter"></i>
                </button>
                <button type="button" class="btn btn-link color-dark dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Menú opciones">
                    <span class="sr-only">Toggle Dropright</span>
                    <i class="fas fa-cog"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item primary" href="<?php echo site_url(strtolower($module).'/create') ?>"><i class="btn-outline-dark fas fa-plus-circle"></i> Nuevo registro</a>
                    <div class="dropdown-divider"></div>
		<a class="dropdown-item primary" href="<?php echo site_url(strtolower($module).'/excel') ?>"><i class="btn-outline-success fas fa-file-excel fa-lg"></i> Generar Excel</a>
	 
                </div>
            </div>
        </div>

        <?php //ver_array($this->session->userdata('Primary_Usu')); ?>
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
                            <label for="Id_BanEst"><?=t('Id_BanEst'); ?> <?php echo form_error('Id_BanEst') ?></label>
                            <select name="Id_BanEst" id="Id_BanEst" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_banco_estado as $banco_estado)
                                { 
                                    $print_value =  $banco_estado->Nombre_BanEst;
                                    $selected = '';
                                    if (isset($Id_BanEst)) {
                                        $selected = ($banco_estado->Id_BanEst==$Id_BanEst) ? 'selected':'';
                                    }
                                    echo '<option value="'.$banco_estado->Id_BanEst.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_TipCueBan"><?=t('Id_TipCueBan'); ?> <?php echo form_error('Id_TipCueBan') ?></label>
                            <select name="Id_TipCueBan" id="Id_TipCueBan" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_tipo_cuenta_banco as $tipo_cuenta_banco)
                                { 
                                    $print_value =  $tipo_cuenta_banco->Nombre_TipCueBan;
                                    $selected = '';
                                    if (isset($Id_TipCueBan)) {
                                        $selected = ($tipo_cuenta_banco->Id_TipCueBan==$Id_TipCueBan) ? 'selected':'';
                                    }
                                    echo '<option value="'.$tipo_cuenta_banco->Id_TipCueBan.'"  '.$selected.'> '.$print_value.'</option>';
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
                        <th><i class="fas fa-pencil-alt"></i></th> 
                        <th><i class="fas fa-eye"></i></th>
                        <th><i class="fas fa-trash-alt"></i></th>
                        
		<th><?=t('NombreCuenta_Ban'); ?></th>
		<th><?=t('NumeroCuenta_Ban'); ?></th>
		<th><?=t('SaldoInicial_Ban'); ?></th>
        <th><?=t('Id_BanEst'); ?></th>
        <th><?=t('Id_TipCueBan'); ?></th>
        <th><?=t('Descripcion_Ban'); ?></th>
		<th><?=t('FechaBanco'); ?></th>
		<th><?=t('FechaRegistro'); ?></th>
		
                    </tr>
                </thead>
                <tbody>
	    
                </tbody>
                <tfoot>
                    <tr>
                        <td>#</td>
                        <td><i class="fas fa-pencil-alt"></i></td> 
                        <td><i class="fas fa-eye"></i></td>
                        <td><i class="fas fa-trash-alt"></i></td>
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
                        this.api().columns([4]).every( function (i) {
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
                        "url": "<?php echo site_url(strtolower($module).'/json') ?>", 
                        "type": "POST",
                        "data": function(d) {
                            d.filter_dataForm = JSON.stringify($('#form_filter_collapse').serializeArray());
                            d.search_dataForm = $('#Search').val();
                        }
                    },
                    columns: [
                        {
                            "data": "Id_Ban",
                            "orderable": false
                        },
                        {
                            "data" : "actualizar",
                            "orderable": false,
                            "className" : "text-center"
                        },
                        {
                            "data" : "ver",
                            "orderable": false,
                            "className" : "text-center"
                        },
                        {
                            "data" : "eliminar",
                            "orderable": false,
                            "className" : "text-center"
                        },
                        {"data": "NombreCuenta_Ban"},{"data": "NumeroCuenta_Ban"},{"data": "SaldoInicial_Ban"},{"data": "Nombre_BanEst"},{"data": "Nombre_TipCueBan"},{"data": "Descripcion_Ban"},{"data": "FechaBanco"},{"data": "FechaRegistro"}
                        
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