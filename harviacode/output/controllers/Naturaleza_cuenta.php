<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Naturaleza_cuenta extends CI_Controller
{
    var $module = 'Naturaleza_cuenta';
    var $view = 'naturaleza_cuenta';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Naturaleza_cuenta_model');
        $this->load->library('form_validation');        
		$this->load->library('datatables');
    }

    public function index()
    {
        $data['page'] = 'Listar Naturaleza_cuenta';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/naturaleza_cuenta_list';

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
        echo $this->Naturaleza_cuenta_model->json($search_fields, $links);

        // Para llamar otras vistas, metodo siguiente
        // $columns = 'element 1, element 2, element 3';
        // $find_id = 'pk_element';
        // echo $this->Naturaleza_cuenta_model->json($search_fields, $links, 'view or table', $columns, $find_id);
    }

    public function read($id) 
    {
        $row = $this->Naturaleza_cuenta_model->get_by_id($id);
        if ($row) {
            $data = array(
				'Id_NatCue' => $row->Id_NatCue,
				'Nombre_NatCue' => $row->Nombre_NatCue,
		    );
            $data['id_update'] = $id;
            $data['page'] = 'Ver Naturaleza_cuenta';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/naturaleza_cuenta_read';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('naturaleza_cuenta'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('naturaleza_cuenta/create_action'),
		    'Id_NatCue' => set_value('Id_NatCue'),
		    'Nombre_NatCue' => set_value('Nombre_NatCue'),
		);
		   
        $data['page'] = 'Nuevo Naturaleza_cuenta';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/naturaleza_cuenta_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'Id_NatCue' => NULL,
				'Nombre_NatCue' => validar_post('Nombre_NatCue'), 
			);

            $this->Naturaleza_cuenta_model->insert($data);
            $this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('naturaleza_cuenta'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Naturaleza_cuenta_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('naturaleza_cuenta/update_action'),
				'Id_NatCue' => set_value('Id_NatCue', $row->Id_NatCue),
				'Nombre_NatCue' => set_value('Nombre_NatCue', $row->Nombre_NatCue),
			);
		   
            $data['page'] = 'Actualizar Naturaleza_cuenta';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/naturaleza_cuenta_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('naturaleza_cuenta'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_NatCue', TRUE));
        } else {
            $data = array(
				'Nombre_NatCue' => validar_post('Nombre_NatCue'), 
		    );

            $this->Naturaleza_cuenta_model->update($this->input->post('Id_NatCue', TRUE), $data);
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('naturaleza_cuenta'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Naturaleza_cuenta_model->get_by_id($id);

        if ($row) {
            $this->Naturaleza_cuenta_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('naturaleza_cuenta'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('naturaleza_cuenta'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	 // $this->form_validation->set_rules('Nombre_NatCue', 'nombre natcue', 'trim|required');

	$this->form_validation->set_rules('Id_NatCue', 'Id_NatCue', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "Listado de naturaleza_cuenta.xls";
        $judul = "naturaleza_cuenta";
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
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Nombre_NatCue")));

	foreach ($this->Naturaleza_cuenta_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Nombre_NatCue));

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Naturaleza_cuenta.php */
/* Location: ./application/controllers/Naturaleza_cuenta.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-22 23:01:58 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/