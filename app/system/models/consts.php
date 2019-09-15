<?php
/*
 * Definimos constantes para interactuar a lo largo del script y obtener facil acceso en nuestro caso
 * a directorios especificos tales como "web", "mobile" que son los que contendran las plantillas 
 * necesarias para que sea posible la visualización en nuestra aplicación.
*/

// DIRECYORIO "ROOT" (RAIZ SYSTEM)
define( 'ROOT', str_replace('\\', '/', realpath(dirname(dirname( __FILE__ ))).'/') );

// DIRECOTORIO "MODELS" (MODELOS DE LA APLICACION)
define( 'MODELS', ROOT . 'models/' );

// DIRECOTRIO "VIEWS" (CONTENIDO VISUAL DE LA APLICACION, HTML)
define( 'VIEWS', ROOT . 'views/' );

// DIRECTORIO "CONTROLLER" (MANEJADORES DE TODAS LAS SOLICITUDES)
define( 'CONTROLLER', ROOT . 'controller/' );

// DIRECTORIO "HTML" (ALMACENAMIENTO DE PLANTILLAS WEB/MOBILE)
define( 'HTML', ROOT . 'views/'. is_mobile_web() . '/' );

// DIRECTORIO "IMG" (IMG)
define( 'UPLOAD', dirname(ROOT).'/img/');

// DIRECTORIO "IMG" (IMG)
define( 'THUMB', dirname(ROOT).'/img/thumb/');

// DIRECTORIO "IMG" (IMG)
define( 'TMP', dirname(ROOT).'/img/TMP/');

//BACKGROUNDS
define( 'BACKGROUND', UPLOAD . 'b/');

//AVATARES
define( 'AVATAR', UPLOAD . 'a/');

define('HEADER', true);


/* Saber si nevgamos en un dispositivo movil o desk browser */
function is_mobile_web(){
	return (preg_match('/(android|blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera mobi|Googlebot-Mobile|googlebot-mobile|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', $_SERVER['HTTP_USER_AGENT'])) ? 'mobile' : 'web';
}
?>