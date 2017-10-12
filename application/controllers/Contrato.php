<?php

class Contrato extends CI_Controller{

    function __construct(){
        parent::__construct();

    }
    public function index(){
        $this->load->view('template/head');
        $this->load->view('template/nav');
        $this->load->view('Contrato');
        $this->load->view('template/footer');
    }

    public  function Save(){

    }


}