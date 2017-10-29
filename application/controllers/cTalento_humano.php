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
        $this->idusuario=$this->session->userdata('id_personal');
    }

    public function index(){
        if($this->session->userdata('login')=== TRUE){
            if($this->session->userdata('id_tipo_usuario') === '48') {
                $this->load->view('template/head');
                $this->load->view('template/nav');
                $this->load->view('vTalento_humano');
                $this->load->view('template/footer');
            }else{
                redirect('/Home');
            }
        }else{
            redirect('/');
        }
    }

    public function GetListadoDepartamentos(){
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->mTalento_humano->getListadoDepartamentos());
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function GetListProRRHHDepto(){
        if ($this->input->is_ajax_request()) {
            $id=$this->input->post('id_cbo_dpto_pro_rrhh');
            echo json_encode($this->mTalento_humano->getListProRRHHDepto($id));
        }else{
            echo show_error('No Tiene Acceso Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function GetListProRRHHAllDepto(){
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->mTalento_humano->getListProRRHHAllDepto());
        }else{
            echo show_error('No Tiene Acceso Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    /*public function GetListFirContratadoDepto(){
        if ($this->input->is_ajax_request()) {
            $id=$this->input->post('id_cbo_fir_contratado');
            echo json_encode($this->mTalento_humano->getListFirContratadoDepto($id));
        }else{
            echo show_error('No Tiene Acceso Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function GetListFirContratadoAllDepto(){
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->mTalento_humano->getListFirContratadoAllDepto());
        }else{
            echo show_error('No Tiene Acceso Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function FirmaContratado(){
        if ($this->input->is_ajax_request()) {
            $campos = array(
                'idcontrato' => $this->input->post('Id_contrato'),
                'idpersonal' => $this->input->post('Id_contratado')
            );
            $res = $this->mTalento_humano->FirmaContratado($campos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }*/

    public function GetListTipo(){
        if ($this->input->is_ajax_request()) {
            $res = $this->mTalento_humano->CargaTipo($this->input->post('Id_Cat_tipo'));
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function GetListNivel(){
        if ($this->input->is_ajax_request()) {
            $res = $this->mTalento_humano->getListNivel($this->input->post('Id_Cat'));
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function GetListDedicacion(){
        if ($this->input->is_ajax_request()) {
            $res = $this->mTalento_humano->getListDedicacion($this->input->post('Id_Cat'),$this->input->post('Id_Niv'));
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function GetRemuneracion(){
        if ($this->input->is_ajax_request()) {
            $res = $this->mTalento_humano->getRemuneracion($this->input->post('Id_Cat'),$this->input->post('Id_Niv'),$this->input->post('Id_Ded'));
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function GetListProfesiones(){
        if ($this->input->is_ajax_request()) {
            $id=$this->input->post('IdPersonal');
            echo json_encode($this->mTalento_humano->getListProfesiones($id));
        }else{
            echo show_error('No Tiene Acceso Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function ProcesarSolicitudRRHH(){
        if ($this->input->is_ajax_request()) {
            $campos = array(
                'idcont' => $this->input->post('IdContrato'),
                'idpersonal' => $this->idusuario,
                'idFP' => $this->input->post('IdForPro'),
                'idRL' => $this->input->post('IdRegLab'),
                'idTipoDenom' => $this->input->post('IdDenoDocen'),
                'RMU' => $this->input->post('RMU'),
                'fec_ini' => $this->input->post('FecIni'),
                'fec_fin' => $this->input->post('FecFin'),
                'num_meses' => $this->input->post('NumMeses')
            );
            $res = $this->mTalento_humano->ProcesarSolicitudRRHH($campos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

}
