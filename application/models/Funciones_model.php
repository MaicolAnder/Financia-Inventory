<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2020, Popayán
*/

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Funciones_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_KardexTotal_by_document($Id_Doc){
        $this->db->where('Id_Doc', $Id_Doc);
        $rs = $this->db->get('vw_kardex')->result();
        // ver_array($rs);
        $total = 0;
        foreach ($rs as $value) {
            $total = $total + doubleval($value->total);
        }
        return $total;

    }
    function get_totalKardex_by_document($Id_Doc) {
        $total = 0;
        $descuentos = 0;
        $impuestos = 0;
        $sub_total = 0;
        $this->db->where('Id_Doc', $Id_Doc);
        $kardex = $this->db->get('kardex')->result();
        $this->load->model('Impuestos_kardex_model');
        foreach ($kardex as $coun => $k) {
            $sum_impuesto = 0;
            $sum_subtotal = $k->Costo_Kar * $k->Cantidad_Kar;
            
            $descuento = $sum_subtotal * $k->Descuento_Kar/100;
            $descuentos = $descuentos + $descuento;

            $imp = $this->Impuestos_kardex_model->get_foreing_Id_Imp('*', ['impuestos_kardex.Id_kar'=>$k->Id_kar]);
            if ($imp) {
                foreach ($imp as $v) {
                    $sum_impuesto = $sum_impuesto + $v->Valor_Imp;
                }
            }
            $impuesto = ($sum_subtotal - $descuento) * $sum_impuesto/100;
            $impuestos = $impuestos + $impuesto;
            $subtotal = $sum_subtotal - $descuento + $impuesto;
            $sub_total = $sub_total + $sum_subtotal;
            $total = $total + $subtotal;
        }
        return $total;
    }
    function get_totalTransaction_by_id($Id_Tran="") {
        $total = 0;
        $descuentos = 0;
        $impuestos = 0;
        $sub_total = 0;
        
        $this->load->model('Transaccion_detalle_model');
        $rs = $this->Transaccion_detalle_model->get_foreing_Id_Imp('*', ['transaccion_detalle.Id_Tran'=>$Id_Tran], 'LEFT');
            
        foreach ($rs as $coun => $k) {
            $sum_subtotal = $k->Valor_TranDet * $k->Cantidad_TranDet;
            $impuesto = $sum_subtotal * $k->Valor_Imp/100;
            $subtotal = $sum_subtotal  + $impuesto;
            $total = $total + $subtotal;
        }
        return $total;
    }

    function getLike_contactos($like_array, $type)
    {
        $select = "persona.Id_Per AS id,
        CONCAT(
            '(',
            COALESCE ( Identificacion_Per, '' ),
            ') ',
            COALESCE ( Nombre1_Per, '' ),
            ' ',
            COALESCE ( Nombre2_Per, '' ),
            ' ',
            COALESCE ( Apeliido1_Per, '' ),
            ' ',
            COALESCE ( Apellido2_Per, '' ) 
        ) AS text";
        $this->db->select($select);
        $this->db->where('Primary_Usu', $this->session->userdata('Primary_Usu'));
        $this->db->where_in('Id_PerTip', array(3,$type));
        if (count($like_array) > 0) {
            $this->db->group_start();
            foreach($like_array as $key => $value) {
                if($key == 0) {
                    $this->db->like('Identificacion_Per', $value);
                    $this->db->or_like('Nombre1_Per', $value);
                    $this->db->or_like('Nombre2_Per', $value);
                    $this->db->or_like('Apeliido1_Per', $value);
                    $this->db->or_like('Apellido2_Per', $value);
                } else {
                    $this->db->or_like('Identificacion_Per', $value);
                    $this->db->or_like('Nombre1_Per', $value);
                    $this->db->or_like('Nombre2_Per', $value);
                    $this->db->or_like('Apeliido1_Per', $value);
                    $this->db->or_like('Apellido2_Per', $value);
                }
            }
            $this->db->group_end();
        }
        $this->db->limit(60);
        return $this->db->get('persona')->result_array();
    }

    // datatables
    function json(
        $search_fields=[],
        $links=[],
        $view = 'kardex',
        $elements = 'Id_kar,Cantidad_Kar,Costo_Kar,Descuento_Kar,Aceptado_Kar,Observacion_Kar,FactorMovimiento_Kar,Id_Doc,Id_Ite,Id_Med,Id_Bod,Id_KarTip,Id_KarEst,Primary_Usu', 
        $find_id = 'Id_kar',
        $join=[]) {
  
        $this->datatables->select($elements);
        $this->datatables->from($view);

        if (count($join)>0) {
            foreach ($join as $array_join) {
                $this->datatables->join($array_join[0], $array_join[1], $array_join[2]);
            }
        }
		$this->datatables->where($view.'.Primary_Usu', $this->session->userdata('Primary_Usu'));


        if (count($search_fields)>0) {
            foreach ($search_fields as $values) {
                $this->datatables->where($values['field'], $values['value']);
            }
        }

        //add this line for join
        //$this->datatables->join('table2', 'kardex.field = table2.field');
        //$this->datatables->add_column('action', anchor(site_url('kardex/read/$1'),'Read')." | ".anchor(site_url('kardex/update/$1'),'Update')." | ".anchor(site_url('kardex/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), $find_id);
        // Métodos estaticos para link en respuesta de datatables
        // $this->datatables->add_column('ver', anchor(site_url('kardex/read/$1'),'<i class="fas fa-eye"></i>',array('title'=>'Ver registro','class' => 'btn btn-info')),$find_id);
        // $this->datatables->add_column('actualizar', anchor(site_url('kardex/update/$1'),'<i class="fas fa-pencil-alt"></i>',array('title'=>'Actualizar','class' => 'btn btn-primary2')),$find_id);
        // $this->datatables->add_column('eliminar', anchor(site_url('kardex/delete/$1'),'<i class="fas fa-trash-alt"></i>',array('title'=>'Eliminar','class' => 'btn btn-danger', 'onclick'=>'javasciprt: return confirm(\'¿Esta seguro?\')')),$find_id);

        // Metodo dinamico para generación de links
        if (count($links)>0) {
            foreach ($links as $key) {
                $this->datatables->add_column(
                    $key['name_link'], 
                    anchor(
                        site_url($key['site_url']),
                        $key['link_txt'],
                        $key['atributos']
                    ),
                    $find_id);
            }            
        }
        return $this->datatables->generate();
    }


    //Consultas libres por SQL enviados desde el controlador
    function sql($sql='', &$total_rows=0) {
        
        $query = $this->db->query($sql);
        if (is_object($query))
        {
            $total_rows = $query->num_rows();
            return $query->result();
            
        } else {
            $total_rows = $query;
            return $query;
        }
    }

    // get joins table
    function get_join(&$total_rows=0, $elements, $join=[], $where=[], $order=[], $limit=[], $group=[], $having=[]){
         /*
         $join = array(
                    array('table','union_id','type_join'), 
                    array('table1','union_id','type_join'),
                    array('table2','union_id','type_join')
                )
        */
        // $elements = 'tbl_user.username,tbl_user.userid,tbl_usercategory.typee'

        $this->db->select($elements);
        $this->db->from($this->table);
        if (count($join)>0) {
            foreach ($join as $array_join) {
                $this->db->join($array_join[0], $array_join[1], $array_join[2]);
            }
        }
		$this->db->where($this->table.'.Primary_Usu', $this->session->userdata('Primary_Usu'));

        if (count($where)>0) {
            foreach ($where as $field => $value) {
                if (stripos($field, 'OR ', 0) !==FALSE ) {
                    validate_where($field, $value, 'OR');
                } else {
                    validate_where($field, $value);
                }
            }
        }
        if (count($group)>0) {
            foreach ($group as $field) {
                $this->db->group_by($field);
            }
        }
        if (count($having)>0) {
            foreach ($having as $field => $value) {
                $this->db->having($field, $value);
            }
        }
        if (count($order)>0) {
            foreach ($order as $by => $order) {
                $this->db->order_by($by, $order);
            }
        } else {
            $this->db->order_by($this->id, $this->order);
        }
        if (count($limit)>0) {
            if (count($limit)==2) {
                $this->db->limit($limit[0], $limit[1]);
            } else {
                $this->db->limit($limit[0]);
            }
        }
        $query = $this->db->get();
        $total_rows = $query->num_rows();
        return $query->result();
    }

    // get all
    function get_all($elements='*', $where=[], $order=[], $limit=[], $group=[], $having=[])
    {
        $this->db->select($elements);
		$this->db->where($this->table.'.Primary_Usu', $this->session->userdata('Primary_Usu'));

        if (count($where)>0) {
            foreach ($where as $field => $value) {
                if (stripos($field, 'OR ', 0) !==FALSE ) {
                    validate_where($field, $value, 'OR');
                } else {
                    validate_where($field, $value);
                }
            }
        }
        if (count($group)>0) {
            foreach ($group as $field) {
                $this->db->group_by($field);
            }
        }
        if (count($having)>0) {
            foreach ($having as $field => $value) {
                $this->db->having($field, $value);
            }
        }
        if (count($order)>0) {
            foreach ($order as $by => $order) {
                $this->db->order_by($by, $order);
            }
        } else {
            $this->db->order_by($this->id, $this->order);
        }
        if (count($limit)>0) {
            if (count($limit)==2) {
                $this->db->limit($limit[0], $limit[1]);
            } else {
                $this->db->limit($limit[0]);
            }
            
        }
        $query = $this->db->get($this->table);
        // $total_rows = $query->num_rows();
        return $query->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $id = ($id != '') ? intval($id) : -1 ;
		$this->db->where($this->table.'.Primary_Usu', $this->session->userdata('Primary_Usu'));
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
		$this->db->where($this->table.'.Primary_Usu', $this->session->userdata('Primary_Usu'));
        if ($q != NULL) {
			$this->db->like('Id_kar', $q);
			$this->db->or_like('Cantidad_Kar', $q);
			$this->db->or_like('Costo_Kar', $q);
			$this->db->or_like('Descuento_Kar', $q);
			$this->db->or_like('Aceptado_Kar', $q);
			$this->db->or_like('Observacion_Kar', $q);
			$this->db->or_like('FactorMovimiento_Kar', $q);
			$this->db->or_like('Id_Doc', $q);
			$this->db->or_like('Id_Ite', $q);
			$this->db->or_like('Id_Med', $q);
			$this->db->or_like('Id_Bod', $q);
			$this->db->or_like('Id_KarTip', $q);
			$this->db->or_like('Id_KarEst', $q);
			$this->db->or_like('Primary_Usu', $q);
		}
    
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $order = []) {
		$this->db->where($this->table.'.Primary_Usu', $this->session->userdata('Primary_Usu'));
        if ($q != NULL) { 
			$this->db->like('Id_kar', $q);
			$this->db->or_like('Cantidad_Kar', $q);
			$this->db->or_like('Costo_Kar', $q);
			$this->db->or_like('Descuento_Kar', $q);
			$this->db->or_like('Aceptado_Kar', $q);
			$this->db->or_like('Observacion_Kar', $q);
			$this->db->or_like('FactorMovimiento_Kar', $q);
			$this->db->or_like('Id_Doc', $q);
			$this->db->or_like('Id_Ite', $q);
			$this->db->or_like('Id_Med', $q);
			$this->db->or_like('Id_Bod', $q);
			$this->db->or_like('Id_KarTip', $q);
			$this->db->or_like('Id_KarEst', $q);
			$this->db->or_like('Primary_Usu', $q);
	
        }
        if (count($order)>0) {
            foreach ($order as $by => $order) {
                $this->db->order_by($by, $order);
            }
        } else {
            $this->db->order_by($this->id, $this->order);
        }
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    // Insert batch
    function insert_batch($data)
    {
        return $this->db->insert_batch($this->table, $data);
    }

    // update data
    function update($id, $data, $where=[])
    {
        if (count($where)>0) {
            // Inactive id delete
            foreach ($where as $field => $value) {
                if (stripos($field, 'OR ', 0) !==FALSE ) {
                    validate_where($field, $value, 'OR');
                } else {
                    validate_where($field, $value);
                }
            }
        } else {
            //default
            $this->db->where($this->id, $id);
        }
		$this->db->where($this->table.'.Primary_Usu', $this->session->userdata('Primary_Usu'));
        $this->db->update($this->table, $data);
        return $id;
    }
    // Insert batch
    function update_batch($data)
    {
        return $this->db->update_batch($this->table, $data);
    }

    // delete data
    function delete($id, $where=[])
    {
        if (count($where)>0) {
            // Inactive id delete
            foreach ($where as $field => $value) {
                if (stripos($field, 'OR ', 0) !==FALSE ) {
                    validate_where($field, $value, 'OR');
                } else {
                    validate_where($field, $value);
                }
            }
        } else {
            //default
            $this->db->where($this->id, $id);
        }
		$this->db->where($this->table.'.Primary_Usu', $this->session->userdata('Primary_Usu'));
        $this->db->delete($this->table);
        return $id;
    }
	
    function get_foreing_by_id($id, $elements='*', $join_type='LEFT')
    {
        
        if($elements=='*'){
            $this->db->select($this->table.'.*');
            $this->db->select('bodegas.*');
            $this->db->select('documento.*');
            $this->db->select('items.*');
            $this->db->select('kardex_estado.*');
            $this->db->select('kardex_tipo.*');
            $this->db->select('medidas.*');
		} else{
            $this->db->select($elements);
        }
        $this->db->join('bodegas', $this->table.'.Id_Bod = bodegas.Id_Bod', $join_type);
        $this->db->join('documento', $this->table.'.Id_Doc = documento.Id_Doc', $join_type);
        $this->db->join('items', $this->table.'.Id_Ite = items.Id_Ite', $join_type);
        $this->db->join('kardex_estado', $this->table.'.Id_KarEst = kardex_estado.Id_KarEst', $join_type);
        $this->db->join('kardex_tipo', $this->table.'.Id_KarTip = kardex_tipo.Id_KarTip', $join_type);
        $this->db->join('medidas', $this->table.'.Id_Med = medidas.Id_Med', $join_type);
		$this->db->where($this->table.'.Primary_Usu', $this->session->userdata('Primary_Usu'));
	
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
	
    function get_foreing_all($elements='*', $where=[], $join_type='LEFT', $order=[], $limit=[], $group=[], $having=[])
    {
        if($elements=='*'){
            $this->db->select($this->table.'.*');
            $this->db->select('bodegas.*');
            $this->db->select('documento.*');
            $this->db->select('items.*');
            $this->db->select('kardex_estado.*');
            $this->db->select('kardex_tipo.*');
            $this->db->select('medidas.*');
		} else{
            $this->db->select($elements);
        }
        $this->db->join('bodegas', $this->table.'.Id_Bod = bodegas.Id_Bod', $join_type);
        $this->db->join('documento', $this->table.'.Id_Doc = documento.Id_Doc', $join_type);
        $this->db->join('items', $this->table.'.Id_Ite = items.Id_Ite', $join_type);
        $this->db->join('kardex_estado', $this->table.'.Id_KarEst = kardex_estado.Id_KarEst', $join_type);
        $this->db->join('kardex_tipo', $this->table.'.Id_KarTip = kardex_tipo.Id_KarTip', $join_type);
        $this->db->join('medidas', $this->table.'.Id_Med = medidas.Id_Med', $join_type);
		$this->db->where($this->table.'.Primary_Usu', $this->session->userdata('Primary_Usu'));
	
        if (count($where)>0) {
            foreach ($where as $field => $value) {
                if (stripos($field, 'OR ', 0) !==FALSE ) {
                    validate_where($field, $value, 'OR');
                } else {
                    validate_where($field, $value);
                }
            }
        }
        if (count($group)>0) {
            foreach ($group as $field) {
                $this->db->group_by($field);
            }
        }
        if (count($having)>0) {
            foreach ($having as $field => $value) {
                $this->db->having($field, $value);
            }
        }
        if (count($order)>0) {
            foreach ($order as $by => $order) {
                $this->db->order_by($by, $order);
            }
        } else {
            $this->db->order_by($this->table.".".$this->id, $this->order);
        }
        if (count($limit)>0) {
            if (count($limit)==2) {
                $this->db->limit($limit[0], $limit[1]);
            } else {
                $this->db->limit($limit[0]);
            }
            
        }
        $query = $this->db->get($this->table);
        // $total_rows = $query->num_rows();
        return $query->result();
    }
	 
    // funciones anidada para la tabla bodegas 
    function get_foreing_Id_Bod($elements='*', $where=[], $join_type='INNER', $order=[], $limit=[], $group=[], $having=[])
    {
        if($elements=='*'){ 
	
            $this->db->select('bodegas.*,'.$this->table.'.*');
            $this->db->join('bodegas', $this->table.'.Id_Bod = bodegas.Id_Bod', $join_type);
		} else{
            $this->db->select($elements);
        }
		$this->db->where($this->table.'.Primary_Usu', $this->session->userdata('Primary_Usu'));
	 
        if (count($where)>0) {
            foreach ($where as $field => $value) {
                if (stripos($field, 'OR ', 0) !==FALSE ) {
                    validate_where($field, $value, 'OR');
                } else {
                    validate_where($field, $value);
                }
            }
        }
        if (count($group)>0) {
            foreach ($group as $field) {
                $this->db->group_by($field);
            }
        }
        if (count($having)>0) {
            foreach ($having as $field => $value) {
                $this->db->having($field, $value);
            }
        }
        if (count($order)>0) {
            foreach ($order as $by => $order) {
                $this->db->order_by($by, $order);
            }
        } else {
            $this->db->order_by($this->table.".".$this->id, $this->order);
        }
        if (count($limit)>0) {
            if (count($limit)==2) {
                $this->db->limit($limit[0], $limit[1]);
            } else {
                $this->db->limit($limit[0]);
            }
            
        }
        $query = $this->db->get($this->table);
        // $total_rows = $query->num_rows();
        return $query->result();
    }
	 
    // funciones anidada para la tabla documento 
    function get_foreing_Id_Doc($elements='*', $where=[], $join_type='INNER', $order=[], $limit=[], $group=[], $having=[])
    {
        if($elements=='*'){ 
	
            $this->db->select('documento.*,'.$this->table.'.*');
            $this->db->join('documento', $this->table.'.Id_Doc = documento.Id_Doc', $join_type);
		} else{
            $this->db->select($elements);
        }
		$this->db->where($this->table.'.Primary_Usu', $this->session->userdata('Primary_Usu'));
	 
        if (count($where)>0) {
            foreach ($where as $field => $value) {
                if (stripos($field, 'OR ', 0) !==FALSE ) {
                    validate_where($field, $value, 'OR');
                } else {
                    validate_where($field, $value);
                }
            }
        }
        if (count($group)>0) {
            foreach ($group as $field) {
                $this->db->group_by($field);
            }
        }
        if (count($having)>0) {
            foreach ($having as $field => $value) {
                $this->db->having($field, $value);
            }
        }
        if (count($order)>0) {
            foreach ($order as $by => $order) {
                $this->db->order_by($by, $order);
            }
        } else {
            $this->db->order_by($this->table.".".$this->id, $this->order);
        }
        if (count($limit)>0) {
            if (count($limit)==2) {
                $this->db->limit($limit[0], $limit[1]);
            } else {
                $this->db->limit($limit[0]);
            }
            
        }
        $query = $this->db->get($this->table);
        // $total_rows = $query->num_rows();
        return $query->result();
    }
	 
    // funciones anidada para la tabla items 
    function get_foreing_Id_Ite($elements='*', $where=[], $join_type='INNER', $order=[], $limit=[], $group=[], $having=[])
    {
        if($elements=='*'){ 
	
            $this->db->select('items.*,'.$this->table.'.*');
            $this->db->join('items', $this->table.'.Id_Ite = items.Id_Ite', $join_type);
		} else{
            $this->db->select($elements);
        }
		$this->db->where($this->table.'.Primary_Usu', $this->session->userdata('Primary_Usu'));
	 
        if (count($where)>0) {
            foreach ($where as $field => $value) {
                if (stripos($field, 'OR ', 0) !==FALSE ) {
                    validate_where($field, $value, 'OR');
                } else {
                    validate_where($field, $value);
                }
            }
        }
        if (count($group)>0) {
            foreach ($group as $field) {
                $this->db->group_by($field);
            }
        }
        if (count($having)>0) {
            foreach ($having as $field => $value) {
                $this->db->having($field, $value);
            }
        }
        if (count($order)>0) {
            foreach ($order as $by => $order) {
                $this->db->order_by($by, $order);
            }
        } else {
            $this->db->order_by($this->table.".".$this->id, $this->order);
        }
        if (count($limit)>0) {
            if (count($limit)==2) {
                $this->db->limit($limit[0], $limit[1]);
            } else {
                $this->db->limit($limit[0]);
            }
            
        }
        $query = $this->db->get($this->table);
        // $total_rows = $query->num_rows();
        return $query->result();
    }
	 
    // funciones anidada para la tabla kardex_estado 
    function get_foreing_Id_KarEst($elements='*', $where=[], $join_type='INNER', $order=[], $limit=[], $group=[], $having=[])
    {
        if($elements=='*'){ 
	
            $this->db->select('kardex_estado.*,'.$this->table.'.*');
            $this->db->join('kardex_estado', $this->table.'.Id_KarEst = kardex_estado.Id_KarEst', $join_type);
		} else{
            $this->db->select($elements);
        }
		$this->db->where($this->table.'.Primary_Usu', $this->session->userdata('Primary_Usu'));
	 
        if (count($where)>0) {
            foreach ($where as $field => $value) {
                if (stripos($field, 'OR ', 0) !==FALSE ) {
                    validate_where($field, $value, 'OR');
                } else {
                    validate_where($field, $value);
                }
            }
        }
        if (count($group)>0) {
            foreach ($group as $field) {
                $this->db->group_by($field);
            }
        }
        if (count($having)>0) {
            foreach ($having as $field => $value) {
                $this->db->having($field, $value);
            }
        }
        if (count($order)>0) {
            foreach ($order as $by => $order) {
                $this->db->order_by($by, $order);
            }
        } else {
            $this->db->order_by($this->table.".".$this->id, $this->order);
        }
        if (count($limit)>0) {
            if (count($limit)==2) {
                $this->db->limit($limit[0], $limit[1]);
            } else {
                $this->db->limit($limit[0]);
            }
            
        }
        $query = $this->db->get($this->table);
        // $total_rows = $query->num_rows();
        return $query->result();
    }
	 
    // funciones anidada para la tabla kardex_tipo 
    function get_foreing_Id_KarTip($elements='*', $where=[], $join_type='INNER', $order=[], $limit=[], $group=[], $having=[])
    {
        if($elements=='*'){ 
	
            $this->db->select('kardex_tipo.*,'.$this->table.'.*');
            $this->db->join('kardex_tipo', $this->table.'.Id_KarTip = kardex_tipo.Id_KarTip', $join_type);
		} else{
            $this->db->select($elements);
        }
		$this->db->where($this->table.'.Primary_Usu', $this->session->userdata('Primary_Usu'));
	 
        if (count($where)>0) {
            foreach ($where as $field => $value) {
                if (stripos($field, 'OR ', 0) !==FALSE ) {
                    validate_where($field, $value, 'OR');
                } else {
                    validate_where($field, $value);
                }
            }
        }
        if (count($group)>0) {
            foreach ($group as $field) {
                $this->db->group_by($field);
            }
        }
        if (count($having)>0) {
            foreach ($having as $field => $value) {
                $this->db->having($field, $value);
            }
        }
        if (count($order)>0) {
            foreach ($order as $by => $order) {
                $this->db->order_by($by, $order);
            }
        } else {
            $this->db->order_by($this->table.".".$this->id, $this->order);
        }
        if (count($limit)>0) {
            if (count($limit)==2) {
                $this->db->limit($limit[0], $limit[1]);
            } else {
                $this->db->limit($limit[0]);
            }
            
        }
        $query = $this->db->get($this->table);
        // $total_rows = $query->num_rows();
        return $query->result();
    }
	 
    // funciones anidada para la tabla medidas 
    function get_foreing_Id_Med($elements='*', $where=[], $join_type='INNER', $order=[], $limit=[], $group=[], $having=[])
    {
        if($elements=='*'){ 
	
            $this->db->select('medidas.*,'.$this->table.'.*');
            $this->db->join('medidas', $this->table.'.Id_Med = medidas.Id_Med', $join_type);
		} else{
            $this->db->select($elements);
        }
		$this->db->where($this->table.'.Primary_Usu', $this->session->userdata('Primary_Usu'));
	 
        if (count($where)>0) {
            foreach ($where as $field => $value) {
                if (stripos($field, 'OR ', 0) !==FALSE ) {
                    validate_where($field, $value, 'OR');
                } else {
                    validate_where($field, $value);
                }
            }
        }
        if (count($group)>0) {
            foreach ($group as $field) {
                $this->db->group_by($field);
            }
        }
        if (count($having)>0) {
            foreach ($having as $field => $value) {
                $this->db->having($field, $value);
            }
        }
        if (count($order)>0) {
            foreach ($order as $by => $order) {
                $this->db->order_by($by, $order);
            }
        } else {
            $this->db->order_by($this->table.".".$this->id, $this->order);
        }
        if (count($limit)>0) {
            if (count($limit)==2) {
                $this->db->limit($limit[0], $limit[1]);
            } else {
                $this->db->limit($limit[0]);
            }
            
        }
        $query = $this->db->get($this->table);
        // $total_rows = $query->num_rows();
        return $query->result();
    }
	 
}

/* End of file Kardex_model.php */
/* Location: ./application/models/Kardex_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-27 05:39:13 */
/* www.margunsoft.com */