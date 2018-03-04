<?php
/**
 * Created by PhpStorm.
 * User: Toshiba
 * Date: 24/2/2018
 * Time: 16:04
 */
use Carbon\Carbon;
class cFirma extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Contrato_Modelo');
        $this->load->model('Perfil_model');


    }

    function index(){
        if($this->session->userdata('login')=== TRUE){
            if($this->session->userdata('id_tipo_usuario') === '48') {
                $this->load->view('template/head');
                $this->load->view('template/nav');
                $this->load->view('vFirma');
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
                echo json_encode($this->Contrato_Modelo->ListarContrtosAll('v_contrato.estado_firma',$this->input->post('estado')));
            }else{
                echo json_encode($this->Contrato_Modelo->ListarContrtos($this->input->post('id_dpto'),'v_contrato.estado_firma',$this->input->post('estado')));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function Aprobar_Proceso_Firma(){
        if ($this->input->is_ajax_request()){
            $campos= array(
                'id_contrato'=>$this->input->post('id_contrato'),
                'id_personal'=>$this->session->userdata('id_personal'),
                'proceso'=>71
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
                'proceso'=>71,
                'observacion'=>$this->input->post('observacion')
            );
            echo json_encode($this->Contrato_Modelo->RechazarProceso($campos));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    function SubirArchivo(){
        if ($this->input->is_ajax_request()) {
            $config['upload_path']   = './uploads/contratos_firma/';
            $config['allowed_types'] = 'pdf';
            $config['max_size']      = 0;
            $this->load->library('upload', $config);
            if($this->upload->do_upload('archivo')){
                $archivo_bin=$this->BinarioArchivo($this->upload->data('file_name'),$this->input->post('ced_asp'),$this->input->post('id_ctr'));
                echo json_encode($this->Contrato_Modelo->SavePdf($archivo_bin));
            }else{
                $res= array('mensaje'=>$this->upload->display_errors(),'opcion'=>2);
                echo json_encode($res);
            }

        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function BinarioArchivo($nombre_archivo,$idpersona,$id_contrato){
        $dt = Carbon::now(new DateTimeZone('America/Guayaquil'));
        if(!empty($nombre_archivo)==true){
            $archivo_ruta = './uploads/contratos_firma/'.$nombre_archivo;
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $archivo_mime=finfo_file($finfo,$archivo_ruta);// obtiene el MIME
            $archivo_size=filesize($archivo_ruta);//BYTES
            finfo_close($finfo);
            //Contenido del archivo
            $fp              = fopen($archivo_ruta, "rb");
            $v_fichero_buffer= fread($fp, filesize($archivo_ruta));
            fclose($fp);
            $campos= array(
                'nombre'=>$idpersona.'_'.$nombre_archivo,
                'descripcion'=>$idpersona.'_'.$nombre_archivo,
                'archivo_bin'=>mb_convert_encoding($v_fichero_buffer,"LATIN1"),
                'archivo_mime'=>$archivo_mime,
                'archivo_tamanio'=>$archivo_size,
                'fecha' => $dt->toDateString(),
                'id_contrato'=> $id_contrato
            );
            return $campos;
        }

    }

    function EliminarPdf(){
        if ($this->input->is_ajax_request()) {
            if(!empty($this->input->post('id_ctr'))==true)
                 echo json_encode($this->Contrato_Modelo->DeletePdf($this->input->post('id_ctr')));
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function Deshacer(){
        if ($this->input->is_ajax_request()){
            if(!empty($this->input->post('id_contrato')) == true)
                echo json_encode($this->Contrato_Modelo->DeshacerProceso($this->input->post('id_contrato'), 71));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    function LeerPdf(){
        if(empty($_GET['id_ctr'])!==true)
             $res = $this->Contrato_Modelo-> GetPdf($_GET['id_ctr']);
             $pdf = pg_unescape_bytea($res['archivo_bin']);
             header('Content-type: application/pdf');
             header('Content-Disposition: inline; filename="'.$res['nombre'].'"');
             header('Content-Transfer-Encoding: binary');
             header("Content-length:".$res['archivo_tamanio']);
             header('Accept-Ranges: bytes');
             readfile($pdf);
    }
}