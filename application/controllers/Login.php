<?php
/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 25/9/2017
 * Time: 18:39
 */

class Login extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->library('Seguridad');
    }

    public function index(){
        if($this->session->userdata('login')=== TRUE){
                 redirect('/Home');
        }else{
            $this->load->view('Login');
        }

    }

    public function Entrar(){
        if ($this->input->is_ajax_request()){
             $user=$this->input->post("txt_usuario");
             $clave=$this->input->post("txt_clave");
             $datos= array('usuario'=>$user,'clave'=>$clave);
             $login_asp=$this->Login_model->Login_Aspirante($datos);
             if($login_asp['p_opcion']=='1'){
                 $info_rol['menus']=$this->Login_model->Menus($login_asp['p_t_usuario']);
                 $info_rol['nombres']=$login_asp['p_nombres'];
                 $info_rol['cedula']=$login_asp['p_cedula'];
                 $info_rol['id_personal']=$login_asp['p_id_personal'];
                 $info_rol['id_tipo_usuario']=$login_asp['p_t_usuario'];
                 $info_rol['tipo_usuario']=utf8_encode(trim($login_asp['p_desc_usuario']));
                 $info_rol['usuario']=" USUARIO TEMPORAL";
                 $info_rol['token'] = $this->Token();
                 $info_rol['login'] = TRUE;
                 $this->session->set_userdata($info_rol);
                 $respuesta['p_opcion'] = $login_asp['p_opcion'];
                 $respuesta['url'] = site_url().'Home';
                 echo json_encode($respuesta);
             }elseif($login_asp['p_opcion']=='3'){
                 $usuario = (stristr($user, '@') === FALSE ? trim(strtolower(str_replace("'", "", $user))) . '@utm.edu.ec' : trim(strtolower(str_replace("'", "", $user))));
                 $datos = array('p_usuario' => $usuario,'p_clave' => $clave);
                 $login_user = $this->Login_model->Login_User($datos);
                 if ($login_user['p_opcion'] == '1'){
                     if($login_user['p_t_usuario'] ==='19'){
                         $dp=$this->Login_model->Departamento($login_user['p_cedula']);
                         $info_rol['id_dpto']=$dp['iddepartamento'];
                         $info_rol['id_facultad']=$dp['idfacultad'];
                         $info_rol['departamento']=$dp['nombre'];
                     }
                     $info_rol['menus']=$this->Login_model->Menus($login_user['p_t_usuario']);
                     $info_rol['nombres']=$login_user['p_nombres'];
                     $info_rol['cedula']=$login_user['p_cedula'];
                     $info_rol['id_personal']=$login_user['p_idpersonal'];
                     $info_rol['fecha_ult_acceso']=$login_user['p_fecha_ultimo_acceso'];
                     $info_rol['id_tipo_usuario']=$login_user['p_t_usuario'];
                     $info_rol['tipo_usuario']=utf8_encode(trim($login_user['p_desc_usuario']));
                     $info_rol['usuario']=$usuario;
                     $info_rol['token'] = $this->Token();
                     $info_rol['login'] = TRUE;
                     $this->session->set_userdata($info_rol);
                     $respuesta['p_opcion'] = $login_user['p_opcion'];
                     $respuesta['url'] = site_url().'Home';
                     echo json_encode($respuesta);
                 }else{
                     echo json_encode($login_user);
                 }

             }else{
                 echo json_encode($login_asp);
             }

        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function Token(){
        $token = md5(uniqid(rand(),true));
        return $token;
    }

    public function Logout(){
        if ($this->input->is_ajax_request()){
            $this->session->sess_destroy();
            $res['url']= base_url();
            $res['opcion']=1;
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

}