<?php

/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 21/7/2017
 * Time: 16:19
 */
class Campos_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->db->db_set_charset('UTF8');
    }

    public function CargarPais(){
        $this->db->select('pais.idubicacion_geografica as idpais,pais.nombre');
        $this->db->from('esq_catalogos.ubicacion_geografica as pais');
        $this->db->where('pais.idtipo_ubicacion_geografica',24);
        $this->db->order_by('pais.nombre');
        $registros=$this->db->get();
        //echo $this->db->last_query();
        return  $registros->result();
    }

    public function CargarProvin($idpais){
        $this->db->select('provincia.idubicacion_geografica as idprovincia,provincia.nombre');
        $this->db->from('esq_catalogos.ubicacion_geografica as provincia');
        $this->db->where('provincia.idubicacion_geografica_padre',$idpais);
        $this->db->order_by('provincia.nombre');
        $registros=$this->db->get();
        //echo $this->db->last_query();
        return  $registros->result();
    }

    public function CargarCanton($idpro){
        $this->db->select('canton.idubicacion_geografica as idcanton,canton.nombre');
        $this->db->from('esq_catalogos.ubicacion_geografica as canton');
        $this->db->where('canton.idubicacion_geografica_padre',$idpro);
        $this->db->order_by('canton.nombre');
        $registros=$this->db->get();
        //echo $this->db->last_query();
        return  $registros->result();
    }

    public function CargarParroquia($idcanton){
        $this->db->select('parroquia.idubicacion_geografica as idparroquia,parroquia.nombre');
        $this->db->from('esq_catalogos.ubicacion_geografica as parroquia');
        $this->db->where('parroquia.idubicacion_geografica_padre',$idcanton);
        $this->db->order_by('parroquia.nombre');
        $registros=$this->db->get();
        //echo $this->db->last_query();
        return  $registros->result();
    }

    public function CargaTipo($idcategoria){
        $this->db->select('tipo.idtipo,tipo.nombre');
        $this->db->from('esq_catalogos.tipo');
        $this->db->join('esq_catalogos.categoria_tipo','categoria_tipo.idcategoria_tipo=tipo.idcategoria_tipo');
        $this->db->where('tipo.idcategoria_tipo',$idcategoria);
        $this->db->order_by('tipo.nombre');
        $registros=$this->db->get();
        //echo $this->db->last_query();
        return  $registros->result();
    }

    public function CargaTipo2($idcategoria){
        $this->db->select('tipo.idtipo,tipo.nombre');
        $this->db->from('esq_contrato.tipo');
        $this->db->join('esq_contrato.categoria_tipo','categoria_tipo.idcategoria_tipo=tipo.idcategoria_tipo');
        $this->db->where('tipo.idcategoria_tipo',$idcategoria);
        $this->db->order_by('tipo.idtipo');
        $registros=$this->db->get();
        //echo $this->db->last_query();
        return  $registros->result();
    }

    public function CargaTipoHijo($idhijo){
        $this->db->select('tipo.idtipo,tipo.nombre');
        $this->db->from('esq_catalogos.tipo');
        $this->db->where('tipo.idtipo_padre_1',$idhijo);
        $this->db->order_by('tipo.nombre');
        $registros=$this->db->get();
        //echo $this->db->last_query();
        return  $registros->result();
    }

    public function CargaTipoHijo2($idhijo){
        $this->db->select('tipo.idtipo,tipo.nombre');
        $this->db->from('esq_contrato.tipo');
        $this->db->where('tipo.idpadre',$idhijo);
        $this->db->order_by('tipo.nombre');
        $registros=$this->db->get();
        //echo $this->db->last_query();
        return  $registros->result();
    }

    public function CargaUniversidad(){
        $this->db->select('uni.iduniversidad,uni.nombre ');
        $this->db->from('esq_datos_personales.p_universidad as uni');
        $this->db->order_by('uni.nombre');
        $registros=$this->db->get();
        //echo $this->db->last_query();
        return  $registros->result();
    }

    public function Get_Instrumento_Pub($cadena){
        $this->db->select('p_publicacion_instrumento.id_publicacion_instrumento,CONCAT(p_publicacion_instrumento.codigo_issn_isbn,\', \',p_publicacion_instrumento.nombre) as nombre');
        $this->db->from('esq_datos_personales.p_publicacion_instrumento');
        $this->db->like('p_publicacion_instrumento.codigo_issn_isbn', $cadena, 'after');
        $res=$this->db->get();
        if ($res->num_rows() == 0){
            $this->db->select('p_publicacion_instrumento.id_publicacion_instrumento,CONCAT(p_publicacion_instrumento.codigo_issn_isbn,\', \',p_publicacion_instrumento.nombre) as nombre');
            $this->db->from('esq_datos_personales.p_publicacion_instrumento');
            $this->db->like('p_publicacion_instrumento.nombre', $cadena, 'after');
            $res=$this->db->get();
            if($res->num_rows()>0){
                return  $res->result();
            }
        }else{
            return  $res->result();
        }
    }

    public function CargaTituloUniversitario($id_personal){
        $res=$this->db->query(' SELECT   f_profecional.idformacion_profesional as id_inst_formal, concat((SELECT tipo.nombre FROM esq_catalogos.tipo WHERE tipo.idtipo=f_profecional.idtipo_nivel_instruccion),\' => \',f_profecional.titulo_obtenido) as titulo FROM esq_datos_personales.p_formacion_profesional as f_profecional WHERE f_profecional.idpersonal=?;',$id_personal);
        //echo $this->db->last_query();
        return  $res->result();
    }

}