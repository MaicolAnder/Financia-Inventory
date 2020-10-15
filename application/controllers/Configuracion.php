<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Configuracion extends CI_Controller
{
    var $module = 'Configuracion';
    var $view = 'configuracion';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Configuracion_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['page'] = 'Selecione configuración';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/configuracion_menu';
        
        $this->load->model('Configuracion_tipo_model');
        $data['all_configuracion_tipo'] = $this->Configuracion_tipo_model->get_all();

 
        $this->load->view('layouts/main',$data);
    }
    public function global_varibales()
    {
        $data['page'] = 'Listar Configuracion';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/configuracion_list';
		
        $this->load->model('Configuracion_tipo_model');
        $data['all_configuracion_tipo'] = $this->Configuracion_tipo_model->get_all();

 
        $this->load->view('layouts/main',$data);
    } 
    
    public function json() {
        // para la busqueda por filtros select y input
        $dataForm = json_decode($this->input->post('filter_dataForm',TRUE));
        $search_fields = array();
        foreach ($dataForm as $value) {
            if ($value->value!='') {
                $find['value'] = $value->value;
                $find['field'] = $value->name;
                array_push($search_fields, $find);
            }
        }

        // Crear botones y links en la tablas
        $links = array(
            array(
                'name_link'=>'Otro boton',
                'site_url'=>'control/metodo/$1',
                'link_txt'=>'<i class="fas fa-plus-circle"></i>',
                'atributos'=>array(
                    'title'=>'Boton siguiente',
                    'class'=>'btn btn-warning'
                )
            ),
            array(
                'name_link'=>'ver',
                'site_url'=>$this->view.'/read/$1',
                'link_txt'=>'<i class="fas fa-eye"></i>',
                'atributos'=>array(
                    'title'=>'Ver registro',
                    'class'=>'btn btn-info'
                )
            ),
            array(
                'name_link'=>'actualizar',
                'site_url'=>$this->view.'/update/$1',
                'link_txt'=>'<i class="fas fa-pencil-alt"></i>',
                'atributos'=>array(
                    'title'=>'Actualizar',
                    'class'=>'btn btn-primary2'
                )
            ),
            array(
                'name_link'=>'eliminar',
                'site_url'=>$this->view.'/delete/$1',
                'link_txt'=>'<i class="fas fa-trash-alt"></i>',
                'atributos'=>array(
                    'title'=>'Eliminar',
                    'class'=>'btn btn-danger',
                    'onclick'=>'javasciprt: return confirm(\'¿Esta seguro?\')'
                )
            )
        );

        // Llamar vista de tabla por defecto
        header('Content-Type: application/json');
        echo $this->Configuracion_model->json($search_fields, $links);

        // Para llamar otras vistas, metodo siguiente
        // $columns = 'element 1, element 2, element 3';
        // $find_id = 'pk_element';
        // echo $this->Configuracion_model->json($search_fields, $links, 'view or table', $columns, $find_id);
    }

    public function read($id) 
    {
        $row = $this->Configuracion_model->get_by_id($id);
        if ($row) {
            $data = array(
		'Id_Conf' => $row->Id_Conf,
		'key_Conf' => $row->key_Conf,
		'Value_Conf' => $row->Value_Conf,
		'Descripcion_Conf' => $row->Descripcion_Conf,
		'Id_ConfTip' => $row->Id_ConfTip,
	    );
        $data['id_update'] = $id;
        $data['page'] = 'Ver Configuracion';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/configuracion_read';
        $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('configuracion'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('configuracion/create_action'),
	    'Id_Conf' => set_value('Id_Conf'),
	    'key_Conf' => set_value('key_Conf'),
	    'Value_Conf' => set_value('Value_Conf'),
	    'Descripcion_Conf' => set_value('Descripcion_Conf'),
	    'Id_ConfTip' => set_value('Id_ConfTip'),
	);
		
                $this->load->model('Configuracion_tipo_model');
                $data['all_configuracion_tipo'] = $this->Configuracion_tipo_model->get_all();
		   
        $data['page'] = 'Nuevo Configuracion';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/configuracion_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(

	'Id_Conf' => NULL,
		'key_Conf' => validar_post('key_Conf'), 
		'Value_Conf' => validar_post('Value_Conf'), 
		'Descripcion_Conf' => validar_post('Descripcion_Conf'), 
		'Id_ConfTip' => validar_post('Id_ConfTip'), 
	    );

            $this->Configuracion_model->insert($data);
            $this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('configuracion'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Configuracion_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('configuracion/update_action'),
		'Id_Conf' => set_value('Id_Conf', $row->Id_Conf),
		'key_Conf' => set_value('key_Conf', $row->key_Conf),
		'Value_Conf' => set_value('Value_Conf', $row->Value_Conf),
		'Descripcion_Conf' => set_value('Descripcion_Conf', $row->Descripcion_Conf),
		'Id_ConfTip' => set_value('Id_ConfTip', $row->Id_ConfTip),
	 );
		
                $this->load->model('Configuracion_tipo_model');
                $data['all_configuracion_tipo'] = $this->Configuracion_tipo_model->get_all();
		   
            $data['page'] = 'Actualizar Configuracion';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/configuracion_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('configuracion'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Conf', TRUE));
        } else {
            $data = array(
		'key_Conf' => validar_post('key_Conf'), 
		'Value_Conf' => validar_post('Value_Conf'), 
		'Descripcion_Conf' => validar_post('Descripcion_Conf'), 
		'Id_ConfTip' => validar_post('Id_ConfTip'), 
	    );

            $this->Configuracion_model->update($this->input->post('Id_Conf', TRUE), $data);
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('configuracion'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Configuracion_model->get_by_id($id);

        if ($row) {
            $this->Configuracion_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('configuracion'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('configuracion'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	 // $this->form_validation->set_rules('key_Conf', 'key conf', 'trim|required');
	 // $this->form_validation->set_rules('Value_Conf', 'value conf', 'trim|required');
	 // $this->form_validation->set_rules('Descripcion_Conf', 'descripcion conf', 'trim|required');
	 // $this->form_validation->set_rules('Id_ConfTip', 'id conftip', 'trim|required|numeric');

	$this->form_validation->set_rules('Id_Conf', 'Id_Conf', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "configuracion.xls";
        $judul = "configuracion";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Key Conf");
	xlsWriteLabel($tablehead, $kolomhead++, "Value Conf");
	xlsWriteLabel($tablehead, $kolomhead++, "Descripcion Conf");
	xlsWriteLabel($tablehead, $kolomhead++, "Id ConfTip");

	foreach ($this->Configuracion_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->key_Conf);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Value_Conf);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Descripcion_Conf);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_ConfTip);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=configuracion.doc");

        $data = array(
            'configuracion_data' => $this->Configuracion_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('configuracion/configuracion_doc',$data);
    }

}

/* End of file Configuracion.php */
/* Location: ./application/controllers/Configuracion.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-10-18 05:12:44 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/