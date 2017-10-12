<?php

/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 21/7/2017
 * Time: 16:19
 */
class Campos extends  CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Campos_model');
    }
    public function Pais(){
        if ($this->input->is_ajax_request()) {
            $res = $this->Campos_model->CargarPais();
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso Esta Url','403', $heading = 'Error de Acceso');
        }
    }
    public function Provincia(){
        if ($this->input->is_ajax_request()) {
            $res = $this->Campos_model->CargarProvin($this->input->post('id_pais'));
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function Canton(){
        if ($this->input->is_ajax_request()) {
            $res = $this->Campos_model->CargarCanton($this->input->post('id_provincia'));
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso Esta Url','403', $heading = 'Error de Acceso');
        }
    }
    public function Parroquia(){
        if ($this->input->is_ajax_request()) {
            $res = $this->Campos_model->CargarParroquia($this->input->post('id_canton'));
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso Esta Url','403', $heading = 'Error de Acceso');
        }
    }
    public function Tipo(){
        if ($this->input->is_ajax_request()) {
            $res = $this->Campos_model->CargaTipo($this->input->post('id'));
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso Esta Url','403', $heading = 'Error de Acceso');
        }
    }
    public function Tipo_hijo(){
        if ($this->input->is_ajax_request()) {
            $res = $this->Campos_model->CargaTipoHijo($this->input->post('id_hijo'));
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso Esta Url','403', $heading = 'Error de Acceso');
        }
    }
    public function Universidad(){
        if ($this->input->is_ajax_request()) {
            $res = $this->Campos_model->CargaUniversidad();
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso Esta Url','403', $heading = 'Error de Acceso');
        }
    }
    public function Instrumento_Pub(){
       if ($this->input->is_ajax_request()) {
            $cadena=$this->input->post('q');
            if(!empty($cadena)==true){
                $res = $this->Campos_model->Get_Instrumento_Pub($cadena);
                echo json_encode($res);
            }
        }else{
            echo show_error('No Tiene Acceso Esta Url','403', $heading = 'Error de Acceso');
       }
    }

    public function SubirArchivo(){
        $config['upload_path']   = './uploads/'.$this->input->post('carpeta').'/';
        $config['allowed_types'] = 'pdf';
        $config['max_size']      = 2048;
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('archivo')){
                     $respuesta = array('mensaje'=>$this->upload->display_errors(),'opcion'=>2);
                }else{
                     $respuesta = array('nombre'=>$this->upload->data('file_name'),'mensaje'=>'Subido Correctamente','opcion'=>1);
                }
            echo json_encode($respuesta);

    }
    public function EliminarFile(){
        if ($this->input->is_ajax_request()) {
                  $base = './uploads/'.$this->input->post('carpeta').'/'.$this->input->post('nombre');
                  if(unlink($base)){
                      $repuesta= array('opcion'=>1,'mensaje'=>'Se elimino Correctamente');
                  }else{
                      $repuesta=array('opcion'=>2,'mensaje'=>'No elimino');
                  }        
            echo json_encode($repuesta);
        }else{
            echo show_error('No Tiene Acceso Esta Url','403', $heading = 'Error de Acceso');
        }  
    }


}