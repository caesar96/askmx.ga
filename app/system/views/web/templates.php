<?php
if(!empty($_GET['template']))
{
	switch($_GET['template'])
	{
		case 'login':
			if($user->is_member == false)
				t_login();
			break;
		case 'contact':
			t_contact();
			break;
		case 'captcha':
			recaptcha();
			break;
		case 'answer_ajax':
			if(!empty($_GET['id']) && is_numeric($_GET['id']))
			answer_ajax($_GET['id']);
			break;
		case 'upload_avatar':
			upload_img_box();
			break;
		default:
			break;
	}
}
function recaptcha(){
	echo ' <script type="text/javascript"
     src="http://www.google.com/recaptcha/api/challenge?k=6LfIZuQSAAAAAOsVURb-R8kynsuuFeDJZv4RQ2Zu">
  </script>
 
     <iframe src="http://www.google.com/recaptcha/api/noscript?k=6LfIZuQSAAAAAOsVURb-R8kynsuuFeDJZv4RQ2Zu"
         height="300" width="500" frameborder="0"></iframe><br>
     <textarea name="recaptcha_challenge_field" rows="3" cols="40">
     </textarea>
     <input type="hidden" name="recaptcha_response_field"
         value="manual_challenge">
  ';
}
function answer_ajax($id){
	global $user, $settings;
	$info = $user->getProfile($id);
	if(!empty($info)){
		$info['anon_quest'] = empty($info['anon_quest']) ? 0 : 1;
		$info['notify'] = empty($info['notify_email']) ? 0 : unserialize($info['notify_email']);
		$info['show_answers'] = empty($info['show_own_answers']) ? 0 : $info['show_own_answers'];
		unset($info['notify_email'], $info['show_own_answers']);
	}
	else return "<h4>El usuario no existe</h4>";
?>
<div id="popup-content" style="width:592px"> <!-- style="width:600px"-->
	<div id="popup_ask_form_container">
		<!--#show form layout-->
		<!--#show actual form-->
		<?php if($user->is_member == false && $info['anon_quest'] == 0):?>
		<div id="reMotivation_box" class="reMotivation_box-simple">
			<h1>Para hacer una pregunta a este usuario tienes que iniciar sesión.</h1>
			<div id="choiceContainer">
				<a href="/signup" class="choiceRegister">Crear una cuenta</a>
				<a style="cursor:pointer;" class="choiceAsk" onclick="showBox({type:1});return false;">Entrar</a>
			</div>
		</div>
		<?php else:?>
		<form id="question_form" method="post" style="display:block">
			<div id="questionPop-title">
				<div class="questionPop-text">
					<span class="text-headline" dir="ltr"><span dir="ltr"><?php if($info['p_title_page']): echo $info['p_title_page'];else:?>Hazme una pregunta :D<?php endif;?></span></span>
				</div>
			</div>
			<div id="postLoaderTerritory">
				<textarea id="popup-ask-textarea" name="question[question_text]" style="overflow:auto"></textarea>
				<div id="postLoader"></div>
			</div>
			<div id="post_options-border">
				<div id="post_options">
					<div id="generalLevel">
						<div class="profile-title-counter" id="question_counter_span" style="">300</div>
						<input type="hidden" name="touser" value="<?php echo $info['u_id'];?>" />
						<input onclick="__questions.send();" class="submitBlue submitBlue-active" id="question_submit" name="commit" type="button" value="Preguntar" />
						<?php if($user->is_member == true):?>
						<div class="questionType_box">
							<label class="typeCheckbox_text<?php if($$info['anon_quest'] == 0):?> strikeout text-grey<?php endif;?>" for="quest_anon">Pregunta anónimamente</label>
							<input <?php if($info['anon_quest'] == 0):?> disabled="disabled"<?php endif;?> class="typeCheckbox" id="quest_anon" name="quest_anon" type="checkbox" value="force_anonymous">
						</div>
						<?php endif;?>
					</div>
				</div>
			</div>
		</form>
		<?php if($user->is_member):?>
		<div id="reMotivation_box" class="reMotivation_box-simple" style="display:none">
		  <h1>Tu pregunta ha sido enviada.</h1>
		  <div id="choiceContainer">
			<a href="javascript:void(0)" class="choiceAsk-logged" onclick="$('#reMotivation_box').hide();$('#question_form').show();$('#postLoaderTerritory textarea').val('').focus(); return false">Hacer otra pregunta</a>
		  </div>
		</div>
		<?php else:?>
		<div id="reMotivation_box" class="reMotivation_box-complex" style="display:none">
			<h1>Tu pregunta ha sido enviada.</h1>
			<div id="choiceContainer">
				<a href="/signup" class="choiceRegister">Crear una cuenta</a>
				<a href="javascript:void(0)" class="choiceAsk" onclick="$('#reMotivation_box').hide();$('#question_form').show();$('#postLoaderTerritory textarea').val('').focus(); return false">Hacer otra pregunta</a>
			</div>
			<h2>
			¡Únete a <?php echo $settings['titulo'];?> ahora! Recibirás notificaciones cada vez que tu pregunta haya sido respondida.<br>
			Podrás seguir a gente interesante y responder a sus preguntas
			</h2>
		</div>
		<?php endif;?>
		<?php endif;?>
	</div>
</div>
<script type="text/javascript">$(document).ready(function(){$("#postLoaderTerritory").on("keyup","textarea",l_text);});function l_text(){l=300;if(l-$(this).val().length<0)$(this).val($(this).val().substr(0,l));if($(this).val().length>=300)$(".profile-title-counter").css("color","red");else $(".profile-title-counter").css("color","green");$(".profile-title-counter").html(l-$(this).val().length)}</script>
<?php
}
function upload_img_box(){ ?>
<form method="post" enctype="multipart/form-data" id="wrapper-upload-container" style="width:370px">
        <div class="clear-container-forms">
          <div class="formBox-long">
            <input class="uploadFile" onchange="upload_avatar(this);" id="user_avatar" name="user_avatar" type="file">
            <div id="fileField-subline"> <span class="text-grey">Tamaño máximo 1 Mb. JPG, PNG, GIF</span> </div>
          </div>
        </div>
        <div id="login-buttonContainer">
          <!--<input class="submit-button submit-button-active" onclick="upload_avatar();" type="button" value="Cargar">-->
          <input class="submit-button submit-button-active" onclick="$.colorbox.close();" type="button" value="Cancelar">
        </div>
</form>
<?php
}
function t_sendemail(){ ?>
  <table cellspacing="0" cellpadding="0" style="background:#ddebf1;padding:20px;width:100%;font-family:Verdana,Tahoma,Arial,Helvetica,sans-serif;font-size:14px">
    <tbody>
      <tr>
        <td style="background-color:#1f3e5d;border:1px solid #1f3e5d;min-height:40px;padding:0px 10px 0px;color:#fff;font-weight:bold">
          <img alt="Ask.fm" src="http://ask.fm/images/logos/ask_fm-email.jpg" style="border:none">
        </td>
      </tr>
      <tr>
        <td style="background-color:#fff;border:1px solid #fff;padding:20px">
          <strong>
            Te has registrado con éxito en Ask.fm
          </strong>
          <p style="font-size:16px">
            Tu página es
            <a href="http://link.ask.fm/goto/50aiCb_tfaGMFH48iDv3_ps0ox2a9tjF4SLHpPu39CvFOApvJ9VC" dir="ltr" style="color:#3081a3" target="_blank">http://ask.fm/taringxd</a>
          </p>
        </td>
      </tr>
      <tr>
        <td style="padding-left:20px;padding-right:20px;padding-top:0px;padding-bottom:0px">
          <p style="font-size:11px;color:#898989">
            En redes sociales: <a href="http://ask.fm/askfm" dir="ltr" style="color:#3081a3" target="_blank">Ask.fm</a>
            | <a href="http://twitter.com/ask_fm" dir="ltr" style="color:#3081a3" target="_blank">Twitter</a>
            | <a href="http://www.facebook.com/askfmpage" dir="ltr" style="color:#3081a3" target="_blank">Facebook</a>
          </p>
        </td>
      </tr>
    </tbody>
  </table>
<?php }
function t_login(){
	global $settings;
?>
<div id="login_popup" style="width:600px">
	<div id="popup-login-container">
		<form action="javascript:login.submit();" id="quick_login_form" method="POST">
			<div style="margin:0;padding:0;display:inline">
				<input name="authenticity_token" type="hidden" value="" />
			</div>
			<div id="login-connect-popup">
				<br/>
				<div class="connect-or-popup">o</div>
				<div class="connect-container-popup">
					<a href="javascript:void(0)" class="button-connect-fb" onclick="">
						<span>Iniciar sesión con Facebook</span>
					</a>
					<a href="javascript:void(0)" class="button-connect-tw" onclick="">
						<span>Iniciar sesión con Twitter</span>
					</a>
					<img alt="" class="login-social-loader" src="<?php echo $settings['source_url'];?>/images/animation/loading.gif" />
				</div>
			</div>
			<div class="formBox-popup">
				<div class="formBox-title">
					<span class="text-bold"><label for="username">Nombre de usuario</label></span>
				</div>
				<input class="input-singleLine-popup" id="username" maxlength="40" name="username" tabindex="101" type="text" value="" />
			</div>
			<div class="formBox-popup">
				<div class="formBox-title">
					<span class="text-bold"><label for="password">Contraseña</label></span>
				</div>
				<input class="input-singleLine-popup" id="password" maxlength="20" name="password" tabindex="102" type="password" />
			</div>
			<div id="login-buttonContainer">
				<input id="login_follow" name="follow" type="hidden" />
				<input id="login_like" name="like" type="hidden" />
				<input id="login_back" name="back" type="hidden" />
				<input class="submit-button submit-button-active" name="commit" onclick="" tabindex="104" type="submit" value="Iniciar sesión" />
				<div id="login-loader"></div>
				<div class="incorrectLogin" style="display:none"></div>
			</div>
			<div class="remember_me-popup">
				<input autocomplete="off" class="settings-checkbox" id="remember_me" name="remember_me" tabindex="105" type="checkbox" value="1" />
				<span class="recieveEmails-text">No cerrar sesión</span>
			</div>
			<div class="forgotPassword-container-popup">
				<a href="/remind/request" class="link-blue-underline" tabindex="106">
					<span class="text-12">¿Olvidaste tu contraseña o tu nombre de usuario?</span>
				</a>
			</div>
		</form>
	</div>
</div>
<?php 
} 
function t_contact(){
?>
<div style="width:600px">

  <div id="popup-content">
    

<form action="javascript:alert('Proximamente')" id="contact_us_form" method="post" onsubmit="">
  <div class="clear-container-forms">
    <div class="formBox-long-popup">
      <div class="formBox-title">
        <span class="text-bold">
          Tu correo electrónico
        </span>
      </div>
      <input class="input-singleLine" id="feedback_email" name="feedback[email]" size="30" type="text">
    </div>
    <div class="formBox-long-popup">
      <div class="formBox-title">
        <span class="text-bold">
          Tu mensaje
        </span>
      </div>
      <textarea class="input-multiMail" cols="40" id="feedback_text" name="feedback[text]" rows="20"></textarea>
    </div>
    <div id="login-buttonContainer">
      <input autocomplete="off" id="source" name="source" type="hidden">
      <input class="submit-button submit-button-active" id="contact_us_submit"  type="button" value="Enviar">
      <input class="submit-button submit-button-active" onclick="$.colorbox.close()" type="button" value="Cancelar">
    </div>
  </div>
</form>
  </div>
</div>
<?php 

}

?>