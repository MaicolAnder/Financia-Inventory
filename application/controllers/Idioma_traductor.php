<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Idioma_traductor extends CI_Controller
{
    var $module = 'Idioma_traductor';
    var $view = 'idioma_traductor';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Idioma_traductor_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['page'] = 'Listar Idioma_traductor';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/idioma_traductor_list';
		
            $this->load->model('Idioma_model');
            $data['all_idioma'] = $this->Idioma_model->get_all();

 
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
        echo $this->Idioma_traductor_model->json($search_fields, $links);

        // Para llamar otras vistas, metodo siguiente
        // $columns = 'element 1, element 2, element 3';
        // $find_id = 'pk_element';
        // echo $this->Idioma_traductor_model->json($search_fields, $links, 'view or table', $columns, $find_id);
    }

    public function read($id) 
    {
        $row = $this->Idioma_traductor_model->get_by_id($id);
        if ($row) {
            $data = array(
		'Id_IdiTrad' => $row->Id_IdiTrad,
		'Id_Idi' => $row->Id_Idi,
		'CampoOriginal_IdiTRad' => $row->CampoOriginal_IdiTRad,
		'Traduccion_IdiTrad' => $row->Traduccion_IdiTrad,
	    );
        $data['id_update'] = $id;
        $data['page'] = 'Ver Idioma_traductor';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/idioma_traductor_read';
        $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('idioma_traductor'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('idioma_traductor/create_action'),
	    'Id_IdiTrad' => set_value('Id_IdiTrad'),
	    'Id_Idi' => set_value('Id_Idi'),
	    'CampoOriginal_IdiTRad' => set_value('CampoOriginal_IdiTRad'),
	    'Traduccion_IdiTrad' => set_value('Traduccion_IdiTrad'),
	);
		
                $this->load->model('Idioma_model');
                $data['all_idioma'] = $this->Idioma_model->get_all();
		   
        $data['page'] = 'Nuevo Idioma_traductor';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/idioma_traductor_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(

	'Id_IdiTrad' => NULL,
		'Id_Idi' => validar_post('Id_Idi'), 
		'CampoOriginal_IdiTRad' => validar_post('CampoOriginal_IdiTRad'), 
		'Traduccion_IdiTrad' => validar_post('Traduccion_IdiTrad'), 
	    );

            $this->Idioma_traductor_model->insert($data);
            $this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('idioma_traductor'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Idioma_traductor_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('idioma_traductor/update_action'),
		'Id_IdiTrad' => set_value('Id_IdiTrad', $row->Id_IdiTrad),
		'Id_Idi' => set_value('Id_Idi', $row->Id_Idi),
		'CampoOriginal_IdiTRad' => set_value('CampoOriginal_IdiTRad', $row->CampoOriginal_IdiTRad),
		'Traduccion_IdiTrad' => set_value('Traduccion_IdiTrad', $row->Traduccion_IdiTrad),
	 );
		
                $this->load->model('Idioma_model');
                $data['all_idioma'] = $this->Idioma_model->get_all();
		   
            $data['page'] = 'Actualizar Idioma_traductor';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/idioma_traductor_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('idioma_traductor'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_IdiTrad', TRUE));
        } else {
            $data = array(
		'Id_Idi' => validar_post('Id_Idi'), 
		'CampoOriginal_IdiTRad' => validar_post('CampoOriginal_IdiTRad'), 
		'Traduccion_IdiTrad' => validar_post('Traduccion_IdiTrad'), 
	    );

            $this->Idioma_traductor_model->update($this->input->post('Id_IdiTrad', TRUE), $data);
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('idioma_traductor'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Idioma_traductor_model->get_by_id($id);

        if ($row) {
            $this->Idioma_traductor_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('idioma_traductor'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('idioma_traductor'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	 // $this->form_validation->set_rules('Id_Idi', 'id idi', 'trim|required|numeric');
	 // $this->form_validation->set_rules('CampoOriginal_IdiTRad', 'campooriginal iditrad', 'trim|required');
	 // $this->form_validation->set_rules('Traduccion_IdiTrad', 'traduccion iditrad', 'trim|required');

	$this->form_validation->set_rules('Id_IdiTrad', 'Id_IdiTrad', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "idioma_traductor.xls";
        $judul = "idioma_traductor";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Idi");
	xlsWriteLabel($tablehead, $kolomhead++, "CampoOriginal IdiTRad");
	xlsWriteLabel($tablehead, $kolomhead++, "Traduccion IdiTrad");

	foreach ($this->Idioma_traductor_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_Idi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->CampoOriginal_IdiTRad);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Traduccion_IdiTrad);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Idioma_traductor.php */
/* Location: ./application/controllers/Idioma_traductor.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-24 01:26:05 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/