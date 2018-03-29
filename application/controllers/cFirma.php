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
                echo json_encode($this->Contrato_Modelo->ListarContratos_firma_All($this->input->post('estado')));
            }else{
                echo json_encode($this->Contrato_Modelo->ListarContratos_firma($this->input->post('id_dpto'),$this->input->post('estado')));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function ListarContratos_rzd(){
        if ($this->input->is_ajax_request()){
            if($this->input->post('id_dpto') === '-3' ){
                echo json_encode($this->Contrato_Modelo->ListarContratos_redz_All('v_contrato.estado_firma',$this->input->post('estado')));
            }else{
                echo json_encode($this->Contrato_Modelo->ListarContratos_redz($this->input->post('id_dpto'),'v_contrato.estado_firma',$this->input->post('estado')));
            }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    function Aprobar_Proceso_Firma($id_contrato){
        if ($this->input->is_ajax_request()){
            if(!empty($id_contrato)== true)
                $campos= [ 'id_contrato'=>$id_contrato, 'id_personal'=>$this->session->userdata('id_personal'), 'proceso'=>71,'p_id_aprobacion'=>71, 'p_id_facultad'=> -71];
                return $this->Contrato_Modelo->AprobarProceso($campos);
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
                'observacion'=>$this->input->post('observacion'),
                'p_id_aprobacion'=>71,
                'p_id_facultad'=> -71
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
                $res=$this->Contrato_Modelo->SavePdf($archivo_bin);
                if($res['p_opcion'] == 1){
                     echo json_encode($this->Aprobar_Proceso_Firma($this->input->post('id_ctr')));
                }else if($res['p_opcion'] == 2){
                     echo json_encode(['opcion'=>'2','mensaje'=>$res['p_mensaje']]);
                }
            }else{
                $res= ['mensaje'=>$this->upload->display_errors(),'opcion'=>'2'];
                return $res;
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
                'archivo_bin'=>pg_escape_bytea($v_fichero_buffer),
                'archivo_mime'=>$archivo_mime,
                'archivo_tamanio'=>$archivo_size,
                'fecha' => $dt->toDateString(),
                'id_contrato'=> $id_contrato
            );
            return $campos;
        }

    }

    function Deshacer(){
        if ($this->input->is_ajax_request()){
            if(!empty($this->input->post('id_contrato')) == true)
                echo json_encode($this->Contrato_Modelo->DeshacerProceso([$this->input->post('id_contrato'), 71]));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    function LeerPdf(){
        if(empty($_GET['id_ctr'])!==true) {
             $res = $this->Contrato_Modelo->GetPdf($_GET['id_ctr']);
             $file = pg_unescape_bytea($res['archivo_bytea']);
             header("Cache-control: private");
             header("Content-type:".$res['archivo_mime']);
             header("Content-Disposition: inline; filename=".$res['nombre']);
             header("Content-length:". $res['archivo_tamanio']);
             header("Expires: ".gmdate("D, d M Y H:i:s", mktime(date("H")+2, date("i"), date("s"), date("m"), date("d"), date("Y")))." GMT");
             header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
             header("Cache-Control: no-cache, must-revalidate");
             header("Pragma: no-cache");
             print $file;
        }
    }
}