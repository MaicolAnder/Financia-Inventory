<?php
Class Web extends CI_Controller{   
	
	var $module = 'Web';
    var $view = 'web';

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    function index(){
    	
        $data = array(
            'email' => set_value('email'), 
            'user'=>set_value('user'),
            'password'=>set_value('password')
        );

        $data['status'] = 'register';
        $this->load->view('login/login', $data);
    }
    public function d($value='')
    {
        # code...
    }
    public function register()
    {
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('user', 'user', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]|max_length[150]');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            if (validar_post('password')!='' && validar_post('user')!='' && validar_post('email')!='') {
                $this->load->model('Usuario_model');
                $rs = $this->Usuario_model->get_all('*', array('Usuario_Usu'=>validar_post('user'), 'OR Email_Usu'=>validar_post('email') ) );
                if ($rs) {
                    if ($rs[0]->Usuario_Usu == validar_post('user')) {
                        $this->session->set_flashdata('message', 'El usuario ingresado no está disponible');
                    }elseif ($rs[0]->Email_Usu == validar_post('email')) {
                        $this->session->set_flashdata('message', 'El E-mail proporcionado, ya se encuentra registrado');
                    }
                    redirect(site_url('web'));
                } else {
                    $_SESSION['email'] = validar_post('email');
                    $_SESSION['user'] = validar_post('user');
                    $_SESSION['password'] = validar_post('password');

                    $data = array(
                        'Nombre1_Per' => set_value('Nombre1_Per'), 
                        'Nombre2_Per'=>set_value('Nombre2_Per'),
                        'Apeliido1_Per'=>set_value('Apeliido1_Per'),
                        'Apellido2_Per'=>set_value('Apellido2_Per'),
                        'TelCelular_Per'=>set_value('TelCelular_Per'),
                        'Id_Mun'=>set_value('Id_Mun')
                    );

                    $this->load->model('Departamento_model');
                    $this->load->model('Municipio_model');
                    $data['all_municipio'] = $this->Municipio_model->get_all('*',[],['Id_Dep'=>'ASC','Nombre_Num'=>'ASC']);

                    $data['status'] = 'person';
                    $this->load->view('login/login', $data);
                }
                  
            } else {
                $this->session->set_flashdata('message', 'Ups! Algo ha salido mal');
                redirect(site_url('web'));
            }
            

            // echo "Llego bien";
            
            
        }
    }

    public function registerp()
    {
        $Contrasena_Usu =  $_SESSION['password'];
        $Usuario_Usu =  $_SESSION['user'];
        $Email_Usu =  $_SESSION['email'];

        if ($Contrasena_Usu!='' && $Email_Usu!='') {
            $data_per = array(
                'Id_Per' => NULL,
                'Identificacion_Per' => validar_post('Identificacion_Per') ,
                'Nombre1_Per' => validar_post('Nombre1_Per') ,
                'Nombre2_Per' => validar_post('Nombre2_Per') ,
                'Apeliido1_Per' => validar_post('Apeliido1_Per') ,
                'Apellido2_Per' => validar_post('Apellido2_Per') ,
                'Telefono_Per' => validar_post('Telefono_Per') ,
                'TelCelular_Per' => validar_post('TelCelular_Per') ,
                'Direccion_Per' => validar_post('Direccion_Per') ,
                'FechaRegistro_Per' => date('Y-m-d H:m:s'),
                'Id_PerTipId' => validar_post('Id_PerTipId') ,
                'Id_Mun' => validar_post('Id_Mun') ,
                'Id_PerEst' => 1,
                'Id_Emp' => validar_post('Id_Emp')   
            );

            $this->load->model('Persona_model');
            $Id_Per = $this->Persona_model->insert($data_per);

            $hashPassword = password_hash($Contrasena_Usu, PASSWORD_BCRYPT,array("cost"=>4) );
            $data = array(
                'Id_Usu' => NULL,
                'Contrasena_Usu' => $hashPassword,
                'Email_Usu' => $Email_Usu,
                'UltimoAcceso_Usu' => NULL ,
                'UltimaContrasena_Usu' => NULL ,
                'KeyPago_Usu' => NULL ,
                'Id_Per' => $Id_Per,
                'Id_UsuEst' => 1,
                'Id_Rol' => 1,
                'Usuario_Usu' => $Usuario_Usu,
                'FechaRegistro_Usu' => date('Y-m-d H:m:s')
            );
            // die();
            $this->load->model('Usuario_model');
            $Id_Usu = $this->Usuario_model->insert($data);

            $this->Persona_model->update($Id_Per, array('Primary_Usu'=>$Id_Usu));
            $this->Usuario_model->update($Id_Usu, array('Primary_Usu'=>$Id_Usu));

            $this->session->set_flashdata('message', 'Usuario creado exitosamente, ya puede acceder a la plataforma');
            redirect(site_url('auth'));
            
        } else {
            $this->session->set_flashdata('message', 'Email y usuario requeridos, usuario no creado');
            redirect(site_url('web'));
        }
    }
   
    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	 // $this->form_validation->set_rules('Id_Usu_Solicitud', 'id usu solicitud', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Afi_Solicitud', 'id afi solicitud', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Usu_Aprobacion', 'id usu aprobacion', 'trim|required|numeric');
	 // $this->form_validation->set_rules('NumeroRadicado_Per', 'numeroradicado per', 'trim|required|numeric');
	 // $this->form_validation->set_rules('NumeroAutorizacion_Per', 'numeroautorizacion per', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_EspMed', 'id espmed', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Cie', 'id cie', 'trim|required|numeric');
	 // $this->form_validation->set_rules('FechaSolicitud_Per', 'fechasolicitud per', 'trim|required');
	 // $this->form_validation->set_rules('Id_Emp_Solicitud', 'id emp solicitud', 'trim|required|numeric');
	 
     $this->form_validation->set_rules('Id_PerTipId', 'id perautest', 'trim|required');
     $this->form_validation->set_rules('Id_Afi_Solicitud', 'id perautrev', 'trim|required');

	// $this->form_validation->set_rules('Id_PerAut', 'Id_PerAut', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
}
