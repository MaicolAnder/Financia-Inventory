<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Documento extends CI_Controller
{
    var $module = 'Documento';
    var $view = 'documento';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        validar_numeracion_documentos();
        $this->load->model('Documento_model');
        $this->load->model('Kardex_model');
        $this->load->model('Items_model');
        $this->load->model('Impuestos_kardex_model');
        $this->load->library('form_validation');        
		$this->load->library('datatables');
    }
    public function index(){
        redirect();
    }

    public function listar($type=NULL)
    {
        switch ($type) {
            case 'income':
                // Ingresos
                $name = "venta";
                $Id_DocTip = 1;
                break;
            case 'expenses':
                // egresos
                $name = "compra";
                $Id_DocTip = 2;
                break;
            case 'quotes':
                // cotizaciones
                $name = "cotizaciones";
                $Id_DocTip = 6;
                break;
            case 'referrals':
                // remisiones
                $name = "remisiones";
                $Id_DocTip = 5;
                break;
            case 'purchase_order':
                // Orden de compra
                $name = "órdenes de compra";
                $Id_DocTip = 7;
                break;
            default:
                redirect();
                break;
        }
        // $Id_DocTip = ($type == 'income') ? 1 : 2 ;
        $data['type'] = $type;
        $data['page'] = 'Listado de '.$name;
        $data['module']= $this->module;
        $data['Id_DocTip'] = $Id_DocTip;
        $data['_view'] = $this->view.'/documento_list';
	
        $this->load->model('Documento_estado_model');
        $data['all_documento_estado'] = $this->Documento_estado_model->get_all('*', [], ['Nombre_DocEst'=>'ASC']);
	
        $this->load->model('Documento_tipo_model');
        $data['all_documento_tipo'] = $this->Documento_tipo_model->get_all('*', ['Id_DocTip'=>$Id_DocTip]);
	
        $this->load->model('Persona_model');
        $data['all_persona'] = $this->Persona_model->get_all();
	
        $this->load->model('Termino_pago_model');
        $data['all_termino_pago'] = $this->Termino_pago_model->get_all();
	
        $this->load->model('Usuario_model');
        $data['all_usuario'] = $this->Usuario_model->get_all();

        $this->load->view('layouts/main',$data);
    }
    public function json($type = NULL) {
        switch ($type) {
            case 'income':
                // Ingresos
                $name = "venta";
                $Id_DocTip = 1;
                break;
            case 'expenses':
                // egresos
                $name = "compra";
                $Id_DocTip = 2;
                break;
            case 'quotes':
                $name = "cotización";
                $Id_DocTip = 6;
                break;
            case 'referrals':
                $name = "remisión";
                $Id_DocTip = 5;
                break;
            case 'purchase_order':
                $name = "órden de compra";
                $Id_DocTip = 7;
                break;
            default:
                redirect();
                break;
        }
        $where = array(
                    array('field'=>'Id_DocTip', 'value'=>$Id_DocTip ),
                    array('field'=>'Primary_Usu', 'value'=>$this->session->userdata('Primary_Usu') )
                );

        $this->load->model('Datatable_model');
        $columns = 'Id_Doc, Contacto, Identificacion_Per, Id_Per, FechaRegistro_Doc, Numero_Doc, FechaDocumento_Doc, FechaVencimiento_Doc, IvaIncluido_Doc, Usuario_Usu, Nombre_DocTip, Nombre_DocEst, Nombre_TerPag, Dias_TerPag';
        $result = $this->Datatable_model->start_datatable($columns, 'vw_documento', $totalData, $totalFiltered, $where); // Iniciar datatable
        $data = array();
        if(!empty($result))
        {
            foreach ($result as $c => $rs)
            {
                // echo $rs->Id_DocEst;
                switch ($rs->Id_DocEst) {
                    case '1':
                        $color = "info";
                        $pago = '<a href="'.site_url('transacciones/create/'.$type.'/'.$rs->Id_Doc).'" class="btn btn-warning" title="Pagar documento"><i class="fas fa-cash-register"></i></a>';
                        $actualizar = '<a href="'.site_url($this->view.'/update/'.$rs->Id_Doc).'" class="btn btn-primary2" title="Editar documento"><i class="fas fa-pencil-alt"></i></a>';
                        $actualizar =  '<a class="dropdown-item" href="'.site_url($this->view.'/update/'.$rs->Id_Doc).'"><i class="fas fa-pencil-alt"></i> Modificar</a>';
                        $imprimir = false;
                        $anular = true;
                        $cancelar = false;
                        break;
                    case '2':
                    // Inactivo
                        $color = "secondary";
                        $pago = "";
                        $actualizar = $actualizar =  '<a class="dropdown-item disabled" href="#"><i class="fas fa-pencil-alt"></i> Modificar</a>';
                        $imprimir = false;
                        $anular = false;
                        $cancelar = false;
                        break;
                    case '3':
                    // Anular
                        $color = "warning";
                        $pago = "";
                        $actualizar =  '<a class="dropdown-item disabled" href="#"><i class="fas fa-pencil-alt"></i> Modificar</a>';
                        $imprimir = false;
                        $anular = false;
                        $cancelar = false;
                        break;
                    case '4':
                        $color = "danger";
                        $pago = "";
                        $actualizar =  '<a class="dropdown-item disabled" href="#"><i class="fas fa-pencil-alt"></i> Modificar</a>';
                        $imprimir = false;
                        $anular = false;
                        $cancelar = false;
                        break;
                    case '5':
                    // Pagado
                        $color = "success";
                        $pago = '<i class="far fa-check-circle color-success fa-lg"></i>';
                        $actualizar =  '<a class="dropdown-item disabled" href="#"><i class="fas fa-pencil-alt"></i> Modificar</a>';
                        $imprimir = true;
                        $anular = false;
                        $cancelar = true;
                        break;
                    case '6':
                    // Por pagar
                        $color = "default background-color-primary";
                        $pago = '<a href="'.site_url('transacciones/create/'.$type.'/'.$rs->Id_Doc).'" class="btn btn-warning" title="Documento por pagar"><i class="fas fa-cash-register"></i></a>';
                        $actualizar =  '<a class="dropdown-item disabled" href="#"><i class="fas fa-pencil-alt"></i> Modificar</a>';
                        $imprimir = false;
                        $anular = false;
                        $cancelar = true;
                        break;
                    
                    default:
                        $color = "light";
                        $pago = "";
                        $actualizar =  '<a class="dropdown-item disabled" href="#"><i class="fas fa-pencil-alt"></i> Modificar</a>';
                        $imprimir = false;
                        $anular = false;
                        $cancelar = false;
                        break;
                }

                // Sub menu de opciones
                $menu_imprimir = ($imprimir)?'<a class="dropdown-item" href="#"><i class="fas fa-print"></i> Imprimir</a>':'<a class="dropdown-item disabled" href="#"><i class="fas fa-print"></i> Imprimir</a>';
                $menu_anular = ($anular)?'<a class="dropdown-item" href="'.site_url('documento/anular/'.$rs->Id_Doc).'"><i class="fas fa-ban"></i> Anular</a>':'<a class="dropdown-item disabled" href="#"><i class="fas fa-ban"></i> Anular</a>';
                $menu_cancelar = ($cancelar)?'<a class="dropdown-item" href="#"><i class="fas fa-times-circle"></i> Cancelar</a>':'<a class="dropdown-item disabled" href="#"><i class="fas fa-times-circle"></i> Cancelar</a>';

                // Crear sub menu
                $options = '<div class="btn-group dropright" >
                    <button type="button" class="btn btn-primary dropdown-toggle" title="Menú de opciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu">
                       '.$actualizar.'
                        <a class="dropdown-item" href="'.site_url($this->view.'/read/'.$rs->Id_Doc).'"><i class="fas fa-search"></i> Detalle</a>
                        <div class="dropdown-divider"></div>
                        '.$menu_imprimir.'
                        '.$menu_anular.'
                        '.$menu_cancelar.'
                    </div>
                </div>';
                unset($row);
                $row['Id_Doc'] = $rs->Id_Doc;
                $row['Id_Per'] = $rs->Contacto.'<br>Ver: <a class="badge badge-light" href="'.site_url('persona/read/'.$rs->Id_Per).'" target="_blank">'.$rs->Identificacion_Per.'</a>';
                $row['Identificacion_Per'] = $rs->Identificacion_Per;
                $row['FechaRegistro_Doc'] = $rs->FechaRegistro_Doc;
                $row['Numero_Doc'] = $rs->Numero_Doc;
                $row['FechaDocumento_Doc'] = $rs->FechaDocumento_Doc;
                $row['FechaVencimiento_Doc'] = $rs->FechaVencimiento_Doc;
                $row['IvaIncluido_Doc'] = $rs->IvaIncluido_Doc;
                $row['Id_Usu'] = $rs->Usuario_Usu;
                $row['Id_DocTip'] = $rs->Nombre_DocTip;
                $row['Id_DocEst'] = '<span class="badge badge-'.$color.'">'.$rs->Nombre_DocEst.'</span>';
                $row['Id_TerPag'] = $rs->Nombre_TerPag;
                $row['total_doc'] = number_format($this->Funciones_model->get_totalKardex_by_document($rs->Id_Doc),2);

                // Opciones
                $row['ver'] = '<a href="'.site_url($this->view.'/read/'.$rs->Id_Doc).'" class="btn btn-info" title="Ver registro"><i class="fas fa-eye"></i></a>';
                $row['actualizar'] = $actualizar;
                $row['pago'] = $pago;
                $row['opciones'] = $options;
                $data[$c] = $row;

            }
        }
        $this->Datatable_model->output_datatable($totalData, $totalFiltered, $data);
    }

    public function read($id) 
    {
        $row = $this->Documento_model->get_by_id($id);
        if ($row) {
            $this->load->model('Documento_estado_model');
            $this->load->model('Documento_tipo_model');
            $this->load->model('Termino_pago_model');

            $this->load->model('Vw_persona_model');
            $p = $this->Vw_persona_model->get_by_id($row->Id_Per);

            $this->load->model('Kardex_model');
            $k = $this->Kardex_model->get_all('*', ['Id_Doc' => $row->Id_Doc]);

            $this->load->model('Usuario_model');
            $users = $this->Usuario_model->get_foreing_by_id($row->Id_Usu);
            $Id_Usu = $users->Nombre1_Per.' '.$users->Nombre2_Per.' '.$users->Apeliido1_Per;

            $data = array(
				'Id_Doc' => $row->Id_Doc,
				'FechaRegistro_Doc' => $row->FechaRegistro_Doc,
				'Numero_Doc' => $row->Numero_Doc,
				'FechaDocumento_Doc' => $row->FechaDocumento_Doc,
				'FechaVencimiento_Doc' => $row->FechaVencimiento_Doc,
				'Observacion_Doc' => $row->Observacion_Doc,
				'IvaIncluido_Doc' => $row->IvaIncluido_Doc,
				'Id_Per' => $row->Id_Per,
				'Id_Usu' => $Id_Usu,
                'Id_DocEst'=>$row->Id_DocEst,
				'Nombre_DocTip' => $this->Documento_tipo_model->get_by_id($row->Id_DocTip)->Nombre_DocTip ,
				'Nombre_DocEst' => $this->Documento_estado_model->get_by_id($row->Id_DocEst)->Nombre_DocEst,
				'Nombre_TerPag' => $this->Termino_pago_model->get_by_id($row->Id_TerPag)->Nombre_TerPag,
				'Primary_Usu' => $row->Primary_Usu,
                'type' => ($row->Id_DocTip != 1) ? 'expenses' : 'income' ,
                'Identificacion_Per' => $p->Identificacion_Per,
                'Nombres' => $p->Nombre1_Per.' '.$p->Nombre2_Per.' '.$p->Apeliido1_Per.' '.$p->Apellido2_Per,
                'Direccion_Per' => $p->Direccion_Per,
                'Nombre_Num' => $p->Nombre_Num,
                'TelCelular_Per' => $p->TelCelular_Per,
                'kardex' => $k,

                // Observación
                'button' => 'Anular',
                'action' => site_url('documento/anular_action/'.$row->Id_Doc),
                'Id_DocObs' => set_value('Id_DocObs'),
                'Nombre_DocObs' => set_value('Nombre_DocObs'),
                'placeholder' => '¿Porqué anulas esté documento?',
                'type' => get_type_documento_string($row->Id_DocTip),
                'id' => $row->Id_Doc,
                'mensaje' => '¿Esta seguro de <strong>ANULAR</strong> el documento?'

		    );
            $data['id_update'] = $id;
            $data['page'] = 'Detalle de '.$data['Nombre_DocTip']." [".$row->Numero_Doc."]";
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/documento_read';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('documento'));
        }
    }

    public function create($type=null) 
    {
        switch ($type) {
            case 'income':
                // Ingresos
                $type = "income";
                $name = "venta";
                $Numero_Doc = "Automático";
                break;
            case 'expenses':
                // egresos
                $type = "expenses";
                $name = "compra";
                $Numero_Doc = "";
                break;
            case 'quotes':
                $type = "quotes";
                $name = "cotización";
                $Numero_Doc = "Automático";
                $Id_DocTip = 6;
                break;
            case 'referrals':
                $type = "referrals";
                $name = "remisión";
                $Numero_Doc = "Automático";
                $Id_DocTip = 5;
                break;
            case 'purchase_order':
                $type = "purchase_order";
                $name = "órden de compra";
                $Numero_Doc = "Automático";
                $Id_DocTip = 7;
                break;
            default:
                redirect();
                break;
        }
        $this->load->model('Lista_precios_model');
        $ListPre_Id = $this->Lista_precios_model->get_all('*', [], ['Id_ListPre'=>'ASC'], [1]);
        $ListPrecio = ($ListPre_Id) ? $ListPre_Id[0]->Id_ListPre : "" ;

        $data = array(
            'button' => 'Guardar',
            'action' => site_url('documento/create_action'),
		    'Id_Doc' => set_value('Id_Doc'),
		    'FechaRegistro_Doc' => set_value('FechaRegistro_Doc', date('Y-m-d H:m:s')),
		    'Numero_Doc' => set_value('Numero_Doc', $Numero_Doc),
		    'FechaDocumento_Doc' => set_value('FechaDocumento_Doc', date('Y-m-d')),
		    'FechaVencimiento_Doc' => set_value('FechaVencimiento_Doc'),
		    'Observacion_Doc' => set_value('Observacion_Doc'),
		    'IvaIncluido_Doc' => set_value('IvaIncluido_Doc'),
		    'Id_Per' => set_value('Id_Per'),
		    'Id_Usu' => $this->session->userdata('Id_Usu'),
		    'Id_DocTip' => set_value('Id_DocTip'),
		    'Id_DocEst' => set_value('Id_DocEst'),
		    'Id_TerPag' => set_value('Id_TerPag'),
            'type' => $type,
            'Editar' => false,
		    'Primary_Usu' => set_value('Primary_Usu'),

            'Id_ListPre' => set_value('Id_ListPre', $ListPrecio),
            'Id_Med' => set_value('Id_Med'),
            'Id_Bod' => set_value('Id_Bod'),
            'Id_Imp' => [],
		);
	
        $this->load->model('Documento_estado_model');
        $data['all_documento_estado'] = $this->Documento_estado_model->get_all();
	
        $this->load->model('Documento_tipo_model');
        $data['all_documento_tipo'] = $this->Documento_tipo_model->get_all();
	
        $this->load->model('Persona_model');
        $data['all_persona'] = $this->Persona_model->get_all();
	
        $this->load->model('Termino_pago_model');
        $data['all_termino_pago'] = $this->Termino_pago_model->get_all();
	
        $this->load->model('Usuario_model');
        $data['all_usuario'] = $this->Usuario_model->get_all();

        $this->load->model('Medidas_model');
        $data['all_medidas'] = $this->Medidas_model->get_all();

        $this->load->model('Bodegas_model');
        $data['all_bodegas'] = $this->Bodegas_model->get_all();

        $this->load->model('Impuestos_model');
        $data['all_impuestos'] = $this->Impuestos_model->get_all();

        $data['all_lista_precios'] = $this->Lista_precios_model->get_all('*', [], ['Nombre_ListPre'=>'ASC']);
		   
        $data['page'] = 'Nueva factura de '.$name;
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/documento_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create(validar_post('type'));
        } else {
            $this->load->model('Impuestos_kardex_model');
            $this->load->model('Termino_pago_model');
            $Primary_Usu = $this->session->userdata('Primary_Usu');
            $Id_DocEst = 1;
            $type = validar_post('type');
            switch ($type) {
                case 'income':
                    // Ingresos
                    $Id_DocTip = 1;
                    $FactorMovimiento_Kar = 1;
                    $Id_KarTip = 1;
                    break;
                case 'expenses':
                    // egresos
                    $Id_DocTip = 2;
                    $FactorMovimiento_Kar = -1;
                    $Id_KarTip = 2;
                    break;
                case 'quotes':
                    //Cotizaciones
                    $Id_DocTip = 6;
                    $FactorMovimiento_Kar = 0;
                    $Id_KarTip = 2;
                    $Id_DocEst = 1;
                    break;
                case 'referrals':
                    $Id_KarTip = 2;
                    $Id_DocEst = 1;
                    $Id_DocTip = 5;
                    $FactorMovimiento_Kar = 0;
                    break;
                case 'purchase_order':
                    $Id_KarTip = 1;
                    $Id_DocEst = 1;
                    $Id_DocTip = 7;
                    $FactorMovimiento_Kar = 0;
                    break;
                
                default:
                    $this->create($type);
                    break;
            }
            $Id_TerPag = validar_post('Id_TerPag');
            if (($Id_TerPag != null) && ($Id_DocTip == 1 || $Id_DocTip == 2)) {
                $DiasPago = $this->Termino_pago_model->get_by_id($Id_TerPag)->Dias_TerPag;
                if ($DiasPago > 0) {
                    $Id_DocEst = 6;
                }
            }

            $data = array(
				'Id_Doc' => NULL,
				'FechaRegistro_Doc' => date('Y-m-d H:m:s'), 
				'Numero_Doc' => $this->getNumero_factura($Id_DocTip, validar_post('Numero_Doc')), 
				'FechaDocumento_Doc' => validar_post('FechaDocumento_Doc'), 
				'FechaVencimiento_Doc' => validar_post('FechaVencimiento_Doc'), 
				'Observacion_Doc' => validar_post('Observacion_Doc'), 
				'IvaIncluido_Doc' => validar_post('IvaIncluido_Doc'), 
				'Id_Per' => validar_post('Id_Per'), 
				'Id_Usu' => $this->session->userdata('Id_Usu'), 
				'Id_DocTip' => $Id_DocTip, 
				'Id_DocEst' => $Id_DocEst, 
				'Id_TerPag' => $Id_TerPag, 
				'Primary_Usu' => $Primary_Usu
			);
            $Id_Doc = $this->Documento_model->insert($data);

            $Id_Ites = validar_post('Id_Ite');
            if (count($Id_Ites) > 0) {
                $Cantidad_Kar = validar_post('cantidad'); 
                $Costo_Kar = validar_post('costo'); 
                $Descuento_Kar = validar_post('descuento'); 
                $Aceptado_Kar = validar_post('ok'); 
                $Observacion_Kar = validar_post('observacion'); 
                $FactorMovimiento_Kar = $FactorMovimiento_Kar;
                $Id_Ite = validar_post('Id_Ite'); 
                $Id_Med = validar_post('Id_Med'); 
                $Id_Bod = validar_post('Id_Bod'); 
                $Id_KarTip = $Id_KarTip; 
                $Id_KarEst = 1;
                $Id_Imp = json_decode(validar_post('json')); // Id_Imp. Capturar JSON

                foreach ($Id_Ites as $key => $Item) {
                    $dataItem = array(
                        'Id_kar' => NULL,
                        'Cantidad_Kar' => $Cantidad_Kar[$key], 
                        'Costo_Kar' => $Costo_Kar[$key], 
                        'Descuento_Kar' => $Descuento_Kar[$key], 
                        'Aceptado_Kar' => (isset($Aceptado_Kar[$key]))?$Aceptado_Kar[$key]:NULL, 
                        'Observacion_Kar' => $Observacion_Kar[$key], 
                        'FactorMovimiento_Kar' => $FactorMovimiento_Kar, 
                        'Id_Doc' => $Id_Doc, 
                        'Id_Ite' => $Item, 
                        'Id_Med' => (isset($Id_Med[$key]))?$Id_Med[$key]:NULL , 
                        'Id_Bod' => (isset($Id_Bod[$key]))?$Id_Bod[$key]:NULL, 
                        'Id_KarTip' => $Id_KarTip, 
                        'Id_KarEst' => $Id_KarEst, 
                        'Primary_Usu' => $Primary_Usu 
                    );
                    $Id_kar = $this->Kardex_model->insert($dataItem);

                    if (count($Id_Imp[$key]) > 0) {
                        foreach ($Id_Imp[$key] as $Imp) {
                            $dataImp = array(
                                'Id_ImpKar' => NULL,
                                'Id_kar' => $Id_kar, 
                                'Id_Imp' => $Imp
                            );
                            $this->Impuestos_kardex_model->insert($dataImp);
                        }
                    }
                    // 
                }
            }
            $payments = validar_post('payments');
            if ($payments == 1) {
                $url = 'transacciones/create/'.$type.'/'.$Id_Doc;
                $this->session->set_flashdata('message', 'Documento creado exitosamente, procede a crear pagos');
            } else {
                $url = 'documento/listar/'.$type ;
                $this->session->set_flashdata('message', 'Documento creado exitosamente');
            }
            
            redirect(site_url($url));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Documento_model->get_by_id($id);

        if ($row) {
            switch ($row->Id_DocTip) {
                case '1':
                    // Ingresos
                    $type = "income";
                    $name = "venta";
                    break;
                case '2':
                    // Egresos
                    $type = "expenses";
                    $name = "compra";
                    break;
                case '6':
                    // Cotizaciones
                    $type = "quotes";
                    $name = "cotización";
                    break;
                case '5':
                    // remisiones
                    $type = "referrals";
                    $name = "remisión";
                    break;
                case '7':
                    // orden de compra
                    $type = "purchase_order";
                    $name = "órden de compra";
                    break;
                default:
                    redirect();
                    break;
            }
            if ($row->Id_DocEst != 1) {
                $this->session->set_flashdata('message', 'El documento no se puede modificar');
                redirect(site_url('documento/read/'.$row->Id_Doc));
            }
            
            $this->load->model('Lista_precios_model');
            $ListPre_Id = $this->Lista_precios_model->get_all('*', [], ['Id_ListPre'=>'ASC'], [1]);
            $ListPrecio = ($ListPre_Id) ? $ListPre_Id[0]->Id_ListPre : "" ;

            $data = array(
                'button' => 'Actualizar',
                'action' => site_url('documento/update_action'),
				'Id_Doc' => set_value('Id_Doc', $row->Id_Doc),
				'FechaRegistro_Doc' => set_value('FechaRegistro_Doc', $row->FechaRegistro_Doc),
				'Numero_Doc' => set_value('Numero_Doc', $row->Numero_Doc),
				'FechaDocumento_Doc' => set_value('FechaDocumento_Doc', date('Y-m-d', strtotime($row->FechaDocumento_Doc))),
				'FechaVencimiento_Doc' => set_value('FechaVencimiento_Doc', date('Y-m-d', strtotime($row->FechaVencimiento_Doc))),
				'Observacion_Doc' => set_value('Observacion_Doc', $row->Observacion_Doc),
				'IvaIncluido_Doc' => set_value('IvaIncluido_Doc', $row->IvaIncluido_Doc),
				'Id_Per' => set_value('Id_Per', $row->Id_Per),
				'Id_Usu' => set_value('Id_Usu', $row->Id_Usu),
				'Id_DocTip' => set_value('Id_DocTip', $row->Id_DocTip),
				'Id_DocEst' => set_value('Id_DocEst', $row->Id_DocEst),
				'Id_TerPag' => set_value('Id_TerPag', $row->Id_TerPag),
				'Primary_Usu' => set_value('Primary_Usu', $row->Primary_Usu),
                'Editar' => true,
                'type' => $type,
                'Id_ListPre' => set_value('Id_ListPre', $ListPrecio),
                'Id_Med' => set_value('Id_Med'),
                'Id_Bod' => set_value('Id_Bod'),
                'Id_Imp' => [],
			);
	
            $this->load->model('Documento_estado_model');
            $data['all_documento_estado'] = $this->Documento_estado_model->get_all();
	
            $this->load->model('Documento_tipo_model');
            $data['all_documento_tipo'] = $this->Documento_tipo_model->get_all();
	
            $this->load->model('Persona_model');
            $data['all_persona'] = $this->Persona_model->get_all();
	
            $this->load->model('Termino_pago_model');
            $data['all_termino_pago'] = $this->Termino_pago_model->get_all();
	
            $this->load->model('Usuario_model');
            $data['all_usuario'] = $this->Usuario_model->get_all();

            // 
            $this->load->model('Medidas_model');
            $data['all_medidas'] = $this->Medidas_model->get_all();

            $this->load->model('Bodegas_model');
            $data['all_bodegas'] = $this->Bodegas_model->get_all();

            $this->load->model('Impuestos_model');
            $data['all_impuestos'] = $this->Impuestos_model->get_all();

            $data['all_lista_precios'] = $this->Lista_precios_model->get_all('*', [], ['Nombre_ListPre'=>'ASC']);
		   
            $data['page'] = 'Actualizar documento de '.$name;
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/documento_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('documento'));
        }
    }

    public function update_action() 
    {
        $this->_rules();
        $Primary_Usu = $this->session->userdata('Primary_Usu');
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Doc', TRUE));
        } else {
            $type = validar_post('type');
            switch ($type) {
                case 'income':
                    // Ingresos
                    $Id_DocTip = 1;
                    $FactorMovimiento_Kar = 1;
                    $Id_KarTip = 1;
                    break;
                case 'expenses':
                    // egresos
                    $Id_DocTip = 2;
                    $FactorMovimiento_Kar = -1;
                    $Id_KarTip = 2;
                    break;
                case 'quotes':
                    //Cotizaciones
                    $Id_DocTip = 6;
                    $FactorMovimiento_Kar = 0;
                    $Id_KarTip = 2;
                    break;
                case 'referrals':
                    //Cotizaciones
                    $Id_DocTip = 5;
                    $FactorMovimiento_Kar = 0;
                    $Id_KarTip = 2;
                    break;
                case 'purchase_order':
                    //Orden de compra
                    $Id_DocTip = 7;
                    $FactorMovimiento_Kar = 0;
                    $Id_KarTip = 1;
                    break;
                default:
                    redirect();
                    break;
            }

            // Borrar impuestos
            $this->Kardex_model->sql('DELETE ik FROM kardex AS k INNER JOIN impuestos_kardex AS ik ON ik.Id_kar = k.Id_kar WHERE k.Id_Doc = '.validar_post('Id_Doc'));

            // Borrar kardex
            $this->Kardex_model->delete('', ['Id_Doc' => validar_post('Id_Doc')]);

            $data = array(
				// 'FechaRegistro_Doc' => validar_post('FechaRegistro_Doc'), 
				'Numero_Doc' => validar_post('Numero_Doc'), 
				'FechaDocumento_Doc' => validar_post('FechaDocumento_Doc'), 
				'FechaVencimiento_Doc' => validar_post('FechaVencimiento_Doc'), 
				'Observacion_Doc' => validar_post('Observacion_Doc'), 
				'IvaIncluido_Doc' => validar_post('IvaIncluido_Doc'), 
				'Id_Per' => validar_post('Id_Per'), 
				'Id_Usu' => $this->session->userdata('Id_Usu'), // Usuario que actualiza
				// 'Id_DocTip' => validar_post('Id_DocTip'), 
				// 'Id_DocEst' => validar_post('Id_DocEst'), 
				'Id_TerPag' => validar_post('Id_TerPag'),
				// 'Primary_Usu' => validar_post('Primary_Usu'), 
		    );
            $Id_Doc = $this->Documento_model->update($this->input->post('Id_Doc', TRUE), $data);
            $Id_Ites = validar_post('Id_Ite');
            if (count($Id_Ites) > 0) {
                $Cantidad_Kar = validar_post('cantidad'); 
                $Costo_Kar = validar_post('costo'); 
                $Descuento_Kar = validar_post('descuento'); 
                $Aceptado_Kar = validar_post('ok'); 
                $Observacion_Kar = validar_post('observacion'); 
                $FactorMovimiento_Kar = $FactorMovimiento_Kar;
                // $Id_Ite = validar_post('Id_Ite'); 
                $Id_Med = validar_post('Id_Med'); 
                $Id_Bod = validar_post('Id_Bod'); 
                $Id_KarTip = $Id_KarTip; 
                $Id_KarEst = 1;
                $Id_Imp = json_decode(validar_post('json')); // Id_Imp. Capturar JSON

                foreach ($Id_Ites as $key => $Item) {
                    $dataItem = array(
                        'Id_kar' => NULL,
                        'Cantidad_Kar' => $Cantidad_Kar[$key], 
                        'Costo_Kar' => $Costo_Kar[$key], 
                        'Descuento_Kar' => $Descuento_Kar[$key], 
                        'Aceptado_Kar' => (isset($Aceptado_Kar[$key]))?$Aceptado_Kar[$key]:NULL, 
                        'Observacion_Kar' => $Observacion_Kar[$key], 
                        'FactorMovimiento_Kar' => $FactorMovimiento_Kar, 
                        'Id_Doc' => $Id_Doc, 
                        'Id_Ite' => $Item, 
                        'Id_Med' => (isset($Id_Med[$key]))?$Id_Med[$key]:null, 
                        'Id_Bod' => (isset($Id_Bod[$key]))?$Id_Bod[$key]:null, 
                        'Id_KarTip' => $Id_KarTip, 
                        'Id_KarEst' => $Id_KarEst, 
                        'Primary_Usu' => $Primary_Usu 
                    );
                    $Id_kar = $this->Kardex_model->insert($dataItem);

                    if (count($Id_Imp[$key]) > 0) {
                        foreach ($Id_Imp[$key] as $Imp) {
                            $dataImp = array(
                                'Id_ImpKar' => NULL,
                                'Id_kar' => $Id_kar, 
                                'Id_Imp' => $Imp
                            );
                            $this->Impuestos_kardex_model->insert($dataImp);
                        }
                    }
                    // 
                }
            }

            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('documento/read/'.$Id_Doc));
        }
    }

    
    public function delete($id) 
    {
        $row = $this->Documento_model->get_by_id($id);

        if ($row) {
            $this->Documento_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('documento'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('documento'));
        }
    }

    public function _rules() 
    { //Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
	 // $this->form_validation->set_rules('FechaRegistro_Doc', 'fecharegistro doc', 'trim|required');
	 // $this->form_validation->set_rules('Numero_Doc', 'numero doc', 'trim|required');
	 // $this->form_validation->set_rules('FechaDocumento_Doc', 'fechadocumento doc', 'trim|required');
	 // $this->form_validation->set_rules('FechaVencimiento_Doc', 'fechavencimiento doc', 'trim|required');
	 // $this->form_validation->set_rules('Observacion_Doc', 'observacion doc', 'trim|required');
	 // $this->form_validation->set_rules('IvaIncluido_Doc', 'ivaincluido doc', 'trim|required');
	 // $this->form_validation->set_rules('Id_Per', 'id per', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_Usu', 'id usu', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_DocTip', 'id doctip', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_DocEst', 'id docest', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Id_TerPag', 'id terpag', 'trim|required|numeric');
	 // $this->form_validation->set_rules('Primary_Usu', 'primary usu', 'trim|required|numeric');

	$this->form_validation->set_rules('Id_Doc', 'Id_Doc', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
    // Anular documento.
    public function anular($id) 
    {
        $row = $this->Documento_model->get_by_id($id);
        if ($row) {
            if ($row->Id_DocEst != 1) {
               $this->session->set_flashdata('message', 'El registro no se puede anular');
               redirect(site_url('documento/listar/'.get_type_documento_string($row->Id_DocTip)));
            }
            $data = array(
                'button' => 'Anular',
                'action' => site_url('documento/anular_action/'.$row->Id_Doc),
                'Id_DocObs' => set_value('Id_DocObs'),
                'Nombre_DocObs' => set_value('Nombre_DocObs'),
                'placeholder' => '¿Porqué anulas esté documento?',
                'type' => get_type_documento_string($row->Id_DocTip),
                'id' => $row->Id_Doc,
                'mensaje' => '¿Esta seguro de <strong>ANULAR</strong> el documento?'
            );

            $data['page'] = 'Anular documento ['.$row->Numero_Doc.']';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/documento_observacion_form';
            //n$this->session->set_flashdata('message', '¿Esta seguro de ANULAR el documento?');
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('inicio'));
        }
    }

    public function anular_action($id) {
        $row = $this->Documento_model->get_by_id($id);
        if ($row) {
            $type = get_type_documento_string($row->Id_DocTip);
            if ($row->Id_DocEst != 1) {
                $this->session->set_flashdata('message', 'El registro no se puede anular');
                redirect(site_url('documento/listar/'.$type));
            }

            $this->Documento_model->update($row->Id_Doc,['Id_DocEst'=>3]);
            $this->Kardex_model->update('',['FactorMovimiento_Kar'=>0], ['Id_Doc'=>$row->Id_Doc]);
            $data = array(
                'Id_DocObs' => NULL,
                'Nombre_DocObs' => 'DOCUMENTO ANULADO'.PHP_EOL.validar_post('Nombre_DocObs'), 
                'Id_DocEst' => 3, 
                'Id_Usu' => $this->session->userdata('Id_Usu'), 
                'FechaRegistro' => date('Y-m-d H:m:s'), 
                'Id_Doc' => $row->Id_Doc 
            );
            
            $this->load->model('Documento_observaciones_model');
            $this->Documento_observaciones_model->insert($data);

            $this->session->set_flashdata('message', 'El documento ha sido ANULADO con éxito');
            redirect(site_url('documento/listar/'.$type));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('inicio'));
        }
    }
    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "Listado de documentos.xls";
        $judul = "documento";
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

        xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_Per")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Numero_Doc")));

        xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_DocTip")));
        xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_DocEst")));

        xlsWriteLabel($tablehead, $kolomhead++, utf8_decode("Total"));
        xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_TerPag")));

		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("FechaDocumento_Doc")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("FechaVencimiento_Doc")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Observacion_Doc")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_Usu")));
        xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("FechaRegistro_Doc")));

    $this->load->model('Vw_documento_model');
	foreach ($this->Vw_documento_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);

            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Contacto));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Numero_Doc));

            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Nombre_DocTip));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Nombre_DocEst));
            xlsWriteNumber($tablebody, $kolombody++, $this->Funciones_model->get_totalKardex_by_document($data->Id_Doc));

            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Nombre_TerPag));

		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->FechaDocumento_Doc));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->FechaVencimiento_Doc));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Observacion_Doc));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Usuario_Usu));
            xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->FechaRegistro_Doc));

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
    public function json_list($type = null)
    {
        switch ($type) {
            case 'income':
                $Id_DocTip = 1;
                break;
            case 'expenses':
                $Id_DocTip = 2;
                break;
            
            default:
                $Id_DocTip = null;
                break;
        }
        $elements = 'Id_Doc, Numero_Doc, FechaDocumento_Doc, Nombres, Nombre_DocEst, Nombre_TerPag, FechaRegistro_Doc, FechaVencimiento_Doc, Observacion_Doc';

        $where = array(
            array('field'=>'Primary_Usu', 'value'=>$this->session->userdata('Primary_Usu')),
            array('field'=>'Id_DocTip', 'value'=>$Id_DocTip)
        );

        $this->load->model('Datatable_model');
        $result = $this->Datatable_model->start_datatable($elements , 'vw_documento', $totalData, $totalFiltered, $where);
        $data = array();
        foreach ($result as $i => $k) {
            unset($row);
            $row['Id_Doc'] = $k->Id_Doc;
            $row['action'] = '<button type="button" class="btn btn-info docadd" data-value="'.$k->Id_Doc.'">+</button>';
            $row['Numero_Doc'] = $k->Numero_Doc;
            $row['FechaDocumento_Doc'] = $k->FechaDocumento_Doc;
            $row['Nombres'] = $k->Nombres;
            $row['Nombre_DocEst'] = $k->Nombre_DocEst;
            $row['Nombre_TerPag'] = $k->Nombre_TerPag;
            $row['FechaRegistro_Doc'] = $k->FechaRegistro_Doc;
            $row['FechaVencimiento_Doc'] = $k->FechaVencimiento_Doc;
            $row['Observacion_Doc'] = $k->Observacion_Doc;
            $data[$i] = $row;
        }
        $this->Datatable_model->output_datatable($totalData, $totalFiltered, $data); 

    }
    public function getNumero_factura($Id_DocTip, $form_DocTip)
    {
        // Optimizar con un case
        $response = false;
        switch ($Id_DocTip) {
            case '1':
                $this->load->model('Numeracion_facturas_model');
                $where = array('Activo_NumFac'=>'Activo', 'Defecto_NumFac'=>'Activo');
                $rs = $this->Numeracion_facturas_model->get_all('*', $where, ['Id_NumFac'=>'DESC'], [1]);
                if ($rs) {
                    $Numero = intval($rs[0]->Numero_NumFac) + 1;
                    $this->Numeracion_facturas_model->update($rs[0]->Id_NumFac,['Numero_NumFac'=>$Numero]);
                    $response = $rs[0]->Prefijo_NumFac.'-'.$Numero;
                }
                break;
            
            default:
                if ($form_DocTip == 'Automático') {
                    $this->load->model('Numeracion_documentos_model');
                    $num = $this->Numeracion_documentos_model->get_all('*', ['Id_TranTip' => $Id_DocTip], ['Id_NumDoc'=>'DESC'], [1]);
                    $Numero_Tran = $num[0]->Siguiente_NumDoc;
                    $this->Numeracion_documentos_model->update($num[0]->Id_NumDoc,['Siguiente_NumDoc'=>intval($Numero_Tran)+1]);
                    $response = $Numero_Tran;
                } else {
                    $response = $form_DocTip;
                }
                break;
        }

        return $response;
    }

    // Cotizaciones
    public function quotes($type)
    {
        $type='quotes';
        $this->listar($type);
    }

    // Remisiones
    public function referrals($type)
    {
        $type='referrals';
        $this->listar($type);
    }

    // Orden de compra
    public function purchase_order($type)
    {
        $type='purchase_order';
        $this->listar($type);
    }

    // Nota de crédito
    public function credit_note($type)
    {
        $type='credit_note';
        $this->listar($type);
    }

    // Nota de dédito
    public function debit_note($type)
    {
        $type='debit_note';
        $this->listar($type);
    }

}

/* End of file Documento.php */
/* Location: ./application/controllers/Documento.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-31 22:18:19 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/