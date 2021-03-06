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
        $res=$this->db->query('SELECT opcion,p_id_personal FROM  esq_contrato.fnc_crear_aspirante(?,?,?,?,?,?,?,?);',$data);
        //echo $this->db->last_query();
        return $res->row_array();
    }

    public function CrearUsuraioRol($data){
       $res=$this->db->query("SELECT  esq_contrato.fnc_agregrar_usuario_rol(?,?,?);",$data);
        //$this->db->last_query();
        return $res->row_array();
    }

    public function BuscaPersona($cedula){
        $this->db->select('p.idpersonal, p.cedula, p.apellido1,  p.apellido2, p.nombres, p.correo_personal_institucional')
                 ->from('esq_datos_personales.personal as p')
                 ->where('p.cedula',$cedula);
        $res=$this->db->get();
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $persona['info']=array_map('utf8_encode',$res->result_array()[$i]);
            }
        }
        $persona['num']=$res->num_rows();
        return $persona;
    }

    public function EliminarRol($idpersona,$idrol){
        $this->db->select(" count(solicitud_contrato.id_solicitud_contrato) as num ")
                 ->from(" esq_contrato.solicitud_contrato ")
                 ->where(" solicitud_contrato.id_personal ",$idpersona)
                 ->where(" (solicitud_contrato.estado='P' OR  solicitud_contrato.estado='A') ")
                 ->where_not_in(" solicitud_contrato.id_personal "," SELECT contrato.id_contrato FROM esq_contrato.contrato WHERE contrato.estado='P' OR  contrato.estado='A' ",false);
        $reg_solicitud= $this->db->get();
        if($reg_solicitud->row('num') == 0) {
            $this->db_user->where('tbl_personal_rol.id_rol', $idrol)
                ->where('tbl_personal_rol.id_personal', $idpersona)
                ->delete('esq_roles.tbl_personal_rol');
            //echo $this->db_user->last_query();
            if ($this->db_user->affected_rows() == 1) {
              $resp['mensaje']='Se Elimino Correctamente';
              $resp['opcion']=1;
              return $resp;
            } else {
              $resp['mensaje']='Error: No Se Elimino';
              $resp['opcion']=2;
              return $resp;
            }
        }else{
            $resp['mensaje']='Error: Tiene Solicitud o Contrato en proceso o Activo';
            $resp['opcion']=2;
            return $resp;
        }
    }

    public function RegistrosInscritos($datos){
        $res=$this->db->query('SELECT p_idpersona,p_cedula,p_apellido1,p_apellido2,p_nombres,p_departamento FROM esq_contrato.fnc_listaraspirantes(?,?);',$datos);
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data['data'][]=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return $ress = array('data' => "");
        }
    }

    public function RegistrosSolicitud($datos){
        $res=$this->db->query('SELECT p_id_solicitud,p_cedula,p_persona,p_tipo_solicitud,p_categoria,p_tipo_dedicacion,p_puesto,p_observacion,p_fecha,p_estdo FROM esq_contrato.fnc_listar_solicitud(?,?);',$datos);
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data['data'][]=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return $ress = array('data' => "");
        }
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

    function VerificaEstado($datos){
        $res=$this->db->query("SELECT count(*) as num  FROM esq_contrato.proceso_solicitud WHERE id_solicitud=? AND id_tipo_aprobacion=? AND estado='P' ;",$datos);
        //echo $this->db->last_query();
        return $res->row_array();
    }
}