<?php
/**
 * Created by PhpStorm.
 * User: HSD
 * Date: 26/10/2017
 * Time: 20:33
 */

class mTalento_humano_as extends CI_Model {

    public function  __construct(){
        parent::__construct();
    }

    public function getListadoDepartamentos(){
        $this->db->select('d.iddepartamento, d.nombre');
        $this->db->from('esq_distributivos.departamento d');
        $this->db->where('d.habilitado','S');
        $this->db->order_by('d.nombre','ASC');
        $r = $this->db->get();
        return $r->result_array();
    }

    public function AprobarSolicitudTalentoHumano($data){
        $res=$this->db->query('SELECT esq_contrato.fnc_aprobar_recursos_humano(?,?);',$data);
        return $res->row();
    }

    public function RechazarSolicitudTalentoHumano($data){
        $res=$this->db->query('SELECT esq_contrato.fnc_rechazar_solicitud_talento_humano(?,?,?);',$data);
        return $res->row();
    }

}