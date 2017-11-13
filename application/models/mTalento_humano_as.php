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

    public function ListaAprobarTalentoHumanoDepto($id){
        $this->db->select('s.id_solicitud_contrato, s.id_personal, s.id_tipo_solicitud, p.apellido1, p.apellido2, p.nombres, p.cedula, d.nombre as departamento, 
        concat(pcoor.apellido1,\' \',pcoor.apellido2,\' \',pcoor.nombres) as nom_coordinador, s.fecha_solicitud as fecha, cat.nombre as t_contrato,
        catCat.nombre as categoria, catDed.nombre as dedicacion, catPues.nombre as puesto, catObs.nombre as observacion, 
        psarh.estado as estado_apro_th');
        $this->db->from('esq_datos_personales.personal p');
        $this->db->join('esq_contrato.solicitud_contrato s','p.idpersonal = s.id_personal','INNER');
        $this->db->join('esq_distributivos.departamento d','d.iddepartamento=s.id_departamento','INNER');
        $this->db->join('esq_datos_personales.personal pcoor','pcoor.idpersonal=s.id_cordinador','INNER');
        $this->db->join('esq_contrato.tipo cat','cat.idtipo=s.id_tipo_solicitud ','INNER');
        $this->db->join('esq_contrato.tipo catCat','catCat.idtipo=s.id_categoria_solicitud','INNER');
        $this->db->join('esq_contrato.tipo catDed','catDed.idtipo=s.id_dedicacion','INNER');
        $this->db->join('esq_contrato.tipo catPues','catPues.idtipo=s.id_puesto','INNER');
        $this->db->join('esq_contrato.tipo catObs','catObs.idtipo=s.id_observacion','INNER');
        $this->db->join('esq_contrato.proceso_solicitud psar','psar.id_solicitud=s.id_solicitud_contrato','INNER');
        $this->db->join('esq_contrato.proceso_solicitud psarh','psarh.id_solicitud=s.id_solicitud_contrato','INNER');
        $this->db->where('psar.id_tipo_aprobacion',7);
        $this->db->where('psar.estado','A');
        $this->db->where('psarh.id_tipo_aprobacion',8);
        $this->db->where('psarh.estado','P');
        $this->db->where('s.estado','P');
        $this->db->where('s.id_departamento',$id);
        $res = $this->db->get();
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data[]=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return $res->result();
        }
    }

    public function ListaAprobarTalentoHumanoAllDepto(){
        $this->db->select('s.id_solicitud_contrato, s.id_personal, s.id_tipo_solicitud, p.apellido1, p.apellido2, p.nombres, p.cedula, d.nombre as departamento, 
        concat(pcoor.apellido1,\' \',pcoor.apellido2,\' \',pcoor.nombres) as nom_coordinador, s.fecha_solicitud as fecha, cat.nombre as t_contrato,
        catCat.nombre as categoria, catDed.nombre as dedicacion, catPues.nombre as puesto, catObs.nombre as observacion, 
        psarh.estado as estado_apro_th');
        $this->db->from('esq_datos_personales.personal p');
        $this->db->join('esq_contrato.solicitud_contrato s','p.idpersonal = s.id_personal','INNER');
        $this->db->join('esq_distributivos.departamento d','d.iddepartamento=s.id_departamento','INNER');
        $this->db->join('esq_datos_personales.personal pcoor','pcoor.idpersonal=s.id_cordinador','INNER');
        $this->db->join('esq_contrato.tipo cat','cat.idtipo=s.id_tipo_solicitud ','INNER');
        $this->db->join('esq_contrato.tipo catCat','catCat.idtipo=s.id_categoria_solicitud','INNER');
        $this->db->join('esq_contrato.tipo catDed','catDed.idtipo=s.id_dedicacion','INNER');
        $this->db->join('esq_contrato.tipo catPues','catPues.idtipo=s.id_puesto','INNER');
        $this->db->join('esq_contrato.tipo catObs','catObs.idtipo=s.id_observacion','INNER');
        $this->db->join('esq_contrato.proceso_solicitud psar','psar.id_solicitud=s.id_solicitud_contrato','INNER');
        $this->db->join('esq_contrato.proceso_solicitud psarh','psarh.id_solicitud=s.id_solicitud_contrato','INNER');
        $this->db->where('psar.id_tipo_aprobacion',7);
        $this->db->where('psar.estado','A');
        $this->db->where('psarh.id_tipo_aprobacion',8);
        $this->db->where('psarh.estado','P');
        $this->db->where('s.estado','P');
        $res = $this->db->get();
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data[]=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return $res->result();
        }
    }

    public function SolicitudesAprobadas_RH($id_dpto,$estado){
        $this->db->select(" v_rh.id_solicitud_contrato, v_rh.id_personal, v_rh.id_departamento, v_rh.aspirante, v_rh.cedula_aspirante, v_rh.cordinador,v_rh.departamento, v_rh.fecha_solicitud, v_rh.t_contrato, v_rh.categoria, v_rh.dedicacion, v_rh.puesto, v_rh.observacion, v_rh.estado_apro_rh,v_rh.estado")
            ->from(" esq_contrato.v_solicitud_aprobar_recursos_h as v_rh ")
                 ->where("v_rh.id_departamento",$id_dpto)->where(" v_rh.estado_apro_rh",$estado);
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

    public function SolicitudesAllAprobadas_RH($estado){
        $this->db->select(" v_rh.id_solicitud_contrato, v_rh.id_personal, v_rh.id_departamento, v_rh.aspirante, v_rh.cedula_aspirante, v_rh.cordinador,v_rh.departamento, v_rh.fecha_solicitud, v_rh.t_contrato, v_rh.categoria, v_rh.dedicacion, v_rh.puesto, v_rh.observacion, v_rh.estado_apro_rh,v_rh.estado")
                 ->from(" esq_contrato.v_solicitud_aprobar_recursos_h as v_rh ")
                 ->where(" v_rh.estado_apro_rh",$estado);
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

    public function InfoSolicitudRechazada($id_solicitud){
        $this->db->select(" v_ps.idproceso_solicitud, v_ps.proceso, v_ps.usuario, v_ps.fecha, v_ps.hora, v_ps.observacion, v_ps.estado")
                 ->from(" esq_contrato.v_proceso_solicitud as v_ps ")
                 ->where(" v_ps.id_solicitud ",$id_solicitud)->where(" v_ps.estado='R' ");
        $res= $this->db->get();
        //echo $this->db->last_query();
        return $res->row();
    }

    public function getListadoDepartamentos(){
        $this->db->select('d.iddepartamento, d.nombre');
        $this->db->from('esq_distributivos.departamento d');
        $this->db->where('d.habilitado','S');
        $this->db->order_by('d.nombre','ASC');
        $r = $this->db->get();
        return $r->result();
    }


    public function AprobarSolicitudTalentoHumano($data){
        $res=$this->db->query('SELECT p_opcion, p_mensaje from esq_contrato.fnc_aprobar_talento_humano(?,?,?,?);',$data);
        return $res->row();
    }

    public function RechazarSolicitudTalentoHumano($data){
        $res=$this->db->query('SELECT esq_contrato.fnc_rechazar_solicitud_talento_humano(?,?,?);',$data);
        return $res->row();
    }

}