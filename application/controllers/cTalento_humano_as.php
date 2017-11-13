<?php
/**
 * Created by PhpStorm.
 * User: HSD
 * Date: 26/10/2017
 * Time: 20:24
 */

class cTalento_humano_as extends CI_Controller{

    private $idusuario=0;
    function __construct(){
        parent::__construct();
        $this->load->model('mTalento_humano_as');
        $this->load->model('Solicitud_Contrato_Modelo');
        $this->load->library('Carga_pdf');
        $this->idusuario=$this->session->userdata('id_personal');
    }
    public function index(){
        if($this->session->userdata('login')=== TRUE){
            if($this->session->userdata('id_tipo_usuario') === '48') {
                $this->load->view('template/head');
                $this->load->view('template/nav');
                $this->load->view('vTalento_humano_as');
                $this->load->view('template/footer');
            }else{
                redirect('/Home');
            }
        }else{
            redirect('/');
        }
    }

    public function ListaAprobarTalentoHumanoDepto(){
        if ($this->input->is_ajax_request()) {
            if($this->input->post('id_dpto') === '-3'){
               echo json_encode($this->Solicitud_Contrato_Modelo->SolicitudRecursosHumanoAll('P'));
            }else{
               echo json_encode($this->Solicitud_Contrato_Modelo->SolicitudRecursosHumano($this->input->post('id_dpto'),'P'));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function AprobadasTalentoHumano(){
        if ($this->input->is_ajax_request()) {
            if($this->input->post('id_cbo_dpto_flu')==='-3'){
                echo json_encode($this->mTalento_humano_as->SolicitudesAllAprobadas_RH('A'));
            }else{
                echo json_encode($this->mTalento_humano_as->SolicitudesAprobadas_RH($this->input->post('id_cbo_dpto_flu'),'A'));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function RechazadasTalentoHumano(){
        if ($this->input->is_ajax_request()) {
            if($this->input->post('id_dpto')==='-3'){
                echo json_encode($this->mTalento_humano_as->SolicitudesAllAprobadas_RH('R'));
            }else{
                echo json_encode($this->mTalento_humano_as->SolicitudesAprobadas_RH($this->input->post('id_cbo_dpto_flu'),'R'));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }

    }

    public function InfoSolicitudRechazada(){
        if ($this->input->is_ajax_request()){
            echo json_encode($this->mTalento_humano_as->InfoSolicitudRechazada($this->input->post('id_solicitud')));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function GetListadoDepartamentos(){
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->mTalento_humano_as->getListadoDepartamentos());
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function AprobarSolicitudTalentoHumano(){
        if ($this->input->is_ajax_request()) {
            $campos = array(
                'idSolcontrato' => $this->input->post('Id_sol_contratoTH'),
                'idpersonal' => $this->idusuario,
                'idcontratado' => $this->input->post('Id_contratado'),
                'idTipoSol' => $this->input->post('Id_tipo_sol')
            );
            $res = $this->mTalento_humano_as->AprobarSolicitudTalentoHumano($campos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function RechazarSolicitudTalentoHumano(){
        if ($this->input->is_ajax_request()) {
            $campos = array(
                'idSolcontrato' => $this->input->post('Id_sol_contrato'),
                'idpersonal' => $this->idusuario,
                'observacion' => $this->input->post('observa')
            );
            $res = $this->mTalento_humano_as->RechazarSolicitudTalentoHumano($campos);
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