<?php
/**
 * Created by PhpStorm.
 * User: HSD
 * Date: 26/10/2017
 * Time: 20:24
 */

class cTalento_humano_as extends CI_Controller{

    private $idusuario=0;
    function __construct(){
        parent::__construct();
        $this->load->model('mTalento_humano_as');
        $this->idusuario=$this->session->userdata('id_personal');
    }
    public function index(){
        if($this->session->userdata('login')=== TRUE){
            if($this->session->userdata('id_tipo_usuario') === '48') {
                $this->load->view('template/head');
                $this->load->view('template/nav');
                $this->load->view('vTalento_humano_as');
                $this->load->view('template/footer');
            }else{
                redirect('/Home');
            }
        }else{
            redirect('/');
        }
    }

    public function GetListAspXAproTHDepto(){
        if ($this->input->is_ajax_request()) {
            $id=$this->input->post('id_cbo_dpto_x_apro_th');
            echo json_encode($this->mTalento_humano_as->getListAspXAproTHDepto($id));
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function GetListAspXAproTHAllDepto(){
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->mTalento_humano_as->getListAspXAproTHAllDepto());
        }else{
            echo show_error('No Tiene Acceso a Esta Url','403', $heading = 'Error de Acceso');
        }
    }

    public function GetListadoDepartamentos(){
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->mTalento_humano_as->getListadoDepartamentos());
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

    public function AprobarSolicitudTH(){
        if ($this->input->is_ajax_request()) {
            $campos = array(
                'idSolcontrato' => $this->input->post('Id_sol_contratoTH'),
                'idpersonal' => $this->idusuario,
                'idcontratado' => $this->input->post('Id_contratado'),
                'idTipoSol' => $this->input->post('Id_tipo_sol')
            );
            $res = $this->mTalento_humano_as->AprobarSolicitudTH($campos);
            echo json_encode($res);
        }else{
            echo show_error('No Tiene Acceso a Esta URL','403', $heading = 'Error de Acceso');
        }
    }

}