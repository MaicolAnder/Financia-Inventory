
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
                            <label for="Id_Emp"><?=t('Id_Emp'); ?> <?php echo form_error('Id_Emp') ?></label>
                            <select name="Id_Emp" id="Id_Emp" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_empresa as $empresa)
                                { 
                                    $print_value =  $empresa->Nombre_Emp;
                                    $selected = '';
                                    if (isset($Id_Emp)) {
                                        $selected = ($empresa->Id_Emp==$Id_Emp) ? 'selected':'';
                                    }
                                    echo '<option value="'.$empresa->Id_Emp.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_Mun"><?=t('Id_Mun'); ?> <?php echo form_error('Id_Mun') ?></label>
                            <select name="Id_Mun" id="Id_Mun" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_municipio as $municipio)
                                { 
                                    $departamento = $this->Departamento_model->get_by_id($municipio->Id_Dep);
                                    $print_value =  $municipio->Nombre_Num." (".$departamento->Nombre_Dep.")";

                                    $selected = '';
                                    if (isset($Id_Mun)) {
                                        $selected = ($municipio->Id_Mun==$Id_Mun) ? 'selected':'';
                                    }
                                    echo '<option value="'.$municipio->Id_Mun.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_PerEst"><?=t('Id_PerEst'); ?> <?php echo form_error('Id_PerEst') ?></label>
                            <select name="Id_PerEst" id="Id_PerEst" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_persona_estado as $persona_estado)
                                { 
                                    $print_value =  $persona_estado->Estado_PerEst;
                                    $selected = '';
                                    if (isset($Id_PerEst)) {
                                        $selected = ($persona_estado->Id_PerEst==$Id_PerEst) ? 'selected':'';
                                    }
                                    echo '<option value="'.$persona_estado->Id_PerEst.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_PerGen"><?=t('Id_PerGen'); ?> <?php echo form_error('Id_PerGen') ?></label>
                            <select name="Id_PerGen" id="Id_PerGen" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_persona_genero as $persona_genero)
                                { 
                                    $print_value =  "(".$persona_genero->Codigo_PerGen.") ".$persona_genero->Descripcion_PerGen;
                                    $selected = '';
                                    if (isset($Id_PerGen)) {
                                        $selected = ($persona_genero->Id_PerGen==$Id_PerGen) ? 'selected':'';
                                    }
                                    echo '<option value="'.$persona_genero->Id_PerGen.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_PerTip"><?=t('Id_PerTip'); ?> <?php echo form_error('Id_PerTip') ?></label>
                            <select name="Id_PerTip" id="Id_PerTip" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_persona_tipo as $persona_tipo)
                                { 
                                    $print_value =  $persona_tipo->Descripcion_PerTip;
                                    $selected = '';
                                    if (isset($Id_PerTip)) {
                                        $selected = ($persona_tipo->Id_PerTip==$Id_PerTip) ? 'selected':'';
                                    }
                                    echo '<option value="'.$persona_tipo->Id_PerTip.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_PerTipId"><?=t('Id_PerTipId'); ?> <?php echo form_error('Id_PerTipId') ?></label>
                            <select name="Id_PerTipId" id="Id_PerTipId" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_persona_tipo_identificacion as $persona_tipo_identificacion)
                                { 
                                    $print_value =  "(".$persona_tipo_identificacion->Codigo_PerTipId.") ".$persona_tipo_identificacion->Descripcion_PerTipId;
                                    $selected = '';
                                    if (isset($Id_PerTipId)) {
                                        $selected = ($persona_tipo_identificacion->Id_PerTipId==$Id_PerTipId) ? 'selected':'';
                                    }
                                    echo '<option value="'.$persona_tipo_identificacion->Id_PerTipId.'"  '.$selected.'> '.$print_value.'</option>';
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
                        
                		<th><?=t('Identificacion_Per'); ?></th>
                		<th><?=t('Nombre1_Per'); ?></th>
                		<th><?=t('Nombre2_Per'); ?></th>
                		<th><?=t('Apeliido1_Per'); ?></th>
                		<th><?=t('Apellido2_Per'); ?></th>
                		<th><?=t('Telefono_Per'); ?></th>
                		<th><?=t('TelCelular_Per'); ?></th>
                		<th><?=t('Correo_Per'); ?></th>
                		<th><?=t('Direccion_Per'); ?></th>
                		<th><?=t('FechaNacimiento_Per'); ?></th>
                		<th><?=t('FechaRegistro_Per'); ?></th>
                		<th><?=t('Celular_Per'); ?></th>
                		<th><?=t('Id_PerTipId'); ?></th>
                		<th><?=t('Id_PerGen'); ?></th>
                		<th><?=t('Id_Mun'); ?></th>
                		<th><?=t('Id_PerEst'); ?></th>
                		<th><?=t('Id_PerTip'); ?></th>
                		<th><?=t('Id_Emp'); ?></th>
		
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
                            "data": "Id_Per",
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
                        {"data": "Identificacion_Per"},{"data": "Nombre1_Per"},{"data": "Nombre2_Per"},{"data": "Apeliido1_Per"},{"data": "Apellido2_Per"},{"data": "Telefono_Per"},{"data": "TelCelular_Per"},{"data": "Correo_Per"},{"data": "Direccion_Per"},{"data": "FechaNacimiento_Per"},{"data": "FechaRegistro_Per"},{"data": "Celular_Per"},{"data": "Descripcion_PerTipId"},{"data": "Descripcion_PerGen"},{"data": "Nombre_Num"},{"data": "Estado_PerEst"},{"data": "Descripcion_PerTip"},{"data": "Nombre_Emp"}
                        
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