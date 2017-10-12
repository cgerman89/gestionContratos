<?php
/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 10/7/2017
 * Time: 12:38
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema de Contratacion !! SGC </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php base_url()?>public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php base_url()?>public/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php base_url()?>public/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php base_url()?>public/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php base_url()?>public/plugins/iCheck/square/green.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php base_url()?>public/js/html5shiv.min.js"></script>
    <script src="<?php base_url()?>public/js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="<?=site_url('/')?>"><b>Sistema</b> S.G.C</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">inicie session</p>

        <form>
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Usuario">
                <span class=" fa fa-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Contraseña">
                <span class="fa fa-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Recordar
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-success btn-block btn-flat">Ingresar</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <!-- /.social-auth-links -->

        <a href="#"> recuperar contraseña</a><br>


    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php base_url()?>public/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php base_url()?>public/app/login.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php base_url()?>public/js/bootstrap.min.js"></script>

<!-- iCheck -->
<script src="<?php base_url()?>public/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-green ',
            radioClass: 'iradio_square-green',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>

