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
<div class="wrapper-top" id="wrapper">
	<div class="mobile-container">
	<div class="headline-menu">
	  <span class="text-headline">Contáctanos</span>
	</div>
	<form action="/feedbacks" method="post"><div style="margin:0;padding:0;display:inline"><input name="authenticity_token" type="hidden" value="y+YTUK0tqzxENE7V4kBpG4xNvPL4VQ6Wm2kv2gXXisY=" /></div>
	<div class="formBox">
	  <div class="formBox-title">
		<span class="text-bold">Tu correo electrónico</span>
	  </div>
	  <input class="input-singleLine" id="feedback_email" name="feedback[email]" size="30" type="text" />
	</div>
	<div class="formBox-long">
	  <div class="formBox-title">
		<span class="text-bold">Tu mensaje</span>
	  </div>
	  <textarea class="input-multiMail" cols="40" id="feedback_text" name="feedback[text]" rows="20"></textarea>
	</div>
	<div id="more-container-float">
	  <div id="more-container2">
		<input autocomplete="off" id="source" name="source" type="hidden" />
		<input class="submit-button submit-button-active" onclick="return !Button.block(this)" type="submit" value="Enviar" />
		<input class="submit-button submit-button-active" onclick="window.location='/'" type="button" value="Cancelar" />
	  </div>
	</div>
	</form>
	</div>

</div>

<?php
//MOSTRAMOS FOOTER SI EL AJAX ESTA DESACTIVADO
if($ajax !== true) include( 'footer.php' );
?>