<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2020, Popayán
*/

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vw_persona_model extends CI_Model
{

    public $table = 'vw_persona';
    public $id = 'Id_Per';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json(
        $search_fields=[],
        $links=[],
        $view = 'vw_persona',
        $elements = 'Id_Per,Identificacion_Per,Nombre1_Per,Nombre2_Per,Apeliido1_Per,Apellido2_Per,TelCelular_Per,Correo_Per,Nombre_Num,Estado_PerEst,Descripcion_PerTip,Descripcion_PerTipId,Codigo_PerTipId,FechaNacimiento_Per,Nombre_Dep,Descripcion_PerGen,Codigo_PerGen,Id_PerTipId,Id_PerGen,Id_Mun,Id_PerEst,Id_PerTip,Telefono_Per,FechaRegistro_Per,Celular_Per,Direccion_Per,Nombre_Emp,Primary_Usu', 
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
        //$this->datatables->join('table2', 'vw_persona.field = table2.field');
        //$this->datatables->add_column('action', anchor(site_url('vw_persona/read/$1'),'Read')." | ".anchor(site_url('vw_persona/update/$1'),'Update')." | ".anchor(site_url('vw_persona/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), $find_id);
        // Métodos estaticos para link en respuesta de datatables
        // $this->datatables->add_column('ver', anchor(site_url('vw_persona/read/$1'),'<i class="fas fa-eye"></i>',array('title'=>'Ver registro','class' => 'btn btn-info')),$find_id);
        // $this->datatables->add_column('actualizar', anchor(site_url('vw_persona/update/$1'),'<i class="fas fa-pencil-alt"></i>',array('title'=>'Actualizar','class' => 'btn btn-primary2')),$find_id);
        // $this->datatables->add_column('eliminar', anchor(site_url('vw_persona/delete/$1'),'<i class="fas fa-trash-alt"></i>',array('title'=>'Eliminar','class' => 'btn btn-danger', 'onclick'=>'javasciprt: return confirm(\'¿Esta seguro?\')')),$find_id);

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
			$this->db->or_like('Id_Per', $q);
			$this->db->or_like('Identificacion_Per', $q);
			$this->db->or_like('Nombre1_Per', $q);
			$this->db->or_like('Nombre2_Per', $q);
			$this->db->or_like('Apeliido1_Per', $q);
			$this->db->or_like('Apellido2_Per', $q);
			$this->db->or_like('TelCelular_Per', $q);
			$this->db->or_like('Correo_Per', $q);
			$this->db->or_like('Nombre_Num', $q);
			$this->db->or_like('Estado_PerEst', $q);
			$this->db->or_like('Descripcion_PerTip', $q);
			$this->db->or_like('Descripcion_PerTipId', $q);
			$this->db->or_like('Codigo_PerTipId', $q);
			$this->db->or_like('FechaNacimiento_Per', $q);
			$this->db->or_like('Nombre_Dep', $q);
			$this->db->or_like('Descripcion_PerGen', $q);
			$this->db->or_like('Codigo_PerGen', $q);
			$this->db->or_like('Id_PerTipId', $q);
			$this->db->or_like('Id_PerGen', $q);
			$this->db->or_like('Id_Mun', $q);
			$this->db->or_like('Id_PerEst', $q);
			$this->db->or_like('Id_PerTip', $q);
			$this->db->or_like('Telefono_Per', $q);
			$this->db->or_like('FechaRegistro_Per', $q);
			$this->db->or_like('Celular_Per', $q);
			$this->db->or_like('Direccion_Per', $q);
			$this->db->or_like('Nombre_Emp', $q);
			$this->db->or_like('Primary_Usu', $q);
		}
    
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $order = []) {
		$this->db->where($this->table.'.Primary_Usu', $this->session->userdata('Primary_Usu'));
        if ($q != NULL) { 
			$this->db->where('1','1');
			$this->db->or_like('Id_Per', $q);
			$this->db->or_like('Identificacion_Per', $q);
			$this->db->or_like('Nombre1_Per', $q);
			$this->db->or_like('Nombre2_Per', $q);
			$this->db->or_like('Apeliido1_Per', $q);
			$this->db->or_like('Apellido2_Per', $q);
			$this->db->or_like('TelCelular_Per', $q);
			$this->db->or_like('Correo_Per', $q);
			$this->db->or_like('Nombre_Num', $q);
			$this->db->or_like('Estado_PerEst', $q);
			$this->db->or_like('Descripcion_PerTip', $q);
			$this->db->or_like('Descripcion_PerTipId', $q);
			$this->db->or_like('Codigo_PerTipId', $q);
			$this->db->or_like('FechaNacimiento_Per', $q);
			$this->db->or_like('Nombre_Dep', $q);
			$this->db->or_like('Descripcion_PerGen', $q);
			$this->db->or_like('Codigo_PerGen', $q);
			$this->db->or_like('Id_PerTipId', $q);
			$this->db->or_like('Id_PerGen', $q);
			$this->db->or_like('Id_Mun', $q);
			$this->db->or_like('Id_PerEst', $q);
			$this->db->or_like('Id_PerTip', $q);
			$this->db->or_like('Telefono_Per', $q);
			$this->db->or_like('FechaRegistro_Per', $q);
			$this->db->or_like('Celular_Per', $q);
			$this->db->or_like('Direccion_Per', $q);
			$this->db->or_like('Nombre_Emp', $q);
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
	 
}

/* End of file Vw_persona_model.php */
/* Location: ./application/models/Vw_persona_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-10 01:50:32 */
/* www.margunsoft.com */