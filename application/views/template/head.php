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
    <link rel="stylesheet" href="<?php base_url()?>public/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php base_url()?>public/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/dataTables.checkboxes.css">
    <link rel="stylesheet" href="<?php base_url()?>public/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?php base_url()?>public/dist/css/skins/skin-green.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/sweetalert2.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/alertify.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/toastr.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/bootstrapA.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/bootstrap-wysihtml5-0.0.2.css">

    <!-- jQuery 3.2.1 -->
    <script src="<?php base_url()?>src/js/jquery-3.2.1.js"></script>
    <script src="<?php base_url()?>public/js/bootstrap.min.js"></script>
    <script src="<?php base_url()?>public/plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?php base_url()?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php base_url()?>public/js/dataTables.buttons.min.js"></script>
    <script src="<?php base_url()?>public/js/dataTables.checkboxes.min.js"></script>
    <script src="<?php base_url()?>public/js/buttons.html5.min.js"></script>
    <script src="<?php base_url()?>public/js/buttons.print.min.js"></script>
    <script src="<?php base_url()?>public/js/jszip.min.js"></script>
    <script src="<?php base_url()?>public/js/pdfmake.min.js"></script>
    <script src="<?php base_url()?>public/js/vfs_fonts.js"></script>
    <script src="<?php base_url()?>public/js/bootstrap-datepicker.js"></script>
    <script src="<?php base_url()?>public/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="<?php base_url()?>public/js/numeral.min.js"></script>
    <script src="<?php base_url()?>public/js/Chart.min.js"></script>
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
    <script src="<?php base_url()?>public/js/moment.js"></script>
    <script src="<?php base_url()?>public/js/moment-with-locales.js"></script>
    <script src="<?php base_url()?>public/js/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- mis js de la app -->
    <script src="<?php base_url()?>src/app/home.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php base_url()?>public/js/html5shiv.min.js"></script>
    <script src="<?php base_url()?>public/js/respond.min.js"></script>
    <![endif]-->

    <?php if($this->uri->segment(1) === 'Perfil') { ?>
        <script src="<?php base_url()?>src/app/perfil_info_per.js"></script>
        <script src="<?php base_url()?>src/app/perfil_instruc_formal.js"></script>
        <script src="<?php base_url()?>src/app/perfil_capacitaciones.js"></script>
        <script src="<?php base_url()?>src/app/perfil_expe_profesional.js"></script>
        <script src="<?php base_url()?>src/app/perfil_publicacion.js"></script>
        <script src="<?php base_url()?>src/app/perfil_banco.js"></script>
    <?php } ?>

    <?php if($this->uri->segment(1) === 'cRectorado') {?>
        <script src="<?php echo base_url();?>src/app/rector_aprobar_soli.js"></script>
    <?php }?>
    <?php if($this->uri->segment(1)=='cTalento_humano_as') {?>
        <script src="<?php echo base_url();?>src/app/tal_humano_aprobar_soli.js"></script>
    <?php }?>
    <?php if($this->uri->segment(1)=='cTalento_humano') {?>
        <script src="<?php echo base_url();?>src/app/contrato_th.js"></script>
    <?php }?>
    <?php if($this->uri->segment(1)=='Contrato') {?>
        <script src="<?php echo base_url();?>src/app/talento_humano_jefe.js"></script>
    <?php }?>
    <?php if($this->uri->segment(1)=='cFinanciero') {?>
        <script src="<?php echo base_url();?>src/app/financiero.js"></script>
    <?php }?>
    <?php if($this->uri->segment(1)=='cContratos_r') {?>
        <script src="<?php echo base_url();?>src/app/rector_ctr.js"></script>
    <?php }?>
    <?php if($this->uri->segment(1)=='Grafico') {?>
        <script src="<?php echo base_url();?>src/app/graficos.js"></script>
    <?php }?>
    <?php if($this->uri->segment(1)=='Contrato_Text') {?>
        <script src="<?php echo base_url();?>src/app/Contrato_Text.js"></script>
    <?php }?>
    <?php if($this->uri->segment(1)=='cFirma') {?>
        <script src="<?php echo base_url();?>src/app/firmar_ctr.js"></script>
    <?php }?>
    <?php if($this->uri->segment(1)=='cImprimir_ctr') {?>
        <script src="<?php echo base_url();?>src/app/Imprime_ctr.js"></script>
    <?php }?>
    <?php if($this->uri->segment(1)=='Buscar') {?>
        <script src="<?php echo base_url();?>src/app/buscar.js"></script>
    <?php }?>

</head>

