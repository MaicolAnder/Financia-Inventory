
<div class="card">
    <form action="<?php echo $action; ?>" method="post">
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Mensajes </h2> -->
        <h5 class="text-left" style="margin-top:0px"><?php echo $page ?> <i class="fas fa-angle-down" style="float: right;"></i></h5>
    </div>
    <div class="text-center" style="margin-top: 0px"  id="message">              
        <?php echo $this->session->userdata('message') <> '' ? '<div class="alert alert-info alert-dismissible fade show" role="alert" style="border-radius: .0rem;"><strong>'.$this->session->userdata('message').'</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' : ''; ?>
    </div>
    <div class="card-body">
        <!-- <h6 class="card-title">Titulo <i class="fas fa-sort-alpha-down"></i></h6> -->
        <!-- <p class="card-text">Best ugg boots on the planet. Free shipping, 24/7 customer service.</p>-->
        <div class="row">
        
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label for="DestinatarioEmail_Men" class="required">Correo electrónico <?php echo form_error('DestinatarioEmail_Men') ?></label>
            <div class="input-group-prepend group-ico">
                <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                <input type="email" class="form-control" name="DestinatarioEmail_Men" id="DestinatarioEmail_Men" placeholder="Correo electrónico destinatario" value="<?php echo $DestinatarioEmail_Men; ?>" required />
            </div>
        </div>
	    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <label for="Asunto_Men">Asunto <?php echo form_error('Asunto_Men') ?></label>
            <input type="text" class="form-control" name="Asunto_Men" id="Asunto_Men" placeholder="Asunto" value="<?php echo $Asunto_Men; ?>" />
        </div>
	    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="Mensaje_Men" class="required">Mensaje <?php echo form_error('Mensaje_Men') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <textarea class="form-control" rows="4" name="Mensaje_Men" id="Mensaje_Men" placeholder="Cuerpo del mensaje" required><?php echo $Mensaje_Men; ?></textarea>
                </div>
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="FechaRegistro_Men">Fecha registro <?php echo form_error('FechaRegistro_Men') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="date" class="form-control" name="FechaRegistro_Men" id="FechaRegistro_Men" placeholder="FechaRegistro Men" value="<?php echo $FechaRegistro_Men; ?>" />
                </div>
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="FechaVisto_Men">Visto <?php echo form_error('FechaVisto_Men') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="date" class="form-control" name="FechaVisto_Men" id="FechaVisto_Men" placeholder="FechaVisto Men" value="<?php echo $FechaVisto_Men; ?>" />
                </div>
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Estado_Men">Estado <?php echo form_error('Estado_Men') ?></label>
                <div class="input-group-prepend group-ico">
                    <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                    <input type="text" class="form-control" name="Estado_Men" id="Estado_Men" placeholder="Estado Men" value="<?php echo $Estado_Men; ?>" />
                </div>
            </div>
	    <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="Masivo_Men">¿Público? <?php echo form_error('Masivo_Men') ?></label>
                <div class="input-group-prepend group-ico">
                    <input type="radio" class="custom-control" name="Masivo_Men" id="Masivo_Men" placeholder="Masivo Men" value="<?php echo $Masivo_Men; ?>" />
                </div>
            </div>
		
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <label for="Id_MenTip"><?=t('Id_MenTip'); ?> <?php echo form_error('Id_MenTip') ?></label>
            <select name="Id_MenTip" id="Id_MenTip" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione</option>
                <?php
                foreach($all_mensaje_tipo as $mensaje_tipo)
                { 
                    $print_value =  $mensaje_tipo->Id_MenTip;
                    $selected = ($mensaje_tipo->Id_MenTip==$Id_MenTip) ? 'selected':'';
                    echo '<option value="'.$mensaje_tipo->Id_MenTip.'"  '.$selected.'> '.$print_value.'</option>';
                } ?>
            </select>
        </div>
	</div>
    </div>

    <div class="card-footer text-right">
        
	    <input type="hidden" name="Id_Men" value="<?php echo $Id_Men; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('mensajes') ?>" class="btn btn-danger">Cancelar</a>
    </div>
	</form>
</div>
<?php // $this->load->view('footer'); ?>    
    