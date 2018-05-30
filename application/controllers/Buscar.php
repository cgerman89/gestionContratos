<?php
/**
 * Created by PhpStorm.
 * User: Toshiba
 * Date: 02/04/2018
 * Time: 16:38
 */
use Dompdf\Dompdf;
use Dompdf\Options;

class Buscar extends CI_Controller {
     function __construct(){
         parent::__construct();
         $this->load->model('Buscar_Modelo');
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

     function Get_Solicitudes(){
         if ($this->input->is_ajax_request()){
             $id_dpto=$this->input->post('dpto');
             $fecha_desde = $this->input->post('f_desde');
             $fecha_hasta = $this->input->post('f_hasta');
             if((!empty($fecha_desde)) and (!empty($fecha_hasta)) and (!empty($id_dpto)))
                  echo json_encode($this->Buscar_Modelo->Solicitudes($id_dpto,$fecha_desde,$fecha_hasta));
             elseif (!empty($id_dpto))
                 echo json_encode($this->Buscar_Modelo-> Solicitudes_dpto($id_dpto));
             else
                 echo json_encode(array('data'=>''));
         }else{
             echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
         }
     }

     function Get_Solicitud_Pdf(){
              $id_sl = $_GET['id'];
             if(!empty($id_sl)){
                 $solicitud = $this->Buscar_Modelo->Solicitud($id_sl);
                 $proceso = $this->Buscar_Modelo->Proceso_Solicitud($id_sl);
                 $usuario = $this->session->userdata('usuario');
                 $html = $this->load->view('pdfs/solicitud_pdf',compact('solicitud','proceso','usuario'),true);
                 $options = new Options();
                 $options->setIsHtml5ParserEnabled(true);
                 $options->setIsPhpEnabled(true);
                 $options->setDefaultPaperOrientation('landscape');
                 $options->setDefaultPaperSize('A4');
                 $dompdf = new Dompdf($options);
                 $dompdf->loadHtml($html);
                 $dompdf->render(); // Generar el PDF desde contenido HTML
                 $pdf = $dompdf->output(); // Obtener el PDF generado
                 $dompdf->stream('Solicitud_General.pdf',array("Attachment"=>0)); // Enviar el PDF generado al navegador
             }

     }

     function Get_Contratos(){
         if ($this->input->is_ajax_request()){
             $id_dpto=$this->input->post('dpto');
             $fecha_desde = $this->input->post('f_desde');
             $fecha_hasta = $this->input->post('f_hasta');
             if((!empty($fecha_desde)) and (!empty($fecha_hasta)) and (!empty($id_dpto)))
                 echo json_encode($this->Buscar_Modelo->Contratos($id_dpto,$fecha_desde,$fecha_hasta));
             elseif (!empty($id_dpto))
                 echo json_encode($this->Buscar_Modelo->Contratos_Dpto($id_dpto));
             else
                 echo json_encode(array('data'=>''));
         }else{
             echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
         }
     }

     function Get_Constrato_Pdf(){
         $id_ctr = $_GET['id'];
         if(!empty($id_ctr)){
             $contrato = $this->Buscar_Modelo->Contrato($id_ctr);
             $proceso = $this->Buscar_Modelo->Proceso_Contrato($id_ctr);
             $beneficios = $this->Buscar_Modelo->beneficios_Contrato($id_ctr);
             $anulado = $this->Buscar_Modelo->Contrato_Anulado($id_ctr);
             $usuario = $this->session->userdata('usuario');
             $html = $this->load->view('pdfs/contrato_info_pdf',compact('contrato','proceso','beneficios','anulado','usuario'),true);
             $options = new Options();
             $options->setIsHtml5ParserEnabled(true);
             $options->setIsPhpEnabled(true);
             $options->setDefaultPaperOrientation('landscape');
             $options->setDefaultPaperSize('A4');
             $dompdf = new Dompdf($options);
             $dompdf->loadHtml($html);
             $dompdf->render(); // Generar el PDF desde contenido HTML
             $pdf = $dompdf->output(); // Obtener el PDF generado
             $dompdf->stream($contrato['cedula_aspirante'].'_'.$contrato['codigo'].'.pdf',array("Attachment"=>0)); // Enviar el PDF generado al navegador

         }

     }



}