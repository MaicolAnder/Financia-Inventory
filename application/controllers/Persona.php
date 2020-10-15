<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Persona extends CI_Controller
{
    var $module = 'Persona';
    var $view = 'persona';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Persona_model');
        $this->load->model('Departamento_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $data['page'] = 'Listado de contactos';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/persona_list';
		
            $this->load->model('Empresa_model');
            $data['all_empresa'] = $this->Empresa_model->get_all();
		
            $this->load->model('Municipio_model');
            $data['all_municipio'] = $this->Municipio_model->get_all('*',[],['Id_Dep'=>'ASC','Nombre_Num'=>'ASC']);
		
            $this->load->model('Persona_estado_model');
            $data['all_persona_estado'] = $this->Persona_estado_model->get_all();
		
            $this->load->model('Persona_genero_model');
            $data['all_persona_genero'] = $this->Persona_genero_model->get_all();
		
            $this->load->model('Persona_tipo_model');
            $data['all_persona_tipo'] = $this->Persona_tipo_model->get_all();
		
            $this->load->model('Persona_tipo_identificacion_model');
            $data['all_persona_tipo_identificacion'] = $this->Persona_tipo_identificacion_model->get_all();

 
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
        // subarray(table, fk, type)
        $joins = array(
            array(''),
        );
        // Llamar vista de tabla por defecto
        header('Content-Type: application/json');
        // echo $this->Persona_model->json($search_fields, $links);

        // Para llamar otras vistas, metodo siguiente
        $columns = 'Id_Per, Identificacion_Per, Nombre1_Per, Nombre2_Per, Apeliido1_Per, Apellido2_Per, TelCelular_Per, Correo_Per, Nombre_Num, Estado_PerEst, Descripcion_PerTip, Descripcion_PerTipId, Codigo_PerTipId, FechaNacimiento_Per, Nombre_Dep, Descripcion_PerGen, Codigo_PerGen, Id_PerTipId, Id_PerGen, Id_Mun, Id_PerEst, Id_PerTip, Telefono_Per, FechaRegistro_Per, Celular_Per, Direccion_Per, Nombre_Emp';
        $find_id = 'Id_Per';
        echo $this->Persona_model->json($search_fields, $links, 'vw_persona', $columns, $find_id);
    }

    public function read($id) 
    {
        $row = $this->Persona_model->get_foreing_by_id($id);
       //  ver_array($row);
        if ($row) {
            $data = array(
        		'Id_Per' => $row->Id_Per,
        		'Identificacion_Per' => $row->Identificacion_Per,
        		'Nombre1_Per' => $row->Nombre1_Per,
        		'Nombre2_Per' => $row->Nombre2_Per,
        		'Apeliido1_Per' => $row->Apeliido1_Per,
        		'Apellido2_Per' => $row->Apellido2_Per,
        		'Telefono_Per' => $row->Telefono_Per,
        		'TelCelular_Per' => $row->TelCelular_Per,
        		'Correo_Per' => $row->Correo_Per,
        		'Direccion_Per' => $row->Direccion_Per,
        		'FechaNacimiento_Per' => $row->FechaNacimiento_Per,
        		'FechaRegistro_Per' => $row->FechaRegistro_Per,
        		'Celular_Per' => $row->Celular_Per,
        		'Id_PerTipId' => $row->Descripcion_PerTipId,
        		'Id_PerGen' => $row->Descripcion_PerGen,
        		'Id_Mun' => $row->Nombre_Num,
        		'Id_PerEst' => $row->Estado_PerEst,
        		'Id_PerTip' => $row->Descripcion_PerTip,
        		'Id_Emp' => $row->Nombre_Emp,
        		'Primary_Usu' => '',
        	);
            $data['id_update'] = $id;
            $data['page'] = 'Ver contacto';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/persona_read';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('persona'));
        }
    }

    public function create($type = "") 
    {
        switch ($type) {
            case 'cliente':
                $Id_PerTip = 1;
                break;
            case 'proveedor':
                $Id_PerTip = 2;
                break;
            default:
                $Id_PerTip = "";
                break;
        }
        $data = array(
            'button' => 'Guardar',
            'action' => site_url('persona/create_action'),
    	    'Id_Per' => set_value('Id_Per'),
    	    'Identificacion_Per' => set_value('Identificacion_Per'),
    	    'Nombre1_Per' => set_value('Nombre1_Per'),
    	    'Nombre2_Per' => set_value('Nombre2_Per'),
    	    'Apeliido1_Per' => set_value('Apeliido1_Per'),
    	    'Apellido2_Per' => set_value('Apellido2_Per'),
    	    'Telefono_Per' => set_value('Telefono_Per'),
    	    'TelCelular_Per' => set_value('TelCelular_Per'),
    	    'Correo_Per' => set_value('Correo_Per'),
    	    'Direccion_Per' => set_value('Direccion_Per'),
    	    'FechaNacimiento_Per' => set_value('FechaNacimiento_Per'),
    	    'FechaRegistro_Per' => set_value('FechaRegistro_Per', date('Y-m-d H:m:s')),
    	    'Celular_Per' => set_value('Celular_Per'),
    	    'Id_PerTipId' => set_value('Id_PerTipId'),
    	    'Id_PerGen' => set_value('Id_PerGen'),
    	    'Id_Mun' => set_value('Id_Mun'),
    	    'Id_PerEst' => set_value('Id_PerEst', 1),
    	    'Id_PerTip' => set_value('Id_PerTip', $Id_PerTip),
    	    'Id_Emp' => set_value('Id_Emp'),
    	    'Primary_Usu' => $this->session->userdata('Primary_Usu'),
    	);
        		
        $this->load->model('Empresa_model');
        $data['all_empresa'] = $this->Empresa_model->get_all();

        $this->load->model('Municipio_model');
        $data['all_municipio'] = $this->Municipio_model->get_all('*',[],['Id_Dep'=>'ASC','Nombre_Num'=>'ASC']);

        $this->load->model('Persona_estado_model');
        $data['all_persona_estado'] = $this->Persona_estado_model->get_all();

        $this->load->model('Persona_genero_model');
        $data['all_persona_genero'] = $this->Persona_genero_model->get_all();

        $this->load->model('Persona_tipo_model');
        $data['all_persona_tipo'] = $this->Persona_tipo_model->get_all();

        $this->load->model('Persona_tipo_identificacion_model');
        $data['all_persona_tipo_identificacion'] = $this->Persona_tipo_identificacion_model->get_all();
		   
        $data['page'] = 'Nuevo contacto';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/persona_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        	    'Id_Per' => NULL,
        		'Identificacion_Per' => validar_post('Identificacion_Per'), 
        		'Nombre1_Per' => validar_post('Nombre1_Per'), 
        		'Nombre2_Per' => validar_post('Nombre2_Per'), 
        		'Apeliido1_Per' => validar_post('Apeliido1_Per'), 
        		'Apellido2_Per' => validar_post('Apellido2_Per'), 
        		'Telefono_Per' => validar_post('Telefono_Per'), 
        		'TelCelular_Per' => validar_post('TelCelular_Per'), 
        		'Correo_Per' => validar_post('Correo_Per'), 
        		'Direccion_Per' => validar_post('Direccion_Per'), 
        		'FechaNacimiento_Per' => date('Y-m-d H:m:s'), 
        		'FechaRegistro_Per' => validar_post('FechaRegistro_Per'), 
        		'Celular_Per' => validar_post('Celular_Per'), 
        		'Id_PerTipId' => validar_post('Id_PerTipId'), 
        		'Id_PerGen' => validar_post('Id_PerGen'), 
        		'Id_Mun' => validar_post('Id_Mun'), 
        		'Id_PerEst' => validar_post('Id_PerEst'), 
        		'Id_PerTip' => validar_post('Id_PerTip'), 
        		'Id_Emp' => validar_post('Id_Emp'), 
        		'Primary_Usu' => $this->session->userdata('Primary_Usu'), 
        	);

            $this->Persona_model->insert($data);
            $this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('persona'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Persona_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Actualizar',
                'action' => site_url('persona/update_action'),
        		'Id_Per' => set_value('Id_Per', $row->Id_Per),
        		'Identificacion_Per' => set_value('Identificacion_Per', $row->Identificacion_Per),
        		'Nombre1_Per' => set_value('Nombre1_Per', $row->Nombre1_Per),
        		'Nombre2_Per' => set_value('Nombre2_Per', $row->Nombre2_Per),
        		'Apeliido1_Per' => set_value('Apeliido1_Per', $row->Apeliido1_Per),
        		'Apellido2_Per' => set_value('Apellido2_Per', $row->Apellido2_Per),
        		'Telefono_Per' => set_value('Telefono_Per', $row->Telefono_Per),
        		'TelCelular_Per' => set_value('TelCelular_Per', $row->TelCelular_Per),
        		'Correo_Per' => set_value('Correo_Per', $row->Correo_Per),
        		'Direccion_Per' => set_value('Direccion_Per', $row->Direccion_Per),
        		'FechaNacimiento_Per' => set_value('FechaNacimiento_Per', $row->FechaNacimiento_Per),
        		'FechaRegistro_Per' => set_value('FechaRegistro_Per', $row->FechaRegistro_Per),
        		'Celular_Per' => set_value('Celular_Per', $row->Celular_Per),
        		'Id_PerTipId' => set_value('Id_PerTipId', $row->Id_PerTipId),
        		'Id_PerGen' => set_value('Id_PerGen', $row->Id_PerGen),
        		'Id_Mun' => set_value('Id_Mun', $row->Id_Mun),
        		'Id_PerEst' => set_value('Id_PerEst', $row->Id_PerEst),
        		'Id_PerTip' => set_value('Id_PerTip', $row->Id_PerTip),
        		'Id_Emp' => set_value('Id_Emp', $row->Id_Emp),
        		'Primary_Usu' => set_value('Primary_Usu', $row->Primary_Usu),
	        );
		
                $this->load->model('Empresa_model');
                $data['all_empresa'] = $this->Empresa_model->get_all();
		
                $this->load->model('Municipio_model');
                $data['all_municipio'] = $this->Municipio_model->get_all('*',[],['Id_Dep'=>'ASC','Nombre_Num'=>'ASC']);
		
                $this->load->model('Persona_estado_model');
                $data['all_persona_estado'] = $this->Persona_estado_model->get_all();
		
                $this->load->model('Persona_genero_model');
                $data['all_persona_genero'] = $this->Persona_genero_model->get_all();
		
                $this->load->model('Persona_tipo_model');
                $data['all_persona_tipo'] = $this->Persona_tipo_model->get_all();
		
                $this->load->model('Persona_tipo_identificacion_model');
                $data['all_persona_tipo_identificacion'] = $this->Persona_tipo_identificacion_model->get_all();
		   
            $data['page'] = 'Actualizar contacto';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/persona_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('persona'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Per', TRUE));
        } else {
            $data = array(
        		'Identificacion_Per' => validar_post('Identificacion_Per'), 
        		'Nombre1_Per' => validar_post('Nombre1_Per'), 
        		'Nombre2_Per' => validar_post('Nombre2_Per'), 
        		'Apeliido1_Per' => validar_post('Apeliido1_Per'), 
        		'Apellido2_Per' => validar_post('Apellido2_Per'), 
        		'Telefono_Per' => validar_post('Telefono_Per'), 
        		'TelCelular_Per' => validar_post('TelCelular_Per'), 
        		'Correo_Per' => validar_post('Correo_Per'), 
        		'Direccion_Per' => validar_post('Direccion_Per'), 
        		'FechaNacimiento_Per' => validar_post('FechaNacimiento_Per'), 
        		// 'FechaRegistro_Per' => validar_post('FechaRegistro_Per'), 
        		'Celular_Per' => validar_post('Celular_Per'), 
        		'Id_PerTipId' => validar_post('Id_PerTipId'), 
        		'Id_PerGen' => validar_post('Id_PerGen'), 
        		'Id_Mun' => validar_post('Id_Mun'), 
        		'Id_PerEst' => validar_post('Id_PerEst'), 
        		'Id_PerTip' => validar_post('Id_PerTip'), 
        		'Id_Emp' => validar_post('Id_Emp'), 
        		// 'Primary_Usu' => validar_post('Primary_Usu'), 
	       );

            $this->Persona_model->update($this->input->post('Id_Per', TRUE), $data);
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('persona'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Persona_model->get_by_id($id);

        if ($row) {
            $this->Persona_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('persona'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('persona'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	 // $this->form_validation->set_rules('Identificacion_Per', 'identificacion per', 'trim|required');
	 // $this->form_validation->set_rules('Nombre1_Per', 'nombre1 per', 'trim|required');
	 // $this->form_validation->set_rules('Nombre2_Per', 'nombre2 per', 'trim|required');
	 // $this->form_validation->set_rules('Apeliido1_Per', 'apeliido1 per', 'trim|required');
	 // $this->form_validation->set_rules('Apellido2_Per', 'apellido2 per', 'trim|required');
	 // $this->form_validation->set_rules('Telefono_Per', 'telefono per', 'trim|required');
	 // $this->form_validation->set_rules('TelCelular_Per', 'telcelular per', 'trim|required');
	 // $this->form_validation->set_rules('Correo_Per', 'correo per', 'trim|required');
	 // $this->form_validation->set_rules('Direccion_Per', 'direccion per', 'trim|required');
	 // $this->form_validation->set_rules('FechaNacimiento_Per', 'fechanacimiento per', 'trim|required');
	 // $this->form_validation->set_rules('FechaRegistro_Per', 'fecharegistro per', 'trim|required');
	 // $this->form_validation->set_rules('Celular_Per', 'celular per', 'trim|required');
	 // $this->form_validation->set_rules('Id_PerTipId', 'id pertipid', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_PerGen', 'id pergen', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Mun', 'id mun', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_PerEst', 'id perest', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_PerTip', 'id pertip', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Emp', 'id emp', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Primary_Usu', 'primary usu', 'trim|required|numeric');

	$this->form_validation->set_rules('Id_Per', 'Id_Per', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "listado de contactos.xls";
        $judul = "persona";
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
    	xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Identificacion_Per")));
    	xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Nombre1_Per")));
    	xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Nombre2_Per")));
    	xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Apeliido1_Per")));
    	xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Apellido2_Per")));
    	xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Telefono_Per")));
    	xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("TelCelular_Per")));
    	xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Correo_Per")));
    	xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Direccion_Per")));
    	xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("FechaNacimiento_Per")));
    	xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("FechaRegistro_Per")));
    	xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Celular_Per")));
    	xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_PerTipId")));
    	xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_PerGen")));
    	xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_Mun")));
    	xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_PerEst")));
    	xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_PerTip")));
    	xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_Emp")));

        $this->load->model('Vw_persona_model');
	   foreach ($this->Vw_persona_model->get_all() as $data) {
            $kolombody = 0;
            
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Identificacion_Per));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Nombre1_Per));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Nombre2_Per));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Apeliido1_Per));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Apellido2_Per));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Telefono_Per));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->TelCelular_Per));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Correo_Per));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Direccion_Per));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->FechaNacimiento_Per));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->FechaRegistro_Per));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Celular_Per));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Descripcion_PerTipId));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Descripcion_PerGen));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Nombre_Num));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Estado_PerEst));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Descripcion_PerTip));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Nombre_Emp));

	        $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Persona.php */
/* Location: ./application/controllers/Persona.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-24 01:26:15 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/