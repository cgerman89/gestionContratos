<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UTM - STH || Login</title>
    <link rel="stylesheet" href="<?php base_url();?>public/css/bootstrap.css">
    <link rel="stylesheet" href="<?php base_url();?>public/css/sticky-footer-navbar.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/font-awesome.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/sweetalert2.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/toastr.css">


    <script src="<?php base_url()?>src/js/jquery-3.2.1.js"></script>
    <script src="<?php base_url()?>public/js/bootstrap.min.js"></script>
    <script src="<?php base_url()?>public/js/sweetalert2.js"></script>
    <script src="<?php base_url()?>public/js/toastr.js"></script>
    <script src="<?php base_url();?>src/app/login.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div align="center">
            <img src="<?php base_url();?>public/img/lista2_2.png" alt="sistema de contratos">
        </div>
        <div class="col-md-4 col-md-offset-4">
            <form id="form_session" role="form" class="form-signin">
                <h3 class="form-signin-heading text-center text-muted">
                    <b>S</b>istema <b>T</b>alento <b>H</b>umano
                </h3>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa-2x" aria-hidden="true"></i></span>
                        <input type="text" id="txt_usuario" name="txt_usuario" class="form-control input-lg" autofocus placeholder="Usuario" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock fa-2x" aria-hidden="true"></i></span>
                        <input type="password" id="txt_clave" name="txt_clave" class="form-control input-lg" placeholder="Contrseña" required>
                    </div>
                </div>
                <button type="button" id="btn_session" name="btn_session" class="btn btn-lg btn-success btn-block">Iniciar Session <i class="fa fa-sign-out" aria-hidden="true"></i>
                </button>
            </form>
        </div>
    </div>
    <footer class="footer">
         <div class="container text-center">
             <p class="text-muted">
                 Sistema de gestión de contratos
                 <strong>Copyright © 2017-2018   Cristian Gérman</a>.  </strong> All rights
                 reserved.
             </p>
         </div>
    </footer>
</div>
</body>
</html>