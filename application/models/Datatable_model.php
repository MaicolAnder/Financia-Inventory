<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    2019, Popayán
*/

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Datatable_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function start_datatable($columns, $view, &$totalData, &$totalFiltered, $where = [] )
    {
        $columns = explode(',', $columns);
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $dataForm = json_decode($this->input->post('filter_dataForm'));
        // $where = array();
        if (!empty($dataForm)) {
            foreach ($dataForm as $value) {
                if ($value->value!='') {
                    unset($find);
                    $find['value'] = $value->value;
                    $find['field'] = $value->name;
                    array_push($where, $find);
                }
            }
        }

        $search = $this->input->post('search')['value'];
        $result_array =  $this->Datatable_model->search_data($view, $columns, $limit,$start,$search,$order,$dir, $where);
        $totalFiltered = $this->Datatable_model->search_data_count($view, $columns, $search, $where);
        $totalData = $this->Datatable_model->get_data_count($view, $where);
        
        return $result_array;
    }

    function get_data_count($view, $where)
    {   
        if (count($where)>0) {
            foreach ($where as $values) {
                // $this->db->where($values['field'], $values['value']);
                if (stripos($values['field'], 'OR ', 0) !==FALSE ) {
                    validate_where($values['field'], $values['value'], 'OR');
                } else {
                    validate_where($values['field'], $values['value']);
                }
            }
        }
        $query = $this->db->get($view);
        return $query->num_rows();  

    }
    
    function get_data($view, $limit,$start,$col,$dir)
    {   
       $query = $this->db->limit($limit,$start)->order_by($col,$dir)->get($view);        
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
        
    }
   
    function search_data($view, $columns, $limit,$start,$search,$col,$dir, $where)
    {
        //  ver_array($where);
        if (count($where)>0) {
            foreach ($where as $values) {
                // $this->db->where($values['field'], $values['value']);
                if (stripos($values['field'], 'OR ', 0) !==FALSE ) {
                    validate_where($values['field'], $values['value'], 'OR');
                } else {
                    validate_where($values['field'], $values['value']);
                }
            }
        }

        if ($search != '') {
            $this->db->group_start();
            foreach ($columns as $column_name) {
                $this->db->or_like($column_name, $search);  
            }
            $this->db->group_end();
        }
        

        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $query = $this->db->get($view);
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }

    function search_data_count($view, $columns, $search, $where)
    {
        if (count($where)>0) {
            foreach ($where as $values) {
                // $this->db->where($values['field'], $values['value']);
                if (stripos($values['field'], 'OR ', 0) !==FALSE ) {
                    validate_where($values['field'], $values['value'], 'OR');
                } else {
                    validate_where($values['field'], $values['value']);
                }
            }
        }
        if ($search != '') {
            $this->db->group_start();
            foreach ($columns as $column_name) {
                $this->db->or_like($column_name, $search);  
            }
            $this->db->group_end();
        }
        $query = $this->db->get($view);
        return $query->num_rows();
    }
    public function output_datatable($totalData, $totalFiltered, $data)
    {
        $json_data = array(
                        "draw"            => intval($this->input->post('draw')),  
                        "recordsTotal"    => intval($totalData),  
                        "recordsFiltered" => intval($totalFiltered), 
                        "data"            => $data   
                    );
            
        echo json_encode($json_data);
    }

    /****************
    *
    *  SEGUNDA FORMA DATATABLES
    *
    *******************/
    public function showEmployees($sql, $elements)
    {
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }
        $valid_columns = explode(',', $elements);
        /* $valid_columns = array(
            0=>'emp_no',
            1=>'birth_date',
            2=>'first_name',
            3=>'last_name',
            4=>'gender',
            5=>'hire_date',
        ); */
        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }
        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        
        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }                 
        }
        $this->db->limit($length,$start);
        $employees = $this->db->get($sql);
        $data = array();
        foreach($employees->result() as $rows)
        {

            $data[]= array(
                $rows->emp_no,
                $rows->birth_date,
                $rows->first_name,
                $rows->last_name,
                $rows->gender,
                $rows->hire_date,
                '<a href="#" class="btn btn-warning mr-1">Edit</a>
                 <a href="#" class="btn btn-danger mr-1">Delete</a>'
            );     
        }
        $total_employees = $this->totalEmployees();
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_employees,
            "recordsFiltered" => $total_employees,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }
    public function totalEmployees()
    {
        $query = $this->db->select("COUNT(*) as num")->get("employees");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }
}

/* End of file Permiso_model.php */
/* Location: ./application/models/Permiso_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-10-23 06:47:42 */
/* http://harviacode.com */