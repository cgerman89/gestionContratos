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
       $res=$this->db->query('SELECT opcion, mensaje FROM esq_contrato.fnc_crear_contrato(?,?,?,?,?,?,?,?,?,?,?,?);',$datos);
       //echo $this->db->last_query();
       return $res->row_array();
    }

    function UpdateContrato($datos){
      $res=$this->db->query("SELECT opcion, mensaje  FROM esq_contrato.fnc_actualiza_contrato(?,?,?,?,?,?,?,?);",$datos);
      //echo $this->db->last_query();
      return $res->row_array();
    }

    function UpdateBeneficios($datos,$id_ctr){
        $this->db->where("contrato.id_contrato ", $id_ctr);
        $this->db->update(" esq_contrato.contrato ",$datos);
        //echo $this->db->last_query();
        return $this->db->affected_rows();
    }

    function InfoAnulada($id_ctr){
        $this->db->select("contrato_anulado.idanulado,
                           ( SELECT concat(personal.apellido1, ' ', personal.apellido2, ' ', personal.nombres) AS concat   FROM esq_datos_personales.personal      WHERE (personal.idpersonal = contrato_anulado.id_personal)) AS persona, 
                           contrato_anulado.fecha,
                           contrato_anulado.hora,
                           contrato_anulado.observacion")
                    ->from(" esq_contrato.contrato_anulado ")
                    ->where(" contrato_anulado.idcontrato ",$id_ctr);
        $res= $this->db->get();
        //echo $this->db->last_query();
        return $res->row_array();
    }

    function ListarContrtos($id_dpto,$campo,$estado){
        $this->db->select("  v_contrato.id_contrato,
                             v_contrato.id_personal,
                             v_contrato.codigo,
                             v_contrato.tipo,
                             v_contrato.modalidad_laboral,
                             v_contrato.pais,
                             v_contrato.aspirante,
                             v_contrato.cedula_aspirante,
                             v_contrato.regimen_laboral,
                             v_contrato.deominacion,
                             v_contrato.titulo,
                             v_contrato.departamento,
                             v_contrato.codigo_solicitud,
                             v_contrato.remuneracion,
                             v_contrato.fecha_inicio,
                             v_contrato.fecha_finaliza,
                             v_contrato.meses,
                             contrato.partida,
                             contrato.p_510510,
                             contrato.p_510203,
                             contrato.p_510204,
                             contrato.p_510601,
                             contrato.p_510602,
                             contrato.total_masa_salarial,
                             v_contrato.estado")
                 ->from(" esq_contrato.v_contrato ")
                 ->join(" esq_contrato.contrato ", " contrato.id_contrato=v_contrato.id_contrato ")
                 ->where(" v_contrato.id_departamento ",$id_dpto)->where($campo,$estado)->where(" v_contrato.estado <> 'R' ");
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

    function ListarContrtosAll($campo,$estado){
        $this->db->select("v_contrato.id_contrato,
                             v_contrato.id_personal,
                             v_contrato.codigo,
                             v_contrato.tipo,
                             v_contrato.modalidad_laboral,
                             v_contrato.pais,
                             v_contrato.aspirante,
                             v_contrato.cedula_aspirante,
                             v_contrato.regimen_laboral,
                             v_contrato.deominacion,
                             v_contrato.titulo,
                             v_contrato.departamento,
                             v_contrato.codigo_solicitud,
                             v_contrato.remuneracion,
                             v_contrato.fecha_inicio,
                             v_contrato.fecha_finaliza,
                             v_contrato.meses,
                             contrato.partida,
                             contrato.p_510510,
                             contrato.p_510203,
                             contrato.p_510204,
                             contrato.p_510601,
                             contrato.p_510602,
                             contrato.total_masa_salarial,
                             v_contrato.estado")
                 ->from(" esq_contrato.v_contrato ")
                 ->join(" esq_contrato.contrato ", " contrato.id_contrato=v_contrato.id_contrato ")
                 ->where($campo,$estado)->where(" v_contrato.estado <> 'R' ");
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
        $this->db->select("v_contrato.id_contrato, 
                           v_contrato.id_personal, 
                           v_contrato.codigo,
                           v_contrato.tipo, 
                           v_contrato.modalidad_laboral, 
                           v_contrato.pais, 
                           v_contrato.aspirante, 
                           v_contrato.cedula_aspirante, 
                           v_contrato.regimen_laboral, 
                           v_contrato.deominacion, 
                           v_contrato.remuneracion, 
                           v_contrato.fecha_inicio, 
                           v_contrato.fecha_finaliza, 
                           v_contrato.partida, 
                           v_contrato.titulo, 
                           v_contrato.departamento, 
                           v_contrato.codigo_solicitud")
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
        $this->db->select("v_contrato.id_contrato, 
                           v_contrato.id_personal, 
                           v_contrato.codigo,
                           v_contrato.tipo, 
                           v_contrato.modalidad_laboral, 
                           v_contrato.pais, 
                           v_contrato.aspirante, 
                           v_contrato.cedula_aspirante, 
                           v_contrato.regimen_laboral, 
                           v_contrato.deominacion, 
                           v_contrato.remuneracion, 
                           v_contrato.fecha_inicio, 
                           v_contrato.fecha_finaliza, 
                           v_contrato.partida, 
                           v_contrato.titulo, 
                           v_contrato.departamento, 
                           v_contrato.codigo_solicitud")
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
        $this->db->select("v_contrato.id_contrato,
                          v_contrato.id_personal,
                          v_contrato.codigo,
                          v_contrato.tipo,
                          v_contrato.modalidad_laboral,
                          v_contrato.pais,
                          v_contrato.aspirante,
                          v_contrato.cedula_aspirante,
                          v_contrato.regimen_laboral,
                          v_contrato.deominacion,
                          v_contrato.departamento,
                          v_contrato.codigo_solicitud,
                          v_contrato.remuneracion,
                          v_contrato.fecha_inicio,
                          v_contrato.fecha_finaliza,
                          v_contrato.meses,
                          v_contrato.partida,
                          v_contrato_beneficios.p_510510,
                          v_contrato_beneficios.p_510203,
                          v_contrato_beneficios.p_510204,
                          v_contrato_beneficios.p_510601,
                          v_contrato_beneficios.p_510602,
                          v_contrato_beneficios.total_masa_salarial")
            ->from(" esq_contrato.v_contrato ")
            ->join(" esq_contrato.v_contrato_beneficios ", " v_contrato_beneficios.id_contrato=v_contrato.id_contrato ")
            ->where("v_contrato.id_departamento",$id_dpto)->where("v_contrato.estado_jefe_th='A'")->where("v_contrato.estado_financiero",$estado);
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
        $this->db->select("v_contrato.id_contrato,
                          v_contrato.id_personal,
                          v_contrato.codigo,
                          v_contrato.tipo,
                          v_contrato.modalidad_laboral,
                          v_contrato.pais,
                          v_contrato.aspirante,
                          v_contrato.cedula_aspirante,
                          v_contrato.regimen_laboral,
                          v_contrato.deominacion,
                          v_contrato.departamento,
                          v_contrato.codigo_solicitud,
                          v_contrato.remuneracion,
                          v_contrato.fecha_inicio,
                          v_contrato.fecha_finaliza,
                          v_contrato.meses,
                          v_contrato.partida,
                          v_contrato_beneficios.p_510510,
                          v_contrato_beneficios.p_510203,
                          v_contrato_beneficios.p_510204,
                          v_contrato_beneficios.p_510601,
                          v_contrato_beneficios.p_510602,
                          v_contrato_beneficios.total_masa_salarial")
            ->from(" esq_contrato.v_contrato ")
            ->join(" esq_contrato.v_contrato_beneficios ", " v_contrato_beneficios.id_contrato=v_contrato.id_contrato ")
            ->where("v_contrato.estado_jefe_th='A'")->where("v_contrato.estado_financiero",$estado);
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

    function ListarContratos_imprimir($id_dpto,$estado){
        $this->db->select("  v_contrato.id_contrato,
                             v_contrato.id_personal,
                             v_contrato.codigo,
                             v_contrato.tipo,
                             v_contrato.modalidad_laboral,
                             v_contrato.pais,
                             v_contrato.aspirante,
                             v_contrato.cedula_aspirante,
                             v_contrato.regimen_laboral,
                             v_contrato.deominacion,
                             v_contrato.titulo,
                             v_contrato.departamento,
                             v_contrato.codigo_solicitud,
                             v_contrato.remuneracion,
                             v_contrato.fecha_inicio,
                             v_contrato.fecha_finaliza,
                             v_contrato.meses,
                             v_contrato.estado")
            ->from(" esq_contrato.v_contrato ")
            ->where("v_contrato.id_departamento",$id_dpto)->where("v_contrato.estado_financiero = 'A'")->where("v_contrato.estado_impreso",$estado)->where("v_contrato.estado <> 'R'");
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

    function ListarContratos_imprimir_All($estado){
        $this->db->select("  v_contrato.id_contrato,
                             v_contrato.id_personal,
                             v_contrato.codigo,
                             v_contrato.tipo,
                             v_contrato.modalidad_laboral,
                             v_contrato.pais,
                             v_contrato.aspirante,
                             v_contrato.cedula_aspirante,
                             v_contrato.regimen_laboral,
                             v_contrato.deominacion,
                             v_contrato.titulo,
                             v_contrato.departamento,
                             v_contrato.codigo_solicitud,
                             v_contrato.remuneracion,
                             v_contrato.fecha_inicio,
                             v_contrato.fecha_finaliza,
                             v_contrato.meses,
                             v_contrato.estado")
                 ->from(" esq_contrato.v_contrato ")
                 ->where("v_contrato.estado_financiero = 'A'")->where("v_contrato.estado_impreso",$estado)->where("v_contrato.estado <> 'R'");
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

    function ListarContratos_firma($id_dpto,$estado){
        $this->db->select("  v_contrato.id_contrato,
                             v_contrato.id_personal,
                             v_contrato.codigo,
                             v_contrato.tipo,
                             v_contrato.modalidad_laboral,
                             v_contrato.pais,
                             v_contrato.aspirante,
                             v_contrato.cedula_aspirante,
                             v_contrato.regimen_laboral,
                             v_contrato.deominacion,
                             v_contrato.titulo,
                             v_contrato.departamento,
                             v_contrato.codigo_solicitud,
                             v_contrato.remuneracion,
                             v_contrato.fecha_inicio,
                             v_contrato.fecha_finaliza,
                             v_contrato.meses,
                             v_contrato.estado")
            ->from(" esq_contrato.v_contrato ")
            ->where("v_contrato.id_departamento",$id_dpto)->where("v_contrato.estado_impreso = 'A'")->where("v_contrato.estado_firma",$estado)->where("v_contrato.estado <> 'R'");
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

    function ListarContratos_firma_All($estado){
        $this->db->select("  v_contrato.id_contrato,
                             v_contrato.id_personal,
                             v_contrato.codigo,
                             v_contrato.tipo,
                             v_contrato.modalidad_laboral,
                             v_contrato.pais,
                             v_contrato.aspirante,
                             v_contrato.cedula_aspirante,
                             v_contrato.regimen_laboral,
                             v_contrato.deominacion,
                             v_contrato.titulo,
                             v_contrato.departamento,
                             v_contrato.codigo_solicitud,
                             v_contrato.remuneracion,
                             v_contrato.fecha_inicio,
                             v_contrato.fecha_finaliza,
                             v_contrato.meses,
                             v_contrato.estado")
            ->from(" esq_contrato.v_contrato ")
            ->where("v_contrato.estado_impreso = 'A'")->where("v_contrato.estado_firma",$estado)->where("v_contrato.estado <> 'R'");
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
        $this->db->select("v_contrato.id_contrato, 
                           v_contrato.id_personal, 
                           v_contrato.codigo,
                           v_contrato.tipo, 
                           v_contrato.modalidad_laboral, 
                           v_contrato.pais, 
                           v_contrato.aspirante, 
                           v_contrato.cedula_aspirante, 
                           v_contrato.regimen_laboral, 
                           v_contrato.deominacion, 
                           v_contrato.remuneracion, 
                           v_contrato.fecha_inicio, 
                           v_contrato.fecha_finaliza,
                           v_contrato.meses,                             
                           v_contrato.titulo, 
                           v_contrato.departamento, 
                           v_contrato.codigo_solicitud,
                           v_contrato_beneficios.p_510510,
                           v_contrato_beneficios.p_510203,
                           v_contrato_beneficios.p_510204,
                           v_contrato_beneficios.p_510601,
                           v_contrato_beneficios.p_510602,
                           v_contrato_beneficios.total_masa_salarial")
                 ->from(" esq_contrato.v_contrato ")
                 ->join(" esq_contrato.v_contrato_beneficios ", " v_contrato_beneficios.id_contrato=v_contrato.id_contrato ")
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
        $this->db->select("v_contrato.id_contrato, 
                           v_contrato.id_personal, 
                           v_contrato.codigo,
                           v_contrato.tipo, 
                           v_contrato.modalidad_laboral, 
                           v_contrato.pais, 
                           v_contrato.aspirante, 
                           v_contrato.cedula_aspirante, 
                           v_contrato.regimen_laboral, 
                           v_contrato.deominacion, 
                           v_contrato.remuneracion, 
                           v_contrato.fecha_inicio, 
                           v_contrato.fecha_finaliza,
                           v_contrato.meses,                           
                           v_contrato.titulo, 
                           v_contrato.departamento, 
                           v_contrato.codigo_solicitud,
                           v_contrato_beneficios.p_510510,
                           v_contrato_beneficios.p_510203,
                           v_contrato_beneficios.p_510204,
                           v_contrato_beneficios.p_510601,
                           v_contrato_beneficios.p_510602,
                           v_contrato_beneficios.total_masa_salarial")
            ->from(" esq_contrato.v_contrato ")
            ->join(" esq_contrato.v_contrato_beneficios ", " v_contrato_beneficios.id_contrato=v_contrato.id_contrato ")
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

    function ListaContratosAnulados($id_ctr){
        $this->db->select("   v_contrato.id_contrato,
                              v_contrato.id_personal,
                              v_contrato.codigo,
                              v_contrato.tipo,
                              v_contrato.modalidad_laboral,
                              v_contrato.pais,
                              v_contrato.aspirante,
                              v_contrato.cedula_aspirante,
                              v_contrato.regimen_laboral,
                              v_contrato.deominacion,
                              v_contrato.titulo,
                              v_contrato.departamento,
                              v_contrato.codigo_solicitud,
                              v_contrato.remuneracion,
                              v_contrato.fecha_inicio,
                              v_contrato.fecha_finaliza,
                              v_contrato.meses,
                              v_contrato.estado")
                  ->from(" esq_contrato.v_contrato ")
                  ->join(" esq_contrato.contrato_anulado "," idcontrato=id_contrato ")
                  ->where(" v_contrato.id_departamento ",$id_ctr);
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

    function ListaContratosAnuladosAll(){
        $this->db->select("   v_contrato.id_contrato,
                              v_contrato.id_personal,
                              v_contrato.codigo,
                              v_contrato.tipo,
                              v_contrato.modalidad_laboral,
                              v_contrato.pais,
                              v_contrato.aspirante,
                              v_contrato.cedula_aspirante,
                              v_contrato.regimen_laboral,
                              v_contrato.deominacion,
                              v_contrato.titulo,
                              v_contrato.departamento,
                              v_contrato.codigo_solicitud,
                              v_contrato.remuneracion,
                              v_contrato.fecha_inicio,
                              v_contrato.fecha_finaliza,
                              v_contrato.meses,
                              v_contrato.estado")
            ->from(" esq_contrato.v_contrato ")
            ->join(" esq_contrato.contrato_anulado "," idcontrato=id_contrato ");
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
        $this->db->select(" v_procesos_contrato.idproceso, v_procesos_contrato.codigo ,v_procesos_contrato.proceso, v_procesos_contrato.usuario, v_procesos_contrato.fecha, v_procesos_contrato.hora, v_procesos_contrato.observacion, v_procesos_contrato.estado ")
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
        $res=$this->db->query('SELECT opcion, mensaje FROM  esq_contrato.fnc_aprobar_proceso_contrato(?,?,?,?,?);',$datos);
        //echo $this->db->last_query();
        return $res->row_array();
    }

    function RechazarProceso($datos){
        $res=$this->db->query("SELECT opcion, mensaje  FROM esq_contrato.fnc_rechazar_proceso_contrato(?,?,?,?,?,?);",$datos);
        //echo $this->db->last_query();
        return $res->row_array();
    }

    function DatosTextoContrato($id_contrato){
        $this->db->db_set_charset('UTF-8');
        $this->db->select(" contrato.codigo, 
                            contrato.id_tipo,
                            contrato.id_tipo_denominacion,
                            (SELECT concat(personal.apellido1, ' ', personal.apellido2, ' ', personal.nombres) AS concat FROM esq_datos_personales.personal  WHERE personal.idpersonal = contrato.id_personal) AS aspirante,
                            (SELECT personal.cedula FROM esq_datos_personales.personal WHERE personal.idpersonal = contrato.id_personal) AS cedula_aspirante,
                            (SELECT departamento.nombre  FROM esq_distributivos.departamento WHERE departamento.iddepartamento=contrato.id_departamento) as departamento,
                            (SELECT concat(personal.nombres,' ',personal.apellido1,' ',personal.apellido2) FROM esq_datos_personales.personal, esq_contrato.solicitud_contrato WHERE personal.idpersonal=solicitud_contrato.id_cordinador AND solicitud_contrato.id_solicitud_contrato=contrato.id_solicitud) as cordinador,
                            (SELECT  f_profecional.titulo_obtenido FROM esq_datos_personales.p_formacion_profesional as f_profecional WHERE f_profecional.idformacion_profesional=contrato.id_titulo_profesional) as titulo,
                            contrato.fecha_inicio,
                            contrato.fecha_finaliza,
                            (SELECT solicitud_contrato.codigo  FROM esq_contrato.solicitud_contrato WHERE solicitud_contrato.id_solicitud_contrato=contrato.id_solicitud) as codigo_solicitud,
                            (SELECT solicitud_contrato.fecha_solicitud  FROM esq_contrato.solicitud_contrato WHERE solicitud_contrato.id_solicitud_contrato=contrato.id_solicitud) as fecha_solicitud,
                            (SELECT esq_contrato.fnc_obtiene_denominacion((SELECT tipo.nombre FROM  esq_contrato.tipo WHERE tipo.idtipo=contrato.id_tipo),contrato.id_tipo_denominacion)) as denominacion,
                            (SELECT p_rmu FROM esq_contrato.fnc_obtiene_denominacion_2((SELECT tipo.nombre FROM  esq_contrato.tipo WHERE tipo.idtipo=contrato.id_tipo),contrato.id_tipo_denominacion)),
                            (SELECT p_rmu_letra FROM esq_contrato.fnc_obtiene_denominacion_2((SELECT tipo.nombre FROM  esq_contrato.tipo WHERE tipo.idtipo=contrato.id_tipo),contrato.id_tipo_denominacion)),
                            (SELECT p_horas FROM esq_contrato.fnc_obtiene_denominacion_2((SELECT tipo.nombre FROM  esq_contrato.tipo WHERE tipo.idtipo=contrato.id_tipo),contrato.id_tipo_denominacion)),
                            (SELECT p_abrevia FROM esq_contrato.fnc_obtiene_denominacion_2((SELECT tipo.nombre FROM  esq_contrato.tipo WHERE tipo.idtipo=contrato.id_tipo),contrato.id_tipo_denominacion))")
                    ->from(" esq_contrato.contrato ")
                    ->where(" contrato.id_contrato ",$id_contrato)->where(" contrato.estado <> 'R' ");
        $res = $this->db->get();
        //echo $this->db->last_query();
        return $res->result_array();
    }

    function DeshacerProceso($datos){
         $res=$this->db->query("SELECT  esq_contrato.fnc_deshacer_proceso_contrato(?,?);",$datos);
         //echo $this->db->last_query();
         return $res->row_array();
    }

    function SavePdf($data){
        $res= $this->db->query(" SELECT  p_opcion, p_mensaje, p_id_fichero  From  esq_contrato.fnc_subir_contrato_pdf(?,?,?,?,?,?,?); ",$data);
        //echo $this->db->last_query();
        return $res->row_array();
    }

    function DeletePdf($id_ctr){
        $this->db->where(" fichero_contrato.id_contrato ",$id_ctr)->delete("esq_contrato.fichero_contrato");
        //echo $this->db->last_query();
        return $this->db->affected_rows();
    }

    function GetPdf($id_ctr){
        $this->db->select(" fichero_contrato.nombre, 
                            COALESCE(fichero_contrato.archivo_bin, '-1') as archivo_bytea, 
                            fichero_contrato.archivo_mime, 
                            fichero_contrato.archivo_tamanio")->from(" esq_contrato.fichero_contrato ")->where("id_contrato",$id_ctr);
        $res = $this->db->get();
        //echo $this->db->last_query();
        return $res->row_array();

    }

    function Graficos($id_dpto){
        $this->db->select("(SELECT  count(*)  FROM esq_contrato.contrato WHERE id_departamento=ctr.id_departamento AND id_tipo=1) as docente,
                           (SELECT  count(*)  FROM esq_contrato.contrato WHERE id_departamento=ctr.id_departamento AND id_tipo=1 AND contrato.estado='A') as apb_docente,
                           (SELECT  count(*)  FROM esq_contrato.contrato WHERE id_departamento=ctr.id_departamento AND id_tipo=1 AND contrato.estado='P') as p_docente,
                           (SELECT  count(*)  FROM esq_contrato.contrato WHERE id_departamento=ctr.id_departamento AND id_tipo=1 AND contrato.estado='R') as rdz_docente,
                           (SELECT  count(*)  FROM esq_contrato.contrato WHERE id_departamento=ctr.id_departamento AND id_tipo=1 AND contrato.estado='E') as anu_docente,
                           (SELECT  count(*)  FROM esq_contrato.contrato WHERE id_departamento=ctr.id_departamento AND id_tipo=1 AND contrato.estado='T') as t_docente,
                            
                           (SELECT  count(*)  FROM esq_contrato.contrato WHERE id_departamento=ctr.id_departamento AND id_tipo=2) as admin,
                           (SELECT  count(*)  FROM esq_contrato.contrato WHERE id_departamento=ctr.id_departamento AND id_tipo=2 AND contrato.estado='A') as apb_admin,
                           (SELECT  count(*)  FROM esq_contrato.contrato WHERE id_departamento=ctr.id_departamento AND id_tipo=2 AND contrato.estado='P') as p_admin,
                           (SELECT  count(*)  FROM esq_contrato.contrato WHERE id_departamento=ctr.id_departamento AND id_tipo=2 AND contrato.estado='R') as rzd_admin,
                           (SELECT  count(*)  FROM esq_contrato.contrato WHERE id_departamento=ctr.id_departamento AND id_tipo=2 AND contrato.estado='E') as anu_admin,
                           (SELECT  count(*)  FROM esq_contrato.contrato WHERE id_departamento=ctr.id_departamento AND id_tipo=2 AND contrato.estado='T') as t_admin,
                           count(id_contrato) AS total")
                 ->from(" esq_contrato.contrato as ctr ")
                 ->where(" ctr.id_departamento ",$id_dpto)->group_by("id_departamento");
        $res= $this->db->get();
        //echo $this->db->last_query();
        return $res->row_array();
    }

    function GraficosAll(){
     $this->db->select(" v_ctr.departamento,
                         (SELECT count(*) FROM esq_contrato.v_contrato  WHERE v_contrato.id_departamento=v_ctr.id_departamento AND v_contrato.tipo='DOCENTE' AND (v_contrato.estado='A' OR v_contrato.estado='T') ) as docente,
                         (SELECT count(*) FROM esq_contrato.v_contrato  WHERE v_contrato.id_departamento=v_ctr.id_departamento AND v_contrato.tipo='ADMINISTRATIVO' AND (v_contrato.estado='A' OR v_contrato.estado='T' )) as administrativo ")
              ->from(" esq_contrato.v_contrato as v_ctr ")
              ->where(" (v_ctr.estado='A' OR v_ctr.estado='T') ")
              ->group_by(" id_departamento,departamento ");
     $res= $this->db->get();
     //echo $this->db->last_query();
     return $res->result_array();
    }

}