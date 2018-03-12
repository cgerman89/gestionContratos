<?php
/**
 * Created by PhpStorm.
 * User: HSD
 * Date: 22/9/2017
 * Time: 0:59
 */

class cRectorado extends CI_Controller{

    private $idusuario=0;

    function __construct(){
        parent::__construct();
        $this->load->model('mRectorado');
        $this->load->model('Solicitud_Contrato_Modelo');
        $this->load->model('Contrato_Modelo');
        $this->load->library('Carga_pdf');
        $this->idusuario=$this->session->userdata('id_personal');
    }

    function index(){
        if($this->session->userdata('login')=== TRUE){
            if($this->session->userdata('id_tipo_usuario') === '12') {
                $this->load->view('template/head');
                $this->load->view('template/nav');
                $this->load->view('vRectorado');
                $this->load->view('template/footer');
            }else{
                redirect('/Permiso');
            }
        }else{
            redirect('/');
        }
    }

    function ListaAprobarRectorDepto(){
        if ($this->input->is_ajax_request()){
            if($this->input->post('id_dpto') ==='-3'){
                echo json_encode($this->Solicitud_Contrato_Modelo->SolicitudRectorAll('P'));
            }else{
                echo json_encode($this->Solicitud_Contrato_Modelo->SolicitudRector($this->input->post('id_dpto'),'P'));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    function ListarFlujosProcesosDpto(){
        if ($this->input->is_ajax_request()){
            if($this->input->post('id_dpto') ==='-3'){
                echo json_encode($this->Solicitud_Contrato_Modelo->SolicitudRectorAll('A'));
            }else{
                echo json_encode($this->Solicitud_Contrato_Modelo->SolicitudRector($this->input->post('id_dpto'),'A'));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    function GetListadoDepartamentos(){
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->mRectorado->getListadoDepartamentos());
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function AprobarSolicitud(){
        if ($this->input->is_ajax_request()) {
            $campos = array(
                'idSolcontrato' => $this->input->post('Id_sol_contrato'),
                'idpersonal' => $this->idusuario,
                'p_id_aprobacion'=> 8,
                'p_id_facultad'=>$this->session->userdata('id_facultad')
            );
            $res = $this->Solicitud_Contrato_Modelo->AprobarSolicitud($campos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function RechazarSolicitud(){
        if ($this->input->is_ajax_request()) {
            $campos = array(
                'idSolcontrato' => $this->input->post('Id_sol_contrato'),
                'idpersonal' => $this->idusuario,
                'observacion' => $this->input->post('observa'),
                'p_id_aprobacion' => 8,
                'p_id_facultad' => $this->session->userdata('id_facultad')
            );
            $res = $this->Solicitud_Contrato_Modelo->RechazarSolicitud($campos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function ListarProcesosSolicitud(){
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

    function SolicitudesRechazadas(){
        if ($this->input->is_ajax_request()){
            if($this->input->post('id_dpto') ==='-3'){
               echo json_encode($this->Solicitud_Contrato_Modelo->SolicitudRechazadasAll('v_sc.estado_apro_rec'));
            }else{
               echo json_encode($this->Solicitud_Contrato_Modelo->SolicitudRechazadas($this->input->post('id_dpto'),'v_sc.estado_apro_rec'));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    function Deshacer(){
        if ($this->input->is_ajax_request()){
            if(!empty($this->input->post('id_solicitud')) == true)
                echo json_encode($this->Solicitud_Contrato_Modelo->DeshacerProceso($this->input->post('id_solicitud'), 8));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    function Hoja_Vida(){
        $id=$_GET['id'];
        Carga_pdf::Hoja_Vida($id);
    }

    function foto(){
        $id = $_GET['id'];
        $res = $this->mRectorado->Hoja_vida($id);
        foreach ($res as $row) {
            $imagen = pg_unescape_bytea($row['foto']);
        }
        header("Content-type: image/jpeg");
        echo $imagen;

    }

}