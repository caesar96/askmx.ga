<?php
class Session
{

    var $ID                 = '';
    var $sess_expiration    = 7200;
    var $sess_match_ip      = FALSE;
    var $sess_time_online   = 72000;
    var $cookie_prefix      = 'askm';
    var $cookie_name        = '';
    var $cookie_path        = '/';
    var $cookie_domain      = '';
    var $userdata;
    var $ip_address;
    var $time_now;
    var $db;

    function __construct()
    {
		global $settings;
		//INICIAR LA SESION
		//if(!isset($_SESSION)) session_start();
		//setcookie('PHPSESSID','',time()-3600,'/');
        // Tiempo
        $this->time_now = time();
        // Obtener el dominio o subdominio para la cookie
        $host = parse_url($settings['url']);
        $host = str_replace('www.', '' , strtolower($host['host']));
        // Establecer variables
        $this->cookie_domain = ($host == 'localhost') ? '' : '.' . $host;
        $this->cookie_name = $this->cookie_prefix . substr(md5($host), 0, 6);
        // IP
        $this->ip_address = getIP();
    }
    /**
     * Leer session activa
     *
	 * @access	public
	 * @return	bool
	 */
     function read()
     {
        global $mysqli;
        $this->ID = !empty($_COOKIE[$this->cookie_name . '_sid']) ? $_COOKIE[$this->cookie_name . '_sid'] :  false;

        // Es un ID válido?
        if(!$this->ID || strlen($this->ID) != 32)
        {
            return FALSE;
        }

        // ** Obtener session desde la base de datos
		$query = $mysqli->query('SELECT * FROM sessions WHERE s_id = \''.$this->ID.'\'');
        $session = $query->fetch_assoc();

        // Existe en la DB?
        if(empty($session['s_id']))
        {
            $this->destroy();
            return false;
        }

        // Is the session current?
		if (($session['s_time'] + $this->sess_expiration) < $this->time_now AND empty($session['s_alogin']))
		{
			$this->destroy();
			return FALSE;
		}

        // Si cambió de IP creamos una nueva session
        if($session['s_ip'] != $this->ip_address)
        {
            $this->destroy();
            return FALSE;
        }

        // Listo guardamos y retornamos
        $this->userdata = $session;
		unset($session);

        return TRUE;
     }
	/**
	 * Create a new session
	 *
	 * @access	public
	 * @return	void
	 */
	function create()
	{
        global $mysqli;
        // Generar ID de sesión
        $this->ID = $this->gen_session_id();

        // Guardar en la base de datos, session_user_id siemrpe será 0 aquí
        // si inicia sesión se "actualiza"
		$mysqli->query('INSERT INTO sessions (s_id, s_uid, s_ip, s_time) VALUES (\''.$this->ID.'\', \'0\', \''.$this->ip_address.'\', \''.$this->time_now.'\') ');

        // Establecemos la cookie
        $this->set_cookie('sid', $this->ID, $this->sess_expiration);
    }

	/**
	 * Update an existing session
	 *
	 * @access	public
	 * @return	void
	 */
	function update($user_id = 0, $autologin = FALSE, $force_update = FALSE)
	{
        global $mysqli;
	   // Actualizar la sesión cada x tiempo, esto es configurado en el panel de Admin
       if(($this->userdata['s_time'] + $this->sess_time_online) >= $this->time_now AND $force_update == FALSE)
       {
            return;
       }

       // Datos para actualizar
       $this->userdata['s_uid'] = empty($user_id) ? $this->userdata['s_uid'] : $user_id;
       $this->userdata['s_ip'] = $this->ip_address;
       $this->userdata['s_time'] = $this->time_now;
       // Autologin requiere una comprovación doble
       $autologin = ($autologin == FALSE) ? 0 : 1;
       $this->userdata['s_alogin'] = empty($this->userdata['s_alogin']) ? $autologin : $this->userdata['s_alogin'];

       // Actualizar en la DB
	   
	   $mysqli->query('UPDATE sessions SET s_uid = \''.$this->userdata['s_uid'].'\', s_ip = \''.$this->userdata['s_ip'].'\', s_time = \''.$this->userdata['s_time'].'\', s_alogin = \''.$this->userdata['s_alogin'].'\' WHERE s_id = \''.$this->ID.'\'');

       // Limpiar sesiones
       $this->sess_gc();

       // Actualizar cookie
       if(!empty($this->userdata['s_alogin']))
       {
            // Si el usuario quiere recordar su sesión, se guardará por 1 año
            $expiration = 31500000;
       }
       else $expiration = $this->sess_expiration;
       //
       $this->set_cookie('sid', $this->ID, $expiration);
    }

	/**
	 * Destroy the current session
	 *
	 * @access	public
	 * @return	void
	 */
	function destroy()
	{
        global $mysqli;
	   // Elminar de la DB
       $mysqli->query('DELETE FROM sessions WHERE s_id = '.$this->ID.'');
	   // Reset a la cookie
       $this->set_cookie('sid', '', -31500000);
    }
    /**
     * Crear cookie
     * @access public
     * @param string
     * @param string
     * @param int
     */
	function set_cookie($name, $cookiedata, $cookietime)
	{
        $cookiename = rawurlencode($this->cookie_name . '_' . $name);
        $cookiedata = rawurlencode($cookiedata);
		// Establecer la cookie
        setcookie($cookiename, $cookiedata, ($this->time_now + $cookietime), '/', $this->cookie_domain);
	}
    /**
     * Generar un ID de sesión
     *
     * @access public
     * @param void
     */
    function gen_session_id()
    {
		$sessid = '';
		while (strlen($sessid) < 32)
		{
			$sessid .= mt_rand(0, mt_getrandmax());
		}

		// To make the session ID even more secure we'll combine it with the user's IP
		$sessid .= $this->ip_address;

        return md5(uniqid($sessid, TRUE).$_SERVER['HTTP_USER_AGENT']);
    }
	/**
	 * Eliminar sesiones expiradas
	 *
	 * @access	public
	 * @return	void
	 */
	function sess_gc()
	{
        global $mysqli;
        // Esto es para no eliminar con cada llamada a esta función
        // sólo si se cumple la siguiente sentencia se eliminan las sesiones
		if ((rand() % 100) < 30)
		{
            // Usuario sin actividad
    		$expire = $this->time_now - $this->sess_time_online;
			$mysqli->query('DELETE FROM sessions WHERE s_time < '.$expire.' AND s_alogin = \'0\'');
        }
	}
}
?>