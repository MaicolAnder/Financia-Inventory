<?php 
// echo site_url('".$c_url."')

$string = "
<div class=\"card\">
    <!-- <form> -->
    <div class=\"card-header\">
        <!-- <h2 style=\"margin-top:0px\">".ucfirst($table_name)." Read</h2> -->
        <h5 class=\"text-left\" style=\"margin-top:0px\"><?php echo \$page ?> <i class=\"fas fa-angle-down\" style=\"float: right;\"></i></h5>
    </div>
    <div class=\"card-body\">
        <!-- <h6 class=\"card-title\">Titulo <i class=\"fas fa-sort-alpha-down\"></i></h6> -->
        <!-- <p class=\"card-text\">Best ugg boots on the planet. Free shipping, 24/7 customer service.</p>-->
        <div class=\"row\">
        ";
            foreach ($non_pk as $row) {
                $string .= '<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <label class="required" for="Id_Con"><?=t(\''.$row["column_name"].'\'); ?> <?php echo form_error(\''.$row["column_name"].'\') ?></label>
                    <div class="input-group-prepend group-ico">
                        <i class="fas fa-sort-alpha-down text-muted inputIco"></i>
                        <input type="text" class="form-control" name="'.$row["column_name"].'" id="'.$row["column_name"].'" placeholder="" value="<?=$'.$row["column_name"].'; ?>" readonly/>
                    </div>
                </div>';
            }
            
            $string .= "\n\t
        </div>
    </div>

    <div class=\"card-footer text-right\">
        <a href=\"<?php echo site_url(\$this->view) ?>\" class=\"btn btn-danger\">Cancelar </a>
        <a href=\"<?php echo site_url(\$this->view.'/update/'.\$id_update) ?>\" class=\"btn btn-info\">Actualizar</a>
    </div>
    <!--</form>-->
</div>
<?php \$this->load->view('footer'); ?>";



$hasil_view_read = createFile($string, $target."views/" . $c_url . "/" . $v_read_file);

?>