<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cuentas extends CI_Controller
{
    var $module = 'Cuentas';
    var $view = 'cuentas';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Cuentas_model');
        $this->load->library('form_validation');        
		$this->load->library('datatables');
    }

    public function index()
    {
        $data['page'] = 'Catalogo de cuentas';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/cuentas_list';
	
        $this->load->model('Cuenta_estado_model');
        $data['all_cuenta_estado'] = $this->Cuenta_estado_model->get_all();
	
        $this->load->model('Cuenta_tipo_model');
        $data['all_cuenta_tipo'] = $this->Cuenta_tipo_model->get_all();
	
        $this->load->model('Cuentas_model');
        $data['all_cuentas'] = $this->Cuentas_model->get_all();
	
        $this->load->model('Naturaleza_cuenta_model');
        $data['all_naturaleza_cuenta'] = $this->Naturaleza_cuenta_model->get_all();

        $this->load->view('layouts/main',$data);
    } 
    
    public function json() {
        // para la busqueda por filtros select y input
        $dataForm = json_decode($this->input->post('filter_dataForm',TRUE));
        $search_fields = array();
        foreach ($dataForm as $value) {
            if ($value->value!='') {
                $find['value'] = $value->value;
                $find['field'] = $this->view.".".$value->name;
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
        // echo $this->Cuentas_model->json($search_fields, $links);

        // Para llamar otras vistas, metodo siguiente
        $columns = 'cuentas.Id_Cue, cuentas.Nombre_Cue, cuentas.Cuenta_Cue, cuentas.Consecutivo_Cue, cuentas.FechaRegistro_Cue, naturaleza_cuenta.Nombre_NatCue AS Id_NatCue, cuenta_estado.Nombre_CueEst AS Id_CueEst, cuenta_tipo.Nombre_CueTip AS Id_CueTip, padre.Cuenta_Cue AS Id_Cue_CuentaPadre';
        $find_id = 'Id_Cue';
        $JOIN = array(
            array('naturaleza_cuenta', 'cuentas.Id_NatCue = naturaleza_cuenta.Id_NatCue','INNER'),
            array('cuenta_estado', 'cuentas.Id_CueEst = cuenta_estado.Id_CueEst','INNER'),
            array('cuenta_tipo', 'cuentas.Id_CueTip = cuenta_tipo.Id_CueTip','INNER'),
            array('cuentas AS padre', 'cuentas.Id_Cue_CuentaPadre = padre.Id_Cue','INNER')
        );
        echo $this->Cuentas_model->json($search_fields, $links, 'cuentas', $columns, $find_id, $JOIN);
    }

    public function read($id) 
    {
        $row = $this->Cuentas_model->get_foreing_by_id($id,'*');
        // ver_array($row);
        if ($row) {
            $data = array(
				'Id_Cue' => $row->Id_Cue,
				'Nombre_Cue' => $row->Nombre_Cue,
				'Cuenta_Cue' => $row->Cuenta_Cue,
				'Consecutivo_Cue' => $row->Consecutivo_Cue,
				'FechaRegistro_Cue' => $row->FechaRegistro_Cue,
				'Id_NatCue' => $row->Nombre_NatCue,
				'Id_CueEst' => $row->Nombre_CueEst,
				'Id_CueTip' => $row->Nombre_CueTip,
				'Id_Cue_CuentaPadre' => $row->Id_Cue_CuentaPadre
		    );

            $this->load->model('Cuentas_model');
            $data['all_cuentas'] = $this->Cuentas_model->get_all();

            $data['id_update'] = $id;
            $data['page'] = 'Ver cuenta ['.$row->Nombre_Cue.']';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/cuentas_read';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('cuentas'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Guardar',
            'action' => site_url('cuentas/create_action'),
		    'Id_Cue' => set_value('Id_Cue'),
		    'Nombre_Cue' => set_value('Nombre_Cue'),
		    'Cuenta_Cue' => set_value('Cuenta_Cue'),
		    'Consecutivo_Cue' => set_value('Consecutivo_Cue'),
		    'FechaRegistro_Cue' => set_value('FechaRegistro_Cue', date('Y-m-d H:m:s')),
		    'Id_NatCue' => set_value('Id_NatCue'),
		    'Id_CueEst' => set_value('Id_CueEst', 1),
		    'Id_CueTip' => set_value('Id_CueTip'),
		    'Id_Cue_CuentaPadre' => set_value('Id_Cue_CuentaPadre'),
		    'Primary_Usu' => set_value('Primary_Usu'),
		);
	
        $this->load->model('Cuenta_estado_model');
        $data['all_cuenta_estado'] = $this->Cuenta_estado_model->get_all();
	
        $this->load->model('Cuenta_tipo_model');
        $data['all_cuenta_tipo'] = $this->Cuenta_tipo_model->get_all();
	
        $this->load->model('Cuentas_model');
        $data['all_cuentas'] = $this->Cuentas_model->get_all();
	
        $this->load->model('Naturaleza_cuenta_model');
        $data['all_naturaleza_cuenta'] = $this->Naturaleza_cuenta_model->get_all();
		   
        $data['page'] = 'Nueva cuenta';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/cuentas_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'Id_Cue' => NULL,
				'Nombre_Cue' => validar_post('Nombre_Cue'), 
				'Cuenta_Cue' => validar_post('Cuenta_Cue'), 
				'Consecutivo_Cue' => validar_post('Consecutivo_Cue'), 
				'FechaRegistro_Cue' => date('Y-m-d H:m:s'), 
				'Id_NatCue' => validar_post('Id_NatCue'), 
				'Id_CueEst' => validar_post('Id_CueEst'), 
				'Id_CueTip' => validar_post('Id_CueTip'), 
				'Id_Cue_CuentaPadre' => validar_post('Id_Cue_CuentaPadre'), 
				'Primary_Usu' => $this->session->userdata('Primary_Usu') 
			);

            $this->Cuentas_model->insert($data);
            $this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('cuentas'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Cuentas_model->get_by_id($id);
        redirect(site_url('cuentas'));
        
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('cuentas/update_action'),
				'Id_Cue' => set_value('Id_Cue', $row->Id_Cue),
				'Nombre_Cue' => set_value('Nombre_Cue', $row->Nombre_Cue),
				'Cuenta_Cue' => set_value('Cuenta_Cue', $row->Cuenta_Cue),
				'Consecutivo_Cue' => set_value('Consecutivo_Cue', $row->Consecutivo_Cue),
				'FechaRegistro_Cue' => set_value('FechaRegistro_Cue', $row->FechaRegistro_Cue),
				'Id_NatCue' => set_value('Id_NatCue', $row->Id_NatCue),
				'Id_CueEst' => set_value('Id_CueEst', $row->Id_CueEst),
				'Id_CueTip' => set_value('Id_CueTip', $row->Id_CueTip),
				'Id_Cue_CuentaPadre' => set_value('Id_Cue_CuentaPadre', $row->Id_Cue_CuentaPadre),
				'Primary_Usu' => set_value('Primary_Usu', $row->Primary_Usu),
			);
	
            $this->load->model('Cuenta_estado_model');
            $data['all_cuenta_estado'] = $this->Cuenta_estado_model->get_all();
	
            $this->load->model('Cuenta_tipo_model');
            $data['all_cuenta_tipo'] = $this->Cuenta_tipo_model->get_all();
	
            $this->load->model('Cuentas_model');
            $data['all_cuentas'] = $this->Cuentas_model->get_all();
	
            $this->load->model('Naturaleza_cuenta_model');
            $data['all_naturaleza_cuenta'] = $this->Naturaleza_cuenta_model->get_all();
		   
            $data['page'] = 'Actualizar Cuentas';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/cuentas_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('cuentas'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Cue', TRUE));
        } else {
            $data = array(
				'Nombre_Cue' => validar_post('Nombre_Cue'), 
				'Cuenta_Cue' => validar_post('Cuenta_Cue'), 
				'Consecutivo_Cue' => validar_post('Consecutivo_Cue'), 
				// 'FechaRegistro_Cue' => validar_post('FechaRegistro_Cue'), 
				'Id_NatCue' => validar_post('Id_NatCue'), 
				'Id_CueEst' => validar_post('Id_CueEst'), 
				'Id_CueTip' => validar_post('Id_CueTip'), 
				'Id_Cue_CuentaPadre' => validar_post('Id_Cue_CuentaPadre'), 
				// 'Primary_Usu' => validar_post('Primary_Usu'), 
		    );

            $this->Cuentas_model->update($this->input->post('Id_Cue', TRUE), $data);
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('cuentas'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Cuentas_model->get_by_id($id);

        if ($row) {
            $this->Cuentas_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('cuentas'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('cuentas'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	 // $this->form_validation->set_rules('Nombre_Cue', 'nombre cue', 'trim|required');
	 // $this->form_validation->set_rules('Cuenta_Cue', 'cuenta cue', 'trim|required');
	 // $this->form_validation->set_rules('Consecutivo_Cue', 'consecutivo cue', 'trim|required');
	 // $this->form_validation->set_rules('FechaRegistro_Cue', 'fecharegistro cue', 'trim|required');
	 // $this->form_validation->set_rules('Id_NatCue', 'id natcue', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_CueEst', 'id cueest', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_CueTip', 'id cuetip', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Cue_CuentaPadre', 'id cue cuentapadre', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Primary_Usu', 'primary usu', 'trim|required|numeric');

	$this->form_validation->set_rules('Id_Cue', 'Id_Cue', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "Listado de cuentas.xls";
        $judul = "cuentas";
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
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Nombre_Cue")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Cuenta_Cue")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Consecutivo_Cue")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("FechaRegistro_Cue")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_NatCue")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_CueEst")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_CueTip")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_Cue_CuentaPadre")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Primary_Usu")));

	foreach ($this->Cuentas_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Nombre_Cue));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Cuenta_Cue));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Consecutivo_Cue));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->FechaRegistro_Cue));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Id_NatCue));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Id_CueEst));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Id_CueTip));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Id_Cue_CuentaPadre));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Primary_Usu));

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
    public function categoryTree($parent_id = 1, $sub_mark = ''){
        $cuentas = $this->Cuentas_model->get_all('*', ['Id_Cue_CuentaPadre'=>$parent_id], ['Cuenta_Cue'=>'ASC']);
        if ($cuentas) {
            foreach ($cuentas as $v) {
                echo "<option value='".$v->Id_Cue."'>".$v->Cuenta_Cue."</option>";
                categoryTree($v->Id_Cue, $sub_mark.'---');
            }
        }
        /*
        $query = $db->query("SELECT * FROM categories WHERE parent_id = $parent_id ORDER BY name ASC");
       
        if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
                echo '<option value="'.$row['id'].'">'.$sub_mark.$row['name'].'</option>';
                categoryTree($row['id'], $sub_mark.'---');
            }
        } */
    }
    

}

/* End of file Cuentas.php */
/* Location: ./application/controllers/Cuentas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-31 22:12:05 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/