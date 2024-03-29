<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Getresult extends CI_Controller
{
    var $module = 'Categoria_item';
    var $view = 'categoria_item';

    function __construct()
    {
        parent::__construct();
        is_login(); // Verifica login de usuario
        $this->load->library('form_validation'); 
    }

    public function index()
    {
        redirect();
    } 

    public function getItems($value='')
    {
        $response = array();
        $criteria = validar_post('search');
        $Id_ListPre = validar_post('list');
        $type = validar_post('type');
        if ($criteria != NULL && $type != '') {
            if ($Id_ListPre != NULL) {
                $sql = "SELECT
                        items.Id_Ite,
                        items.Nombre_Ite,
                        items.Referencia_Ite,
                        items.Serie_Ite,
                        items.Id_Med,
                        items.Id_Bod,
                        precios_item.PrecioVenta,
                        GROUP_CONCAT(DISTINCT impuestos_items.Id_Imp ) AS Id_Imp 
                    FROM
                        items
                        LEFT JOIN precios_item ON precios_item.Id_Ite = items.Id_Ite
                        LEFT JOIN impuestos_items ON impuestos_items.Id_Ite = items.Id_Ite
                        LEFT JOIN impuestos ON impuestos_items.Id_Imp = impuestos.Id_Imp
                    WHERE
                        -- impuestos.Estado_Imp = 'Activo' AND
                        items.Id_IteEst = 1
                        AND precios_item.Id_ListPre = $Id_ListPre 
                        AND ( items.Nombre_Ite LIKE '%$criteria%' OR items.Referencia_Ite LIKE '%$criteria%' OR items.Serie_Ite LIKE '%$criteria%' ) 
                        AND items.Primary_Usu = ".$this->session->userdata('Primary_Usu')."
                    GROUP BY
                        items.Id_Ite
                    ORDER BY
                        items.Nombre_Ite ASC";
// echo $sql;
                $this->load->model('Items_model');
                $result = $this->Items_model->sql($sql);
                if ($result) {
                    $k = 0;
                    foreach ($result as $value) {
                        $data['value'] = $value->Id_Ite;
                        $data['label'] = $value->Nombre_Ite;
                        $data['data'] = $value;
                        $response[$k] = $data;
                        $k++;
                    }
                } else {
                    $response['value']='No se ha encontrado resultados';
                }
            } else {
                $response['value']='Seleccione '.t("Id_ListPre");
            }
            
        } else{
            $response['value']='Digite un criterio de busqueda';
        }

        echo json_encode($response);
    }
    

    /******* select2 ajax response *******/
    public function getContact($type='')
    {
        $response = null;
        $q = (isset($_GET['q'])) ? $_GET['q'] : null ;
        if ($type != '' &&  $q != null) {
            $criteria = explode(' ', $q);
            $type = ($type == 'expenses' || $type == 'purchase_order') ? 2 : 1 ;
            $this->load->model('Funciones_model');
            $response = $this->Funciones_model->getLike_contactos($criteria, $type);            
        }
        echo json_encode($response);
    }
    
    public function addMarca($marca = null) {
        $response = array();
        
        $request_body = file_get_contents('php://input'); 
        $data = json_decode($request_body);
        $type = clean($data->_type);

        if($type === 'addMarca'){
            $this->load->model('Marcas_model');
            $term = clean($data->_term);
            $term = ucwords($term);
            $result = $this->Marcas_model->sql("SELECT Nombre_Mar FROM marcas WHERE Nombre_Mar LIKE '%".$term."%'");
            if($result){
                $response = ['mensaje' => 'Ya se encuentra registrado', 'error' => -1];
            } else {
                $marca = [
                    'Nombre_Mar' => $term,
                    'Primary_Usu' => $this->session->userdata('Primary_Usu')
                ];
                $resultMarca = $this->Marcas_model->insert($marca);
                $response = ['mensaje' => 'Registro ' . $term . ' Creado', 'error' => 0,
                            'key'=>$resultMarca, 'value' => $term];
            }
        } else {
            $response = ['mensaje' => 'Error al crear el registro', 'error' => -1];
        }
        
        echo json_encode($response);
    }

    public function addMedidas($marca = null) {
        $response = array();
        
        $request_body = file_get_contents('php://input'); 
        $data = json_decode($request_body);
        $type = clean($data->_type);

        if($type === 'addMedidas'){
            $this->load->model('Medidas_model');
            $term = clean($data->_term);
            $term = ucwords($term);
            $result = $this->Medidas_model->sql("SELECT Nombre_Med FROM medidas WHERE Nombre_Med LIKE '%".$term."%'");
            if($result){
                $response = ['mensaje' => 'Ya se encuentra registrado', 'error' => -1];
            } else {
                $marca = [
                    'Nombre_Med' => $term,
                    'Primary_Usu' => $this->session->userdata('Primary_Usu')
                ];
                $resultMarca = $this->Medidas_model->insert($marca);
                $response = ['mensaje' => 'Registro ' . $term . ' Creado', 'error' => 0,
                            'key'=>$resultMarca, 'value' => $term];
            }
        } else {
            $response = ['mensaje' => 'Error al crear el registro', 'error' => -1];
        }
        
        echo json_encode($response);
    }

    public function addCategoriaItem($marca = null) {
        $response = array();
        
        $request_body = file_get_contents('php://input'); 
        $data = json_decode($request_body);
        $type = clean($data->_type);

        if($type === 'addCategoriaItem'){
            $this->load->model('Categoria_item_model');
            $term = clean($data->_term);
            $term = ucwords($term);
            $result = $this->Categoria_item_model->sql("SELECT Nombre_CatIte FROM categoria_item WHERE Nombre_CatIte LIKE '%".$term."%'");
            if($result){
                $response = ['mensaje' => 'Ya se encuentra registrado', 'error' => -1];
            } else {
                $marca = [
                    'Nombre_CatIte' => $term,
                    'Primary_Usu' => $this->session->userdata('Primary_Usu')
                ];
                $resultMarca = $this->Categoria_item_model->insert($marca);
                $response = ['mensaje' => 'Registro ' . $term . ' Creado', 'error' => 0,
                            'key'=>$resultMarca, 'value' => $term];
            }
        } else {
            $response = ['mensaje' => 'Error al crear el registro', 'error' => -1];
        }
        
        echo json_encode($response);
    }
}

/* End of file Categoria_item.php */
/* Location: ./application/controllers/Categoria_item.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-24 01:25:57 */
/* http://harviacode.com 
// $password = $this->input->post('Contrasena_Usu',TRUE);
// $hashPassword   = password_hash($password,PASSWORD_BCRYPT,array("cost"=>4));
            
*/