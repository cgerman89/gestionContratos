<?php
/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 3/10/2017
 * Time: 21:15
 */

class ayuda_helper{
    protected static $CI;

    public static function Usuario(){
        $CI = & get_instance();
        $res = $CI->session->userdata('nombres');
        return $res;
    }

}