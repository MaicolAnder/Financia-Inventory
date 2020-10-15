<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 */
	function __construct()
    {
        parent::__construct();
        is_login(); 
        date_default_timezone_set('America/Bogota');
        $this->load->model('Persona_model');
        validar_numeracion_documentos();
    } 

	public function index()
	{
		$data = array('page' => 'Bienvenidos', 'module'=>'Inicio', '_view'=>'inicio');

		$this->load->model('Vw_persona_model');
		$this->load->model('Vw_usuario_model');

		$data['fecha'] = $this->fecha(date('d-m-Y H:i:s'));
        $persona_data = $this->Vw_persona_model->get_by_id($this->session->userdata('Id_Per'));
        $data['Per_Nombres'] = $persona_data->Nombre1_Per." ". $persona_data->Nombre2_Per." ". $persona_data->Apeliido1_Per." ".$persona_data->Apellido2_Per;



        $this->load->view('layouts/main',$data);
	}

	public function rules_start()
	{
		$message = "";
		$this->load->model('Numeracion_documentos_model');
		if ($this->Numeracion_documentos_model->total_rows() < 1) {
			$message = 'Configurar numeración de documentos <a href="'.site_url("numeracion_documentos/create").'" class="btn btn-link">Ir a la configuración</a>';
        }

        $this->load->model('Numeracion_facturas_model');
        if ($this->Numeracion_facturas_model->total_rows() < 1) {
        	$message .= '<br>Configurar resolución de facturas <a href="'.site_url("numeracion_facturas").'" class="btn btn-link">Ir a la configuración</a>';
        }
        $this->session->set_flashdata('message', $message);
        if ($message != "") {
        	// redirect();
        }
	}
	public function total_ventas($income='')
	{
		// $this->load->model('Funciones_model');
	 	number_format($this->Funciones_model->get_totalKardex_by_document($rs->Id_Doc),2);
        $this->load->model('Documento_model');
	}

	// Fecha date() a dias string
	public function fecha ($fecha) {
	  	$fecha = substr($fecha, 0, 10);
	  	$numeroDia = date('d', strtotime($fecha));
	  	$dia = date('l', strtotime($fecha));
	  	$mes = date('F', strtotime($fecha));
	  	$anio = date('Y', strtotime($fecha));
	  	$dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
	  	$dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
	  	$nombredia = str_replace($dias_EN, $dias_ES, $dia);
		$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	  	$meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	  	$nombreMes = str_replace($meses_EN, $meses_ES, $mes);
	  	return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
	}


}
