<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 19/7/2017
 * Time: 10:43
 */
class Perfil_model extends CI_Model{

    public function  __construct(){
        parent::__construct();


    }

    public function SaveInfoPer($data){
        $this->db->db_set_charset('UTF-8');
        $res=$this->db->query('SELECT esq_contrato.info_personal(?,?,?,?,?,?,?,?,?,?,?,?,?,?);',$data);
        //echo $this->db->last_query();
        return $res->row();
    }

    public function SaveDimicilio($data){
        $this->db->db_set_charset('UTF-8');
        $res=$this->db->query('SELECT esq_contrato.info_domicilio(?,?,?,?,?,?,?,?,?,?,?,?,?,?);',$data);
        //echo $this->db->last_query();
        return $res->row();
    }

    public function SavePdf($data){
        $this->db->db_set_charset('LATIN1');
        $res=$this->db->query('SELECT esq_contrato.crear_archivo(?,?,?,?,?,?,?);',$data);
        //echo $this->db->last_query();
        return $res->row();
    }

    public function SaveFormal($data){
        $this->db->db_set_charset('UTF-8');
        $res=$this->db->query('SELECT esq_contrato.inst_formal(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',$data);
        //echo $this->db->last_query();
        return $res->row();
    }

    public function SaveCapacitacion($data){
        $this->db->db_set_charset('UTF-8');
        $res=$this->db->query('SELECT esq_contrato.perfil_capacitaciones(?,?,?,?,?,?,?,?,?,?,?)',$data);
        //echo $this->db->last_query();
        return $res->row();   
    }

    public function SaveExpProfesional($data){
        $this->db->db_set_charset('UTF-8');
        $res=$this->db->query('SELECT esq_contrato.perfil_exp_profesional(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',$data);
        //echo $this->db->last_query();
        return $res->row();
    }

    public function SaveBanco($data){
        $this->db->db_set_charset('UTF-8');
        $res=$this->db->query('SELECT esq_contrato.perfil_banco(?,?,?,?)',$data); 
        //echo $this->db->last_query();
        return $res->row();
    }

    public function SaveDiscapacidad($data){
        $this->db->db_set_charset('UTF-8');
        $res=$this->db->query('SELECT esq_contrato.perfil_discapacidad(?,?,?,?,?)',$data);
        //echo $this->db->last_query();
        return $res->row();
    }

    public function SavePublicacion($data){
        $this->db->db_set_charset('UTF-8');
        $res=$this->db->query('SELECT esq_contrato.perfil_publicaciones(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);',$data);
        //echo $this->db->last_query();
        return $res->row();
    }

    public function Datos_Info_personal($cedula){
        $this->db->select('personal.idpersonal,
                personal.idtipo_documento,
                personal.cedula,
                personal.idtipo_nacionalidad,
                personal.apellido1,
                personal.apellido2,
                personal.nombres,
                personal.fecha_nacimiento,
                personal.idtipo_genero,
                personal.idtipo_estado_civil,
                personal.idtipo_sangre,
                personal.idtipo_etnia,
                personal.idtipo_pais_origen,
                personal.idtipo_provincia_origen,
                personal.idtipo_canton_origen,
                personal.idtipo_parroquia_origen,
                personal.idtipo_pais_residencia,
                personal.idtipo_provincia_residencia,
                personal.idtipo_canton_residencia,
                personal.idtipo_parroquia_residencia,
                personal.residencia_calle_1,
                personal.residencia_calle_2,
                personal.residencia_calle_3,
                personal.residencia_referencia,
                personal.residencia_domicilio_numero,
                personal.telefono_personal_domicilio,
                personal.telefono_personal_celular,
                personal.telefono_personal_trabajo,
                personal.correo_personal_alternativo,
                personal.idtipo_discapacidad,
            personal.discapacidad_numero_porcentaje,
            personal.discapacidad_numero_carne,
            personal.discapacidad_observacion
                ')
            ->from('esq_datos_personales.personal')
            ->where('personal.cedula',$cedula);
        $res=$this->db->get();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }
    }

    public function DatosAllFormacion($cedula){
        $res=$this->db->query('SELECT * from  esq_contrato.listar_inst_formal(?)',$cedula); 
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
             for ($i=0; $i < $res->num_rows(); $i++) { 
                     $data['data'][]=array_map('utf8_encode',$res->result_array()[$i]);
             }
             return $data;
        }else{
          return $ress = array('data' => "");
        }               
        
    }

    public function AllCapacitacion($cedula){
        $res=$this->db->query('SELECT * From  esq_contrato.listar_capacitaciones(?);',$cedula);
         //echo $this->db->last_query();
        if($res->num_rows() > 0){
             for ($i=0; $i < $res->num_rows(); $i++) { 
                     $data['data'][]=array_map('utf8_encode',$res->result_array()[$i]);
             }
             return $data;
        }else{
          return $ress = array('data' => "");
        }    
    }

    public function AllExpProfesional($cedula){
        $res=$this->db->query('SELECT * From esq_contrato.listar_exp_profesional(?);',$cedula);
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
             for ($i=0; $i < $res->num_rows(); $i++) { 
                     $data['data'][]=array_map('utf8_encode',$res->result_array()[$i]);
             }
             return $data;
        }else{
          return $ress = array('data' => "");
        }
    }

    public function AllBanco($cedula){
        $res=$this->db->query('SELECT * From  esq_contrato.listar_banco(?);',$cedula);
        //echo $this->db->last_query();
         if($res->num_rows() > 0){
             for ($i=0; $i < $res->num_rows(); $i++) { 
                     $data['data'][]=array_map('utf8_encode',$res->result_array()[$i]);
             }
             return $data;
        }else{
          return $ress = array('data' => "");
        }    
    }

    public function AllPublicacion($datos){
        $res=$this->db->query('SELECT * From  esq_contrato.listar_publicacion(?,?);',$datos);
        //echo $this->db->last_query();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data['data'][]=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return $ress = array('data' => "");
        }
    }

    public function EliminarFichero($id_fichero){
        $this->db->where('fichero_hoja_vida.idfichero_hoja_vida', $id_fichero);
        $this->db->delete('esq_ficheros.fichero_hoja_vida');
        if($this->db->affected_rows()){
            return 'Se Elimino Correctamente';
        }
        return 'No Se Elimino Archivo';
    }

    public function EliminarPublicacion($id){
        $this->db->where('p_publicacion.id_publicacion', $id);
        $this->db->delete('esq_datos_personales.p_publicacion');
        if($this->db->affected_rows()){
            return 'Se Elimino Correctamente';
        }
        return 'No Se Elimino';
    }

    public function EliminarRegistro($tabla,$condicion,$id_registro, $id_fichero){
        $this->db->where($condicion,$id_registro);
        $this->db->delete($tabla);        
        //echo $this->db->last_query();
        if($this->db->affected_rows()){
            $this->db->where('fichero_hoja_vida.idfichero_hoja_vida', $id_fichero);
            $this->db->delete('esq_ficheros.fichero_hoja_vida');
            //echo $this->db->last_query();
            if($this->db->affected_rows()){
              return $res = array('respuesta'=>'Se Elimino Registro');
            }
        }      
    }

    public function EliminarRegistro_SF($tabla,$condicion,$id_registro){
        $this->db->where($condicion,$id_registro);
        $this->db->delete($tabla);
        //echo $this->db->last_query();
        if($this->db->affected_rows()){
            return $res = array('respuesta'=>'Se Elimino Registro');
        }
    }

}//fin de la clase perfil