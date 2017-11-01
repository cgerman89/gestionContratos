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

    public function CargaTipo($idCategoriaTipo){
        $this->db->select('t.idtipo,t.nombre');
        $this->db->from('esq_catalogos.tipo t');
        $this->db->join('esq_catalogos.categoria_tipo ct','ct.idcategoria_tipo=t.idcategoria_tipo');
        $this->db->where('t.idcategoria_tipo',$idCategoriaTipo);
        $this->db->where('t.nombre !=','ESCALAFON DOCENTE');
        $this->db->where('t.habilitado','S');
        $this->db->where('t.bloqueado','N');
        $r=$this->db->get();
        return $r->result();
    }

    public function getListNivel($idCategoria){
        $this->db->select('DISTINCT(t.idtipo), t.nombre');
        $this->db->from('esq_catalogos.tipo t');
        $this->db->join('esq_contrato.denominacion_docente dd','dd.id_nivel_docente=t.idtipo');
        $this->db->where('dd.id_categoria_docente',$idCategoria);
        $this->db->where('t.habilitado','S');
        $this->db->where('t.bloqueado','N');
        $this->db->order_by('t.idtipo');
        $r=$this->db->get();
        return $r->result();
    }

    public function getListDedicacion($idCategoria,$idNivel){
        $this->db->select('DISTINCT(t.idtipo), t.nombre');
        $this->db->from('esq_catalogos.tipo t');
        $this->db->join('esq_contrato.denominacion_docente dd','dd.id_dedicacion_docente=t.idtipo');
        $this->db->where('dd.id_categoria_docente',$idCategoria);
        $this->db->where('dd.id_nivel_docente',$idNivel);
        $this->db->where('t.habilitado','S');
        $this->db->where('t.bloqueado','N');
        $this->db->order_by('t.idtipo');
        $r=$this->db->get();
        return $r->result();
    }

    public function getRemuneracion($idCategoria,$idNivel,$Dedicacion){
        $this->db->select('dd.id_denominacion_docente, dd.rmu, dd.abrevia');
        $this->db->from('esq_contrato.denominacion_docente dd');
        $this->db->where('dd.id_categoria_docente',$idCategoria);
        $this->db->where('dd.id_nivel_docente',$idNivel);
        $this->db->where('dd.id_dedicacion_docente',$Dedicacion);
        $this->db->where('dd.estado','S');
        $r=$this->db->get();
        return $r->result();
    }

    public function getListProfesiones($idPersonal){
        $this->db->select('fp.idformacion_profesional, fp.titulo_obtenido');
        $this->db->from('esq_datos_personales.p_formacion_profesional fp');
        $this->db->where('fp.idpersonal',$idPersonal);
        $r=$this->db->get();
        return $r->result();
    }

    public function ProcesarSolicitudRRHH($data){
        $res=$this->db->query('SELECT esq_contrato.fnc_proceso_rrhh(?,?,?,?,?,?,?,?,?);',$data);
        return $res->row();
    }


    public function ListaSolicitudes($dpto,$tipo){
        $this->db->select("solicitud_contrato.id_solicitud_contrato,
                           solicitud_contrato.id_personal,
                           (SELECT concat(personal.nombres,' ',personal.apellido1,' ',personal.apellido2) FROM esq_datos_personales.personal WHERE personal.idpersonal=solicitud_contrato.id_cordinador) as cordinador,
                           (SELECT departamento.nombre FROM esq_distributivos.departamento WHERE departamento.iddepartamento=solicitud_contrato.id_departamento) as departamento,
                           (SELECT  esq_catalogos.tipo.nombre from esq_catalogos.tipo WHERE esq_catalogos.tipo.idtipo=solicitud_contrato.id_tipo_solicitud) as tipo_solicitud,
                           (SELECT  esq_catalogos.tipo.nombre from esq_catalogos.tipo WHERE esq_catalogos.tipo.idtipo=solicitud_contrato.id_categoria_solicitud) as categoria,
                           (SELECT  esq_catalogos.tipo.nombre from esq_catalogos.tipo WHERE esq_catalogos.tipo.idtipo=solicitud_contrato.id_puesto) as puesto,
                           (SELECT  esq_catalogos.tipo.nombre from esq_catalogos.tipo WHERE esq_catalogos.tipo.idtipo=solicitud_contrato.id_dedicacion) as dedicacion,
                           solicitud_contrato.fecha_solicitud,
                           (SELECT concat(personal.nombres,' ',personal.apellido1,' ',personal.apellido2) FROM esq_datos_personales.personal WHERE personal.idpersonal=solicitud_contrato.id_personal) as aspirante,
                           (SELECT personal.cedula FROM esq_datos_personales.personal WHERE personal.idpersonal=solicitud_contrato.id_personal) as cedula_aspirante,
                           (SELECT  esq_catalogos.tipo.nombre from esq_catalogos.tipo WHERE esq_catalogos.tipo.idtipo=solicitud_contrato.id_observacion) as observacion,
                           solicitud_contrato.estado")
                 ->from('esq_contrato.solicitud_contrato')
                 ->where('solicitud_contrato.id_departamento',$dpto)->where('solicitud_contrato.id_tipo_solicitud',$tipo)->where("solicitud_contrato.estado='A'");
        $res=$this->db->get();
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            $data['data']=$res->result_array();
            return $data;
        }else{
            $res=array('data' => "");
        }
        return $res;
    }

    public function ListaAllSolicitudes($tipo){
        $this->db->select("solicitud_contrato.id_solicitud_contrato,
                           solicitud_contrato.id_personal,
                           (SELECT concat(personal.nombres,' ',personal.apellido1,' ',personal.apellido2) FROM esq_datos_personales.personal WHERE personal.idpersonal=solicitud_contrato.id_cordinador) as cordinador,
                           (SELECT departamento.nombre FROM esq_distributivos.departamento WHERE departamento.iddepartamento=solicitud_contrato.id_departamento) as departamento,
                           (SELECT  esq_catalogos.tipo.nombre from esq_catalogos.tipo WHERE esq_catalogos.tipo.idtipo=solicitud_contrato.id_tipo_solicitud) as tipo_solicitud,
                           (SELECT  esq_catalogos.tipo.nombre from esq_catalogos.tipo WHERE esq_catalogos.tipo.idtipo=solicitud_contrato.id_categoria_solicitud) as categoria,
                           (SELECT  esq_catalogos.tipo.nombre from esq_catalogos.tipo WHERE esq_catalogos.tipo.idtipo=solicitud_contrato.id_puesto) as puesto,
                           (SELECT  esq_catalogos.tipo.nombre from esq_catalogos.tipo WHERE esq_catalogos.tipo.idtipo=solicitud_contrato.id_dedicacion) as dedicacion,
                           solicitud_contrato.fecha_solicitud,
                           (SELECT concat(personal.nombres,' ',personal.apellido1,' ',personal.apellido2) FROM esq_datos_personales.personal WHERE personal.idpersonal=solicitud_contrato.id_personal) as aspirante,
                           (SELECT personal.cedula FROM esq_datos_personales.personal WHERE personal.idpersonal=solicitud_contrato.id_personal) as cedula_aspirante,
                           (SELECT  esq_catalogos.tipo.nombre from esq_catalogos.tipo WHERE esq_catalogos.tipo.idtipo=solicitud_contrato.id_observacion) as observacion,
                           solicitud_contrato.estado")
            ->from('esq_contrato.solicitud_contrato')
            ->where('solicitud_contrato.id_tipo_solicitud',$tipo)->where("solicitud_contrato.estado='A'");
        $res=$this->db->get();
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            $data['data']=$res->result_array();
            return $data;
        }else{
            $res=array('data' => "");
        }
        return $res;
    }

}