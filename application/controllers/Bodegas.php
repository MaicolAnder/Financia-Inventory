<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bodegas extends CI_Controller
{
    var $module = 'Bodegas';
    var $view = 'bodegas';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Bodegas_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $data['page'] = 'Listado de bodegas';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/bodegas_list';
		
            $this->load->model('Bodega_estado_model');
            $data['all_bodega_estado'] = $this->Bodega_estado_model->get_all();
		
            $this->load->model('Bodega_tipo_model');
            $data['all_bodega_tipo'] = $this->Bodega_tipo_model->get_all();
		
            $this->load->model('Usuario_model');
            $data['all_usuario'] = $this->Usuario_model->get_all();

 
        $this->load->view('layouts/main',$data);
    } 
    
    public function json() {
        // para la busqueda por filtros select y input
        $dataForm = json_decode($this->input->post('filter_dataForm',TRUE));
        $search_fields = array();
        foreach ($dataForm as $value) {
            if ($value->value!='') {
                $find['value'] = $value->value;
                $find['field'] = "bodegas.".$value->name;
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
        $joins = array(
            array('bodega_estado', 'bodegas.Id_BodEst = bodega_estado.Id_BodEst', 'LEFT'),
            array('bodega_tipo', 'bodegas.Id_BodTip = bodega_tipo.Id_BodTip', 'LEFT'),
            array('usuario', 'bodegas.Id_Usu = usuario.Id_Usu', 'LEFT')
        );
        // Llamar vista de tabla por defecto
        header('Content-Type: application/json');
        // echo $this->Bodegas_model->json($search_fields, $links);

        // Para llamar otras vistas, metodo siguiente
        $columns = 'bodegas.Id_Bod, bodegas.Nombre_Bod, bodegas.Codigo_Bod, bodegas.Direccion_Bod, bodegas.Descripcion_Bod, bodegas.FechaRegistro_Bod, bodegas.FechaCreacion_Bod, bodegas.Id_BodTip, bodegas.Id_BodEst, bodegas.Id_Usu, bodegas.Primary_Usu, usuario.Usuario_Usu, bodega_estado.Nombre_BodEst, bodega_tipo.Nombre_BodTip ';
        $find_id = 'Id_Bod';
        echo $this->Bodegas_model->json($search_fields, $links, 'bodegas', $columns, $find_id, $joins);
    }

    public function read($id) 
    {
        $row = $this->Bodegas_model->get_by_id($id);
        if ($row) {
            $data = array(
        		'Id_Bod' => $row->Id_Bod,
        		'Nombre_Bod' => $row->Nombre_Bod,
        		'Codigo_Bod' => $row->Codigo_Bod,
        		'Direccion_Bod' => $row->Direccion_Bod,
        		'Descripcion_Bod' => $row->Descripcion_Bod,
        		'FechaRegistro_Bod' => $row->FechaRegistro_Bod,
        		'FechaCreacion_Bod' => $row->FechaCreacion_Bod,
        		'Id_BodTip' => $row->Id_BodTip,
        		'Id_BodEst' => $row->Id_BodEst,
        		'Id_Usu' => $row->Id_Usu,
        		'Primary_Usu' => $row->Primary_Usu,
            );

            $data['id_update'] = $id;
            $data['page'] = 'Detalle de '.$row->Nombre_Bod;
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/bodegas_read';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('bodegas'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Guardar',
            'action' => site_url('bodegas/create_action'),
    	    'Id_Bod' => set_value('Id_Bod'),
    	    'Nombre_Bod' => set_value('Nombre_Bod'),
    	    'Codigo_Bod' => set_value('Codigo_Bod'),
    	    'Direccion_Bod' => set_value('Direccion_Bod'),
    	    'Descripcion_Bod' => set_value('Descripcion_Bod'),
    	    'FechaRegistro_Bod' => set_value('FechaRegistro_Bod'),
    	    'FechaCreacion_Bod' => set_value('FechaCreacion_Bod'),
    	    'Id_BodTip' => set_value('Id_BodTip'),
    	    'Id_BodEst' => set_value('Id_BodEst', 1),
    	    'Id_Usu' => set_value('Id_Usu', $this->session->userdata('Id_Usu')),
    	    'Primary_Usu' => set_value('Primary_Usu'),
    	);
		
                $this->load->model('Bodega_estado_model');
                $data['all_bodega_estado'] = $this->Bodega_estado_model->get_all();
		
                $this->load->model('Bodega_tipo_model');
                $data['all_bodega_tipo'] = $this->Bodega_tipo_model->get_all();
		
                $this->load->model('Usuario_model');
                $data['all_usuario'] = $this->Usuario_model->get_all();
		   
        $data['page'] = 'Nuevo bodega';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/bodegas_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        	    'Id_Bod' => NULL,
        		'Nombre_Bod' => validar_post('Nombre_Bod'), 
        		'Codigo_Bod' => validar_post('Codigo_Bod'), 
        		'Direccion_Bod' => validar_post('Direccion_Bod'), 
        		'Descripcion_Bod' => validar_post('Descripcion_Bod'), 
        		'FechaRegistro_Bod' => date('Y-m-d H:m:s'), 
        		'FechaCreacion_Bod' => validar_post('FechaCreacion_Bod'), 
        		'Id_BodTip' => validar_post('Id_BodTip'), 
        		'Id_BodEst' => validar_post('Id_BodEst'), 
        		'Id_Usu' => $this->session->userdata('Id_Usu'), 
        		'Primary_Usu' => $this->session->userdata('Primary_Usu')  
	        );

            $this->Bodegas_model->insert($data);
            $this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('bodegas'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Bodegas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Actualizar',
                'action' => site_url('bodegas/update_action'),
        		'Id_Bod' => set_value('Id_Bod', $row->Id_Bod),
        		'Nombre_Bod' => set_value('Nombre_Bod', $row->Nombre_Bod),
        		'Codigo_Bod' => set_value('Codigo_Bod', $row->Codigo_Bod),
        		'Direccion_Bod' => set_value('Direccion_Bod', $row->Direccion_Bod),
        		'Descripcion_Bod' => set_value('Descripcion_Bod', $row->Descripcion_Bod),
        		'FechaRegistro_Bod' => set_value('FechaRegistro_Bod', $row->FechaRegistro_Bod),
        		'FechaCreacion_Bod' => set_value('FechaCreacion_Bod', $row->FechaCreacion_Bod),
        		'Id_BodTip' => set_value('Id_BodTip', $row->Id_BodTip),
        		'Id_BodEst' => set_value('Id_BodEst', $row->Id_BodEst),
        		'Id_Usu' => set_value('Id_Usu', $row->Id_Usu),
        		'Primary_Usu' => set_value('Primary_Usu', $row->Primary_Usu),
        	);
		
                $this->load->model('Bodega_estado_model');
                $data['all_bodega_estado'] = $this->Bodega_estado_model->get_all();
		
                $this->load->model('Bodega_tipo_model');
                $data['all_bodega_tipo'] = $this->Bodega_tipo_model->get_all();
		
                $this->load->model('Usuario_model');
                $data['all_usuario'] = $this->Usuario_model->get_all();
		   
            $data['page'] = 'Actualizar '.$row->Nombre_Bod;
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/bodegas_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('bodegas'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Bod', TRUE));
        } else {
            $data = array(
        		'Nombre_Bod' => validar_post('Nombre_Bod'), 
        		'Codigo_Bod' => validar_post('Codigo_Bod'), 
        		'Direccion_Bod' => validar_post('Direccion_Bod'), 
        		'Descripcion_Bod' => validar_post('Descripcion_Bod'), 
        		// 'FechaRegistro_Bod' => validar_post('FechaRegistro_Bod'), 
        		'FechaCreacion_Bod' => validar_post('FechaCreacion_Bod'), 
        		'Id_BodTip' => validar_post('Id_BodTip'), 
        		'Id_BodEst' => validar_post('Id_BodEst'), 
        		'Id_Usu' => validar_post('Id_Usu'), 
        		// 'Primary_Usu' => validar_post('Primary_Usu'), 
        	);

            $this->Bodegas_model->update($this->input->post('Id_Bod', TRUE), $data);
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('bodegas'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Bodegas_model->get_by_id($id);

        if ($row) {
            $this->Bodegas_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('bodegas'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('bodegas'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	 $this->form_validation->set_rules('Nombre_Bod', 'nombre bod', 'trim|required');
	 // $this->form_validation->set_rules('Codigo_Bod', 'codigo bod', 'trim|required');
	 // $this->form_validation->set_rules('Direccion_Bod', 'direccion bod', 'trim|required');
	 // $this->form_validation->set_rules('Descripcion_Bod', 'descripcion bod', 'trim|required');
	 // $this->form_validation->set_rules('FechaRegistro_Bod', 'fecharegistro bod', 'trim|required');
	 // $this->form_validation->set_rules('FechaCreacion_Bod', 'fechacreacion bod', 'trim|required');
	 // $this->form_validation->set_rules('Id_BodTip', 'id bodtip', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_BodEst', 'id bodest', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Usu', 'id usu', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Primary_Usu', 'primary usu', 'trim|required|numeric');

	$this->form_validation->set_rules('Id_Bod', 'Id_Bod', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "bodegas.xls";
        $judul = "bodegas";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nombre Bod");
	xlsWriteLabel($tablehead, $kolomhead++, "Codigo Bod");
	xlsWriteLabel($tablehead, $kolomhead++, "Direccion Bod");
	xlsWriteLabel($tablehead, $kolomhead++, "Descripcion Bod");
	xlsWriteLabel($tablehead, $kolomhead++, "FechaRegistro Bod");
	xlsWriteLabel($tablehead, $kolomhead++, "FechaCreacion Bod");
	xlsWriteLabel($tablehead, $kolomhead++, "Id BodTip");
	xlsWriteLabel($tablehead, $kolomhead++, "Id BodEst");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Usu");
	xlsWriteLabel($tablehead, $kolomhead++, "Primary Usu");

	foreach ($this->Bodegas_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Nombre_Bod);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Codigo_Bod);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Direccion_Bod);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Descripcion_Bod);
	    xlsWriteLabel($tablebody, $kolombody++, $data->FechaRegistro_Bod);
	    xlsWriteLabel($tablebody, $kolombody++, $data->FechaCreacion_Bod);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_BodTip);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_BodEst);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_Usu);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Primary_Usu);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Bodegas.php */
/* Location: ./application/controllers/Bodegas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-24 01:25:55 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/