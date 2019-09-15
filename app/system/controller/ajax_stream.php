<?php
/*
 * -> ESTABLECEMOS UN CONEXIÓN PERSISTENTE HACIENDO EL MINIMO DE SOLICITUDES
*/
/* SI EL USUARIO ES MIEMBRO, CONTINUAMOS */
if($user->is_member){
	//NOTIFICACIONES
	$n = array();
	$n['questions'] = $user->notifications['quest'];//TOTAL DE PREGUNTAS NUEVAS
	$n['answers'] = $user->notifications['answer'];//TOTAL DE RESPUESTAS NUEVAS
	//DATOS ANTIGUOS QUE NOS ENVIARA EL CLIENTE
	$last = array(
		'last_quests' => (empty($_GET['last_quests'])) ? 0 : $_GET['last_quests'],
		'last_answers' => (empty($_GET['last_answers'])) ? 0 : $_GET['last_answers'],
	);
	//CONEXION PERSISTENTE
	if(!empty($_GET['stream'])){
		//TIEMPO DE RESPUESTA (0)
		set_time_limit(0);
		//HACEMOS UN BUCLE "INFINITO" SOLO SI NUNGUN VALOR HA CAMBIADO
		while 
		(
			($n['questions'] == $last['last_quests']) 
			&& 
			($n['answers'] == $last['last_answers']) 
		)
		{
			sleep(10);// HACEMOS DESCANSAR POR 10 SEGUNDOS AL CPU
			clearstatcache();
			$n['questions'] = $user->getNotify(1);
			$n['answers'] = $user->getNotify(2);
			ob_flush();
			flush();
			//
		}
		//SI NO SE HAN DEFINIDO O ESTAN VACIAS
		$n['questions'] = empty($n['questions']) ? 0: $n['questions'];
		$n['answers'] = empty($n['answers']) ? 0 : $n['answers'];
		$n['is_member'] = true;
		// RETORNAMOS VALORES QUE SE ENCUENTRAN EN EL ARREGLO
		echo json_encode($n);
	}
}
/* NO ES MIEMBRO, DEVOLVEMOS VALOR Y CERRAMOS CONEXION */
else {
	echo json_encode(array('is_member' => false));
}

?>