<?php
/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 28/12/2017
 * Time: 10:40
 */

class cContratos_r extends CI_Controller {

      function __construct(){
         parent::__construct();
         $this->load->model('Contrato_Modelo');
      }

      function index(){
          if($this->session->userdata('login')=== TRUE){
              if($this->session->userdata('id_tipo_usuario') === '12') {
                  $this->load->view('template/head');
                  $this->load->view('template/nav');
                  $this->load->view('vContratos_r');
                  $this->load->view('template/footer');
              }else{
                  redirect('/Permiso');
              }
          }else{
              redirect('/');
          }
      }

      function ListaContratos(){
            if ($this->input->is_ajax_request()){
                if($this->input->post('id_dpto') ==='-3'){
                    echo json_encode($this->Contrato_Modelo->ListarContratos_rct_All('P'));
                }else{
                    echo json_encode($this->Contrato_Modelo->ListarContratos_rct($this->input->post('id_dpto'),'P'));
                }
            }else{
                echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
            }
      }

      function ListaContratosApb(){
          if ($this->input->is_ajax_request()){
              if($this->input->post('id_dpto') ==='-3'){
                  echo json_encode($this->Contrato_Modelo->ListarContratos_rct_All('A'));
              }else{
                  echo json_encode($this->Contrato_Modelo->ListarContratos_rct($this->input->post('id_dpto'),'A'));
              }
          }else{
              echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
          }
      }

      function ListaContratosRdz(){
        if($this->input->is_ajax_request()){
            if($this->input->post('id_dpto') ==='-3'){
                echo json_encode($this->Contrato_Modelo->ListarContratos_redz_All('v_contrato.estado_rector','R'));
            }else{
                echo json_encode($this->Contrato_Modelo->ListarContratos_redz($this->input->post('id_dpto'),'v_contrato.estado_rector','R'));
            }
        }else{
            echo show_error("No tiene permiso para esta url","403","Error de Acceso");
        }
    }

      function AprobarContrato(){
          if ($this->input->is_ajax_request()){
              $campos= array(
                  'id_contrato'=>$this->input->post('id_contrato'),
                  'id_personal'=>$this->session->userdata('id_personal'),
                  'proceso'=>13
              );
              echo json_encode($this->Contrato_Modelo->AprobarProceso($campos));
          }else{
              echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
          }
      }

      function RechazarContrato(){
          if ($this->input->is_ajax_request()){
              $campos= array(
                  'id_contrato'=>$this->input->post('id_contrato'),
                  'id_personal'=>$this->session->userdata('id_personal'),
                  'proceso'=>13
              );
              echo json_encode($this->Contrato_Modelo->AprobarProceso($campos));
          }else{
              echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
          }
      }
}