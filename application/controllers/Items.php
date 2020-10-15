<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Items extends CI_Controller
{
    var $module = 'Items';
    var $view = 'items';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->model('Items_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $data['page'] = 'Listado de Items';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/items_list';
		
            $this->load->model('Bodegas_model');
            $data['all_bodegas'] = $this->Bodegas_model->get_all();
		
            $this->load->model('Categoria_item_model');
            $data['all_categoria_item'] = $this->Categoria_item_model->get_all();
		
            $this->load->model('Item_estado_model');
            $data['all_item_estado'] = $this->Item_estado_model->get_all();
		
            $this->load->model('Item_tipo_model');
            $data['all_item_tipo'] = $this->Item_tipo_model->get_all();
		
            $this->load->model('Marcas_model');
            $data['all_marcas'] = $this->Marcas_model->get_all();
		
            $this->load->model('Medidas_model');
            $data['all_medidas'] = $this->Medidas_model->get_all();
		
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
        // echo $this->Items_model->json($search_fields, $links);

        // Para llamar otras vistas, metodo siguiente
        $columns = 'Id_Ite, Nombre_Ite, Referencia_Ite, Serie_Ite, FechaRegistro_Ite, Inventariable_Ite, Observacion_Ite, Imagen_Item, Primary_Usu, Nombre_CatIte, Nombre_Mar, Nombre_Med, Valor_Med, Nombre_IteTip, Nombre_IteEst, Nombre_Bod, Id_CatIte, Id_Mar, Id_Med, Id_Usu, Id_IteTip, Id_IteEst, Id_Bod';
        $find_id = 'Id_Ite';
        echo $this->Items_model->json($search_fields, $links, 'vw_items', $columns, $find_id);
    }

    public function read($id) 
    {
        $row = $this->Items_model->get_by_id($id);
        if ($row) {
            $data = array(
        		'Id_Ite' => $row->Id_Ite,
        		'Nombre_Ite' => $row->Nombre_Ite,
        		'Referencia_Ite' => $row->Referencia_Ite,
        		'Serie_Ite' => $row->Serie_Ite,
        		'FechaRegistro_Ite' => $row->FechaRegistro_Ite,
        		'Inventariable_Ite' => $row->Inventariable_Ite,
        		'Observacion_Ite' => $row->Observacion_Ite,
        		'Imagen_Item' => $row->Imagen_Item,
        		'Id_CatIte' => $row->Id_CatIte,
        		'Id_Mar' => $row->Id_Mar,
        		'Id_Med' => $row->Id_Med,
        		'Id_Usu' => $row->Id_Usu,
        		'Id_IteTip' => $row->Id_IteTip,
        		'Id_IteEst' => $row->Id_IteEst,
        		'Id_Bod' => $row->Id_Bod,
        		'Primary_Usu' => $row->Primary_Usu,
    	    );

            $data['id_update'] = $id;
            $data['page'] = 'Ver Items';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/items_read';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('items'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Guardar',
            'action' => site_url('items/create_action'),
    	    'Id_Ite' => set_value('Id_Ite'),
    	    'Nombre_Ite' => set_value('Nombre_Ite'),
    	    'Referencia_Ite' => set_value('Referencia_Ite'),
    	    'Serie_Ite' => set_value('Serie_Ite'),
    	    'FechaRegistro_Ite' => set_value('FechaRegistro_Ite', date('Y-m-d H:m:s')),
    	    'Inventariable_Ite' => set_value('Inventariable_Ite'),
    	    'Observacion_Ite' => set_value('Observacion_Ite'),
    	    'Imagen_Item' => set_value('Imagen_Item'),
    	    'Id_CatIte' => set_value('Id_CatIte'),
    	    'Id_Mar' => set_value('Id_Mar'),
    	    'Id_Med' => set_value('Id_Med'),
    	    'Id_Usu' => $this->session->userdata('Id_Usu'),
    	    'Id_IteTip' => set_value('Id_IteTip'),
    	    'Id_IteEst' => set_value('Id_IteEst', 1),
    	    'Id_Bod' => set_value('Id_Bod'),
            'PrecioVenta' => set_value('PrecioVenta'),
            'Id_ListPre' => set_value('Id_ListPre', []),
            'Id_Imp' => set_value('Id_Imp',[]),
    	    'Primary_Usu' => set_value('Primary_Usu'),
    	);
		    $this->load->model('Lista_precios_model');
            $data['all_lista_precios'] = $this->Lista_precios_model->get_all('*', [], ['Nombre_ListPre'=>'ASC']);

            $this->load->model('Impuestos_model');
            $data['all_impuestos'] = $this->Impuestos_model->get_all();

            $this->load->model('Bodegas_model');
            $data['all_bodegas'] = $this->Bodegas_model->get_all();
	
            $this->load->model('Categoria_item_model');
            $data['all_categoria_item'] = $this->Categoria_item_model->get_all();
	
            $this->load->model('Item_estado_model');
            $data['all_item_estado'] = $this->Item_estado_model->get_all();
	
            $this->load->model('Item_tipo_model');
            $data['all_item_tipo'] = $this->Item_tipo_model->get_all();
	
            $this->load->model('Marcas_model');
            $data['all_marcas'] = $this->Marcas_model->get_all();
	
            $this->load->model('Medidas_model');
            $data['all_medidas'] = $this->Medidas_model->get_all();
	
            $this->load->model('Usuario_model');
            $data['all_usuario'] = $this->Usuario_model->get_all();
		   
        $data['page'] = 'Nuevo item';
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/items_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        	    'Id_Ite' => NULL,
        		'Nombre_Ite' => validar_post('Nombre_Ite'), 
        		'Referencia_Ite' => validar_post('Referencia_Ite'), 
        		'Serie_Ite' => validar_post('Serie_Ite'), 
        		'FechaRegistro_Ite' => date('Y-m-d H:m:s'), 
        		'Inventariable_Ite' => validar_post('Inventariable_Ite'), 
        		'Observacion_Ite' => validar_post('Observacion_Ite'), 
        		'Imagen_Item' => validar_post('Imagen_Item'), 
        		'Id_CatIte' => validar_post('Id_CatIte'), 
        		'Id_Mar' => validar_post('Id_Mar'), 
        		'Id_Med' => validar_post('Id_Med'), 
        		'Id_Usu' => validar_post('Id_Usu'), 
        		'Id_IteTip' => validar_post('Id_IteTip'), 
        		'Id_IteEst' => validar_post('Id_IteEst'), 
        		'Id_Bod' => validar_post('Id_Bod'), 
        		'Primary_Usu' =>  $this->session->userdata('Primary_Usu'), 
        	);
            $Id_Ite = $this->Items_model->insert($data);

            // Impuestos
            $Impuesto = validar_post('Id_Imp');
            if (count($Impuesto)>0) {
                $this->load->model('Impuestos_items_model');
                foreach ($Impuesto as $value) {
                    $data_impuesto = array(
                        'Id_Ite' => $Id_Ite,
                        'Id_Imp' => $value
                    );
                    $this->Impuestos_items_model->insert($data_impuesto);
                }
            }

            // Precios de venta
            $PrecioVenta = validar_post('PrecioVenta');
            $Id_ListPre = validar_post('Id_ListPre');
            if (count($PrecioVenta)>0) {
                $this->load->model('Precios_item_model');
                $k = 0;
                while ($k < count($PrecioVenta)) {
                    if ($PrecioVenta[$k] != '') {
                        $data = array(
                            // 'Id_ListPre' => $Id_Ite,
                            'Id_ListPre' =>$Id_ListPre[$k],
                            'Id_Ite' =>$Id_Ite,
                            'PrecioVenta' =>$PrecioVenta[$k],
                            'Primary_Usu' =>$this->session->userdata('Primary_Usu')
                        );
                        $this->Precios_item_model->insert($data);
                    }
                    $k++;
                }
            }
                

            $this->session->set_flashdata('message', 'Registro creado exitosamente');
            redirect(site_url('items'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Items_model->get_by_id($id);

        if ($row) {
            $this->load->model('Impuestos_items_model');
            $rs = $this->Impuestos_items_model->get_all('Id_Imp',['Id_Ite'=>$row->Id_Ite]);
            $impuesto = array();
            if ($rs) {
                foreach ($rs as $r) {
                    array_push($impuesto, $r->Id_Imp);
                }
            }
            $this->load->model('Precios_item_model');
            $rsp = $this->Precios_item_model->get_all('Id_ListPre, PrecioVenta', ['Id_Ite'=>$row->Id_Ite]);
            $precios = array();
            if ($rsp) {
                foreach ($rsp as $r) {
                    array_push($precios, get_object_vars($r));
                }
            }
            $data = array(
                'button' => 'Actualizar',
                'action' => site_url('items/update_action'),
        		'Id_Ite' => set_value('Id_Ite', $row->Id_Ite),
        		'Nombre_Ite' => set_value('Nombre_Ite', $row->Nombre_Ite),
        		'Referencia_Ite' => set_value('Referencia_Ite', $row->Referencia_Ite),
        		'Serie_Ite' => set_value('Serie_Ite', $row->Serie_Ite),
        		'FechaRegistro_Ite' => set_value('FechaRegistro_Ite', $row->FechaRegistro_Ite),
        		'Inventariable_Ite' => set_value('Inventariable_Ite', $row->Inventariable_Ite),
        		'Observacion_Ite' => set_value('Observacion_Ite', $row->Observacion_Ite),
        		'Imagen_Item' => set_value('Imagen_Item', $row->Imagen_Item),
        		'Id_CatIte' => set_value('Id_CatIte', $row->Id_CatIte),
        		'Id_Mar' => set_value('Id_Mar', $row->Id_Mar),
        		'Id_Med' => set_value('Id_Med', $row->Id_Med),
        		'Id_Usu' => set_value('Id_Usu', $row->Id_Usu),
        		'Id_IteTip' => set_value('Id_IteTip', $row->Id_IteTip),
        		'Id_IteEst' => set_value('Id_IteEst', $row->Id_IteEst),
        		'Id_Bod' => set_value('Id_Bod', $row->Id_Bod),
                'Id_ListPre' => set_value('Id_ListPre', $precios),
                'Id_Imp' => set_value('Id_Imp', $impuesto),
        		'Primary_Usu' => set_value('Primary_Usu', $row->Primary_Usu),
        	);
            $this->load->model('Lista_precios_model');
            $data['all_lista_precios'] = $this->Lista_precios_model->get_all('*', [], ['Nombre_ListPre'=>'ASC']);

            $this->load->model('Impuestos_model');
            $data['all_impuestos'] = $this->Impuestos_model->get_all();

		
                $this->load->model('Bodegas_model');
                $data['all_bodegas'] = $this->Bodegas_model->get_all();
		
                $this->load->model('Categoria_item_model');
                $data['all_categoria_item'] = $this->Categoria_item_model->get_all();
		
                $this->load->model('Item_estado_model');
                $data['all_item_estado'] = $this->Item_estado_model->get_all();
		
                $this->load->model('Item_tipo_model');
                $data['all_item_tipo'] = $this->Item_tipo_model->get_all();
		
                $this->load->model('Marcas_model');
                $data['all_marcas'] = $this->Marcas_model->get_all();
		
                $this->load->model('Medidas_model');
                $data['all_medidas'] = $this->Medidas_model->get_all();
		
                $this->load->model('Usuario_model');
                $data['all_usuario'] = $this->Usuario_model->get_all();
		   
            $data['page'] = 'Actualizar Items ['.$row->Nombre_Ite.']';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/items_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('items'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Ite', TRUE));
        } else {
            $data = array(
        		'Nombre_Ite' => validar_post('Nombre_Ite'), 
        		'Referencia_Ite' => validar_post('Referencia_Ite'), 
        		'Serie_Ite' => validar_post('Serie_Ite'), 
        		// 'FechaRegistro_Ite' => validar_post('FechaRegistro_Ite'), 
        		'Inventariable_Ite' => validar_post('Inventariable_Ite'), 
        		'Observacion_Ite' => validar_post('Observacion_Ite'), 
        		'Imagen_Item' => validar_post('Imagen_Item'), 
        		'Id_CatIte' => validar_post('Id_CatIte'), 
        		'Id_Mar' => validar_post('Id_Mar'), 
        		'Id_Med' => validar_post('Id_Med'), 
        		'Id_Usu' => validar_post('Id_Usu'), 
        		'Id_IteTip' => validar_post('Id_IteTip'), 
        		'Id_IteEst' => validar_post('Id_IteEst'), 
        		'Id_Bod' => validar_post('Id_Bod'), 
        		// 'Primary_Usu' => validar_post('Primary_Usu'), 
        	);
            $Id_Ite = $this->Items_model->update(validar_post('Id_Ite'), $data);

            // Impuestos
            $Impuesto = validar_post('Id_Imp');

            $this->load->model('Impuestos_items_model');
            $this->Impuestos_items_model->delete(NULL, ['Id_Ite'=>$Id_Ite]);

            if (count($Impuesto)>0) {
                foreach ($Impuesto as $value) {
                    $data_impuesto = array(
                        'Id_Ite' => $Id_Ite,
                        'Id_Imp' => $value
                    );
                    $this->Impuestos_items_model->insert($data_impuesto);
                }
            }

            // Precios de venta
            $PrecioVenta = validar_post('PrecioVenta');
            $Id_ListPre = validar_post('Id_ListPre');

            $this->load->model('Precios_item_model');
            $this->Precios_item_model->delete(NULL, ['Id_Ite'=>$Id_Ite]);

            if (count($PrecioVenta)>0) {
                $k = 0;
                while ($k < count($PrecioVenta)) {
                    if ($PrecioVenta[$k] != '') {
                        $data = array(
                            // 'Id_ListPre' => $Id_Ite,
                            'Id_ListPre' =>$Id_ListPre[$k],
                            'Id_Ite' =>$Id_Ite,
                            'PrecioVenta' =>$PrecioVenta[$k],
                            'Primary_Usu' =>$this->session->userdata('Primary_Usu')
                        );
                        $this->Precios_item_model->insert($data);
                    }
                    $k++;
                }
            }

            
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('items'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Items_model->get_by_id($id);

        if ($row) {
            $this->Items_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('items'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('items'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	    $this->form_validation->set_rules('Nombre_Ite', 'nombre ite', 'trim|required');
	 // $this->form_validation->set_rules('Referencia_Ite', 'referencia ite', 'trim|required');
	 // $this->form_validation->set_rules('Serie_Ite', 'serie ite', 'trim|required');
	 // $this->form_validation->set_rules('FechaRegistro_Ite', 'fecharegistro ite', 'trim|required');
	 // $this->form_validation->set_rules('Inventariable_Ite', 'inventariable ite', 'trim|required');
	 // $this->form_validation->set_rules('Observacion_Ite', 'observacion ite', 'trim|required');
	 // $this->form_validation->set_rules('Imagen_Item', 'imagen item', 'trim|required');
	 // $this->form_validation->set_rules('Id_CatIte', 'id catite', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Mar', 'id mar', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Med', 'id med', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Usu', 'id usu', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_IteTip', 'id itetip', 'trim|required|numeric');
	    $this->form_validation->set_rules('Id_IteEst', 'id iteest', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Bod', 'id bod', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Primary_Usu', 'primary usu', 'trim|required|numeric');

	$this->form_validation->set_rules('Id_Ite', 'Id_Ite', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "items.xls";
        $judul = "items";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "Nombre Ite");
    	xlsWriteLabel($tablehead, $kolomhead++, "Referencia Ite");
    	xlsWriteLabel($tablehead, $kolomhead++, "Serie Ite");
    	xlsWriteLabel($tablehead, $kolomhead++, "FechaRegistro Ite");
    	xlsWriteLabel($tablehead, $kolomhead++, "Inventariable Ite");
    	xlsWriteLabel($tablehead, $kolomhead++, "Observacion Ite");
    	xlsWriteLabel($tablehead, $kolomhead++, "Imagen Item");
    	xlsWriteLabel($tablehead, $kolomhead++, "Id CatIte");
    	xlsWriteLabel($tablehead, $kolomhead++, "Id Mar");
    	xlsWriteLabel($tablehead, $kolomhead++, "Id Med");
    	xlsWriteLabel($tablehead, $kolomhead++, "Id Usu");
    	xlsWriteLabel($tablehead, $kolomhead++, "Id IteTip");
    	xlsWriteLabel($tablehead, $kolomhead++, "Id IteEst");
    	xlsWriteLabel($tablehead, $kolomhead++, "Id Bod");
    	xlsWriteLabel($tablehead, $kolomhead++, "Primary Usu");

	   foreach ($this->Items_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->Nombre_Ite);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->Referencia_Ite);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->Serie_Ite);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->FechaRegistro_Ite);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->Inventariable_Ite);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->Observacion_Ite);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->Imagen_Item);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_CatIte);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_Mar);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_Med);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_Usu);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_IteTip);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_IteEst);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->Id_Bod);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->Primary_Usu);

    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Items.php */
/* Location: ./application/controllers/Items.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-24 01:26:06 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/