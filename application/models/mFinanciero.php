<?php
/**
 * Created by PhpStorm.
 * User: HSD
 * Date: 21/10/2017
 * Time: 10:58
 */

class mFinanciero extends CI_Model {

    public function  __construct(){
        parent::__construct();
    }
    public function getListadoDepartamentos(){
        $this->db->select('d.iddepartamento, d.nombre');
        $this->db->from('esq_distributivos.departamento d');
        $this->db->where('d.habilitado','S');
        $this->db->order_by('d.nombre','ASC');
        //echo $this->db->last_query();
        $r = $this->db->get();
        return $r->result();
    }






}