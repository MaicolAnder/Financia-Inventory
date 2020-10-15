<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Impuestos extends CI_Controller
{
    var $module = 'Impuestos';
    var $view = 'impuestos';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Impuestos_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $data['page'] = 'Listado de impuestos';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/impuestos_list';

 
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
        echo $this->Impuestos_model->json($search_fields, $links);

        // Para llamar otras vistas, metodo siguiente
        // $columns = 'element 1, element 2, element 3';
        // $find_id = 'pk_element';
        // echo $this->Impuestos_model->json($search_fields, $links, 'view or table', $columns, $find_id);
    }

    public function read($id) 
    {
        $row = $this->Impuestos_model->get_by_id($id);
        if ($row) {
            $data = array(
        		'Id_Imp' => $row->Id_Imp,
        		'Nombre_Imp' => $row->Nombre_Imp,
        		'Valor_Imp' => $row->Valor_Imp,
        		'Estado_Imp' => $row->Estado_Imp,
        		'FechaRegistro_Imp' => $row->FechaRegistro_Imp,
        		'Primary_Usu' => $row->Primary_Usu,
    	    );
            $data['id_update'] = $id;
            $data['page'] = 'Detalle de impuesto ['.$row->Nombre_Imp.']';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/impuestos_read';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('impuestos'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('impuestos/create_action'),
    	    'Id_Imp' => set_value('Id_Imp'),
    	    'Nombre_Imp' => set_value('Nombre_Imp'),
    	    'Valor_Imp' => set_value('Valor_Imp'),
    	    'Estado_Imp' => set_value('Estado_Imp', 'Activo'),
    	    'FechaRegistro_Imp' => date('Y-m-d H:m:s'),
    	    'Primary_Usu' => set_value('Primary_Usu'),
	    );
		   
        $data['page'] = 'Nuevo impuesto';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/impuestos_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
	            'Id_Imp' => NULL,
        		'Nombre_Imp' => validar_post('Nombre_Imp'), 
        		'Valor_Imp' => validar_post('Valor_Imp'), 
        		'Estado_Imp' => validar_post('Estado_Imp'), 
        		'FechaRegistro_Imp' => date('Y-m-d H:m:s'), 
        		'Primary_Usu' => $this->session->userdata('Primary_Usu'), 
        	);

            $this->Impuestos_model->insert($data);
            $this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('impuestos'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Impuestos_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('impuestos/update_action'),
        		'Id_Imp' => set_value('Id_Imp', $row->Id_Imp),
        		'Nombre_Imp' => set_value('Nombre_Imp', $row->Nombre_Imp),
        		'Valor_Imp' => set_value('Valor_Imp', $row->Valor_Imp),
        		'Estado_Imp' => set_value('Estado_Imp', $row->Estado_Imp),
        		'FechaRegistro_Imp' => set_value('FechaRegistro_Imp', $row->FechaRegistro_Imp),
        		'Primary_Usu' => set_value('Primary_Usu', $row->Primary_Usu),
        	);
		   
            $data['page'] = 'Actualizar impuesto ['.$row->Nombre_Imp.']';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/impuestos_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('impuestos'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Imp', TRUE));
        } else {
            $data = array(
        		'Nombre_Imp' => validar_post('Nombre_Imp'), 
        		'Valor_Imp' => validar_post('Valor_Imp'), 
        		'Estado_Imp' => validar_post('Estado_Imp'), 
        		// 'FechaRegistro_Imp' => validar_post('FechaRegistro_Imp'), 
        		// 'Primary_Usu' => validar_post('Primary_Usu'), 
        	);

            $this->Impuestos_model->update($this->input->post('Id_Imp', TRUE), $data);
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('impuestos'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Impuestos_model->get_by_id($id);

        if ($row) {
            $this->Impuestos_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('impuestos'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('impuestos'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	 // $this->form_validation->set_rules('Nombre_Imp', 'nombre imp', 'trim|required');
	 // $this->form_validation->set_rules('Valor_Imp', 'valor imp', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Estado_Imp', 'estado imp', 'trim|required');
	 // $this->form_validation->set_rules('FechaRegistro_Imp', 'fecharegistro imp', 'trim|required');
	 // $this->form_validation->set_rules('Primary_Usu', 'primary usu', 'trim|required|numeric');

	$this->form_validation->set_rules('Id_Imp', 'Id_Imp', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "impuestos.xls";
        $judul = "impuestos";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nombre Imp");
	xlsWriteLabel($tablehead, $kolomhead++, "Valor Imp");
	xlsWriteLabel($tablehead, $kolomhead++, "Estado Imp");
	xlsWriteLabel($tablehead, $kolomhead++, "FechaRegistro Imp");
	xlsWriteLabel($tablehead, $kolomhead++, "Primary Usu");

	foreach ($this->Impuestos_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Nombre_Imp);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Valor_Imp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Estado_Imp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->FechaRegistro_Imp);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Primary_Usu);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Impuestos.php */
/* Location: ./application/controllers/Impuestos.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-27 03:07:28 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/