<?php
/**
 * Created by PhpStorm.
 * User: Toshiba
 * Date: 27/05/2018
 * Time: 8:29
 */

class Buscar_Modelo extends CI_Model {
       function __construct(){
           parent::__construct();
       }

        /**
         * @param  $dpto
         * @param  $fecha_desde
         * @param  $fecha_hasta
         * @return array
         */
       function Solicitudes($dpto,$fecha_desde,$fecha_hasta){
           $this->db->select("v_solicitud_contrato.id_solicitud_contrato as id,
                              v_solicitud_contrato.codigo,
                              v_solicitud_contrato.aspirante,
                              v_solicitud_contrato.cedula_aspirante,
                              v_solicitud_contrato.t_contrato as tipo_solicitud,
                              v_solicitud_contrato.observacion,
                              v_solicitud_contrato.fecha_solicitud,
                              v_solicitud_contrato.puesto,
                              v_solicitud_contrato.dedicacion,
                              v_solicitud_contrato.departamento,
                              v_solicitud_contrato.cordinador,
                               v_solicitud_contrato.estado")
                     ->from(" esq_contrato.v_solicitud_contrato ")
                     ->where(" v_solicitud_contrato.id_departamento ",$dpto)
                     ->where(" v_solicitud_contrato.fecha_solicitud BETWEEN '$fecha_desde' AND '$fecha_hasta' ", NULL, FALSE );
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

      /**
       * @param $dpto
       * @return array
       */
       function Solicitudes_dpto($dpto){
        $this->db->select("v_solicitud_contrato.id_solicitud_contrato as id,
                              v_solicitud_contrato.codigo,
                              v_solicitud_contrato.aspirante,
                              v_solicitud_contrato.cedula_aspirante,
                              v_solicitud_contrato.t_contrato as tipo_solicitud,
                              v_solicitud_contrato.observacion,
                              v_solicitud_contrato.fecha_solicitud,
                              v_solicitud_contrato.puesto,
                              v_solicitud_contrato.dedicacion,
                              v_solicitud_contrato.departamento,
                              v_solicitud_contrato.cordinador,
                               v_solicitud_contrato.estado")
            ->from(" esq_contrato.v_solicitud_contrato ")
            ->where(" v_solicitud_contrato.id_departamento ",$dpto);
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

    /**
     * @param $id
     * @return mixed
     */
     function Solicitud($id){
           $this->db->select(" v_solicitud_contrato.codigo,
                               v_solicitud_contrato.aspirante,
                               v_solicitud_contrato.cedula_aspirante,
                               v_solicitud_contrato.t_contrato as tipo_solicitud,
                               v_solicitud_contrato.observacion,
                               v_solicitud_contrato.fecha_solicitud,
                               v_solicitud_contrato.puesto,
                               v_solicitud_contrato.dedicacion,
                               v_solicitud_contrato.departamento,
                               v_solicitud_contrato.cordinador,
                               v_solicitud_contrato.estado")
                    ->from(" esq_contrato.v_solicitud_contrato")
                    ->where(" v_solicitud_contrato.id_solicitud_contrato ",$id);
           $res= $this->db->get();
           return $res->row_array();
     }

    /**
     * @param $id
     * @return mixed
     */
     function Proceso_Solicitud($id){
            $this->db->select("v_proceso_solicitud.codigo,
                               v_proceso_solicitud.proceso,
                               v_proceso_solicitud.usuario,
                               v_proceso_solicitud.fecha,
                               v_proceso_solicitud.hora,
                               v_proceso_solicitud.observacion,
                               v_proceso_solicitud.estado")
                      ->from(" esq_contrato.v_proceso_solicitud ")
                      ->where(" v_proceso_solicitud.id_solicitud ",$id);
           $res= $this->db->get();
           return $res->result_array();
     }

    /**
     * @param $id
     * @param $fecha_desde
     * @param $fecha_hasta
     * @return array
     */
     function Contratos($id,$fecha_desde,$fecha_hasta){
         $this->db->select("v_contrato.id_contrato as id,
                            v_contrato.codigo,
                            v_contrato.codigo_solicitud,
                            v_contrato.aspirante,
                            v_contrato.cedula_aspirante,
                            v_contrato.tipo,
                            v_contrato.modalidad_laboral,
                            v_contrato.regimen_laboral,
                            v_contrato.deominacion,
                            v_contrato.remuneracion,
                            v_contrato.fecha,
                            v_contrato.fecha_inicio,
                            v_contrato.fecha_finaliza,
                            v_contrato.meses,
                            v_contrato.partida,
                            v_contrato.titulo,
                            v_contrato.departamento,
                            v_contrato.codigo_solicitud,
                            v_contrato.estado")
                    ->from(" esq_contrato.v_contrato ")
                    ->where(" v_contrato.id_departamento ",$id)
                    ->where(" v_contrato.fecha BETWEEN '$fecha_desde' AND '$fecha_hasta' ", NULL, FALSE);
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

    /**
     * @param $id
     * @return array
     */
     function Contratos_Dpto($id){
        $this->db->select("v_contrato.id_contrato as id,
                            v_contrato.codigo,
                            v_contrato.codigo_solicitud,
                            v_contrato.aspirante,
                            v_contrato.cedula_aspirante,
                            v_contrato.tipo,
                            v_contrato.modalidad_laboral,
                            v_contrato.regimen_laboral,
                            v_contrato.deominacion,
                            v_contrato.remuneracion,
                            v_contrato.fecha,
                            v_contrato.fecha_inicio,
                            v_contrato.fecha_finaliza,
                            v_contrato.meses,
                            v_contrato.partida,
                            v_contrato.titulo,
                            v_contrato.departamento,
                            v_contrato.codigo_solicitud,
                            v_contrato.estado")
            ->from(" esq_contrato.v_contrato ")
            ->where(" v_contrato.id_departamento ",$id);
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

     function Contrato($id){
         $this->db->select("v_contrato.id_contrato as id,
                            v_contrato.codigo,
                            v_contrato.codigo_solicitud,
                            v_contrato.aspirante,
                            v_contrato.cedula_aspirante,
                            v_contrato.tipo,
                            v_contrato.modalidad_laboral,
                            v_contrato.regimen_laboral,
                            v_contrato.deominacion,
                            v_contrato.remuneracion,
                            v_contrato.fecha,
                            v_contrato.fecha_inicio,
                            v_contrato.fecha_finaliza,
                            v_contrato.meses,
                            v_contrato.partida,
                            v_contrato.titulo,
                            v_contrato.departamento,
                            (select   v_solicitud_contrato.cordinador from esq_contrato.v_solicitud_contrato where v_solicitud_contrato.id_solicitud_contrato = v_contrato.id_solicitud) as coordinador,
                            v_contrato.codigo_solicitud,
                            v_contrato.estado")
             ->from(" esq_contrato.v_contrato ")
             ->where(" v_contrato.id_contrato ",$id);
         $res= $this->db->get();
         //echo $this->db->last_query();
         return $res->row_array();
     }

     function Proceso_Contrato($id){
            $this->db->select(" v_procesos_contrato.proceso,
                                v_procesos_contrato.codigo,
                                v_procesos_contrato.usuario,
                                v_procesos_contrato.fecha,
                                v_procesos_contrato.hora,
                                v_procesos_contrato.observacion,
                                v_procesos_contrato.estado")
                     ->from(" esq_contrato.v_procesos_contrato ")
                     ->where(" v_procesos_contrato.idcontrato ",$id)->order_by("idproceso");
            $res= $this->db->get();
            return $res->result_array();
     }

     function beneficios_Contrato($id){
          $this->db->select(" contrato.partida,
                              contrato.p_510510,
                              contrato.p_510203,
                              contrato.p_510204,
                              contrato.p_510601,
                              contrato.p_510602,
                              contrato.total_masa_salarial")
                     ->from("esq_contrato.contrato")
                     ->where(" contrato.id_contrato ",$id);
          $res= $this->db->get();
          return $res->row_array();
     }

     function Contrato_Anulado($id){
         $this->db->select(" v_contratos_anulados.usuario,
                             v_contratos_anulados.fecha,
                             v_contratos_anulados.hora,
                             v_contratos_anulados.observacion")
                  ->from(" esq_contrato.v_contratos_anulados ")
                  ->where(" v_contratos_anulados.idcontrato ",$id);
         $res= $this->db->get();
         return $res->row_array();
     }


}