<?php
/**
 * Created by PhpStorm.
 * User: Toshiba
 * Date: 02/04/2018
 * Time: 16:38
 */

class Buscar extends CI_Controller {
     function __construct(){
         parent::__construct();
     }

     function index(){
         if($this->session->userdata('login')=== TRUE){
             if($this->session->userdata('id_tipo_usuario') === '48') {
                 $this->load->view('template/head');
                 $this->load->view('template/nav');
                 $this->load->view('vBuscar');
                 $this->load->view('template/footer');
             }else{
                 redirect('/Permiso');
             }
         }else{
             redirect('/');
         }
     }


}