<?php
/** 
 * Configuración general del Script
 * Cofiguramos datos de conexión al servidor MYSQL
 * @File: config.php
*/
// Evitamos el acceso directo al archivo
if(!defined('HEADER')) header('Location: /');
$heroku_db = array();
$heroku_db['host'] = empty(getenv('CLEARDB_DATABASE_URL')) ? null : 'us-cdbr-iron-east-02.cleardb.net';
$heroku_db['user'] = empty(getenv('CLEARDB_DATABASE_URL')) ? null : 'b24319fc3c1915';
$heroku_db['pass'] = empty(getenv('CLEARDB_DATABASE_URL')) ? null : '517775e7';
$heroku_db['name'] = empty(getenv('CLEARDB_DATABASE_URL')) ? null : 'heroku_edd8f89c43cb5d5';

/** Confurar datos de conexón **/
$db = array();
/* Nombre del Servidor de MySQL */
$db['host'] = empty ($heroku_db['host']) ? 'localhost' : $heroku_db['host'];
/* Tu nombre de usuario de MySQL */
$db['user'] = empty ($heroku_db['user']) ? 'root' : $heroku_db['user'];
/* Tu contraseña de MySQL */
$db['pass'] = empty ($heroku_db['pass']) ? '' : $heroku_db['pass'];
/* El nombre de tu base de datos */
$db['name'] = empty ($heroku_db['name']) ? 'askme' : $heroku_db['name'];
//Conexión persistente
$db['persist'] = true;

// ZONA HORARIA / CIUDAD DE MÉXICO
date_default_timezone_set('America/Mexico_City');

//Cambiamos el tiempo limite de ejecución del script
set_time_limit(300);

//Incluimos configuraciones para la web
require('settings.php');
?>