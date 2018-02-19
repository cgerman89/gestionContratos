<?php
/**
 * Created by PhpStorm.
 * User: Toshiba
 * Date: 30/1/2018
 * Time: 15:35
 */
use Dompdf\Dompdf;
use Dompdf\Options;
use Carbon\Carbon;

class Contrato_Text extends CI_Controller {

      function __construct(){
          parent::__construct();
          $this->load->model('Texto_Modelo');
          $this->load->model('Contrato_Modelo');
      }

      function index(){
          if($this->session->userdata('login')=== TRUE){
              if($this->session->userdata('id_tipo_usuario') === '48') {
                  $this->load->view('template/head');
                  $this->load->view('template/nav');
                  $this->load->view('v_Contrato_Text');
                  $this->load->view('template/footer');
              }else{
                  redirect('/Permiso');
              }
          }else{
              redirect('/');
          }
      }

      function Denominacion(){
          if ($this->input->is_ajax_request()){
              if($this->input->post('id_tipo') === '1'){
                  echo json_encode($this->Texto_Modelo->DenominacionDocente());
              }else if ($this->input->post('id_tipo') === '2'){
                  echo json_encode($this->Texto_Modelo->DenominacionAdministrativo());
              }
          }else{
              echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
          }
      }

      function SaveTexto(){
          if ($this->input->is_ajax_request()){
              $dt = Carbon::now(new DateTimeZone('America/Guayaquil'));
              if(!empty($this->input->post('id_texto')) == true){
                  echo json_encode($this->Texto_Modelo-> Update($this->input->post('id_texto'),['texto'=>$this->input->post('texto'),'fecha'=> $dt->toDateString()]));
              }else{
                  echo json_encode($this->Texto_Modelo->Save(['id_texto'=>$this->Texto_Modelo->MaxId()['id'],'id_tipo'=>$this->input->post('id_tipo'),'id_denominacion'=>$this->input->post('id_denominacion'),'texto'=>$this->input->post('texto'),'fecha'=> $dt->toDateString()]));
              }
          }else{
              echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
          }
      }

      function Eliminar(){
          if ($this->input->is_ajax_request()){
              if(!empty($this->input->post('id_texto') == true))
                  echo json_encode($this->Texto_Modelo->Delete($this->input->post('id_texto')));
          }else{
              echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
          }
      }

      function GetAllTexto(){
          if ($this->input->is_ajax_request()){
               echo json_encode($this->Texto_Modelo->AllTexto($this->input->post('id_tipo')));
          }else{
              echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
          }
      }

      function Pdf(){
          $datos_c=$this->Contrato_Modelo->DatosTextoContrato($_GET['id']);
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
          $dompdf->stream('Contrato.pdf',array("Attachment"=>0)); // Enviar el PDF generado al navegador

      }

}