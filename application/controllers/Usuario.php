<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario extends CI_Controller
{
    var $module = 'Usuario';
    var $view = 'usuario';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Usuario_model');
        $this->load->library('form_validation');        
		$this->load->library('datatables');
    }

    public function index()
    {
        $data['page'] = 'Listar Usuario';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/usuario_list';
	
        $this->load->model('Persona_model');
        $data['all_persona'] = $this->Persona_model->get_all();
	
        $this->load->model('Roles_model');
        $data['all_roles'] = $this->Roles_model->get_all();
	
        $this->load->model('Usuario_estado_model');
        $data['all_usuario_estado'] = $this->Usuario_estado_model->get_all();

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
        echo $this->Usuario_model->json($search_fields, $links);

        // Para llamar otras vistas, metodo siguiente
        // $columns = 'element 1, element 2, element 3';
        // $find_id = 'pk_element';
        // echo $this->Usuario_model->json($search_fields, $links, 'view or table', $columns, $find_id);
    }

    public function read($id) 
    {
        $row = $this->Usuario_model->get_by_id($id);
        if ($row) {
            $data = array(
				'Id_Usu' => $row->Id_Usu,
				'Usuario_Usu' => $row->Usuario_Usu,
				'Contrasena_Usu' => $row->Contrasena_Usu,
				'UltimoAcceso_Usu' => $row->UltimoAcceso_Usu,
				'UltimaContrasena_Usu' => $row->UltimaContrasena_Usu,
				'KeyPago_Usu' => $row->KeyPago_Usu,
				'Email_Usu' => $row->Email_Usu,
				'KeyRecoverPassword_Usu' => $row->KeyRecoverPassword_Usu,
				'FechaRegistro_Usu' => $row->FechaRegistro_Usu,
				'Primary_Usu' => $row->Primary_Usu,
				'Id_Per' => $row->Id_Per,
				'Id_UsuEst' => $row->Id_UsuEst,
				'Id_Rol' => $row->Id_Rol,
		    );
            $data['id_update'] = $id;
            $data['page'] = 'Ver Usuario';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/usuario_read';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('usuario'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('usuario/create_action'),
		    'Id_Usu' => set_value('Id_Usu'),
		    'Usuario_Usu' => set_value('Usuario_Usu'),
		    'Contrasena_Usu' => set_value('Contrasena_Usu'),
		    'UltimoAcceso_Usu' => set_value('UltimoAcceso_Usu'),
		    'UltimaContrasena_Usu' => set_value('UltimaContrasena_Usu'),
		    'KeyPago_Usu' => set_value('KeyPago_Usu'),
		    'Email_Usu' => set_value('Email_Usu'),
		    'KeyRecoverPassword_Usu' => set_value('KeyRecoverPassword_Usu'),
		    'FechaRegistro_Usu' => set_value('FechaRegistro_Usu'),
		    'Primary_Usu' => set_value('Primary_Usu'),
		    'Id_Per' => set_value('Id_Per'),
		    'Id_UsuEst' => set_value('Id_UsuEst'),
		    'Id_Rol' => set_value('Id_Rol'),
		);
	
        $this->load->model('Persona_model');
        $data['all_persona'] = $this->Persona_model->get_all();
	
        $this->load->model('Roles_model');
        $data['all_roles'] = $this->Roles_model->get_all();
	
        $this->load->model('Usuario_estado_model');
        $data['all_usuario_estado'] = $this->Usuario_estado_model->get_all();
		   
        $data['page'] = 'Nuevo Usuario';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/usuario_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'Id_Usu' => NULL,
				'Usuario_Usu' => validar_post('Usuario_Usu'), 
				'Contrasena_Usu' => validar_post('Contrasena_Usu'), 
				'UltimoAcceso_Usu' => validar_post('UltimoAcceso_Usu'), 
				'UltimaContrasena_Usu' => validar_post('UltimaContrasena_Usu'), 
				'KeyPago_Usu' => validar_post('KeyPago_Usu'), 
				'Email_Usu' => validar_post('Email_Usu'), 
				'KeyRecoverPassword_Usu' => validar_post('KeyRecoverPassword_Usu'), 
				'FechaRegistro_Usu' => validar_post('FechaRegistro_Usu'), 
				'Primary_Usu' => validar_post('Primary_Usu'), 
				'Id_Per' => validar_post('Id_Per'), 
				'Id_UsuEst' => validar_post('Id_UsuEst'), 
				'Id_Rol' => validar_post('Id_Rol'), 
			);

            $this->Usuario_model->insert($data);
            $this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('usuario'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Usuario_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('usuario/update_action'),
				'Id_Usu' => set_value('Id_Usu', $row->Id_Usu),
				'Usuario_Usu' => set_value('Usuario_Usu', $row->Usuario_Usu),
				'Contrasena_Usu' => set_value('Contrasena_Usu', $row->Contrasena_Usu),
				'UltimoAcceso_Usu' => set_value('UltimoAcceso_Usu', $row->UltimoAcceso_Usu),
				'UltimaContrasena_Usu' => set_value('UltimaContrasena_Usu', $row->UltimaContrasena_Usu),
				'KeyPago_Usu' => set_value('KeyPago_Usu', $row->KeyPago_Usu),
				'Email_Usu' => set_value('Email_Usu', $row->Email_Usu),
				'KeyRecoverPassword_Usu' => set_value('KeyRecoverPassword_Usu', $row->KeyRecoverPassword_Usu),
				'FechaRegistro_Usu' => set_value('FechaRegistro_Usu', $row->FechaRegistro_Usu),
				'Primary_Usu' => set_value('Primary_Usu', $row->Primary_Usu),
				'Id_Per' => set_value('Id_Per', $row->Id_Per),
				'Id_UsuEst' => set_value('Id_UsuEst', $row->Id_UsuEst),
				'Id_Rol' => set_value('Id_Rol', $row->Id_Rol),
			);
	
            $this->load->model('Persona_model');
            $data['all_persona'] = $this->Persona_model->get_all();
	
            $this->load->model('Roles_model');
            $data['all_roles'] = $this->Roles_model->get_all();
	
            $this->load->model('Usuario_estado_model');
            $data['all_usuario_estado'] = $this->Usuario_estado_model->get_all();
		   
            $data['page'] = 'Actualizar Usuario';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/usuario_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('usuario'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Usu', TRUE));
        } else {
            $data = array(
				'Usuario_Usu' => validar_post('Usuario_Usu'), 
				'Contrasena_Usu' => validar_post('Contrasena_Usu'), 
				'UltimoAcceso_Usu' => validar_post('UltimoAcceso_Usu'), 
				'UltimaContrasena_Usu' => validar_post('UltimaContrasena_Usu'), 
				'KeyPago_Usu' => validar_post('KeyPago_Usu'), 
				'Email_Usu' => validar_post('Email_Usu'), 
				'KeyRecoverPassword_Usu' => validar_post('KeyRecoverPassword_Usu'), 
				'FechaRegistro_Usu' => validar_post('FechaRegistro_Usu'), 
				'Primary_Usu' => validar_post('Primary_Usu'), 
				'Id_Per' => validar_post('Id_Per'), 
				'Id_UsuEst' => validar_post('Id_UsuEst'), 
				'Id_Rol' => validar_post('Id_Rol'), 
		    );

            $this->Usuario_model->update($this->input->post('Id_Usu', TRUE), $data);
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('usuario'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Usuario_model->get_by_id($id);

        if ($row) {
            $this->Usuario_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('usuario'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('usuario'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	 // $this->form_validation->set_rules('Usuario_Usu', 'usuario usu', 'trim|required');
	 // $this->form_validation->set_rules('Contrasena_Usu', 'contrasena usu', 'trim|required');
	 // $this->form_validation->set_rules('UltimoAcceso_Usu', 'ultimoacceso usu', 'trim|required');
	 // $this->form_validation->set_rules('UltimaContrasena_Usu', 'ultimacontrasena usu', 'trim|required');
	 // $this->form_validation->set_rules('KeyPago_Usu', 'keypago usu', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Email_Usu', 'email usu', 'trim|required');
	 // $this->form_validation->set_rules('KeyRecoverPassword_Usu', 'keyrecoverpassword usu', 'trim|required');
	 // $this->form_validation->set_rules('FechaRegistro_Usu', 'fecharegistro usu', 'trim|required');
	 // $this->form_validation->set_rules('Primary_Usu', 'primary usu', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Per', 'id per', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_UsuEst', 'id usuest', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Rol', 'id rol', 'trim|required|numeric');

	$this->form_validation->set_rules('Id_Usu', 'Id_Usu', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "Listado de usuario.xls";
        $judul = "usuario";
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
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Usuario_Usu")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Contrasena_Usu")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("UltimoAcceso_Usu")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("UltimaContrasena_Usu")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("KeyPago_Usu")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Email_Usu")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("KeyRecoverPassword_Usu")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("FechaRegistro_Usu")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Primary_Usu")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_Per")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_UsuEst")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_Rol")));

	foreach ($this->Usuario_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Usuario_Usu));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Contrasena_Usu));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->UltimoAcceso_Usu));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->UltimaContrasena_Usu));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->KeyPago_Usu));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Email_Usu));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->KeyRecoverPassword_Usu));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->FechaRegistro_Usu));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Primary_Usu));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Id_Per));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Id_UsuEst));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Id_Rol));

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Usuario.php */
/* Location: ./application/controllers/Usuario.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-31 22:18:44 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/