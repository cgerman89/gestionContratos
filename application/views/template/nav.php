<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="<?=site_url('/Home')?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>S</b>TH</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Panel</b>STH</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <i class="fas fa-bookmark"></i>
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
               <div class="nav navbar-nav">
                   <!-- /.messages-menu -->
                   <li class="dropdown user user-menu">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <span class="hidden-xs"><?php echo $this->session->userdata('nombres');?></span>
                       </a>
                       <ul class="dropdown-menu">
                           <!-- User image -->
                           <li class="user-header">
                               <img src="<?php base_url()?>public/img/avatar5.png" class="img-circle" alt="User Image">
                           </li>
                           <li class="user-body">
                               <div class="text-center">
                                   <div class="row">
                                       <label class="text-muted small"><?php echo $this->session->userdata('usuario');?></label>
                                   </div>
                                   <div class="row">
                                       <label class="small"><?php echo $this->session->userdata('tipo_usuario');?></label><br>
                                       <label class="small"><?php echo $this->session->userdata('departamento');?></label>
                                   </div>
                               </div>
                           </li>
                           <!-- Menu Footer-->
                           <li class="user-footer">
                               <a href="#" id="btn_cerrar_session" name="btn_cerrar_session" class="btn btn-default"><i class="fas fa-sign-out-alt"></i>&nbsp; Cerrar Session</a>
                           </li>
                       </ul>
                   </li>
               </div>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <h5 class="text-gray text-center text-bold">MENU DE NAVEGACION</h5>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <?php
                    $menu=$this->session->userdata('menus');
                    foreach ($menu as $row){
                ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-folder"></i>
                        &nbsp;
                        <span><?=$row['descripcion'];?> </span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <?php
                           $sub_menu=$row['submenu'];
                           foreach ($sub_menu as $item){
                        ?>
                        <li>
                            <a href="<?=site_url($item['ruta'])?>">
                                <i class="fas fa-chevron-circle-right"></i>
                                &nbsp;
                                <?=$item['descripcion'];?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
                    <?php } ?>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>
        <!-- Main content -->
        <section class="content">