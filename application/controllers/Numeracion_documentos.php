<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Numeracion_documentos extends CI_Controller
{
    var $module = 'Numeracion_documentos';
    var $view = 'numeracion_documentos';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Numeracion_documentos_model');
        $this->load->library('form_validation');        
		$this->load->library('datatables');
    }

    public function index()
    {
        if ($this->Numeracion_documentos_model->total_rows() < 1) {
            redirect(site_url($this->view.'/create'));
        } else {
            redirect(site_url($this->view.'/update'));
        }

        $data['page'] = 'Numeración de documentos';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/numeracion_documentos_list';
	
        $this->load->model('Documento_tipo_model');
        $data['all_documento_tipo'] = $this->Documento_tipo_model->get_all();
	
        $this->load->model('Transaccion_tipo_model');
        $data['all_transaccion_tipo'] = $this->Transaccion_tipo_model->get_all();

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
        echo $this->Numeracion_documentos_model->json($search_fields, $links);

        // Para llamar otras vistas, metodo siguiente
        // $columns = 'element 1, element 2, element 3';
        // $find_id = 'pk_element';
        // echo $this->Numeracion_documentos_model->json($search_fields, $links, 'view or table', $columns, $find_id);
    }

    public function read($id) 
    {
        $row = $this->Numeracion_documentos_model->get_by_id($id);
        if ($row) {
            $data = array(
				'Id_NumDoc' => $row->Id_NumDoc,
				'Inicial_NumDoc' => $row->Inicial_NumDoc,
				'Siguiente_NumDoc' => $row->Siguiente_NumDoc,
				'Id_DocTip' => $row->Id_DocTip,
				'Id_TranTip' => $row->Id_TranTip,
				'Primary_Usu' => $row->Primary_Usu,
		    );
            $data['id_update'] = $id;
            $data['page'] = 'Ver Numeracion_documentos';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/numeracion_documentos_read';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('numeracion_documentos'));
        }
    }

    public function create() 
    {
        if ($this->Numeracion_documentos_model->total_rows() > 0) {
            redirect(site_url($this->view.'/update'));
        }
        $data = array(
            'button' => 'Guardar numeración',
            'action' => site_url('numeracion_documentos/create_action'),
		    'Id_NumDoc' => set_value('Id_NumDoc'),
		    'Inicial_NumDoc' => set_value('Inicial_NumDoc', 1),
		    'Siguiente_NumDoc' => set_value('Siguiente_NumDoc', 1),
		    'Id_DocTip' => set_value('Id_DocTip'),
		    'Id_TranTip' => set_value('Id_TranTip'),
		    'Primary_Usu' => set_value('Primary_Usu'),
		);
	
        $this->load->model('Documento_tipo_model');
        $data['all_documento_tipo'] = $this->Documento_tipo_model->get_all();
	
        $this->load->model('Transaccion_tipo_model');
        $data['all_transaccion_tipo'] = $this->Transaccion_tipo_model->get_all();
		   
        $data['page'] = 'Nueva configuracion de numeración';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/numeracion_documentos_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $Id_TranTip = validar_post('value');
            $Primary_Usu = $this->session->userdata('Primary_Usu');
            if (!empty($Id_TranTip)) {
                $data = array();
                foreach ($Id_TranTip as $i => $value) {
                    unset($row);
                    $row = array(
                        'Id_NumDoc' => NULL,
                        'Inicial_NumDoc' => validar_post('Inicial_NumDoc')[$i], 
                        'Siguiente_NumDoc' => validar_post('Siguiente_NumDoc')[$i], 
                        'Id_DocTip' => NULL, 
                        'Id_TranTip' => $value, 
                        'Primary_Usu' => $Primary_Usu, 
                    );
                    array_push($data, $row);
                }
                $this->Numeracion_documentos_model->insert_batch($data);
            }
            
            $this->session->set_flashdata('message', 'Numeración creada exitosamente');
            redirect(site_url('numeracion_documentos/update'));
        }
    }
    
    public function update() 
    {
        if ($this->Numeracion_documentos_model->total_rows() < 1) {
            redirect(site_url($this->view.'/create'));
        }
        $Primary_Usu = $this->session->userdata('Primary_Usu');
        $all_transaccion_tipo = $this->Numeracion_documentos_model->get_all('*', ['Primary_Usu'=>$Primary_Usu]);

        // if ($row) {
            $data = array(
                'button' => 'Actualizar',
                'action' => site_url('numeracion_documentos/update_action'),
				'all_transaccion_tipo' => $all_transaccion_tipo,
                'true' => true
			);
	
            $this->load->model('Documento_tipo_model');
            $data['all_documento_tipo'] = $this->Documento_tipo_model->get_all();
	
            $this->load->model('Transaccion_tipo_model');
            //$data['all_transaccion_tipo'] = $this->Transaccion_tipo_model->get_all();
		   
            $data['page'] = 'Actualizar numeración de documentos';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/numeracion_documentos_form';
            $this->load->view('layouts/main',$data);
        // } else {
        //     $this->session->set_flashdata('message', 'Registro no encontrado');
        //     redirect(site_url('numeracion_documentos'));
        // }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_NumDoc', TRUE));
        } else {
            $Id_TranTip = validar_post('value');
            $Primary_Usu = $this->session->userdata('Primary_Usu');
            if (!empty($Id_TranTip)) {
                $data = array();
                foreach ($Id_TranTip as $i => $value) {
                    unset($row);
                    $row = array(
                        'Id_NumDoc' => validar_post('Id_NumDoc')[$i],
                        'Inicial_NumDoc' => validar_post('Inicial_NumDoc')[$i], 
                        'Siguiente_NumDoc' => validar_post('Siguiente_NumDoc')[$i], 
                        'Id_DocTip' => NULL, 
                        'Id_TranTip' => $value, 
                        'Primary_Usu' => $Primary_Usu, 
                    );
                    array_push($data, $row);
                }
                $this->Numeracion_documentos_model->update_batch($data);
            }
            
            $this->session->set_flashdata('message', 'Numeración actualizada exitosamente');
            redirect(site_url('numeracion_documentos/update'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Numeracion_documentos_model->get_by_id($id);

        if ($row) {
            $this->Numeracion_documentos_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('numeracion_documentos'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('numeracion_documentos'));
        }
    }

    public function validate_nums()
    {
        if ($this->Numeracion_documentos_model->total_rows() < 1) {
            redirect(site_url($this->view.'/create'));
        } else {
            redirect(site_url($this->view.'/update'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	 // $this->form_validation->set_rules('Inicial_NumDoc', 'inicial numdoc', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Siguiente_NumDoc', 'siguiente numdoc', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_DocTip', 'id doctip', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_TranTip', 'id trantip', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Primary_Usu', 'primary usu', 'trim|required|numeric');

	$this->form_validation->set_rules('Id_NumDoc', 'Id_NumDoc', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "Listado de numeracion_documentos.xls";
        $judul = "numeracion_documentos";
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
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Inicial_NumDoc")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Siguiente_NumDoc")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_DocTip")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_TranTip")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Primary_Usu")));

	foreach ($this->Numeracion_documentos_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Inicial_NumDoc));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Siguiente_NumDoc));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Id_DocTip));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Id_TranTip));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Primary_Usu));

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Numeracion_documentos.php */
/* Location: ./application/controllers/Numeracion_documentos.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-22 23:01:34 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/