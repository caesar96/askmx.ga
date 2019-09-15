<form action="javascript:__settings.privacy()" autocomplete="off" id="settings_form" method="post">
	<div class="formContainer">
		<div class="formBox-long">
			<div class="formBox-title">
				<span class="text-bold">Privacidad de la pregunta</span>
			</div>
			<table class="questionPrivacy-table">
				<tr>
					<td>
						<label>
							<input <?php if($data['anon_quest'] == 1):?>checked="checked"<?php endif;?> class="questionPrivacy-radio" id="user_anonymous_tolerance_0" name="anon_quest" tabindex="1" type="radio" value="1" />
							Permitir preguntas anónimas en tu perfil
						</label>
					</td>
				</tr>
				<tr>
					<td>
						<label>
							<input <?php if($data['anon_quest'] == 0):?>checked="checked"<?php endif;?>class="questionPrivacy-radio" id="user_anonymous_tolerance_2" name="anon_quest" tabindex="2" type="radio" value="0" />
							No permitir preguntas anónimas
						</label>
					</td>
				</tr>
			</table>
		</div>
		<div class="formBox-long">
			<div class="formBox-title"> <span class="text-bold"> Notificaciones por correo electrónico</span> </div>
			<div class="checkLevel">
				<input <?php if($data['notify']['mail_questions']):?>checked="checked"<?php endif;?> class="checkLevel-box" id="user_mail_questions" name="mail_questions" tabindex="3" type="checkbox" value="1" />
				<div class="checkLevel-label">
				Recibir una notificación cuando alguien me haga una pregunta
				</div>
			</div>
			<div class="checkLevel">
				<input <?php if($data['notify']['mail_gifts']):?>checked="checked"<?php endif;?> class="checkLevel-box" id="user_mail_gifts" name="mail_gifts" tabindex="4" type="checkbox" value="1" />
				<div class="checkLevel-label">
				Recibir una notificación cuando alguien me haga un regalo
				</div>
			</div>
			<div class="checkLevel">
				<input <?php if($data['notify']['mail_birthdays']):?>checked="checked"<?php endif;?> class="checkLevel-box" id="user_mail_birthdays" name="mail_birthdays" tabindex="5" type="checkbox" value="1" />
				<div class="checkLevel-label">
				Recibir una notificación cuando un amigo cumpla años
				</div>
			</div>
			<div class="checkLevel">
				<input <?php if($data['notify']['mail_digests']):?>checked="checked"<?php endif;?> class="checkLevel-box" id="user_mail_digests" name="mail_digests" tabindex="6" type="checkbox" value="1" />
				<div class="checkLevel-label">
				Resumen mensual de <?php echo $settings['titulo'];?>
				</div>
			</div>
		</div>
		<div class="formBox-long">
			<div class="formBox-title">
				<span class="text-bold"> En directo </span>
			</div>
			<div class="checkLevel">
				<input <?php if($data['show_answers'] == 1):?>checked="checked"<?php endif;?> class="checkLevel-box" id="user_habbit_dont_post_stream" name="d_show_answers" type="checkbox" value="1" />
				<div class="checkLevel-label">
					No mostrar mis respuestas en la sección "En directo".<br/>
					<span class="text-italic text-grey">Tus respuestas ya no aparecerán en la sección "En directo", de este modo tu perfil atraerá menos atención inesperada.</span>
				</div>
			</div>
		</div>
		<div class="formBox-long">
			<div class="formBox-title-nomar">
				<span class="text-bold">Lista negra</span><br/>
				<a href="/account/settings/privacy/blacklist" class="link-blue-underline" onclick="$.fn.colorbox({title:&quot;Lista negra&quot;,href:&quot;/account/settings/privacy/blacklist&quot;}); return false">Ver lista negra</a>
			</div>
		</div>
	</div>
	<div id="setting-buttons-container">
		<input class="submit-button submit-button-active" id="user_submit" name="commit" type="submit" value="Guardar" />
		<input class="submit-button submit-button-active" onclick="window.location='/account/wall'" type="button" value="Cancelar" />
	</div>
</form>