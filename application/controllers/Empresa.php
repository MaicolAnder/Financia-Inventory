<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empresa extends CI_Controller
{
    var $module = 'Empresa';
    var $view = 'empresa';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Vw_empresa_model');
        $this->load->model('Empresa_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['page'] = 'Listar Empresa';
        $data['module']= $this->module;
        $data['_view'] = 'vw_empresa/vw_empresa_list';
        $this->load->view('layouts/main',$data);
    } 
    
    public function json() {
        // Llamar vista normal
        header('Content-Type: application/json');
        $columns = 'Id_Emp,Nombre_Emp,DigitoVerificacion_Emp,Direccion_Emp,Nit_Emp,Correo_Emp,Telefono_Emp,TelCelular_Emp,Nombre_Num,Nombre_EmpTip,CodigoIPS_Emp';
        $dataForm = json_decode($this->input->post('filter_dataForm',TRUE));
        $search_fields = array();
        foreach ($dataForm as $value) {
            if ($value->value!='') {
                $find['value'] = $value->value;
                $find['field'] = $value->name;
                array_push($search_fields, $find);
            }
        }
        $links = array(
            array(
                'name_link'=>'servicio',
                'site_url'=>'contratos/read/$1',
                'link_txt'=>'<i class="fas fa-plus-circle"></i>',
                'atributos'=>array(
                    'title'=>'Servicios contratados',
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

        echo $this->Empresa_model->json($search_fields, $links,'vw_empresa', $columns, 'Id_Emp');

        // Para llamar otras vistas, metodo siguiente
        // $columns = 'element 1, element 2, element 3';
        // $find_id = 'pk_element';
        // echo $this->Empresa_model->json('view or table', $columns, $find_id);
    }

    public function read($id) 
    {
        $row = $this->Vw_empresa_model->get_by_id($id);
        if ($row) {
            $data = array(
            'Id_Emp' => $row->Id_Emp,
            'Nombre_Emp' => $row->Nombre_Emp,
            'DigitoVerificacion_Emp' => $row->DigitoVerificacion_Emp,
            'Direccion_Emp' => $row->Direccion_Emp,
            'Nit_Emp' => $row->Nit_Emp,
            'Correo_Emp' => $row->Correo_Emp,
            'Telefono_Emp' => $row->Telefono_Emp,
            'TelCelular_Emp' => $row->TelCelular_Emp,
            'Nombre_Num' => $row->Nombre_Num,
            'Nombre_EmpTip' => $row->Nombre_EmpTip,
        );
        $data['id_update'] = $id;
        $data['page'] = 'Ver empresa';
        $data['module']= $this->module;
        $data['_view'] = 'vw_empresa/vw_empresa_read';
        $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url($this->view));
        }
        /* $row = $this->Empresa_model->get_by_id($id);
        if ($row) {
            $data = array(
		'Id_Emp' => $row->Id_Emp,
		'Nombre_Emp' => $row->Nombre_Emp,
		'DigitoVerificacion_Emp' => $row->DigitoVerificacion_Emp,
		'Correo_Emp' => $row->Correo_Emp,
		'Direccion_Emp' => $row->Direccion_Emp,
		'Telefono_Emp' => $row->Telefono_Emp,
		'TelCelular_Emp' => $row->TelCelular_Emp,
		'Nit_Emp' => $row->Nit_Emp,
		'Id_Mun' => $row->Id_Mun,
		'Id_EmpTip' => $row->Id_EmpTip,
		'CodigoIPS_Emp' => $row->CodigoIPS_Emp,
		'CodigoSedeIPS_Emp' => $row->CodigoSedeIPS_Emp,
		'CodigoPrestador_Emp' => $row->CodigoPrestador_Emp,
		'Sede_Emp' => $row->Sede_Emp,
	    );
        $data['id_update'] = $id;
        $data['page'] = 'Ver Empresa';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/empresa_read';
        $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('empresa'));
        } */
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('empresa/create_action'),
	    'Id_Emp' => set_value('Id_Emp'),
	    'Nombre_Emp' => set_value('Nombre_Emp'),
	    'DigitoVerificacion_Emp' => set_value('DigitoVerificacion_Emp'),
	    'Correo_Emp' => set_value('Correo_Emp'),
	    'Direccion_Emp' => set_value('Direccion_Emp'),
	    'Telefono_Emp' => set_value('Telefono_Emp'),
	    'TelCelular_Emp' => set_value('TelCelular_Emp'),
	    'Nit_Emp' => set_value('Nit_Emp'),
	    'Id_Mun' => set_value('Id_Mun'),
	    'Id_EmpTip' => set_value('Id_EmpTip'),
	    'CodigoIPS_Emp' => set_value('CodigoIPS_Emp'),
	    'CodigoSedeIPS_Emp' => set_value('CodigoSedeIPS_Emp'),
	    'CodigoPrestador_Emp' => set_value('CodigoPrestador_Emp'),
	    'Sede_Emp' => set_value('Sede_Emp'),
	);
		
                $this->load->model('Empresa_model');
                $data['all_empresa'] = $this->Empresa_model->get_all();
		
                $this->load->model('Empresa_tipo_model');
                $data['all_empresa_tipo'] = $this->Empresa_tipo_model->get_all();
		
                $this->load->model('Municipio_model');
                $data['all_municipio'] = $this->Municipio_model->get_all();
		   
        $data['page'] = 'Nuevo Empresa';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/empresa_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'Id_Emp' => NULL,
                'Nombre_Emp' => ($this->input->post('Nombre_Emp',TRUE) !='') ? $this->input->post('Nombre_Emp',TRUE) : NULL ,
                'DigitoVerificacion_Emp' => ($this->input->post('DigitoVerificacion_Emp',TRUE) !='') ? $this->input->post('DigitoVerificacion_Emp',TRUE) : NULL ,
                'Correo_Emp' => ($this->input->post('Correo_Emp',TRUE) !='') ? $this->input->post('Correo_Emp',TRUE) : NULL ,
                'Direccion_Emp' => ($this->input->post('Direccion_Emp',TRUE) !='') ? $this->input->post('Direccion_Emp',TRUE) : NULL ,
                'Telefono_Emp' => ($this->input->post('Telefono_Emp',TRUE) !='') ? $this->input->post('Telefono_Emp',TRUE) : NULL ,
                'TelCelular_Emp' => ($this->input->post('TelCelular_Emp',TRUE) !='') ? $this->input->post('TelCelular_Emp',TRUE) : NULL ,
                'Nit_Emp' => ($this->input->post('Nit_Emp',TRUE) !='') ? $this->input->post('Nit_Emp',TRUE) : NULL ,
                'Id_Mun' => ($this->input->post('Id_Mun',TRUE) !='') ? $this->input->post('Id_Mun',TRUE) : NULL ,
                'Id_EmpTip' => ($this->input->post('Id_EmpTip',TRUE) !='') ? $this->input->post('Id_EmpTip',TRUE) : NULL ,
                'CodigoIPS_Emp' => ($this->input->post('CodigoIPS_Emp',TRUE) !='') ? $this->input->post('CodigoIPS_Emp',TRUE) : NULL ,
                'CodigoSedeIPS_Emp' => ($this->input->post('CodigoSedeIPS_Emp',TRUE) !='') ? $this->input->post('CodigoSedeIPS_Emp',TRUE) : NULL ,
                'CodigoPrestador_Emp' => ($this->input->post('CodigoPrestador_Emp',TRUE) !='') ? $this->input->post('CodigoPrestador_Emp',TRUE) : NULL ,
                'Sede_Emp' => ($this->input->post('Sede_Emp',TRUE) !='') ? $this->input->post('Sede_Emp',TRUE) : NULL ,
            );

            $this->Empresa_model->insert($data);
            $this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('empresa'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Empresa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('empresa/update_action'),
		'Id_Emp' => set_value('Id_Emp', $row->Id_Emp),
		'Nombre_Emp' => set_value('Nombre_Emp', $row->Nombre_Emp),
		'DigitoVerificacion_Emp' => set_value('DigitoVerificacion_Emp', $row->DigitoVerificacion_Emp),
		'Correo_Emp' => set_value('Correo_Emp', $row->Correo_Emp),
		'Direccion_Emp' => set_value('Direccion_Emp', $row->Direccion_Emp),
		'Telefono_Emp' => set_value('Telefono_Emp', $row->Telefono_Emp),
		'TelCelular_Emp' => set_value('TelCelular_Emp', $row->TelCelular_Emp),
		'Nit_Emp' => set_value('Nit_Emp', $row->Nit_Emp),
		'Id_Mun' => set_value('Id_Mun', $row->Id_Mun),
		'Id_EmpTip' => set_value('Id_EmpTip', $row->Id_EmpTip),
		'CodigoIPS_Emp' => set_value('CodigoIPS_Emp', $row->CodigoIPS_Emp),
		'CodigoSedeIPS_Emp' => set_value('CodigoSedeIPS_Emp', $row->CodigoSedeIPS_Emp),
		'CodigoPrestador_Emp' => set_value('CodigoPrestador_Emp', $row->CodigoPrestador_Emp),
		'Sede_Emp' => set_value('Sede_Emp', $row->Sede_Emp),
	 );
		
                $this->load->model('Empresa_model');
                $data['all_empresa'] = $this->Empresa_model->get_all();
		
                $this->load->model('Empresa_tipo_model');
                $data['all_empresa_tipo'] = $this->Empresa_tipo_model->get_all();
		
                $this->load->model('Municipio_model');
                $data['all_municipio'] = $this->Municipio_model->get_all();
		   
            $data['page'] = 'Actualizar Empresa';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/empresa_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('empresa'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Emp', TRUE));
        } else {
            $data = array(
		'Nombre_Emp' => ($this->input->post('Nombre_Emp',TRUE) !='') ? $this->input->post('Nombre_Emp',TRUE) : NULL ,
		'DigitoVerificacion_Emp' => ($this->input->post('DigitoVerificacion_Emp',TRUE) !='') ? $this->input->post('DigitoVerificacion_Emp',TRUE) : NULL ,
		'Correo_Emp' => ($this->input->post('Correo_Emp',TRUE) !='') ? $this->input->post('Correo_Emp',TRUE) : NULL ,
		'Direccion_Emp' => ($this->input->post('Direccion_Emp',TRUE) !='') ? $this->input->post('Direccion_Emp',TRUE) : NULL ,
		'Telefono_Emp' => ($this->input->post('Telefono_Emp',TRUE) !='') ? $this->input->post('Telefono_Emp',TRUE) : NULL ,
		'TelCelular_Emp' => ($this->input->post('TelCelular_Emp',TRUE) !='') ? $this->input->post('TelCelular_Emp',TRUE) : NULL ,
		'Nit_Emp' => ($this->input->post('Nit_Emp',TRUE) !='') ? $this->input->post('Nit_Emp',TRUE) : NULL ,
		'Id_Mun' => ($this->input->post('Id_Mun',TRUE) !='') ? $this->input->post('Id_Mun',TRUE) : NULL ,
		'Id_EmpTip' => ($this->input->post('Id_EmpTip',TRUE) !='') ? $this->input->post('Id_EmpTip',TRUE) : NULL ,
		'CodigoIPS_Emp' => ($this->input->post('CodigoIPS_Emp',TRUE) !='') ? $this->input->post('CodigoIPS_Emp',TRUE) : NULL ,
		'CodigoSedeIPS_Emp' => ($this->input->post('CodigoSedeIPS_Emp',TRUE) !='') ? $this->input->post('CodigoSedeIPS_Emp',TRUE) : NULL ,
		'CodigoPrestador_Emp' => ($this->input->post('CodigoPrestador_Emp',TRUE) !='') ? $this->input->post('CodigoPrestador_Emp',TRUE) : NULL ,
		'Sede_Emp' => ($this->input->post('Sede_Emp',TRUE) !='') ? $this->input->post('Sede_Emp',TRUE) : NULL ,
	    );

            $this->Empresa_model->update($this->input->post('Id_Emp', TRUE), $data);
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('empresa'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Empresa_model->get_by_id($id);

        if ($row) {
            $this->Empresa_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('empresa'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('empresa'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	 // $this->form_validation->set_rules('Nombre_Emp', 'nombre emp', 'trim|required');
	 // $this->form_validation->set_rules('DigitoVerificacion_Emp', 'digitoverificacion emp', 'trim|required');
	 // $this->form_validation->set_rules('Correo_Emp', 'correo emp', 'trim|required');
	 // $this->form_validation->set_rules('Direccion_Emp', 'direccion emp', 'trim|required');
	 // $this->form_validation->set_rules('Telefono_Emp', 'telefono emp', 'trim|required');
	 // $this->form_validation->set_rules('TelCelular_Emp', 'telcelular emp', 'trim|required');
	 // $this->form_validation->set_rules('Nit_Emp', 'nit emp', 'trim|required');
	 // $this->form_validation->set_rules('Id_Mun', 'id mun', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_EmpTip', 'id emptip', 'trim|required|numeric');
	 // $this->form_validation->set_rules('CodigoIPS_Emp', 'codigoips emp', 'trim|required');
	 // $this->form_validation->set_rules('CodigoSedeIPS_Emp', 'codigosedeips emp', 'trim|required');
	 // $this->form_validation->set_rules('CodigoPrestador_Emp', 'codigoprestador emp', 'trim|required');
	 // $this->form_validation->set_rules('Sede_Emp', 'sede emp', 'trim|required|numeric');

	$this->form_validation->set_rules('Id_Emp', 'Id_Emp', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "empresa.xls";
        $judul = "empresa";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nombre Emp");
	xlsWriteLabel($tablehead, $kolomhead++, "DigitoVerificacion Emp");
	xlsWriteLabel($tablehead, $kolomhead++, "Correo Emp");
	xlsWriteLabel($tablehead, $kolomhead++, "Direccion Emp");
	xlsWriteLabel($tablehead, $kolomhead++, "Telefono Emp");
	xlsWriteLabel($tablehead, $kolomhead++, "TelCelular Emp");
	xlsWriteLabel($tablehead, $kolomhead++, "Nit Emp");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Mun");
	xlsWriteLabel($tablehead, $kolomhead++, "Id EmpTip");
	xlsWriteLabel($tablehead, $kolomhead++, "CodigoIPS Emp");
	xlsWriteLabel($tablehead, $kolomhead++, "CodigoSedeIPS Emp");
	xlsWriteLabel($tablehead, $kolomhead++, "CodigoPrestador Emp");
	xlsWriteLabel($tablehead, $kolomhead++, "Sede Emp");

	foreach ($this->Empresa_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Nombre_Emp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->DigitoVerificacion_Emp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Correo_Emp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Direccion_Emp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Telefono_Emp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->TelCelular_Emp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Nit_Emp);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_Mun);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_EmpTip);
	    xlsWriteLabel($tablebody, $kolombody++, $data->CodigoIPS_Emp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->CodigoSedeIPS_Emp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->CodigoPrestador_Emp);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Sede_Emp);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=empresa.doc");

        $data = array(
            'empresa_data' => $this->Empresa_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('empresa/empresa_doc',$data);
    }

}

/* End of file Empresa.php */
/* Location: ./application/controllers/Empresa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-06-16 05:13:38 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/