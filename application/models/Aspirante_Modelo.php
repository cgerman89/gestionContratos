<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 7/8/2017
 * Time: 10:25
 */

class Aspirante_Modelo extends CI_Model {
    private $db_user;
    public function  __construct(){
        parent::__construct();
        $this->db_user=$this->load->database('db_usuarios',TRUE);
    }
    public function Save($data){
        $res=$this->db->query('SELECT p_idpersonal,p_opcion, p_mensaje from  esq_contrato.crear_persona(?,?,?,?,?);',$data);
        //>echo $this->db->last_query();
        return $res->row_array();
    }

    public function CrearClave($datos){
        $res=$this->db_user->query('SELECT opcion, mensaje FROM esq_roles.fnc_crear_clave_sth(?,?);',$datos);
        //>echo $this->db_user->last_query();
        return $res->row_array();
    }

    public function SaveRol($data){
        $res=$this->db_user->query('SELECT p_opcion, p_mensaje from esq_roles.fnc_agregar_rol_sth(?,?,?);',$data);
        //>echo $this->db->last_query();
        return $res->row_array();
    }

    public function SaveSolicitud($datos){
        $res=$this->db->query('SELECT  p_opcion, p_mensaje from esq_contrato.fnc_crear_solicitud_contrato(?,?,?,?,?,?,?,?,?,?);',$datos);
        //$this->db->last_query();
       return $res->row_array();
    }
    public function BuscaPersona($cedula){
        $this->db->select('p.idpersonal, p.cedula, p.apellido1,  p.apellido2, p.nombres, p.correo_personal_institucional')
                 ->from('esq_datos_personales.personal as p')
                 ->where('p.cedula',$cedula);

        $res=$this->db->get();
        //echo $this->db->last_query();
        $persona['datos']=$res->result_array();
        $persona['num']=$res->num_rows();
        return $persona;
    }

    public function EliminarRol($idpersona,$idrol){
        $this->db_user->where('tbl_personal_rol.id_rol',$idrol)
                      ->where('tbl_personal_rol.id_personal',$idpersona)
                      ->delete('esq_roles.tbl_personal_rol');
        //echo $this->db_user->last_query();
        if($this->db_user->affected_rows()){
          return 'Se Elimino Correctamente';
        }else{
            return 'No Se Elimino';
        }
    }

    public function RegistrosInscritos($datos){
        $res=$this->db->query('SELECT p_idpersona,p_cedula,p_apellido1,p_apellido2,p_nombres,p_usuario,p_departamento FROM esq_contrato.fnc_listaraspirantes(?,?);',$datos);
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            $data['data']=$res->result_array();
            return $data;
        }else{
            $res=array('data' => "");
        }
        return $res;
    }

    public function RegistrosSolicitud($datos){
        $res=$this->db->query('SELECT p_id_solicitud,p_cedula,p_persona,p_tipo_solicitud,p_categoria,p_tipo_dedicacion,p_puesto,p_observacion,p_fecha,p_estdo FROM esq_contrato.fnc_listar_solicitud(?,?);',$datos);
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            $data['data']=$res->result_array();
            return $data;
        }else{
            $res=array('data' => "");
        }
        return $res;
    }

    public function RegistrosProcesos($id_solicitud){
        $res=$this->db->query('SELECT p_id_proceso_solicitud,p_proceso,p_fecha,p_hora,p_observacion,p_estado FROM  esq_contrato.fnc_listar_procesos(?);',$id_solicitud);
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            $data['data']=$res->result_array();
            return $data;
        }else{
            $res=array('data' => "");
        }
        return $res;
    }
}