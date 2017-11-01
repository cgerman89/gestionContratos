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

    public function GetSolicitud_Contrato_th(){
        if ($this->input->is_ajax_request()) {
            if($this->input->post('dpto')==='-1'){
                $res =$this->mTalento_humano->ListaAllSolicitudes($this->input->post('tipo'));
            }else{
                $res =$this->mTalento_humano->ListaSolicitudes($this->input->post('dpto'),$this->input->post('tipo'));
            }
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

}
