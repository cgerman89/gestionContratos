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

    public function index(){
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

    public function ListaAprobarRectorDepto(){
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

    public function ListarFlujosProcesosDpto(){
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

    public function GetListadoDepartamentos(){
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->mRectorado->getListadoDepartamentos());
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function AprobarSolicitud(){
        if ($this->input->is_ajax_request()) {
            $campos = array(
                'idSolcontrato' => $this->input->post('Id_sol_contrato'),
                'idpersonal' => $this->idusuario
            );
            $res = $this->mRectorado->AprobarSolicitud($campos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function RechazarSolicitud(){
        if ($this->input->is_ajax_request()) {
            $campos = array(
                'idSolcontrato' => $this->input->post('Id_sol_contrato'),
                'idpersonal' => $this->idusuario,
                'observacion' => $this->input->post('observa')
            );
            $res = $this->mRectorado->RechazarSolicitud($campos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function ListarProcesosSolicitud(){
        if ($this->input->is_ajax_request()){
            $res=$this->mRectorado->RegistrosProcesosSolicitud($this->input->post('id_solicitud'));
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

    public function SolicitudesRechazadas(){
        if ($this->input->is_ajax_request()){
            if($this->input->post('id_dpto') ==='-3'){
               echo json_encode($this->Solicitud_Contrato_Modelo->SolicitudRechazadasAll());
            }else{
               echo json_encode($this->Solicitud_Contrato_Modelo->SolicitudRechazadas($this->input->post('id_dpto')));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function Hoja_Vida(){
        $id=$_GET['id'];
        Carga_pdf::Hoja_Vida($id);
    }

    public function foto(){
        $id = $_GET['id'];
        $res = $this->mRectorado->Hoja_vida($id);
        foreach ($res as $row) {
            $imagen = pg_unescape_bytea($row['foto']);
        }
        header("Content-type: image/jpeg");
        echo $imagen;

    }

}