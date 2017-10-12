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
        $res=$this->db_user->query('SELECT p_opcion, p_mensaje from esq_roles.fnc_agregar_rol_sth(?,?);',$data);
        //>echo $this->db->last_query();
        return $res->row_array();
    }

    public function BuscaPersona($cedula){
        $this->db->select('p.idpersonal, p.cedula, p.apellido1,  p.apellido2, p.nombres, p.correo_personal_institucional')
                 ->from('esq_datos_personales.personal as p')
                 ->where('p.cedula',$cedula);
        $res=$this->db->get();
        $persona['datos']=$res->result_array();
        $persona['num']=$res->num_rows();
        return $persona;
    }

    public function EliminarRol($idpersona,$idrol){
        $this->db_user->where('tbl_personal_rol.id_rol',$idrol)
                      ->where('tbl_personal_rol.id_personal',$idpersona)
                      ->delete('esq_roles.tbl_personal_rol');
        if($this->db_user->affected_rows()){
          return 'Se Elimino Correctamente';
        }else{
            return 'No Se Elimino';
        }
    }

    public function RegistrosInscritos(){
        $sql  =" SELECT personal.idpersonal, personal.cedula, personal.apellido1, personal.apellido2, personal.nombres";
        $sql .="  FROM esq_datos_personales.personal";
        $sql .="  JOIN  dblink(esq_contrato.fnc_con_db_usuarios(),'SELECT   tbl_personal_rol.id_personal as idpersona FROM esq_roles.tbl_personal_rol WHERE tbl_personal_rol.id_rol=47 AND tbl_personal_rol.estado=''S'';')";
        $sql .=" datos(idpersona BIGINT)ON idpersona= esq_datos_personales.personal.idpersonal";
        $sql .=" where personal.estado_usuario='S';";
        //echo $sql;
        $res=$this->db->query($sql);
        if($res->num_rows() > 0){
            $data['data']=$res->result_array();
            return $data;
        }else{
            $res=array('data' => "");
        }
        return $res;
    }
}