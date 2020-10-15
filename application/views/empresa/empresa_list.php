
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4"> </div>
            
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? '<span class="badge badge-success">'.$this->session->userdata('message').'</span>' : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <!-- <h2 style="margin-top:0px">Listado de Empresa </h2> -->
                <h2 style="margin-top:0px"><?php echo $page ?></h2>
            </div>
            <div class="col-md-5 text-left">
                <div class="input-group mb-3">
                    <input type="search" class="form-control" placeholder="Buscar" aria-label="Username" aria-describedby="Search" id="Search">
                    <div class="input-group-prepend">
                        <span class="input-group-text" ><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </div> 
            <div class="col-md-3 text-center"></div>
            <div class="col-md-4 text-right">
                <div class="btn-group dropright">
                    <?php echo anchor(site_url(strtolower($module).'/create'), '<i class="fas fa-plus-circle"></i> Crear', 'class="btn btn-primary"'); ?>
                    <button type="button" class="btn btn-primary2 dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropright</span>
                        <i class="fas fa-cog"></i> Exportar
                    </button>
                    <div class="dropdown-menu">
		<a class="dropdown-item label-primary" href="<?php echo site_url(strtolower($module).'/excel') ?>"><i class="fas fa-file-excel"></i> Generar Excel</a>
		<a class="dropdown-item label-primary" href="<?php echo site_url(strtolower($module).'/word') ?>"><i class="fas fa-file-word"></i> Generar Word</a>
	 
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-fixed table-condensed table-striped" id="mytable" >
                <thead>
                    <tr>
                        <th>No</th>
		    <th>Nombre Emp</th>
		    <th>DigitoVerificacion Emp</th>
		    <th>Correo Emp</th>
		    <th>Direccion Emp</th>
		    <th>Telefono Emp</th>
		    <th>TelCelular Emp</th>
		    <th>Nit Emp</th>
		    <th>Id Mun</th>
		    <th>Id EmpTip</th>
		    <th>CodigoIPS Emp</th>
		    <th>CodigoSedeIPS Emp</th>
		    <th>CodigoPrestador Emp</th>
		    <th>Sede Emp</th>
		  
                        <th><i class="fas fa-pencil-alt"></i></th> 
                        <th><i class="fas fa-eye"></i></th>
                        <th><i class="fas fa-trash-alt"></i></th>
                    </tr>
                </thead>
                <tbody>
	    
                </tbody>
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
                    initComplete: function() {
                        var api = this.api();
                        $('#Search')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    dom: 'ritlp', // f
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "<?php echo site_url(strtolower($module).'/json') ?>", "type": "POST"},
                    columns: [
                        {
                            "data": "Id_Emp",
                            "orderable": false
                        },{"data": "Nombre_Emp"},{"data": "DigitoVerificacion_Emp"},{"data": "Correo_Emp"},{"data": "Direccion_Emp"},{"data": "Telefono_Emp"},{"data": "TelCelular_Emp"},{"data": "Nit_Emp"},{"data": "Id_Mun"},{"data": "Id_EmpTip"},{"data": "CodigoIPS_Emp"},{"data": "CodigoSedeIPS_Emp"},{"data": "CodigoPrestador_Emp"},{"data": "Sede_Emp"},
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