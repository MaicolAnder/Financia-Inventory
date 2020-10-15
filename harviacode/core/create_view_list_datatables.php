<?php 

$string = "
    <div class=\"card\">
        <div class=\"card-header\">
            <h5 style=\"float: left;\"><?php echo \$page ?></h5>
            <div class=\"btn-group dropright\" style=\"float: right;\">
                <?php echo anchor(site_url(strtolower(\$module).'/create'), '<i class=\"fas fa-plus-circle\"></i>', 'title=\"Crear nuevo\" class=\"btn btn-link color-dark\"'); ?>
                <button class=\"btn btn-link color-dark\" data-toggle=\"collapse\" data-target=\"#action_filter_collapse\" id=\"btn_filter_active\" title=\"Mostrar más filtros\">
                    <i class=\"fas fa-filter\"></i>
                </button>
                <button type=\"button\" class=\"btn btn-link color-dark dropdown-toggle-split\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" title=\"Menú opciones\">
                    <span class=\"sr-only\">Toggle Dropright</span>
                    <i class=\"fas fa-cog\"></i>
                </button>
                <div class=\"dropdown-menu\">
                    <a class=\"dropdown-item primary\" href=\"<?php echo site_url(strtolower(\$module).'/create') ?>\"><i class=\"btn-outline-dark fas fa-plus-circle\"></i> Nuevo registro</a>
                    <div class=\"dropdown-divider\"></div>";
                    if ($export_excel == '1') {
                        $string .= "\n\t\t<a class=\"dropdown-item primary\" href=\"<?php echo site_url(strtolower(\$module).'/excel') ?>\"><i class=\"btn-outline-success fas fa-file-excel fa-lg\"></i> Generar Excel</a>";
                    }
                    if ($export_word == '1') {
                        $string .= "\n\t\t<a class=\"dropdown-item primary\" href=\"<?php echo site_url(strtolower(\$module).'/word') ?>\"><i class=\"btn-outline-info fas fa-file-word fa-lg\"></i> Generar Word</a>";
                    } if ($export_pdf == '1') {
                        $string .= "\n\t\t<a class=\"dropdown-item primary\" href=\"<?php echo site_url(strtolower(\$module).'/pdf') ?>\"><i class=\"badge-danger fas fa-file-pdf fa-lg\"></i> Generar PDF</a>";
                    }
                $string .= "\n\t 
                </div>
            </div>
        </div>
        <div class=\"text-center\" style=\"margin-top: 0px\"  id=\"message\">              
            <?php echo \$this->session->userdata('message') <> '' ? '<div class=\"alert alert-info alert-dismissible fade show\" role=\"alert\" style=\"border-radius: .0rem;\"><strong>'.\$this->session->userdata('message').'</strong> <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>' : ''; ?>
        </div>
        <div class=\"card-body row\">
            <div class=\"col-md-5 text-left\">
                <div class=\"input-group mb-3\">
                    <input type=\"search\" class=\"form-control\" placeholder=\"Buscar\" aria-label=\"Username\" aria-describedby=\"Search\" id=\"Search\">
                    <div class=\"input-group-prepend\">
                        <button class=\"btn btn-secondary\" id=\"btn_search\" title=\"Buscar\">
                            <i class=\"fas fa-search\"></i>
                        </button> 
                        <button class=\"btn btn-primary\" onclick=\"javascript:location.reload();\" title=\"Recargar\">
                            <i class=\"fas fa-sync-alt\"></i>
                        </button> 
                    </div>
                </div>
            </div> 
            <div class=\"form-group col-md-3 text-center\"></div>
            <div class=\"col-md-4 text-right\"></div>
            <div id=\"action_filter_collapse\" class=\"collapse col-xs-12 col-sm-12 col-md-12 col-lg-12\">
                <form id=\"form_filter_collapse\" class=\"row\" method=\"post\">";
                if (count($fk_fiels)>0) {
                    foreach ($fk_fiels as $row) {
                        $fk_Table = $row['fk_Table'];
                        $column_name = $row['column_name'];
                        $fk_column = $row['fk_column'];
                        $string .= "\n\t\t
                        <div class=\"form-group col-xs-12 col-sm-6 col-md-3 col-lg-3\">
                            <label for=\"".$row["column_name"]."\"><?=t('".($row["column_name"])."'); ?> <?php echo form_error('".$row["column_name"]."') ?></label>
                            <select name=\"$column_name\" id=\"$column_name\" class=\"form-control selectpicker\" data-live-search=\"true\">
                                <option value=\"\">Seleccione</option>
                                <?php
                                foreach(\$all_$fk_Table as $".$fk_Table.")
                                { 
                                    \$print_value =  \$$fk_Table->$fk_column;
                                    \$selected = '';
                                    if (isset(\$".$fk_column.")) {
                                        \$selected = (\$".$fk_Table."->".$fk_column."==\$".$row["column_name"].") ? 'selected':'';
                                    }
                                    echo '<option value=\"'.\$$fk_Table->$fk_column.'\"  '.\$selected.'> '.\$print_value.'</option>';
                                } ?>
                            </select>

                        </div>";
                    }
                }
            $string .= "\n\t
                </form>
            </div>
        </div>
        <div class=\"container-fluid table-responsive\">
            <table id=\"mytable\" class=\"table table-fixed table-condensed table-hover table-sm\" width=\"100%\">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><i class=\"fas fa-pencil-alt\"></i></th> 
                        <th><i class=\"fas fa-eye\"></i></th>
                        <th><i class=\"fas fa-trash-alt\"></i></th>
                        ";
                            foreach ($non_pk as $row) {
                                $string .= "\n\t\t<th><?=t('".($row["column_name"])."'); ?></th>";
                            }
                        $string .= "\n\t\t
                    </tr>
                </thead>
                <tbody>";

                $column_non_pk = array();
                foreach ($non_pk as $row) {
                    $column_non_pk[] .= "{\"data\": \"".$row['column_name']."\"}";
                }
                $col_non_pk = implode(',', $column_non_pk);

                $string .= "\n\t    
                </tbody>
                <tfoot>
                    <tr>
                        <td>#</td>
                        <td><i class=\"fas fa-pencil-alt\"></i></td> 
                        <td><i class=\"fas fa-eye\"></i></td>
                        <td><i class=\"fas fa-trash-alt\"></i></td>";
                            foreach ($non_pk as $row) {
                                $string .= "\n\t\t<td></td>";
                            }
                        $string .= "\n\t\t
                    </tr>
                </tfoot>
            </table>
        </div>
</div>
        <?php \$this->load->view('footer'); ?>
        <script type=\"text/javascript\">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        \"iStart\": oSettings._iDisplayStart,
                        \"iEnd\": oSettings.fnDisplayEnd(),
                        \"iLength\": oSettings._iDisplayLength,
                        \"iTotal\": oSettings.fnRecordsTotal(),
                        \"iFilteredTotal\": oSettings.fnRecordsDisplay(),
                        \"iPage\": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        \"iTotalPages\": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $(\"#mytable\").dataTable({
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
                            var select = $('<select><option value=\"\">Ver todos</option></select>')
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
                                select.append( '<option value=\"'+d+'\">'+d+'</option>' )
                            } );
                        } );
                    },
                    dom: 'riltp', // f
                    \"language\": {
                        \"url\": \"<?php echo site_url() ?>assets/js/spanish.json\"
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {
                        \"url\": \"<?php echo site_url(strtolower(\$module).'/json') ?>\", 
                        \"type\": \"POST\",
                        \"data\": function(d) {
                            d.filter_dataForm = JSON.stringify($('#form_filter_collapse').serializeArray());
                            d.search_dataForm = $('#Search').val();
                        }
                    },
                    columns: [
                        {
                            \"data\": \"$pk\",
                            \"orderable\": false
                        },
                        {
                            \"data\" : \"actualizar\",
                            \"orderable\": false,
                            \"className\" : \"text-center\"
                        },
                        {
                            \"data\" : \"ver\",
                            \"orderable\": false,
                            \"className\" : \"text-center\"
                        },
                        {
                            \"data\" : \"eliminar\",
                            \"orderable\": false,
                            \"className\" : \"text-center\"
                        },
                        ".$col_non_pk."
                        
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
</html>";


$hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_list_file);

?>