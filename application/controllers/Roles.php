<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Roles extends CI_Controller
{
    var $module = 'Roles';
    var $view = 'roles';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Roles_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['page'] = 'Listar Roles';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/roles_list';

 
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
        echo $this->Roles_model->json($search_fields, $links);

        // Para llamar otras vistas, metodo siguiente
        // $columns = 'element 1, element 2, element 3';
        // $find_id = 'pk_element';
        // echo $this->Roles_model->json($search_fields, $links, 'view or table', $columns, $find_id);
    }

    public function read($id) 
    {
        $row = $this->Roles_model->get_by_id($id);
        if ($row) {
            $data = array(
		'Id_Rol' => $row->Id_Rol,
		'Descripcion_Rol' => $row->Descripcion_Rol,
		'Primary_Usu' => $row->Primary_Usu,
	    );
        $data['id_update'] = $id;
        $data['page'] = 'Ver Roles';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/roles_read';
        $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('roles'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('roles/create_action'),
	    'Id_Rol' => set_value('Id_Rol'),
	    'Descripcion_Rol' => set_value('Descripcion_Rol'),
	    'Primary_Usu' => set_value('Primary_Usu'),
	);
		   
        $data['page'] = 'Nuevo Roles';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/roles_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(

	'Id_Rol' => NULL,
		'Descripcion_Rol' => validar_post('Descripcion_Rol'), 
		'Primary_Usu' => validar_post('Primary_Usu'), 
	    );

            $this->Roles_model->insert($data);
            $this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('roles'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Roles_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('roles/update_action'),
		'Id_Rol' => set_value('Id_Rol', $row->Id_Rol),
		'Descripcion_Rol' => set_value('Descripcion_Rol', $row->Descripcion_Rol),
		'Primary_Usu' => set_value('Primary_Usu', $row->Primary_Usu),
	 );
		   
            $data['page'] = 'Actualizar Roles';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/roles_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('roles'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Rol', TRUE));
        } else {
            $data = array(
		'Descripcion_Rol' => validar_post('Descripcion_Rol'), 
		'Primary_Usu' => validar_post('Primary_Usu'), 
	    );

            $this->Roles_model->update($this->input->post('Id_Rol', TRUE), $data);
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('roles'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Roles_model->get_by_id($id);

        if ($row) {
            $this->Roles_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('roles'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('roles'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	 // $this->form_validation->set_rules('Descripcion_Rol', 'descripcion rol', 'trim|required');
	 // $this->form_validation->set_rules('Primary_Usu', 'primary usu', 'trim|required|numeric');

	$this->form_validation->set_rules('Id_Rol', 'Id_Rol', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "roles.xls";
        $judul = "roles";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Descripcion Rol");
	xlsWriteLabel($tablehead, $kolomhead++, "Primary Usu");

	foreach ($this->Roles_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Descripcion_Rol);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Primary_Usu);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Roles.php */
/* Location: ./application/controllers/Roles.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-24 01:19:01 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/