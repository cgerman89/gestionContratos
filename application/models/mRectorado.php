<?php
/**
 * Created by PhpStorm.
 * User: HSD
 * Date: 17/10/2017
 * Time: 16:05
 */

class mRectorado extends CI_Model {
    public function  __construct(){
        parent::__construct();
    }

    public function getListAspFluProDpto($id){
        $this->db->select('c.idcontrato, c.idpersonal, p.apellido1, p.apellido2, p.nombres, p.cedula, d.nombre as departamento, 
        concat(pcoor.apellido1,\' \',pcoor.apellido2,\' \',pcoor.nombres) as nom_coordinador, s.fecha_solicitud as fecha, cat.nombre as t_contrato,
        catCat.nombre as categoria, catDed.nombre as dedicacion, catPues.nombre as puesto, catObs.nombre as observacion,
        psar.estado as estado_apro_rec, pusuar.correo_personal_institucional as usuarioar, psar.fecha as fecha_apro_rec, psar.hora as hora_apro_rec,
        psarh.estado as estado_apro_th, pusuarh.correo_personal_institucional as usuarioarh, psarh.fecha as fecha_apro_th, psarh.hora as hora_apro_th,
        
        pcrh.estado as estado_rh, pusurh.correo_personal_institucional as usuariorh, pcrh.fecha as fecha_rh, pcrh.hora as hora_rh,
        pcfi.estado as estado_fin, pusufi.correo_personal_institucional as usuariofi, pcfi.fecha as fecha_fi, pcfi.hora as hora_fi,
        pcfc.estado as estado_fc, pusufc.correo_personal_institucional as usuariofc, pcfc.fecha as fecha_fc, pcfc.hora as hora_fc,
        pcrhf.estado as estado_rhf, pusurhf.correo_personal_institucional as usuariorhf, pcrhf.fecha as fecha_rhf, pcrhf.hora as hora_rhf,
        pcfr.estado as estado_fr, pusufr.correo_personal_institucional as usuariofr, pcfr.fecha as fecha_fr, pcfr.hora as hora_fr');

        $this->db->from('esq_datos_personales.personal p');
        $this->db->join('esq_contrato.solicitud_contrato s','p.idpersonal = s.id_personal','INNER');
        $this->db->join('esq_distributivos.departamento d','d.iddepartamento=s.id_departamento','INNER');
        $this->db->join('esq_datos_personales.personal pcoor','pcoor.idpersonal=s.id_cordinador','INNER');
        $this->db->join('esq_catalogos.tipo cat','cat.idtipo=s.id_tipo_solicitud','INNER');
        $this->db->join('esq_catalogos.tipo catCat','catCat.idtipo=s.id_categoria_solicitud','INNER');
        $this->db->join('esq_catalogos.tipo catDed','catDed.idtipo=s.id_dedicacion','INNER');
        $this->db->join('esq_catalogos.tipo catPues','catPues.idtipo=s.id_puesto','INNER');
        $this->db->join('esq_catalogos.tipo catObs','catObs.idtipo=s.id_observacion','INNER');
        $this->db->join('esq_contrato.proceso_solicitud psar','psar.id_solicitud=s.id_solicitud_contrato','INNER');
        $this->db->join('esq_datos_personales.personal pusuar','pusuar.idpersonal=psar.id_personal','INNER');
        $this->db->join('esq_contrato.proceso_solicitud psarh','psarh.id_solicitud=s.id_solicitud_contrato','INNER');
        $this->db->join('esq_datos_personales.personal pusuarh','pusuarh.idpersonal=psarh.id_personal','INNER');

        $this->db->join('esq_contrato.contrato c','s.id_solicitud_contrato=c.id_solicitud','INNER');
        $this->db->join('esq_contrato.proceso_contrato pcrh','pcrh.idcontrato=c.idcontrato','INNER');
        $this->db->join('esq_datos_personales.personal pusurh','pusurh.idpersonal=pcrh.idpersonal','INNER');
        $this->db->join('esq_contrato.proceso_contrato pcfi','pcfi.idcontrato=c.idcontrato','INNER');
        $this->db->join('esq_datos_personales.personal pusufi','pusufi.idpersonal=pcfi.idpersonal','INNER');
        $this->db->join('esq_contrato.proceso_contrato pcfc','pcfc.idcontrato=c.idcontrato','INNER');
        $this->db->join('esq_datos_personales.personal pusufc','pusufc.idpersonal=pcfc.idpersonal','INNER');
        $this->db->join('esq_contrato.proceso_contrato pcrhf','pcrhf.idcontrato=c.idcontrato','INNER');
        $this->db->join('esq_datos_personales.personal pusurhf','pusurhf.idpersonal=pcrhf.idpersonal','INNER');
        $this->db->join('esq_contrato.proceso_contrato pcfr','pcfr.idcontrato=c.idcontrato','INNER');
        $this->db->join('esq_datos_personales.personal pusufr','pusufr.idpersonal=pcfr.idpersonal','INNER');

        $this->db->where('psar.id_tipo_aprobacion',2533);
        $this->db->where('psarh.id_tipo_aprobacion',2534);
        //$this->db->where('s.estado','A');
        $this->db->where('s.estado !=','R');

        $this->db->where('pcrh.idtipo_proceso',2578);
        $this->db->where('pcfi.idtipo_proceso',2535);
        $this->db->where('pcfc.idtipo_proceso',2536);
        $this->db->where('pcrhf.idtipo_proceso',2537);
        $this->db->where('pcfr.idtipo_proceso',2538);
        $this->db->where('pcfr.estado','P');
        $this->db->where('c.estado','P');
        $this->db->where('s.id_departamento',$id);
        $r = $this->db->get();
        return $r->result();
    }

    public function getListAspFluProAllDpto(){
        $this->db->select('c.idcontrato, c.idpersonal, p.apellido1, p.apellido2, p.nombres, p.cedula, d.nombre as departamento, 
        concat(pcoor.apellido1,\' \',pcoor.apellido2,\' \',pcoor.nombres) as nom_coordinador, s.fecha_solicitud as fecha, cat.nombre as t_contrato,
        catCat.nombre as categoria, catDed.nombre as dedicacion, catPues.nombre as puesto, catObs.nombre as observacion,
        psar.estado as estado_apro_rec, pusuar.correo_personal_institucional as usuarioar, psar.fecha as fecha_apro_rec, psar.hora as hora_apro_rec,
        psarh.estado as estado_apro_th, pusuarh.correo_personal_institucional as usuarioarh, psarh.fecha as fecha_apro_th, psarh.hora as hora_apro_th,
        
        pcrh.estado as estado_rh, pusurh.correo_personal_institucional as usuariorh, pcrh.fecha as fecha_rh, pcrh.hora as hora_rh,
        pcfi.estado as estado_fin, pusufi.correo_personal_institucional as usuariofi, pcfi.fecha as fecha_fi, pcfi.hora as hora_fi,
        pcfc.estado as estado_fc, pusufc.correo_personal_institucional as usuariofc, pcfc.fecha as fecha_fc, pcfc.hora as hora_fc,
        pcrhf.estado as estado_rhf, pusurhf.correo_personal_institucional as usuariorhf, pcrhf.fecha as fecha_rhf, pcrhf.hora as hora_rhf,
        pcfr.estado as estado_fr, pusufr.correo_personal_institucional as usuariofr, pcfr.fecha as fecha_fr, pcfr.hora as hora_fr');

        $this->db->from('esq_datos_personales.personal p');
        $this->db->join('esq_contrato.solicitud_contrato s','p.idpersonal = s.id_personal','INNER');
        $this->db->join('esq_distributivos.departamento d','d.iddepartamento=s.id_departamento','INNER');
        $this->db->join('esq_datos_personales.personal pcoor','pcoor.idpersonal=s.id_cordinador','INNER');
        $this->db->join('esq_catalogos.tipo cat','cat.idtipo=s.id_tipo_solicitud','INNER');
        $this->db->join('esq_catalogos.tipo catCat','catCat.idtipo=s.id_categoria_solicitud','INNER');
        $this->db->join('esq_catalogos.tipo catDed','catDed.idtipo=s.id_dedicacion','INNER');
        $this->db->join('esq_catalogos.tipo catPues','catPues.idtipo=s.id_puesto','INNER');
        $this->db->join('esq_catalogos.tipo catObs','catObs.idtipo=s.id_observacion','INNER');
        $this->db->join('esq_contrato.proceso_solicitud psar','psar.id_solicitud=s.id_solicitud_contrato','INNER');
        $this->db->join('esq_datos_personales.personal pusuar','pusuar.idpersonal=psar.id_personal','INNER');
        $this->db->join('esq_contrato.proceso_solicitud psarh','psarh.id_solicitud=s.id_solicitud_contrato','INNER');
        $this->db->join('esq_datos_personales.personal pusuarh','pusuarh.idpersonal=psarh.id_personal','INNER');

        $this->db->join('esq_contrato.contrato c','s.id_solicitud_contrato=c.id_solicitud','INNER');
        $this->db->join('esq_contrato.proceso_contrato pcrh','pcrh.idcontrato=c.idcontrato','INNER');
        $this->db->join('esq_datos_personales.personal pusurh','pusurh.idpersonal=pcrh.idpersonal','INNER');
        $this->db->join('esq_contrato.proceso_contrato pcfi','pcfi.idcontrato=c.idcontrato','INNER');
        $this->db->join('esq_datos_personales.personal pusufi','pusufi.idpersonal=pcfi.idpersonal','INNER');
        $this->db->join('esq_contrato.proceso_contrato pcfc','pcfc.idcontrato=c.idcontrato','INNER');
        $this->db->join('esq_datos_personales.personal pusufc','pusufc.idpersonal=pcfc.idpersonal','INNER');
        $this->db->join('esq_contrato.proceso_contrato pcrhf','pcrhf.idcontrato=c.idcontrato','INNER');
        $this->db->join('esq_datos_personales.personal pusurhf','pusurhf.idpersonal=pcrhf.idpersonal','INNER');
        $this->db->join('esq_contrato.proceso_contrato pcfr','pcfr.idcontrato=c.idcontrato','INNER');
        $this->db->join('esq_datos_personales.personal pusufr','pusufr.idpersonal=pcfr.idpersonal','INNER');

        $this->db->where('psar.id_tipo_aprobacion',2533);
        $this->db->where('psarh.id_tipo_aprobacion',2534);
        //$this->db->where('s.estado','A');
        $this->db->where('s.estado !=','R');

        $this->db->where('pcrh.idtipo_proceso',2578);
        $this->db->where('pcfi.idtipo_proceso',2535);
        $this->db->where('pcfc.idtipo_proceso',2536);
        $this->db->where('pcrhf.idtipo_proceso',2537);
        $this->db->where('pcfr.idtipo_proceso',2538);
        $this->db->where('pcfr.estado','P');
        $this->db->where('c.estado','P');
        $r = $this->db->get();
        return $r->result();
    }

    public function getListAspXAproDepto($id){
        $this->db->select('s.id_solicitud_contrato, p.apellido1, p.apellido2, p.nombres, p.cedula, d.nombre as departamento, 
        concat(pcoor.apellido1,\' \',pcoor.apellido2,\' \',pcoor.nombres) as nom_coordinador, s.fecha_solicitud as fecha, cat.nombre as t_contrato,
        catCat.nombre as categoria, catDed.nombre as dedicacion, catPues.nombre as puesto, catObs.nombre as observacion,
        psar.estado as estado_apro_rec, pusuar.correo_personal_institucional as usuarioar, psar.fecha as fecha_apro_rec, psar.hora as hora_apro_rec');
        $this->db->from('esq_datos_personales.personal p');
        $this->db->join('esq_contrato.solicitud_contrato s','p.idpersonal = s.id_personal','INNER');
        $this->db->join('esq_distributivos.departamento d','d.iddepartamento=s.id_departamento','INNER');
        $this->db->join('esq_datos_personales.personal pcoor','pcoor.idpersonal=s.id_cordinador','INNER');
        $this->db->join('esq_catalogos.tipo cat','cat.idtipo=s.id_tipo_solicitud','INNER');
        $this->db->join('esq_catalogos.tipo catCat','catCat.idtipo=s.id_categoria_solicitud','INNER');
        $this->db->join('esq_catalogos.tipo catDed','catDed.idtipo=s.id_dedicacion','INNER');
        $this->db->join('esq_catalogos.tipo catPues','catPues.idtipo=s.id_puesto','INNER');
        $this->db->join('esq_catalogos.tipo catObs','catObs.idtipo=s.id_observacion','INNER');
        $this->db->join('esq_contrato.proceso_solicitud psar','psar.id_solicitud=s.id_solicitud_contrato','INNER');
        $this->db->join('esq_datos_personales.personal pusuar','pusuar.idpersonal=psar.id_personal','INNER');
        $this->db->where('psar.id_tipo_aprobacion',2533);
        $this->db->where('psar.estado','P');
        $this->db->where('s.estado','P');
        $this->db->where('s.id_departamento',$id);
        $r = $this->db->get();
        return $r->result();
    }

    public function getListAspXAproAllDepto(){
        $this->db->select('s.id_solicitud_contrato, p.apellido1, p.apellido2, p.nombres, p.cedula, d.nombre as departamento, 
        concat(pcoor.apellido1,\' \',pcoor.apellido2,\' \',pcoor.nombres) as nom_coordinador, s.fecha_solicitud as fecha, cat.nombre as t_contrato,
        catCat.nombre as categoria, catDed.nombre as dedicacion, catPues.nombre as puesto, catObs.nombre as observacion,
        psar.estado as estado_apro_rec, pusuar.correo_personal_institucional as usuarioar, psar.fecha as fecha_apro_rec, psar.hora as hora_apro_rec');
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
        $this->db->where('psar.id_tipo_aprobacion',2533);
        $this->db->where('psar.estado','P');
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


    public function AprobarSolicitud($data){
        $res=$this->db->query('SELECT esq_contrato.fnc_actualizar_estado_rector(?,?);',$data);
        //echo $this->db->last_query();
        return $res->row();
    }

}