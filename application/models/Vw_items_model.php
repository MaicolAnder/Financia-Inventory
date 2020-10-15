<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2020, Popayán
*/

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vw_items_model extends CI_Model
{

    public $table = 'vw_items';
    public $id = 'Id_Ite';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json(
        $search_fields=[],
        $links=[],
        $view = 'vw_items',
        $elements = 'Id_Ite,Nombre_Ite,Referencia_Ite,Serie_Ite,FechaRegistro_Ite,Inventariable_Ite,Observacion_Ite,Imagen_Item,Primary_Usu,Nombre_CatIte,Nombre_Mar,Nombre_Med,Valor_Med,Nombre_IteTip,Nombre_IteEst,Nombre_Bod,Id_CatIte,Id_Mar,Id_Med,Id_Usu,Id_IteTip,Id_IteEst,Id_Bod', 
        $find_id = '',
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
        //$this->datatables->join('table2', 'vw_items.field = table2.field');
        //$this->datatables->add_column('action', anchor(site_url('vw_items/read/$1'),'Read')." | ".anchor(site_url('vw_items/update/$1'),'Update')." | ".anchor(site_url('vw_items/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), $find_id);
        // Métodos estaticos para link en respuesta de datatables
        // $this->datatables->add_column('ver', anchor(site_url('vw_items/read/$1'),'<i class="fas fa-eye"></i>',array('title'=>'Ver registro','class' => 'btn btn-info')),$find_id);
        // $this->datatables->add_column('actualizar', anchor(site_url('vw_items/update/$1'),'<i class="fas fa-pencil-alt"></i>',array('title'=>'Actualizar','class' => 'btn btn-primary2')),$find_id);
        // $this->datatables->add_column('eliminar', anchor(site_url('vw_items/delete/$1'),'<i class="fas fa-trash-alt"></i>',array('title'=>'Eliminar','class' => 'btn btn-danger', 'onclick'=>'javasciprt: return confirm(\'¿Esta seguro?\')')),$find_id);

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
			$this->db->where('1','1');
			$this->db->or_like('Id_Ite', $q);
			$this->db->or_like('Nombre_Ite', $q);
			$this->db->or_like('Referencia_Ite', $q);
			$this->db->or_like('Serie_Ite', $q);
			$this->db->or_like('FechaRegistro_Ite', $q);
			$this->db->or_like('Inventariable_Ite', $q);
			$this->db->or_like('Observacion_Ite', $q);
			$this->db->or_like('Imagen_Item', $q);
			$this->db->or_like('Primary_Usu', $q);
			$this->db->or_like('Nombre_CatIte', $q);
			$this->db->or_like('Nombre_Mar', $q);
			$this->db->or_like('Nombre_Med', $q);
			$this->db->or_like('Valor_Med', $q);
			$this->db->or_like('Nombre_IteTip', $q);
			$this->db->or_like('Nombre_IteEst', $q);
			$this->db->or_like('Nombre_Bod', $q);
			$this->db->or_like('Id_CatIte', $q);
			$this->db->or_like('Id_Mar', $q);
			$this->db->or_like('Id_Med', $q);
			$this->db->or_like('Id_Usu', $q);
			$this->db->or_like('Id_IteTip', $q);
			$this->db->or_like('Id_IteEst', $q);
			$this->db->or_like('Id_Bod', $q);
		}
    
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $order = []) {
		$this->db->where($this->table.'.Primary_Usu', $this->session->userdata('Primary_Usu'));
        if ($q != NULL) { 
			$this->db->where('1','1');
			$this->db->or_like('Id_Ite', $q);
			$this->db->or_like('Nombre_Ite', $q);
			$this->db->or_like('Referencia_Ite', $q);
			$this->db->or_like('Serie_Ite', $q);
			$this->db->or_like('FechaRegistro_Ite', $q);
			$this->db->or_like('Inventariable_Ite', $q);
			$this->db->or_like('Observacion_Ite', $q);
			$this->db->or_like('Imagen_Item', $q);
			$this->db->or_like('Primary_Usu', $q);
			$this->db->or_like('Nombre_CatIte', $q);
			$this->db->or_like('Nombre_Mar', $q);
			$this->db->or_like('Nombre_Med', $q);
			$this->db->or_like('Valor_Med', $q);
			$this->db->or_like('Nombre_IteTip', $q);
			$this->db->or_like('Nombre_IteEst', $q);
			$this->db->or_like('Nombre_Bod', $q);
			$this->db->or_like('Id_CatIte', $q);
			$this->db->or_like('Id_Mar', $q);
			$this->db->or_like('Id_Med', $q);
			$this->db->or_like('Id_Usu', $q);
			$this->db->or_like('Id_IteTip', $q);
			$this->db->or_like('Id_IteEst', $q);
			$this->db->or_like('Id_Bod', $q);
	
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
	 
}

/* End of file Vw_items_model.php */
/* Location: ./application/models/Vw_items_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-10 01:50:30 */
/* www.margunsoft.com */