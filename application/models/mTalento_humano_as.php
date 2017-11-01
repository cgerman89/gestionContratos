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

    public function getListAspXAproTHDepto($id){
        $this->db->select('s.id_solicitud_contrato, s.id_personal, s.id_tipo_solicitud, p.apellido1, p.apellido2, p.nombres, p.cedula, d.nombre as departamento, 
        concat(pcoor.apellido1,\' \',pcoor.apellido2,\' \',pcoor.nombres) as nom_coordinador, s.fecha_solicitud as fecha, cat.nombre as t_contrato,
        catCat.nombre as categoria, catDed.nombre as dedicacion, catPues.nombre as puesto, catObs.nombre as observacion,
        psar.estado as estado_apro_rec, pusuar.correo_personal_institucional as usuarioar, psar.fecha as fecha_apro_rec, psar.hora as hora_apro_rec,
        psarh.estado as estado_apro_th, pusuarh.correo_personal_institucional as usuarioarh, psarh.fecha as fecha_apro_th, psarh.hora as hora_apro_th');
        $this->db->from('esq_datos_personales.personal p');
        $this->db->join('esq_contrato.solicitud_contrato s','p.idpersonal = s.id_personal','INNER');
        $this->db->join('esq_distributivos.departamento d','d.iddepartamento=s.id_departamento','INNER');
        $this->db->join('esq_datos_personales.personal pcoor','pcoor.idpersonal=s.id_cordinador','INNER');
        $this->db->join('esq_catalogos.tipo cat','cat.idtipo=s.id_tipo_solicitud ','INNER');
        $this->db->join('esq_catalogos.tipo catCat','catCat.idtipo=s.id_categoria_solicitud','INNER');
        $this->db->join('esq_catalogos.tipo catDed','catDed.idtipo=s.id_dedicacion','INNER');
        $this->db->join('esq_catalogos.tipo catPues','catPues.idtipo=s.id_puesto','INNER');
        $this->db->join('esq_catalogos.tipo catObs','catObs.idtipo=s.id_observacion','INNER');
        $this->db->join('esq_contrato.proceso_solicitud psar','psar.id_solicitud=s.id_solicitud_contrato','INNER');
        $this->db->join('esq_datos_personales.personal pusuar','pusuar.idpersonal=psar.id_personal','INNER');
        $this->db->join('esq_contrato.proceso_solicitud psarh','psarh.id_solicitud=s.id_solicitud_contrato','INNER');
        $this->db->join('esq_datos_personales.personal pusuarh','pusuarh.idpersonal=psarh.id_personal','INNER');
        $this->db->where('psar.id_tipo_aprobacion',2533);
        $this->db->where('psar.estado','A');
        $this->db->where('psarh.id_tipo_aprobacion',2534);
        $this->db->where('psarh.estado','P');
        $this->db->where('s.estado','P');
        $this->db->where('s.id_departamento',$id);
        $r = $this->db->get();
        return $r->result();
    }

    public function getListAspXAproTHAllDepto(){
        $this->db->select('s.id_solicitud_contrato, s.id_personal, s.id_tipo_solicitud, p.apellido1, p.apellido2, p.nombres, p.cedula, d.nombre as departamento, 
        concat(pcoor.apellido1,\' \',pcoor.apellido2,\' \',pcoor.nombres) as nom_coordinador, s.fecha_solicitud as fecha, cat.nombre as t_contrato,
        catCat.nombre as categoria, catDed.nombre as dedicacion, catPues.nombre as puesto, catObs.nombre as observacion,
        psar.estado as estado_apro_rec, pusuar.correo_personal_institucional as usuarioar, psar.fecha as fecha_apro_rec, psar.hora as hora_apro_rec,
        psarh.estado as estado_apro_th, pusuarh.correo_personal_institucional as usuarioarh, psarh.fecha as fecha_apro_th, psarh.hora as hora_apro_th');
        $this->db->from('esq_datos_personales.personal p');
        $this->db->join('esq_contrato.solicitud_contrato s','p.idpersonal = s.id_personal','INNER');
        $this->db->join('esq_distributivos.departamento d','d.iddepartamento=s.id_departamento','INNER');
        $this->db->join('esq_datos_personales.personal pcoor','pcoor.idpersonal=s.id_cordinador','INNER');
        $this->db->join('esq_catalogos.tipo cat','cat.idtipo=s.id_tipo_solicitud ','INNER');
        $this->db->join('esq_catalogos.tipo catCat','catCat.idtipo=s.id_categoria_solicitud','INNER');
        $this->db->join('esq_catalogos.tipo catDed','catDed.idtipo=s.id_dedicacion','INNER');
        $this->db->join('esq_catalogos.tipo catPues','catPues.idtipo=s.id_puesto','INNER');
        $this->db->join('esq_catalogos.tipo catObs','catObs.idtipo=s.id_observacion','INNER');
        $this->db->join('esq_contrato.proceso_solicitud psar','psar.id_solicitud=s.id_solicitud_contrato','INNER');
        $this->db->join('esq_datos_personales.personal pusuar','pusuar.idpersonal=psar.id_personal','INNER');
        $this->db->join('esq_contrato.proceso_solicitud psarh','psarh.id_solicitud=s.id_solicitud_contrato','INNER');
        $this->db->join('esq_datos_personales.personal pusuarh','pusuarh.idpersonal=psarh.id_personal','INNER');
        $this->db->where('psar.id_tipo_aprobacion',2533);
        $this->db->where('psar.estado','A');
        $this->db->where('psarh.id_tipo_aprobacion',2534);
        $this->db->where('psarh.estado','P');
        $this->db->where('s.estado','P');
        $r = $this->db->get();
        return $r->result();
    }

    public function getListadoDepartamentos(){
        $this->db->select('d.iddepartamento, d.nombre');
        $this->db->from('esq_distributivos.departamento d');
        $this->db->where('d.habilitado','S');
        $this->db->order_by('d.nombre','ASC');
        $r = $this->db->get();
        return $r->result();
    }


    public function AprobarSolicitudTH($data){
        $res=$this->db->query('SELECT p_opcion, p_mensaje from esq_contrato.fnc_actualizar_estado_th(?,?,?,?);',$data);
        //echo $this->db->last_query();
        return $res->row();
    }

}