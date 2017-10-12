<?php
/**
 * Created by PhpStorm.
 * User: cgerm
 * Date: 26/9/2017
 * Time: 12:22
 */

class Seguridad{
    protected static $magic_quotes_gpc =false;
    protected static $raiz_aplicacion  ="";
    protected static $ruta_tmp         ="";
    protected static $ruta_logo      = "";
    protected static $nom_aplicacion = "";
    protected static $datos_equipo   = array();
    protected static $mail_sender    = "SGA-UTM <sga@utm.edu.ec>";


    public static function setDatosEquipo(){
        if ($_SERVER) {
            if(getenv('HTTP_X_FORWARDED_FOR')){
                $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            }elseif (getenv("HTTP_CLIENT_IP")) {
                $ip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $ip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
                $ip = getenv( 'HTTP_X_FORWARDED_FOR' );
            } elseif ( getenv( 'HTTP_CLIENT_IP' ) ) {
                $ip = getenv( 'HTTP_CLIENT_IP' );
            } else {
                $ip = getenv( 'REMOTE_ADDR' );
            }
        }

        //La variable información contendra los datos que trae la cabecera
        // 'HTTP_USER_AGENT', como lo son navegador y su versión, ademas del
        //sistema operativo
        $informacion = $_SERVER['HTTP_USER_AGENT'];
        //Si no se encuentran coincidencias se mostraran los valores
        //de las variables que estan puestos por defecto (los que siguen)
        $navegador = 'Desconocido';
        $version= "";
        $SO = 'Desconocido';
        //Obtenemos el puerto por el cual el cliente esta conectado a nuestro servidor
        $puerto = $_SERVER['REMOTE_PORT'];

        /* Ahora averiguamos el nombre del navegador*/
        //Lo que hacemos es comparar los nombres de los navegadores
        //con la información de la cabecera HTTP_USER_AGENT, y cuando haya una
        //coincidencia guardar la variable.
        if(preg_match('/MSIE/i',$informacion) && !preg_match('/Opera/i',$informacion))
        {
            $navegador = 'Internet Explorer';
            $n_navegador = "MSIE";
        }
        elseif(preg_match('/Firefox/i',$informacion))
        {
            $navegador = 'Mozilla Firefox';
            $n_navegador = "Firefox";
        }
        elseif(preg_match('/Chrome/i',$informacion))
        {
            $navegador = 'Google Chrome';
            $n_navegador = "Chrome";
        }
        elseif(preg_match('/Safari/i',$informacion))
        {
            $navegador = 'Apple Safari';
            $n_navegador = "Safari";
        }
        elseif(preg_match('/Opera/i',$informacion))
        {
            $navegador = 'Opera';
            $n_navegador = "Opera";
        }
        elseif(preg_match('/Netscape/i',$informacion))
        {
            $navegador = 'Netscape';
            $n_navegador = "Netscape";
        }

        // Finalmente obtenemos la versión del navegador
        //Esto es una expresión regular que no explicare...apenas y la entiendo yo
        $patron = '#(?<browser>' . $n_navegador .')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($patron, $informacion, $busqueda)) {
            // aun no tenemos el número correcto, solo continuamos
        }

        // Contamos cuantos números tenemos de la versión
        $i = count($busqueda['browser']);
        if ($i != 1) {
            //comprobamos en que posición del array esta la versión
            if (strripos($informacion,"version") < strripos($informacion,$n_navegador)){
                $version= $busqueda['version'][0];
            }
            else {
                $version= $busqueda['version'][1];
            }
        }
        else {
            $version= $busqueda['version'][0];
        }

        // Comprobamos si tenemos un número
        if ($version==null || $version=="") {
            $version="???";
        }

        //Obtenemos el sistema operativo
        if (preg_match('/linux/i', $informacion)) {
            $SO = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $informacion)) {
            $SO = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $informacion)) {
            $SO = 'Windows';
        }
        //Asignamos un valor a cada variable dentro del array
        return array(
                'equipo'    => gethostbyaddr($_SERVER['REMOTE_ADDR']),
                'SO'  	    => $SO,
                'direccion_ip' => $ip,
                'navegador' => $navegador,
                'version'   => $version,
                'puerto'    => $puerto
        );

    }
}