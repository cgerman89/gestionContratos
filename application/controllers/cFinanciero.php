<?php
/**
 * Created by PhpStorm.
 * User: HSD
 * Date: 21/10/2017
 * Time: 10:55
 */

class cFinanciero extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('mFinanciero');
    }

    public function index(){
        if($this->session->userdata('login')=== TRUE){
            if($this->session->userdata('id_tipo_usuario') === '49') {
                $this->load->view('template/head');
                $this->load->view('template/nav');
                $this->load->view('vFinanciero');
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
            echo json_encode($this->mFinanciero->getListadoDepartamentos());
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function GetListProFinanDepto(){
        if ($this->input->is_ajax_request()) {
            $id=$this->input->post('id_cbo_dpto_pro_finan');
            echo json_encode($this->mFinanciero->getListProFinanDepto($id));
        }else{
            echo show_error('No Tiene Acceso Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function GetListProFinanAllDepto(){
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->mFinanciero->getListProFinanAllDepto());
        }else{
            echo show_error('No Tiene Acceso Esta Url','403', $heading = 'Error de Acceso');
        }
    }

}