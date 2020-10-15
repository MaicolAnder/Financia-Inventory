<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gestion_documental extends CI_Controller
{
    var $module = 'Gestion_documental';
    var $view = 'gestion_documental';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Gestion_documental_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['page'] = 'Listar Gestion_documental';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/gestion_documental_list';
		
            $this->load->model('Afiliado_model');
            $data['all_afiliado'] = $this->Afiliado_model->get_all();
		
            $this->load->model('Autorizaciones_model');
            $data['all_autorizaciones'] = $this->Autorizaciones_model->get_all();
		
            $this->load->model('Contratos_model');
            $data['all_contratos'] = $this->Contratos_model->get_all();
		
            $this->load->model('Persona_model');
            $data['all_persona'] = $this->Persona_model->get_all();
		
            $this->load->model('Pertinencia_autorizacion_model');
            $data['all_pertinencia_autorizacion'] = $this->Pertinencia_autorizacion_model->get_all();
		
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
        echo $this->Gestion_documental_model->json($search_fields, $links);

        // Para llamar otras vistas, metodo siguiente
        // $columns = 'element 1, element 2, element 3';
        // $find_id = 'pk_element';
        // echo $this->Gestion_documental_model->json($search_fields, $links, 'view or table', $columns, $find_id);
    }

    public function read($id) 
    {
        $row = $this->Gestion_documental_model->get_by_id($id);
        if ($row) {
            $data = array(
		'Id_GesDoc' => $row->Id_GesDoc,
		'Nombre_GesDoc' => $row->Nombre_GesDoc,
		'Descripcion_GesDoc' => $row->Descripcion_GesDoc,
		'NombreInterno_GesDoc' => $row->NombreInterno_GesDoc,
		'Ubicacion_GesDoc' => $row->Ubicacion_GesDoc,
		'Formato_GesDoc' => $row->Formato_GesDoc,
		'Tamanio_GesDoc' => $row->Tamanio_GesDoc,
		'FechaRegistro_GesDoc' => $row->FechaRegistro_GesDoc,
		'Id_Usu' => $row->Id_Usu,
		'Id_Per' => $row->Id_Per,
		'Id_PerAut' => $row->Id_PerAut,
		'Id_Afi' => $row->Id_Afi,
		'Id_Aut' => $row->Id_Aut,
		'Id_Con' => $row->Id_Con,
	    );
        $data['id_update'] = $id;
        $data['page'] = 'Ver Gestion_documental';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/gestion_documental_read';
        $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('gestion_documental'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('gestion_documental/create_action'),
	    'Id_GesDoc' => set_value('Id_GesDoc'),
	    'Nombre_GesDoc' => set_value('Nombre_GesDoc'),
	    'Descripcion_GesDoc' => set_value('Descripcion_GesDoc'),
	    'NombreInterno_GesDoc' => set_value('NombreInterno_GesDoc'),
	    'Ubicacion_GesDoc' => set_value('Ubicacion_GesDoc'),
	    'Formato_GesDoc' => set_value('Formato_GesDoc'),
	    'Tamanio_GesDoc' => set_value('Tamanio_GesDoc'),
	    'FechaRegistro_GesDoc' => set_value('FechaRegistro_GesDoc'),
	    'Id_Usu' => set_value('Id_Usu'),
	    'Id_Per' => set_value('Id_Per'),
	    'Id_PerAut' => set_value('Id_PerAut'),
	    'Id_Afi' => set_value('Id_Afi'),
	    'Id_Aut' => set_value('Id_Aut'),
	    'Id_Con' => set_value('Id_Con'),
	);
		
                $this->load->model('Afiliado_model');
                $data['all_afiliado'] = $this->Afiliado_model->get_all();
		
                $this->load->model('Autorizaciones_model');
                $data['all_autorizaciones'] = $this->Autorizaciones_model->get_all();
		
                $this->load->model('Contratos_model');
                $data['all_contratos'] = $this->Contratos_model->get_all();
		
                $this->load->model('Persona_model');
                $data['all_persona'] = $this->Persona_model->get_all();
		
                $this->load->model('Pertinencia_autorizacion_model');
                $data['all_pertinencia_autorizacion'] = $this->Pertinencia_autorizacion_model->get_all();
		
                $this->load->model('Usuario_model');
                $data['all_usuario'] = $this->Usuario_model->get_all();
		   
        $data['page'] = 'Nuevo Gestion_documental';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/gestion_documental_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(

	'Id_GesDoc' => NULL,
		'Nombre_GesDoc' => validar_post('Nombre_GesDoc'), 
		'Descripcion_GesDoc' => validar_post('Descripcion_GesDoc'), 
		'NombreInterno_GesDoc' => validar_post('NombreInterno_GesDoc'), 
		'Ubicacion_GesDoc' => validar_post('Ubicacion_GesDoc'), 
		'Formato_GesDoc' => validar_post('Formato_GesDoc'), 
		'Tamanio_GesDoc' => validar_post('Tamanio_GesDoc'), 
		'FechaRegistro_GesDoc' => validar_post('FechaRegistro_GesDoc'), 
		'Id_Usu' => validar_post('Id_Usu'), 
		'Id_Per' => validar_post('Id_Per'), 
		'Id_PerAut' => validar_post('Id_PerAut'), 
		'Id_Afi' => validar_post('Id_Afi'), 
		'Id_Aut' => validar_post('Id_Aut'), 
		'Id_Con' => validar_post('Id_Con'), 
	    );

            $this->Gestion_documental_model->insert($data);
            $this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('gestion_documental'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Gestion_documental_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('gestion_documental/update_action'),
		'Id_GesDoc' => set_value('Id_GesDoc', $row->Id_GesDoc),
		'Nombre_GesDoc' => set_value('Nombre_GesDoc', $row->Nombre_GesDoc),
		'Descripcion_GesDoc' => set_value('Descripcion_GesDoc', $row->Descripcion_GesDoc),
		'NombreInterno_GesDoc' => set_value('NombreInterno_GesDoc', $row->NombreInterno_GesDoc),
		'Ubicacion_GesDoc' => set_value('Ubicacion_GesDoc', $row->Ubicacion_GesDoc),
		'Formato_GesDoc' => set_value('Formato_GesDoc', $row->Formato_GesDoc),
		'Tamanio_GesDoc' => set_value('Tamanio_GesDoc', $row->Tamanio_GesDoc),
		'FechaRegistro_GesDoc' => set_value('FechaRegistro_GesDoc', $row->FechaRegistro_GesDoc),
		'Id_Usu' => set_value('Id_Usu', $row->Id_Usu),
		'Id_Per' => set_value('Id_Per', $row->Id_Per),
		'Id_PerAut' => set_value('Id_PerAut', $row->Id_PerAut),
		'Id_Afi' => set_value('Id_Afi', $row->Id_Afi),
		'Id_Aut' => set_value('Id_Aut', $row->Id_Aut),
		'Id_Con' => set_value('Id_Con', $row->Id_Con),
	 );
		
                $this->load->model('Afiliado_model');
                $data['all_afiliado'] = $this->Afiliado_model->get_all();
		
                $this->load->model('Autorizaciones_model');
                $data['all_autorizaciones'] = $this->Autorizaciones_model->get_all();
		
                $this->load->model('Contratos_model');
                $data['all_contratos'] = $this->Contratos_model->get_all();
		
                $this->load->model('Persona_model');
                $data['all_persona'] = $this->Persona_model->get_all();
		
                $this->load->model('Pertinencia_autorizacion_model');
                $data['all_pertinencia_autorizacion'] = $this->Pertinencia_autorizacion_model->get_all();
		
                $this->load->model('Usuario_model');
                $data['all_usuario'] = $this->Usuario_model->get_all();
		   
            $data['page'] = 'Actualizar Gestion_documental';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/gestion_documental_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('gestion_documental'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_GesDoc', TRUE));
        } else {
            $data = array(
		'Nombre_GesDoc' => validar_post('Nombre_GesDoc'), 
		'Descripcion_GesDoc' => validar_post('Descripcion_GesDoc'), 
		'NombreInterno_GesDoc' => validar_post('NombreInterno_GesDoc'), 
		'Ubicacion_GesDoc' => validar_post('Ubicacion_GesDoc'), 
		'Formato_GesDoc' => validar_post('Formato_GesDoc'), 
		'Tamanio_GesDoc' => validar_post('Tamanio_GesDoc'), 
		'FechaRegistro_GesDoc' => validar_post('FechaRegistro_GesDoc'), 
		'Id_Usu' => validar_post('Id_Usu'), 
		'Id_Per' => validar_post('Id_Per'), 
		'Id_PerAut' => validar_post('Id_PerAut'), 
		'Id_Afi' => validar_post('Id_Afi'), 
		'Id_Aut' => validar_post('Id_Aut'), 
		'Id_Con' => validar_post('Id_Con'), 
	    );

            $this->Gestion_documental_model->update($this->input->post('Id_GesDoc', TRUE), $data);
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('gestion_documental'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Gestion_documental_model->get_by_id($id);

        if ($row) {
            $this->Gestion_documental_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('gestion_documental'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('gestion_documental'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	 // $this->form_validation->set_rules('Nombre_GesDoc', 'nombre gesdoc', 'trim|required');
	 // $this->form_validation->set_rules('Descripcion_GesDoc', 'descripcion gesdoc', 'trim|required');
	 // $this->form_validation->set_rules('NombreInterno_GesDoc', 'nombreinterno gesdoc', 'trim|required');
	 // $this->form_validation->set_rules('Ubicacion_GesDoc', 'ubicacion gesdoc', 'trim|required');
	 // $this->form_validation->set_rules('Formato_GesDoc', 'formato gesdoc', 'trim|required');
	 // $this->form_validation->set_rules('Tamanio_GesDoc', 'tamanio gesdoc', 'trim|required|numeric');
	 // $this->form_validation->set_rules('FechaRegistro_GesDoc', 'fecharegistro gesdoc', 'trim|required');
	 // $this->form_validation->set_rules('Id_Usu', 'id usu', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Per', 'id per', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_PerAut', 'id peraut', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Afi', 'id afi', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Aut', 'id aut', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Con', 'id con', 'trim|required|numeric');

	$this->form_validation->set_rules('Id_GesDoc', 'Id_GesDoc', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "gestion_documental.xls";
        $judul = "gestion_documental";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nombre GesDoc");
	xlsWriteLabel($tablehead, $kolomhead++, "Descripcion GesDoc");
	xlsWriteLabel($tablehead, $kolomhead++, "NombreInterno GesDoc");
	xlsWriteLabel($tablehead, $kolomhead++, "Ubicacion GesDoc");
	xlsWriteLabel($tablehead, $kolomhead++, "Formato GesDoc");
	xlsWriteLabel($tablehead, $kolomhead++, "Tamanio GesDoc");
	xlsWriteLabel($tablehead, $kolomhead++, "FechaRegistro GesDoc");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Usu");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Per");
	xlsWriteLabel($tablehead, $kolomhead++, "Id PerAut");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Afi");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Aut");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Con");

	foreach ($this->Gestion_documental_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Nombre_GesDoc);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Descripcion_GesDoc);
	    xlsWriteLabel($tablebody, $kolombody++, $data->NombreInterno_GesDoc);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Ubicacion_GesDoc);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Formato_GesDoc);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Tamanio_GesDoc);
	    xlsWriteLabel($tablebody, $kolombody++, $data->FechaRegistro_GesDoc);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_Usu);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_Per);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_PerAut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_Afi);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_Aut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_Con);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=gestion_documental.doc");

        $data = array(
            'gestion_documental_data' => $this->Gestion_documental_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('gestion_documental/gestion_documental_doc',$data);
    }

}

/* End of file Gestion_documental.php */
/* Location: ./application/controllers/Gestion_documental.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-10-19 16:59:16 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/