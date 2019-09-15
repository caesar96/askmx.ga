<?php
if(!$user->is_member){
	$page='home';require('home.php');exit();
}
if($ajax !== true)
// HEADER HTML
include( 'header.php' );
//
	$geo = user_geo(getIP());
	$geo = !empty($geo) ? $geo['state'] . ', '.$geo['country'] : '';
?>
<style type="text/css">
    html {
    background-image: none;
    background-color: #264C67;
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-position: left top;
    }
</style>
<div id="wrapper" class="wrapper-top">
	<div class="container">
		<div id="reHeadline">información de perfil (opcional)</div>
		<div class="registrationFinishMessage flashMessage" id="profile_updated" style="display:<?php if(!empty($_GET['f'])):?>block<?php else:?>none<?php endif;?>">
			<?php if(!empty($_GET['f'])):?>Te has registrado con éxito en Ask.fm<?php else:?>Tu perfil ha sido actualizado<?php endif;?>
		</div>
		<div class="settingsErrorMessage flashMessage" id="profile_image_errors" style="display:none">
			Ha surgido un problema al cargar tu imagen<br/>
			Tamaño máximo 8 Mb. JPG, PNG
		</div>
		<div id="registrationPictureBox">
			<div class="registrationLevel">
				<h1>Imagen</h1>
				<div id="coverBox">
					<div class="picture-settings-block">
						<img alt="" <?php if($data['p_avatar']['t'] != 'http://i.imgur.com/HSmdSGH.jpg'):?>style="cursor:pointer;" onclick="$.colorbox({opacity:.4, href: '<?php echo $data['p_avatar']['a'];?>'})" <?php endif;?>id="profile-picture" src="<?php echo $data['p_avatar']['t'];?>" title="" />
						<img alt="Loading" id="profile_avatar_loader" src="<?php echo $settings['source_url'];?>/images/animation/loading.gif" />
					</div>
					<div id="coverOptions">
						<a class="link-blue-underline" style="cursor:pointer;" onclick="showBox({type: 4}); return false; return false;">Cambiar imagen</a>
						<br/>
						<a  class="link-blue-underline" id="remove_picture" onclick="remove_avatar();" style="display:<?php if($data['p_avatar']['t'] != 'http://i.imgur.com/HSmdSGH.jpg'):?>block<?php else:?>none<?php endif;?>">Quitar imagen</a>
					</div>
				</div>
			</div>
		</div>
		<div style="display:none">
			<form method="post" enctype="multipart/form-data" onsubmit="return false;" id="wrapper-upload-container" style="width:370px">
				<div class="clear-container-forms">
					<div class="formBox-long">
						<input class="uploadFile" id="user_upload_photo-input" name="avatar_uploaded_data" type="file" />
						<div id="fileField-subline"> <span class="text-grey">Tamaño máximo 8 Mb. JPG, PNG</span> </div>
					</div>
				</div>
				<div id="login-buttonContainer">
					<input class="submit-button submit-button-active" onclick="Settings.onAvatarFileChange($('#user_upload_photo-input').get(0))" type="button" value="Cargar" />
					<input class="submit-button submit-button-active" onclick="$.fn.colorbox.close()" type="button" value="Cancelar" />
				</div>
			</form>
		</div>

	<!--[if IE 7]>
	<style type="text/css">
	.register {
	display:block;
	width:300px;
	height:40px;
	margin-top:0px;
	margin-bottom:0px;
	margin-left:0px;
	margin-right:auto;
	padding-top:9px;
	padding-bottom:10px;
	padding-right:10px;
	padding-left:10px;
	border:solid 1px #65942A;
	color:#FFF;
	font-weight:bold;
	text-align:center;
	text-decoration:none;
	font-size:16px;
	line-height:20px;
	}
	.register_Active {
	background:#7EB939 url(/images/buttons/register_Submi-ie7t.png) repeat-x center top;
	cursor:pointer;
	}
	.register_Active:hover {
	background:#88C83D url(/images/buttons/register_Submi-ie7t.png) repeat-x center -38px;
	}
	.register_Active:active {
	background:#90D048 url(/images/buttons/register_Submi-ie7t.png) repeat-x center bottom;
	}
	.register_Disabled {
	background:#90D048; /* url(/images/buttons/register_Submi-ie7t.png) repeat-x center bottom;*/
	cursor:default;
	}
	</style>
	<![endif]-->


	<form action="javascript:__settings.profile(true)" autocomplete="off" enctype="multipart/form-data" id="settings_form" method="post">
		<div id="registrationLevelLiner" style="border:none;">
			<div id="registrationLevelLiner2">
				<div id="registrationLevelLiner3" style="border:none;">
					<div id="registrationLevelLiner4">

	<!--
	<div class="registrationLevel">
	<h1></h1>

	</div>
	-->
						<div class="registrationLevel">
							<h1>Localización</h1>
							<input class="Form_text" id="user_location" maxlength="30" name="geo" size="30" tabindex="2" type="text" value="<?php if($data['p_geo']): echo $data['p_geo'];else: echo $geo;endif;?>" />
						</div>
						<div class="registrationLevel">
						<h1>Sobre mí</h1>
						<textarea class="Form_text-multi growable-textarea" cols="40" id="user_about_me" name="about_me" rows="2" tabindex="5"><?php if($data['p_about_me']) echo $data['p_about_me'];?></textarea>
						<h2>Breve presentación sobre ti</h2>
						</div>
						<div class="registrationLevel">
						<h1>Página web</h1>
						<textarea class="Form_text-multi growable-textarea" cols="40" id="user_website" name="website" rows="2" tabindex="6"><?php if($data['p_website']): echo $data['p_website'];else:?>http://<?php endif;?></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="registerHolder">
			<div id="registration-loader" style="display:none"></div>
			<input class="register register_Active" id="user_submit" name="commit" onclick="" type="submit" value="Hecho" />
		</div>
	</form>
	</div>
</div>
<script type="text/javascript" src="<?php echo $settings['source_url'];?>/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="<?php echo $settings['source_url'];?>/js/resize.js"></script>
<script type="text/javascript">$(document).ready(function(){AskmH.allow = false;$("textarea").autoResize()});</script>
<?php
// VACIAMOS VARIABLES	
unset($geo, $data);

//MOSTRAMOS FOOTER SI EL AJAX ESTA DESACTIVADO
if($ajax !== true) include( 'footer.php' );
?>