<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mensajes extends CI_Controller
{
    var $module = 'Mensajes';
    var $view = 'mensajes';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Mensajes_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        

        $config['first_link'] = 'Inicio';
        $config['last_link'] = 'Fin';
        $config['next_link'] = '>';
        $config['prev_link'] = '<';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</span></li>';
        // $config['prev_link'] = '<i class="icon-backward"></i> <';
        // $config['next_link'] = '<i class="icon-forward"></i> >';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';

        if ($q <> '') {
            $config['base_url'] = base_url() . 'mensajes/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'mensajes/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'mensajes/index';
            $config['first_url'] = base_url() . 'mensajes/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Mensajes_model->total_rows($q);
        $mensajes = $this->Mensajes_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'mensajes_data' => $mensajes,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['page'] = 'Bandeja de entrada';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/mensajes_list';
        $this->load->view('layouts/correspondencia',$data);
    }

    public function read($id) 
    {
        $row = $this->Mensajes_model->get_by_id($id);
        if ($row) {
            $data = array(
		'Id_Men' => $row->Id_Men,
		'Asunto_Men' => $row->Asunto_Men,
		'Mensaje_Men' => $row->Mensaje_Men,
		'FechaRegistro_Men' => $row->FechaRegistro_Men,
		'FechaVisto_Men' => $row->FechaVisto_Men,
		'DestinatarioEmail_Men' => $row->DestinatarioEmail_Men,
		'Estado_Men' => $row->Estado_Men,
		'Masivo_Men' => $row->Masivo_Men,
		'Id_MenTip' => $row->Id_MenTip,
	    );
        $data['id_update'] = $id;
        $data['page'] = 'Leer mensaje';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/mensajes_read';
        $this->load->view('layouts/correspondencia',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('mensajes'));
        }
    }
    public function enviar(){
      /*
       * Cuando cargamos una librería
       * es similar a hacer en PHP puro esto:
       * require_once("libreria.php");
       * $lib=new Libreria();
       */
        
       //Cargamos la librería email
       $this->load->library('email');
        
       /*
        * Configuramos los parámetros para enviar el email,
        * las siguientes configuraciones es recomendable
        * hacerlas en el fichero email.php dentro del directorio config,
        * en este caso para hacer un ejemplo rápido lo hacemos
        * en el propio controlador
        */
        
       //Indicamos el protocolo a utilizar
        $config['protocol'] = 'smtp';
         
       //El servidor de correo que utilizaremos
        $config["smtp_host"] = 'smtp.gmail.com';
         
       //Nuestro usuario
        $config["smtp_user"] = 'correo@gmail.com';
         
       //Nuestra contraseña
        $config["smtp_pass"] = 'contraseña';   
         
       //El puerto que utilizará el servidor smtp
        $config["smtp_port"] = '587';
        
       //El juego de caracteres a utilizar
        $config['charset'] = 'utf-8';
 
       //Permitimos que se puedan cortar palabras
        $config['wordwrap'] = TRUE;
         
       //El email debe ser valido 
       $config['validate'] = true;
       
        
      //Establecemos esta configuración
        $this->email->initialize($config);
 
      //Ponemos la dirección de correo que enviará el email y un nombre
        $this->email->from('correo@gmail.com', 'Victor Robles');
         
      /*
       * Ponemos el o los destinatarios para los que va el email
       * en este caso al ser un formulario de contacto te lo enviarás a ti
       * mismo
       */
        $this->email->to('correo@gmail.com', 'Víctor Robles');
         
      //Definimos el asunto del mensaje
        $this->email->subject($this->input->post("asunto"));
         
      //Definimos el mensaje a enviar
        $this->email->message(
                "Email: ".$this->input->post("email").
                " Mensaje: ".$this->input->post("mensaje")
                );
         
        //Enviamos el email y si se produce bien o mal que avise con una flasdata
        if($this->email->send()){
            $this->session->set_flashdata('envio', 'Email enviado correctamente');
        }else{
            $this->session->set_flashdata('envio', 'No se a enviado el email');
        }
         
        redirect(base_url("contacto"));
   }  

    public function create() 
    {
        $data = array(
            'button' => 'Enviar',
            'action' => site_url('mensajes/create_action'),
	    'Id_Men' => set_value('Id_Men'),
	    'Asunto_Men' => set_value('Asunto_Men'),
	    'Mensaje_Men' => set_value('Mensaje_Men'),
	    'FechaRegistro_Men' => set_value('FechaRegistro_Men'),
	    'FechaVisto_Men' => set_value('FechaVisto_Men'),
	    'DestinatarioEmail_Men' => set_value('DestinatarioEmail_Men'),
	    'Estado_Men' => set_value('Estado_Men'),
	    'Masivo_Men' => set_value('Masivo_Men'),
	    'Id_MenTip' => set_value('Id_MenTip'),
	);
		
                $this->load->model('Mensaje_tipo_model');
                $data['all_mensaje_tipo'] = $this->Mensaje_tipo_model->get_all();
		   
        $data['page'] = 'Nuevo mensaje';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/mensajes_form';
        $this->load->view('layouts/correspondencia',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(

	'Id_Men' => NULL,
		'Asunto_Men' => validar_post('Asunto_Men'), 
		'Mensaje_Men' => validar_post('Mensaje_Men'), 
		'FechaRegistro_Men' => validar_post('FechaRegistro_Men'), 
		'FechaVisto_Men' => validar_post('FechaVisto_Men'), 
		'DestinatarioEmail_Men' => validar_post('DestinatarioEmail_Men'), 
		'Estado_Men' => validar_post('Estado_Men'), 
		'Masivo_Men' => validar_post('Masivo_Men'), 
		'Id_MenTip' => validar_post('Id_MenTip'), 
	    );

            $this->Mensajes_model->insert($data);
            $this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('mensajes'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Mensajes_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Actualizar y enviar',
                'action' => site_url('mensajes/update_action'),
		'Id_Men' => set_value('Id_Men', $row->Id_Men),
		'Asunto_Men' => set_value('Asunto_Men', $row->Asunto_Men),
		'Mensaje_Men' => set_value('Mensaje_Men', $row->Mensaje_Men),
		'FechaRegistro_Men' => set_value('FechaRegistro_Men', $row->FechaRegistro_Men),
		'FechaVisto_Men' => set_value('FechaVisto_Men', $row->FechaVisto_Men),
		'DestinatarioEmail_Men' => set_value('DestinatarioEmail_Men', $row->DestinatarioEmail_Men),
		'Estado_Men' => set_value('Estado_Men', $row->Estado_Men),
		'Masivo_Men' => set_value('Masivo_Men', $row->Masivo_Men),
		'Id_MenTip' => set_value('Id_MenTip', $row->Id_MenTip),
	 );
		
                $this->load->model('Mensaje_tipo_model');
                $data['all_mensaje_tipo'] = $this->Mensaje_tipo_model->get_all();
		   
            $data['page'] = 'Actualizar información del mensajes';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/mensajes_form';
            $this->load->view('layouts/correspondencia',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('mensajes'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Men', TRUE));
        } else {
            $data = array(
		'Asunto_Men' => validar_post('Asunto_Men'), 
		'Mensaje_Men' => validar_post('Mensaje_Men'), 
		'FechaRegistro_Men' => validar_post('FechaRegistro_Men'), 
		'FechaVisto_Men' => validar_post('FechaVisto_Men'), 
		'DestinatarioEmail_Men' => validar_post('DestinatarioEmail_Men'), 
		'Estado_Men' => validar_post('Estado_Men'), 
		'Masivo_Men' => validar_post('Masivo_Men'), 
		'Id_MenTip' => validar_post('Id_MenTip'), 
	    );

            $this->Mensajes_model->update($this->input->post('Id_Men', TRUE), $data);
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('mensajes'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Mensajes_model->get_by_id($id);

        if ($row) {
            $this->Mensajes_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('mensajes'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('mensajes'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	 // $this->form_validation->set_rules('Asunto_Men', 'asunto men', 'trim|required');
	 // $this->form_validation->set_rules('Mensaje_Men', 'mensaje men', 'trim|required');
	 // $this->form_validation->set_rules('FechaRegistro_Men', 'fecharegistro men', 'trim|required');
	 // $this->form_validation->set_rules('FechaVisto_Men', 'fechavisto men', 'trim|required');
	 // $this->form_validation->set_rules('DestinatarioEmail_Men', 'destinatarioemail men', 'trim|required');
	 // $this->form_validation->set_rules('Estado_Men', 'estado men', 'trim|required');
	 // $this->form_validation->set_rules('Masivo_Men', 'masivo men', 'trim|required');
	 // $this->form_validation->set_rules('Id_MenTip', 'id mentip', 'trim|required|numeric');

	$this->form_validation->set_rules('Id_Men', 'Id_Men', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "mensajes.xls";
        $judul = "mensajes";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Asunto Men");
	xlsWriteLabel($tablehead, $kolomhead++, "Mensaje Men");
	xlsWriteLabel($tablehead, $kolomhead++, "FechaRegistro Men");
	xlsWriteLabel($tablehead, $kolomhead++, "FechaVisto Men");
	xlsWriteLabel($tablehead, $kolomhead++, "DestinatarioEmail Men");
	xlsWriteLabel($tablehead, $kolomhead++, "Estado Men");
	xlsWriteLabel($tablehead, $kolomhead++, "Masivo Men");
	xlsWriteLabel($tablehead, $kolomhead++, "Id MenTip");

	foreach ($this->Mensajes_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Asunto_Men);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Mensaje_Men);
	    xlsWriteLabel($tablebody, $kolombody++, $data->FechaRegistro_Men);
	    xlsWriteLabel($tablebody, $kolombody++, $data->FechaVisto_Men);
	    xlsWriteLabel($tablebody, $kolombody++, $data->DestinatarioEmail_Men);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Estado_Men);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Masivo_Men);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_MenTip);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=mensajes.doc");

        $data = array(
            'mensajes_data' => $this->Mensajes_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('mensajes/mensajes_doc',$data);
    }

}

/* End of file Mensajes.php */
/* Location: ./application/controllers/Mensajes.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-07 02:36:57 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/