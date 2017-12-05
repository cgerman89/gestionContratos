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
         $this->load->model('Solicitud_Contrato_Modelo');
         $this->load->library('Carga_pdf');
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

    public function AgregarAspirante(){
        if ($this->input->is_ajax_request()){
            $campos = array(
                'cedula' => $this->input->post('n_documento_asp'),
                'apellido1' => $this->input->post('apellido1_reg_asp'),
                'apellido2' => $this->input->post('apellido2_reg_asp'),
                'nombres' => $this->input->post('nombres_reg_asp'),
                'tipo_documento'=>$this->input->post('t_documento_asp'),
                'nacionalidad'=>$this->input->post('nacionalidad_reg_asp'),
                'genero'=>$this->input->post('sexo_reg_asp'),
                'fecha_nacimiento'=>$this->input->post('f_nacimiento_reg_asp')
            );
            echo json_encode($this->Aspirante_Modelo->Save($campos));
        } else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function CrearUsuario(){
        if($this->input->is_ajax_request()){
            $campos=array('idpersonal'=>$this->input->post('id_personal'),'n_documento'=>$this->input->post('cedula'),'id_dpto'=>$this->session->userdata('id_dpto'));
            $res=$this->Aspirante_Modelo->CrearUsuraioRol($campos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function EnviarSolicitud(){
        if ($this->input->is_ajax_request()){
         $campos=array(
             'id_cordinador'=>$this->session->userdata('id_personal'),
             'id_dpto'=>$this->session->userdata('id_dpto'),
             'id_solicitud'=>$this->input->post('tipo_solicitud'),
             'id_puesto'=>$this->input->post('tipo_puesto'),
             'tipo_dedicacion'=>$this->input->post('tipo_dedicacion'),
             'fecha'=>$this->input->post('fecha'),
             'id_personal'=>$this->input->post('id_personal'),
             'id_observacion'=>$this->input->post('id_observacion'),
             'p_caso'=>$this->input->post('p_caso'));
            $res=$this->Solicitud_Contrato_Modelo->SaveSolicitud($campos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function ListarPreInscritos(){
        if ($this->input->is_ajax_request()){
            $campos=array('idrol'=>47,'iddpto'=>$this->session->userdata('id_dpto'));
            $res=$this->Aspirante_Modelo->RegistrosInscritos($campos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }

    }

    public function ListarSolicitud(){
        if ($this->input->is_ajax_request()){
            $res=$this->Solicitud_Contrato_Modelo->RegistrosSolicitudDpto($this->session->userdata('id_dpto'));
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function ListarProceso(){
        if ($this->input->is_ajax_request()){
            $res=$this->Solicitud_Contrato_Modelo->EstadoProcesosSolicitud($this->input->post('id_solicitud'));
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

    public function Hoja_Vida(){
        $id=$_GET['id'];
        Carga_pdf::Hoja_Vida($id);
    }
}