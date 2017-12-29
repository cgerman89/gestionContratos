<?php
/**
 * Created by PhpStorm.
 * User: HSD
 * Date: 11/10/2017
 * Time: 10:23
 */

class cTalento_humano extends CI_Controller{

    private $idusuario=0;

    function __construct(){
        parent::__construct();
        $this->load->model('mTalento_humano');
        $this->load->model('Solicitud_Contrato_Modelo');
        $this->load->model('Contrato_Modelo');
        $this->load->library('Carga_pdf');
        $this->idusuario=$this->session->userdata('id_personal');
    }

    function index(){
        if($this->session->userdata('login')=== TRUE){
            if($this->session->userdata('id_tipo_usuario') === '48') {
                $this->load->view('template/head');
                $this->load->view('template/nav');
                $this->load->view('vTalento_humano');
                $this->load->view('template/footer');
            }else{
                redirect('/Permiso');
            }
        }else{
            redirect('/');
        }
    }

    function AnularContrato(){
        if ($this->input->is_ajax_request()){
            if((!empty($this->input->post('id_contrato'))==true)){
                $datos = [
                    'id_contrato' => $this->input->post('id_contrato'),
                    'id_personal' => $this->idusuario,
                    'observacion' => $this->input->post('observacion'),
                ];
                echo json_encode($this->Contrato_Modelo->AnularContrato($datos));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Acceso Denegado');
        }
    }

    function CrearContrato(){
        if ($this->input->is_ajax_request()){
             if((!empty($this->input->post('id_contrato'))==true)){
                 $campos=array(
                     'id_contrato'=>$this->input->post('id_contrato'),
                     'p_id_personal'=>$this->input->post('id_personal'),
                     'p_id_titulo'=>$this->input->post('id_titulo'),
                     'p_id_regimen'=>$this->input->post('id_regimen'),
                     'p_fecha_inicio'=>$this->input->post('fecha_inicio'),
                     'p_fecha_finaliza'=>$this->input->post('fecha_finaliza'),
                     'p_remuneracion'=>$this->input->post('rmu'),
                     'p_id_denominacion'=>$this->input->post('denominacion')
                 );
                 echo json_encode($this->Contrato_Modelo->UpdateContrato($campos));
             }else {
               $datos = array (
                   'p_tipo'=>$this->input->post('tipo'),
                   'p_id_personal'=>$this->input->post('id_personal'),
                   'p_id_solicitud'=>$this->input->post('id_solicitud'),
                   'p_id_regimen'=>$this->input->post('id_regimen'),
                   'p_id_denominacion'=>$this->input->post('denominacion'),
                   'p_remuneracion'=>$this->input->post('rmu'),
                   'p_fecha_inicio'=>$this->input->post('fecha_inicio'),
                   'p_fecha_finaliza'=>$this->input->post('fecha_finaliza'),
                   'p_id_titulo'=>$this->input->post('id_titulo'),
                   'p_id_departamento'=>$this->input->post('id_departamento'),
                   'p_id_usuario'=>$this->idusuario
               );
               echo json_encode($this->Contrato_Modelo->SaveContrato($datos));
             }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function EditarContrato(){
        if ($this->input->is_ajax_request()){
            if((!empty($this->input->post('id_contrato'))==true)){
                echo json_encode($this->Contrato_Modelo->EditarContrato($this->input->post('id_contrato')));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function GetListadoDepartamentos(){
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->mTalento_humano->getListadoDepartamentos());
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function SolicitudContrato(){
        if ($this->input->is_ajax_request()) {
            if($this->input->post('id_dpto') === '-3'){
              echo json_encode($this->Solicitud_Contrato_Modelo->SolicitudAceptadaAll());
            }else if($this->input->post('id_dpto') !== ''){
              echo json_encode($this->Solicitud_Contrato_Modelo->SolicitudAceptada($this->input->post('id_dpto')));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function ProcesoSolicitud(){
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->Solicitud_Contrato_Modelo->EstadoProcesosSolicitud($this->input->post('id_solicitud')));
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function ListaNiveles(){
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->mTalento_humano->Tipo(5,$this->input->post('categoria')));
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function ListaDedicacion(){
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->mTalento_humano->Tipo(4,$this->input->post('dedicacion')));
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function ListaRemuneracionDocente(){
        if ($this->input->is_ajax_request()){
           if( (!empty($this->input->post('catetoria'))==true) && (!empty($this->input->post('nivel'))==true) && (!empty($this->input->post('dedicacion'))==true) ) {
               echo json_encode($this->Contrato_Modelo->Remuneracion_Docente($this->input->post('catetoria'), $this->input->post('nivel'), $this->input->post('dedicacion')));
           }else{
               echo json_encode(null);
           }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function ListaOcupacion(){
        if ($this->input->is_ajax_request()){
            echo json_encode($this->mTalento_humano->Tipo(8,$this->input->post('grupo_ocupacion')));
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function ListaRemuneracionAdmin(){
        if ($this->input->is_ajax_request()){
            if((!empty($this->input->post('grupo_ocupacion'))==true) && (!empty($this->input->post('puesto'))==true)){
                echo json_encode($this->Contrato_Modelo->ListaRemuneracionAdmin($this->input->post('grupo_ocupacion'),$this->input->post('puesto')));
            }else{
                echo json_encode(null);
            }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function ListarContratos(){
        if ($this->input->is_ajax_request()){
            if($this->input->post('id_dpto') === '-3' ){
                echo json_encode($this->Contrato_Modelo->ListarContrtosAll());
            }else{
                echo json_encode($this->Contrato_Modelo->ListarContrtos($this->input->post('id_dpto')));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function ProcesosContrato(){
        if ($this->input->is_ajax_request()){
            if((!empty($this->input->post('id_contrato'))==true)){
                echo json_encode($this->Contrato_Modelo->ProcesosContrato($this->input->post('id_contrato')));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function DenominacionDocente(){
        if ($this->input->is_ajax_request()){
            if((!empty($this->input->post('id_denominacion'))==true)){
               echo json_encode($this->Contrato_Modelo->DenominacionDocente($this->input->post('id_denominacion')));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function DenominacionAdmin(){
        if ($this->input->is_ajax_request()){
            if((!empty($this->input->post('id_denominacion'))==true)){
                echo json_encode($this->Contrato_Modelo->DenominacionAdmin($this->input->post('id_denominacion')));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function Hoja_Vida(){
        $id=$_GET['id'];
        Carga_pdf::Hoja_Vida($id);
    }
}
