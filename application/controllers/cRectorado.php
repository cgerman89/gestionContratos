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
                redirect('/Home');
            }
        }else{
            redirect('/');
        }
    }

    public function GetListAspXAproDepto(){
        if ($this->input->is_ajax_request()) {
            $id=$this->input->post('id_cbo_dpto_x_apro');
            echo json_encode($this->mRectorado->getListAspXAproDepto($id));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function GetListAspXAproAllDepto(){
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->mRectorado->getListAspXAproAllDepto());
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function GetListAspFluProDpto(){
        if ($this->input->is_ajax_request()) {
            $id=$this->input->post('id_cbo_dpto_flu');
            echo json_encode($this->mRectorado->getListAspFluProDpto($id));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function GetListAspFluProAllDpto(){
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->mRectorado->getListAspFluProAllDpto());
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function GetListContParaFirmRecDepto(){
        if ($this->input->is_ajax_request()) {
            $id=$this->input->post('id_cbo_dpto_fir_rec');
            echo json_encode($this->mRectorado->getListContParaFirmRecDepto($id));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function GetListContParaFirmRecAllDepto(){
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->mRectorado->getListContParaFirmRecAllDepto());
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function GetListContFirmDpto(){
        if ($this->input->is_ajax_request()) {
            $id=$this->input->post('id_cbo_dpto_fir');
            echo json_encode($this->mRectorado->getListContFirmDpto($id));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    //Probando con funciones
    /*public function GetListContFirmDpto(){
        if ($this->input->is_ajax_request()) {
            $id=$this->input->post('id_cbo_dpto_fir');
            $res=$this->Aspirante_Modelo->getListContFirmDpto($id);
            //print_r($res);
            //echo json_encode($res);
            var_dump($res);
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }*/

    public function GetListContFirmAllDpto(){
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->mRectorado->getListContFirmAllDpto());
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

    public function FirmarContrato(){
        if ($this->input->is_ajax_request()) {
            $campos = array(
                'idcontrato' => $this->input->post('Id_contrato'),
                'idpersonal' => $this->idusuario
            );
            $res = $this->mRectorado->Firmar($campos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

}