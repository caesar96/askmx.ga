<?php
/*
 * @Registro Class
 * Contiene todos los metodos para el correcto registro del usuario
*/
class USERS
{
	public $is_member = false;
	public $nick = 'Visitante';
	public $id = 0;
	public $info = array();
	public $is_banned = 0;
	public $key = 0;
	public $avatar = '';
	public $session;
	public $questions;
	public $notifications;
	private static $instance;
	
	/* INSTANCIAR CLASE*/
	public static function getInstance(){
		if(is_null(self::$instance)){
			self::$instance = new USERS();
		}
		return self::$instance;
	}
	
	/* CONSTRUCTOR DE LA CLASE */
	private function __construct()
	{
		global $settings;
		/* CARGAR SESSION */
		$this->session = new Session();
		if($settings['offline']['status'] == 1)
		{
			$this->session->read();
			$this->session->destroy();
		} 
		else
			$this->loadSession();
	}
	
	
	function loadSession()
    {
        // Si no existe una sessión la creamos
        // si existe la actualizamos...
		if ( ! $this->session->read() )
		{
			$this->session->create();
		}
		else
		{
            // Actualizamos sesión
			$this->session->update();
            // Cargamos información
            $this->load_user();
		}
	}

	/** CARGAR INFO DEL USUARIO **/
	public function load_user($login = false)
	{
		global $mysqli;
		// Cargar datos
		$query = $mysqli->query('SELECT u.*, s.* FROM sessions s, members u WHERE s.s_id = \''.$this->session->ID.'\' AND u.u_id = s.s_uid AND u.u_active = 1 LIMIT 0, 1');
        $this->info = $query->fetch_assoc();
		// Existe el usuario?
        if(empty($this->info['u_id']))
        {
            return FALSE;
        }
		/* ES MIEMBRO */
		$this->is_member = true;
		// NOMBRE
		$this->nick = $this->info['u_nick'];
		$this->id = $this->info['u_id'];
		$this->key = $this->info['u_key'];
		$question = $this->getTotalQuestAnswer($this->id);
		$this->questions = empty($question) ? 0 : $question;
		$this->notifications['quest'] = $this->getNotify(1);
		$this->notifications['answer'] = $this->getNotify(2);
		$this->notifications['likes'] = $this->getNotify(3);
		//
        if($login == true)
        {
            // ACTUALIZAR DATOS
			$mysqli->query('UPDATE members SET u_last_login = \''.$this->session->time_now.'\', u_ip = \''.$this->session->ip_address.'\' WHERE u_id = \''.$this->id.'\'');
        }
		//VACIAMOS EL OBJETO SESSION Y OTROS ELEMENTOS
		unset($this->session, $question, $this->info);
	}
	
	/*
	 * -> Metodo sencillo para eliminar el background
	 * @param array (ruta hacia las imagenes)
	 * return (bool)
	*/
	public function delet_background($dir){
		global $mysqli;
		$id = $this->id;
		if(!empty($dir['background']) && !empty($dir['thumb'])){
			//ELIMINAR FONDO Y THUMB
			unlink($dir['background']);unlink($dir['thumb']);
			//ESTABLECER EN CERO EL CAMPO P_BACKGROUND_U el cual nos indica si se ha subido una imagen
			$mysqli->query('UPDATE profile SET p_background_u = 0 WHERE p_id = \''.$id.'\' ');
			unset($id, $dir);
			return true;
		}
	}
	/*
	 * -> Metodo sencillo para eliminar el background
	 * @param array (ruta hacia las imagenes)
	 * return (bool)
	*/
	public function delet_avatar($dir){
		$id = $this->id;
		if(!empty($dir['t']) && !empty($dir['a'])){
			//ELIMINAR FONDO Y THUMB
			unlink($dir['t']);unlink($dir['a']);
			//PONEMOS EN CERO EL AVATAR EN LA DB
			$this->set_OutAvatar($this->id, false);
			unset($id, $dir);
			return true;
		}
	}
	/*
	 * -> Obtener background
	 * -> Retorna un string con la url del avatar, puede ser la imagen en tamaño completa
	 * -> O una imagen en miniatura
	 * @params (string)
	 * @return array()
	*/
	public function getAvatar($nick, $dir = false)
	{
		global $settings;
		//DATOS A USAR
		$nick = !empty($nick) ? $nick : $this->nick;
		//PREFIJO
		$prefix = 'a_';
		//CREAMOS UN ARREGLO CON LAS EXTENSIONES MAS COUMNES DE IMAGENES
		$ext = array('png', 'jpg', 'jpeg', 'gif', 'bmp');
		//ALMACENAR AVATAR Y THUMB
		$img = array();
		//BUSCAMOS UNA IMAGEN CON SU NOMBRE DE USUARIO
		foreach($ext as $e)
		{
			//SI SE ENCONTRO UNA IMAGEN, ENTONCES ENVIAMOS UNA URL O UNA RUTA DEL DIRECTORIO
			if ( file_exists( THUMB . $prefix . $nick. '.'.$e ) && file_exists( AVATAR . $prefix . $nick. '.'.$e ) )
			{
				//RUTA AL DIRECTORIO INTERNO
				if($dir == true)
				{
					//THUMB
					$img['t'] = THUMB . $prefix . $nick. '.'.$e;
					//AVATAR
					$img['a'] = AVATAR . $prefix . $nick. '.'.$e;
					//Enviar array
					return $img;
				}
				//URL
				else
				{
					//THUMB
					$img['t'] = $settings['local_img'] . 'thumb/' . $prefix . $nick. '.'.$e  . '?' . mt_rand();
					//AVATAR
					$img['a'] = $settings['local_img'] . 'a/' . $prefix . $nick. '.'.$e . '?' . mt_rand();
					//Enviar array
					return $img;				
				}
			}
		}
		//LIBERAR MEMORIA SI NO SE HA ENCONTRADO IMAGEN
		unset($nick, $prefix, $ext, $ruta);
		return false;
	}
	/*
	 * -> Obtener background
	 * -> Retorna un array asociativo con la url del background y de la miniatura
	 * @params (string)
	 * @return array()
	*/
	public function getBackground($nick, $dir = false)
	{
		global $settings;
		// DEFINIMOS DIRECTORIOS
		// DIRECTORIO DE LOS FONDOS
		// DIRECTORIO DE LAS MINIATURAS
		$background_dir = BACKGROUND;
		$thumb_dir = THUMB;
		
		//COMPROBAMOS QUE EXISTAN ESOS DIRECTORIOS, SI EXISTEN CONTINUAMOS
		if ( is_dir ( $background_dir ) &&  is_dir ( $thumb_dir ) )
		{
			//CREAMOS UN ARREGLO CON LAS EXTENSIONES MAS COUMNES DE IMAGENES
			$ext = array('png', 'jpg', 'jpeg', 'gif', 'bmp');
			//COMPROBAMOS QUE EXISTA EL BACKGROUND Y EL THUMBAIL
			foreach($ext as $e)
			{
				if ( file_exists( $background_dir . $nick.'.'.$e ) &&  file_exists( $thumb_dir . $nick.'.'.$e ) )
				{
					//LIBERAMOS MEORIA
					unset($ext);
					if($dir == true)
						return array('background' => $background_dir  . $nick .'.'. $e, 'thumb' => $thumb_dir . $nick.'.'.$e);
					else
						return array('background' => $settings['local_img'] . 'b/' . $nick .'.'. $e, 'thumb' => $settings['local_img'] . 'thumb/' . $nick.'.'.$e);
				}
			}
			return false;
		}
		else
			return array('error' => 'El directorio no existe');
	}
	public function set_OutAvatar($id, $type = 1){
		global $mysqli;
		if(!empty($id)){
			//ESTABLECER / DESESTABLECER
			$set = ($type == true) ? 1 : 0;
			//ESTABLECER EL AVATAR EN 1/TRUE
			$mysqli->query('UPDATE profile SET p_avatar = \''.$set.'\' WHERE p_id = \''.$id.'\' ');
		}
	}
	/*
	 * Obtenemos datos del perfil de un usuario
	 * utilizando su nombre de usuario o su ID
	 * @ params (string|int)
	 * @ return array | bool
	*/
	public function getProfile($value){
		global $mysqli;
		//FILTRAMOS VARIABLE
		$value = mksecure(strip_tags(strtolower($value)));
		//DECLARAMOS VARIABLE
		$text = '';
		//SI EL VALOR INGRESADO ES UN NUMERO, OBTENEMOS DATOS DEL ID
		if(is_numeric($value))
			$text = 'm.u_id = \''.$value.'\' AND p.p_id = m.u_id';
		//SI ES UN STRING OBTENEMOS DATOS DESDE EL NICK
		elseif(is_string($value))
			$text = 'm.u_nick = \''.$value.'\' AND p.p_id = m.u_id';
		//HACEMOS CONSULTA
		$query = $mysqli->query('SELECT m.*, p.* FROM members m, profile p WHERE '.$text.' AND m.u_active = 1 LIMIT 0,1');
		$query = $query->fetch_assoc();
		//SI NO HAY DATOS PARA ESTE PERFIL RETORNAMOS FALSO
		if(empty($query)) return false;
		/* MANEJAMOS DATOS DEL BACKGROUND PARA EVITAR ERRORES */
		$query['p_background'] = !empty($query['p_background']) ? unserialize($query['p_background']) : '';
		$query['p_background']['b_id'] = !empty($query['p_background']['b_id']) ? $query['p_background']['b_id'] : '';
		$query['u_background'] = $this->getBackground($this->nick);
		/* MANEJAMOS DATOS DEL AVATAR */
		$u_avatar = $this->getAvatar($query['u_nick']);
		$query['p_avatar'] = (empty( $query['p_avatar']) || empty($u_avatar) ) ? array('t' => 'https://i.imgur.com/HSmdSGH.jpg', 'a' => 'https://i.imgur.com/HSmdSGH.jpg') : $u_avatar;
		//VACIAMOS LA VARIABLE PARA LIBERAR MEMORIA
		unset($u_avatar, $_GET['u_name']);
		//TOTAL DE RESPUESTAS
		$query['t_answer'] = $this->getTotalQuestAnswer($query['u_id'], true);
		$query['t_answer'] = empty($query['t_answer']) ? 0 : $query['t_answer'];
		//RETORNAMOS ARRAY CON LOS DATOS
		return $query;
	}
	/*
	 * -> Obtener el nick o el ID
	*/
	public function ID_NAME($value){
		global $mysqli;
		$value = mksecure(strip_tags(strtolower($value)));
		$text = '';
		if(is_numeric($value))
			$text = 'u_id = \''.$value.'\'';
		elseif(is_string($value))
			$text = 'u_nick = \''.$value.'\'';
		//
		$query = $mysqli->query('SELECT u_id, u_nick FROM members WHERE '.$text.' LIMIT 0,1');
		$query = $query->fetch_assoc();
		if(empty($query)) return false;
		if(is_numeric($value))
			return $query['u_nick'];
		elseif(is_string($value))
			return $query['u_id'];
	}
	//OBTEBER NOMBRE DEL PERFIL
	public function getNameProfile($id){
		global $mysqli;
		$id = mkSecure($id);
		if(!empty($id) && is_numeric($id)){
			$query = $mysqli->query('SELECT p_name FROM profile WHERE p_id = \''.$id.'\' LIMIT 0,1');
			$query = $query->fetch_assoc();
			if(!empty($query)){
				return $query['p_name'];
			}
			return false;
		
		}
	}
	public function getUserHome()
	{
		global $mysqli;
		$query = $mysqli->query("SELECT m.u_id, m.u_nick, p.p_avatar FROM members m, profile p WHERE m.u_active = 1 AND m.u_id = p.p_id  ORDER BY rand() LIMIT 0, 13 ");
		//ENVIAREMOS ESTO
		$array = array();
		while($item = $query->fetch_assoc()){
			/* MANEJAMOS DATOS DEL AVATAR */
			$u_avatar = $this->getAvatar($item['u_nick']);
			$item['p_avatar'] = (empty( $item['p_avatar']) || empty($u_avatar['a']) ) ? 'https://i.imgur.com/HSmdSGH.jpg' : $u_avatar['a'];
			$array[] = $item;
		}
		//LIBERAMOS MEMORIA
		unset($query, $item, $u_avatar, $_GET);
		//ENVIAMOS DATOS EN ARRAY
		return $array;
	}
	/*
	 *	LOGIN
	 * @params type
	 * @return json string
	*/
	public function getLogin( $user )
	{
		global $mysqli;
		//SI ESTÁ VACÍO ALGUN CAMPO NO AVANZAMOS
		if( empty( $user['username'] ) )
			return json_encode( array( 'error' => 2, 'data' => 'username' ) );
		else if( empty( $user['password'] ) )
			return json_encode( array( 'error' => 2, 'data' => 'password' ) );
		//FILTRAMOS DATOS
		$user['nick'] = urldecode( mkSecure( strtolower($user['username'] )) );
		$user['pass'] = md5( md5( $user['nick'] ).md5( $user['password'] ) );
		//ALMACENAMOS LA CONSULTA
		$user['data'] = $mysqli->query('SELECT u_active, u_nick, u_id, u_pass FROM members WHERE LOWER(u_nick) = \''.$user['nick'].'\' AND u_active = 1 LIMIT 0,1');
		$user['data'] = $user['data']->fetch_assoc();
		//COMPROBAMOS QUE LA CONSULTA HAYA SIDO VERDADERA / EXISTE EL USUARIO
		if( !empty( $user['data'] ) )
		{
			//SI LA CONTRASEÑA INGRESADA ES IGUAL A LA CONTRASEÑA DE LA BASE DE DATOS INICIAMOS SESION
			if( $user['data']['u_pass'] == $user['pass'] )
			{
				//ACTUALIZAMOS LA SESSION
				$this->session->update($user['data']['u_id'], false, true);
                //CARGAMOS INFO DEL USUARIO
				$this->load_user(true);
				return json_encode( array( 'error' => 0, 'data' => 'success' ) );
			}
			//EL USUARIO EXISTE PERO LA CONTRASEÑA INGRESADA NO ES LA CORRECTA
			else
				return json_encode( array( 'error' => 1, 'data' => 'La contraseña no es la correcta' ) );
		}
		//NO EXISTE EL USUARIO
		else
			return json_encode( array( 'error' => 1, 'data' => 'Datos no validos' ) );
	}
	//
	public function change_background($data, $id){
		global $mysqli;
		//ID DEL USUARIO 
		$id = empty($id) ? $this->id : $id; 
		//SI NO HAY DATOS DEVOLVEMOS FALSE
		if(empty($data)) return false;
		//ALMACENAMOS EN UN ARRAY
		$b = array(
			'background-image' => mkSecure($data['background-image']),
			'background-color' => mkSecure($data['background-color']),
			'b_id' => mkSecure($data['b_id']),
		);
		// ¿REPETIR FONDO?
		if ( !empty( $data['background-repeat'] ) ) {
			$b['background-repeat'] = mkSecure($data['background-repeat']);
		}
		// POSICION
		if( !empty( $data['background-position'] ) ) {
			$b['background-position'] = mkSecure($data['background-position']);
		}
		//
		if( !empty( $data['background-attachment'] ) ) {
			$b['background-attachment'] = mkSecure($data['background-attachment']);
		}
		//
		if( !empty( $data['background-thumb'] ) ) {
			$b['background-thumb'] = mkSecure($data['background-thumb']);
		}
		//COMPROBAMOS QUE LOS CAMPOS NO ESTEN VACIOS
		foreach($b as $v){
			if( empty($v) )
			{
				return json_encode(array('error' => 1, 'success' => 0, 'msg' => "No existen suficientes parametros para cambiar el fondo"));
			}
		}
		if( !empty( $data['upload'] ) ) {
			$b['upload'] = 1;
		} else {
			$b['upload'] = 0;
		}
		unset($data);
		//SERIAMOS LOS DATOS
		$data = serialize($b);
		
		if ( $mysqli->query( 'UPDATE profile SET p_background_u = \''.$b['upload'].'\', p_background = \''.$data.'\' WHERE p_id = \''.$id.'\' ' ) ) {
			unset($b);
			return json_encode(array('error' => 0, 'success' => 1));
		} else {
			return json_encode(array('error' => 1, 'success' => 0, 'msg' => 'Hubo un error al guardar el fondo, contacte con el administrador.'));
		}
	}
	//
	public function saveProfile($d, $optionalpage = false){
		global $r, $mysqli;;
		$user = $this->getProfile($this->id);
		if( ($user['last_act']+60) > time()){
			return json_encode(array('fail_message' => 'Ya habías hecho cambios a tu perfil.<br />Intenta en 1 minuto', 'success' => 0));
		}
		//PARA LA PAGINA /SIGNUP/OPTIONAL
		if($optionalpage == true){
			$data = array(
				'geo' => mkSecure($d['geo']),
				'about_me' => mkSecure($d['about_me']),
				'website' => mkSecure($d['website'])
			);
			foreach ($data as $key => $value) {
				if (empty($value)) {
					return json_encode(array('field' => $key, 'success' => 0 ));
				}
			}
			$sql = 'UPDATE profile SET last_act = \''.time().'\', p_geo = \''.$data['geo'].'\', p_about_me = \''.$data['about_me'].'\', p_website = \''.$data['website'].'\' WHERE p_id = \''.$user['u_id'].'\' ';
			if ( $mysqli->query($sql) ) {
				unset($sql, $data);
				return json_encode(array('success' => 1 ));
			} else {
				return json_encode(array('fail' => "Hubo un error al guardar los datos, intenta más tarde", 'success' => 0));
			}
		}
		//
		if(!empty($d)){
			$data = array(
				'name' => mkSecure($d['name']),
				'geo' => mkSecure($d['geo']),
				'about_me' => mkSecure($d['about_me']),
				'website' => mkSecure($d['website']),
				'page_title' => mkSecure($d['page_title']),
				'email' => mkSecure($d['email']),
				'day' => (int) $d['day'],
				'month' => (int) $d['month'],
				'year' => (int) $d['year']
			);
			if(!empty($d['current_password'])){
				$data['current_password'] = md5(md5( $this->nick ).md5( $d['current_password']));
				$data['password'] = $d['password'];
				$data['password_confirmation'] = $d['password_confirmation'];
			}
			foreach ($data as $key => $value) {
				if (empty($value)) {
					return json_encode(array('field' => $key, 'success' => 0 ));
				}
			}
			if(!$r->valid_name($data['name'])){
				return json_encode(array('fail' => 'Tu nombre y apellidos no son valídos', 'field' => 'name', 'success' => 0 ));
			}
			if (strlen($data['about_me']) > 300) {
				$data['about_me'] = substr($data['about_me'], 0, 300);
			} elseif (strlen($data['website']) > 300) {
				$data['website'] = substr($data['website'], 0, 300);
			} elseif (strlen($data['page_title']) > 100) {
				$data['page_title'] = substr($data['page_title'], 0, 100);
			} elseif (strlen($data['geo']) >= 50) {
				$data['geo'] = substr($data['geo'], 0, 50);
			}
			if(!empty($data['current_password']) && $user['u_pass'] !== $data['current_password']){
				return json_encode(array('fail' => "La contraseña actual no es la correcta", 'field' => 'current_password', 'success' => 0 ));
			}
			if(!empty($data['current_password']) && $data['password'] !== $data['password_confirmation']){
				return json_encode(array('fail' => "Las contraseñas no son iguales", 'field' => 'password', 'success' => 0 ));
			} elseif (!empty($data['current_password']) && !$r->valid_pass($data['password'])){
				return json_encode(array('fail' => 'La constraseña no tiene el formato correcto', 'field' => 'password', 'success' => 0));
			}
			if(!$r->valida_email($data['email'])){
				return json_encode(array('fail' => 'El email no es valido', 'field' => 'email', 'success' => 0));
			}
			//SOLO PERSONAS MAYORES A 13 AÑOS, SI NO, NO
			if(UserAge($data['day'], $data['month'], $data['year']) < 13 ){
				return json_encode(array('fail_message' => 'No se pueden registrar niños menores a 13 años, lo siento Morro.', 'success' => 0));
			}
			//HACK
			$_GET['data'] = $data['email'];
			if($data['email'] !== $user['u_email'] && !$r->checkUserEmail(true)){
				return json_encode(array('fail' => 'El e-mail ya existe', 'field' => 'email', 'success' => 0));
			} elseif ($data['email'] == $user['u_email']) {
				$data['email'] = $user['u_email'];
			}

			$data['password'] = (!empty($data['current_password']) && !empty($data['password'])) ? md5( md5(strtolower($user['u_nick']) ) . md5($data['password']) ) : $user['u_pass'];
			//CONSULTAS
			$sql = array();
			$sql[0] = 'UPDATE members SET u_pass = \''.$data['password'].'\', u_email = \''.$data['email'].'\' WHERE u_id = \''.$user['u_id'].'\' ';
			$sql[1] = 'UPDATE profile SET last_act = \''.time().'\',p_name = \''.$data['name'].'\', p_day = \''.$data['day'].'\', p_month = \''.$data['month'].'\', p_year = \''.$data['year'].'\', p_title_page = \''.$data['page_title'].'\', p_geo = \''.$data['geo'].'\', p_about_me = \''.$data['about_me'].'\', p_website = \''.$data['website'].'\' WHERE p_id = \''.$user['u_id'].'\' ';
			//
			if ($mysqli->query($sql[0]) && $mysqli->query($sql[1])) {
				return json_encode(array('success' => 1 ));
			} else {
				return json_encode(array('fail' => "Hubo un error al guardar los datos, intenta más tarde", 'success' => 0));
			}
		}
	}
	/*
	 *
	*/
	public function delete_all($id){
		global $mysqli;
		//SI LA VARIABLE $id no es un array delvemos error
		if( !is_array($id) ) return json_encode(array('error' => 'Hubo un error'));
		//ALMACENAMOS LOS DATOS
		foreach($id as $ids) $data[] = $ids;
		if(empty($data)) return json_encode(array('error' => 'Hubo un error'));
		//CREAMOS UNA LISTA CON IDs
		$items = implode(',', $data);
		//COMPROBAMOS QUE HAYA ELIMINADO TODAS LAS PREGUNTAS SELECCIONADAS
		if($mysqli->query('DELETE FROM questions WHERE q_id IN('.$items.') ')){
			return json_encode(array('success' => 1));
		} else {
			return json_encode(array('error' => 'Hubo un error al eliminar las preguntas'));
		}
	}
	/*
	 *
	*/
	public function delete_answer($id_answer){
		global $mysqli;
		$id = $this->id;
		if(is_numeric($id_answer)){
			$id_answer = mkSecure($id_answer);
			//COMPROBAMOS QUE LA PREGUNTA EXISTA O SE HAYA RESPONDIDO
			$where = 'q.q_touid = \''.$id.'\' AND a.a_uid = q.q_touid AND q.q_id = a.a_qid AND a.a_id = \''.$id_answer.'\' AND q.q_active = 1 LIMIT 0, 1';
			$query = $mysqli->query('SELECT a.a_qid FROM questions q, answers a WHERE '.$where.' ');
			$query = $query->fetch_assoc();
			if(empty($query)){
				return json_encode(array('error' => 'No existe la pregunta'));
			}
			unset($where);
			if($mysqli->query('DELETE FROM answers WHERE a_uid = \''.$id.'\' AND a_id = \''.$id_answer.'\' ')){
				//PONEMOS EN CERO LA PREGUNTA
				$mysqli->query('UPDATE questions SET q_active = 0 WHERE q_id = \''.$query['a_qid'].'\' ');
				return json_encode(array('success' => $query['a_qid']));
			}
			else {
				return json_encode(array('error' => 'Hubo un error eliminando la pregunta: '));
			}
		}
		return json_encode(array('error' => 'Pregunta no valida'));		
	}
	/*
	 *
	*/
	public function delete_quest($id_quest){
		global $mysqli;
		$id = $this->id;
		if(is_numeric($id_quest)){
			$id_quest = mkSecure($id_quest);
			if($mysqli->query('DELETE FROM questions WHERE q_touid = \''.$id.'\'AND q_id = \''.$id_quest.'\' AND q_active = 0 ')){
				return json_encode(array('success' => $id_quest));
			}
			else {
				return json_encode(array('error' => 'Hubo un error eliminando la pregunta'));
			}
		}
		return json_encode(array('error' => 'Pregunta no valida'));
	}
	/*
	 *
	*/
	public function getQuestion($id, $id_quest = false){
		global $mysqli;
		if(empty($id)){
			return false;
		}
		//ID DEL USUARIO
		$id = mkSecure($id);
		//
		$order = ($id_quest == true) ? 'LIMIT 0, 1' : 'ORDER BY q_id DESC LIMIT 0, 30';
		if($id_quest !== false)
			$query = 'SELECT * FROM questions WHERE q_id = \''.$id_quest.'\' AND q_touid = \''.$id.'\' AND q_active = 0  '.$order.' ';
		else 
			$query = 'SELECT * FROM questions WHERE q_touid = \''.$id.'\' AND q_active = 0  '.$order.' ';
		//BUSCAR PREGUNTAS ASOCIADAS AL USUARIO
		$query = $mysqli->query($query);
		//ALMACENAMO DATOS AQUI
		$array = array();
		if($id_quest == false)
		{
			while($data = $query->fetch_assoc()){
				//BUSCAR EL NOMBRE DE USUARIO DEL QUE PREGUNTA
				$data['q_username'] = (empty($data['q_uid']) || $data['q_anon'] == 1) ? 0 : $this->getNameProfile($data['q_uid']);
				$data['q_user_nick'] = (empty($data['q_uid']) || $data['q_anon'] == 1) ? 0 : $this->ID_NAME($data['q_uid']);
				$data['time'] = fechaHace($data['q_date']);
				//RETORNAMOS LOS DATOS
				$array[] = $data;
				//VACIAMOS $data['q_uid']
				unset($data['q_uid'], $data['q_anon']);
			}
		}
		else 
		{
			$array = $query->fetch_assoc();
			if(empty($array)) return false;
			$array['q_username'] = (empty($array['q_uid']) || $array['q_anon'] == 1) ? 0 : $this->getNameProfile($array['q_uid']);
			$array['q_user_nick'] = (empty($array['q_uid']) || $array['q_anon'] == 1) ? 0 : $this->ID_NAME($array['q_uid']);
			$array['time'] = fechaHace($array['q_date']);
			//VACIAMOS $array['q_uid']
			unset($array['q_uid'], $array['q_anon']);
		}
		//VACIAMOS VARIABLES
		unset($query, $order, $id);
		//
		return $array;
	}
	
	/*
	 *
	*/
	public function getAnswers($id, $answer_id = false){
		global $mysqli;
		//ID DEL USUARIO AL QUE SE LE PREGUNTA
		$id = mkSecure($id);
		//ID DE LA RESPUESTA
		$answer_id = empty($answer_id) ? false : mkSecure($answer_id);
		//CONDICIONAL PARA LA CONSULTA
		if(!$answer_id){
			$where = 'q.q_touid = \''.$id.'\' AND a.a_uid = q.q_touid AND q.q_id = a.a_qid AND q.q_active = 1 ORDER BY a.a_id DESC LIMIT 0, 30';
		} else {
			$where = 'q.q_touid = \''.$id.'\' AND a.a_uid = q.q_touid AND q.q_id = a.a_qid AND a.a_id = \''.$answer_id.'\' AND q.q_active = 1 ORDER BY a.a_id DESC LIMIT 0, 1';
		}
		//HACEMOS CONSULTA 
		$query = $mysqli->query('SELECT q.q_id, q.q_quest, q.q_uid, q.q_anon, a.a_id, a.a_content, a.a_date FROM questions q, answers a WHERE '.$where.' ');
		//ALMACENAREMOS EN ESTE ARRAY
		$array = array();
		if(!$answer_id){
			while($data = $query->fetch_assoc()){
				//PREGUNTA
				$data['q_quest'] = &$data['q_quest'];
				//USUARIO DE LA PREGUNTA
				$data['q_user'] = (empty($data['q_uid']) || $data['q_anon'] == 1) ? 0 : $this->getNameProfile($data['q_uid']);
				$data['q_user_nick'] = (empty($data['q_uid']) || $data['q_anon'] == 1) ? 0 : $this->ID_NAME($data['q_uid']);
				//ID DE LA RESPUESTA
				$data['a_id'] = &$data['a_id'];
				//RESPUESTA DE LA PREGUNTA
				$data['a_content'] = nl2br($data['a_content']);
				//FECHA DE LA RESPUESTA
				$data['a_date'] = fechaHace($data['a_date']);
				//RETORNAMOS LOS DATOS
				$array[] = $data;
			}
		}
		else
		{
			$array = $query->fetch_assoc();
			if(empty($array)) return false;
			//PREGUNTA
			$array['q_quest'] = &$array['q_quest'];
			//USUARIO DE LA PREGUNTA
			$array['q_user'] = (empty($array['q_uid']) || $array['q_anon'] == 1) ? 0 : $this->getNameProfile($array['q_uid']);
			$array['q_user_nick'] = (empty($array['q_uid']) || $array['q_anon'] == 1) ? 0 : $this->ID_NAME($array['q_uid']);
			//ID DE LA RESPUESTA
			$array['a_id'] = &$array['a_id'];
			//RESPUESTA DE LA PREGUNTA
			$array['a_content'] = nl2br($array['a_content']);
			//FECHA DE LA RESPUESTA
			$array['a_date'] = fechaHace($array['a_date']);			
		}
		//VACIAMOS VARIABLES
		unset($query, $answer_id, $id, $where);
		//REGRESAMOS DATOS
		return $array;
	}
	/*
	 *
	*/
	public function getTotalQuestAnswer($id, $answer = false){
		global $mysqli;
		$id = mkSecure($id);
		$item = array();
		$item['id'] = $answer ? 'a_id' : 'q_id';
		$item['table'] = $answer ? 'answers' : 'questions';
		$item['where'] = $answer ? 'a_uid = \''.$id.'\'' : 'q_touid = \''.$id.'\' AND q_active = 0';
		$query = $mysqli->query('SELECT COUNT('.$item['id'].') AS total FROM '.$item['table'].' WHERE '.$item['where'].' ');
		$query = $query->fetch_assoc();
		if(!empty($query))
			return $query['total'];
		else
			return false;
	}
	public function delete_notify($id_al){
		global $mysqli;
		if(empty($id_al) || !is_numeric($id_al)) return false;
		if($mysqli->query('DELETE FROM notify WHERE n_like_aid = \''.$id_al.'\' AND n_uid = \''.$this->id.'\' ')){
			return true;
		}
		else return false;
	}
	//
	public function CreateNotify($id, $toid, $type, $a_like_id = false)
	{
		global $mysqli;
		//SI HAY ALGO MALO
		//if(empty($id) || empty($toid) || empty($type)) return false;
		//SI HAY ÉXITO AL INSERTAR LOS DATOS, DEVOLVEMOS TRUE
		$extra = array();
		if($a_like_id != false){
			$extra['field'] = ', n_like_aid';
			$extra['value'] = ', \''.$a_like_id.'\' ';
		} else {
			$extra['field'] = '';
			$extra['value'] = '';
		}
		$sql = 'INSERT INTO notify (n_uid, n_fromid, n_type, n_date'.$extra['field'].') VALUES (\''.$toid.'\', \''.$id.'\', \''.$type.'\', \''.time().'\''.$extra['value'].') ';
		if($mysqli->query($sql))
		{
			return true;
		}
		//SI NO TUVO EXITO LA CONSULTA, DEVOLVEMOS FALSO/0
		return false;
	}
	//UNREAD
	public function unReadNotify($id){
	
	}
	//
	public function readNotify($n_type)
	{
		global $mysqli;
		//ID
		$id = $this->id;
		if(empty($id) || empty($n_type)) return false;
		//
		//HACEMOS CONSULTA
		if($mysqli->query( 'UPDATE notify SET n_read = 1 WHERE n_uid = \''.$id.'\' AND n_read  = 0 AND n_type = \''.$n_type.'\'' )){
			return true;
		}
		else {
			return false;
		}
	}
	/*
	 *
	*/
	public function getNotify( $type, $loop = false, $limit = false )
	{
		global $mysqli;
		//ID
		$id = $this->id;
		//FALSE
		if(empty($type)) return false;
		//CONDICIONAL
		$where = '';
		//CAMPOS
		$fields = '';
		//TIPO DE NOTIFICACION: PREGUNTAS NUEVAS/ PREGUNTA RESPONDIDA / ME GUSTA
		switch( $type ){
			//PREGUNTAS NUEVA
			case 1:
				$fields = 'COUNT(n_id) AS total';
				$where = 'n_uid = \''.$id.'\' AND n_type = 1 AND n_read = 0 AND n_fromid != \''.$id.'\'';
				break;
			//PREGUNTA RESPONDIDA
			case 2:
				if($loop) {
					$limit = ($limit == false) ? '' : 'LIMIT 0, 5';
					$fields = 'n_fromid, n_date, n_like_aid';
					$where = 'n_uid = \''.$id.'\' AND n_type = 2 ORDER BY n_id DESC '.$limit;
				}
				else {
					$fields = 'COUNT(n_id) AS total';
					$where = 'n_uid = \''.$id.'\' AND n_type = 2 AND n_read = 0 AND n_fromid != \''.$id.'\' ';
				}
				break;
			//ME GUSTA
			case 3:
				if ($loop) {
					$fields = 'n_fromid, n_date, n_like_aid';
					$where = 'n_uid = \''.$id.'\' AND n_type = 3 ORDER BY n_id DESC';
				}
				else {
					$fields = 'COUNT(n_id) AS total';
					$where = 'n_uid = \''.$id.'\' AND n_type = 3 AND n_read = 0 ';
				}
				break;
		}
		//SI NO HAY NINGUN CONDICIONAL O CAMPO, REGRESAMOS FALSO
		if(empty($where) || empty($fields)) return false;
		//HACEMOS CONSULTA
		$query = $mysqli->query( 'SELECT '.$fields.' FROM notify WHERE '.$where );
		//GUARDAMOS LO DATOS EN UN ARRAY
		if ( ( $type == 2 ||  $type == 3 ) && !empty ( $loop ) )
		{
			//AQUI SE GUARDARAN LOS DATOS A ENVIAR
			$array = array();
			//
			while ( $data = $query->fetch_assoc() ) {
				if($data['n_fromid'] != $this->id){
					$data['id'] = $data['n_like_aid'];
					//NICK DEL USUARIO
					$data['nick'] = $this->ID_NAME($data['n_fromid']);
					/* MANEJAMOS DATOS DEL AVATAR */
					$u_avatar = $this->getAvatar($data['nick']);
					//AVATAR DEL USUARIO
					$data['avatar'] = ( empty($u_avatar) ) ? 'https://i.imgur.com/HSmdSGH.jpg' : $u_avatar['t'];
					//NOMBRE DEL USUARIO
					$data['name'] = $this->getNameProfile($data['n_fromid']);
					//FECHA DE LA RESPUESTA
					$data['date'] = fechaHace($data['n_date']);
					//VACIAMOS LOS DOS DATOS EXTRAIDOS
					unset($data['n_fromid'], $data['n_date'], $data['n_like_aid']);
					//ALMACENAMOS TODO EN UN ARRAY
					$array[] = 	$data;
				}
			}
			//RETORNAMOS DATOS
			return $array;
		}
		//EXTRAEMOS EL TOTAL
		$data = $query->fetch_assoc();
		//SI NO OBTUVIMOS NINGUN DATO, DEVOLVEMOS FALSO
		if ( empty( $data ) ) return false;
		//RETORNAMOS EL TOTAL
		return $data['total'];
	}
	
	/*
	 *
	*/
	public function savePrivacy($data)
	{
		global $mysqli;
		$id = $this->id;
		$data['anon_quest'] = !empty($data['anon_quest']) ? 1 : 0;
		$data['d_show_answers'] = !empty($data['d_show_answers']) ? 1 : 0;
		$data['notify'] = array(
			'mail_questions' => !empty($data['mail_questions']) ? 1 : 0,
			'mail_gifts' => !empty($data['mail_gifts']) ? 1 : 0,
			'mail_birthdays' => !empty($data['mail_birthdays']) ? 1 : 0,
			'mail_digests' => !empty($data['mail_digests']) ? 1 : 0,			
		);
		$data['notify'] = serialize($data['notify']);
		if( $mysqli->query( 'UPDATE profile SET anon_quest = \''.$data['anon_quest'].'\', notify_email = \''.$data['notify'].'\', show_own_answers = \''.$data['d_show_answers'].'\' WHERE p_id = \''.$id.'\' ' ) )
		{
			//VACIAMOS DATOS
			unset($data, $id);
			return json_encode(array('success' => 1));
		}
		else 
			return json_encode(array('error' => 'Ocurrió un error al guardar los datos'));
	}
	
	public function getOut($url = false){
		global $settings;
		/* BORRAR SESSION */
        $this->session = new Session();
        $this->session->read();
        $this->session->destroy();
		/* LIMPIAR VARIABLES */
		unset( $this->info, $this->is_member );
		return $url ? $url: $settings['url'];
	}


}
require('class.session.php');
?>