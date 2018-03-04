<?php
/**
 * Created by PhpStorm.
 * User: Toshiba
 * Date: 30/1/2018
 * Time: 21:00
 */

class Texto_Modelo extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function Save($data){
        $this->db->db_set_charset('UTF-8');
        $this->db->select(" count(texto_contrato.id_texto) as regis ")->from(" esq_contrato.texto_contrato ")->where(" id_tipo ",$data['id_tipo'])->where(" id_denominacion ",$data['id_denominacion']);
        $count=$this->db->get();
        if ($count->result_array()[0]['regis'] == 0) {
            $this->db->insert('esq_contrato.texto_contrato', $data);
            return $this->db->affected_rows();
        }else {
            return 2;
        }
    }

    function Update($id,$data){
        $this->db->db_set_charset('UTF-8');
        $this->db->where(" texto_contrato.id_texto ",$id);
        $this->db->update(" esq_contrato.texto_contrato ",$data);
        //echo $this->db->last_query();
        return $this->db->affected_rows();
    }

    function Delete($id_texto){
        $this->db->where(" texto_contrato.id_texto ", $id_texto)->delete(" esq_contrato.texto_contrato ");
        return $this->db->affected_rows();
    }

    function MaxId(){
        $this->db->select("  coalesce(max(texto_contrato.id_texto),0) + 1 as id ")
                 ->from(" esq_contrato.texto_contrato ");
        $res= $this->db->get();
        return $res->row_array();
    }

    function DenominacionDocente(){
        $this->db->select(" v_denominacion_docente.id_denominacion_docente as id, concat(v_denominacion_docente.categoria,' -  NIVEL: ',v_denominacion_docente.nivel,' - DEDICACION: ',v_denominacion_docente.dedicacion) as denominacion ")
                 ->from(" esq_contrato.v_denominacion_docente ")->order_by(" id ");
        $res= $this->db->get();
        //echo $this->db->last_query();
        return $res->result_array();
    }

    function DenominacionAdministrativo(){
        $this->db->db_set_charset('UTF-8');
        $this->db->select(" v_denominacion_admin.id_denominacion_admin as id, concat(v_denominacion_admin.gp_ocupacional,' - ',v_denominacion_admin.puesto) as denominacion")
                 ->from(" esq_contrato.v_denominacion_admin ")->order_by(" id ");
        $res = $this->db->get();
        //echo $this->db->last_query();
        return $res->result_array();
    }

    function GetTexto($id_tipo,$id_denominacion){
        $this->db->select(" texto_contrato.id_texto,  texto_contrato.texto ")
                 ->from(" esq_contrato.texto_contrato ")->where(" texto_contrato.id_tipo ",$id_tipo)->where(" texto_contrato.id_denominacion ",$id_denominacion)->order_by(" texto_contrato.id_texto ");
        $res = $this->db->get();
        //echo $this->db->last_query();
        return $res->result_array();

    }

    function AllTexto($id_tipo){
        $this->db->db_set_charset('UTF-8');
        $this->db->select(" texto_contrato.id_texto,
                            texto_contrato.id_tipo,
                            texto_contrato.id_denominacion,
                            (SELECT  esq_contrato.fnc_obtiene_denominacion((SELECT tipo.nombre FROM  esq_contrato.tipo WHERE tipo.idtipo=texto_contrato.id_tipo),texto_contrato.id_denominacion)) as deominacion,
                            texto_contrato.texto,
                            texto_contrato.fecha")->from(" esq_contrato.texto_contrato ")->where(" texto_contrato.id_tipo ",$id_tipo);
        $res = $this->db->get();
        //echo $this->db->last_query();
        return ['data'=>$res->result_array()];
    }
}