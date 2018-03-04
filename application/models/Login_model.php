<?php
/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 26/9/2017
 * Time: 15:16
 */

class Login_model extends CI_Model {
   private $db_user;

    public function __construct(){
        parent::__construct();
        $this->db_user=$this->load->database('db_usuarios',TRUE);
    }

    public function Login_Aspirante($datos){
       $this->db->db_set_charset('UTF-8');
       $res=$this->db->query('SELECT p_opcion,p_mensaje,p_id_personal,p_cedula,p_nombres,p_t_usuario,p_desc_usuario FROM esq_contrato.fnc_login_aspirante(?,?);',$datos);
       //echo $this->db_user->last_query();
       return $res->row_array();
    }

    public function Login_User($datos){
        $this->db->db_set_charset('LATIN1');
        $res=$this->db->query('SELECT p_mensaje, p_opcion , p_idpersonal,p_cedula,p_nombres,p_t_usuario,p_desc_usuario FROM esq_contrato.fnc_login_sth(?,?)',$datos);
        //echo $this->db_user->last_query();
        if($res->num_rows() > 0){
            for ($i=0; $i < $res->num_rows(); $i++) {
                $data=array_map('utf8_encode',$res->result_array()[$i]);
            }
            return $data;
        }else{
            return $ress = array('data' => "");
        }
    }

    public function Departamento($cedula){
        $this->db->select(' dp.iddepartamento,dp.idfacultad,dp.nombre')
                        ->from('esq_distributivos.departamento as dp')
                        ->where('dp.cedula',$cedula)
                        ->where("dp.habilitado='S'");
        $res=$this->db->get();
        //echo $this->db_user->last_query();
        return $res->row_array();
    }

    public function Menus($id_rol){
        $this->db_user->select('tbl_menu.id_menu,tbl_menu.descripcion')
                      ->from('esq_roles.tbl_menu')
                      ->join('esq_roles.tbl_menu_rol','tbl_menu_rol.id_menu=tbl_menu.id_menu')
                      ->join('esq_roles.tbl_rol','tbl_rol.id_rol=tbl_menu_rol.id_rol')
                      ->where('tbl_rol.id_rol',$id_rol)
                      ->where("tbl_menu.id_aplicacion=7")
                      ->where("tbl_menu.id_modulo=7")
                      ->where("tbl_menu.estado='S'");
        $res_menu=$this->db_user->get();
        //echo $this->db_user->last_query();
        $menu=$res_menu->result_array();
        if(isset($res_menu)){
            for ($i=0;$i< count($menu);$i++){
                $menu[$i]['submenu']=$this->SubMenu($menu[$i]['id_menu']);
            }
        }
        return $menu;
    }

    public function SubMenu($id_menu){
        $this->db_user->select('tbl_menu.id_menu, tbl_menu.descripcion,tbl_menu.id_padre,tbl_menu.ruta')
                      ->from('esq_roles.tbl_menu')
                      ->where('tbl_menu.id_padre',$id_menu)
                      ->where("tbl_menu.estado='S'");
        $res_sub=$this->db_user->get();
        //echo $this->db_user->last_query();
        return $res_sub->result_array();
    }

    public function Rol_User($datos){
        $res=$this->db_user->query('SELECT p_conexion,p_idpersonal,p_cedula,p_nombre,p_idsesion,p_password_changed,p_mail_alternativo,p_error , p_fecha From  esq_roles.fnc_roles(?,?,?)',$datos);
        //echo $this->db_user->last_query();
        return $res->row_array();
    }

    public function GetFotoUser($id_personal){
       $res = $this->db->query("select esq_ficheros.fichero_hoja_vida.archivo_bin  as foto FROM esq_ficheros.fichero_hoja_vida WHERE esq_ficheros.fichero_hoja_vida.idpersonal_propietario = ? AND esq_ficheros.fichero_hoja_vida.idtipo_documento=3",$id_personal);
       //echo $this->db_user->last_query();
       return $res->row_array();
    }
}