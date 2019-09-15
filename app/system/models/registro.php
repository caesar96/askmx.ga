<?php
/*
 * @Registro Class
 * Contiene todos los metodos para el correcto registro del usuario
*/
class SIGNUP {
	
	/*
	 * submit
	 * @params type
	 * @return json string
	*/
	public function submit ( $users ) {
		global $user, $mysqli;
		if ( !empty( $users ) )
		{
			$message = array();
			//Array que almacena los datos del usuario;
			$users = array
			(
				'nick' => mkSecure($users['nick']),
				'name' => mkSecure($users['name']),
				'pass' => mkSecure($users['pass']),
				'pass1' => $users['pass1'],
				'email' => mkSecure($users['email']),
				'day' => (int) $users['day'], 'month' => (int) $users['month'], 'year' => (int) $users['year'],
				'date' => time(),
				'lang' => (int) $users['lang']
			);
			// Comprobamos que el usuario a llenado todos los datos requeridos
			foreach( $users as $k => $v  )
			{
				$users[$k] = (urldecode($users[$k]));
				//Si esta vacio algun campo retornamos un mensaje de aviso :)
				if( empty( $v ) || strlen( $v ) < 1 ){
					//Almacenamos el mensaje en el array $message
					$message['error'] = 'El campo "'.$this->fieldname($k).'" está vacío';
					$message['data'] = 0;
					$message['field'] = $k;
					//retornamos un objeto json
					return json_encode($message);
				}
			}
			$users['born'] = array('day' => $users['day'], 'month' => $users['month'], 'year' => $users['year']);
			foreach($users['born'] as $k => $v){
				if(empty($v) || !is_numeric($v)){
					return json_encode(array('error' => 'La fecha no es valida', 'data' => 0));
				}
			}
			//SOLO PERSONAS MAYORES A 13 AÑOS, SI NO, NO
			if(UserAge($users['day'], $users['month'], $users['year']) < 13 ){
				return json_encode(array('error' => 'No se pueden registrar niños menores a 13 años, lo siento niño.', 'data' => 0));
			}
			$_GET['data'] = $users['nick'];
			if(!$this->checkUserEmail(true)){
				return json_encode(array('error' => 'El nombre de usuario ya existe', 'data' => 0));
			}
			if(!$this->valid_user($users['nick'])){
				return json_encode(array('error' => 'El nombre de usuario no es valído', 'data' => 0));
			}
			if(!$this->valid_name($users['name'])){
				return json_encode(array('error' => 'El nombre de perfil no es valido.', 'data' => 0));	
			}
			$_GET['data'] = $users['email'];
			if(!$this->valida_email($users['email'])){
				return json_encode(array('error' => 'El Correo electrónico no es valido', 'data' => 0));
			}
			if(!$this->checkUserEmail(true)){
				return json_encode(array('error' => 'El Correo electrónico ya existe', 'data' => 0));
			}
			if($users['pass'] != $users['pass1']){
				return json_encode(array('error' => 'Las contraseñas no coinciden', 'data' => 0));
			}
			$users['pass'] = md5(md5(strtolower($users['nick'])).md5($users['pass']));
			$users['key'] = md5(md5(mt_rand()).md5(mt_rand()));
			$sql = 'INSERT INTO  members (u_nick, u_pass, u_email, u_date, u_ip, u_key) VALUES (\''.$users['nick'].'\',  \''.$users['pass'].'\',  \''.$users['email'].'\',  \''.$users['date'].'\',  \''.getIP().'\', \''.$users['key'].'\');';
			$sqll = 'INSERT INTO profile (p_name, p_day, p_month, p_year, p_lang) VALUES (\''.$users['name'].'\',  \''.$users['day'].'\',  \''.$users['month'].'\',  \''.$users['year'].'\',  \''.$users['lang'].'\');';
			if($mysqli->query($sql) && $mysqli->query($sqll))
			{
				$id = $user->ID_NAME($users['nick']);
				//ACTUALIZAMOS LA SESSION
				$user->session->update($id, false, true);
                //CARGAMOS INFO DEL USUARIO
				$user->load_user(true);
				//vaciamos variables
				unset($users, $sql, $sqll, $id);
				return json_encode(array('error' => '', 'data' => 1));
			}
			else
			{
				return json_encode(array('error' => 'Hubo un error al ingresar los datos: '. $mysqli->error, 'data' => 0));
			}
		}
	}
	/*
	 * checkusersEmail();
	 * Comprobamos si el Nick o el E-mail ya están registrados
	 * @ params none
	 * @ return (bool)||(string JSON)
	*/
	public function checkUserEmail($submit = false)
	{
		global $mysqli;
		// FILTRAMOS DATOS EN $data
		$data = urldecode(mkSecure($_GET['data']));
		if(empty($data)) return false;
		// HACEMOS UNA CONSULTA PARA SABER SI HAY UN REGISTRO 
		$query = $mysqli->query('SELECT u_nick FROM members WHERE LOWER(u_nick) = \''.$data.'\' OR LOWER(u_email) = \''.$data.'\' LIMIT 0,1 ');
		//SI HAY UN REGISTRO, EL USUARIO O E-MAIL EXISTE, DEVOLVEMOS STRING JSON
		if($query->num_rows > 0) {
			if($submit == true)	return false;
			return json_encode(array('error' => 1, 'message' => 'Ya existe'));
		} else {
			return json_encode(array('error' => 0, 'data' => $data));
		}
	}
	private function fieldname($field){
		$fields = array(
			'nick' => 'Nombre de usuario',
			'name' => 'Nombre y apellidos',
			'pass1' => 'Repetir contraseña',
			'pass' => 'Contraseña',
			'email' => 'Correo electrónico',
			'day' => 'Día',
			'month' => 'Mes',
			'year' => 'Año',
			'lang' => 'Idioma'
		);
		foreach($fields as $k => $v){
			$field = str_replace($k, $v, $field);
		}
		return $field;
	
	}
	//VERIFICAMOS EL FORMATO DE EMAIL
	public function valida_email($mail)
	{
		return(preg_match('/(\w+)@(\w+)\.\w\w\w?/',$mail)) ? true : false;
	}
	//VERIFICAR EL NOMBRE DE USUARIO
	public function valid_user($name)
	{
		if(strlen($name) == 0){
			return false;
		} elseif(strlen($name) < 4 || strlen($name) > 16){
			return false;
		} elseif(!preg_match("/([a-zA-Z]+)/", $name)){
			return false;
		} elseif(!preg_match("/^[-_a-zA-Z0-9]{4,16}$/", $name)){
			return false;
		} else {
			return true;
		}
	}
	public function valid_name($name){
		if(isset($name)){
			$reg = '/^[\sa-zá-úñ]{2,30}$/i';
			if(strlen($name) == 0){
				return false;
			} elseif(preg_match($reg, $name) === false){
				return false;
			} elseif(strlen($name) < 4 || strlen($name) > 30){
				return false;
			} else{
				return true;
			}			
		}
	}
	public function valid_pass($pass){
		if(isset($pass)){
			$reg = '/^[^"\']{6,20}$/';
			if(strlen($pass) == 0){
				return false;
			} elseif(preg_match($reg, $pass) === false){
				return false;
			} elseif(strlen($pass) < 6 || strlen($pass) > 20){
				return false;
			} else{
				return true;
			}			
		}
	}

}
?>