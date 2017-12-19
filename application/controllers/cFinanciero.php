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
        $this->load->model('Contrato_Modelo');
    }
    function index(){
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
    function ListaContratos(){
        if ($this->input->is_ajax_request()){
            if($this->input->post('id_dpto') ==='-3'){
                echo json_encode($this->Contrato_Modelo->ListarContratos_fn_All('P'));
            }else{
                echo json_encode($this->Contrato_Modelo->ListarContratos_fn($this->input->post('id_dpto'),'P'));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }
    function AprobarContrato(){
        if ($this->input->is_ajax_request()){
            $campos= array(
                'id_contrato'=>$this->input->post('id_contrato'),
                'id_personal'=>$this->session->userdata('id_personal'),
                'proceso'=>12
            );
            if( $this->Contrato_Modelo->AgregarItem($this->input->post('id_contrato'),$this->input->post('item')) == 1){
                 echo json_encode($this->Contrato_Modelo->AprobarProceso($campos));
            }else{
                 $resp=array('opcion'=>'2','mensaje'=>'Error al agregar partida');
                 echo json_encode($resp);
            }
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }
    function RechazarContrato(){
        if ($this->input->is_ajax_request()){
            $campos= array(
                'id_contrato'=>$this->input->post('id_contrato'),
                'id_personal'=>$this->session->userdata('id_personal'),
                'proceso'=>12,
                'observacion'=>$this->input->post('observacion')
            );
            echo json_encode($this->Contrato_Modelo->RechazarProceso($campos));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

}