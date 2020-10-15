
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
                            <label for="Id_Bod"><?=t('Id_Bod'); ?> <?php echo form_error('Id_Bod') ?></label>
                            <select name="Id_Bod" id="Id_Bod" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_bodegas as $bodegas)
                                { 
                                    $print_value =  $bodegas->Nombre_Bod;
                                    $selected = '';
                                    if (isset($Id_Bod)) {
                                        $selected = ($bodegas->Id_Bod==$Id_Bod) ? 'selected':'';
                                    }
                                    echo '<option value="'.$bodegas->Id_Bod.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_CatIte"><?=t('Id_CatIte'); ?> <?php echo form_error('Id_CatIte') ?></label>
                            <select name="Id_CatIte" id="Id_CatIte" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_categoria_item as $categoria_item)
                                { 
                                    $print_value =  $categoria_item->Nombre_CatIte;
                                    $selected = '';
                                    if (isset($Id_CatIte)) {
                                        $selected = ($categoria_item->Id_CatIte==$Id_CatIte) ? 'selected':'';
                                    }
                                    echo '<option value="'.$categoria_item->Id_CatIte.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_IteEst"><?=t('Id_IteEst'); ?> <?php echo form_error('Id_IteEst') ?></label>
                            <select name="Id_IteEst" id="Id_IteEst" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_item_estado as $item_estado)
                                { 
                                    $print_value =  $item_estado->Nombre_IteEst;
                                    $selected = '';
                                    if (isset($Id_IteEst)) {
                                        $selected = ($item_estado->Id_IteEst==$Id_IteEst) ? 'selected':'';
                                    }
                                    echo '<option value="'.$item_estado->Id_IteEst.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_IteTip"><?=t('Id_IteTip'); ?> <?php echo form_error('Id_IteTip') ?></label>
                            <select name="Id_IteTip" id="Id_IteTip" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_item_tipo as $item_tipo)
                                { 
                                    $print_value =  $item_tipo->Nombre_IteTip;
                                    $selected = '';
                                    if (isset($Id_IteTip)) {
                                        $selected = ($item_tipo->Id_IteTip==$Id_IteTip) ? 'selected':'';
                                    }
                                    echo '<option value="'.$item_tipo->Id_IteTip.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_Mar"><?=t('Id_Mar'); ?> <?php echo form_error('Id_Mar') ?></label>
                            <select name="Id_Mar" id="Id_Mar" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_marcas as $marcas)
                                { 
                                    $print_value =  $marcas->Nombre_Mar;
                                    $selected = '';
                                    if (isset($Id_Mar)) {
                                        $selected = ($marcas->Id_Mar==$Id_Mar) ? 'selected':'';
                                    }
                                    echo '<option value="'.$marcas->Id_Mar.'"  '.$selected.'> '.$print_value.'</option>';
                                } ?>
                            </select>

                        </div>
		
                        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <label for="Id_Med"><?=t('Id_Med'); ?> <?php echo form_error('Id_Med') ?></label>
                            <select name="Id_Med" id="Id_Med" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                foreach($all_medidas as $medidas)
                                { 
                                    $print_value =  $medidas->Nombre_Med;
                                    $selected = '';
                                    if (isset($Id_Med)) {
                                        $selected = ($medidas->Id_Med==$Id_Med) ? 'selected':'';
                                    }
                                    echo '<option value="'.$medidas->Id_Med.'"  '.$selected.'> '.$print_value.'</option>';
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
                                    $print_value =  $usuario->Id_Usu;
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
                        <th><i class="fas fa-pencil-alt"></i></th> 
                        <th><i class="fas fa-eye"></i></th>
                        <th><i class="fas fa-trash-alt"></i></th>
                		<th><?=t('Nombre_Ite'); ?></th>
                		<th><?=t('Referencia_Ite'); ?></th>
                		<th><?=t('Serie_Ite'); ?></th>
                        <th><?=t('Id_IteTip'); ?></th>
                        <th><?=t('Id_IteEst'); ?></th>
                        <th><?=t('Id_CatIte'); ?></th>
                        <th><?=t('Id_Mar'); ?></th>
                        <th><?=t('Id_Med'); ?></th>
                		<th><?=t('Imagen_Item'); ?></th>
                        <th><?=t('Id_Bod'); ?></th>
                		<th><?=t('Id_Usu'); ?></th>
                        <th><?=t('FechaRegistro_Ite'); ?></th>
		
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
                            "data": "Id_Ite",
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
                        {"data": "Nombre_Ite"},{"data": "Referencia_Ite"},{"data": "Serie_Ite"},{"data": "Nombre_IteTip"},{"data": "Nombre_IteEst"},{"data": "Nombre_CatIte"},{"data": "Nombre_Mar"},{"data": "Nombre_Med"},{"data": "Imagen_Item"},{"data": "Nombre_Bod"},{"data": "Id_Usu"},{"data": "FechaRegistro_Ite"}
                        
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