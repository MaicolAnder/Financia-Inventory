<?php 

$string = "
<div class=\"card\">
    <form action=\"<?php echo \$action; ?>\" method=\"post\">
    <div class=\"card-header\">
        <!-- <h2 style=\"margin-top:0px\">".ucfirst($table_name)." </h2> -->
        <h5 class=\"text-left\" style=\"margin-top:0px\"><?php echo \$page ?> <i class=\"fas fa-angle-down\" style=\"float: right;\"></i></h5>
    </div>
    <div class=\"text-center\" style=\"margin-top: 0px\"  id=\"message\">              
        <?php echo \$this->session->userdata('message') <> '' ? '<div class=\"alert alert-info alert-dismissible fade show\" role=\"alert\" style=\"border-radius: .0rem;\"><strong>'.\$this->session->userdata('message').'</strong> <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>' : ''; ?>
    </div>
    <div class=\"card-body\">
        <!-- <h6 class=\"card-title\">Titulo <i class=\"fas fa-sort-alpha-down\"></i></h6> -->
        <!-- <p class=\"card-text\">Best ugg boots on the planet. Free shipping, 24/7 customer service.</p>-->
        <div class=\"row\">
        ";

foreach ($non_pk as $row) {
    if ($row["data_type"] == 'text') {
    $string .= "\n\t\t\t<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-lg-12\">
                <label for=\"".$row["column_name"]."\"><?=t('".($row["column_name"])."'); ?> <?php echo form_error('".$row["column_name"]."') ?></label>
                <textarea class=\"form-control\" rows=\"3\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\"><?php echo $".$row["column_name"]."; ?></textarea>
            </div>";
    } else {
    
        if (($row['column_key']=='MUL') && (!preg_match('/^Id_/', $row['column_name']) ) ) {
            $string .= "\n\t\t\t<div class=\"form-group col-xs-12 col-sm-6 col-md-3 col-lg-3\">
                <label for=\"".$row["column_name"]."\"><?=t('".($row["column_name"])."'); ?> <?php echo form_error('".$row["column_name"]."') ?></label>
                <div class=\"input-group-prepend group-ico\">
                    <i class=\"fas fa-sort-alpha-down text-muted inputIco\"></i>
                    <input type=\"text\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\" value=\"<?php echo $".$row["column_name"]."; ?>\" />
                </div>
            </div>";
        }
        if ($row['column_key'] !='MUL') {
            $string .= "\n\t\t\t<div class=\"form-group col-xs-12 col-sm-6 col-md-3 col-lg-3\">
                <label for=\"".$row["column_name"]."\"><?=t('".($row["column_name"])."'); ?> <?php echo form_error('".$row["column_name"]."') ?></label>
                <div class=\"input-group-prepend group-ico\">
                    <i class=\"fas fa-sort-alpha-down text-muted inputIco\"></i>
                    <input type=\"text\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\" value=\"<?php echo $".$row["column_name"]."; ?>\" />
                </div>
            </div>";
        }
    }
}
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
                        \$selected = (\$".$fk_Table."->".$fk_column."==\$".$row["column_name"].") ? 'selected':'';
                        echo '<option value=\"'.\$$fk_Table->$fk_column.'\"  '.\$selected.'> '.\$print_value.'</option>';
                    } ?>
                </select>
            </div>";
    }
}

echo '';
$string .= "\n\t\t</div>
    </div>

    <div class=\"card-footer text-right\">
        ";
            $string .= "\n\t    <input type=\"hidden\" name=\"".$pk."\" value=\"<?php echo $".$pk."; ?>\" /> ";
            $string .= "\n\t    <button type=\"submit\" class=\"btn btn-primary\"><?php echo \$button ?></button> ";
            $string .= "\n\t    <a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-danger\">Cancelar</a>
    </div>";
$string .= "\n\t</form>
</div>
<?php \$this->load->view('footer'); ?>    
    ";

$hasil_view_form = createFile($string, $target."views/" . $c_url . "/" . $v_form_file);

?>