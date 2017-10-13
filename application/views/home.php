<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
     <div class="col-md-10 col-md-offset-1">
        <h1>Bienvenidos al Sistema de Talento Humano</h1>

         <?php
           $menu=$this->session->userdata('menus');
           $this->load->helper('ayuda_helper');
            echo ayuda_helper::Usuario();
            echo $this->session->userdata('id_dpto');
            //echo json_encode($menu);
            /*foreach ($menu as $row){
                echo $row['descripcion']."\n";
            }*/
         ?>
     </div>
</div>
