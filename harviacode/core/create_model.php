<?php 

$string = "<?php
/*  
    For Miguel A. Tunubalá.
    www.margunsoft.com
    ".date('Y').", Popayán
*/

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class " . $m . " extends CI_Model
{

    public \$table = '$table_name';
    public \$id = '$pk';
    public \$order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }";

if ($jenis_tabel <> 'reguler_table') {

$multitenan = false;    
$column_all = array();
foreach ($all as $row) {
    if ($row['column_name'] == 'Primary_Usu') {
        $multitenan = true;
    }
    $column_all[] = $row['column_name'];
}
$columnall = implode(',', $column_all);
// echo "multitenan ".$multitenan;  
$string .="\n\n    // datatables
    function json(
        \$search_fields=[],
        \$links=[],
        \$view = '".$table_name."',
        \$elements = '".$columnall."', 
        \$find_id = '".$pk."',
        \$join=[]) {
  
        \$this->datatables->select(\$elements);
        \$this->datatables->from(\$view);

        if (count(\$join)>0) {
            foreach (\$join as \$array_join) {
                \$this->datatables->join(\$array_join[0], \$array_join[1], \$array_join[2]);
            }
        }";
        if ($multitenan) {
            $string .="\n\t\t\$this->datatables->where(\$view.'.Primary_Usu', \$this->session->userdata('Primary_Usu'));";
        }
$string .="\n\n
        if (count(\$search_fields)>0) {
            foreach (\$search_fields as \$values) {
                \$this->datatables->where(\$values['field'], \$values['value']);
            }
        }

        //add this line for join
        //\$this->datatables->join('table2', '".$table_name.".field = table2.field');
        //\$this->datatables->add_column('action', anchor(site_url('".$c_url."/read/\$1'),'Read').\" | \".anchor(site_url('".$c_url."/update/\$1'),'Update').\" | \".anchor(site_url('".$c_url."/delete/\$1'),'Delete','onclick=\"javasciprt: return confirm(\\'Are You Sure ?\\')\"'), \$find_id);
        // Métodos estaticos para link en respuesta de datatables
        // \$this->datatables->add_column('ver', anchor(site_url('".$c_url."/read/\$1'),'<i class=\"fas fa-eye\"></i>',array('title'=>'Ver registro','class' => 'btn btn-info')),\$find_id);
        // \$this->datatables->add_column('actualizar', anchor(site_url('".$c_url."/update/\$1'),'<i class=\"fas fa-pencil-alt\"></i>',array('title'=>'Actualizar','class' => 'btn btn-primary2')),\$find_id);
        // \$this->datatables->add_column('eliminar', anchor(site_url('".$c_url."/delete/\$1'),'<i class=\"fas fa-trash-alt\"></i>',array('title'=>'Eliminar','class' => 'btn btn-danger', 'onclick'=>'javasciprt: return confirm(\\'¿Esta seguro?\\')')),\$find_id);

        // Metodo dinamico para generación de links
        if (count(\$links)>0) {
            foreach (\$links as \$key) {
                \$this->datatables->add_column(
                    \$key['name_link'], 
                    anchor(
                        site_url(\$key['site_url']),
                        \$key['link_txt'],
                        \$key['atributos']
                    ),
                    \$find_id);
            }            
        }
        return \$this->datatables->generate();
    }";
}

$string .="\n\n
    //Consultas libres por SQL enviados desde el controlador
    function sql(\$sql='', &\$total_rows=0) {
        
        \$query = \$this->db->query(\$sql);
        if (is_object(\$query))
        {
            \$total_rows = \$query->num_rows();
            return \$query->result();
            
        } else {
            \$total_rows = \$query;
            return \$query;
        }
    }

    // get joins table
    function get_join(&\$total_rows=0, \$elements, \$join=[], \$where=[], \$order=[], \$limit=[], \$group=[], \$having=[]){
         /*
         \$join = array(
                    array('table','union_id','type_join'), 
                    array('table1','union_id','type_join'),
                    array('table2','union_id','type_join')
                )
        */
        // \$elements = 'tbl_user.username,tbl_user.userid,tbl_usercategory.typee'

        \$this->db->select(\$elements);
        \$this->db->from(\$this->table);
        if (count(\$join)>0) {
            foreach (\$join as \$array_join) {
                \$this->db->join(\$array_join[0], \$array_join[1], \$array_join[2]);
            }
        }";
        if ($multitenan) {
            $string .="\n\t\t\$this->db->where(\$this->table.'.Primary_Usu', \$this->session->userdata('Primary_Usu'));";
        }
$string .="\n
        if (count(\$where)>0) {
            foreach (\$where as \$field => \$value) {
                if (stripos(\$field, 'OR ', 0) !==FALSE ) {
                    validate_where(\$field, \$value, 'OR');
                } else {
                    validate_where(\$field, \$value);
                }
            }
        }
        if (count(\$group)>0) {
            foreach (\$group as \$field) {
                \$this->db->group_by(\$field);
            }
        }
        if (count(\$having)>0) {
            foreach (\$having as \$field => \$value) {
                \$this->db->having(\$field, \$value);
            }
        }
        if (count(\$order)>0) {
            foreach (\$order as \$by => \$order) {
                \$this->db->order_by(\$by, \$order);
            }
        } else {
            \$this->db->order_by(\$this->id, \$this->order);
        }
        if (count(\$limit)>0) {
            if (count(\$limit)==2) {
                \$this->db->limit(\$limit[0], \$limit[1]);
            } else {
                \$this->db->limit(\$limit[0]);
            }
        }
        \$query = \$this->db->get();
        \$total_rows = \$query->num_rows();
        return \$query->result();
    }

    // get all
    function get_all(\$elements='*', \$where=[], \$order=[], \$limit=[], \$group=[], \$having=[])
    {
        \$this->db->select(\$elements);";
    if ($multitenan) {
        $string .="\n\t\t\$this->db->where(\$this->table.'.Primary_Usu', \$this->session->userdata('Primary_Usu'));";
    }
$string .="\n
        if (count(\$where)>0) {
            foreach (\$where as \$field => \$value) {
                if (stripos(\$field, 'OR ', 0) !==FALSE ) {
                    validate_where(\$field, \$value, 'OR');
                } else {
                    validate_where(\$field, \$value);
                }
            }
        }
        if (count(\$group)>0) {
            foreach (\$group as \$field) {
                \$this->db->group_by(\$field);
            }
        }
        if (count(\$having)>0) {
            foreach (\$having as \$field => \$value) {
                \$this->db->having(\$field, \$value);
            }
        }
        if (count(\$order)>0) {
            foreach (\$order as \$by => \$order) {
                \$this->db->order_by(\$by, \$order);
            }
        } else {
            \$this->db->order_by(\$this->id, \$this->order);
        }
        if (count(\$limit)>0) {
            if (count(\$limit)==2) {
                \$this->db->limit(\$limit[0], \$limit[1]);
            } else {
                \$this->db->limit(\$limit[0]);
            }
            
        }
        \$query = \$this->db->get(\$this->table);
        // \$total_rows = \$query->num_rows();
        return \$query->result();
    }

    // get data by id
    function get_by_id(\$id)
    {
        \$id = (\$id != '') ? intval(\$id) : -1 ;";
        if ($multitenan) {
            $string .="\n\t\t\$this->db->where(\$this->table.'.Primary_Usu', \$this->session->userdata('Primary_Usu'));";
        }
$string .="
        \$this->db->where(\$this->id, \$id);
        return \$this->db->get(\$this->table)->row();
    }
    
    // get total rows
    function total_rows(\$q = NULL) {";
        if ($multitenan) {
            $string .="\n\t\t\$this->db->where(\$this->table.'.Primary_Usu', \$this->session->userdata('Primary_Usu'));";
        }
$string .="
        if (\$q != NULL) {
            \$this->db->group_start();";
        if ($pk != '') {
            $string .= "\n\t\t\t\$this->db->like('$pk', \$q);";
        } else {
            $string .= "\n\t\t\t\$this->db->where('1','1');";
        }
        foreach ($non_pk as $row) {
            $string .= "\n\t\t\t\$this->db->or_like('" . $row['column_name'] ."', \$q);";
        }    

$string .= "    \$this->db->group_end();
            \n\t\t}
    \n\t\t\$this->db->from(\$this->table);
        return \$this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data(\$limit, \$start = 0, \$q = NULL, \$order = []) {";
        if ($multitenan) {
            $string .="\n\t\t\$this->db->where(\$this->table.'.Primary_Usu', \$this->session->userdata('Primary_Usu'));";
        }
$string .="
        if (\$q != NULL) {
            \$this->db->group_start();";
        if ($pk != '') {
            $string .= "\n\t\t\t\$this->db->like('$pk', \$q);";
        } else {
            $string .= "\n\t\t\t\$this->db->where('1','1');";
        }
        foreach ($non_pk as $row) {
            $string .= "\n\t\t\t\$this->db->or_like('" . $row['column_name'] ."', \$q);";
        }    

$string .= "\n\t
            \$this->db->group_end();
        }
        if (count(\$order)>0) {
            foreach (\$order as \$by => \$order) {
                \$this->db->order_by(\$by, \$order);
            }
        } else {
            \$this->db->order_by(\$this->id, \$this->order);
        }
        \$this->db->limit(\$limit, \$start);
        return \$this->db->get(\$this->table)->result();
    }

    // insert data
    function insert(\$data)
    {
        \$this->db->insert(\$this->table, \$data);
        return \$this->db->insert_id();
    }
    // Insert batch
    function insert_batch(\$data)
    {
        return \$this->db->insert_batch(\$this->table, \$data);
    }

    // update data
    function update(\$id, \$data, \$where=[])
    {
        if (count(\$where)>0) {
            // Inactive id delete
            foreach (\$where as \$field => \$value) {
                if (stripos(\$field, 'OR ', 0) !==FALSE ) {
                    validate_where(\$field, \$value, 'OR');
                } else {
                    validate_where(\$field, \$value);
                }
            }
        } else {
            //default
            \$this->db->where(\$this->id, \$id);
        }";
        if ($multitenan) {
            $string .="\n\t\t\$this->db->where(\$this->table.'.Primary_Usu', \$this->session->userdata('Primary_Usu'));";
        }
$string .="
        \$this->db->update(\$this->table, \$data);
        return \$id;
    }
    // Insert batch
    function update_batch(\$data)
    {
        return \$this->db->update_batch(\$this->table, \$data, \$this->id);
    }

    // delete data
    function delete(\$id, \$where=[])
    {
        if (count(\$where)>0) {
            // Inactive id delete
            foreach (\$where as \$field => \$value) {
                if (stripos(\$field, 'OR ', 0) !==FALSE ) {
                    validate_where(\$field, \$value, 'OR');
                } else {
                    validate_where(\$field, \$value);
                }
            }
        } else {
            //default
            \$this->db->where(\$this->id, \$id);
        }";
        if ($multitenan) {
            $string .="\n\t\t\$this->db->where(\$this->table.'.Primary_Usu', \$this->session->userdata('Primary_Usu'));";
        }
$string .="
        \$this->db->delete(\$this->table);
        return \$id;
    }";
if (count($fk_fiels)>0) {
    // funciones anidada para todas las llaves foraneas"
    $string .= "\n\t
    function get_foreing_by_id(\$id, \$elements='*', \$join_type='LEFT')
    {
        
        if(\$elements=='*'){
            \$this->db->select(\$this->table.'.*');";
    foreach ($fk_fiels as $row) {
        $fk_Table = $row['fk_Table'];
        $column_name = $row['column_name'];
        $fk_column = $row['fk_column'];

        $campo_foraneo = explode('_', $column_name);
        if (count($campo_foraneo)>2) {
            $string .= "
            \$this->db->select('".strtolower($campo_foraneo[2]).".*');";
        } else {
            $string .= "
            \$this->db->select('".$fk_Table.".*');";
        }
    }
        $string .= "\n\t\t} else{
            \$this->db->select(\$elements);
        }";
        
    foreach ($fk_fiels as $row) {
        $fk_Table = $row['fk_Table'];
        $column_name = $row['column_name'];
        $fk_column = $row['fk_column'];
        $campo_foraneo = explode('_', $column_name);
        if (count($campo_foraneo)>2) {
            $string .= "
        \$this->db->join('".$fk_Table." AS ".strtolower($campo_foraneo[2])."', \$this->table.'.".$column_name." = ".strtolower($campo_foraneo[2]).".".$fk_column."', \$join_type);";
        } else {
            $string .= "
        \$this->db->join('".$fk_Table."', \$this->table.'.".$column_name." = ".$fk_Table.".".$fk_column."', \$join_type);";
        }
    }
    if ($multitenan) {
        $string .="\n\t\t\$this->db->where(\$this->table.'.Primary_Usu', \$this->session->userdata('Primary_Usu'));";
    }
    $string .= "\n\t
        \$this->db->where(\$this->table.'.'.\$this->id, \$id);
        return \$this->db->get(\$this->table)->row();
    }";
}


if (count($fk_fiels)>0) {
    // funciones anidada para todas las llaves foraneas"
    $string .= "\n\t
    function get_foreing_all(\$elements='*', \$where=[], \$join_type='LEFT', \$order=[], \$limit=[], \$group=[], \$having=[])
    {
        if(\$elements=='*'){
            \$this->db->select(\$this->table.'.*');";
    $table_list = array($table_name);
    foreach ($fk_fiels as $row) {
        $fk_Table = $row['fk_Table'];
        $column_name = $row['column_name'];
        $fk_column = $row['fk_column'];
        
        $campo_foraneo = explode('_', $column_name);
        if (count($campo_foraneo)>2) {
            $string .= "
            \$this->db->select('".strtolower($campo_foraneo[2]).".*');";
        } else {
            $string .= "
            \$this->db->select('".$fk_Table.".*');";
        }
        
    }
        $string .= "\n\t\t} else{
            \$this->db->select(\$elements);
        }";        
    
    foreach ($fk_fiels as $row) {
        $fk_Table = $row['fk_Table'];
        $column_name = $row['column_name'];
        $fk_column = $row['fk_column'];

        $campo_foraneo = explode('_', $column_name);
        if (count($campo_foraneo)>2) {
            $string .= "
        \$this->db->join('".$fk_Table." AS ".strtolower($campo_foraneo[2])."', \$this->table.'.".$column_name." = ".strtolower($campo_foraneo[2]).".".$fk_column."', \$join_type);";
        } else {
            $string .= "
        \$this->db->join('".$fk_Table."', \$this->table.'.".$column_name." = ".$fk_Table.".".$fk_column."', \$join_type);";
        }


        
    }
    if ($multitenan) {
        $string .="\n\t\t\$this->db->where(\$this->table.'.Primary_Usu', \$this->session->userdata('Primary_Usu'));";
    }

    $string .= "\n\t
        if (count(\$where)>0) {
            foreach (\$where as \$field => \$value) {
                if (stripos(\$field, 'OR ', 0) !==FALSE ) {
                    validate_where(\$field, \$value, 'OR');
                } else {
                    validate_where(\$field, \$value);
                }
            }
        }
        if (count(\$group)>0) {
            foreach (\$group as \$field) {
                \$this->db->group_by(\$field);
            }
        }
        if (count(\$having)>0) {
            foreach (\$having as \$field => \$value) {
                \$this->db->having(\$field, \$value);
            }
        }
        if (count(\$order)>0) {
            foreach (\$order as \$by => \$order) {
                \$this->db->order_by(\$by, \$order);
            }
        } else {
            \$this->db->order_by(\$this->table.\".\".\$this->id, \$this->order);
        }
        if (count(\$limit)>0) {
            if (count(\$limit)==2) {
                \$this->db->limit(\$limit[0], \$limit[1]);
            } else {
                \$this->db->limit(\$limit[0]);
            }
            
        }
        \$query = \$this->db->get(\$this->table);
        // \$total_rows = \$query->num_rows();
        return \$query->result();
    }";
}


if (count($fk_fiels)>0) {
foreach ($fk_fiels as $row) {
    $fk_Table = $row['fk_Table'];
    $column_name = $row['column_name'];
    $fk_column = $row['fk_column'];

    $string .= "\n\t 
    // funciones anidada para la tabla ".$fk_Table." 
    function get_foreing_".$column_name."(\$elements='*', \$where=[], \$join_type='INNER', \$order=[], \$limit=[], \$group=[], \$having=[])
    {
        if(\$elements=='*'){ ";
    $campo_foraneo = explode('_', $column_name);
    if (count($campo_foraneo)>2) {
        $string .= "\n\t
            \$this->db->select('".strtolower($campo_foraneo[2]).".*,'.\$this->table.'.*');
            \$this->db->join('".$fk_Table." AS ".strtolower($campo_foraneo[2])."', \$this->table.'.".$column_name." = ".strtolower($campo_foraneo[2]).".".$fk_column."', \$join_type);";
    } else {
        $string .= "\n\t
            \$this->db->select('".$fk_Table.".*,'.\$this->table.'.*');
            \$this->db->join('".$fk_Table."', \$this->table.'.".$column_name." = ".$fk_Table.".".$fk_column."', \$join_type);";
    }

    // \$this->db->select('".$fk_Table.".*,'.\$this->table.'.*');
    // \$this->db->join('".$fk_Table."', \$this->table.'.".$column_name." = ".$fk_Table.".".$fk_column."', \$join_type);
    $string .= "\n\t\t} else{
            \$this->db->select(\$elements);
        }"; 
        if ($multitenan) {
            $string .="\n\t\t\$this->db->where(\$this->table.'.Primary_Usu', \$this->session->userdata('Primary_Usu'));";
        }
    
$string .= "\n\t 
        if (count(\$where)>0) {
            foreach (\$where as \$field => \$value) {
                if (stripos(\$field, 'OR ', 0) !==FALSE ) {
                    validate_where(\$field, \$value, 'OR');
                } else {
                    validate_where(\$field, \$value);
                }
            }
        }
        if (count(\$group)>0) {
            foreach (\$group as \$field) {
                \$this->db->group_by(\$field);
            }
        }
        if (count(\$having)>0) {
            foreach (\$having as \$field => \$value) {
                \$this->db->having(\$field, \$value);
            }
        }
        if (count(\$order)>0) {
            foreach (\$order as \$by => \$order) {
                \$this->db->order_by(\$by, \$order);
            }
        } else {
            \$this->db->order_by(\$this->table.\".\".\$this->id, \$this->order);
        }
        if (count(\$limit)>0) {
            if (count(\$limit)==2) {
                \$this->db->limit(\$limit[0], \$limit[1]);
            } else {
                \$this->db->limit(\$limit[0]);
            }
            
        }
        \$query = \$this->db->get(\$this->table);
        // \$total_rows = \$query->num_rows();
        return \$query->result();
    }";
    }
}

$string .= "\n\t 
}

/* End of file $m_file */
/* Location: ./application/models/$m_file */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator ".date('Y-m-d H:i:s')." */
/* www.margunsoft.com */";




$hasil_model = createFile($string, $target."models/" . $m_file);

?>