<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema STH</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->     
    <link rel="stylesheet" href="<?php base_url()?>public/css/bootstrap.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/select2.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/select2-bootstrap.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/smoke.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/bootstrap-datepicker3.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/bootstrap-toggle.min.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/font-awesome.css">
    <link rel="stylesheet" href="<?php base_url()?>public/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?php base_url()?>public/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php base_url()?>public/dist/css/skins/skin-green.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/sweetalert2.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/alertify.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/toastr.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/bootstrapA.css">
       

    <!-- jQuery 2.2.3 -->
    <script src="<?php base_url()?>src/js/jquery-3.2.1.js"></script>
    <script src="<?php base_url()?>public/js/bootstrap.min.js"></script>
    <script src="<?php base_url()?>public/plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?php base_url()?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php base_url()?>public/js/bootstrap-datepicker.js"></script>
    <script src="<?php base_url()?>public/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="<?php base_url()?>src/js/cedula.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php base_url()?>public/js/smoke.js"></script>
    <script src="<?php base_url()?>public/locales/es.js"></script>
    <script src="<?php base_url()?>public/js/bootstrap-toggle.min.js"></script>
    <script src="<?php base_url()?>public/js/sweetalert2.js"></script>
    <script src="<?php base_url()?>src/js/alertify.js"></script>
    <script src="<?php base_url()?>public/js/toastr.js"></script>
    <script src="<?php base_url()?>public/dist/js/app.min.js"></script>
    <script src="<?php base_url()?>public/js/select2.js"></script>

    <!-- mis js de la app -->
    <script src="<?php base_url()?>src/app/home.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php base_url()?>public/js/html5shiv.min.js"></script>
    <script src="<?php base_url()?>public/js/respond.min.js"></script>
    <![endif]-->
       <?php if($this->uri->segment(1) === 'cRectorado') {?>
        <script src="<?php echo base_url();?>src/app/lista_apro_asp.js"></script>
        <script src="<?php echo base_url();?>src/app/lista_flu_pro.js"></script>
    <?php }?>
    <?php if($this->uri->segment(1)=='cTalento_humano_as') {?>
        <script src="<?php echo base_url();?>src/app/talento_humano_as.js"></script>
    <?php }?>
    <?php if($this->uri->segment(1)=='cTalento_humano') {?>
        <script src="<?php echo base_url();?>src/app/talento_humano.js"></script>
    <?php }?>
    <?php if($this->uri->segment(1)=='cFinanciero') {?>
        <script src="<?php echo base_url();?>src/app/financiero.js"></script>
    <?php }?>
</head>

