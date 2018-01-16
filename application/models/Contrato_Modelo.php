<?php
/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 9/11/2017
 * Time: 0:25
 */

class Contrato_Modelo extends CI_Model {

    function  __construct(){
        parent::__construct();
    }

    function AnularContrato($datos){
       $res=$this->db->query("SELECT  opcion, mensaje  FROM esq_contrato.fnc_anular_contrato(?,?,?);",$datos);
        //echo $this->db->last_query();
        return $res->row_array();
    }

    function SaveContrato($datos){
       $res=$this->db->query('SELECT opcion, mensaje FROM esq_contrato.fnc_crear_contrato(?,?,?,?,?,?,?,?,?,?,?);',$datos);
       //echo $this->db->last_query();
       return $res->row_array();
    }

    function UpdateContrato($datos){
      $res=$this->db->query("SELECT opcion, mensaje  FROM esq_contrato.fnc_actualiza_contrato(?,?,?,?,?,?,?,?);",$datos);
      //echo $this->db->last_query();
      return $res->row_array();
    }

    function ListarContrtos($id_dpto,$estado){
        $this->db->select(" v_contrato.id_contrato, v_contrato.id_personal, v_contrato.codigo, v_contrato.tipo,  v_contrato.modalidad_laboral,  v_contrato.pais, v_contrato.aspirante, v_contrato.cedula_aspirante, v_contrato.regimen_laboral, v_contrato.deominacion, v_contrato.remuneracion, v_contrato.fecha_inicio, v_contrato.fecha_finaliza, v_contrato.partida, v_contrato.titulo, v_contrato.departamento, v_contrato.codigo_solicitud, v_contrato.codigo_solicitud ,v_contrato.estado")
                 ->from(" esq_contrato.v_contrato ")
                 ->where(" v_contrato.id_departamento ",$id_dpto)->where(" v_contrato.estado ",$estado);
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

    function ListarContrtosAll($estado){
        $this->db->select(" v_contrato.id_contrato, v_contrato.id_personal, v_contrato.codigo, v_contrato.tipo,  v_contrato.modalidad_laboral,  v_contrato.pais, v_contrato.aspirante, v_contrato.cedula_aspirante, v_contrato.regimen_laboral, v_contrato.deominacion, v_contrato.remuneracion, v_contrato.fecha_inicio, v_contrato.fecha_finaliza, v_contrato.partida, v_contrato.titulo, v_contrato.departamento, v_contrato.codigo_solicitud, v_contrato.codigo_solicitud ,v_contrato.estado")
            ->from(" esq_contrato.v_contrato ")->where(" v_contrato.estado ",$estado);
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

    function ListarContratos_Jefe_th($id_dpto,$estado){
        $this->db->select("v_contrato.id_contrato, v_contrato.id_personal, v_contrato.codigo,v_contrato.tipo, v_contrato.modalidad_laboral, v_contrato.pais, v_contrato.aspirante, v_contrato.cedula_aspirante, v_contrato.regimen_laboral, v_contrato.deominacion, v_contrato.remuneracion, v_contrato.fecha_inicio, v_contrato.fecha_finaliza, v_contrato.partida, v_contrato.titulo, v_contrato.departamento, v_contrato.codigo_solicitud ")
                 ->from(" esq_contrato.v_contrato ")
                 ->where("v_contrato.id_departamento",$id_dpto)->where("v_contrato.estado_jefe_th",$estado)->where("v_contrato.estado <> 'R'");
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

    function ListarContratos_Jefe_th_All($estado){
        $this->db->select("v_contrato.id_contrato, v_contrato.id_personal, v_contrato.codigo,v_contrato.tipo, v_contrato.modalidad_laboral, v_contrato.pais, v_contrato.aspirante, v_contrato.cedula_aspirante, v_contrato.regimen_laboral, v_contrato.deominacion, v_contrato.remuneracion, v_contrato.fecha_inicio, v_contrato.fecha_finaliza, v_contrato.partida, v_contrato.titulo, v_contrato.departamento, v_contrato.codigo_solicitud ")
            ->from(" esq_contrato.v_contrato ")
            ->where("v_contrato.estado_jefe_th",$estado)->where("v_contrato.estado <> 'R'");
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

    function ListarContratos_fn($id_dpto,$estado){
        $this->db->select("v_contrato.id_contrato, v_contrato.id_personal, v_contrato.codigo,v_contrato.tipo, v_contrato.modalidad_laboral, v_contrato.pais, v_contrato.aspirante, v_contrato.cedula_aspirante, v_contrato.regimen_laboral, v_contrato.deominacion, v_contrato.remuneracion, v_contrato.fecha_inicio, v_contrato.fecha_finaliza, v_contrato.meses , v_contrato.partida, v_contrato.departamento, v_contrato.codigo_solicitud, v_contrato.p_510510, v_contrato.p_510203, v_contrato.p_510204, v_contrato.p_510601,  v_contrato.p_510602, v_contrato.total_masa_salarial")
            ->from(" esq_contrato.v_contrato ")
            ->where("v_contrato.id_departamento",$id_dpto)->where("v_contrato.estado_jefe_th='A'")->where("v_contrato.estado_financiero",$estado)->where("v_contrato.estado <> 'R'");
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

    function ListarContratos_fn_All($estado){
        $this->db->select("v_contrato.id_contrato, v_contrato.id_personal, v_contrato.codigo,v_contrato.tipo, v_contrato.modalidad_laboral, v_contrato.pais, v_contrato.aspirante, v_contrato.cedula_aspirante, v_contrato.regimen_laboral, v_contrato.deominacion, v_contrato.remuneracion, v_contrato.fecha_inicio, v_contrato.fecha_finaliza,  v_contrato.meses , v_contrato.partida, v_contrato.departamento, v_contrato.codigo_solicitud, v_contrato.p_510510, v_contrato.p_510203, v_contrato.p_510204, v_contrato.p_510601,  v_contrato.p_510602, v_contrato.total_masa_salarial")
            ->from(" esq_contrato.v_contrato ")
            ->where("v_contrato.estado_jefe_th='A'")->where("v_contrato.estado_financiero",$estado)->where("v_contrato.estado <> 'R'");
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

    function ListarContratos_rct($id_dpto,$estado){
        $this->db->select("v_contrato.id_contrato, v_contrato.id_personal, v_contrato.codigo,v_contrato.tipo, v_contrato.modalidad_laboral, v_contrato.pais, v_contrato.aspirante, v_contrato.cedula_aspirante, v_contrato.regimen_laboral, v_contrato.deominacion, v_contrato.remuneracion, v_contrato.fecha_inicio, v_contrato.fecha_finaliza, v_contrato.partida, v_contrato.titulo, v_contrato.departamento, v_contrato.codigo_solicitud ")
            ->from(" esq_contrato.v_contrato ")
            ->where("v_contrato.id_departamento",$id_dpto)->where("v_contrato.estado_financiero = 'A'")->where("v_contrato.estado_rector",$estado)->where("v_contrato.estado <> 'R'");
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

    function ListarContratos_rct_All($estado){
        $this->db->select("v_contrato.id_contrato, v_contrato.id_personal, v_contrato.codigo,v_contrato.tipo, v_contrato.modalidad_laboral, v_contrato.pais, v_contrato.aspirante, v_contrato.cedula_aspirante, v_contrato.regimen_laboral, v_contrato.deominacion, v_contrato.remuneracion, v_contrato.fecha_inicio, v_contrato.fecha_finaliza, v_contrato.partida, v_contrato.titulo, v_contrato.departamento, v_contrato.codigo_solicitud ")
                 ->from(" esq_contrato.v_contrato ")
                 ->where("v_contrato.estado_financiero = 'A'")
                 ->where("v_contrato.estado_rector",$estado)
                 ->where("v_contrato.estado <> 'R'");
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

    function ListarContratos_redz($id_dpto,$p_estado,$estado){
        $this->db->select("v_contrato.id_contrato, v_contrato.id_personal, v_contrato.codigo,v_contrato.tipo, v_contrato.modalidad_laboral, v_contrato.pais, v_contrato.aspirante, v_contrato.cedula_aspirante, v_contrato.regimen_laboral, v_contrato.deominacion, v_contrato.remuneracion, v_contrato.fecha_inicio, v_contrato.fecha_finaliza,v_contrato.meses, v_contrato.partida, v_contrato.titulo, v_contrato.departamento, v_contrato.codigo_solicitud, v_contrato.p_510510, v_contrato.p_510203, v_contrato.p_510204, v_contrato.p_510601,  v_contrato.p_510602, v_contrato.total_masa_salarial ")
                 ->from(" esq_contrato.v_contrato ")
                 ->where("v_contrato.id_departamento",$id_dpto)
                 ->where($p_estado,$estado);
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

    function ListarContratos_redz_All($p_estado,$estado){
        $this->db->select("v_contrato.id_contrato, v_contrato.id_personal, v_contrato.codigo,v_contrato.tipo, v_contrato.modalidad_laboral, v_contrato.pais, v_contrato.aspirante, v_contrato.cedula_aspirante, v_contrato.regimen_laboral, v_contrato.deominacion, v_contrato.remuneracion, v_contrato.fecha_inicio, v_contrato.fecha_finaliza,v_contrato.meses, v_contrato.partida, v_contrato.titulo, v_contrato.departamento, v_contrato.codigo_solicitud, v_contrato.p_510510, v_contrato.p_510203, v_contrato.p_510204, v_contrato.p_510601,  v_contrato.p_510602, v_contrato.total_masa_salarial ")
            ->from(" esq_contrato.v_contrato ")
            ->where($p_estado,$estado);
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

    function ProcesosContrato($id_contrato){
        $this->db->select(" v_procesos_contrato.idproceso, v_procesos_contrato.proceso, v_procesos_contrato.usuario, v_procesos_contrato.fecha, v_procesos_contrato.hora, v_procesos_contrato.observacion, v_procesos_contrato.estado ")
                 ->from(" esq_contrato.v_procesos_contrato ")
                 ->where(" v_procesos_contrato.idcontrato",$id_contrato)->order_by('v_procesos_contrato.idproceso');
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

    function EditarContrato($id_contrato){
        $this->db->select("v_solicitud_contrato.id_personal, v_solicitud_contrato.id_solicitud_contrato, v_solicitud_contrato.id_departamento, v_solicitud_contrato.t_contrato, v_solicitud_contrato.departamento, v_solicitud_contrato.observacion, v_solicitud_contrato.cedula_aspirante, v_solicitud_contrato.aspirante, v_solicitud_contrato.dedicacion, v_solicitud_contrato.puesto, contrato.id_titulo_profesional, contrato.id_regimen_laboral, contrato.fecha_inicio, contrato.fecha_finaliza, contrato.id_tipo_denominacion ")
                 ->from("esq_contrato.v_solicitud_contrato ")
                 ->join(" esq_contrato.contrato "," contrato.id_solicitud=id_solicitud_contrato ")
                 ->where("contrato.id_contrato ",$id_contrato);
        $res= $this->db->get();
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return array('data'=>'');
        }
    }

    function DenominacionDocente($id){
        $this->db->select("  denominacion_docente.id_categoria_docente, denominacion_docente.id_nivel_docente, denominacion_docente.id_dedicacion_docente ")
                 ->from(" esq_contrato.denominacion_docente ")
                 ->where(" denominacion_docente.id_denominacion_docente ",$id);
        $res= $this->db->get();
        //echo $this->db->last_query();
        return $res->row_array();
    }

    function DenominacionAdmin($id){
        $this->db->select(" denominacion_administrativo.id_grupo_ocupacional, denominacion_administrativo.id_puesto ")
                 ->from(" esq_contrato.denominacion_administrativo ")
                 ->where("denominacion_administrativo.id_denominacion_admin ",$id);
        $res= $this->db->get();
        //echo $this->db->last_query();
        return $res->row_array();
    }

    function Remuneracion_Docente($categoria, $nivel, $dedicacion){
        $this->db->select(" denominacion_docente.id_denominacion_docente, denominacion_docente.rmu ")
            ->from(" esq_contrato.denominacion_docente ")
            ->where("denominacion_docente.id_categoria_docente ",$categoria)
            ->where(" denominacion_docente.id_nivel_docente ",$nivel)
            ->where(" denominacion_docente.id_dedicacion_docente", $dedicacion)->order_by(" id_denominacion_docente");
        $res = $this->db->get();
        return $res->row();
    }

    function ListaRemuneracionAdmin($gp_ocupacion,$ocupacion){
        $this->db->select(" d_admin.id_denominacion_admin, d_admin.rmu ")
            ->from(" esq_contrato.denominacion_administrativo as d_admin ")
            ->where(" d_admin.id_grupo_ocupacional ",$gp_ocupacion)->where(" d_admin.id_puesto ",$ocupacion);
        $res = $this->db->get();
        return $res->row();
    }

    function AprobarProceso($datos){
        $res=$this->db->query('SELECT opcion, mensaje FROM  esq_contrato.fnc_aprobar_proceso_contrato(?,?,?);',$datos);
        //echo $this->db->last_query();
        return $res->row_array();
    }

    function RechazarProceso($datos){
        $res=$this->db->query("SELECT opcion, mensaje  FROM esq_contrato.fnc_rechazar_proceso_contrato(?,?,?,?);",$datos);
        //echo $this->db->last_query();
        return $res->row_array();
    }

    function AgregarItem($id_contrato,$partida){
        $this->db->set('partida',$partida, FALSE);
        $this->db->where('contrato.id_contrato',$id_contrato);
        $this->db->update('esq_contrato.contrato');
        //echo $this->db->last_query();
        if($this->db->affected_rows()>0){
            return 1;
        }else{
            return 2;
        }
    }

}