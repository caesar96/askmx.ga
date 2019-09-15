<?php
/**
 * SUBIR IMAGENES, SIMPLE CLASE NADA EXTRAORDINARIA
 *
 */
class upload {
	public $no_rescale = false;
	public $size = array('w' => 800, 'h' => 600);
	public $allow = true;
	public $avatar = false;
	
	public function __contruct(){}
	
	/*
	 * -> Funcion simple para subir el fondo de usuario -
	 * -> Sube una imagen en tamaño original 
	 * -> Utiliza la misma imagen subida para redimensionarla y crear una miniatura para mostrar
	 * @params array
	 * @return json objet
	*/
	public function upload_avatar($nick){
		//Datos del sitio
		global $settings, $user;
		//
		if(empty($_FILES)){
			return json_encode(array('error' => 'Tienes que subir una imagen!'));
		}		
		//
		foreach($_FILES as $file) $files = $file;
		//
		//ARRAY
		$img = array (
			'name' => $files['name'],
			'size' => $files['size'],
			'type' => $files['type'],
			'tmp_name' => $files['tmp_name'],
			'error' => $files['error'],
		);
		$img['ext'] = explode('.', $img['name']);
		$img['ext'] = end($img['ext']);
		$img['ext'] = strtolower($img['ext']);
		
		//VALIDAMOS LA SUBIDA
		$error = $this->valid_upload_file($img);
		
		//SI HAY UN ERROR AVISAMOS AL USUARIO
		if(!empty($error['error']))
		{
			return json_encode($error);
		}
		//ELIMINAMOS LA ANTERIOR IMAGEN SI EXISTE
		$delet = $user->getAvatar('', true);
		if ( !empty($delet) ){
			unlink($delet['a']);
			unlink($delet['t']);
		}
		unset($delet);
		//
		$msg = array();
		//ESTA PERMITIDO SUBIR 
		if($this->allow == true)
		{
			//DEFINIMOS
			$msg['error'] = '';
			//NUEVO NOMBRE
			$img['new_name'] = 'a_' . $nick;
			//COPIAMOS EL ARCHIVO A LA CARPETA 'TMP'
			$TMP = TMP . $img['new_name'] . '.' . $img['ext'];
			$fullname = $img['new_name'] . '.' . $img['ext'];
			if( copy( $img['tmp_name'], $TMP) )
			{
				/***** REDIMENSION PARA EL AVATAR MINIATURA****/
					$this->no_rescale = true;
					$this->size['w'] = 90;
					$this->size['h'] = 90;
					//SI REDIMENCIONO LA IMAGEN MOSTRAMOS EL LINK
					$thumb = $this->rescale_img( $TMP, $fullname );
					if(!empty($thumb)){
						$msg['a_thumb'] =  $thumb;
					}
					unset($thumb);
				/***** REDIMENSION PARA EL AVATAR ****/
					$this->avatar = true;
					$this->no_rescale = false;
					$this->size['w'] = 650;
					$this->size['h'] = 600;
					//SI REDIMENCIONO LA IMAGEN MOSTRAMOS EL LINK
					$thumb = $this->rescale_img( $TMP, $fullname );
					if(!empty($thumb)){
						$msg['avatar'] =  $thumb;
					}
				//ELIMINAMOS ARCHIVOS TEMPORALES
				unlink($TMP);
				unlink($img['tmp_name']);
				//ESTABLECEMOS EL AVATAR EN 1 SI SE HA SUBIDO LAS IMAGENES
				if(!empty($msg['avatar']) && !empty($msg['a_thumb']))
					$user->set_OutAvatar($user->id);
				return json_encode($msg);
			} else {
				$msg['error'] = 'Un error ha ocurrido subiendo la im&aacute;gen.';
			}
		}
	}
	/*
	 * -> Funcion simple para subir el fondo de usuario -
	 * -> Sube una imagen en tamaño original 
	 * -> Utiliza la misma imagen subida para redimensionarla y crear una miniatura para mostrar
	 * @params array
	 * @return json objet
	*/
	public function u_background(){
		//Datos del sitio
		global $settings, $user;
		//
		if(empty($_FILES)){
			return json_encode(array('error' => 'Tienes que subir una imagen!'));
		}
		foreach($_FILES as $file) $files = $file;
		
		//ARRAY
		$img = array(
			'name' => $files['name'],
			'size' => $files['size'],
			'type' => $files['type'],
			'tmp_name' => $files['tmp_name'],
			'error' => $files['error'],
		);
		$img['ext'] = explode('.', $img['name']);
		$img['ext'] = end($img['ext']);
		$img['ext'] = strtolower($img['ext']);
		
		//DATOS A ENVIAR
		$msg = array();
		
		//VALIDAMOS LA SUBIDA
		$error = $this->valid_upload_file($img);
		
		//SI HAY UN ERROR AVISAMOS AL USUARIO
		if(!empty($error['error']))
		{
			return json_encode($error);
		}
		//ELIMINAMOS LA ANTERIOR IMAGEN SI EXISTE
		$old = $user->getBackground($user->nick, true);
		if(!empty($old['background'])){
			unlink($old['background']);
			unlink($old['thumb']);
		}
		unset($old);
		
		//ESTA PERMITIDO SUBIR 
		if($this->allow == true)
		{
			//DEFINIMOS
			$msg['error'] = '';
			
			//CREAMOS UN NUEVO NOMBRE PARA EL ARCHIVO UTILIZANDO EL NICK
			/*$img['new_name'] = md5( time() . md5( mt_rand(). $img['name'] . mt_rand() ) );
			$img['new_name'] = substr($img['new_name'], 0, 5);*/
			$img['new_name'] = $user->nick;
			
			//COPIAMOS EL ARCHIVO A LA CARPETA 'BACKGROUNDS'
			$background_dir = BACKGROUND . $img['new_name'] . '.' . $img['ext'];
			$fullname = $img['new_name'] . '.' . $img['ext'];
			if( copy( $img['tmp_name'], $background_dir) )
			{
				//LINK DE LA IMAGEN DE FONDO
				$msg['background'] = $settings['url'] . '/img/b/'. $fullname;
				
				//REDIMENCIONAMOS EL BACKGROUND PARA MOSTRAR MINIATURA
				$this->no_rescale = true;
				$this->size['w'] = 156;
				$this->size['h'] = 106;
				
				//SI REDIMENCIONO LA IMAGEN MOSTRAMOS EL LINK
				$thumb = $this->rescale_img($background_dir, $fullname);
				if(!empty($thumb)){
					$msg['thumb'] =  $thumb;
				}
			} else {
				$msg['error'] = 'Un error ha ocurrido subiendo la im&aacute;gen.';
			}
			//ELIMINAMOS ARCHIVO TEMPORAL
			unlink($img['tmp_name']);
			//VACIAMOS VARIABLES
			unset($img, $_FILES);
			return json_encode($msg);
		}
		return json_encode(array('error' => 'El administrador prohibio subir imagenes'));
	}
	
	/*
	 * -> Funcion que valida una imagen
	 * -> Verifica si se ha enviado una imagen
	 * -> Si ha ocurrido un error
	 * -> Si el archivo subido pesa más de 1MB
	 * -> Si el archivo subido es o no una imágen
	 * @params array()
	 * @return array();
	 */
	private function valid_upload_file($file){
		//CREAMOS UNA VARIABLE VACIA QUE ALMACENARA EL MENSAJE DE ERROR
		$error = '';
		//SE HA SUBIDO EL ARCHIVO?
		if ( empty( $file['name'] ) ) {
			$error = 'No has enviado ninguna im&aacute;gen.';
		} elseif( empty( $file['tmp_name'] ) ) {
			$error = 'No se ha podido subir la im&aacute;gen.';
		} elseif(filesize($file['tmp_name']) > 1175220){
			$error = 'El archivo que acabas de subir pesa m&aacute;s de 1MB.';
		} elseif( !preg_match( '/(gif|png|jpg|jpeg)/i', $file['ext'] ) ) {
			$error = 'El archivo que acabas de subir no es una im&aacute;gen valida o permitida.';
		}
		//RETORNAMOS UN ARRAY CON EL ERROR
		return array('error' => $error, 'success' => 0);
	}
	
	/*
	 * -> Funcion que redimensionará la imagen subida
	 * -> Se puede elegir si mantener proporciones o simplemente cambiar al tamaño deseado 
	 * -> sin mantener proporciones.
	 * @param string(ruta a la imagen a redimensionar)
	 * @return string(url a la nueva imagen)
	*/
	 public function rescale_img($img, $name){
		global $settings;
		// Extension de la imagen
		$ext = explode('.', strtolower($name));
		$ext = end($ext);
		//Creamos una nueva imagen dependiendo de la extensión
		switch($ext){
			case 'gif':
				$original = imagecreatefromgif($img);
				break;
			case 'png':
				$original = imagecreatefrompng($img);
				break;
			case 'jpg':
			case 'jpeg':
				$original = imagecreatefromjpeg($img);
				break;
			case 'bmp':
				$original = imagecreatefromwbmp($img);
				break;
		}
		if(empty($original)){
			return array('error' => 'Ha ocurrido un error interno al crear la imagen');
		}
		
		//Se define el maximo ancho o alto que tendra la imagen final
		$max_ancho = $this->size['w'];
		$max_alto = $this->size['h'];
		
		//Ancho y alto de la imagen original
		list($ancho, $alto) = getimagesize($img);
		
		//Se calcula ancho y alto de la imagen final
		$x_ratio = $max_ancho / $ancho;
		$y_ratio = $max_alto / $alto;
		
		//Si el ancho y el alto de la imagen no superan los maximos, 
		//ancho final y alto final son los que tiene actualmente
		if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){//Si ancho 
			$ancho_final = $ancho;
			$alto_final = $alto;
		}
		/*
		 * si proporcion horizontal*alto mayor que el alto maximo,
		 * alto final es alto por la proporcion horizontal
		 * es decir, le quitamos al alto, la misma proporcion que 
		 * le quitamos al alto
		 * 
		*/
		elseif (($x_ratio * $alto) < $max_alto){
			$alto_final = ceil($x_ratio * $alto);
			$ancho_final = $max_ancho;
		}
		/*
		 * Igual que antes pero a la inversa
		*/
		else {
			$ancho_final = ceil($y_ratio * $ancho);
			$alto_final = $max_alto;
		}
		/*
		 * -> SI HA ELEGIDO NO MANTENER PROPORCIONES SIMPLEMENTE CREAMOS UNA NUEVA IMAGEN CON
		 * -> LOS TAMAÑOS ESTABLECIDOS EN $max_ancho, $max_alto
		*/
		if($this->no_rescale == true)
		{
			//Creamos una imagen en blanco de tamaño $max_ancho  por $max_alto .
			$tmp = imagecreatetruecolor( $max_ancho, $max_alto );	

			//Copiamos $original sobre la imagen que acabamos de crear en blanco ($tmp)
			imagecopyresampled( $tmp, $original, 0,0,0,0, $max_ancho, $max_alto, $ancho, $alto );
		}
		//MANTENER PROPORCIONES
		else 
		{
			//Creamos una imagen en blanco de tamaño $ancho_final  por $alto_final .
			$tmp = imagecreatetruecolor( $ancho_final, $alto_final );	

			//Copiamos $original sobre la imagen que acabamos de crear en blanco ($tmp)
			imagecopyresampled( $tmp, $original, 0,0,0,0, $ancho_final, $alto_final, $ancho, $alto );
		}
		//Se destruye variable $original para liberar memoria
		imagedestroy($original);
		
		//Definimos la calidad de la imagen final
		$calidad = 95;
		unset($img);
		//QUE DIRECTORIO COPIAREMOS LA NUEVA IMAGEN?
		$dir = ( $this->avatar == false) ? THUMB : AVATAR;
		//Se crea la imagen final en el directorio indicado
		if(imagejpeg($tmp, $dir . $name, $calidad)){
			if( $this->avatar == false )
				return $settings['url'].'/img/thumb/'.$name;
			else
				return $settings['url'].'/img/a/'.$name;
		} else {
			return false;
		}
	}
}
?>