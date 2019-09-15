<?php

class QUESTION {

	public function __construct(){}
	
	//SEND
	public function SendQuest($quest){
		//OBJETO USER
		global $user, $mysqli;
		//
		//SI SE HAN ENVIADO LOS DATOS 
		if ( !empty( $quest['question'] ) && !empty ( $quest['id'] ) ) 
		{
			//ID DEL USUARIO 
			$quest['id'] = mkSecure($quest['id']);
			$last = $user->getProfile($user->id);
			$last = $last['last_quest'];
			if( ($last+60) > time() ){
				return json_encode(array( 'error' => 'Espera 1 minuto para volver a preguntar' ));
			}
			unset($last);
			//BUSCAMOS AL USUARIO AL QUE SE LE HARA LA PREGUNTA
			$query = $mysqli->query( 'SELECT m.u_id, p.anon_quest FROM members m, profile p WHERE m.u_id = \''.$quest['id'].'\' AND p.p_id = m.u_id AND m.u_active = 1 LIMIT 0,1' );
			$e = $query->fetch_assoc();
			//SI NO EXISTE EL USUARIO MOSTRAMOS MENSAJE DE ERROR
			if(empty($e))
				return json_encode(array( 'error' => 'No existe el usuario al que quieres preguntar' ));

			/**** SI LLEGAMOS HASTA A AQUI, EL USUARIO EXISTE ****/
			
			//VERIFICAMOS SI TIENE PERMITIDO PREGUNTAS ANONIMAS
			if(empty($e['anon_quest']) && $user->is_member == false){
				return json_encode(array( 'error' => 'El usuario no permite preguntas anonimas' ));
			}
			
			//SI LA PREGUNTA SUPERA LOS 300 CARACTERES AVISAMOS
			if(strlen($quest['question']) > 300)
				return json_encode(array( 'error' => 'La pregunta no puede superar los 300 caracteres' ));
			elseif(preg_match('/^\s+$/', $quest['question']))
				return json_encode(array( 'error' => 'Llena correctamente el campo' ));
			//PREGUNTA ANONIMA
			$quest['anon'] = (empty($quest['anon']) || empty($e['anon_quest'])) ? 0 : 1;
			//FILTRAMOS DATOS
			$quest['question'] = trim(htmlentities(mkSecure($quest['question'])));
			
			//SI EL USUARIO NO ES MIEMBRO, PONEMOS EL ID DEL QUE PREGUNTA EN 0
			if($user->is_member == false)
				$quest['u_id'] = 0;
			//EL USUARIO SI ES MIEMBRO ASIGNAMOS EL ID DE LA SESION ACTUAL
			else
				$quest['u_id'] = $user->id;
			
			//FECHA EN LA QUE SE ENVIO LA PREGUNTA
			$quest['time'] = time();
			$m = 'El usuario '.$quest['u_id'].' ha preguntado al usuario '.$e['u_id']. ' esto: '. $quest['question'] . ', Anonimamente: '.$quest['anon'];
			//HACEMOS CONSULTA Y COMPROBAMOS QUE HAYA SALIDO BIEN
			if($mysqli->query('INSERT INTO questions (q_uid, q_touid, q_quest, q_date, q_anon) VALUES (\''.$quest['u_id'].'\', \''.$e['u_id'].'\', \''.$quest['question'].'\', \''.$quest['time'].'\', \''.$quest['anon'].'\') '))
			{
				//CREAMOS LA NOTIFICACION
				$user->CreateNotify($quest['u_id'], $e['u_id'], 1);
				//ULTIMA VEZ QUE PREGUNTO, PARA EVITAR FLOOD O SPAM
				$mysqli->query('UPDATE profile SET last_quest = \''.time().'\' WHERE p_id = \''.$user->id.'\' ');
				//REGRESAMOS DATOS EN JSON
				return json_encode(array('success' => $m));
			}
			else
			{
				return json_encode(array('error' => 'Ha ocurrido un error'));
			}
		}
		else
		{
			return json_encode(array( 'error' => 'Faltan datos' ));
		}
	}
	public function response_quest($answer)
	{
		global $user, $mysqli;
		//
		if(empty($answer))
			return json_encode(array( 'error' => 'Hubo un error' ));
		//
		if(strlen($answer['content']) < 1  || preg_match('/^\s+$/', $answer['content']))
			return json_encode(array( 'error' => 'Introduce una respuesta' ));
		//
		//VERIFICAMOS QUE EXISTA LA PREGUNTA BUSCANDOLA EN LA DB
		if(!empty($answer['quest_id']) && is_numeric($answer['quest_id'])) {
			$query = $mysqli->query('SELECT q_id, q_uid FROM questions WHERE q_id = \''.$answer['quest_id'].'\' AND q_active = 0 LIMIT 0,1');
			$data = $query->fetch_assoc();
			//SI EXISTE CONTINUAMOS
			if(!empty($data['q_id'])) {
				//FILTRAMOS DATOS DE LA PREGUNTA
				$answer['content'] = htmlentities(mkSecure($answer['content']));//CONTENIDO DE LA RESPUESTA
				//ORDENAMOS DATOS
				$answer['q_id'] = $data['q_id'];// ID DE LA PREGUNTA
				$answer['uid'] = $user->id;// ID DEL USUARIO QUE RESPONDE
				$answer['date'] = time();//FECHA EN LA QUE RESPONDIO
				//ENVIAMOS A LA DB Y COMPROBAMOS QUE SE HAYA GUARDADO
				if($mysqli->query('INSERT INTO answers (a_qid, a_uid, a_content, a_date) VALUES (\''.$answer['q_id'].'\', \''.$answer['uid'].'\', \''.$answer['content'].'\', \''.$answer['date'].'\')'))
				{
					//EXTRAEMOS EL ID DE LA RESPUESTA MEDIANTE EL ID DE LA PREGUNTA
					$q = $mysqli->query('SELECT a_id FROM answers WHERE a_qid = \''.$answer['q_id'].'\' LIMIT 0,1');
					$q = $q->fetch_assoc();
					if(empty($q['a_id'])) $q['a_id'] = 0;
					//CREAMOS NOTIFICACION
					$user->CreateNotify($answer['uid'], $data['q_uid'], 2, $q['a_id']);
					//ACTIVAMOS LA PREGUNTA
					$mysqli->query('UPDATE questions SET q_active = 1 WHERE q_id = \''.$answer['quest_id'].'\' ');
					return json_encode(array('success' => 1));
				}
				else return json_encode(array('error' => 'Ocurrió un error al enviar la respuesta'));
			}
			//NO EXISTE AVISAMOS AL USUARIO
			else
				return json_encode(array('error' => 'No existe la pregunta ('.$answer['quest_id'].')'));
		}
		else 
			return json_encode(array('error' => 'No se ha seleccionado ninguna pregunta.'));
	}


}
?>