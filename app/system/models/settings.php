<?php
/**
 * => Configuraciones generales del Sitio *
 * => Almacenamos los datos en un array *
**/
$settings = array();
$settings['version'] = '0.1';
$settings['titulo'] = 'AskMe!';
$settings['slogan'] = 'Pregunta y responde....';
$settings['description'] = 'Pregunta y responde. ¡Encuentra a personas que quieren saber más de ti!';
$settings['keywords'] = 'ask, preguntas, personal, facebook, twitter, tumblr, instagram, hipster, gamner, geek';
$settings['url'] = 'https://'.$_SERVER['HTTP_HOST'];
$settings['email'] = 'webmaster@askm.com.ar';
$settings['offline'] = array();
$settings['offline']['status'] = (int) 0;
$settings['offline']['message'] = 'Hola, estamos realizando unas mejoras al sistema.<br />Por esta razón el sitio estará en mantenimiento por unos días.<br />Te sugerimos volver en unas horas.';
$settings['source_url'] = 'https://'.$_SERVER['HTTP_HOST'].'/resources';
$settings['local_img'] = $settings['url'].'/img/';
//
?>