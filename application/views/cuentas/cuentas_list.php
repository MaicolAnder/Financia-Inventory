
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
                    <?php /* ?>
                    <div class="dropdown-divider"></div>
		                <a class="dropdown-item primary" href="<?php echo site_url(strtolower($module).'/excel') ?>"><i class="btn-outline-success fas fa-file-excel fa-lg"></i> Generar Excel</a>
                    <?php */ ?>
	 
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
                            <label for="Id_CueEst"><?=t('Id_CueEst'); ?> <?php echo form_error('Id_CueEst') ?></label>
                            <select name="Id_CueEst" id="Id_CueEst" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_cuenta_estado as $cuenta_estado)
                                { 
                                    $print_value =  $cuenta_estado->Nombre_CueEst;
                                    $selected = '';
                                    if (isset($Id_CueEst)) {
                                        $selected = ($cuenta_estado->Id_CueEst==$Id_CueEst) ? 'selected':'';
                                    }
                                    echo '<option value="'.$cuenta_estado->Id_CueEst.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_CueTip"><?=t('Id_CueTip'); ?> <?php echo form_error('Id_CueTip') ?></label>
                            <select name="Id_CueTip" id="Id_CueTip" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_cuenta_tipo as $cuenta_tipo)
                                { 
                                    $print_value =  $cuenta_tipo->Nombre_CueTip;
                                    $selected = '';
                                    if (isset($Id_CueTip)) {
                                        $selected = ($cuenta_tipo->Id_CueTip==$Id_CueTip) ? 'selected':'';
                                    }
                                    echo '<option value="'.$cuenta_tipo->Id_CueTip.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_Cue_CuentaPadre"><?=t('Id_Cue_CuentaPadre'); ?> <?php echo form_error('Id_Cue_CuentaPadre') ?></label>
                            <select name="Id_Cue_CuentaPadre" id="Id_Cue_CuentaPadre" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                ListadoCuentas() ?>
                            </select>

                        </div>
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_NatCue"><?=t('Id_NatCue'); ?> <?php echo form_error('Id_NatCue') ?></label>
                            <select name="Id_NatCue" id="Id_NatCue" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_naturaleza_cuenta as $naturaleza_cuenta)
                                { 
                                    $print_value =  $naturaleza_cuenta->Nombre_NatCue;
                                    $selected = '';
                                    if (isset($Id_NatCue)) {
                                        $selected = ($naturaleza_cuenta->Id_NatCue==$Id_NatCue) ? 'selected':'';
                                    }
                                    echo '<option value="'.$naturaleza_cuenta->Id_NatCue.'"  '.$selected.'> '.$print_value.'</option>';
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
                        
		<th><?=t('Nombre_Cue'); ?></th>
		<th><?=t('Cuenta_Cue'); ?></th>
		<th><?=t('Consecutivo_Cue'); ?></th>
		<th><?=t('Id_NatCue'); ?></th>
		<th><?=t('Id_CueEst'); ?></th>
		<th><?=t('Id_CueTip'); ?></th>
		<th><?=t('Id_Cue_CuentaPadre'); ?></th>
		
                    </tr>
                </thead>
                <tbody>
	    
                </tbody>
                <tfoot>
                    <tr>
                        <td>#</td>
                        <td><i class="fas fa-eye"></i></td>
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
                            "data": "Id_Cue",
                            "orderable": false,
                            "className" : "text-center"
                        },
                        //{
                        //    "data" : "actualizar",
                        //    "orderable": false,
                        //    "className" : "text-center"
                        //},
                        {
                            "data" : "ver",
                            "orderable": false,
                            "className" : "text-center"
                        },
                        // {
                        //     "data" : "eliminar",
                        //     "orderable": false,
                        //     "className" : "text-center"
                        // },
                        {"data": "Nombre_Cue"},{"data": "Cuenta_Cue"},{"data": "Consecutivo_Cue"},{"data": "Id_NatCue"},{"data": "Id_CueEst"},{"data": "Id_CueTip"},{"data": "Id_Cue_CuentaPadre"}
                        
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