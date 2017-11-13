<?php
/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 9/11/2017
 * Time: 0:17
 */

class Solicitud_Contrato_Modelo extends CI_Model {
    public function  __construct(){
        parent::__construct();
    }
    public function SaveSolicitud($datos){
        $res=$this->db->query("SELECT  p_opcion, p_mensaje from esq_contrato.fnc_crear_solicitud_contrato(?,?,?,?,?,?,?,?,?,?);",$datos);
        //$this->db->last_query();
        return $res->row_array();
    }

    public function RegistrosSolicitudDpto($dpto){
        $this->db->select("v_sc.id_solicitud_contrato, v_sc.id_personal, v_sc.aspirante, v_sc.cedula_aspirante, v_sc.fecha_solicitud, v_sc.t_contrato, v_sc.categoria, v_sc.dedicacion, v_sc.puesto, v_sc.observacion, v_sc.estado")
                 ->from("esq_contrato.v_solicitud_contrato as v_sc")
                 ->where("v_sc.id_departamento",$dpto);
        $res= $this->db->get();
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data['data'][]=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return array('data'=>'');
        }
    }

    public function SolicitudRector($dpto,$estado_rect){
        $this->db->select("v_sc.id_solicitud_contrato, v_sc.id_personal, v_sc.aspirante, v_sc.cedula_aspirante, v_sc.departamento, v_sc.cordinador, v_sc.fecha_solicitud, v_sc.t_contrato, v_sc.categoria, v_sc.dedicacion, v_sc.puesto, v_sc.observacion, v_sc.estado_apro_rec")
            ->from("esq_contrato.v_solicitud_contrato as v_sc")
            ->where("v_sc.id_departamento",$dpto)->where(" v_sc.estado_apro_rec",$estado_rect)->where(" v_sc.estado<>'R' ");
        $res= $this->db->get();
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data['data'][]=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return array('data'=>'');
        }
    }

    public function SolicitudRectorAll($estado_rect){
        $this->db->select("v_sc.id_solicitud_contrato, v_sc.id_personal, v_sc.aspirante, v_sc.cedula_aspirante, v_sc.departamento, v_sc.cordinador, v_sc.fecha_solicitud, v_sc.t_contrato, v_sc.categoria, v_sc.dedicacion, v_sc.puesto, v_sc.observacion,v_sc.estado_apro_rec")
            ->from("esq_contrato.v_solicitud_contrato as v_sc")
            ->where(" v_sc.estado_apro_rec",$estado_rect)->where(" v_sc.estado<>'R' ");
        $res= $this->db->get();
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data['data'][]=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return array('data'=>'');
        }
    }

    public function SolicitudRecursosHumano($dpto,$estado_rh){
        $this->db->select("v_sc.id_solicitud_contrato, v_sc.id_personal, v_sc.aspirante, v_sc.cedula_aspirante, v_sc.departamento, v_sc.cordinador, v_sc.fecha_solicitud, v_sc.t_contrato, v_sc.categoria, v_sc.dedicacion, v_sc.puesto, v_sc.observacion, v_sc.estado_apro_rh")
            ->from("esq_contrato.v_solicitud_contrato as v_sc")
            ->where("v_sc.id_departamento",$dpto)->where(" v_sc.estado_apro_rh",$estado_rh)->where(" v_sc.estado<>'R' ");
        $res= $this->db->get();
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data['data'][]=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return array('data'=>'');
        }
    }

    public function SolicitudRecursosHumanoAll($estado_rh){
        $this->db->select("v_sc.id_solicitud_contrato, v_sc.id_personal, v_sc.aspirante, v_sc.cedula_aspirante, v_sc.departamento, v_sc.cordinador, v_sc.fecha_solicitud, v_sc.t_contrato, v_sc.categoria, v_sc.dedicacion, v_sc.puesto, v_sc.observacion, v_sc.estado_apro_rh")
            ->from("esq_contrato.v_solicitud_contrato as v_sc")
            ->where(" v_sc.estado_apro_rh",$estado_rh)->where(" v_sc.estado<>'R' ");
        $res= $this->db->get();
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data['data'][]=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return array('data'=>'');
        }
    }

    public function SolicitudRechazadas($id_dpto){
        $this->db->select("v_sc.id_solicitud_contrato, v_sc.id_personal, v_sc.aspirante, v_sc.cedula_aspirante, v_sc.departamento, v_sc.cordinador, v_sc.fecha_solicitud, v_sc.t_contrato, v_sc.categoria, v_sc.dedicacion, v_sc.puesto, v_sc.observacion, v_sc.estado")
            ->from("esq_contrato.v_solicitud_contrato as v_sc")
            ->where("v_sc.id_departamento",$id_dpto)->where(" v_sc.estado='R' ");
        $res= $this->db->get();
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data['data'][]=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return array('data'=>'');
        }
    }
    public function SolicitudRechazadasAll(){
        $this->db->select("v_sc.id_solicitud_contrato, v_sc.id_personal, v_sc.aspirante, v_sc.cedula_aspirante, v_sc.departamento, v_sc.cordinador, v_sc.fecha_solicitud, v_sc.t_contrato, v_sc.categoria, v_sc.dedicacion, v_sc.puesto, v_sc.observacion, v_sc.estado")
            ->from("esq_contrato.v_solicitud_contrato as v_sc")
            ->where(" v_sc.estado='R' ");
        $res= $this->db->get();
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data['data'][]=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return array('data'=>'');
        }
    }

    public function InfoSolicitudRechazada($id_solicitud){
        $this->db->select(" v_ps.idproceso_solicitud, v_ps.proceso, v_ps.usuario, v_ps.fecha, v_ps.hora, v_ps.observacion, v_ps.estado")
            ->from(" esq_contrato.v_proceso_solicitud as v_ps ")
            ->where(" v_ps.id_solicitud ",$id_solicitud)->where(" v_ps.estado='R' ");
        $res= $this->db->get();
        //echo $this->db->last_query();
        return $res->row();
    }

    public function EstadoProcesosSolicitud($id_solicitud){
        $this->db->select(" v_ps.idproceso_solicitud, v_ps.proceso, v_ps.usuario, v_ps.fecha, v_ps.hora, v_ps.observacion, v_ps.estado")
                 ->from("esq_contrato.v_proceso_solicitud v_ps")
                 ->where(" v_ps.id_solicitud ",$id_solicitud)->order_by(" v_ps.idproceso_solicitud");
        $res= $this->db->get();
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