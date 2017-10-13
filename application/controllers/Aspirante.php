<?php
/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 3/8/2017
 * Time: 13:25
 */

class Aspirante extends CI_Controller {
     public function __construct(){
         parent::__construct();
         $this->load->model('Aspirante_Modelo');
    }

    public function index(){
        if($this->session->userdata('login')=== TRUE){
            if($this->session->userdata('id_tipo_usuario') === '19') {
                $this->load->view('template/head');
                $this->load->view('template/nav');
                $this->load->view('Aspirante');
                $this->load->view('template/footer');
            }else{
                redirect('/Home');
            }
        }else{
            redirect('/');
        }
    }
    public function UsuarioDatos(){
        if ($this->input->is_ajax_request()){
            echo json_encode($this->session->userdata());
        } else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function CrearAspirante(){
        if ($this->input->is_ajax_request()){
            $campos = array(
                'cedula' => $this->input->post('cedula_asp'),
                'apellido1' => $this->input->post('apellido1_asp'),
                'apellido2' => $this->input->post('apellido2_asp'),
                'nombres' => $this->input->post('nombres_asp'),
                'usuario'=>$this->input->post('correo_institucion_asp')
            );
            $res=$this->Aspirante_Modelo->Save($campos);
            if($res['p_opcion']==='1'){
                $datos=array('id_usuario'=>$res['p_idpersonal'],'clave'=>$this->input->post('clave_asp'));
                $clave=$this->Aspirante_Modelo->CrearClave($datos);
                $datos_rol=array('id_usuario'=>$res['p_idpersonal'],'rol'=>47,'iddpto'=>$this->session->userdata('id_dpto'));
                $rol=$this->Aspirante_Modelo->SaveRol($datos_rol);
                echo json_encode($res);
            }
        } else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function AgregarAspirante(){
        if($this->input->is_ajax_request()){
            $campos=array(
                'idpersonal'=>$this->input->post(),
                'id_rol'=>47,
                'iddpto'=>$this->session->userdata('id_dpto')
            );
            $res=$this->Aspirante_Modelo->SaveRol($campos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }
    public function ListarPreInscritos(){
        if ($this->input->is_ajax_request()){
            $campos=array('idrol'=>$this->input->post('idrol'),'iddpto'=>$this->session->userdata('id_dpto'));
            $res=$this->Aspirante_Modelo->RegistrosInscritos($campos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }

    }

    public function EliminarRol(){
        if ($this->input->is_ajax_request()) {
            $res=$this->Aspirante_Modelo->EliminarRol($this->input->post('idpersonal'),$this->input->post('idrol'));
            echo json_encode($res);
        } else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }
    public function Buscar(){
        if ($this->input->is_ajax_request()) {
            $res=$this->Aspirante_Modelo->BuscaPersona($this->input->post('cedula'));
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }

    }
}