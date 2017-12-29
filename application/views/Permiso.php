<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
         <div class="alert alert-danger">
            <h3>
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                Acceso Denegado
            </h3>
           <h5>
               El usuario <b><?php echo $this->session->userdata('nombres'); ?></b>,  no cuenta con <b>permiso</b> para
               acceder a esta Seccion, por favor comunicarse con el Administrador del Sistema Web.
           </h5>

        </div>
    </div>
</div>