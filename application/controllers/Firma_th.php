<?php
/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 25/10/2017
 * Time: 21:54
 */

class Firma_th extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        if($this->session->userdata('login')=== TRUE){
            if($this->session->userdata('id_tipo_usuario') === '48') {
                $this->load->view('template/head');
                $this->load->view('template/nav');
                $this->load->view('Firma_th');
                $this->load->view('template/footer');
            }else{
                redirect('/Home');
            }
        }else{
            redirect('/');
        }
    }
}