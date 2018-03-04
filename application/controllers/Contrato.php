<?php
/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 12/12/2017
 * Time: 11:51
 */

class Contrato extends CI_Controller {

    function __construct(){
       parent::__construct();
       $this->load->model('Contrato_Modelo');
    }

    function index(){
        if($this->session->userdata('login')=== TRUE){
            if($this->session->userdata('id_tipo_usuario') === '50') {
                $this->load->view('template/head');
                $this->load->view('template/nav');
                $this->load->view('vTalento_humano_jefe');
                $this->load->view('template/footer');
            }else{
                redirect('/Permiso');
            }
        }else{
            redirect('/');
        }
    }

    function Deshacer(){
        if ($this->input->is_ajax_request()){
            if(!empty($this->input->post('id_contrato')) == true)
                echo json_encode($this->Contrato_Modelo->DeshacerProceso($this->input->post('id_contrato'),11));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    function ListaContratos(){
        if ($this->input->is_ajax_request()){
            if($this->input->post('id_dpto') ==='-3'){
                echo json_encode($this->Contrato_Modelo->ListarContratos_Jefe_th_All('P'));
            }else{
                echo json_encode($this->Contrato_Modelo->ListarContratos_Jefe_th($this->input->post('id_dpto'),'P'));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    function ListarContratos_proceso_Jefe(){
        if ($this->input->is_ajax_request()){
            if (!empty($this->input->post('id_dpto'))==true)
                 if($this->input->post('id_dpto') == '-3')
                     echo json_encode($this->Contrato_Modelo->ListarContrtosAll('v_contrato.estado_jefe_th',$this->input->post('estado')));
                 else
                     echo json_encode($this->Contrato_Modelo->ListarContrtos($this->input->post('id_dpto'),'v_contrato.estado_jefe_th',$this->input->post('estado')));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    function ListarContratos_all(){
        if ($this->input->is_ajax_request()){
            if (!empty($this->input->post('id_dpto'))==true)
                if($this->input->post('id_dpto') == '-3')
                    echo json_encode($this->Contrato_Modelo->ListarContrtosAll('v_contrato.estado',$this->input->post('estado')));
                else
                    echo json_encode($this->Contrato_Modelo->ListarContrtos($this->input->post('id_dpto'),'v_contrato.estado',$this->input->post('estado')));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    function AprobarContrato(){
        if ($this->input->is_ajax_request()){
            $campos= array(
                'id_contrato'=>$this->input->post('id_contrato'),
                'id_personal'=>$this->session->userdata('id_personal'),
                'proceso'=>11
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
                'proceso'=>11,
                'observacion'=>$this->input->post('observacion')
            );
            echo json_encode($this->Contrato_Modelo->RechazarProceso($campos));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }
}