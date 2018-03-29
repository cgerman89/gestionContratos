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
                redirect('/Permiso');
            }
        }else{
            redirect('/');
        }
    }

    function ListaContratos(){
        if ($this->input->is_ajax_request()){
            if($this->input->post('id_dpto') ==='-3'){
                echo json_encode($this->Contrato_Modelo->ListarContratos_fn_All($this->input->post('estado')));
            }else{
                echo json_encode($this->Contrato_Modelo->ListarContratos_fn($this->input->post('id_dpto'),$this->input->post('estado')));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    function ContratosApb(){
        if ($this->input->is_ajax_request()){
            if($this->input->post('id_dpto') ==='-3'){
                echo json_encode($this->Contrato_Modelo->ListarContrtosAll(' v_contrato.estado_financiero',$this->input->post('estado')));
            }else{
                echo json_encode($this->Contrato_Modelo->ListarContrtos($this->input->post('id_dpto'),' v_contrato.estado_financiero',$this->input->post('estado')));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }

    }

    function ListaContratosRdz(){
        if($this->input->is_ajax_request()){
             if($this->input->post('id_dpto') ==='-3'){
                 echo json_encode($this->Contrato_Modelo->ListarContratos_redz_All('v_contrato.estado_financiero','R'));
             }else{
                 echo json_encode($this->Contrato_Modelo->ListarContratos_redz($this->input->post('id_dpto'),'v_contrato.estado_financiero','R'));
             }
        }else{
          echo show_error("No tiene permiso para esta url","403","Error de Acceso");
        }
    }

    function AprobarContrato($id_ctr){
        $campos= ['id_contrato'=>$id_ctr,
                  'id_personal'=>$this->session->userdata('id_personal'),
                  'proceso'=>12,
                  'p_id_aprobacion'=>12,
                  'p_id_facultad'=>$this->session->userdata('id_facultad')];
        return $this->Contrato_Modelo->AprobarProceso($campos);
    }

    function AprobarFn(){
        if ($this->input->is_ajax_request()){
            if(empty($this->input->post('id_contrato'))!==true)
                 $datos=['partida'=>$this->input->post('item'),
                         'p_510510'=>$this->input->post('p_510510'),
                         'p_510203'=>$this->input->post('p_510203'),
                         'p_510204'=>$this->input->post('p_510204'),
                         'p_510601'=>$this->input->post('p_510601'),
                         'p_510602'=>$this->input->post('p_510602'),
                         'total_masa_salarial'=>$this->input->post('t_m_salarial')];
                 $res = $this->Contrato_Modelo->UpdateBeneficios($datos,$this->input->post('id_contrato'));
                 if($res == 1){
                     echo json_encode($this->AprobarContrato($this->input->post('id_contrato')));
                 }else{
                     echo json_encode(['opcion'=>2,'mensaje'=>'Error Al insertar Item']);
                 }
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    function RechazarContrato(){
        if ($this->input->is_ajax_request()){
            $campos=['id_contrato'=>$this->input->post('id_contrato'),
                     'id_personal'=>$this->session->userdata('id_personal'),
                     'proceso'=>12,
                     'observacion'=>$this->input->post('observacion'),
                     'p_id_aprobacion'=>12,
                     'p_id_facultad'=>$this->session->userdata('id_facultad')];
            echo json_encode($this->Contrato_Modelo->RechazarProceso($campos));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }
    
    function Deshacer(){
        if ($this->input->is_ajax_request()){
            if(!empty($this->input->post('id_contrato')) == true)
               echo json_encode($this->Contrato_Modelo->DeshacerProceso([$this->input->post('id_contrato'), 12]));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

}