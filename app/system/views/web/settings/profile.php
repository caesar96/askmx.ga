	<div style="display:none" id="upIMG">
		<form method="post" enctype="multipart/form-data" onsubmit="return false;" id="wrapper-upload-container" style="width:370px">
			<div class="clear-container-forms">
				<div class="formBox-long">
					<input class="uploadFile" id="user_upload_photo-input" name="avatar_uploaded_data" type="file" />
					<div id="fileField-subline"> <span class="text-grey">Tamaño máximo 8 Mb. JPG, PNG</span> </div>
				</div>
			</div>
			<div id="login-buttonContainer">
				<input class="submit-button submit-button-active" onclick="Settings.onAvatarFileChange($('#user_upload_photo-input').get(0))" type="button" value="Cargar" />
				<input class="submit-button submit-button-active" onclick="$.colorbox.close()" type="button" value="Cancelar" />
			</div>
		</form>
	</div>

	<form action="javascript:__settings.profile()" autocomplete="off" enctype="multipart/form-data" id="settings_form" method="post">
		<div id="settingsHolder">
			<div class="registrationFinishMessage flashMessage" id="profile_updated" style="display:none">
			Tu perfil ha sido actualizado
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
			<div class="registrationLevel">
				<h1>Nombre y apellidos <span class="asterisk">*</span></h1>
				<input class="Form_text" id="user_name" maxlength="30" name="name" size="30" tabindex="1" type="text" value="<?php if($data['p_name']) echo $data['p_name'];?>" />
			</div>
			<div class="registrationLevel">
				<h1>Localización</h1>
				<input class="Form_text" id="user_location" maxlength="30" name="geo" size="30" tabindex="2" type="text" value="<?php if($data['p_geo']): echo $data['p_geo'];else: echo $geo;endif;?>" />
			</div>
			<div class="registrationLevel">
				<h1>Idioma</h1>
				<select class="Form_select" id="user_language_id" name="lang" tabindex="3">
					<option value="1">English</option>
					<option value="<?php if($data['p_lang']) echo $data['p_lang'];?>" selected="selected">Español</option>
				</select>
			</div>
			<div class="registrationLevel">
				<h1>Sobre mí</h1>
				<textarea class="Form_text-multi growable-textarea" cols="40" id="user_about_me" name="about_me" rows="2" tabindex="4"><?php if($data['p_about_me']) echo $data['p_about_me'];?></textarea>
				<h2>Breve presentación sobre ti</h2>
			</div>
			<div class="registrationLevel">
				<h1>Página web</h1>
				<textarea class="Form_text-multi growable-textarea" cols="40" id="user_website" name="website"  rows="2" tabindex="5"><?php if($data['p_website']) echo $data['p_website'];?></textarea>
			</div>
			<div class="registrationLevel">
			<h1>Título de la página</h1>
			<textarea class="Form_text-multi growable-textarea" cols="40" id="user_headline" name="page_title"  rows="20" style="height:18px" tabindex="6"><?php if($data['p_title_page']) echo $data['p_title_page'];?></textarea>
			</div>
			<div class="registrationLevel registrationLevel-username">
				<div id="usernameFailMessage" style="display:none"><span></span></div>
				<div id="usernameCheck"></div>
				<h1>Nombre de usuario <span class="asterisk">*</span></h1>
				<input class="Form_text Form_text-username" disabled="disabled" id="user_login" maxlength="40" name="nick" size="40" tabindex="7" type="text" value="<?php if($data['u_nick']) echo $data['u_nick'];?>" />
				<h2>Tu dirección <?php echo $settings['titulo'];?> será <span id="subdomain_field_pri" dir="ltr"><?php if($data['u_nick']) echo $settings['url'].'/'.$data['u_nick'];?></span></h2>
			</div>
			<div class="registrationLevel">
				<h1>Correo electrónico <span class="asterisk">*</span></h1>
				<input class="Form_text" id="user_email" maxlength="50" name="email" size="50" tabindex="8" type="text" value="<?php if($data['u_email']) echo $data['u_email'];?>" />
			</div>
			<div class="registrationLevel">
				<h1>Fecha de nacimiento <span class="asterisk">*</span></h1>
				<div class="Form_select-group">
					<select class="Form_select Form_select-group-xSmall" id="user_born_at_day" name="day" tabindex="9">
						<option value="">Día</option>
						<?php for($i=0;$i<=30;++$i):?>
						<option <?php if($data['p_day'] == $i):?>selected="selected"<?php endif;?>value="<?php echo $i;?>"><?php echo $i;?></option>
						<?php endfor;?>
					</select>
					<select class="Form_select Form_select-group-Medium" id="user_born_at_month" name="month" tabindex="10">
						<option value="">Mes</option>
						<?php foreach($months as $n => $month):?>
						<option <?php if($n == $data['p_month']):?>selected="selected"<?php endif;?> value="<?php echo $n;?>"><?php echo $month;?></option>
						<?php endforeach;?>
					</select>
					<select class="Form_select Form_select-group-Small" id="user_born_at_year" name="year" tabindex="11">
						<option value="">Año</option>
						<?php for($i=date('Y');$i>1930 ;--$i):?>
						<option <?php if($data['p_year'] == $i):?>selected="selected"<?php endif;?>value="<?php echo $i;?>"><?php echo $i;?></option>
						<?php endfor;?>						
					</select>
				</div>
				<h2>El resto de usuarios no podrán ver tu edad</h2>
			</div>
			<div id="password_change_switch" style="display:block">
				<div class="registrationLevel">
					<h1>Contraseña</h1>
					<a style="cursor:pointer;" class="link-blue-underline" onclick="$('#password_change_block').show();$('#password_change_switch').hide()">Cambiar contraseña</a>
				</div>
			</div>
			<div id="password_change_block" style="display:none">
				<div class="registrationLevel">
					<h1>Contraseña actual</h1>
					<input class="Form_text" id="user_current_password" maxlength="20" name="current_password" size="20" tabindex="13" type="password">
				</div>
				<div class="registrationLevel registrationLevel-username">
					<div id="passwordFailMessage" style="display:none"><span>contraseña débil</span></div>
					<div id="passwordCheck"></div>
					<h1>Nueva contraseña</h1>
					<input class="Form_text Form_text-username" id="user_password" maxlength="20" name="password" size="20" tabindex="14" type="password">
					<h2>6-20 caracteres</h2>
				</div>
				<div class="registrationLevel">
					<h1>Repetir contraseña</h1>
					<input class="Form_text" id="user_password_confirmation" maxlength="20" name="password_confirmation" size="20" tabindex="15" type="password">
				</div>
			</div>
		</div>
		<div id="setting-buttons-container">
			<input class="submit-button submit-button-active" id="user_submit" name="commit" tabindex="16" type="submit" value="Guardar" />
			<input class="submit-button submit-button-active" onclick="window.location='<?php echo $settings['url'];?>/account/wall'" tabindex="17" type="button" value="Cancelar" />
			<a href="/account/settings/deactivation" class="link-disableAccount" tabindex="18">Desactivar cuenta</a>
		</div>
	</form>
<script type="text/javascript" src="<?php echo $settings['source_url'];?>/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="<?php echo $settings['source_url'];?>/js/resize.js"></script>
<script type="text/javascript">$(document).ready(function(){$("textarea").autoResize()});</script>