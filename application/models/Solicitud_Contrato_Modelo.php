<?php
/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 9/11/2017
 * Time: 0:17
 */

class Solicitud_Contrato_Modelo extends CI_Model {

    function  __construct(){
        parent::__construct();
    }

    function AnularSolicitud($datos){
       $res=$this->db->query("SELECT opcion, mensaje FROM esq_contrato.fnc_anular_solicitud(?,?,?);",$datos);
        //echo $this->db->last_query();
        return $res->row_array();
    }

    function DatosSolicitud($id_solicitud){
        $this->db->select("solicitud_contrato.id_observacion, solicitud_contrato.id_tipo_solicitud, solicitud_contrato.id_dedicacion, solicitud_contrato.id_puesto")
                 ->from("esq_contrato.solicitud_contrato")
                 ->where("solicitud_contrato.id_solicitud_contrato",$id_solicitud);
        $res=$this->db->get();
        //echo $this->db->last_query();
        return $res->row_array();
    }

    function SaveSolicitud($datos){
        $res=$this->db->query("SELECT  p_opcion, p_mensaje from esq_contrato.fnc_crear_solicitud_contrato(?,?,?,?,?,?,?,?,?);",$datos);
        //echo $this->db->last_query();
        return $res->row_array();
    }

    function UpdateSolicitud($datos){
        $res=$this->db->query("SELECT p_opcion, p_mensaje FROM esq_contrato.fnc_actualiza_solicitud(?,?,?,?,?,?,?); ",$datos);
        //echo $this->db->last_query();
        return $res->row_array();
    }

    function RegistrosSolicitudDpto($dpto){
        $this->db->select("v_sc.id_solicitud_contrato,v_sc.codigo, v_sc.id_personal, v_sc.aspirante, v_sc.cedula_aspirante, v_sc.departamento ,v_sc.fecha_solicitud, v_sc.t_contrato, v_sc.dedicacion, v_sc.puesto, v_sc.observacion,v_sc.estado_apro_rec,v_sc.estado_apro_rh, v_sc.estado")
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

    function SolicitudRector($dpto,$estado_rect){
        $this->db->select("v_sc.id_solicitud_contrato,v_sc.codigo, v_sc.id_personal, v_sc.aspirante, v_sc.cedula_aspirante, v_sc.departamento, v_sc.cordinador, v_sc.fecha_solicitud, v_sc.t_contrato, v_sc.dedicacion, v_sc.puesto, v_sc.observacion, v_sc.estado_apro_rec")
            ->from("esq_contrato.v_solicitud_contrato as v_sc")
            ->where("v_sc.id_departamento",$dpto)->where(" v_sc.estado_apro_rec",$estado_rect)->where(" v_sc.estado<>'R' ")->where(" v_sc.estado<>'E' ");
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

    function SolicitudRectorAll($estado_rect){
        $this->db->select("v_sc.id_solicitud_contrato, v_sc.codigo, v_sc.id_personal, v_sc.aspirante, v_sc.cedula_aspirante, v_sc.departamento, v_sc.cordinador, v_sc.fecha_solicitud, v_sc.t_contrato, v_sc.dedicacion, v_sc.puesto, v_sc.observacion,v_sc.estado_apro_rec")
            ->from("esq_contrato.v_solicitud_contrato as v_sc")
            ->where(" v_sc.estado_apro_rec",$estado_rect)->where(" v_sc.estado<>'R' ")->where(" v_sc.estado<>'E' ");
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

    function SolicitudRecursosHumano($dpto,$estado_rh){
        $this->db->select("v_sc.id_solicitud_contrato, v_sc.codigo, v_sc.id_personal, v_sc.aspirante, v_sc.cedula_aspirante, v_sc.departamento, v_sc.cordinador, v_sc.fecha_solicitud, v_sc.t_contrato,  v_sc.dedicacion, v_sc.puesto, v_sc.observacion, v_sc.estado_apro_rh")
            ->from("esq_contrato.v_solicitud_contrato as v_sc")
            ->where("v_sc.id_departamento",$dpto)->where(" v_sc.estado_apro_rh",$estado_rh)->where(" v_sc.estado_apro_rec='A'")->where(" v_sc.estado<>'R' ")->where(" v_sc.estado<>'E' ");
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

    function SolicitudRecursosHumanoAll($estado_rh){
        $this->db->select("v_sc.id_solicitud_contrato,v_sc.codigo, v_sc.id_personal, v_sc.aspirante, v_sc.cedula_aspirante, v_sc.departamento, v_sc.cordinador, v_sc.fecha_solicitud, v_sc.t_contrato,  v_sc.dedicacion, v_sc.puesto, v_sc.observacion, v_sc.estado_apro_rh")
            ->from("esq_contrato.v_solicitud_contrato as v_sc")
            ->where(" v_sc.estado_apro_rh",$estado_rh)->where(" v_sc.estado_apro_rec='A'")->where(" v_sc.estado<>'R' ")->where(" v_sc.estado<>'E' ");
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

    function SolicitudRechazadas($id_dpto){
        $this->db->select("v_sc.id_solicitud_contrato, v_sc.codigo,v_sc.id_personal, v_sc.aspirante, v_sc.cedula_aspirante, v_sc.departamento, v_sc.cordinador, v_sc.fecha_solicitud, v_sc.t_contrato, v_sc.dedicacion, v_sc.puesto, v_sc.observacion, v_sc.estado")
            ->from("esq_contrato.v_solicitud_contrato as v_sc")
            ->where("v_sc.id_departamento",$id_dpto)->where(" v_sc.estado='R' ")->where(" v_sc.estado<>'E' ");
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

    function SolicitudRechazadasAll(){
        $this->db->select("v_sc.id_solicitud_contrato, v_sc.codigo, v_sc.id_personal, v_sc.aspirante, v_sc.cedula_aspirante, v_sc.departamento, v_sc.cordinador, v_sc.fecha_solicitud, v_sc.t_contrato, v_sc.dedicacion, v_sc.puesto, v_sc.observacion, v_sc.estado")
            ->from("esq_contrato.v_solicitud_contrato as v_sc")
            ->where(" v_sc.estado='R' ")->where(" v_sc.estado<>'E' ");
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

    function SolicitudAceptada($id_dpto){
       $this->db->select("v_sc.id_solicitud_contrato, v_sc.codigo, v_sc.id_personal,v_sc.id_departamento,v_sc.aspirante,v_sc.cedula_aspirante,v_sc.departamento,v_sc.cordinador, v_sc.fecha_solicitud,v_sc.t_contrato,v_sc.dedicacion,  v_sc.puesto,v_sc.observacion")
                ->from(" esq_contrato.v_solicitud_contrato as v_sc ")->where(" v_sc.id_departamento ",$id_dpto)->where(" v_sc.estado_apro_rec='A' ")->where(" v_sc.estado_apro_rh='A' ")->where(" v_sc.estado<>'E' ")
                ->where_not_in('v_sc.id_solicitud_contrato',"SELECT contrato.id_solicitud  FROM  esq_contrato.contrato",false);
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

    function SolicitudAceptadaAll(){
        $this->db->select("v_sc.id_solicitud_contrato, v_sc.codigo, v_sc.id_personal,v_sc.id_departamento,v_sc.aspirante,v_sc.cedula_aspirante,v_sc.departamento,v_sc.cordinador, v_sc.fecha_solicitud,v_sc.t_contrato,v_sc.dedicacion,  v_sc.puesto,v_sc.observacion")
                 ->from(" esq_contrato.v_solicitud_contrato as v_sc ")
                 ->where(" v_sc.estado_apro_rec='A' ")
                 ->where(" v_sc.estado_apro_rh='A' ")
                 ->where(" v_sc.estado<>'E' ")
                 ->where_not_in('v_sc.id_solicitud_contrato',"SELECT contrato.id_solicitud  FROM  esq_contrato.contrato ",false);
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

    function InfoSolicitudRechazada($id_solicitud){
        $this->db->select(" v_ps.idproceso_solicitud, v_ps.proceso, v_ps.usuario, v_ps.fecha, v_ps.hora, v_ps.observacion, v_ps.estado")
            ->from(" esq_contrato.v_proceso_solicitud as v_ps ")
            ->where(" v_ps.id_solicitud ",$id_solicitud)->where(" v_ps.estado='R' ");
        $res= $this->db->get();
        //echo $this->db->last_query();
        return $res->row();
    }

    function EstadoProcesosSolicitud($id_solicitud){
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

    function ObtenerIdContrato($id_solicitud){
          $this->db->select(" contrato.id_contrato ")
                   ->from(" esq_contrato.contrato")
                   ->where(" contrato.id_solicitud ",$id_solicitud);
          $res= $this->db->get();
          //echo $this->db->last_query();
          return $res->row_array();
    }

}