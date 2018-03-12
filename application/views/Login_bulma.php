<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UTM - STH || Login</title>
    <link rel="stylesheet" href="<?php base_url()?>public/css/bulma.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/sweetalert2.css">
    <link rel="stylesheet" href="<?php base_url()?>public/css/toastr.css">
</head>
<body>
<section class="hero is-light is-fullheight">
    <figure class="avatar">
        <img src="<?php base_url();?>public/img/lista2_2.png" alt="sistema de contratos">
    </figure>
    <div class="hero-body" id="app_login">
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <div class="">
                    <form>
                        <div class="field">
                            <p class="control has-icons-left has-icons-right">
                                <input id="txt_usuario" name="txt_usuario" autofocus  v-model="usuario" class="input is-primary is-medium" type="text" placeholder="Usuario">
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control has-icons-left">
                                <input id="txt_clave" name="txt_clave" v-model="password" class="input is-primary is-medium" type="password" placeholder="Contraseña">
                                <span class="icon is-small is-left">
                                    <i class="fa fa-lock"></i>
                                </span>
                            </p>
                        </div>
                        <button type="button" class="button is-info is-medium"  id="btn_session" name="btn_session"  @click="Valida">
                            <span class="icon is-small is-left">
                                <i class="fas fa-sign-in-alt"></i>
                            </span> &nbsp; Iniciar Session
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?php base_url()?>src/js/vue.min.js"></script>
<script src="<?php base_url()?>src/js/jquery-3.2.1.js"></script>
<script src="<?php base_url()?>public/js/sweetalert2.js"></script>
<script src="<?php base_url()?>public/js/toastr.js"></script>
<script src="<?php base_url();?>src/app/login.js"></script>
</body>
</html>