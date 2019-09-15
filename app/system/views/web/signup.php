<?php
if($ajax !== true)
// HEADER HTML
include( 'header.php' );
//
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
		<div id="reHeadline">Crear una cuenta</div>
		<div id="registrationServiceBox">
			<a href="/facebook_session/registration" class="serveFacebook" onclick="Signup.showSocialLoader(this, 'serveFacebook-fill', 'serveFacebook-fill_active')">
				<div class="serveFacebook-fill">
					<img alt="Servefacebook" src="<?php echo $settings['source_url'];?>/images/buttons/serveFacebook.png?1371566220" />
					<h1><b>Registrarse</b> por <b>Facebook</b></h1>
				</div>
				<img alt="Servefacebook_loader" class="serveLoading serveLoading-Facebook" src="<?php echo $settings['source_url'];?>/images/animation/serveFacebook_loader.gif?1371566220" style="display:none" />
			</a>
			<a href="/twitter_session/registration" class="serveTwitter" onclick="Signup.showSocialLoader(this, 'serveTwitter-fill', 'serveTwitter-fill_active')">
				<div class="serveTwitter-fill">
					<img alt="Servetwitter" src="<?php echo $settings['source_url'];?>/images/buttons/serveTwitter.png?1371566220" />
					<h1><b>Registrarse</b> por <b>Twitter</b></h1>
				</div>
				<img alt="Servetwitter_loader" class="serveLoading serveLoading-Twitter" src="<?php echo $settings['source_url'];?>/images/animation/serveTwitter_loader.gif?1371566220" style="display:none" />
			</a>
			<div id="captcha"></div>
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
    background:#7EB939 url(<?php echo $settings['source_url'];?>/images/buttons/register_Submi-ie7t.png) repeat-x center top;
    cursor:pointer;
}
.register_Active:hover {
    background:#88C83D url(<?php echo $settings['source_url'];?>/images/buttons/register_Submi-ie7t.png) repeat-x center -38px;
}
.register_Active:active {
    background:#90D048 url(<?php echo $settings['source_url'];?>/images/buttons/register_Submi-ie7t.png) repeat-x center bottom;
}
.register_Disabled {
    background:#90D048; /* url(<?php echo $settings['source_url'];?>/images/buttons/register_Submi-ie7t.png) repeat-x center bottom;*/
    cursor:default;
}
</style>
<![endif]-->
		<form action="javascript:Register.submit();" autocomplete="off" enctype="multipart/form-data" id="signup_form" method="post">
			<div style="margin:0;padding:0;display:inline"></div>
			<div id="registrationLevelLiner">
				<div id="registrationLevelLiner2">
					<div id="or">o</div>
					<div class="registrationLevel registrationLevel-username">
						<div id="usernameFailMessage" style="display:none"><span></span></div>
						<div id="usernameCheck" clasesss="usernamePassLoadingFail" class="username"></div>
						<h1>Nombre de usuario <span class="asterisk">*</span></h1>
						<input class=" Form_text Form_text-username" id="user_login" maxlength="40" name="nick" onkeyup="" size="40" tabindex="1" type="text" />
						<h2>Tu dirección Ask.fm será <span id="subdomain_field_pri" dir="ltr"><?php echo $settings['url'];?></span></h2>
					</div>
					<div class="registrationLevel">
						<h1>Nombre y apellidos <span class="asterisk">*</span></h1>
						<input class="Form_text" id="user_name" maxlength="30" name="name" size="30" tabindex="2" type="text" onkeyup=""/>
					</div>
					<div class="registrationLevel registrationLevel-username">
						<div id="passwordFailMessage" style="display:none"><span>contraseña débil</span></div>
						<div id="passwordCheck"></div>
						<h1>Contraseña <span class="asterisk">*</span></h1>
						<input class="Form_text Form_text-username" id="user_password" maxlength="20" name="pass" size="20" tabindex="3" type="password" />
						<h2>6-20 caracteres</h2>
					</div>
					<div class="registrationLevel">
						<h1>Repetir contraseña <span class="asterisk">*</span></h1>
						<input class="Form_text" id="user_password_confirmation" maxlength="20" name="pass1" size="20" tabindex="4" type="password" />
					</div>
					<div class="registrationLevel">
						<h1>Correo electrónico <span class="asterisk">*</span> <span id="messagee" style="color: red;font-size: 12px;"></span></h1>
						<input class="Form_text" id="user_email" maxlength="50" name="email" size="50" tabindex="5" type="text" />
					</div>
					<div class="registrationLevel">
						<h1>Fecha de nacimiento <span class="asterisk">*</span></h1>
						<div class="Form_select-group">
							<select class="Form_select Form_select-group-xSmall" id="user_born_at_day" name="day" tabindex="6">
								<option value="">Día</option>
								<?php for($day = 1;$day<=31;++$day):?>
									<option value="<?php echo $day;?>"><?php echo $day;?></option>
								<?php endfor;?>
							</select>
							<select class="Form_select Form_select-group-Medium" id="user_born_at_month" name="month" tabindex="7">
								<option value="">Mes</option>
								<option value="1">Enero</option>
								<option value="2">Febrero</option>
								<option value="3">Marzo</option>
								<option value="4">Abril</option>
								<option value="5">Mayo</option>
								<option value="6">Junio</option>
								<option value="7">Julio</option>
								<option value="8">Agosto</option>
								<option value="9">Septiembre</option>
								<option value="10">Octubre</option>
								<option value="11">Noviembre</option>
								<option value="12">Diciembre</option>
							</select>
							<select class="Form_select Form_select-group-Small" id="user_born_at_year" name="year" tabindex="8">
								<option value="">Año</option>
								<?php for($year = date('Y');$year>=1900;--$year):?>
									<option value="<?php echo $year;?>"><?php echo $year;?></option>
								<?php endfor;?>
							</select>
						</div>
						<h2>El resto de usuarios no podrán ver tu edad</h2>
					</div>
					<div class="registrationLevel">
						<h1>Idioma <span class="asterisk">*</span></h1>
						<select class="Form_select" id="user_language_id" name="lang" tabindex="9">
							<option value="2">English</option>
							<option value="1" selected="selected">Español</option>
						</select>
					</div>
				</div>
				<div id="termsHolder">
					Al hacer clic en Registrarse, usted acepta nuestros <a href="/about/tos" class="link-blue-underline nowrap" target="_blank">Términos</a>.
				</div>
				<div id="registerHolder">
					<div id="registration-loader" style="display:none"></div>
					<div id="ldng" style="margin-left:130px;display:none;background: url('https://i.imgur.com/dJp3Fsd.gif') no-repeat;width:54px;height:55px;"></div>
					<input style="display:block;" class="register register_Active" id="user_submit" name="submit" onclick="" type="submit" value="Registrarse" />
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
/*
* check browser supports local storage
*/
	if (localStorage) {
		var $form = $("form input[type=text], input[type=password]");
		$.each($form, function(k, v){
			if(localStorage[$(v).attr("name")]){
				$(v).val(localStorage[$(v).attr("name")]);
			}
		});
	}
});
$("form[id=signup_form]").on("change", "input", 'select', function() {
	$this = $(this);
    localStorage[$this.attr("name")] = $this.val();
});
</script>
<script type="text/javascript">
$("form[id=signup_form]").on("keyup","input",function(){var e=$("input[type=text], input[type=password]");var t=$(this).attr("name");if(t!="pass1")Register.setTime(this,t);$.each(e,function(e,t){var n=$(t).val();if(!n){$(t).removeClass("fieldWell");$(t).addClass("fieldWithErrors")}else{$(t).removeClass("fieldWithErrors")}});if($("input[name=pass]").val()){if($("input[name=pass1]").val()==$("input[name=pass]").val()){$("input[name=pass1]").removeClass("fieldWithErrors");$("input[name=pass1]").addClass("fieldWell")}else{$("input[name=pass1]").removeClass("fieldWell");$("input[name=pass1]").addClass("fieldWithErrors")}}})
</script>
<?php
if($ajax !== true)
// HEADER HTML
include( 'footer.php' );
//
?>