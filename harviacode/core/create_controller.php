<?php

$string = "<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class " . $c . " extends CI_Controller
{
    var \$module = '".$c."';
    var \$view = '".$c_url."';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        \$this->load->model('$m');
        \$this->load->library('form_validation');";

if ($jenis_tabel <> 'reguler_table') {
    $string .= "        \n\t\t\$this->load->library('datatables');";
}
        
$string .= "
    }";

if ($jenis_tabel == 'reguler_table') {
    
$string .= "\n\n    public function index()
    {
        \$q = urldecode(\$this->input->get('q', TRUE));
        \$start = intval(\$this->input->get('start'));
        
        if (\$q <> '') {
            \$config['base_url'] = base_url() . '$c_url/index.html?q=' . urlencode(\$q);
            \$config['first_url'] = base_url() . '$c_url/index.html?q=' . urlencode(\$q);
        } else {
            \$config['base_url'] = base_url() . '$c_url/index.html';
            \$config['first_url'] = base_url() . '$c_url/index.html';
        }

        \$config['per_page'] = 10;
        \$config['page_query_string'] = TRUE;
        \$config['total_rows'] = \$this->" . $m . "->total_rows(\$q);
        \$$c_url = \$this->" . $m . "->get_limit_data(\$config['per_page'], \$start, \$q);

        \$this->load->library('pagination');
        \$this->pagination->initialize(\$config);

        \$data = array(
            '" . $c_url . "_data' => \$$c_url,
            'q' => \$q,
            'pagination' => \$this->pagination->create_links(),
            'total_rows' => \$config['total_rows'],
            'start' => \$start,
        );
        \$data['page'] = 'Listar $c';
        \$data['module']= \$this->module;
        \$data['_view'] = \$this->view.'/$v_list';
        \$this->load->view('layouts/main',$"."data);
    }";

} else {
    
$string .="\n\n    public function index()
    {
        \$data['page'] = 'Listar $c';
        \$data['module']= \$this->module;
        \$data['_view'] = \$this->view.'/$v_list';";

if (count($fk_fiels)>0) {
    foreach ($fk_fiels as $key) {
        $fk_Table = $key['fk_Table'];
        $fk_model_table = ucwords($key['fk_Table']);
        $string.="\n\t
        \$this->load->model('$fk_model_table"."_model');
        \$data['all_$fk_Table'] = \$this->$fk_model_table"."_model->get_all();";
    }
}
        $string .="\n
        \$this->load->view('layouts/main',$"."data);
    } 
    
    public function json() {
        // para la busqueda por filtros select y input
        \$dataForm = json_decode(\$this->input->post('filter_dataForm',TRUE));
        \$search_fields = array();
        foreach (\$dataForm as \$value) {
            if (\$value->value!='') {
                \$find['value'] = \$value->value;
                \$find['field'] = \$value->name;
                array_push(\$search_fields, \$find);
            }
        }

        // Crear botones y links en la tablas
        \$links = array(
            array(
                'name_link'=>'Otro boton',
                'site_url'=>'control/metodo/$1',
                'link_txt'=>'<i class=\"fas fa-plus-circle\"></i>',
                'atributos'=>array(
                    'title'=>'Boton siguiente',
                    'class'=>'btn btn-warning'
                )
            ),
            array(
                'name_link'=>'ver',
                'site_url'=>\$this->view.'/read/$1',
                'link_txt'=>'<i class=\"fas fa-eye\"></i>',
                'atributos'=>array(
                    'title'=>'Ver registro',
                    'class'=>'btn btn-info'
                )
            ),
            array(
                'name_link'=>'actualizar',
                'site_url'=>\$this->view.'/update/$1',
                'link_txt'=>'<i class=\"fas fa-pencil-alt\"></i>',
                'atributos'=>array(
                    'title'=>'Actualizar',
                    'class'=>'btn btn-primary2'
                )
            ),
            array(
                'name_link'=>'eliminar',
                'site_url'=>\$this->view.'/delete/$1',
                'link_txt'=>'<i class=\"fas fa-trash-alt\"></i>',
                'atributos'=>array(
                    'title'=>'Eliminar',
                    'class'=>'btn btn-danger',
                    'onclick'=>'javasciprt: return confirm(\'¿Esta seguro?\')'
                )
            )
        );

        // Llamar vista de tabla por defecto
        header('Content-Type: application/json');
        echo \$this->" . $m . "->json(\$search_fields, \$links);

        // Para llamar otras vistas, metodo siguiente
        // \$columns = 'element 1, element 2, element 3';
        // \$find_id = 'pk_element';
        // echo \$this->".$m."->json(\$search_fields, \$links, 'view or table', \$columns, \$find_id);
    }";

}
    
$string .= "\n\n    public function read(\$id) 
    {
        \$row = \$this->" . $m . "->get_by_id(\$id);
        if (\$row) {
            \$data = array(";
foreach ($all as $row) {
    $string .= "\n\t\t\t\t'" . $row['column_name'] . "' => \$row->" . $row['column_name'] . ",";
}
$string .= "\n\t\t    );
            \$data['id_update'] = \$id;
            \$data['page'] = 'Ver $c';
            \$data['module']= \$this->module;
            \$data['_view'] = \$this->view.'/$v_read';
            \$this->load->view('layouts/main',$"."data);
        } else {
            \$this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('$c_url'));
        }
    }

    public function create() 
    {
        \$data = array(
            'button' => 'Create',
            'action' => site_url('$c_url/create_action'),";
            foreach ($all as $row) {
                $string .= "\n\t\t    '" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "'),";
                
            }
            $string .= "\n\t\t);";
if (count($fk_fiels)>0) {
    foreach ($fk_fiels as $key) {
    	$fk_Table = $key['fk_Table'];
    	$fk_model_table = ucwords($key['fk_Table']);
        $string.="\n\t
        \$this->load->model('$fk_model_table"."_model');
        \$data['all_$fk_Table'] = \$this->$fk_model_table"."_model->get_all();";
    }
}
        $string .="\n\t\t   
        \$data['page'] = 'Nuevo $c';
        \$data['module']= \$this->module;
        \$data['_view'] = \$this->view.'/$v_form';
        \$this->load->view('layouts/main',$"."data);
    }
    
    public function create_action() 
    {
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->create();
        } else {
            \$data = array(";
                $string .= "\n\t\t\t\t'".$all[0]['column_name']."' => NULL,";
            
            foreach ($non_pk as $row) {
                //$string .= "\n\t\t'".$row['column_name']."' => \$this->input->post('".$row['column_name']."',TRUE),";
                // $string .= "\n\t\t'".$row['column_name']."' => (\$this->input->post('".$row['column_name']."',TRUE) !='') ? \$this->input->post('".$row['column_name']."',TRUE) : NULL ,";
                $string .= "\n\t\t\t\t'".$row['column_name']."' => validar_post('".$row['column_name']."'), ";
            }
            $string .= "\n\t\t\t);

            \$this->".$m."->insert(\$data);
            \$this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('$c_url'));
        }
    }
    
    public function update(\$id) 
    {
        \$row = \$this->".$m."->get_by_id(\$id);

        if (\$row) {
            \$data = array(
                'button' => 'Update',
                'action' => site_url('$c_url/update_action'),";
            foreach ($all as $row) {
                $string .= "\n\t\t\t\t'" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "', \$row->". $row['column_name']."),";
            }
            $string .= "\n\t\t\t);";
    if (count($fk_fiels)>0) {
        foreach ($fk_fiels as $key) {
            $fk_Table = $key['fk_Table'];
            $fk_model_table = ucwords($key['fk_Table']);
            $string.="\n\t
            \$this->load->model('$fk_model_table"."_model');
            \$data['all_$fk_Table'] = \$this->$fk_model_table"."_model->get_all();";
        }
    }
            $string .="\n\t\t   
            \$data['page'] = 'Actualizar $c';
            \$data['module']= \$this->module;
            \$data['_view'] = \$this->view.'/$v_form';
            \$this->load->view('layouts/main',$"."data);
        } else {
            \$this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('$c_url'));
        }
    }
    
    public function update_action() 
    {
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->update(\$this->input->post('$pk', TRUE));
        } else {
            \$data = array(";
            foreach ($non_pk as $row) {
                // $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
                // $string .= "\n\t\t'".$row['column_name']."' => (\$this->input->post('".$row['column_name']."',TRUE) !='') ? \$this->input->post('".$row['column_name']."',TRUE) : NULL ,";
                $string .= "\n\t\t\t\t'".$row['column_name']."' => validar_post('".$row['column_name']."'), ";
            }    
            $string .= "\n\t\t    );

            \$this->".$m."->update(\$this->input->post('$pk', TRUE), \$data);
            \$this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('$c_url'));
        }
    }
    
    public function delete(\$id) 
    {
        \$row = \$this->".$m."->get_by_id(\$id);

        if (\$row) {
            \$this->".$m."->delete(\$id);
            \$this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('$c_url'));
        } else {
            \$this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('$c_url'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad";
foreach ($non_pk as $row) {
    $int = $row['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? '|numeric' : '';
    $string .= "\n\t // \$this->form_validation->set_rules('".$row['column_name']."', '".  strtolower(label($row['column_name']))."', 'trim|required$int');";
}    
$string .= "\n\n\t\$this->form_validation->set_rules('$pk', '$pk', 'trim');";
$string .= "\n\t\$this->form_validation->set_error_delimiters('<span class=\"text-danger\">', '</span>');
    }";

if ($export_excel == '1') {
    $string .= "\n\n    public function excel()
    {
        \$this->load->helper('exportexcel');
        \$namaFile = \"Listado de $table_name.xls\";
        \$judul = \"$table_name\";
        \$tablehead = 0;
        \$tablebody = 1;
        \$nourut = 1;
        //penulisan header
        header(\"Pragma: public\");
        header(\"Expires: 0\");
        header(\"Cache-Control: must-revalidate, post-check=0,pre-check=0\");
        header(\"Content-Type: application/force-download\");
        header(\"Content-Type: application/octet-stream\");
        header(\"Content-Type: application/download\");
        header(\"Content-Disposition: attachment;filename=\" . \$namaFile . \"\");
        header(\"Content-Transfer-Encoding: binary \");

        xlsBOF();

        \$kolomhead = 0;
        xlsWriteLabel(\$tablehead, \$kolomhead++, \"No\");";
foreach ($non_pk as $row) {
        // $column_name = label($row['column_name']); // label
        $column_name = $row['column_name'];
        $string .= "\n\t\txlsWriteLabel(\$tablehead, \$kolomhead++, utf8_decode(t(\"$column_name\")));";
}
$string .= "\n\n\tforeach (\$this->" . $m . "->get_all() as \$data) {
            \$kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber(\$tablebody, \$kolombody++, \$nourut);";
foreach ($non_pk as $row) {
        $column_name = $row['column_name'];
        $xlsWrite = $row['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? 'xlsWriteNumber' : 'xlsWriteLabel';
        $string .= "\n\t\t    " . $xlsWrite . "(\$tablebody, \$kolombody++, utf8_decode(\$data->$column_name));";
}
$string .= "\n\n\t    \$tablebody++;
            \$nourut++;
        }

        xlsEOF();
        exit();
    }";
}

if ($export_word == '1') {
    $string .= "\n\n    public function word()
    {
        header(\"Content-type: application/vnd.ms-word\");
        header(\"Content-Disposition: attachment;Filename=$table_name.doc\");

        \$data = array(
            '" . $table_name . "_data' => \$this->" . $m . "->get_all(),
            'start' => 0
        );
        
        \$this->load->view('" . $c_url ."/". $v_doc . "',\$data);
    }";
}

if ($export_pdf == '1') {
    $string .= "\n\n    function pdf()
    {
        \$data = array(
            '" . $table_name . "_data' => \$this->" . $m . "->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        \$html = \$this->load->view('" . $c_url ."/". $v_pdf . "', \$data, true);
        \$this->load->library('pdf');
        \$pdf = \$this->pdf->load();
        \$pdf->WriteHTML(\$html);
        \$pdf->Output('" . $table_name . ".pdf', 'D'); 
    }";
}

$string .= "\n\n}\n\n/* End of file $c_file */
/* Location: ./application/controllers/$c_file */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator ".date('Y-m-d H:i:s')." */
/* http://harviacode.com 
// \$password = \$this->input->post('Contrasena_Usu',TRUE);
// \$hashPassword   = password_hash(\$password,PASSWORD_BCRYPT,array(\"cost\"=>4));
            
*/";




$hasil_controller = createFile($string, $target . "controllers/" . $c_file);

?>