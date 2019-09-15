<?php
	//REQUERIMOS CLASE PARA EL REGISTRO
	require (MODELS.'registro.php');
	//INSTANCIAMOS Y CREAMOS ONJETO $r
	$r = new SIGNUP;
	//FILTRAMOS EL DATO A VALIDAR
	$data = empty($_GET['data']) ?  '' : mkSecure(strip_tags(trim($_GET['data'])));
	//EJECUTAMOS ACCIONES DEPENDIENDO DEL TIPO DE SOLICITUD
	switch(trim($_GET['type']))
	{
		case 'salir':
			if(!empty($_GET['salir']))
				echo $user->getOut($_GET['path_url']);
			break;
		case 'login':
			echo $user->getLogin($_GET);
			break;
		case 'captcha':
			//CAPTCHA
				require(MODELS.'recaptchalib.php');
				$publickey = "6LfIZuQSAAAAAOsVURb-R8kynsuuFeDJZv4RQ2Zu";
				$privatekey = "6LfIZuQSAAAAACH3FZUdklN2zkd6sTcwV-TIFoqi";
				$resp = null;
				$error = null;
				echo recaptcha_get_html($publickey, $error);
			break;
		case 'submit':
			//print_r($_GET['user']);exit();
			echo $r->submit( empty($_GET) ? array() :  $_GET );
			break;
		case 'nick':
			//DEVOLVEMOS MENSAJE
			if($r->valid_user($data)){
				echo $r->checkUserEmail();
			} else {
				echo json_encode(array('error' => 1, 'message' => 'Formato incorrecto'));
			}
			break;
		case 'name':
			//SI EL NOMBRE ES VALIDO MOSTRAMOS ERROR = 0
			if($r->valid_name($data))
				echo json_encode(array('error' => 0));
			//SI NO ES VALUDO MOSTRAMOS ERROR = 1, MESSAGE = STRING
			else
				echo json_encode(array('error' => 1, 'message' => 'Tu nombre y apellidos no son valídos'));
			break;
		case 'pass':
			//SI LA CONTRASEÑA ES VALIDO MOSTRAMOS ERROR = 0
			if($r->valid_pass($data))
				echo json_encode(array('error' => 0));
			//SI NO ES VALUDO MOSTRAMOS ERROR = 1, MESSAGE = STRING
			else
				echo json_encode(array('error' => 1, 'message' => 'La constraseña es incorrecta'));
			break;
		case 'email':
			//SI EL EMAIL ES VALIDO MOSTRAMOS CHECAMOS SI EXISTE EN LA DB
			if($r->valida_email($data))
				echo $r->checkUserEmail();
			//SI NO ES VALUDO MOSTRAMOS ERROR = 1, MESSAGE = STRING
			else
				echo json_encode(array('error' => 1, 'message' => 'Formato de e-mail no valído.'));
			break;
		default:
			break;
	}

?>