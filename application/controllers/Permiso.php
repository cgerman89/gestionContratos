<?php
/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 19/12/2017
 * Time: 9:06
 */

class Permiso extends CI_Controller{
    function __construct(){
        parent::__construct();
    }
    function index(){
        if($this->session->userdata('login')=== TRUE){
            $this->load->view('template/head');
            $this->load->view('template/nav');
            $this->load->view('Permiso');
            $this->load->view('template/footer');
        }else{
            redirect('/');
        }
    }

}