
<div class="card">
    <!-- <form> -->
    <div class="card-header">
        <!-- <h2 style="margin-top:0px">Idioma_traductor Read</h2> -->
        <h5 class="text-left" style="margin-top:0px"><?php echo $page ?> <i class="fas fa-angle-down" style="float: right;"></i></h5>
    </div>
    <div class="card-body">
        <!-- <h6 class="card-title">Titulo <i class="fas fa-sort-alpha-down"></i></h6> -->
        <!-- <p class="card-text">Best ugg boots on the planet. Free shipping, 24/7 customer service.</p>-->
        <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Id_Idi'); ?> <?php echo form_error('Id_Idi') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Id_Idi" id="Id_Idi" placeholder="" value="<?=$Id_Idi; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('CampoOriginal_IdiTRad'); ?> <?php echo form_error('CampoOriginal_IdiTRad') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="CampoOriginal_IdiTRad" id="CampoOriginal_IdiTRad" placeholder="" value="<?=$CampoOriginal_IdiTRad; ?>" readonly/>
                    </div>
                </div><div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t('Traduccion_IdiTrad'); ?> <?php echo form_error('Traduccion_IdiTrad') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="Traduccion_IdiTrad" id="Traduccion_IdiTrad" placeholder="" value="<?=$Traduccion_IdiTrad; ?>" readonly/>
                    </div>
                </div>
	
        </div>
    </div>

    <div class="card-footer text-right">
        <a href="<?php echo site_url($this->view) ?>" class="btn btn-danger">Cancelar </a>
        <a href="<?php echo site_url($this->view.'/update/'.$id_update) ?>" class="btn btn-info">Actualizar</a>
    </div>
    <!--</form>-->
</div>
<?php $this->load->view('footer'); ?>