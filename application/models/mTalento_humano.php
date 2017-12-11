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

}