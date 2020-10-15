<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Retenciones extends CI_Controller
{
    var $module = 'Retenciones';
    var $view = 'retenciones';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Retenciones_model');
        $this->load->library('form_validation');        
		$this->load->library('datatables');
    }

    public function index()
    {
        $data['page'] = 'Listar Retenciones';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/retenciones_list';
	
        $this->load->model('Cuentas_model');
        $data['all_cuentas'] = $this->Cuentas_model->get_all();
	
        $this->load->model('Cuentas_model');
        $data['all_cuentas'] = $this->Cuentas_model->get_all();
	
        $this->load->model('Retencion_tipo_model');
        $data['all_retencion_tipo'] = $this->Retencion_tipo_model->get_all();

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
        echo $this->Retenciones_model->json($search_fields, $links);

        // Para llamar otras vistas, metodo siguiente
        // $columns = 'element 1, element 2, element 3';
        // $find_id = 'pk_element';
        // echo $this->Retenciones_model->json($search_fields, $links, 'view or table', $columns, $find_id);
    }

    public function read($id) 
    {
        $row = $this->Retenciones_model->get_by_id($id);
        if ($row) {
            $data = array(
				'Id_Ret' => $row->Id_Ret,
				'Nombre_Ret' => $row->Nombre_Ret,
				'Porcentaje_Ret' => $row->Porcentaje_Ret,
				'Descripcion_Ret' => $row->Descripcion_Ret,
				'FechaRegistro_Ret' => $row->FechaRegistro_Ret,
				'Estado_Ret' => $row->Estado_Ret,
				'Id_RetTip' => $row->Id_RetTip,
				'Id_Cue_Ventas' => $row->Id_Cue_Ventas,
				'Id_Cue_Compras' => $row->Id_Cue_Compras,
				'Primary_Usu' => $row->Primary_Usu,
		    );
            $data['id_update'] = $id;
            $data['page'] = 'Ver Retenciones';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/retenciones_read';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('retenciones'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('retenciones/create_action'),
		    'Id_Ret' => set_value('Id_Ret'),
		    'Nombre_Ret' => set_value('Nombre_Ret'),
		    'Porcentaje_Ret' => set_value('Porcentaje_Ret'),
		    'Descripcion_Ret' => set_value('Descripcion_Ret'),
		    'FechaRegistro_Ret' => set_value('FechaRegistro_Ret'),
		    'Estado_Ret' => set_value('Estado_Ret'),
		    'Id_RetTip' => set_value('Id_RetTip'),
		    'Id_Cue_Ventas' => set_value('Id_Cue_Ventas'),
		    'Id_Cue_Compras' => set_value('Id_Cue_Compras'),
		    'Primary_Usu' => set_value('Primary_Usu'),
		);
	
        $this->load->model('Cuentas_model');
        $data['all_cuentas'] = $this->Cuentas_model->get_all();
	
        $this->load->model('Cuentas_model');
        $data['all_cuentas'] = $this->Cuentas_model->get_all();
	
        $this->load->model('Retencion_tipo_model');
        $data['all_retencion_tipo'] = $this->Retencion_tipo_model->get_all();
		   
        $data['page'] = 'Nuevo Retenciones';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/retenciones_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'Id_Ret' => NULL,
				'Nombre_Ret' => validar_post('Nombre_Ret'), 
				'Porcentaje_Ret' => validar_post('Porcentaje_Ret'), 
				'Descripcion_Ret' => validar_post('Descripcion_Ret'), 
				'FechaRegistro_Ret' => validar_post('FechaRegistro_Ret'), 
				'Estado_Ret' => validar_post('Estado_Ret'), 
				'Id_RetTip' => validar_post('Id_RetTip'), 
				'Id_Cue_Ventas' => validar_post('Id_Cue_Ventas'), 
				'Id_Cue_Compras' => validar_post('Id_Cue_Compras'), 
				'Primary_Usu' => validar_post('Primary_Usu'), 
			);

            $this->Retenciones_model->insert($data);
            $this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('retenciones'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Retenciones_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('retenciones/update_action'),
				'Id_Ret' => set_value('Id_Ret', $row->Id_Ret),
				'Nombre_Ret' => set_value('Nombre_Ret', $row->Nombre_Ret),
				'Porcentaje_Ret' => set_value('Porcentaje_Ret', $row->Porcentaje_Ret),
				'Descripcion_Ret' => set_value('Descripcion_Ret', $row->Descripcion_Ret),
				'FechaRegistro_Ret' => set_value('FechaRegistro_Ret', $row->FechaRegistro_Ret),
				'Estado_Ret' => set_value('Estado_Ret', $row->Estado_Ret),
				'Id_RetTip' => set_value('Id_RetTip', $row->Id_RetTip),
				'Id_Cue_Ventas' => set_value('Id_Cue_Ventas', $row->Id_Cue_Ventas),
				'Id_Cue_Compras' => set_value('Id_Cue_Compras', $row->Id_Cue_Compras),
				'Primary_Usu' => set_value('Primary_Usu', $row->Primary_Usu),
			);
	
            $this->load->model('Cuentas_model');
            $data['all_cuentas'] = $this->Cuentas_model->get_all();
	
            $this->load->model('Cuentas_model');
            $data['all_cuentas'] = $this->Cuentas_model->get_all();
	
            $this->load->model('Retencion_tipo_model');
            $data['all_retencion_tipo'] = $this->Retencion_tipo_model->get_all();
		   
            $data['page'] = 'Actualizar Retenciones';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/retenciones_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('retenciones'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Ret', TRUE));
        } else {
            $data = array(
				'Nombre_Ret' => validar_post('Nombre_Ret'), 
				'Porcentaje_Ret' => validar_post('Porcentaje_Ret'), 
				'Descripcion_Ret' => validar_post('Descripcion_Ret'), 
				'FechaRegistro_Ret' => validar_post('FechaRegistro_Ret'), 
				'Estado_Ret' => validar_post('Estado_Ret'), 
				'Id_RetTip' => validar_post('Id_RetTip'), 
				'Id_Cue_Ventas' => validar_post('Id_Cue_Ventas'), 
				'Id_Cue_Compras' => validar_post('Id_Cue_Compras'), 
				'Primary_Usu' => validar_post('Primary_Usu'), 
		    );

            $this->Retenciones_model->update($this->input->post('Id_Ret', TRUE), $data);
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('retenciones'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Retenciones_model->get_by_id($id);

        if ($row) {
            $this->Retenciones_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('retenciones'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('retenciones'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	 // $this->form_validation->set_rules('Nombre_Ret', 'nombre ret', 'trim|required');
	 // $this->form_validation->set_rules('Porcentaje_Ret', 'porcentaje ret', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Descripcion_Ret', 'descripcion ret', 'trim|required');
	 // $this->form_validation->set_rules('FechaRegistro_Ret', 'fecharegistro ret', 'trim|required');
	 // $this->form_validation->set_rules('Estado_Ret', 'estado ret', 'trim|required');
	 // $this->form_validation->set_rules('Id_RetTip', 'id rettip', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Cue_Ventas', 'id cue ventas', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Cue_Compras', 'id cue compras', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Primary_Usu', 'primary usu', 'trim|required|numeric');

	$this->form_validation->set_rules('Id_Ret', 'Id_Ret', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "Listado de retenciones.xls";
        $judul = "retenciones";
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
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Nombre_Ret")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Porcentaje_Ret")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Descripcion_Ret")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("FechaRegistro_Ret")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Estado_Ret")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_RetTip")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_Cue_Ventas")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_Cue_Compras")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Primary_Usu")));

	foreach ($this->Retenciones_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Nombre_Ret));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Porcentaje_Ret));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Descripcion_Ret));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->FechaRegistro_Ret));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Estado_Ret));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Id_RetTip));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Id_Cue_Ventas));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Id_Cue_Compras));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Primary_Usu));

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Retenciones.php */
/* Location: ./application/controllers/Retenciones.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-31 22:18:36 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/