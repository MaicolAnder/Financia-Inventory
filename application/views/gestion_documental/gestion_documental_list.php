
        <div class="row" style="margin-bottom: 0px">
            <div class="col-md-4"> </div>
            
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? '<span class="badge badge-success">'.$this->session->userdata('message').'</span>' : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <!-- <h2 style="margin-top:0px">Listado de Gestion_documental </h2> -->
                <h4 style="margin-top:0px"><?php echo $page ?></h4>
            </div>
            <div class="col-md-5 text-left">
                <div class="input-group mb-3">
                    <input type="search" class="form-control" placeholder="Buscar" aria-label="Username" aria-describedby="Search" id="Search">
                    <div class="input-group-prepend">
                        <!-- <span class="input-group-text" ><i class="fas fa-search"></i></span> -->
                        <button class="btn btn-secondary" id="btn_search">
                            <i class="fas fa-search"></i>
                        </button> 
                        <button class="btn btn-primary" onclick="javascript:location.reload();">
                            <i class="fas fa-sync-alt"></i>
                        </button> 
                    </div>
                </div>
            </div> 
            <div class="col-md-3 text-center"></div>
            <div class="col-md-4 text-right">
                <div class="btn-group dropright">
                    <?php echo anchor(site_url(strtolower($module).'/create'), '<i class="fas fa-plus-circle"></i>', 'title="Crear nuevo" class="btn btn-secondary"'); ?>
                    <button class="btn btn-primary" data-toggle="collapse" data-target="#action_filter_collapse" id="btn_filter_active" title="Mostrar más filtros">
                        <i class="fas fa-filter"></i>
                    </button>
                    <button type="button" class="btn btn-primary dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Menú opciones">
                        <span class="sr-only">Toggle Dropright</span>
                        <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu">
		<a class="dropdown-item primary" href="<?php echo site_url(strtolower($module).'/excel') ?>"><i class="badge-primary fas fa-file-excel fa-lg"></i> Generar Excel</a>
		<a class="dropdown-item primary" href="<?php echo site_url(strtolower($module).'/word') ?>"><i class="badge-info fas fa-file-word fa-lg"></i> Generar Word</a>
	 
                    </div>
                </div>
            </div>
            <div id="action_filter_collapse" class="collapse col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form id="form_filter_collapse" class="row" method="post">
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_Afi">Afiliado <?php echo form_error('Id_Afi') ?></label>
            <select name="Id_Afi" id="Id_Afi" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
                <?php
                foreach($all_afiliado as $afiliado)
                { 
                    $print_value =  $afiliado->Id_Afi;
                    $selected = '';
                    if (isset($Id_Afi)) {
                        $selected = ($afiliado->Id_Afi==$Id_Afi) ? 'selected':'';
                    }
                    echo '<option value="'.$afiliado->Id_Afi.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>

        </div>
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_Aut">Autorizaciones <?php echo form_error('Id_Aut') ?></label>
            <select name="Id_Aut" id="Id_Aut" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
                <?php
                foreach($all_autorizaciones as $autorizaciones)
                { 
                    $print_value =  $autorizaciones->Id_Aut;
                    $selected = '';
                    if (isset($Id_Aut)) {
                        $selected = ($autorizaciones->Id_Aut==$Id_Aut) ? 'selected':'';
                    }
                    echo '<option value="'.$autorizaciones->Id_Aut.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>

        </div>
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_Con">Contratos <?php echo form_error('Id_Con') ?></label>
            <select name="Id_Con" id="Id_Con" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
                <?php
                foreach($all_contratos as $contratos)
                { 
                    $print_value =  $contratos->Id_Con;
                    $selected = '';
                    if (isset($Id_Con)) {
                        $selected = ($contratos->Id_Con==$Id_Con) ? 'selected':'';
                    }
                    echo '<option value="'.$contratos->Id_Con.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>

        </div>
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_Per">Persona <?php echo form_error('Id_Per') ?></label>
            <select name="Id_Per" id="Id_Per" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
                <?php
                foreach($all_persona as $persona)
                { 
                    $print_value =  $persona->Id_Per;
                    $selected = '';
                    if (isset($Id_Per)) {
                        $selected = ($persona->Id_Per==$Id_Per) ? 'selected':'';
                    }
                    echo '<option value="'.$persona->Id_Per.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>

        </div>
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_PerAut">Pertinencia Autorizacion <?php echo form_error('Id_PerAut') ?></label>
            <select name="Id_PerAut" id="Id_PerAut" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
                <?php
                foreach($all_pertinencia_autorizacion as $pertinencia_autorizacion)
                { 
                    $print_value =  $pertinencia_autorizacion->Id_PerAut;
                    $selected = '';
                    if (isset($Id_PerAut)) {
                        $selected = ($pertinencia_autorizacion->Id_PerAut==$Id_PerAut) ? 'selected':'';
                    }
                    echo '<option value="'.$pertinencia_autorizacion->Id_PerAut.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>

        </div>
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_Usu">Usuario <?php echo form_error('Id_Usu') ?></label>
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
        <div class="table-responsive">
            <table id="mytable" class="table table-fixed table-condensed table-striped" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
		    <th>Nombre GesDoc</th>
		    <th>Descripcion GesDoc</th>
		    <th>NombreInterno GesDoc</th>
		    <th>Ubicacion GesDoc</th>
		    <th>Formato GesDoc</th>
		    <th>Tamanio GesDoc</th>
		    <th>FechaRegistro GesDoc</th>
		    <th>Id Usu</th>
		    <th>Id Per</th>
		    <th>Id PerAut</th>
		    <th>Id Afi</th>
		    <th>Id Aut</th>
		    <th>Id Con</th>
		  
                        <th><i class="fas fa-pencil-alt"></i></th> 
                        <th><i class="fas fa-eye"></i></th>
                        <th><i class="fas fa-trash-alt"></i></th>
                    </tr>
                </thead>
                <tbody>
	    
                </tbody>
                <tfoot>
                    <tr>
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
		  
                        <td><i class="fas fa-pencil-alt"></i></td> 
                        <td><i class="fas fa-eye"></i></td>
                        <td><i class="fas fa-trash-alt"></i></td>
                    </tr>
                </tfoot>
            </table>
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
                        this.api().columns().every( function (i) {
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
                    dom: 'ritlp', // f
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
                            "data": "Id_GesDoc",
                            "orderable": false
                        },{"data": "Nombre_GesDoc"},{"data": "Descripcion_GesDoc"},{"data": "NombreInterno_GesDoc"},{"data": "Ubicacion_GesDoc"},{"data": "Formato_GesDoc"},{"data": "Tamanio_GesDoc"},{"data": "FechaRegistro_GesDoc"},{"data": "Id_Usu"},{"data": "Id_Per"},{"data": "Id_PerAut"},{"data": "Id_Afi"},{"data": "Id_Aut"},{"data": "Id_Con"},
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
                        }
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