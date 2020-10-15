<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bancos extends CI_Controller
{
    var $module = 'Bancos';
    var $view = 'bancos';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Bancos_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $data['page'] = 'Listado de bancos';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/bancos_list';
		
        $this->load->model('Banco_estado_model');
        $data['all_banco_estado'] = $this->Banco_estado_model->get_all();
	
        $this->load->model('Tipo_cuenta_banco_model');
        $data['all_tipo_cuenta_banco'] = $this->Tipo_cuenta_banco_model->get_all();

 
        $this->load->view('layouts/main',$data);
    } 
    
    public function json() {
        // para la busqueda por filtros select y input
        $dataForm = json_decode($this->input->post('filter_dataForm',TRUE));
        $search_fields = array();
        foreach ($dataForm as $value) {
            if ($value->value!='') {
                $find['value'] = $value->value;
                $find['field'] = "bancos.".$value->name;
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
        $joins = array(
            array('banco_estado', 'bancos.Id_BanEst = banco_estado.Id_BanEst', 'LEFT'),
            array('tipo_cuenta_banco', 'bancos.Id_TipCueBan = tipo_cuenta_banco.Id_TipCueBan', 'LEFT')
        );
        // Llamar vista de tabla por defecto
        header('Content-Type: application/json');
        // echo $this->Bancos_model->json($search_fields, $links);

        // Para llamar otras vistas, metodo siguiente
        $columns = 'bancos.Id_Ban, bancos.NombreCuenta_Ban, bancos.NumeroCuenta_Ban, bancos.SaldoInicial_Ban, bancos.FechaBanco, bancos.Descripcion_Ban, bancos.FechaRegistro, bancos.Id_BanEst, bancos.Id_TipCueBan, bancos.Primary_Usu, banco_estado.Nombre_BanEst, tipo_cuenta_banco.Nombre_TipCueBan';

        echo $this->Bancos_model->json($search_fields, $links, 'bancos', $columns, 'Id_Ban', $joins);
    }

    public function read($id) 
    {
        $row = $this->Bancos_model->get_by_id($id);
        if ($row) {
            $data = array(
        		'Id_Ban' => $row->Id_Ban,
        		'NombreCuenta_Ban' => $row->NombreCuenta_Ban,
        		'NumeroCuenta_Ban' => $row->NumeroCuenta_Ban,
        		'SaldoInicial_Ban' => $row->SaldoInicial_Ban,
        		'FechaBanco' => $row->FechaBanco,
        		'Descripcion_Ban' => $row->Descripcion_Ban,
        		'FechaRegistro' => $row->FechaRegistro,
        		'Id_BanEst' => $row->Id_BanEst,
        		'Id_TipCueBan' => $row->Id_TipCueBan,
        		'Primary_Usu' => $row->Primary_Usu,
        	);
            $data['id_update'] = $id;
            $data['page'] = 'Ver detalle';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/bancos_read';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('bancos'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Guardar',
            'action' => site_url('bancos/create_action'),
    	    'Id_Ban' => set_value('Id_Ban'),
    	    'NombreCuenta_Ban' => set_value('NombreCuenta_Ban'),
    	    'NumeroCuenta_Ban' => set_value('NumeroCuenta_Ban'),
    	    'SaldoInicial_Ban' => set_value('SaldoInicial_Ban',0),
    	    'FechaBanco' => set_value('FechaBanco',date('Y-m-d')),
    	    'Descripcion_Ban' => set_value('Descripcion_Ban'),
    	    'FechaRegistro' => set_value('FechaRegistro', date('Y-m-d H:m:s')),
    	    'Id_BanEst' => set_value('Id_BanEst', 1),
    	    'Id_TipCueBan' => set_value('Id_TipCueBan'),
    	    'Primary_Usu' => $this->session->userdata('Primary_Usu'),
    	);
		
        $this->load->model('Banco_estado_model');
        $data['all_banco_estado'] = $this->Banco_estado_model->get_all();

        $this->load->model('Tipo_cuenta_banco_model');
        $data['all_tipo_cuenta_banco'] = $this->Tipo_cuenta_banco_model->get_all();
		   
        $data['page'] = 'Nuevo banco';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/bancos_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
	            'Id_Ban' => NULL,
        		'NombreCuenta_Ban' => validar_post('NombreCuenta_Ban'), 
        		'NumeroCuenta_Ban' => validar_post('NumeroCuenta_Ban'), 
        		'SaldoInicial_Ban' => validar_post('SaldoInicial_Ban'), 
        		'FechaBanco' => validar_post('FechaBanco'), 
        		'Descripcion_Ban' => validar_post('Descripcion_Ban'), 
        		'FechaRegistro' => date('Y-m-d H:m:s'), 
        		'Id_BanEst' => validar_post('Id_BanEst'), 
        		'Id_TipCueBan' => validar_post('Id_TipCueBan'), 
        		'Primary_Usu' => $this->session->userdata('Primary_Usu'), 
	        );

            $this->Bancos_model->insert($data);
            $this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('bancos'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Bancos_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Actualizar',
                'action' => site_url('bancos/update_action'),
        		'Id_Ban' => set_value('Id_Ban', $row->Id_Ban),
        		'NombreCuenta_Ban' => set_value('NombreCuenta_Ban', $row->NombreCuenta_Ban),
        		'NumeroCuenta_Ban' => set_value('NumeroCuenta_Ban', $row->NumeroCuenta_Ban),
        		'SaldoInicial_Ban' => set_value('SaldoInicial_Ban', $row->SaldoInicial_Ban),
        		'FechaBanco' => set_value('FechaBanco', $row->FechaBanco),
        		'Descripcion_Ban' => set_value('Descripcion_Ban', $row->Descripcion_Ban),
        		'FechaRegistro' => set_value('FechaRegistro', $row->FechaRegistro),
        		'Id_BanEst' => set_value('Id_BanEst', $row->Id_BanEst),
        		'Id_TipCueBan' => set_value('Id_TipCueBan', $row->Id_TipCueBan),
        		'Primary_Usu' => $this->session->userdata('Primary_Usu'),
        	 );
		
                $this->load->model('Banco_estado_model');
                $data['all_banco_estado'] = $this->Banco_estado_model->get_all();
		
                $this->load->model('Tipo_cuenta_banco_model');
                $data['all_tipo_cuenta_banco'] = $this->Tipo_cuenta_banco_model->get_all();
		   
            $data['page'] = 'Actualizar banco';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/bancos_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('bancos'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Ban', TRUE));
        } else {
            $data = array(
        		'NombreCuenta_Ban' => validar_post('NombreCuenta_Ban'), 
        		'NumeroCuenta_Ban' => validar_post('NumeroCuenta_Ban'), 
        		'SaldoInicial_Ban' => validar_post('SaldoInicial_Ban'), 
        		'FechaBanco' => validar_post('FechaBanco'), 
        		'Descripcion_Ban' => validar_post('Descripcion_Ban'), 
        		// 'FechaRegistro' => validar_post('FechaRegistro'), 
        		'Id_BanEst' => validar_post('Id_BanEst'), 
        		'Id_TipCueBan' => validar_post('Id_TipCueBan'), 
        		// 'Primary_Usu' => validar_post('Primary_Usu'), 
	        );

            $this->Bancos_model->update($this->input->post('Id_Ban', TRUE), $data);
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('bancos'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Bancos_model->get_by_id($id);

        if ($row) {
            $this->Bancos_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('bancos'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('bancos'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	 // $this->form_validation->set_rules('NombreCuenta_Ban', 'nombrecuenta ban', 'trim|required');
	 // $this->form_validation->set_rules('NumeroCuenta_Ban', 'numerocuenta ban', 'trim|required');
	 // $this->form_validation->set_rules('SaldoInicial_Ban', 'saldoinicial ban', 'trim|required|numeric');
	 // $this->form_validation->set_rules('FechaBanco', 'fechabanco', 'trim|required');
	 // $this->form_validation->set_rules('Descripcion_Ban', 'descripcion ban', 'trim|required');
	 // $this->form_validation->set_rules('FechaRegistro', 'fecharegistro', 'trim|required');
	 // $this->form_validation->set_rules('Id_BanEst', 'id banest', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_TipCueBan', 'id tipcueban', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Primary_Usu', 'primary usu', 'trim|required|numeric');

	$this->form_validation->set_rules('Id_Ban', 'Id_Ban', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "Listado de bancos.xls";
        $judul = "bancos";
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
    	xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("NombreCuenta_Ban")));
        xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("NumeroCuenta_Ban")));
        xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("SaldoInicial_Ban")));
        xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_BanEst")));
        xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_TipCueBan")));
        xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Descripcion_Ban")));
        xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("FechaBanco")));
        xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("FechaRegistro")));

        $joins = array(
            array('banco_estado', 'bancos.Id_BanEst = banco_estado.Id_BanEst', 'LEFT'),
            array('tipo_cuenta_banco', 'bancos.Id_TipCueBan = tipo_cuenta_banco.Id_TipCueBan', 'LEFT')
        );

        // Para llamar otras vistas, metodo siguiente
        $elements = 'bancos.Id_Ban, bancos.NombreCuenta_Ban, bancos.NumeroCuenta_Ban, bancos.SaldoInicial_Ban, bancos.FechaBanco, bancos.Descripcion_Ban, bancos.FechaRegistro, bancos.Id_BanEst, bancos.Id_TipCueBan, bancos.Primary_Usu, banco_estado.Nombre_BanEst, tipo_cuenta_banco.Nombre_TipCueBan';

	    foreach ($this->Bancos_model->get_join($t,$elements, $joins) as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->NombreCuenta_Ban));
    	    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->NumeroCuenta_Ban));
    	    xlsWriteNumber($tablebody, $kolombody++, $data->SaldoInicial_Ban);
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Nombre_BanEst));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Nombre_TipCueBan));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Descripcion_Ban));
    	    xlsWriteLabel($tablebody, $kolombody++, $data->FechaBanco);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->FechaRegistro);

    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Bancos.php */
/* Location: ./application/controllers/Bancos.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-24 01:25:55 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/