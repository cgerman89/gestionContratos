<?php
/**
 * Created by PhpStorm.
 * User: Toshiba
 * Date: 28/1/2018
 * Time: 15:42
 */

class Grafico extends CI_Controller{

    function __construct(){
       parent::__construct();
       $this->load->model('Solicitud_Contrato_Modelo');
       $this->load->model('Contrato_Modelo');
    }

    function index(){
        if($this->session->userdata('login')=== TRUE){
                $this->load->view('template/head');
                $this->load->view('template/nav');
                $this->load->view('v_Graficos');
                $this->load->view('template/footer');
        }else{
            redirect('/');
        }
    }

    function Solicitudes(){
        if ($this->input->is_ajax_request()) {
            if($this->input->post('id_dpto') == '-3'){
                $res=$this->Solicitud_Contrato_Modelo->DatosGraficoAll();
                foreach ( $res as $item) {
                    $titutlos[]=$item['departamento'];
                    $docentes[]=$item['docentes'];
                    $administrativos[]=$item['administrativos'];
                }
                $datos=['titulos'=>$titutlos,'docentes'=>$docentes,'administrativos'=>$administrativos];
               echo json_encode($datos);
            }else{
                echo json_encode($this->Solicitud_Contrato_Modelo->DatosGrafico($this->input->post('id_dpto')));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function Contratos(){
        if ($this->input->is_ajax_request()) {
           if(empty($this->input->post('id_dpto'))!==true){
               if($this->input->post('id_dpto') == '-3'){
                   $resp=$this->Contrato_Modelo->GraficosAll();
                   foreach ($resp as $item):
                       $titutlos[]=$item['departamento'];
                       $docentes[]=$item['docente'];
                       $administrativos[]=$item['administrativo'];
                   endforeach;
                   $datos=['titulos'=>$titutlos,'docentes'=>$docentes,'administrativos'=>$administrativos];
                   echo json_encode($datos);
               }else{
                   echo json_encode($this->Contrato_Modelo->Graficos($this->input->post('id_dpto')));
               }

           }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

}