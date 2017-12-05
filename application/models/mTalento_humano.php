<?php
/**
 * Created by PhpStorm.
 * User: HSD
 * Date: 11/10/2017
 * Time: 10:25
 */

class mTalento_humano extends CI_Model {

    public function  __construct(){
        parent::__construct();
    }

    public function getListadoDepartamentos(){
        $this->db->select('d.iddepartamento, d.nombre');
        $this->db->from('esq_distributivos.departamento d');
        $this->db->where('d.habilitado','S');
        $this->db->order_by('d.nombre','ASC');
        $r = $this->db->get();
        return $r->result();
    }
    public function Tipo($id_tipo,$id_padre){
        $this->db->db_set_charset('UTF-8');
        $this->db->select(" tipo.idtipo, tipo.nombre ")
                 ->from(" esq_contrato.tipo ")
                 ->where(" tipo.idcategoria_tipo", $id_tipo)->where(" tipo.idpadre ",$id_padre)->order_by(" idtipo");
        $res = $this->db->get();
        //echo $this->db->last_query();
        return $res->result();
    }

    public function Remuneracion_Docente($categoria, $nivel, $dedicacion){
        $this->db->select(" denominacion_docente.id_denominacion_docente, denominacion_docente.rmu ")
                 ->from(" esq_contrato.denominacion_docente ")
                 ->where("denominacion_docente.id_categoria_docente ",$categoria)
                 ->where(" denominacion_docente.id_nivel_docente ",$nivel)
                 ->where(" denominacion_docente.id_dedicacion_docente", $dedicacion)->order_by(" id_denominacion_docente");
        $res = $this->db->get();
        return $res->row();
    }

    public function ListaRemuneracionAdmin($grupo_ocupacion,$ocupacion){
        $this->db->select(" d_admin.id_denominacion_admin, d_admin.rmu ")
                 ->from(" esq_contrato.denominacion_administrativo as d_admin ")
                 ->where(" d_admin.id_grupo_ocupacional ",$grupo_ocupacion)->where(" d_admin.id_puesto ",$ocupacion);
        $res = $this->db->get();
        return $res->row();
    }
}