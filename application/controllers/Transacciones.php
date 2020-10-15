<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transacciones extends CI_Controller
{
    var $module = 'Transacciones';
    var $view = 'transacciones';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        validar_numeracion_documentos();
        $this->load->model('Pagos_model');
        $this->load->model('Transacciones_model');
        $this->load->model('Transaccion_detalle_model');
        $this->load->library('form_validation');        
		$this->load->library('datatables');
    }

    public function index($type = null)
    {
        switch ($type) {
            case 'income':
                $url = 'transacciones/listar/income';
                break;
            case 'expenses':
                $url = 'transacciones/listar/expenses';
                break;
            default:
                $url = '';
                break;
        }
        redirect($url);
    }
    public function listar($type=NULL)
    {
        switch ($type) {
            case 'income':
                // Ingresos
                $name = "ingresos";
                $Id_TranTip = array(1,6,8);
                break;
            case 'expenses':
                // egresos
                $name = "egresos";
                $Id_TranTip = array(2,5);
                break;
            default:
                redirect();
                break;
        }
        // $Id_DocTip = ($type == 'income') ? 1 : 2 ;
        $data['type'] = $type;
        $data['name'] = $name;        
        // $data['Id_DocTip'] = $Id_DocTip;
    
        
    
        $this->load->model('Bancos_model');
        $data['all_bancos'] = $this->Bancos_model->get_all();
    
        $this->load->model('Persona_model');
        $data['all_persona'] = $this->Persona_model->get_all();
    
        $this->load->model('Transaccion_estado_model');
        $data['all_transaccion_estado'] = $this->Transaccion_estado_model->get_all();
    
        $this->load->model('Transaccion_tipo_model');
        $data['all_transaccion_tipo'] = $this->Transaccion_tipo_model->get_all('*', ['Id_TranTip IN'=>$Id_TranTip], ['Nombre_TranTip'=>'ASC']);
    
        $this->load->model('Transacciones_model');
        $data['all_transacciones'] = $this->Transacciones_model->get_all();
    
        $this->load->model('Usuario_model');
        $data['all_usuario'] = $this->Usuario_model->get_all();

        $data['page'] = 'Transacciones de '.$name;
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/transacciones_list';
        $this->load->view('layouts/main',$data);
    }
    
    public function json($type = NULL) {
        switch ($type) {
            case 'income':
                // Ingresos
                $name = "Ingresos";
                $Id_TranTip = array(1,6,8);
                break;
            case 'expenses':
                // egresos
                $name = "Egresos";
                $Id_TranTip = array(2,5,7,9);
                break;
            default:
                redirect();
                break;
        }
        $where = array(
                    array('field'=>'Id_TranTip IN', 'value'=>$Id_TranTip ),
                    array('field'=>'Primary_Usu', 'value'=>$this->session->userdata('Primary_Usu') )
                );

        $this->load->model('Datatable_model');
        $columns = 'Id_Tran, Numero_Tran, Fecha_Tran, NotaVisible_Tran, DocumentoAsociado_Tran, FechaRegistro_Tran, Primary_Usu, Nombre_TranTip, Nombre_TranEst, NombreCuenta_Ban, NumeroCuenta_Ban, Usuario_Usu, Contacto, Id_TranTip, Id_TranEst';
        $result = $this->Datatable_model->start_datatable($columns, 'vw_transacciones', $totalData, $totalFiltered, $where); // Iniciar datatable
        $data = array();
        if(!empty($result))
        {
            foreach ($result as $c => $rs)
            {
                switch ($rs->Id_TranEst) {
                    case '1':
                        $color = "info";
                        $pago = '<a href="'.site_url('transacciones/create/'.$type.'/'.$rs->Id_Tran).'" class="btn btn-warning" title="Pagar documento"><i class="fas fa-cash-register"></i></a>';
                        $actualizar = '<a href="'.site_url($this->view.'/update/'.$rs->Id_Tran).'" class="btn btn-primary2" title="Editar documento"><i class="fas fa-pencil-alt"></i></a>';
                        $actualizar =  '<a class="dropdown-item" href="'.site_url($this->view.'/update/'.$rs->Id_Tran).'"><i class="fas fa-pencil-alt"></i> Modificar</a>';
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
                        $color = "dark";
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
                        $color = "warning";
                        $pago = '<a href="'.site_url('transacciones/create/'.$type.'/'.$rs->Id_Tran).'" class="btn btn-warning" title="Documento por pagar"><i class="fas fa-cash-register"></i></a>';
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

                switch ($rs->Id_TranTip) {
                    case '1':
                        $colorTip = "info";
                        break;
                    case '2':
                    // Inactivo
                        $colorTip = "secondary";
                        break;
                    case '3':
                    // Anular
                        $colorTip = "dark";
                    case '4':
                        $colorTip = "danger";
                        break;
                    case '5':
                    // Pagado
                        $colorTip = "success";
                        break;
                    case '6':
                        $colorTip = "warning";
                        break; 
                    default:
                        $colorTip = "light";
                        break;
                }
                // Sub menu de opciones
                $menu_imprimir = ($imprimir)?'<a class="dropdown-item" href="#"><i class="fas fa-print"></i> Imprimir</a>':'<a class="dropdown-item disabled" href="#"><i class="fas fa-print"></i> Imprimir</a>';
                $menu_anular = ($anular)?'<a class="dropdown-item" href="'.site_url('documento/anular/'.$rs->Id_Tran).'"><i class="fas fa-ban"></i> Anular</a>':'<a class="dropdown-item disabled" href="#"><i class="fas fa-ban"></i> Anular</a>';
                $menu_cancelar = ($cancelar)?'<a class="dropdown-item" href="#"><i class="fas fa-times-circle"></i> Cancelar</a>':'<a class="dropdown-item disabled" href="#"><i class="fas fa-times-circle"></i> Cancelar</a>';

                // Crear sub menu
                $options = '<div class="btn-group dropright" >
                    <button type="button" class="btn btn-primary2 dropdown-toggle" title="Menú de opciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu">
                       '.$actualizar.'
                        <a class="dropdown-item" href="'.site_url($this->view.'/read/'.$rs->Id_Tran).'"><i class="fas fa-search"></i> Detalle</a>
                        <div class="dropdown-divider"></div>
                        '.$menu_imprimir.'
                        '.$menu_anular.'
                        '.$menu_cancelar.'
                    </div>
                </div>';
                unset($row);
                $row['Id_Tran'] = $rs->Id_Tran;
                $row['Id_Per'] = $rs->Contacto.'<br>Ver: <a class="badge badge-light" href="'.site_url('persona/read/'.$rs->Id_Per).'" target="_blank">'.$rs->Identificacion_Per.'</a>';
                $row['Identificacion_Per'] = $rs->Identificacion_Per;
                $row['FechaRegistro_Tran'] = $rs->FechaRegistro_Tran;
                $row['Numero_Tran'] = $rs->Numero_Tran;
                $row['Fecha_Tran'] = date('Y-m-d', strtotime($rs->Fecha_Tran));
                $row['Id_Usu'] = $rs->Usuario_Usu;
                $row['Id_TranTip'] = '<span class="badge badge-outline-'.$colorTip.'  nav-link">'.$rs->Nombre_TranTip.'</span>';
                $row['Id_TranEst'] = '<span class="badge badge-'.$color.'">'.$rs->Nombre_TranEst.'</span>';
                $row['Id_Ban'] = $rs->NombreCuenta_Ban;
                $row['DocumentoAsociado_Tran'] = ($rs->DocumentoAsociado_Tran==1)?'SI':'NO';
                $row['Id_Tran_TransaccionParcial'] = ($rs->Id_Tran_TransaccionParcial==1)?'SI':'NO';
                $row['total'] = number_format($this->Funciones_model->get_totalTransaction_by_id($rs->Id_Tran),2);

                // Opciones
                $row['ver'] = '<a href="'.site_url($this->view.'/read/'.$rs->Id_Tran).'" class="btn btn-info" title="Ver registro"><i class="fas fa-eye"></i></a>';
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
        $row = $this->Transacciones_model->get_by_id($id);
        if ($row) {
            $this->load->model('Transaccion_estado_model');
            $this->load->model('Transaccion_tipo_model');

            $this->load->model('Cuentas_model');
            $this->load->model('Documento_model');
            $this->load->model('Impuestos_model');

            $this->load->model('Vw_persona_model');
            $p = $this->Vw_persona_model->get_by_id($row->Id_Per);

            $this->load->model('Transaccion_detalle_model');
            $k = $this->Transaccion_detalle_model->get_all('*', ['Id_Tran' => $row->Id_Tran]);

            $this->load->model('Usuario_model');
            $users = $this->Usuario_model->get_foreing_by_id($row->Id_Usu);
            $Id_Usu = $users->Nombre1_Per.' '.$users->Nombre2_Per.' '.$users->Apeliido1_Per;

            $data = array(
				'Id_Tran' => $row->Id_Tran,
				'Numero_Tran' => $row->Numero_Tran,
				'Fecha_Tran' => $row->Fecha_Tran,
				'NotaVisible_Tran' => $row->NotaVisible_Tran,
				'DocumentoAsociado_Tran' => $row->DocumentoAsociado_Tran,
				'FechaRegistro_Tran' => $row->FechaRegistro_Tran,
				'Id_TranTip' => $row->Id_TranTip,
				'Id_TranEst' => $row->Id_TranEst,
				'Id_Ban' => $row->Id_Ban,
				'Id_Usu' => $Id_Usu,
				'Id_Per' => $row->Id_Per,
				'Id_Tran_TransaccionParcial' => $row->Id_Tran_TransaccionParcial,
				'Primary_Usu' => $row->Primary_Usu,

                'Identificacion_Per' => $p->Identificacion_Per,
                'Nombres' => $p->Nombre1_Per.' '.$p->Nombre2_Per.' '.$p->Apeliido1_Per.' '.$p->Apellido2_Per,
                'Direccion_Per' => $p->Direccion_Per,
                'Nombre_Num' => $p->Nombre_Num,
                'TelCelular_Per' => $p->TelCelular_Per,

                'Nombre_TranTip' => $this->Transaccion_tipo_model->get_by_id($row->Id_TranTip)->Nombre_TranTip ,
                'Nombre_TranEst' => $this->Transaccion_estado_model->get_by_id($row->Id_TranEst)->Nombre_TranEst,
                'Nombre_TerPag' => '',
                'd' => $k
                
		    );
            $data['id_update'] = $id;
            $data['page'] = 'Detalle de transaccion ['.$row->Numero_Tran.']';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/transacciones_read';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('transacciones'));
        }
    }

    public function create($type = NULL, $Id_Doc = NULL) 
    {

        switch ($type) {
            case 'income':
                // Ingresos
                $name = "ingreso";
                $Id_DocTip = 1;
                $Id_NatCue = 1;
                break;
            case 'expenses':
                // egresos
                $name = "egreso";
                $Id_DocTip = 2;
                $Id_NatCue = 2;
                break;
            case 'quotes':
                // egresos
                $name = "ingreso";
                $Id_DocTip = 6; // Comprobante de ingreso
                $Id_NatCue = 1;
                break;
            case 'referrals':
                // Remisiones
                $name = "remisión";
                $Id_NatCue = 2;
                $Id_DocTip = 5;
                break;
            case 'purchase_order':
                // Orden de compra
                $name = "órden de compra";
                $Id_NatCue = 2;
                $Id_DocTip = 7;
                break;
            default:
                // redirect();
                break;
        }

        $Id_Per = '';
        $DocumentoAsociado_Tran = 0;
        $Numero_Doc = '';
        $total_documento = '';
        if ($Id_Doc != NULL) {
            $this->load->model('Documento_model');
            $elements='*';
            $where=['Id_Doc'=>$Id_Doc, 'Id_DocTip'=>$Id_DocTip, 'Id_DocEst IN'=>array(1,6)];
            $row = $this->Documento_model->get_all($elements, $where);
            // Detalle de_array($row);
            if (!empty($row)) {
                $DocumentoAsociado_Tran = 1;
                $Id_Per = $row[0]->Id_Per;
                $Id_Doc = $row[0]->Id_Doc;
                $Numero_Doc = $row[0]->Numero_Doc;
                $total_documento = $this->Funciones_model->get_totalKardex_by_document($Id_Doc);
            } else {
                $this->session->set_flashdata('message', 'No se ha encontrado documento');
            }            
        }

        $data = array(
            'button' => 'Guardar',
            'action' => site_url('transacciones/create_action'),
		    'Id_Tran' => set_value('Id_Tran'),
		    'Numero_Tran' => set_value('Numero_Tran','Automático'),
		    'Fecha_Tran' => set_value('Fecha_Tran', date('Y-m-d')),
		    'NotaVisible_Tran' => set_value('NotaVisible_Tran'),
		    'DocumentoAsociado_Tran' => set_value('DocumentoAsociado_Tran', $DocumentoAsociado_Tran),
		    'FechaRegistro_Tran' => set_value('FechaRegistro_Tran', date('Y-m-d H:m:s')),
		    'Id_TranTip' => set_value('Id_TranTip'),
		    'Id_TranEst' => set_value('Id_TranEst', 1),
		    'Id_Ban' => set_value('Id_Ban'),
		    'Id_Usu' => $this->session->userdata('Id_Usu'),
		    'Id_Per' => set_value('Id_Per', $Id_Per),
		    'Id_Tran_TransaccionParcial' => set_value('Id_Tran_TransaccionParcial'),
		    'Primary_Usu' => $this->session->userdata('Primary_Usu'),
            'type' => $type,
            'name' => $name,
            'Id_DocTip' => $Id_DocTip,
            'Id_NatCue' => $Id_NatCue,
            'Id_MetPag' => null,
            'Valor_Pag' => null,
            'Editar' => false,

            // Si existe documento
            'Id_Doc' => set_value('Id_Doc', $Id_Doc),
            'Numero_Doc' => set_value('Numero_Doc', $Numero_Doc),
            'valor' => $total_documento
		);
	
        $this->load->model('Metodo_pago_model');
        $data['all_metodo_pago'] = $this->Metodo_pago_model->get_all();

        $this->load->model('Cuentas_model');
        $data['all_cuentas'] = $this->Cuentas_model->get_all('*', [], ['Cuenta_Cue'=>'ASC']);

        $this->load->model('Impuestos_model');
        $data['all_impuestos'] = $this->Impuestos_model->get_all();

        $this->load->model('Bancos_model');
        $data['all_bancos'] = $this->Bancos_model->get_all('*', [], ['NombreCuenta_Ban'=>'ASC']);
	
        $this->load->model('Persona_model');
        $data['all_persona'] = $this->Persona_model->get_all();
	
        $this->load->model('Transaccion_estado_model');
        $data['all_transaccion_estado'] = $this->Transaccion_estado_model->get_all();
	
        $this->load->model('Transaccion_tipo_model');
        $data['all_transaccion_tipo'] = $this->Transaccion_tipo_model->get_all();
	
        $this->load->model('Transacciones_model');
        $data['all_transacciones'] = $this->Transacciones_model->get_all();
	
        $this->load->model('Usuario_model');
        $data['all_usuario'] = $this->Usuario_model->get_all();
		   
        $data['page'] = 'Nueva transaccion de '.$name;
        $data['module']= $this->module;
        $data['_view'] = $this->view.'/transacciones_form';
        $this->load->view('layouts/main',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();
        $type = validar_post('type');
        switch ($type) {
            case 'income':
                // Ingresos
                $Id_DocTip = 1;
                $FactorMovimiento_Kar = 1;
                $Id_TranDetTip = 1;
                $Id_TranDetEst = 1;
                $Id_TranTip = 8;
                $redirect = "income";
                break;
            case 'expenses':
                // egresos
                $Id_DocTip = 2;
                $FactorMovimiento_Kar = -1;
                $Id_TranDetTip = 2;
                $Id_TranDetEst = 1;
                $Id_TranTip = 9;
                $redirect = "expenses";
                break;
            case 'quotes':
                //Cotizaciones
                $Id_DocTip = 6;
                $FactorMovimiento_Kar = 0;
                $Id_TranDetTip = 2;
                $Id_TranDetEst = 1;
                $Id_TranTip = 8;
                $redirect = "income";
                break;
            case 'referrals':
                // Remisiones
                $Id_TranDetTip = 2;
                $Id_TranDetEst = 1;
                $Id_DocTip = 5;
                $FactorMovimiento_Kar = 0;
                $Id_TranTip = 8;
                $redirect = "income";
                break;
            case 'purchase_order':
                // Orden de compra
                $Id_TranDetTip = 1;
                $Id_TranDetEst = 1;
                $Id_DocTip = 7;
                $FactorMovimiento_Kar = 0;
                $Id_TranTip = 9;
                $redirect = "expenses";
                break;
            
            default:
                $this->session->set_flashdata('message', 'Algo ha ocurrido, por favor verifica tus datos');
                $this->create($type);
                break;
        }

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Algunos datos son requeridos, por favor verifica los campos');
            $this->create($type);
        } else {
            $Primary_Usu = $this->session->userdata('Primary_Usu');
            
            // $Id_DocTip = validar_post('Id_DocTip');
            // if (($type =='income' && $Id_DocTip !=1) || ($type == 'expenses' && $Id_DocTip != 2)) {
            //     $this->session->set_flashdata('message', 'Algo ha ocurrido, por favor verifica tus datos');
            //     $this->create($type);
            // } else {
                $error = false;
                // Validar detalle de transacción.
                $rows = validar_post('checking');
                $Valor_TranDet = validar_post('valor'); 
                $Cantidad_TranDet = validar_post('cantidad'); 
                $Observaciones_TranDet = validar_post('observacion'); 
                $Id_Tran = validar_post('Id_Tran'); 
                $Id_Cue = validar_post('Id_Cue'); 
                $Id_Doc = validar_post('Id_Doc');
                $Id_Imp = validar_post('Id_Imp'); 
                $Id_TranDetTip = $Id_TranDetTip; 
                $Id_TranDetEst = $Id_TranDetEst; 
                $FactorMoviemiento = $FactorMovimiento_Kar; 
                $Primary_Usu = $Primary_Usu;

                // Validación del detalle de la transacción.
                $detalle_transacciones = array();
                foreach ($rows as $i => $offsetnull) {
                    unset($data);
                    if ($Id_Doc != NULL || $Id_Cue != NULL) {
                        $data = array(
                            'Id_TranDet' => NULL,
                            'Valor_TranDet' => $Valor_TranDet[$i], 
                            'Cantidad_TranDet' => $Cantidad_TranDet[$i], 
                            'Observaciones_TranDet' => $Observaciones_TranDet[$i], 
                            'Id_Tran' =>null, 
                            'Id_Cue' => (isset($Id_Cue[$i])) ? $Id_Cue[$i] : NULL, 
                            'Id_Doc' => (isset($Id_Doc[$i])) ? $Id_Doc[$i] : NULL, 
                            'Id_Imp' => (isset($Id_Imp[$i])) ? $Id_Imp[$i] : NULL, 
                            'Id_TranDetTip' => $Id_TranDetTip, 
                            'Id_TranDetEst' => $Id_TranDetEst, 
                            'FactorMoviemiento' => $FactorMoviemiento, 
                            'Primary_Usu' => $Primary_Usu
                        );
                        array_push($detalle_transacciones, $data);
                    } else {
                        $error = true;
                    }
                }
                $count_detalle_transacciones = count($detalle_transacciones);
                if ($count_detalle_transacciones < 1) {
                    $this->session->set_flashdata('message', 'No existen detalles para procesar la transacción');
                    $error = true;
                }
                $id_pago = validar_post('Id_MetPag');
                $valor_pagos = validar_post('Valor_Pag');
                $pagos = array();
                if (count($valor_pagos)>0) {
                    foreach ($valor_pagos as $p => $vpay) {
                        unset($data);
                        if ($vpay != '') {
                            $data = array(
                                'Id_Pag' => NULL,
                                'Valor_Pag' => $vpay, 
                                'Fecha_Pag' => date('Y-m-d H:m:s'), 
                                'Id_MetPag' => $id_pago[$p], 
                                'Id_Tran' => null, 
                                'Primary_Usu' => $Primary_Usu, 
                            );
                            array_push($pagos, $data);
                        }
                    }
                }
                $count_pagos = count($pagos);
                if ($count_pagos < 1) {
                    $this->session->set_flashdata('message', 'No ha asignado pagos a la transacción');
                    $error = true;
                }
                //ver_array($detalle_transacciones);
                //die;
                // Comprobar si hay errores.
                if ($error == true) {
                    $this->create($type);
                } else {
                    // Numeración de transacciones
                    $this->load->model('Numeracion_documentos_model');
                    $Numero_Tran = validar_post('Numero_Tran');
                    $Id_NumDoc = "";
                    if ($Numero_Tran == 'Automático') {
                        $numeraciones = $this->Numeracion_documentos_model->get_all('*', ['Id_TranTip' => $Id_TranTip], ['Id_NumDoc'=>'DESC'], [1]);
                        $Numero_Tran = $numeraciones[0]->Siguiente_NumDoc;
                        $Id_NumDoc = $numeraciones[0]->Id_NumDoc;
                    }

                    // Inicio de guardado de la información.
                    // INSERT TRANSACCIÓN 
                    $DocumentoAsociado_Tran = validar_post('DocumentoAsociado_Tran');
                    $data_tran = array(
                        'Id_Tran' => NULL,
                        'Numero_Tran' => $Numero_Tran, 
                        'Fecha_Tran' => validar_post('Fecha_Tran'), 
                        'NotaVisible_Tran' => validar_post('NotaVisible_Tran'), 
                        'DocumentoAsociado_Tran' => $DocumentoAsociado_Tran, 
                        'FechaRegistro_Tran' => date('Y-m-d H:m:s'), 
                        'Id_TranTip' => $Id_TranTip, 
                        'Id_TranEst' => 5, 
                        'Id_Ban' => validar_post('Id_Ban'), 
                        'Id_Usu' => $this->session->userdata('Id_Usu'), 
                        'Id_Per' => validar_post('Id_Per'), 
                        'Id_Tran_TransaccionParcial' => validar_post('Id_Tran_TransaccionParcial'), 
                        'Primary_Usu' => $Primary_Usu 
                    );
                    $Id_Tran = $this->Transacciones_model->insert($data_tran);

                    // Actualizar consecutivo.
                    if ($Id_NumDoc != "") {
                        $Numero_Tran = $numeraciones[0]->Siguiente_NumDoc;
                        $this->Numeracion_documentos_model->update($Id_NumDoc,['Siguiente_NumDoc'=>intval($Numero_Tran)+1]);
                    }

                    // INSERT DETALLES DE TRANSACCIÓN
                    $e = 0;
                    while ($e < $count_detalle_transacciones) {
                        $detalle_transacciones[$e]['Id_Tran'] = $Id_Tran;
                        $e++;
                    }
                    $this->Transaccion_detalle_model->insert_batch($detalle_transacciones);

                    // INSERT PAGOS
                    $p = 0;
                    while ($p < $count_pagos) {
                        $pagos[$p]['Id_Tran'] = $Id_Tran;
                        $p++;
                    }
                    $this->Pagos_model->insert_batch($pagos);

                    // Validar pagos y actualizar estados de pago
                    // Documento
                    if ($DocumentoAsociado_Tran==1) {
                        $this->load->model('Documento_model');
                        foreach ($Id_Doc as $id) {
                            $this->Documento_model->sql("UPDATE documento SET Id_DocEst='5' WHERE Id_Doc = $id");
                        }
                    }

                    $this->session->set_flashdata('message', 'Transacción realizada exitosamente');
                    redirect(site_url('transacciones/listar/'.$redirect));
                }


                
            // }
        }
    }
    
    public function update($id) 
    {
        redirect('transacciones/read/'.$id);
        $row = $this->Transacciones_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Actualizar',
                'action' => site_url('transacciones/update_action'),
				'Id_Tran' => set_value('Id_Tran', $row->Id_Tran),
				'Numero_Tran' => set_value('Numero_Tran', $row->Numero_Tran),
				'Fecha_Tran' => set_value('Fecha_Tran', $row->Fecha_Tran),
				'NotaVisible_Tran' => set_value('NotaVisible_Tran', $row->NotaVisible_Tran),
				'DocumentoAsociado_Tran' => set_value('DocumentoAsociado_Tran', $row->DocumentoAsociado_Tran),
				'FechaRegistro_Tran' => set_value('FechaRegistro_Tran', $row->FechaRegistro_Tran),
				'Id_TranTip' => set_value('Id_TranTip', $row->Id_TranTip),
				'Id_TranEst' => set_value('Id_TranEst', $row->Id_TranEst),
				'Id_Ban' => set_value('Id_Ban', $row->Id_Ban),
				'Id_Usu' => set_value('Id_Usu', $row->Id_Usu),
				'Id_Per' => set_value('Id_Per', $row->Id_Per),
				'Id_Tran_TransaccionParcial' => set_value('Id_Tran_TransaccionParcial', $row->Id_Tran_TransaccionParcial),
				'Primary_Usu' => set_value('Primary_Usu', $row->Primary_Usu),
			);
	
            $this->load->model('Bancos_model');
            $data['all_bancos'] = $this->Bancos_model->get_all();
	
            $this->load->model('Persona_model');
            $data['all_persona'] = $this->Persona_model->get_all();
	
            $this->load->model('Transaccion_estado_model');
            $data['all_transaccion_estado'] = $this->Transaccion_estado_model->get_all();
	
            $this->load->model('Transaccion_tipo_model');
            $data['all_transaccion_tipo'] = $this->Transaccion_tipo_model->get_all();
	
            $this->load->model('Transacciones_model');
            $data['all_transacciones'] = $this->Transacciones_model->get_all();
	
            $this->load->model('Usuario_model');
            $data['all_usuario'] = $this->Usuario_model->get_all();
		   
            $data['page'] = 'Actualizar transaccion ['.$row->Numero_Tran.']';
            $data['module']= $this->module;
            $data['_view'] = $this->view.'/transacciones_form';
            $this->load->view('layouts/main',$data);
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('transacciones'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Tran', TRUE));
        } else {
            $data = array(
				'Numero_Tran' => validar_post('Numero_Tran'), 
				'Fecha_Tran' => validar_post('Fecha_Tran'), 
				'NotaVisible_Tran' => validar_post('NotaVisible_Tran'), 
				'DocumentoAsociado_Tran' => validar_post('DocumentoAsociado_Tran'), 
				'FechaRegistro_Tran' => validar_post('FechaRegistro_Tran'), 
				'Id_TranTip' => validar_post('Id_TranTip'), 
				'Id_TranEst' => validar_post('Id_TranEst'), 
				'Id_Ban' => validar_post('Id_Ban'), 
				'Id_Usu' => validar_post('Id_Usu'), 
				'Id_Per' => validar_post('Id_Per'), 
				'Id_Tran_TransaccionParcial' => validar_post('Id_Tran_TransaccionParcial'), 
				'Primary_Usu' => validar_post('Primary_Usu'), 
		    );

            $this->Transacciones_model->update($this->input->post('Id_Tran', TRUE), $data);
            $this->session->set_flashdata('message', 'Registro actualizado exitosamente');
            redirect(site_url('transacciones'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Transacciones_model->get_by_id($id);

        if ($row) {
            $this->Transacciones_model->delete($id);
            $this->session->set_flashdata('message', 'Registro eliminado exitosamente');
            redirect(site_url('transacciones'));
        } else {
            $this->session->set_flashdata('message', 'Registro no encontrado');
            redirect(site_url('transacciones'));
        }
    }

    public function _rules() 
    {   
        // Reglas y validaciones en formulario, descomentar si es necesario y ajustar segun necesidad
        // $this->form_validation->set_rules('NotaVisible_Tran', 'notavisible tran', 'trim|required');
        // $this->form_validation->set_rules('DocumentoAsociado_Tran', 'documentoasociado tran', 'trim|required');
        // $this->form_validation->set_rules('FechaRegistro_Tran', 'fecharegistro tran', 'trim|required');
        // $this->form_validation->set_rules('Id_TranTip', 'id trantip', 'trim|required|numeric');
        // $this->form_validation->set_rules('Id_TranEst', 'id tranest', 'trim|required|numeric');
	    
	    // $this->form_validation->set_rules('Id_Usu', 'id usu', 'trim|required|numeric');
	    // $this->form_validation->set_rules('Id_Tran_TransaccionParcial', 'id tran transaccionparcial', 'trim|required|numeric');
	    // $this->form_validation->set_rules('Primary_Usu', 'primary usu', 'trim|required|numeric');
	    $this->form_validation->set_rules('Id_Tran', 'Id_Tran', 'trim');
        $this->form_validation->set_rules('Numero_Tran', 'numero tran', 'trim|required');
        $this->form_validation->set_rules('Fecha_Tran', 'fecha tran', 'trim|required');
        $this->form_validation->set_rules('Id_Ban', 'id ban', 'trim|required|numeric');
        $this->form_validation->set_rules('Id_Per', 'id per', 'trim|required|numeric');
	    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "Listado de transacciones.xls";
        $judul = "transacciones";
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
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Numero_Tran")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Fecha_Tran")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("NotaVisible_Tran")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("DocumentoAsociado_Tran")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("FechaRegistro_Tran")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_TranTip")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_TranEst")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_Ban")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_Usu")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_Per")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Id_Tran_TransaccionParcial")));
		xlsWriteLabel($tablehead, $kolomhead++, utf8_decode(t("Primary_Usu")));

	foreach ($this->Transacciones_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Numero_Tran));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->Fecha_Tran));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->NotaVisible_Tran));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->DocumentoAsociado_Tran));
		    xlsWriteLabel($tablebody, $kolombody++, utf8_decode($data->FechaRegistro_Tran));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Id_TranTip));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Id_TranEst));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Id_Ban));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Id_Usu));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Id_Per));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Id_Tran_TransaccionParcial));
		    xlsWriteNumber($tablebody, $kolombody++, utf8_decode($data->Primary_Usu));

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
    public function categoryTree($parent_id = 1, $sub_mark = '') {      
        $this->load->model('Cuentas_model');
        $cuentas = $this->Cuentas_model->get_all('*', ['Id_Cue_CuentaPadre'=>$parent_id], ['Cuenta_Cue'=>'ASC']);
        if ($cuentas) {
            foreach ($cuentas as $v) {
                echo "<option value='".$v->Id_Cue."'>".$v->Cuenta_Cue."</option>";
                categoryTree($v->Id_Cue, $sub_mark.'---');
            }
        }
    }

}

/* End of file Transacciones.php */
/* Location: ./application/controllers/Transacciones.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-31 22:18:40 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/