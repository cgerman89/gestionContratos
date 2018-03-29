<?php
/**
 * Created by PhpStorm.
 * User: Toshiba
 * Date: 12/3/2018
 * Time: 10:46
 */
use Dompdf\Dompdf;
use Dompdf\Options;

class cImprimir_ctr extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Contrato_Modelo');
        $this->load->model('Texto_Modelo');
    }

    function index(){
        if($this->session->userdata('login')=== TRUE){
            if($this->session->userdata('id_tipo_usuario') === '48') {
                $this->load->view('template/head');
                $this->load->view('template/nav');
                $this->load->view('vImprime_ctr');
                $this->load->view('template/footer');
            }else{
                redirect('/Permiso');
            }
        }else{
            redirect('/');
        }
    }

    function ListarContratos(){
        if ($this->input->is_ajax_request()){
            if($this->input->post('id_dpto') === '-3' ){
                echo json_encode($this->Contrato_Modelo->ListarContratos_imprimir_All($this->input->post('estado')));
            }else{
                echo json_encode($this->Contrato_Modelo->ListarContratos_imprimir($this->input->post('id_dpto'),$this->input->post('estado')));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function ListarContratos_rzd(){
        if ($this->input->is_ajax_request()){
            if($this->input->post('id_dpto') === '-3' ){
                echo json_encode($this->Contrato_Modelo->ListarContratos_redz_All('v_contrato.estado_impreso',$this->input->post('estado')));
            }else{
                echo json_encode($this->Contrato_Modelo->ListarContratos_redz($this->input->post('id_dpto'),'v_contrato.estado_impreso',$this->input->post('estado')));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function AprobarContrato(){
        if ($this->input->is_ajax_request()){
            $campos= array(
                'id_contrato'=>$this->input->post('id_contrato'),
                'id_personal'=>$this->session->userdata('id_personal'),
                'proceso'=>13,
                'p_id_aprobacion'=>13,
                'p_id_facultad'=> -13
            );
            echo json_encode($this->Contrato_Modelo->AprobarProceso($campos));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    function RechazarProceso(){
        if ($this->input->is_ajax_request()){
            $campos= array(
                'id_contrato'=>$this->input->post('id_contrato'),
                'id_personal'=>$this->session->userdata('id_personal'),
                'proceso'=>13,
                'observacion'=>$this->input->post('observacion'),
                'p_id_aprobacion'=>13,
                'p_id_facultad'=> -13
            );
            echo json_encode($this->Contrato_Modelo->RechazarProceso($campos));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    function Deshacer_Proceso(){
        if ($this->input->is_ajax_request()){
            if(!empty($this->input->post('id_contrato')) == true)
                echo json_encode($this->Contrato_Modelo->DeshacerProceso([$this->input->post('id_contrato'), 13]));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    function Pdf(){
        $datos_c=$this->Contrato_Modelo->DatosTextoContrato($_GET['id_ctr']);
        $datos['textos']=$this->Texto_Modelo->GetTexto($datos_c[0]['id_tipo'],$datos_c[0]['id_tipo_denominacion']);
        $datos['contrato']=$datos_c;
        //var_dump($datos);
        $html=$this->load->view('pdfs/Contrato_pdf',$datos,true);
        $options = new Options();
        $options->setIsHtml5ParserEnabled(true);
        $options->setIsPhpEnabled(true);
        $options->setDefaultPaperOrientation('portrait');
        $options->setDefaultPaperSize('A4');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->render(); // Generar el PDF desde contenido HTML
        $pdf = $dompdf->output(); // Obtener el PDF generado
        $dompdf->stream($datos_c[0]['codigo'].'_'.$datos_c[0]['cedula_aspirante'].'_.pdf',array("Attachment"=>1)); // Enviar el PDF generado al navegador

    }

}