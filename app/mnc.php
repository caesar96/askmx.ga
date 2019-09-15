<?php
/*
 * => Este archivo contiene sentencias de configuracion hechas a modo que la aplicación
 * funcione correctamente, en este archivo tendrá que ser modificado en lo más minimo si 
 * no desea inestabilidad en su sitio.
*/

//INCLUDE CONSTANTS
require( './system/models/consts.php' );

//INCLUDE SETTINGS
require( MODELS. 'config.php' );

// INCLUDE DB
require( MODELS. 'db.php' );

//INCLUDE FUNCTIONS
require( MODELS. 'functions.php' );

//
require( MODELS. 'users.php');

// Creamos el objeto user
$user = USERS::getInstance();

//REQUEST PAGE
$page = empty( $_GET['do'] ) ? 'home' :  str_replace(array('..', '/', 'http://', 'header','footer'), '', $_GET['do']);

//SI AJAX ES TRUE, MOSTRAMOS SOLO CONTENIDO Y NO CABECERAS 
$ajax = (empty($_POST['ajax']))? false : true;

//SI SHOW NO ESTA DEFINIDO MOSTRAMOS PAGINAS EN HTML
if(empty($show)) getHTML( $user, $page, $ajax );
?>