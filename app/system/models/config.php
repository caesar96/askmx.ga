<?php
/** 
 * Configuración general del Script
 * Cofiguramos datos de conexión al servidor MYSQL
 * @File: config.php
*/
// Evitamos el acceso directo al archivo
if(!defined('HEADER')) header('Location: /');

$heroku_db = parse_url(getenv('CLEARDB_DATABASE_URL'));

/** Confurar datos de conexón **/
$db = array();
/* Nombre del Servidor de MySQL */
$db['host'] = empty ($heroku_db['host']) ? 'localhost' : $heroku_db['host'];
/* Tu nombre de usuario de MySQL */
$db['user'] = empty ($heroku_db['user']) ? 'root' : $heroku_db['user'];
/* Tu contraseña de MySQL */
$db['pass'] = empty ($heroku_db['pass']) ? '' : $heroku_db['pass'];
/* El nombre de tu base de datos */
$db['name'] = empty (ltrim($dbopts["path"],'/')) ? 'askme' : ltrim($dbopts["path"],'/');
//Conexión persistente
$db['persist'] = true;

// ZONA HORARIA / CIUDAD DE MÉXICO
date_default_timezone_set('America/Mexico_City');

//Cambiamos el tiempo limite de ejecución del script
set_time_limit(300);

//Incluimos configuraciones para la web
require('settings.php');
?>