<?php
function label($str){
    $label = str_replace('_', ' ', $str);
    $label = ucwords($label);
    return $label;
}
function label_explode($str, $pos = 1){
    $label = explode('_',$str);
    $pos = (count($label)>1) ? $pos : 0 ;
    return ucwords($label[$pos]);
   
}
function cmb_dinamis($name,$table,$field,$pk,$selected=null,$order=null){
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control'>";
    if($order){
        $ci->db->order_by($field,$order);
    }
    $data = $ci->db->get($table)->result();
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  strtoupper($d->$field)."</option>";
    }
    $cmb .="</select>";
    return $cmb;  
}
function select2_dinamis($name,$table,$field,$placeholder){
    $ci = get_instance();
    $select2 = '<select name="'.$name.'" class="form-control select2 select2-hidden-accessible" multiple="" 
               data-placeholder="'.$placeholder.'" style="width: 100%;" tabindex="-1" aria-hidden="true">';
    $data = $ci->db->get($table)->result();
    foreach ($data as $row){
        $select2.= ' <option>'.$row->$field.'</option>';
    }
    $select2 .='</select>';
    return $select2;
}
function datalist_dinamis($name,$table,$field,$value=null){
    $ci = get_instance();
    $string = '<input value="'.$value.'" name="'.$name.'" list="'.$name.'" class="form-control">
    <datalist id="'.$name.'">';
    $data = $ci->db->get($table)->result();
    foreach ($data as $row){
        $string.='<option value="'.$row->$field.'">';
    }
    $string .='</datalist>';
    return $string;
}
function rename_string_is_aktif($string){
    return $string=='y'?'Aktif':'Tidak Aktif';
}
function loger_data($user, $action, $table, $json)
{
    # code...
}
function is_login($module = "") {
    $ci = get_instance();
    if(!$ci->session->userdata('Id_Usu')){
        redirect('auth');
        exit();
    }else{
        $controlador = ($ci->uri->segment(1)) ? $ci->uri->segment(1) : 'inicio' ;
        // echo "Control: ".$controlador;
        $roles_permiso = $ci->session->userdata('Permisos');
        $Permisos = $ci->db->get_where('permiso', array('Controlador_Perm'=>$controlador))->row_array();

        $validador_permiso_controlador = array();
        foreach ($roles_permiso as $value) {
            if ($Permisos['Id_Perm']==$value->Id_Perm) {
                $validador_permiso_controlador['modulo'] = strtolower($controlador);
                $validador_permiso_controlador['Acceso_Perm'] = $Permisos['Acceso_Perm'];
                $validador_permiso_controlador['Editar'] = $value->Editar;
                $validador_permiso_controlador['Ver'] = $value->Ver;
                $validador_permiso_controlador['Crear'] = $value->Crear;
                $validador_permiso_controlador['Listar'] = $value->Listar;
            }
        }
        if ( $ci->session->userdata('Id_Rol')==1 ) { // Si es administrador
            $validador_permiso_controlador['modulo'] = '';
            $validador_permiso_controlador['Acceso_Perm'] = 'Si';
            $validador_permiso_controlador['Editar'] = 'Si';
            $validador_permiso_controlador['Ver'] = 'Si';
            $validador_permiso_controlador['Crear'] = 'Si';
            $validador_permiso_controlador['Listar'] = 'Si';
        }
        if (count($validador_permiso_controlador) < 1) {
            redirect('auth/acceso_denegado');
            exit();
        }
    }
}
function alert($class,$title,$description) {
    return '<div class="alert '.$class.' alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> '.$title.'</h4>
                '.$description.'
              </div>';
}
// untuk chek akses level pada modul peberian akses
function checked_akses($Id_Rol,$id_menu) {
    $ci = get_instance();
    $ci->db->where('Id_Rol',$Id_Rol);
    $ci->db->where('id_menu',$id_menu);
    $data = $ci->db->get('tbl_hak_akses');
    if($data->num_rows()>0){
        return "checked='checked'";
    }
}
function autocomplate_json($table,$field) {
    $ci = get_instance();
    $ci->db->like($field, $_GET['term']);
    $ci->db->select($field);
    $collections = $ci->db->get($table)->result();
    foreach ($collections as $collection) {
        $return_arr[] = $collection->$field;
    }
    echo json_encode($return_arr);
}
// Complemento de busqueda WHERE
function validate_where($campo, $value, $if='AND')
{
    $ci = get_instance();
    switch ($if) {
        case 'OR':
            if (preg_match('/IN$/i', $campo) === true) {
                return $ci->db->or_where_in(substr($campo,2,-3), $value);
            }elseif (preg_match('/LIKE$/i', $campo) === true) {
                return $ci->db->or_like(substr($campo,2,-5), $value);
            } else {
                return $ci->db->or_where(substr($campo, 3), $value);
            }
            break;
        
        default:
            if (preg_match('/IN$/i', $campo) == true) {
                return $ci->db->where_in(substr($campo,0,-3), $value);
            }elseif (preg_match('/LIKE$/i', $campo) == true) {
                return $ci->db->like(substr($campo,0,-5), $value);
            } else {
                return $ci->db->where($campo, $value);
            }
            break;
    }
    
}

// Mostrar arrays u objetos print_r
function ver_array($array=[])
{
    // if (is_array($array)) {
        if ($array) {
            echo ('<pre>');
                print_r($array);
            echo ('</pre>');
        } else {
            echo "Datos vacios<br>";
        }
    // } else {
    //     echo "No es array";
    // }
    
    
}
function clean($string){
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}
function clean_force($string, $force_lowercase = true, $anal = false) {
    return $string;
    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "=", "+", "[", "{", "]",
                   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                   "â€”", "â€“", ",", "<", ".", ">", "/", "?");

    $clean = trim(str_replace($strip, "", strip_tags($string)));
    $clean = preg_replace('/\s+/', " ", $clean);
    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
    return ($force_lowercase) ?
        (function_exists('mb_strtolower')) ?
            mb_strtolower($clean, 'UTF-8') :
            strtolower($clean) :
        $clean;
}
// Validar peticiones enviadas por post
function validar_post($post, $ArrayPos='') {
    $ci = get_instance();

    if (isset($_POST[$post])) { // POST Existe
        $input = $ci->input->post($post,TRUE); // Llamar post
        if (is_array($input)) { // Es array
            $post_array = array(); // Array de retorno
            if ($ArrayPos != '') {
                return ($input[$ArrayPos] != '') ? clean($input[$ArrayPos]) : NULL ; //Retornar posición del Array
            } else {
                // Retornar array POST Completo
                if (count($input) > 0) {
                    foreach ($input as $key) {
                        array_push($post_array, ($key != '') ? clean($key) : NULL);
                    }
                }
                return ($post_array);
            }
        } else {
            return ($input != null || $input != '') ? clean($input) : NULL ;
        }
    } else {
        return NULL;
    }
    
}
// Validar peticiones enviadas por post
function validar_get($get, $ArrayGet='') {
    $ci = get_instance();

    if (isset($_GET[$get])) { // GET Existe
        $input = $ci->input->get($get,TRUE); // Llamar get
        if (is_array($input)) { // Es array
            $get_array = array(); // Array de retorno
            if ($ArrayGet != '') {
                return ($input[$ArrayGet] != '') ? $input[$ArrayGet] : NULL ; //Retornar posición del Array
            } else {
                // Retornar array GET Completo
                if (count($input) > 0) {
                    foreach ($input as $key) {
                        array_push($get_array, ($key != '') ? $key : NULL);
                    }
                }
                return ($get_array);
            }
        } else {
            return ($input != null || $input != '') ? $input : NULL ;
        }
    } else {
        return NULL;
    }
    
}
function validar_file($get, $ArrayFile='') {
    $ci = get_instance();

    if (isset($_FILES[$get])) { // GET Existe
        $input = $ci->input->file($get,TRUE); // Llamar get
        if (is_array($input)) { // Es array
            $file_array = array(); // Array de retorno
            if ($ArrayFile != '') {
                return ($input[$ArrayFile] != '') ? $input[$ArrayFile] : NULL ; //Retornar posición del Array
            } else {
                // Retornar array GET Completo
                if (count($input) > 0) {
                    foreach ($input as $key) {
                        array_push($file_array, ($key != '') ? $key : NULL);
                    }
                }
                return ($file_array);
            }
        } else {
            return ($input != null || $input != '') ? $input : NULL ;
        }
    } else {
        return NULL;
    }
    
}

function get_global_var($key)
{
    $ci = get_instance();
    $result = $ci->db->get_where('configuracion',array('Key_Conf'=>$key))->row_array();
    return (!empty($result)) ? $result['Value_Conf'] : NULL ;
}

function set_global_var($key, $value)
{
    $ci = get_instance();
    $result = $ci->db->update('configuracion', array('Value_Conf'=>$value), array('Key_Conf'=>$key));
    return ($result) ? $value : NULL ;
}
function increment_global_var($key, $increment = 1)
{
    $ci = get_instance();
    $value = (get_global_var($key)+$increment);
    $result = $ci->db->update('configuracion', array('Value_Conf'=>$value), array('Key_Conf'=>$key));
    return ($result) ? $value : NULL ;
}
function indicadores_etiqueta_valor($result_array, $etiqueta="", $valor="", $sumar_result=false)
{
    $labels = array();
    $values = array();
    $total = 0;
    foreach ($result_array as $array) {
        array_push($labels,"'". $array[$etiqueta]."'");
        array_push($values, $array[$valor]);
        if ($sumar_result) {
            if (is_numeric($array[$valor])) {
                $total = $total + $array[$valor];
            }
        }
    }
    
    $rs['labels'] = trim_array($labels);        
    $rs['values'] = trim_array($values);       
    $rs['total_result'] = round(($total),2);

    return $rs;
}

function trim_array($array_data) 
{
    $trim_data = '';
    if ($array_data!="") {
        foreach ($array_data as $id) { $trim_data .= $id.","; }
        $trim_data = rtrim($trim_data,',');
    } else{
        $trim_data = NULL;
    }
    return $trim_data;
}

function t($campo_original, $lenguaje = 1)
{
    $ci = get_instance();

    $ci->db->where('CampoOriginal_IdiTRad',$campo_original); 
    // $ci->db->where('Traduccion_IdiTrad != ',NULL);    
    $ci->db->where('Id_Idi',$lenguaje);
    $traduccion = $campo_original;
    $data = $ci->db->get('idioma_traductor');
    if($data->num_rows()>0){
        if ($data->row_array()['Traduccion_IdiTrad']!=NULL) {
            $traduccion = $data->row_array()['Traduccion_IdiTrad'];
        }        
    } else {
        $result = $ci->db->insert(
            'idioma_traductor', 
            array(
                'CampoOriginal_IdiTRad'=>$campo_original,
                'Id_Idi'=>$lenguaje
            )
        );
    }
    return $traduccion;
}

// (Elemento seleccionado, Filtro por tipo o estado unicamente mediante where in (1,2..#))
function ListadoCuentas($id_selected='', $where=[], $js = false)
{
   // $where = ['Id_EstCue' => [1,2,3,4]];
   $ci = get_instance();
   $ci->db->select('Id_Cue, Nombre_Cue');
   if (count($where)>0) {
        foreach ($where as $id => $val_array) {
            $ci->db->where_in($id,$val_array);
        }
       
   }
   // $ci->db->group_by('Id_CueTip');
   $data = $ci->db->get('cuentas')->result();
   foreach ($data as $o ) {
       echo ($js==false) ?  '<optgroup label="'.strtoupper($o->Nombre_Cue).'">' : '\'<optgroup label="'.strtoupper($o->Nombre_Cue).'">\'+';
       getArbolCuentas($o->Id_Cue, $id_selected, $js);
       echo ($js==false) ? '</optgroup>' : '\'</optgroup>\'+';
   }
}
function getArbolCuentas($parent_id = 1, $id_selected, $js, $sub = '') {
    $ci = get_instance();
    $ci->db->where('Id_Cue_CuentaPadre', $parent_id);
    $ci->db->order_by('Cuenta_Cue', 'ASC');
    $cuentas = $ci->db->get('cuentas')->result();;
    if ($cuentas) {
        foreach ($cuentas as $v) {
            $selected = ($v->Id_Cue == $id_selected) ? 'selected' : '' ;
            $value = $sub.$v->Nombre_Cue." [".$v->Cuenta_Cue."]";
            
            if ($js==false) {
                echo "<option value='".$v->Id_Cue."' ".$selected.">".$value."</option>";
            } else {
                echo '\'<option value="'.$v->Id_Cue.'"  '.$selected.'> '.$value.'</option>\'+';
            }
            
            if ($parent_id != $v->Id_Cue) {
               getArbolCuentas($v->Id_Cue, $id_selected, $js, $sub.'&nbsp&nbsp&nbsp');
            }
        }
    }
}

function get_type_documento_string($Id_DocTip, &$name = Null)
{
    switch ($Id_DocTip) {
        case '1':
            // Ingresos
            $type = "income";
            $name = "venta";
            break;
        case '2':
            // egresos
            $type = "expenses";
            $name = "compra";
            break;
        default:
            $type = "";
            $name = "";
            break;
    }
    return $type;
}

function validar_numeracion_documentos()
{
    $ci = get_instance();
    $message = "";
    $ci->load->model('Numeracion_documentos_model');
    if ($ci->Numeracion_documentos_model->total_rows() < 1) {
        $message = 'Configurar numeración de documentos <a href="'.site_url("numeracion_documentos/create").'" class="btn btn-link">Ir a la configuración</a>';
    }

    $ci->load->model('Numeracion_facturas_model');
    if ($ci->Numeracion_facturas_model->total_rows() < 1) {
        $message .= '<br>Configurar resolución de facturas <a href="'.site_url("numeracion_facturas").'" class="btn btn-link">Ir a la configuración</a>';
    }

    if ($message != "") {
        $ci->session->set_flashdata('message', $message);
    }
}