<?php
	//INCLUIR CLASE PARA SUBIDA DE ACHIVOS
	require(MODELS.'class.upload.php');
	//PREGUNTAS
	require(MODELS.'class.question.php');
	//INSTANCIO
	$quest = new QUESTION();
	//CREO EL OBJETO UPLOAD
	$upload = new upload();
	//EJECUTAMOS ACCIONES DEPENDIENDO DEL TIPO DE SOLICITUD
	$_POST['type'] = empty($_POST['type']) ? '': $_POST['type'];
	switch(trim($_POST['type']))
	{
		case 'delet_al':
			echo json_encode(array('success' => $user->delete_notify($_POST['id_al'])));
			break;
		case 'notify_answer':
			echo json_encode($user->getNotify(2, true, true));
			break;
		case 'read-quest':
			//SI NO ES MIEMBRO NO HACEMOS NADA
			if($user->is_member == false) exit();
			//TIPO DE NOTIFICACION
			if(!empty($_POST['type_q']) && is_numeric($_POST['type_q'])){
				echo $user->readNotify($_POST['type_q']);
			}
			else echo false;
			break;
		case 'delet-all':
			if($user->is_member == false) exit();
			echo $user->delete_all($_POST['id']);
			break;
		case 'delet-answer':
			if($user->is_member == false) exit();
			echo $user->delete_answer($_POST['quest_id']);
			break;
		case 'delet-quest':
			if($user->is_member == false) exit();
			echo $user->delete_quest($_POST['quest_id']);
			break;
		case 'submit-answer':
			$answer = array('quest_id' => $_POST['quest_id'], 'content' => $_POST['content']);
			//unset($_POST['quest_id'], $_POST['content']);
			echo $quest->response_quest($answer);
			break;
		case 'submit-quest':
			//SOLO NECESITAMOS ESTO
			$question = array('question' => $_POST['question'], 'anon' => $_POST['anon'], 'id' => $_POST['id']);
			//VACIAMOS YA QUE NO LO UTILIZAREMOS
			unset($_POST['question'], $_POST['anon'], $_POST['id']);
			
			//PARA LOS VISITANTES
			if($user->is_member == false){
				//CONTROL ANTISPAM/FLOOD
				echo visitor_wait($question);
			}
			//ES MIEMBRO
			else {
				//PASAMOS LOS DATOS AL METODO
				echo $quest->SendQuest($question);
			}
			break;
		case 'save-privacy':
			if($user->is_member == false) exit();
			echo $user->savePrivacy($_POST);
			break;
		//ELIMINAR AVATAR
		case 'delet_avatar':
			if($user->is_member == false) exit();
			$avatar = $user->getAvatar('', true);
			if(!empty($avatar['a']) && !empty($avatar['t'])){
				//ENVIAMOS UN RESULTADO
				echo $user->delet_avatar($avatar);
				unset($avatar);
			}
			break;
		//SUBIR AVATAR
		case 'upload_avatar':
			echo $upload->upload_avatar($user->nick);
			break;
		//ELIMINAR EL BACKGROUND SUBIDO
		case 'delet_background':	
			if($user->is_member == false) exit();
			$background = $user->getBackground($user->nick, true);
			if(!empty($background['background']) && !empty($background['thumb'])){
				//ENVIAMOS UN RESULTADO
				echo $user->delet_background($background);
				unset($background);
			}
			break;
		//SUBIR IMAGEN DE FONDO
		case 'upload-background':
			if($user->is_member == false) exit();
			echo $upload->u_background();
			//CORTAR
			break;
			
		//CAMBIAR IMAGEN DE FONDO
		case 'background':
			if($user->is_member == false) exit();
			echo $user->change_background($_POST, $user->id);
			break;
		//MENCIONES
		case 'mentions':
			if($_POST['id']){
				//DESCANSAR POR MEDIO SEGUNDO
				sleep(.9);
				$info = $user->getProfile($_POST['id']);
				if(empty($info)) {echo "<h4>El usuario no existe</h4>";exit();}
				echo json_encode(array(
					'nick' => $info['u_nick'], 
					'name' => $info['p_name'], 
					'geo' => $info['p_geo'], 
					'answers' => $info['t_answer'],
					'avatar' => $info['p_avatar']['t'],
					'id' => $info['u_id']
				));
			}
			break;
		//CERRAR SESION
		case 'salir':
			if(!empty($_POST['salir']))
				echo $user->getOut($_POST['path_url']);
			break;
		//INICIAR SESION
		case 'login':
			echo $user->getLogin($_POST);
			break;
		//GUARDAR DATOS DEL PERFIL
		case 'save-profile':
			//INSTANCIAMOS Y CREAMOS ONJETO $r
			require (MODELS.'registro.php');
			$r = new SIGNUP;
			if($user->is_member == false) exit();
			sleep(1);
			if(!empty($_POST['optional'])){
				echo $user->saveProfile($_POST, true);
			} else echo $user->saveProfile($_POST);
			break;
		//NONE
		default:
			break;
	}

?>