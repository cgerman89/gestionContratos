<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 12/7/2017
 * Time: 8:45
 */
class Perfil extends CI_Controller{
    private $cedula='';
    function __construct(){
        parent::__construct();
        $this->load->model('Perfil_model');
        $this->cedula=$this->session->userdata('cedula');
    }

    public function index(){
     if($this->session->userdata('login')=== TRUE){
        if($this->session->userdata('id_tipo_usuario') === '47') {
            $this->load->view('template/head');
            $this->load->view('template/nav');
            $this->load->view('Perfil');
            $this->load->view('template/footer');
        }else{
            redirect('/Home');
        }
     }else{
         redirect('/');
     }

    }

    public function InforPersona(){
        if ($this->input->is_ajax_request()) {
            $campos = array(
                'cedula' => $this->cedula,
                'apellido1'=> $this->input->post('apellido1'),
                'apellido2'=>$this->input->post('apellido2'),
                'nombres'=>$this->input->post('nombres'),
                'idtipo_nacionalidad'=>$this->input->post('nacionalidad_per'),
                'idtipo_genero'=>$this->input->post('sexo_per'),
                'idtipo_estado_civil'=>$this->input->post('e_civil_per'),
                'idtipo_etnia'=>$this->input->post('etnia_per'),
                'idtipo_sangre'=>$this->input->post('t_sangre_per'),
                'idtipo_pais_origen'=>$this->input->post('pais_per'),
                'idtipo_provincia_origen'=>$this->input->post('provincia_per'),
                'idtipo_canton_origen'=>$this->input->post('canton_per'),
                'idtipo_parroquia_origen'=>$this->input->post('parroquia_per'),
                'fecha_nacimiento'=>$this->input->post('fnacimiento')
            );
            $res=$this->Perfil_model->SaveInfoPer($campos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }
    public function Domicilio(){
        if ($this->input->is_ajax_request()) {
            $campos = array(
                'cedula' => $this->cedula,
                'idtipo_pais_residencia'=> $this->input->post('pais_domi'),
                'idtipo_provincia_residencia'=>$this->input->post('provincia_domi'),
                'idtipo_canton_residencia'=>$this->input->post('canton_domi'),
                'idtipo_parroquia_residencia '=>$this->input->post('parroquia_domi'),
                'residencia_calle_1'=>$this->input->post('calle_prin'),
                'residencia_calle_2'=>$this->input->post('calle1_domi'),
                'residencia_calle_3'=>$this->input->post('calle2_domi'),
                'residencia_referencia'=>$this->input->post('refrencia_domi'),
                'residencia_domicilio_numero'=>$this->input->post('num_casa'),
                'telefono_personal_domicilio'=>$this->input->post('telefono_domi'),
                'telefono_personal_celular'=>$this->input->post('celular_domi'),
                'telefono_personal_trabajo'=>$this->input->post('celular2_domi'),
                'correo_personal_alternativo'=>$this->input->post('correo2_domi')
            );
            $res=$this->Perfil_model->SaveDimicilio($campos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }
    public function InstFormal(){
        if ($this->input->is_ajax_request()) {
            $campos = array(
                    'cedula'=>$this->cedula,
                    'universidad'=>$this->input->post('universidad_fp'),
                    'nivel_instruccion'=>$this->input->post('Ninstruccion_fp'),
                    'area_conocimiento'=>$this->input->post('Aconocimiento_fp'),
                    'sub_area'=>$this->input->post('sbArea_fp'),
                    'sub_area_especifica'=>$this->input->post('sbAreaES_fp'),
                    'titulo'=>$this->input->post('titulo_obt_fp'),
                    'numero_registro'=>$this->input->post('N_regitro_fp'),
                    'fecha_inicio'=>$this->input->post('fecha_inicio_fp'),
                    'fecha_obtuvo'=>$this->input->post('fecha_obtuvo_fp'),
                    'fecha_graduacion'=>$this->input->post('fecha_graduacion_fp'),
                    'numero_periodos'=>$this->input->post('n_periodos_fp'),
                    'tipo_periodos'=>$this->input->post('Tperiodo_fp'),
                    'fichero'=>$this->input->post('idfichero'),
                    'beca'=>$this->input->post('beca_fp')
                );
            $res=$this->Perfil_model->SaveFormal($campos);
            echo json_encode($res);

        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function Capacitacion(){
        if ($this->input->is_ajax_request()) {
                 $campos = array(
                        'cedula'=>$this->cedula,
                         'p_tipo_pais'=>$this->input->post('pais_cp'),
                         'p_idtipo_capacitacion'=>$this->input->post('tipo_cp'),
                         'p_idtipo_certificado'=>$this->input->post('tipo_cert_cp'),
                         'p_nombre_evento'=>$this->input->post('evento_cp'),
                         'p_nombre_auspiciante'=>$this->input->post('auspiciante_cp'),
                         'p_numero_horas'=>$this->input->post('horas_cp'),
                         'p_fecha_inicio'=>$this->input->post('fecha_inicio_cp'),
                         'p_fecha_final'=>$this->input->post('fecha_final_cp'),
                         'p_institucion_certificante'=>$this->input->post('certificado_cp'),
                         'p_idarchivo'=>$this->input->post('idfichero')
                    );
                 $res=$this->Perfil_model->SaveCapacitacion($campos);
                 echo json_encode($res);

        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }            
    }

    public function ExpProfesional(){
        if ($this->input->is_ajax_request()) {
                    $campos = array(
                         'p_cedula'=>$this->cedula,
                         'p_idpais'=>$this->input->post('pais_exp_pro'),
                         'p_inst_sostenibilidad'=>$this->input->post('sostenibilidad_exp_pro'),
                         'p_idmotivo_ingreso'=>$this->input->post('M_ingreso_exp_pro'),
                         'p_idmotivo_salida'=>$this->input->post('M_salida_exp_pro'),
                         'p_id_area_conocimiento'=>$this->input->post('area_exp_pro'),
                         'p_id_subarea'=>$this->input->post('sub_area_exp_pro'),
                         'p_especifica'=>$this->input->post('especifica_exp_pro'),
                         'p_nombre_institucion'=>$this->input->post('instruccion_exp_pro'),
                         'p_nombre_uni_administrativa'=>$this->input->post('uni_admin_exp_pro'),
                         'p_nombre_puesto'=>$this->input->post('cargo_exp_pro'),
                         'p_fecha_inicio'=>$this->input->post('fecha_inicio_exp_pro'),
                         'p_fecha_final'=>$this->input->post('fecha_fin_exp_pro'),
                         'p_id_fichero'=>$this->input->post('idfichero'),
                         'p_act_docente'=>$this->input->post('docencia'),
                         'p_act_gestiongestion'=>$this->input->post('gestion')
                        );
                    $res=$this->Perfil_model->SaveExpProfesional($campos);
                    echo json_encode($res);
        }else{
           echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso'); 
        }              
    }

    public function Publicacion(){
        if ($this->input->is_ajax_request()) {
            $campos = array(
                'p_cedula'=>$this->cedula,
                'p_instrumento'=>$this->input->post('instrumento'),
                'p_tipo_publicacion'=>$this->input->post('tipo_publicacion_pb'),
                'p_estado_publicacion'=>$this->input->post('estado_pub'),
                'p_sub_area_conocimiento_espe'=>$this->input->post('area_espe'),
                'p_tipo_participacion'=>$this->input->post('participacion'),
                'p_fichero_1'=>$this->input->post('arch_subido'),
                'p_fichero_2'=>$this->input->post('arch_progr_cient_pb'),
                'p_fecha'=>$this->input->post('fecha_publicacion'),
                'p_url'=>$this->input->post('url'),
                'p_nombre'=>$this->input->post('nombre'),
                'p_ciudad'=>$this->input->post('ciudad'),
                'p_editor'=>$this->input->post('editor'),
                'p_rango_paginas'=>$this->input->post('rango_pagina'),
                'p_revista_numero'=>$this->input->post('num_revista'),
                'p_revista_volumen'=>$this->input->post('num_volumen'),
            );
            $res=$this->Perfil_model->SavePublicacion($campos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function Banco(){
        if ($this->input->is_ajax_request()) {
            $campos = array(
                'p_cedula'=>$this->cedula,
                'p_id_institucion'=>$this->input->post('inst_financiera_bc'),
                'p_id_tipo_cuenta'=>$this->input->post('tipo_cuenta_bc'),
                'p_numero_cuenta'=>$this->input->post('numero_cuenta_bc')
                );
              $res=$this->Perfil_model->SaveBanco($campos);
              echo json_encode($res);
        }else{
           echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso'); 
        }
    }
    public function Discapacidad(){
        if ($this->input->is_ajax_request()) {
            $campos = array(
                'p_cedula'=>$this->cedula,
                'p_numero_de_carnet'=>$this->input->post('numero_carnet'),
                'p_porcentaje'=>$this->input->post('porcentaje'),
                'tipo_discapacidad'=>$this->input->post('tipo_discapacidad'),
                'observacion'=>$this->input->post('observacion_dis')
                );
            $res=$this->Perfil_model->SaveDiscapacidad($campos);
            echo json_encode($res);
        }else{
           echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso'); 
        }
    }

    public function Archivo(){
        if ($this->input->is_ajax_request()) {
            $carpeta=$this->input->post('carpeta');
            $config['upload_path']   = './uploads/'.$carpeta.'/';
            $config['allowed_types'] = 'pdf';
            $config['max_size']      = 2048;
            $this->load->library('upload', $config);
            if($this->upload->do_upload('archivo')){
                $archivo_bin=$this->BinarioArchivo($this->upload->data('file_name'),$carpeta,$this->cedula,$this->input->post('tipo_documento'));
                $archivo_id = get_object_vars($this->Perfil_model->SavePdf($archivo_bin));
                $res = array('id_fichero'=>$archivo_id['crear_archivo'],'mensaje'=>'Guardado Correctamente','opcion'=>1);
            }else{
                $res= array('mensaje'=>$this->upload->display_errors(),'opcion'=>2);
            }
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function EliminarArchivo(){
        if ($this->input->is_ajax_request()) {
            $res=$this->Perfil_model->EliminarFichero($this->input->post('id_fichero'));
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function BinarioArchivo($nombre_archivo,$carpeta,$idpersona,$tipo_documento){
         if(!empty($nombre_archivo)==true){
             $archivo_ruta = './uploads/'.$carpeta.'/'.$nombre_archivo;
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
                 'archivo_bin'=>$v_fichero_buffer,
                 'archivo_mime'=>$archivo_mime,
                 'archivo_tamanio'=>$archivo_size,
                 'idtipo_documento'=>$tipo_documento,
                 'cedula'=>$idpersona
             );
             return $campos;
         }

    }

    public function RegisInf_Personal(){
        if ($this->input->is_ajax_request()){
            $res=$this->Perfil_model->Datos_Info_personal($this->cedula);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function RegisInstFormal(){
        if ($this->input->is_ajax_request()) {
                 $res=$this->Perfil_model->DatosAllFormacion($this->cedula);
                 echo json_encode($res);
        }else{
                 echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function RegisPublicacion(){
        if ($this->input->is_ajax_request()) {
            $datos= array(
                'cedula'=>$this->cedula,
                'tipo_p'=>$this->input->post('tipo_p')
            );
            $res=$this->Perfil_model->AllPublicacion($datos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function RegisCapacitacion(){
        # funcion trae los registros de capacitacion de la persona
        if ($this->input->is_ajax_request()) {
                 $res=$this->Perfil_model->AllCapacitacion($this->cedula);
                 echo json_encode($res);
        }else{
                 echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
      } 

    public function RegisExpProfesional(){
         if ($this->input->is_ajax_request()) {
                 $res=$this->Perfil_model->AllExpProfesional($this->cedula);
                 echo json_encode($res);
        }else{
                 echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
     }

    public function RegisBanco(){
        if ($this->input->is_ajax_request()) {
                 $res=$this->Perfil_model->AllBanco($this->cedula);
                 echo json_encode($res);
        }else{
                 echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }
    public function EliminarPublicacion(){
        if ($this->input->is_ajax_request()){
              $fichero1=$this->input->post('fichero1');
              $fichero2=$this->input->post('fichero2');
              $id_publicacion=$this->input->post('id_publicacion');
            if(!empty($fichero1)==true){
                $res=$this->Perfil_model->EliminarFichero($this->input->post('fichero1'));
            }
            if(!empty($fichero2)==true){
                $res=$this->Perfil_model->EliminarFichero($this->input->post('fichero2'));
            }
            if(!empty($id_publicacion)==true){
                $ress=$this->Perfil_model->EliminarPublicacion($this->input->post('id_publicacion'));
                echo json_encode($ress);
            }
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function EliminarRegisFormacion(){
          if ($this->input->is_ajax_request()) {
             $tabla='esq_datos_personales.p_formacion_profesional';
             $condicion='p_formacion_profesional.idformacion_profesional';
             $id_formacion= $this->input->post('id_personal');
             $id_fichero= $this->input->post('id_archivo');
             $res=$this->Perfil_model->EliminarRegistro($tabla,$condicion,$id_formacion, $id_fichero);
             echo json_encode($res);
          }else{
             echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
          }
    }

    public function EliminarCapacitacion(){
          # funcion elimina capacitacion y el archivo pdf vinculado
          if ($this->input->is_ajax_request()) {
             $tabla='esq_datos_personales.p_capacitacion';
             $condicion='p_capacitacion.idcapacitacion';
             $id_capacitacion=$this->input->post('id_capacitacion');
             $id_fichero=$this->input->post('id_archivo');
             $res=$this->Perfil_model->EliminarRegistro($tabla,$condicion,$id_capacitacion,$id_fichero);
             echo json_encode($res);
          }else{
             echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
          }
    }
    public function EliminarExpProfesional(){
          if ($this->input->is_ajax_request()){
             $tabla='esq_datos_personales.p_trayectoria_laboral';
             $condicion='p_trayectoria_laboral.idtrayectoria_laboral';
             $id_exp_profesional=$this->input->post('id_exp_profesional');
             $id_fichero=$this->input->post('id_archivo');
             $res=$this->Perfil_model->EliminarRegistro($tabla,$condicion,$id_exp_profesional,$id_fichero);
             echo json_encode($res);
          }else{
             echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
          } 
    }

    public function EliminarBanco(){
        if ($this->input->is_ajax_request()){
            $tabla='esq_datos_personales.p_bancaria';
            $condicion='p_bancaria.idbancaria';
            $id_campo=$this->input->post('p_id_banco');
            $res=$this->Perfil_model->EliminarRegistro_SF($tabla,$condicion,$id_campo);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }

    }

}//fin de clase perfil