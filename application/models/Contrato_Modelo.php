<?php
/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 9/11/2017
 * Time: 0:25
 */

class Contrato_Modelo extends CI_Model {
    public function  __construct(){
        parent::__construct();
    }

    public function SaveContrato($datos){
       $res=$this->db->query('SELECT opcion, mensaje FROM esq_contrato.fnc_crear_contrato(?,?,?,?,?,?,?,?,?);',$datos);
       //echo $this->db->last_query();
       return $res->row_array();
    }

}