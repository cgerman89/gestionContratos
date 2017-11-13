<?php
/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 7/11/2017
 * Time: 15:13
 */

class Carga_pdf {
    protected static $CI;

    public static function Hoja_Vida($id){
        $CI= & get_instance();
        $CI->load->model('mRectorado');
        $data = $CI->mRectorado->Hoja_vida($id);
        $data2 = $CI->mRectorado->Hoja_vida2($id);
        $data3 = $CI->mRectorado->Hoja_vida3($id);
        $data4 = $CI->mRectorado->Hoja_vida4($id);
        $data5 = $CI->mRectorado->Hoja_vida5($id);

        $var['datos_personales']=$data;
        $var['instruccion_formal']=$data2;
        $var['capacitaciones']=$data3;
        $var['publicaciones']=$data4;
        $var['experiencia']=$data5;
        $var['id'] = $id;

        //$this->load->view('pdfs/Hoja_vida_pdf', $var, true);
        $html=$CI->load->view('pdfs/Hoja_vida_pdf', $var, true);
        //load mPDF library
        $CI->load->library('m_pdf');
        //$siteaddressAPI = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css";
        //$data = file_get_contents($siteaddressAPI);
        $hoy=date("dmyhis");
        //$data = file_get_contents('././public/css/bootstrap.css');
        $CI->m_pdf->pdf->setFooter('Sistema de Gesion de Contratos SGC - {PAGENO} de {nbpg}');
        $CI->m_pdf->pdf->writeHTML($data, 1);
        //$this->m_pdf->pdf->SetWatermarkImage('https://upload.wikimedia.org/wikipedia/commons/c/ce/Logo_utm_png.png',0.05,'F', array(66,147));
        $CI->m_pdf->pdf->SetWatermarkImage('././public/img/fondo_contrato.png', 0.05,'F', array(66,147));
        //$pdfFilePath = "output_pdf_name.pdf";
        $CI->m_pdf->pdf->showWatermarkImage = true;
        $CI->m_pdf->pdf->WriteHTML($html);
        $CI->m_pdf->pdf->Output('sgc_hv_'.$hoy.'.pdf','I');
    }

}