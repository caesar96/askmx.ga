<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es-MX" xml:lang="es-MX">
<head>
	<meta charset="utf-8" />
	<meta property="og:image" content="http://ask.fm/images/1500x1500.png" />
	<link rel="image_src" href="http://ask.fm/images/1500x1500.png" />
    <title><?php echo $title;?></title>
	<base href="<?php echo $settings['url'];?>" target="_self"/>
<?php if($page == 'perfil'):?>
	<?php if(!empty($respuestas['query']['a_content'])):?>
	<meta property="og:title" content="<?php echo $respuestas['query']['q_quest'];?> | <?php echo $domain_nick;?>" />
	<meta name="description" content="<?php echo $respuestas['query']['a_content'];?>" />
	<?php else:?>
	<meta property="og:title" content="<?php echo $meta_tags['title'];?>" />
	<meta property="og:description" content="<?php echo $meta_tags['description'];?>" />
    <meta name="description" content="<?php echo $meta_tags['description'];?>" />
	<?php endif;?>
<?php else:?>
	<meta name="description" content="<?php echo $settings['description'];?>" />
<?php endif;?>
	<meta name="href" content="<?php echo $_SERVER['REQUEST_URI'];?>"/>
    <link rel="shortcut icon" href="<?php echo $settings['source_url'];?>/favicon_270613.ico" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="<?php echo $settings['source_url'];?>/apple-touch-icon.png"/>
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $settings['source_url'];?>/apple-touch-icon-72x72.png"/>
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $settings['source_url'];?>/apple-touch-icon-114x114.png"/>
	<link href="<?php echo $settings['source_url'];?>/stylesheets/base_ltr_packaged.css?1371566220" media="screen" rel="stylesheet" type="text/css" />
	<!-- GOOGLE JQUERY CDN -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<!-- JQUERY COLORBOX -->
	<script type="text/javascript" src="<?php echo $settings['source_url'];?>/js/jquery.colorbox.min.js"></script>
	<script type="text/javascript">var pageUrl = "<?php echo $settings['url'];?>";var u = {is_member: <?php echo $user->is_member ? 'true' : 'false';?>}</script>
<?php if($settings['offline']['status'] !== 1):?>
	<script type="text/javascript" src="<?php echo $settings['source_url'];?>/js/mn.act.js"></script>
<?php if($user->is_member && empty(getenv('CLEARDB_DATABASE_URL'))):?>
	<script type="text/javascript" src="<?php echo $settings['source_url'];?>/js/stream.js"></script>
<?php endif;?>
<?php endif;?>
</head>
<body class="body-<?php echo ($page == 'home' &&( $settings['offline']['status'] == 0) && !$user->is_member)? 'welcome' : 'content';?>">
	<div id="menu" class="menu-top">
		<div id="menuCenter">
			<span><a href="/" name="logo" title="<?php echo $settings['titulo'];?>"><div id="logo"></div></a></span>
			<?php if($user->is_member):?>
			<div id="flyout-wrapper" style="display:none">
				<div id="flyout-like">
					<div class="flyoutHeadline">Notificaciones</div>
					<div id="flyout-like-loader"></div>
					<div id="flyout-like-content"></div>
					<a href="/account/notifications/perks" class="link-viewAllNotifications" onclick="PerkNotify.handleViewAllClick(); return true;">Ver todas las notificaciones</a>
				</div>
			</div>
			<div id="flyout-replies-wrapper" style="display:none">
				<div id="flyout-answer">
					<div class="flyoutHeadline">Respuestas</div>
					<div id="flyout-answer-loader"></div>
					<div id="flyout-answer-content"></div>
					<a href="/account/notifications/answers" class="link-viewAllNotifications">Ver todas las respuestas</a>
				</div>
			</div>
			<a href="#" class="notification-like" id="notify_like_icon" onclick="return false">
			  <div id="notification-like-digit" style="display:none">0</div>
			</a>
			<a href="/account/questions" allow="false" class="notification-question" id="notify_question_icon" n="1" onclick="__questions.read_q(this); return false">
			  <div id="notification-q-digit" style="display:<?php if(!empty($user->notifications['quest'])):?>block;<?php else:?>none<?php endif;?>"><?php if( !empty($user->notifications['quest']) ): echo $user->notifications['quest']; else:?>0<?php endif;?></div>
			</a>
			<a href="#" n="2" allow="false" class="notification-answer" id="notify_answer_icon" onclick="__questions.read(this); return false">
			  <div id="notification-answer-digit" style="display:<?php if(!empty($user->notifications['answer'])):?>block;<?php else:?>none<?php endif;?>"><?php if( !empty($user->notifications['answer']) ): echo $user->notifications['answer']; else:?>0<?php endif;?></div>
			</a>
			<a>
				<input class="link-logout" name="commit" type="submit" value="" onclick="login.salir();" />
			</a>
			<a href="/account/settings/profile" class="link-menu<?php if($page == 'settings'):?>-active<?php endif;?>">Configuración</a>
			<a href="/search/name" class="link-menu<?php if($page == 'search'):?>-active<?php endif;?>">Buscar</a>
			<a href="/account/people" class="link-menu<?php if($page == 'people'):?>-active<?php endif;?>">Amigos</a>
			<a href="/<?php if($user->nick) echo $user->nick;?>" class="link-menu<?php if($page == 'perfil' && $data['u_nick'] == $user->nick ):?>-active<?php endif;?>">Perfil</a>
			<a href="/account/questions" class="link-menu<?php if($page == 'questions'):?>-active<?php endif;?>">Preguntas (<span id='inbox_menu_counter'><?php if(!empty($user->questions)):echo $user->questions;else:?>0<?php endif;?></span>)</a>
			<a href="/account/wall" class="link-menu<?php if($page == 'home' || $page == 'wall'):?>-active<?php endif;?>">Inicio</a>
			<?php else:?>			
				<a href="/login" allow="false" class="link-login" onclick="login.show();return false;">Entrar</a>
				<div class="text-menu" id="already_registered_label" style="display:<?php echo ($page == 'home' || $page == 'signup' )? 'block' : 'none';?>">¿Ya tienes una cuenta?</div>
				<a href="/signup" class="link-login" id="create_account_link" style="display:<?php echo ($page == 'home' || $page == 'signup' )? 'none' : 'block';?>">Crear una cuenta</a>
				<div id="popup-login-container" style="display: none;">
					<!-- Login form started !-->
					<div id="logBox">
						<div id="logBox_top" class="logBox_sprite"></div>
						<div id="logBox_content">
							<form action="javascript:login.submit()" autocomplete="off" id="logBox_form" method="post">
								<script type="text/javascript">$(document).ready(function(){$("#logBox_form").on("keyup", "input",function(){var e=$(this).val();if(e.length>0)$(this).addClass("signinTileMask");else $(this).removeClass("signinTileMask")});});</script>
								<div id="signinFrame">
									<div class="signinTile signinTile-top">
										<input class="signinInput " id="login" maxlength="40" name="username" tabindex="101" type="text" value="">
										<label for="username">Nombre de usuario</label>
									</div>
									<div class="signinTile signinTile-bottom">
										<input class="signinInput" id="password" maxlength="20" name="password" tabindex="102" type="password">
										<label for="password">Contraseña</label>
									</div>
								</div>
								<input id="login_follow" name="follow" type="hidden" value=""/>
								<input id="login_like" name="like" type="hidden" value=""/>
								<input id="login_back" name="back" type="hidden" value=""/>
								<div id="logBox_submit-wrapper">
									<input class="login_Active logBox_sprite" id="logBox_submit" name="commit" tabindex="104" type="submit" value="Iniciar sesión">
									<img id="logBox_submit-spinner" src="<?php echo $settings['source_url'];?>/images/logbox/spinner.gif" class="logBox_sprite">
								</div>
								<div id="logBox_form-alert"></div>
							</form>
							<div id="logBox_servicesBox">
								<strong>Iniciar sesión con</strong>
								<div id="logBox_services">
									<a href="javascript:void(0)" class="logBox_service logBox_service-facebook logBox_sprite" onclick="RLTLogger.execute('oAuth', 'login_auth', 'fb');Login.connect(this,'/facebook_session/login',true)">
										<img src="<?php echo $settings['source_url'];?>/images/logbox/facebookLoader.gif" class="logBox_service-loader">
									</a>
									<a href="javascript:void(0)" class="logBox_service logBox_service-twitter logBox_sprite" onclick="RLTLogger.execute('oAuth', 'login_auth', 'tw');Login.connect(this,'/twitter_session/login',true)">
										<img src="<?php echo $settings['source_url'];?>/images/logbox/twitterLoader.gif" class="logBox_service-loader">
									</a>
									<a href="javascript:void(0)" class="logBox_service logBox_service-vkontakte logBox_sprite" onclick="RLTLogger.execute('oAuth', 'login_auth', 'vk');Login.connect(this,'/vkontakte_session/login',true)">
										<img src="<?php echo $settings['source_url'];?>/images/logbox/vkontakteLoader.gif" class="logBox_service-loader">
									</a>
								</div>
							</div>
							<div id="logBox_recover">
								<a href="/remind/request" class="link-blue">
									¿Olvidaste tu contraseña o tu nombre de usuario?
								</a>
							</div>
						</div>
						<div id="logBox_bottom" class="logBox_sprite"></div>
					</div>
					<!-- Login form finished -->
				</div>
			<?php endif;?>
		</div>
	</div>
	<div id="allContent">
		<div id="mContent">