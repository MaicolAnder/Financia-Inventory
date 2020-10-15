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

    function start_datatable($columns, $sql, &$totalData, &$totalFiltered )
    {
        $columns = explode(',', $columns);
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  
        $totalData = $this->Datatable_model->get_data_count($sql);
        $totalFiltered = $totalData; 

        $dataForm = json_decode(validar_post('filter_dataForm'));
        $where = array();
        foreach ($dataForm as $value) {
            if ($value->value!='') {
                $find['value'] = $value->value;
                $find['field'] = $value->name;
                array_push($where, $find);
            }
        }
        // echo count($where);
        if(empty($this->input->post('search')['value']) || count($where) < 1)
        {            
            $result_array = $this->Datatable_model->get_data($sql, $limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $result_array =  $this->Datatable_model->search_data($sql, $columns, $limit,$start,$search,$order,$dir, $where);

            $totalFiltered = $this->Datatable_model->search_data_count($sql, $columns, $search, $where);
        }
        return $result_array;
    }
    function start($sql){

    }
    function get_data_count($sql)
    {   
        $query = $this->db->get($sql);
        return $query->num_rows();  

    }
    
    function get_data($sql, $limit,$start,$col,$dir)
    {   
       $query = $this->db->limit($limit,$start)->order_by($col,$dir)->get($sql);        
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
        
    }
   
    function search_data($sql, $columns, $limit,$start,$search,$col,$dir, $where)
    {
        // ver_array($where);
        if (count($where)>0) {
            foreach ($where as $values) {
                $this->db->where($values['field'], $values['value']);
            }
        }

        $this->db->like('1', '1');
        foreach ($columns as $column_name) {
            $this->db->or_like($column_name, $search);  
        }

        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $query = $this->db->get($sql);
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }

    function search_data_count($sql, $columns, $search, $where)
    {
        if (count($where)>0) {
            foreach ($where as $values) {
                $this->db->where($values['field'], $values['value']);
            }
        }

        $this->db->like('1', '1');
        foreach ($columns as $column_name) {
            $this->db->or_like($column_name, $search);  
        }
        $query = $this->db->get($sql);
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