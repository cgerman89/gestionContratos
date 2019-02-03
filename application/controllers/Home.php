<?php

/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 10/7/2017
 * Time: 9:41
 */
class Home extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('Login_model');
    }

    public function index(){
       if($this->session->userdata('login')=== TRUE){
            $this->load->view('template/head');
            $this->load->view('template/nav');
            $this->load->view('home');
            $this->load->view('template/footer');
       }else{
         redirect('/');
       }
    }

    public function FotoUser(){
        if(!empty($_GET['id_personal'])==true)
             $res  = $this->Login_model->GetFotoUser($_GET['id_personal']);
             $foto = pg_unescape_bytea($res['foto']);
             header("Content-type: image/jpeg");
             echo $foto;

    }


}
