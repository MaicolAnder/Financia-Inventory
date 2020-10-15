<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2020, Popayán
*/

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transacciones_model extends CI_Model
{

    public $table = 'transacciones';
    public $id = 'Id_Tran';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json(
        $search_fields=[],
        $links=[],
        $view = 'transacciones',
        $elements = 'Id_Tran,Numero_Tran,Fecha_Tran,NotaVisible_Tran,DocumentoAsociado_Tran,FechaRegistro_Tran,Id_TranTip,Id_TranEst,Id_Ban,Id_Usu,Id_Per,Id_Tran_TransaccionParcial,Primary_Usu', 
        $find_id = 'Id_Tran',
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
        //$this->datatables->join('table2', 'transacciones.field = table2.field');
        //$this->datatables->add_column('action', anchor(site_url('transacciones/read/$1'),'Read')." | ".anchor(site_url('transacciones/update/$1'),'Update')." | ".anchor(site_url('transacciones/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), $find_id);
        // Métodos estaticos para link en respuesta de datatables
        // $this->datatables->add_column('ver', anchor(site_url('transacciones/read/$1'),'<i class="fas fa-eye"></i>',array('title'=>'Ver registro','class' => 'btn btn-info')),$find_id);
        // $this->datatables->add_column('actualizar', anchor(site_url('transacciones/update/$1'),'<i class="fas fa-pencil-alt"></i>',array('title'=>'Actualizar','class' => 'btn btn-primary2')),$find_id);
        // $this->datatables->add_column('eliminar', anchor(site_url('transacciones/delete/$1'),'<i class="fas fa-trash-alt"></i>',array('title'=>'Eliminar','class' => 'btn btn-danger', 'onclick'=>'javasciprt: return confirm(\'¿Esta seguro?\')')),$find_id);

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
			$this->db->like('Id_Tran', $q);
			$this->db->or_like('Numero_Tran', $q);
			$this->db->or_like('Fecha_Tran', $q);
			$this->db->or_like('NotaVisible_Tran', $q);
			$this->db->or_like('DocumentoAsociado_Tran', $q);
			$this->db->or_like('FechaRegistro_Tran', $q);
			$this->db->or_like('Id_TranTip', $q);
			$this->db->or_like('Id_TranEst', $q);
			$this->db->or_like('Id_Ban', $q);
			$this->db->or_like('Id_Usu', $q);
			$this->db->or_like('Id_Per', $q);
			$this->db->or_like('Id_Tran_TransaccionParcial', $q);
			$this->db->or_like('Primary_Usu', $q);
		}
    
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $order = []) {
		$this->db->where($this->table.'.Primary_Usu', $this->session->userdata('Primary_Usu'));
        if ($q != NULL) { 
			$this->db->like('Id_Tran', $q);
			$this->db->or_like('Numero_Tran', $q);
			$this->db->or_like('Fecha_Tran', $q);
			$this->db->or_like('NotaVisible_Tran', $q);
			$this->db->or_like('DocumentoAsociado_Tran', $q);
			$this->db->or_like('FechaRegistro_Tran', $q);
			$this->db->or_like('Id_TranTip', $q);
			$this->db->or_like('Id_TranEst', $q);
			$this->db->or_like('Id_Ban', $q);
			$this->db->or_like('Id_Usu', $q);
			$this->db->or_like('Id_Per', $q);
			$this->db->or_like('Id_Tran_TransaccionParcial', $q);
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
            $this->db->select('bancos.*');
            $this->db->select('persona.*');
            $this->db->select('transaccion_estado.*');
            $this->db->select('transaccion_tipo.*');
            $this->db->select('transaccionparcial.*');
            $this->db->select('usuario.*');
		} else{
            $this->db->select($elements);
        }
        $this->db->join('bancos', $this->table.'.Id_Ban = bancos.Id_Ban', $join_type);
        $this->db->join('persona', $this->table.'.Id_Per = persona.Id_Per', $join_type);
        $this->db->join('transaccion_estado', $this->table.'.Id_TranEst = transaccion_estado.Id_TranEst', $join_type);
        $this->db->join('transaccion_tipo', $this->table.'.Id_TranTip = transaccion_tipo.Id_TranTip', $join_type);
        $this->db->join('transacciones AS transaccionparcial', $this->table.'.Id_Tran_TransaccionParcial = transaccionparcial.Id_Tran', $join_type);
        $this->db->join('usuario', $this->table.'.Id_Usu = usuario.Id_Usu', $join_type);
		$this->db->where($this->table.'.Primary_Usu', $this->session->userdata('Primary_Usu'));
	
        $this->db->where($this->table.'.'.$this->id, $id);
        return $this->db->get($this->table)->row();
    }
	
    function get_foreing_all($elements='*', $where=[], $join_type='LEFT', $order=[], $limit=[], $group=[], $having=[])
    {
        if($elements=='*'){
            $this->db->select($this->table.'.*');
            $this->db->select('bancos.*');
            $this->db->select('persona.*');
            $this->db->select('transaccion_estado.*');
            $this->db->select('transaccion_tipo.*');
            $this->db->select('transaccionparcial.*');
            $this->db->select('usuario.*');
		} else{
            $this->db->select($elements);
        }
        $this->db->join('bancos', $this->table.'.Id_Ban = bancos.Id_Ban', $join_type);
        $this->db->join('persona', $this->table.'.Id_Per = persona.Id_Per', $join_type);
        $this->db->join('transaccion_estado', $this->table.'.Id_TranEst = transaccion_estado.Id_TranEst', $join_type);
        $this->db->join('transaccion_tipo', $this->table.'.Id_TranTip = transaccion_tipo.Id_TranTip', $join_type);
        $this->db->join('transacciones AS transaccionparcial', $this->table.'.Id_Tran_TransaccionParcial = transaccionparcial.Id_Tran', $join_type);
        $this->db->join('usuario', $this->table.'.Id_Usu = usuario.Id_Usu', $join_type);
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
	 
    // funciones anidada para la tabla bancos 
    function get_foreing_Id_Ban($elements='*', $where=[], $join_type='INNER', $order=[], $limit=[], $group=[], $having=[])
    {
        if($elements=='*'){ 
	
            $this->db->select('bancos.*,'.$this->table.'.*');
            $this->db->join('bancos', $this->table.'.Id_Ban = bancos.Id_Ban', $join_type);
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
	 
    // funciones anidada para la tabla persona 
    function get_foreing_Id_Per($elements='*', $where=[], $join_type='INNER', $order=[], $limit=[], $group=[], $having=[])
    {
        if($elements=='*'){ 
	
            $this->db->select('persona.*,'.$this->table.'.*');
            $this->db->join('persona', $this->table.'.Id_Per = persona.Id_Per', $join_type);
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
	 
    // funciones anidada para la tabla transaccion_estado 
    function get_foreing_Id_TranEst($elements='*', $where=[], $join_type='INNER', $order=[], $limit=[], $group=[], $having=[])
    {
        if($elements=='*'){ 
	
            $this->db->select('transaccion_estado.*,'.$this->table.'.*');
            $this->db->join('transaccion_estado', $this->table.'.Id_TranEst = transaccion_estado.Id_TranEst', $join_type);
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
	 
    // funciones anidada para la tabla transaccion_tipo 
    function get_foreing_Id_TranTip($elements='*', $where=[], $join_type='INNER', $order=[], $limit=[], $group=[], $having=[])
    {
        if($elements=='*'){ 
	
            $this->db->select('transaccion_tipo.*,'.$this->table.'.*');
            $this->db->join('transaccion_tipo', $this->table.'.Id_TranTip = transaccion_tipo.Id_TranTip', $join_type);
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
	 
    // funciones anidada para la tabla transacciones 
    function get_foreing_Id_Tran_TransaccionParcial($elements='*', $where=[], $join_type='INNER', $order=[], $limit=[], $group=[], $having=[])
    {
        if($elements=='*'){ 
	
            $this->db->select('transaccionparcial.*,'.$this->table.'.*');
            $this->db->join('transacciones AS transaccionparcial', $this->table.'.Id_Tran_TransaccionParcial = transaccionparcial.Id_Tran', $join_type);
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
	 
    // funciones anidada para la tabla usuario 
    function get_foreing_Id_Usu($elements='*', $where=[], $join_type='INNER', $order=[], $limit=[], $group=[], $having=[])
    {
        if($elements=='*'){ 
	
            $this->db->select('usuario.*,'.$this->table.'.*');
            $this->db->join('usuario', $this->table.'.Id_Usu = usuario.Id_Usu', $join_type);
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

/* End of file Transacciones_model.php */
/* Location: ./application/models/Transacciones_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-10 01:50:24 */
/* www.margunsoft.com */