<?php
Class Auth extends CI_Controller{    
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    function index($url = ""){
        
        if(!$this->session->userdata('Id_Usu')){
            $this->load->view('login/login');
        } else {
            redirect('inicio');
            exit();
        }
    }
    
    function cheklogin(){
        $email      = $this->input->post('email',TRUE);
        $password = $this->input->post('password',TRUE);
        $hashPass = password_hash($password,PASSWORD_DEFAULT);
        $test     = password_verify($password, $hashPass);
        // query chek users
        $this->db->where('Email_Usu',$email);
        //$this->db->where('password',  $test);
        
        $object_users = $this->db->get('usuario');
        if($object_users->num_rows()>0){
            $user_data = $object_users->row_array();
            if(password_verify($password,$user_data['Contrasena_Usu'])){
                // retrive user data to session
                $this->db->where('Id_Per',$user_data['Id_Per']);
                $object_person = $this->db->get('vw_persona');
                $person_data = $object_person->row_array();

                $this->db->where('Id_Usu',$user_data['Id_Usu']);
                $object_vw_user = $this->db->get('vw_usuario');
                $wv_user_data = $object_vw_user->row_array();

                $Id_Rol = $user_data['Id_Rol'];
                $Permisos_usuario = $this->db->get_where('roles_permiso',array('Id_Rol'=>$Id_Rol))->result();

                $menu = array();
                foreach ($Permisos_usuario as $value) {
                    $Permisos = $this->db->get_where('permiso',array('Id_Perm'=>$value->Id_Perm))->row_array();
                    array_push($menu, $Permisos['Controlador_Perm']);

                }
                //Cargar datos de usuario y persona a la sessión
                $this->session->set_userdata('Permisos',$Permisos_usuario); 
                $this->session->set_userdata('menu',$menu);  
                $this->session->set_userdata($user_data);                
                $this->session->set_userdata($person_data);
                $this->session->set_userdata($wv_user_data);
                
                // Actualizar ultimo acceso
                $data['UltimoAcceso_Usu'] = date('Y-m-d H:m:s');
                $this->db->where('Id_Usu', $this->session->userdata('Id_Usu'));
                $this->db->update('usuario', $data);
                redirect('inicio');

            }else{
                $this->session->set_flashdata('status_login','El correo electrónico o contraseña son incorrectos');
                redirect('auth');
                // echo "In Correcto";
            }
        }else{
            $this->session->set_flashdata('status_login','El correo electrónico o contraseña son incorrectos');
            redirect('auth');
        }
    }
    
    function logout(){
        $this->session->sess_destroy();
        $this->session->set_flashdata('status_login','Vuelve pronto');
        redirect('auth');
    }
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
        return $id;
    }
    public function acceso_denegado()
    {
        $data['page'] = 'Acceso denegado';
        $data['module']= 'Acceso';
        $data['_view'] = 'login/acceso_denegado';
        $this->load->view('layouts/main',$data);
    }
}
