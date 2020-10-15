<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categoria_item extends CI_Controller
{
    var $module = 'Categoria_item';
    var $view = 'categoria_item';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Categoria_item_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['page'] = 'Listado de categorias';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/categoria_item_list';

 
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
        echo $this->Categoria_item_model->json($search_fields, $links);

        // Para llamar otras vistas, metodo siguiente
        // $columns = 'element 1, element 2, element 3';
        // $find_id = 'pk_element';
        // echo $this->Categoria_item_model->json($search_fields, $links, 'view or table', $columns, $find_id);
    }

    public function read($id) 
    {
        $row = $this->Categoria_item_model->get_by_id($id);
        if ($row) {
            $data = array(
		'Id_CatIte' => $row->Id_CatIte,
		'Nombre_CatIte' => $row->Nombre_CatIte,
		'FechaRegistro_CatIte' => $row->FechaRegistro_CatIte,
		'Estado_CatIte' => $row->Estado_CatIte,
		'Primary_Usu' => $row->Primary_Usu,
	    );
        $data['id_update'] = $id;
        $data['page'] = 'Detalle Categoria';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/categoria_item_read';
        $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('categoria_item'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('categoria_item/create_action'),
    	    'Id_CatIte' => set_value('Id_CatIte'),
    	    'Nombre_CatIte' => set_value('Nombre_CatIte'),
    	    'FechaRegistro_CatIte' => set_value('FechaRegistro_CatIte', date('Y-m-d H:m:s')),
    	    'Estado_CatIte' => set_value('Estado_CatIte', 'Activo'),
    	    'Primary_Usu' => set_value('Primary_Usu'),
    	);
		   
        $data['page'] = 'Nueva categoría';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/categoria_item_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        	    'Id_CatIte' => NULL,
        		'Nombre_CatIte' => validar_post('Nombre_CatIte'), 
        		'FechaRegistro_CatIte' => date('Y-m-d H:m:s'), 
        		'Estado_CatIte' => validar_post('Estado_CatIte'), 
        		'Primary_Usu' => $this->session->userdata('Primary_Usu') 
    	    );

            $this->Categoria_item_model->insert($data);
            $this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('categoria_item'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Categoria_item_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('categoria_item/update_action'),
        		'Id_CatIte' => set_value('Id_CatIte', $row->Id_CatIte),
        		'Nombre_CatIte' => set_value('Nombre_CatIte', $row->Nombre_CatIte),
        		'FechaRegistro_CatIte' => set_value('FechaRegistro_CatIte', $row->FechaRegistro_CatIte),
        		'Estado_CatIte' => set_value('Estado_CatIte', $row->Estado_CatIte),
        		'Primary_Usu' => set_value('Primary_Usu', $row->Primary_Usu),
        	);
		   
            $data['page'] = 'Actualizar categoría';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/categoria_item_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('categoria_item'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_CatIte', TRUE));
        } else {
            $data = array(
        		'Nombre_CatIte' => validar_post('Nombre_CatIte'), 
        		// 'FechaRegistro_CatIte' => validar_post('FechaRegistro_CatIte'), 
        		'Estado_CatIte' => validar_post('Estado_CatIte'), 
        		// 'Primary_Usu' => validar_post('Primary_Usu'), 
      	    );

            $this->Categoria_item_model->update($this->input->post('Id_CatIte', TRUE), $data);
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('categoria_item'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Categoria_item_model->get_by_id($id);

        if ($row) {
            $this->Categoria_item_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('categoria_item'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('categoria_item'));
        }
    }

    public function _rules() 
    { 
        //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	    $this->form_validation->set_rules('Nombre_CatIte', 'nombre catite', 'trim|required');
	    // $this->form_validation->set_rules('FechaRegistro_CatIte', 'fecharegistro catite', 'trim|required');
	    // $this->form_validation->set_rules('Estado_CatIte', 'estado catite', 'trim|required');
	    // $this->form_validation->set_rules('Primary_Usu', 'primary usu', 'trim|required|numeric');

	   $this->form_validation->set_rules('Id_CatIte', 'Id_CatIte', 'trim');
	   $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "categoria_item.xls";
        $judul = "categoria_item";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nombre CatIte");
	xlsWriteLabel($tablehead, $kolomhead++, "FechaRegistro CatIte");
	xlsWriteLabel($tablehead, $kolomhead++, "Estado CatIte");
	xlsWriteLabel($tablehead, $kolomhead++, "Primary Usu");

	foreach ($this->Categoria_item_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Nombre_CatIte);
	    xlsWriteLabel($tablebody, $kolombody++, $data->FechaRegistro_CatIte);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Estado_CatIte);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Primary_Usu);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Categoria_item.php */
/* Location: ./application/controllers/Categoria_item.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-24 01:25:57 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/