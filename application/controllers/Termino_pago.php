<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Termino_pago extends CI_Controller
{
    var $module = 'Termino_pago';
    var $view = 'termino_pago';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Termino_pago_model');
        $this->load->library('form_validation');        
		$this->load->library('datatables');
    }

    public function index()
    {
        $data['page'] = 'Términos de pago';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/termino_pago_list';

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
        echo $this->Termino_pago_model->json($search_fields, $links);

        // Para llamar otras vistas, metodo siguiente
        // $columns = 'element 1, element 2, element 3';
        // $find_id = 'pk_element';
        // echo $this->Termino_pago_model->json($search_fields, $links, 'view or table', $columns, $find_id);
    }

    public function read($id) 
    {
        $row = $this->Termino_pago_model->get_by_id($id);
        if ($row) {
            $data = array(
				'Id_TerPag' => $row->Id_TerPag,
				'Nombre_TerPag' => $row->Nombre_TerPag,
				'Dias_TerPag' => $row->Dias_TerPag,
				'Estado_TerPag' => $row->Estado_TerPag,
				'FechaRegistro_TerPag' => $row->FechaRegistro_TerPag,
				'Primary_Usu' => $row->Primary_Usu,
		    );
            $data['id_update'] = $id;
            $data['page'] = 'Ver detalle ['.$row->Nombre_TerPag.']';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/termino_pago_read';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('termino_pago'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Guardar',
            'action' => site_url('termino_pago/create_action'),
		    'Id_TerPag' => set_value('Id_TerPag'),
		    'Nombre_TerPag' => set_value('Nombre_TerPag'),
		    'Dias_TerPag' => set_value('Dias_TerPag'),
		    'Estado_TerPag' => set_value('Estado_TerPag', 'Activo'),
		    'FechaRegistro_TerPag' => set_value('FechaRegistro_TerPag', date('Y-m-d H:m:s')),
		    'Primary_Usu' => set_value('Primary_Usu'),
		);
		   
        $data['page'] = 'Nuevo término de pago';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/termino_pago_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'Id_TerPag' => NULL,
				'Nombre_TerPag' => validar_post('Nombre_TerPag'), 
				'Dias_TerPag' => validar_post('Dias_TerPag'), 
				'Estado_TerPag' => validar_post('Estado_TerPag'), 
				'FechaRegistro_TerPag' => date('Y-m-d H:m:s'), 
				'Primary_Usu' => $this->session->userdata('Primary_Usu') 
			);

            $this->Termino_pago_model->insert($data);
            $this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('termino_pago'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Termino_pago_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Actualizar',
                'action' => site_url('termino_pago/update_action'),
				'Id_TerPag' => set_value('Id_TerPag', $row->Id_TerPag),
				'Nombre_TerPag' => set_value('Nombre_TerPag', $row->Nombre_TerPag),
				'Dias_TerPag' => set_value('Dias_TerPag', $row->Dias_TerPag),
				'Estado_TerPag' => set_value('Estado_TerPag', $row->Estado_TerPag),
				'FechaRegistro_TerPag' => set_value('FechaRegistro_TerPag', $row->FechaRegistro_TerPag),
				'Primary_Usu' => set_value('Primary_Usu', $row->Primary_Usu),
			);
		   
            $data['page'] = 'Actualizar Termino_pago';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/termino_pago_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('termino_pago'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_TerPag', TRUE));
        } else {
            $data = array(
				'Nombre_TerPag' => validar_post('Nombre_TerPag'), 
				'Dias_TerPag' => validar_post('Dias_TerPag'), 
				'Estado_TerPag' => validar_post('Estado_TerPag'), 
				// 'FechaRegistro_TerPag' => validar_post('FechaRegistro_TerPag'), 
				// 'Primary_Usu' => validar_post('Primary_Usu'), 
		    );

            $this->Termino_pago_model->update($this->input->post('Id_TerPag', TRUE), $data);
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('termino_pago'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Termino_pago_model->get_by_id($id);

        if ($row) {
            $this->Termino_pago_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('termino_pago'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('termino_pago'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	 // $this->form_validation->set_rules('Nombre_TerPag', 'nombre terpag', 'trim|required');
	 // $this->form_validation->set_rules('Dias_TerPag', 'dias terpag', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Estado_TerPag', 'estado terpag', 'trim|required');
	 // $this->form_validation->set_rules('FechaRegistro_TerPag', 'fecharegistro terpag', 'trim|required');
	 // $this->form_validation->set_rules('Primary_Usu', 'primary usu', 'trim|required|numeric');

	$this->form_validation->set_rules('Id_TerPag', 'Id_TerPag', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "Listado de terminos  de pago.xls";
        $judul = "termino_pago";
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
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Nombre_TerPag")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Dias_TerPag")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Estado_TerPag")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("FechaRegistro_TerPag")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Primary_Usu")));

	foreach ($this->Termino_pago_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Nombre_TerPag));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Dias_TerPag));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Estado_TerPag));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->FechaRegistro_TerPag));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Primary_Usu));

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Termino_pago.php */
/* Location: ./application/controllers/Termino_pago.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-31 22:18:39 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/