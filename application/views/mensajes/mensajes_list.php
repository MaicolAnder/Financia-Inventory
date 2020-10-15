        <div class="card">
            <!-- <form action="<?php echo $action; ?>" method="post"> -->
            <div class="card-header">
                <!-- <h2 style="margin-top:0px">Mensajes </h2> -->
                <h5 class="text-left" style="margin-top:0px"><?php echo $page ?> <i class="fas fa-angle-down" style="float: right;"></i></h5>
            </div>
            <div class="text-center" style="margin-top: 0px"  id="message">              
                <?php echo $this->session->userdata('message') <> '' ? '<div class="alert alert-info alert-dismissible fade show" role="alert" style="border-radius: .0rem;"><strong>'.$this->session->userdata('message').'</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' : ''; ?>
            </div>
            <div class="card-body">
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-md-4">
                        <?php // echo anchor(site_url('mensajes/create'),'Nuevo mensaje', 'class="btn btn-primary"'); ?>
                    </div>
                    <div class="col-md-3 text-center"></div>
                    <!--<div class="col-md-1 text-right"></div>-->
                    <div class="col-md-5 text-right">
                        <form action="<?php echo site_url('mensajes/index'); ?>" class="form-inline" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                <span class="input-group-btn">
                                    <?php 
                                        if ($q <> '')
                                        {
                                            ?>
                                            <a href="<?php echo site_url('mensajes'); ?>" class="btn btn-default">Limpiar</a>
                                            <?php
                                        }
                                    ?>
                                  <button class="btn btn-primary" type="submit">Buscar <i class="fas fa-search"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                <table class="table table-fixed table-condensed table-hover" style="margin-bottom: 10px">
                    <tr>
                        <th>No</th>
                        <th>Action</th>
                        <th>Asunto</th>
                        <th>Mensaje</th>
                        <th>Fecha registro</th>
                        <th>Fecha visto</th>
                        <th>Destinatario email</th>
                        <th>Estado</th>
                        <th>Masivo</th>
                        <th>Tipo</th>
                    </tr><?php
                    if ($mensajes_data) {
                        foreach ($mensajes_data as $mensajes)
                    {
                        ?>
                        <tr>
                            <td width="80px"><?php echo ++$start ?></td>
                            <td>
                                <div class="btn-group">
                                    <?=anchor(site_url('mensajes/read/'.$mensajes->Id_Men),'Read','class="btn btn-secondary"');?>
                                    <?=anchor(site_url('mensajes/update/'.$mensajes->Id_Men),'update','class="btn btn-secondary"');?>
                                    <?=anchor(site_url('mensajes/delete/'.$mensajes->Id_Men),'Read','class="btn btn-secondary" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');?>
                                    
                                </div>
                            </td>
                            <td><?php echo $mensajes->Asunto_Men ?></td>
                            <td><?php echo $mensajes->Mensaje_Men ?></td>
                            <td><?php echo $mensajes->FechaRegistro_Men ?></td>
                            <td><?php echo $mensajes->FechaVisto_Men ?></td>
                            <td><?php echo $mensajes->DestinatarioEmail_Men ?></td>
                            <td><?php echo $mensajes->Estado_Men ?></td>
                            <td><?php echo $mensajes->Masivo_Men ?></td>
                            <td><?php echo $mensajes->Id_MenTip ?></td>
                        </tr>
                        <?php
                    }
                    } else {
                        echo "<tr><td colspan='10' class='text-center'>No hay mensajes para mostrar</td></tr>";
                    }
                    ?>
                </table>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        Mostrando <?php echo $total_rows ?> registros
                        <!-- <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a> -->
                          <?php // echo anchor(site_url('mensajes/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                          <?php // echo anchor(site_url('mensajes/word'), 'Word', 'class="btn btn-primary"'); ?>
                    </div>
                    <div class="col-md-6 text-right">
                        <?php echo $pagination ?>
                    </div>
                </div>
            </div>
        </div>