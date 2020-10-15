<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lista_precios extends CI_Controller
{
    var $module = 'Lista_precios';
    var $view = 'lista_precios';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Lista_precios_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $data['page'] = 'Listado de precios';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/lista_precios_list';

 
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
        echo $this->Lista_precios_model->json($search_fields, $links);

        // Para llamar otras vistas, metodo siguiente
        // $columns = 'element 1, element 2, element 3';
        // $find_id = 'pk_element';
        // echo $this->Lista_precios_model->json($search_fields, $links, 'view or table', $columns, $find_id);
    }

    public function read($id) 
    {
        $row = $this->Lista_precios_model->get_by_id($id);
        if ($row) {
            $data = array(
        		'Id_ListPre' => $row->Id_ListPre,
        		'Nombre_ListPre' => $row->Nombre_ListPre,
        		'Estado_ListPre' => $row->Estado_ListPre,
        		'Valor_Incremento' => $row->Valor_Incremento,
        		'Porcentaje_Incremento' => $row->Porcentaje_Incremento,
        		'Primary_Usu' => $row->Primary_Usu,
        	);
            $data['id_update'] = $id;
            $data['page'] = 'Ver detalle de '.$row->Nombre_ListPre;
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/lista_precios_read';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('lista_precios'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Guardar',
            'action' => site_url('lista_precios/create_action'),
    	    'Id_ListPre' => set_value('Id_ListPre'),
    	    'Nombre_ListPre' => set_value('Nombre_ListPre'),
    	    'Estado_ListPre' => set_value('Estado_ListPre', 'Activo'),
    	    'Valor_Incremento' => set_value('Valor_Incremento'),
    	    'Porcentaje_Incremento' => set_value('Porcentaje_Incremento'),
    	    'Primary_Usu' => set_value('Primary_Usu'),
    	);
		   
        $data['page'] = 'Nueva lista de precio';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/lista_precios_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        	    'Id_ListPre' => NULL,
        		'Nombre_ListPre' => validar_post('Nombre_ListPre'), 
        		'Estado_ListPre' => validar_post('Estado_ListPre'), 
        		'Valor_Incremento' => validar_post('Valor_Incremento'), 
        		'Porcentaje_Incremento' => validar_post('Porcentaje_Incremento'), 
        		'Primary_Usu' => $this->session->userdata('Primary_Usu') 
      	    );

            $this->Lista_precios_model->insert($data);
            $this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('lista_precios'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Lista_precios_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Actualizar',
                'action' => site_url('lista_precios/update_action'),
        		'Id_ListPre' => set_value('Id_ListPre', $row->Id_ListPre),
        		'Nombre_ListPre' => set_value('Nombre_ListPre', $row->Nombre_ListPre),
        		'Estado_ListPre' => set_value('Estado_ListPre', $row->Estado_ListPre),
        		'Valor_Incremento' => set_value('Valor_Incremento', $row->Valor_Incremento),
        		'Porcentaje_Incremento' => set_value('Porcentaje_Incremento', $row->Porcentaje_Incremento),
        		// 'Primary_Usu' => set_value('Primary_Usu', $row->Primary_Usu),
        	);
		   
            $data['page'] = 'Actualizar '.$row->Nombre_ListPre;
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/lista_precios_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('lista_precios'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_ListPre', TRUE));
        } else {
            $data = array(
        		'Nombre_ListPre' => validar_post('Nombre_ListPre'), 
        		'Estado_ListPre' => validar_post('Estado_ListPre'), 
        		'Valor_Incremento' => validar_post('Valor_Incremento'), 
        		'Porcentaje_Incremento' => validar_post('Porcentaje_Incremento'), 
        		// 'Primary_Usu' => validar_post('Primary_Usu'), 
        	);

            $this->Lista_precios_model->update($this->input->post('Id_ListPre', TRUE), $data);
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('lista_precios'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Lista_precios_model->get_by_id($id);

        if ($row) {
            $this->Lista_precios_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('lista_precios'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('lista_precios'));
        }
    }

    public function _rules() 
    { 
    //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	    $this->form_validation->set_rules('Nombre_ListPre', 'nombre listpre', 'trim|required');
	    $this->form_validation->set_rules('Estado_ListPre', 'estado listpre', 'trim|required');
	 //   $this->form_validation->set_rules('Valor_Incremento', 'valor incremento', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Porcentaje_Incremento', 'porcentaje incremento', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Primary_Usu', 'primary usu', 'trim|required|numeric');

	$this->form_validation->set_rules('Id_ListPre', 'Id_ListPre', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "lista_precios.xls";
        $judul = "lista_precios";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nombre ListPre");
	xlsWriteLabel($tablehead, $kolomhead++, "Estado ListPre");
	xlsWriteLabel($tablehead, $kolomhead++, "Valor Incremento");
	xlsWriteLabel($tablehead, $kolomhead++, "Porcentaje Incremento");
	xlsWriteLabel($tablehead, $kolomhead++, "Primary Usu");

	foreach ($this->Lista_precios_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Nombre_ListPre);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Estado_ListPre);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Valor_Incremento);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Porcentaje_Incremento);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Primary_Usu);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Lista_precios.php */
/* Location: ./application/controllers/Lista_precios.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-24 01:26:09 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/