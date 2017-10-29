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
            $info=Seguridad::setDatosEquipo();
            $user=$this->input->post('txt_usuario');
            $clave=$this->input->post('txt_clave');
            if((!empty($user) == true) && (!empty($clave)==true)){
                $usuario = (stristr($user, '@') === FALSE ? trim(strtolower(str_replace("'", "", $user))) . '@utm.edu.ec' : trim(strtolower(str_replace("'", "", $user))));
                $datos = array(
                    'p_usuario' => $usuario,
                    'p_clave' => $clave
                );
                $res = $this->Login_model->Login_User($datos);
                if ($res['p_opcion'] === '1'){
                    if($res['p_t_usuario'] ==='19'){
                        $dp=$this->Login_model->Departamento($res['p_cedula']);
                        $info_rol['id_dpto']=$dp['iddepartamento'];
                        $info_rol['id_facultad']=$dp['idfacultad'];
                        $info_rol['departamento']=$dp['nombre'];
                    }
                    $info_rol['menus']=$this->Login_model->Menus($res['p_t_usuario']);
                    $info_rol['nombres']=$res['p_nombres'];
                    $info_rol['cedula']=$res['p_cedula'];
                    $info_rol['id_personal']=$res['p_idpersonal'];
                    $info_rol['fecha_ult_acceso']=$res['p_fecha_ultimo_acceso'];
                    $info_rol['id_tipo_usuario']=$res['p_t_usuario'];
                    $info_rol['tipo_usuario']=utf8_encode(trim($res['p_desc_usuario']));
                    $info_rol['usuario']=$usuario;
                    $info_rol['token'] = $this->Token();
                    $info_rol['login'] = TRUE;
                    $this->session->set_userdata($info_rol);
                    $respuesta['opcion'] = $res['p_opcion'];
                    $respuesta['url'] = site_url().'Home';
                    echo json_encode($respuesta);
                } else if ($res['p_opcion'] === '2') {
                    $respuesta['mensaje'] = $res['p_mensaje'];
                    $respuesta['opcion'] = $res['p_opcion'];
                    echo json_encode($respuesta);
                }
            }else{
               $respuesta['mensaje']='Campos Usuario y Contraseña Obligatorios';
               $respuesta['opcion']=3;
               echo  json_encode($respuesta);
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