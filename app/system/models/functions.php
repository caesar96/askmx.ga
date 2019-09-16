<?php
/*
 * Obtener los datos de la ubicacion del usuario mediante esta funcion ayudandonos
 * con la API que nos ofrece infodb
 * @param string IP
 * @return ARRAY
*/
function user_geo($ip){
	/* OBTENEMOS LA LOCALIZACION DEL USUARIO MEDIANTTE LA API DE iPInfoDB*
	$data = file_get_contents('http://api.ipinfodb.com/v3/ip-city/?key=a03bc55c8d1a9008c8331f83c36802d32fa3286cdd372e2c1bb46c3d5049279b&ip='.$ip.'&format=JSON');
	/* DECODIFICAMOS EL STRING EN FORMATO JSON CON json_decode() *
	$data = json_decode($data, true);
	/* VERIFICAMOS SI TODO HA SALIDO BIEN *
	if($data['statusCode'] == 'Ok' && $data['countryCode'] != '-')
	{
		//RE ASIGNAMOS VARIABLES
		$result['code'] = $data['countryCode'];
		$result['country'] = ucwords(strtolower($data['countryName']));
		$result['state'] = ucwords(strtolower($data['regionName']));
		$result['city'] = ucwords(strtolower($data['cityName']));
		//REGRESAMOS DATOS
		return $result;
	}*/
	return false;
}
/**
 * @ Muestra la IP verdadera del usuario
 * @ paramns
 * @ return (float)
*/
function getIP(){
    if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
            $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($addr[0]);
        } else {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
/**
 * @ Filtra las variables usadas en alguna consulta SQL
 * @ paramns string
 * @ return (string)
*/
function mkSecure($string){
	global $mysqli;
	$string = strip_tags($string);
	return $mysqli->real_escape_string(function_exists('magic_quotes_gpc') ? stripslashes($string) : $string);
}
function UserAge($day, $month, $year){
	$current = array();
	$current['day'] = date('d');
	$current['month'] = date('m');
	$current['year'] = date('Y');
	return ($month.$day > $current['month'].$current['day']) ? ($current['year'] - $year) : ($current['year'] - $year) - 1;
}

function parseURL($url){
	global $settings;
	/*if(preg_match("/(chrome|ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/", $url))
	$url = preg_replace("#http://)([A-z0-9./-]+)#", '<a class="link-blue" target="_blank" rel="nofollow" href="http:\/\/$1">$0</a><br />', $url);
	/*return $url;*/
	if (preg_match("/(\s#[^\s]+)/i", $url))
		$url = preg_replace("/(\s#[^\s]+)/i", ' <a target=\"_blank\"  href="'.$settings['url'].'/search?q=$1">$0</a>', $url);
	if ( preg_match("/(\s@[^\s]+)/i", $url) )
		$url = preg_replace("/(\s@[^\s]+)/i", ' <a target=\"_blank\"  href="'.$settings['url'].'/$1">$0</a><br>', $url);
	$url = preg_replace("/((chrome|http|https|www)[^\s]+)/i", ' <a target="_blank" href="$1">$0</a><br>', $url);
	$url = preg_replace("/href=\"www/i", 'href="http://www', $url);
    return $url;
}
/* OBTENER LA FECHA EN LA QUE SE REALIZO O SE CREO ALGUNA FRASE */
function fechaHace($fecha, $show = false) {
	$ahora = time();
	$tiempo = $ahora - $fecha;
	//
	$dias = round($tiempo / 86400);
	// HOY
	if($dias <= 0) {
		// HACE MENOS DE 1 HORA
		if(round($tiempo / 3600) <= 0){
			// HACE MENOS DE 1 MINUTO
			if(round($tiempo / 60) <= 0){
				if($tiempo <= 60){ $hace = "Hace unos segundos"; }
			// HACE X MINUTOS
			} else  {
				$can = round($tiempo / 60);
				if($can <= 1) {    $word = "minuto"; } else { $word = "minutos"; }
				$hace = 'Hace '.$can. " ".$word;
			}
		// HACE X HORAS
		} else {
			$can = round($tiempo / 3600);
			if($can <= 1) {    $word = "hora."; } else {    $word = "horas"; }
			$hace = 'Hace '.$can. " ".$word;
		}
	}
	// MENOS DE 7 DIAS
	else if($dias <= 30){
		// AYER
		if($dias < 2){
			$hace = 'Ayer';
		// HACE MENOS DE 5 DIAS
		} else {
			$hace = 'Hace '.$dias.' d&iacute;as';
		}
	// HACE MAS DE UNA SEMANA
	} else{
		$meses = round($tiempo / 2592000);
		if($meses == 1) $hace = 'Hace 1 mes';
		elseif($meses < 12) {
			$hace = 'Hace m&aacute;s de '.$meses.' meses';
		} else {
			$anos = round($tiempo / 31536000);
			if($anos == 1) $hace = 'Hace 1 a&ntilde;o.';
			else $hace = 'Hace m&aacute;s de '.$anos.' a&ntilde;os';
		}
	}
	//
	return $hace;
}
function visitor_wait($question){
	global $quest, $settings;
	//CREMOS UNA COOKIE CON LA CUAL CONTROLAREMOS EL ENVIO DE PREGUNTAS SI NO EXISTE
	if(empty($_COOKIE['last_quest'])){
		//OBETENER DOMINIO/SUBDOMINIO
		$domain = parse_url($settings['url']);
		$domain = str_replace('www.', '' , strtolower($domain['host']));
		$domain = ($domain == 'localhost') ? '' : '.' . $domain;
		//ESTABLECEMOS LA COOKIE
		setcookie('last_quest', time(), (time() + 60), '/', $domain);
		//ENVIAMOS DATOS
		return $quest->SendQuest($question);
	} else {
		if( ( $_COOKIE['last_quest'] + 60 ) > time() ){
			return json_encode(array( 'error' => 'Espera 1 minuto para volver a preguntar' ));
		}
	}
}
/*
 * @ Muestra una plantilla HTML (template)
 * @ params page
 * @ return HTML content
*/
function getHTML($user, $page, $ajax = false){
	global $settings;
	/* LEER NOTIFICACIONES EN DETERMINADA PAGINA */
	if ( $page == 'questions' ) {
		$user->readNotify(1);
		$user->notifications['quest'] = 0;
	}
	/* TITULO DE LA PAGINA */
	$contador = 0;
	if ( !empty( $user->notifications['quest'] ) ){
		$contador = $user->notifications['quest'];
	}
	if(!empty($user->notifications['answer'])){
		$contador += $user->notifications['answer'];
	}
	$contador = !empty( $contador) ?  '(' .$contador . ') ': '';
	$title = ($user->is_member) ? $contador . $settings['titulo']  : $settings['titulo'] . ' | ' . $settings['slogan'];
	/* EXTRAER INFORMACIÓN DEL PERFIL DEL USUARIO PARA ESTAS PAGINAS */
	if
	(
		$page == 'optional' || 
		$page == 'perfil'	||
		$page == 'wall'		|| 
		$page == 'home'		||
		$page == 'popular'	|| 
		$page == 'settings'	||
		$page == 'questions'
	)
	{
		/* ID DE LA SESION ACTUAL O EL NOMBRE DE USUARIO OBTENIDO POR $_GET */
		$type = empty($_GET['u_name']) ? $user->id : $_GET['u_name'];
		
		/* DATOS DEL PERFIL */
		$data = $user->getProfile($type);
		
		/* CONFIGURAMOS OPCIONES DE PRIVACIDAD */
		if($page == 'settings' || $page == 'perfil'){
			if(!empty($data)){
				$data['anon_quest'] = empty($data['anon_quest']) ? 0 : 1;
				$data['notify'] = empty($data['notify_email']) ? 0 : unserialize($data['notify_email']);
				$data['show_answers'] = empty($data['show_own_answers']) ? 0 : $data['show_own_answers'];
				unset($data['notify_email'], $data['show_own_answers']);
			}
		}
	}
	//SI EXISTE LA PLANTILLA CON EL NOMBRE DE LA PAGINA MOSTRAMOS EL TEMPLATE
	$template = HTML . $page. '.php';
	if( file_exists( $template ) )
	{
		/* SI LA WEB SE ENCUENTRA EN MANTENIMIENTO */
		if($settings['offline']['status'] == 1){
			//ELIMINMOS OBJETO USER
			unset($user);
			if($page == 'templates' || $ajax == true){echo '<script>window.location.href="/";</script><h3 style="padding:20px;">Sitio Web en mantenimiento</h3>';exit();}
			//INCLUIMOS EL ARCHIVO PHP/HTML
			require(HTML . 'mntn.php');
		}
		//SI NO LO ESTA
		else
		{
			//INCLUIMOS EL ARCHIVO PHP/HTML
			if($user->is_member && ($page == 'home' || $page == 'signup'))
			{
				require(HTML . 'wall.php');
			}
			elseif(!$user->is_member && ($page == 'wall')){
				require(HTML . 'home.php');
			}
			else
			{
				require($template);
			}
		}
	}
	//EL ARCHIVO NO EXISTE MOSTRAMOS UNA PAGINA DE ERROR 404 
	else
	{
		if( file_exists(HTML . '404.php') )
			require(HTML . '404.php');
		else
			echo '<h1>Error al cargar la plantilla...</h1>';
	}
	//VACIAMOS DATOS QUE YA NO USAREMOS
	unset($page, $template, $data);
}
?>