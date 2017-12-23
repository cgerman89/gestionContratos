<?php
/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 3/8/2017
 * Time: 13:25
 */

class Aspirante extends CI_Controller {

    function __construct(){
         parent::__construct();
         $this->load->model('Aspirante_Modelo');
         $this->load->model('Solicitud_Contrato_Modelo');
         $this->load->model('Contrato_Modelo');
         $this->load->library('Carga_pdf');
    }

    function index(){
        if($this->session->userdata('login')=== TRUE){
            if(($this->session->userdata('id_tipo_usuario') === '19')||($this->session->userdata('id_tipo_usuario') === '12')) {
                $this->load->view('template/head');
                $this->load->view('template/nav');
                $this->load->view('Aspirante');
                $this->load->view('template/footer');
            }else{
                redirect('/Permiso');
            }
        }else{
            redirect('/');
        }
    }

    function AnularSolicitud(){
        if ($this->input->is_ajax_request()){
            $datos=array(
              'id_solicitud'=>$this->input->post('id_solicitud'),
              'id_personal'=>$this->session->userdata('id_personal'),
               'observacion'=>$this->input->post('observacion')
            );
            echo json_encode($this->Solicitud_Contrato_Modelo->AnularSolicitud($datos));
        } else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function DatosSolicitud(){
        if ($this->input->is_ajax_request()){
            if(empty($this->input->post('id_solicitud'))!=true)
                echo json_encode($this->Solicitud_Contrato_Modelo->DatosSolicitud($this->input->post('id_solicitud')));
        } else {
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function UsuarioDatos(){
        if ($this->input->is_ajax_request()){
            echo json_encode($this->session->userdata());
        } else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function AgregarAspirante(){
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

    function CrearUsuario(){
        if($this->input->is_ajax_request()){
            $campos=array('idpersonal'=>$this->input->post('id_personal'),'n_documento'=>$this->input->post('cedula'),'id_dpto'=>$this->session->userdata('id_dpto'));
            $res=$this->Aspirante_Modelo->CrearUsuraioRol($campos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function EnviarSolicitud(){
        if ($this->input->is_ajax_request()){
            if(empty($this->input->post('id_solicitud_ctr'))!==true){
                $datos=array(
                    'p_caso'=>$this->input->post('p_caso'),
                    'id_solicitud_ctr'=>$this->input->post('id_solicitud_ctr'),
                    'fecha'=>$this->input->post('fecha'),
                    'id_observacion'=>$this->input->post('id_observacion'),
                    'id_tipo_solicitud'=>$this->input->post('tipo_solicitud'),
                    'tipo_dedicacion'=>$this->input->post('tipo_dedicacion'),
                    'id_puesto'=>$this->input->post('tipo_puesto'));
                echo json_encode($this->Solicitud_Contrato_Modelo->UpdateSolicitud($datos));
            }else{
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
                echo json_encode($this->Solicitud_Contrato_Modelo->SaveSolicitud($campos));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function ListarPreInscritos(){
        if ($this->input->is_ajax_request()){
            $campos=array('idrol'=>47,'iddpto'=>$this->session->userdata('id_dpto'));
            $res=$this->Aspirante_Modelo->RegistrosInscritos($campos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }

    }

    function ListarSolicitud(){
        if ($this->input->is_ajax_request()){
            $res=$this->Solicitud_Contrato_Modelo->RegistrosSolicitudDpto($this->session->userdata('id_dpto'));
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function ListarProceso(){
        if ($this->input->is_ajax_request()){
            $res=$this->Solicitud_Contrato_Modelo->EstadoProcesosSolicitud($this->input->post('id_solicitud'));
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function ProcesoContrato(){
        if ($this->input->is_ajax_request()){
            $res=$this->Solicitud_Contrato_Modelo->ObtenerIdContrato($this->input->post('id_solicitud'));
            if((!empty($res['id_contrato'])==true)){
              echo json_encode($this->Contrato_Modelo->ProcesosContrato($res['id_contrato']));
            }else{
              echo json_encode(array('data'=>''));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function EliminarRol(){
        if ($this->input->is_ajax_request()) {
            $res=$this->Aspirante_Modelo->EliminarRol($this->input->post('idpersonal'),$this->input->post('idrol'));
            echo json_encode($res);
        } else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function Buscar(){
        if ($this->input->is_ajax_request()) {
            $res=$this->Aspirante_Modelo->BuscaPersona($this->input->post('cedula'));
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }

    }

    function Hoja_Vida(){
        $id=$_GET['id'];
        Carga_pdf::Hoja_Vida($id);
    }
}
