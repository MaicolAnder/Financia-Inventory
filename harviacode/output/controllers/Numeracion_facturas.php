<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Numeracion_facturas extends CI_Controller
{
    var $module = 'Numeracion_facturas';
    var $view = 'numeracion_facturas';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Numeracion_facturas_model');
        $this->load->library('form_validation');        
		$this->load->library('datatables');
    }

    public function index()
    {
        $data['page'] = 'Listar Numeracion_facturas';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/numeracion_facturas_list';

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
        echo $this->Numeracion_facturas_model->json($search_fields, $links);

        // Para llamar otras vistas, metodo siguiente
        // $columns = 'element 1, element 2, element 3';
        // $find_id = 'pk_element';
        // echo $this->Numeracion_facturas_model->json($search_fields, $links, 'view or table', $columns, $find_id);
    }

    public function read($id) 
    {
        $row = $this->Numeracion_facturas_model->get_by_id($id);
        if ($row) {
            $data = array(
				'Id_NumFac' => $row->Id_NumFac,
				'Nombre_NumFac' => $row->Nombre_NumFac,
				'Prefijo_NumFac' => $row->Prefijo_NumFac,
				'Numero_NumFac' => $row->Numero_NumFac,
				'Resolucion_NumFac' => $row->Resolucion_NumFac,
				'Activo_NumFac' => $row->Activo_NumFac,
				'Defecto_NumFac' => $row->Defecto_NumFac,
				'Primary_Usu' => $row->Primary_Usu,
		    );
            $data['id_update'] = $id;
            $data['page'] = 'Ver Numeracion_facturas';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/numeracion_facturas_read';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('numeracion_facturas'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('numeracion_facturas/create_action'),
		    'Id_NumFac' => set_value('Id_NumFac'),
		    'Nombre_NumFac' => set_value('Nombre_NumFac'),
		    'Prefijo_NumFac' => set_value('Prefijo_NumFac'),
		    'Numero_NumFac' => set_value('Numero_NumFac'),
		    'Resolucion_NumFac' => set_value('Resolucion_NumFac'),
		    'Activo_NumFac' => set_value('Activo_NumFac'),
		    'Defecto_NumFac' => set_value('Defecto_NumFac'),
		    'Primary_Usu' => set_value('Primary_Usu'),
		);
		   
        $data['page'] = 'Nuevo Numeracion_facturas';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/numeracion_facturas_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'Id_NumFac' => NULL,
				'Nombre_NumFac' => validar_post('Nombre_NumFac'), 
				'Prefijo_NumFac' => validar_post('Prefijo_NumFac'), 
				'Numero_NumFac' => validar_post('Numero_NumFac'), 
				'Resolucion_NumFac' => validar_post('Resolucion_NumFac'), 
				'Activo_NumFac' => validar_post('Activo_NumFac'), 
				'Defecto_NumFac' => validar_post('Defecto_NumFac'), 
				'Primary_Usu' => validar_post('Primary_Usu'), 
			);

            $this->Numeracion_facturas_model->insert($data);
            $this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('numeracion_facturas'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Numeracion_facturas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('numeracion_facturas/update_action'),
				'Id_NumFac' => set_value('Id_NumFac', $row->Id_NumFac),
				'Nombre_NumFac' => set_value('Nombre_NumFac', $row->Nombre_NumFac),
				'Prefijo_NumFac' => set_value('Prefijo_NumFac', $row->Prefijo_NumFac),
				'Numero_NumFac' => set_value('Numero_NumFac', $row->Numero_NumFac),
				'Resolucion_NumFac' => set_value('Resolucion_NumFac', $row->Resolucion_NumFac),
				'Activo_NumFac' => set_value('Activo_NumFac', $row->Activo_NumFac),
				'Defecto_NumFac' => set_value('Defecto_NumFac', $row->Defecto_NumFac),
				'Primary_Usu' => set_value('Primary_Usu', $row->Primary_Usu),
			);
		   
            $data['page'] = 'Actualizar Numeracion_facturas';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/numeracion_facturas_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('numeracion_facturas'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_NumFac', TRUE));
        } else {
            $data = array(
				'Nombre_NumFac' => validar_post('Nombre_NumFac'), 
				'Prefijo_NumFac' => validar_post('Prefijo_NumFac'), 
				'Numero_NumFac' => validar_post('Numero_NumFac'), 
				'Resolucion_NumFac' => validar_post('Resolucion_NumFac'), 
				'Activo_NumFac' => validar_post('Activo_NumFac'), 
				'Defecto_NumFac' => validar_post('Defecto_NumFac'), 
				'Primary_Usu' => validar_post('Primary_Usu'), 
		    );

            $this->Numeracion_facturas_model->update($this->input->post('Id_NumFac', TRUE), $data);
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('numeracion_facturas'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Numeracion_facturas_model->get_by_id($id);

        if ($row) {
            $this->Numeracion_facturas_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('numeracion_facturas'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('numeracion_facturas'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	 // $this->form_validation->set_rules('Nombre_NumFac', 'nombre numfac', 'trim|required');
	 // $this->form_validation->set_rules('Prefijo_NumFac', 'prefijo numfac', 'trim|required');
	 // $this->form_validation->set_rules('Numero_NumFac', 'numero numfac', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Resolucion_NumFac', 'resolucion numfac', 'trim|required');
	 // $this->form_validation->set_rules('Activo_NumFac', 'activo numfac', 'trim|required');
	 // $this->form_validation->set_rules('Defecto_NumFac', 'defecto numfac', 'trim|required');
	 // $this->form_validation->set_rules('Primary_Usu', 'primary usu', 'trim|required|numeric');

	$this->form_validation->set_rules('Id_NumFac', 'Id_NumFac', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "Listado de numeracion_facturas.xls";
        $judul = "numeracion_facturas";
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
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Nombre_NumFac")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Prefijo_NumFac")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Numero_NumFac")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Resolucion_NumFac")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Activo_NumFac")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Defecto_NumFac")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Primary_Usu")));

	foreach ($this->Numeracion_facturas_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Nombre_NumFac));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Prefijo_NumFac));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Numero_NumFac));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Resolucion_NumFac));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Activo_NumFac));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Defecto_NumFac));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Primary_Usu));

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Numeracion_facturas.php */
/* Location: ./application/controllers/Numeracion_facturas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-22 23:02:52 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/