<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$resources['page'] = (isset($page)) ? $page : '' ;
$resources['module'] = (isset($module)) ? $module : '' ;
$this->load->view('header.php',$resources);                   
    if(isset($_view) && $_view){
        $this->load->view("".$_view);
    }
//$this->load->view("footer");
/*
?> 

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <?php                    
            if(isset($_view) && $_view)
                $this->load->view($_view);
            ?>                    
        </section>
        <!-- /.content -->
    </div>
    php */ ?>