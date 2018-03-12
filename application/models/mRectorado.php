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

    public function ListarFlujosProcesosDpto($id){
        $this->db->select('s.id_solicitud_contrato, p.idpersonal, p.apellido1, p.apellido2, p.nombres, p.cedula, d.nombre as departamento, 
        concat(pcoor.apellido1,\' \',pcoor.apellido2,\' \',pcoor.nombres) as nom_coordinador, s.fecha_solicitud as fecha, cat.nombre as t_contrato,
        catCat.nombre as categoria, catDed.nombre as dedicacion, catPues.nombre as puesto, catObs.nombre as observacion');
        $this->db->from('esq_datos_personales.personal p');
        $this->db->join('esq_contrato.solicitud_contrato s','p.idpersonal = s.id_personal','INNER');
        $this->db->join('esq_distributivos.departamento d','d.iddepartamento=s.id_departamento','INNER');
        $this->db->join('esq_datos_personales.personal pcoor','pcoor.idpersonal=s.id_cordinador','INNER');
        $this->db->join('esq_contrato.tipo cat','cat.idtipo=s.id_tipo_solicitud','INNER');
        $this->db->join('esq_contrato.tipo catCat','catCat.idtipo=s.id_categoria_solicitud','INNER');
        $this->db->join('esq_contrato.tipo catDed','catDed.idtipo=s.id_dedicacion','INNER');
        $this->db->join('esq_contrato.tipo catPues','catPues.idtipo=s.id_puesto','INNER');
        $this->db->join('esq_contrato.tipo catObs','catObs.idtipo=s.id_observacion','INNER');
        $this->db->join('esq_contrato.proceso_solicitud psar','psar.id_solicitud=s.id_solicitud_contrato','INNER');
        $this->db->where('psar.id_tipo_aprobacion',7);
        $this->db->where('psar.estado','A');
        $this->db->where('s.estado !=','R');
        $this->db->where('s.id_departamento',$id);
        $res = $this->db->get();
        // echo $this->db->last_query();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data[]=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return $res->result_array();
        }
    }

    public function ListarFlujosProcesosAllDpto(){
        $this->db->select('s.id_solicitud_contrato, p.idpersonal, p.apellido1, p.apellido2, p.nombres, p.cedula, d.nombre as departamento, 
        concat(pcoor.apellido1,\' \',pcoor.apellido2,\' \',pcoor.nombres) as nom_coordinador, s.fecha_solicitud as fecha, cat.nombre as t_contrato,
        catCat.nombre as categoria, catDed.nombre as dedicacion, catPues.nombre as puesto, catObs.nombre as observacion');
        $this->db->from('esq_datos_personales.personal p');
        $this->db->join('esq_contrato.solicitud_contrato s','p.idpersonal = s.id_personal','INNER');
        $this->db->join('esq_distributivos.departamento d','d.iddepartamento=s.id_departamento','INNER');
        $this->db->join('esq_datos_personales.personal pcoor','pcoor.idpersonal=s.id_cordinador','INNER');
        $this->db->join('esq_contrato.tipo cat','cat.idtipo=s.id_tipo_solicitud','INNER');
        $this->db->join('esq_contrato.tipo catCat','catCat.idtipo=s.id_categoria_solicitud','INNER');
        $this->db->join('esq_contrato.tipo catDed','catDed.idtipo=s.id_dedicacion','INNER');
        $this->db->join('esq_contrato.tipo catPues','catPues.idtipo=s.id_puesto','INNER');
        $this->db->join('esq_contrato.tipo catObs','catObs.idtipo=s.id_observacion','INNER');
        $this->db->join('esq_contrato.proceso_solicitud psar','psar.id_solicitud=s.id_solicitud_contrato','INNER');

        $this->db->where('psar.id_tipo_aprobacion',7);
        $this->db->where('psar.estado','A');
        $this->db->where('s.estado !=','R');
        $res = $this->db->get();
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data[]=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return $res->result_array();
        }
    }

    public function ListaAprobarRectorDepto($id_dpto){
        $this->db->select(" ap_r.id_solicitud_contrato, ap_r.id_personal,  ap_r.id_departamento, ap_r.aspirante, ap_r.cedula_aspirante, ap_r.departamento, ap_r.cordinador, ap_r.fecha_solicitud, ap_r.t_contrato, ap_r.categoria, ap_r.dedicacion, ap_r.puesto, ap_r.estado_apro_rec ")
                 ->from(" esq_contrato.v_solicitud_aprobar_rector as ap_r ")
                 ->where("ap_r.id_departamento",$id_dpto)->where("ap_r.estado_apro_rec='P' ");
        $res= $this->db->get();
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data[]=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return $res->result_array();
        }
    }

    public function ListaAprobarRectorAllDepto(){
        $this->db->select(" ap_r.id_solicitud_contrato, ap_r.id_personal,  ap_r.id_departamento, ap_r.aspirante, ap_r.cedula_aspirante, ap_r.departamento, ap_r.cordinador, ap_r.fecha_solicitud, ap_r.t_contrato, ap_r.categoria, ap_r.dedicacion, ap_r.puesto, ap_r.estado_apro_rec ")
            ->from(" esq_contrato.v_solicitud_aprobar_rector as ap_r ")
            ->where("ap_r.estado_apro_rec='P' ");
        $res= $this->db->get();
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data[]=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return $res->result_array();
        }
    }

    public function getListadoDepartamentos(){
        $this->db->select('d.iddepartamento, d.nombre');
        $this->db->from('esq_distributivos.departamento d');
        $this->db->where('d.habilitado','S');
        $this->db->order_by('d.nombre','ASC');
        $r = $this->db->get();
        return $r->result();
    }



    public function RegistrosProcesosSolicitud($id_solicitud){
        $res=$this->db->query('SELECT p_id_proceso_solicitud,p_proceso,p_usuario,p_fecha,p_hora,p_observacion,p_estado FROM  esq_contrato.fnc_listar_procesos_solicitud(?);',$id_solicitud);
        if($res->num_rows() > 0){
            $data['data']=$res->result_array();
            return $data;
        }else{
            $res=array('data' => "");
        }
        return $res;
    }

    public function RegistrosProcesosContrato($id_solicitud){
        $res=$this->db->query('SELECT p_id_proceso_contrato,p_proceso,p_usuario,p_fecha,p_hora,p_observacion,p_estado FROM  esq_contrato.fnc_listar_procesos_contrato(?);',$id_solicitud);
        if($res->num_rows() > 0){
            $data['data']=$res->result_array();
            return $data;
        }else{
            $res=array('data' => "");
        }
        return $res;
    }

    public function ProcesosSolicitudesRechazadasDpto($id){
        $this->db->select('s.id_solicitud_contrato, p.idpersonal, p.apellido1, p.apellido2, p.nombres, p.cedula, d.nombre as departamento, 
        concat(pcoor.apellido1,\' \',pcoor.apellido2,\' \',pcoor.nombres) as nom_coordinador, s.fecha_solicitud as fecha, cat.nombre as t_contrato,
        catCat.nombre as categoria, catDed.nombre as dedicacion, catPues.nombre as puesto, catObs.nombre as observacion');

        $this->db->from('esq_datos_personales.personal p');
        $this->db->join('esq_contrato.solicitud_contrato s','p.idpersonal = s.id_personal','INNER');
        $this->db->join('esq_distributivos.departamento d','d.iddepartamento=s.id_departamento','INNER');
        $this->db->join('esq_datos_personales.personal pcoor','pcoor.idpersonal=s.id_cordinador','INNER');
        $this->db->join('esq_contrato.tipo cat','cat.idtipo=s.id_tipo_solicitud','INNER');
        $this->db->join('esq_contrato.tipo catCat','catCat.idtipo=s.id_categoria_solicitud','INNER');
        $this->db->join('esq_contrato.tipo catDed','catDed.idtipo=s.id_dedicacion','INNER');
        $this->db->join('esq_contrato.tipo catPues','catPues.idtipo=s.id_puesto','INNER');
        $this->db->join('esq_contrato.tipo catObs','catObs.idtipo=s.id_observacion','INNER');

        $this->db->where('s.estado','R');
        $this->db->where('s.id_departamento',$id);
        $res = $this->db->get();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data[]=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return $res->result();
        }
    }

    public function ProcesosSolicitudesRechazadasAllDpto(){
        $this->db->select('s.id_solicitud_contrato, p.idpersonal, p.apellido1, p.apellido2, p.nombres, p.cedula, d.nombre as departamento, 
        concat(pcoor.apellido1,\' \',pcoor.apellido2,\' \',pcoor.nombres) as nom_coordinador, s.fecha_solicitud as fecha, cat.nombre as t_contrato,
        catCat.nombre as categoria, catDed.nombre as dedicacion, catPues.nombre as puesto, catObs.nombre as observacion');

        $this->db->from('esq_datos_personales.personal p');
        $this->db->join('esq_contrato.solicitud_contrato s','p.idpersonal = s.id_personal','INNER');
        $this->db->join('esq_distributivos.departamento d','d.iddepartamento=s.id_departamento','INNER');
        $this->db->join('esq_datos_personales.personal pcoor','pcoor.idpersonal=s.id_cordinador','INNER');
        $this->db->join('esq_contrato.tipo cat','cat.idtipo=s.id_tipo_solicitud','INNER');
        $this->db->join('esq_contrato.tipo catCat','catCat.idtipo=s.id_categoria_solicitud','INNER');
        $this->db->join('esq_contrato.tipo catDed','catDed.idtipo=s.id_dedicacion','INNER');
        $this->db->join('esq_contrato.tipo catPues','catPues.idtipo=s.id_puesto','INNER');
        $this->db->join('esq_contrato.tipo catObs','catObs.idtipo=s.id_observacion','INNER');

        $this->db->where('s.estado','R');
        $res = $this->db->get();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data[]=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return $res->result();
        }
    }

    public function Hoja_vida($datos){
        $res=$this->db->query('SELECT * from  esq_contrato.hoja_vida_datos_personales(?)',$datos);
        return $res->result_array();
    }

    public function Hoja_vida2($datos){
        $res=$this->db->query('SELECT * from  esq_contrato.hoja_vida_instruccion_formal(?)',$datos);
        return $res->result_array();
    }

    public function Hoja_vida3($datos){
        $res=$this->db->query('SELECT * from  esq_contrato.hoja_vida_capacitaciones(?)',$datos);
        return $res->result_array();
    }

    public function Hoja_vida4($datos){
        $res=$this->db->query('SELECT * from  esq_contrato.hoja_vida_publicaciones(?)',$datos);
        return $res->result_array();

    }

    public function Hoja_vida5($datos){
        $res=$this->db->query('SELECT * from  esq_contrato.hoja_vida_experiencia(?)',$datos);
        return $res->result_array();

    }


}