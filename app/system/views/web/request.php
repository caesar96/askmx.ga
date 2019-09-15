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
    <div class="headline-menu">
      <a class="link-headline-active">Recuperar la información de la cuenta</a>
    </div>
    
    <div class="questionBox-borderNone">
      Rellena el siguiente formulario. Recibirás un correo electrónico con la información de tu cuenta.
    </div>

    <form action="/remind/send" id="reset_request_form" method="post"><div style="margin:0;padding:0;display:inline"><input name="authenticity_token" type="hidden" value="NOdtrrdayYFhetSCS7rcmljPAgCwFJtH3avtyb+RjBw=" /></div>
      <div class="formContainer">
        <div class="formContainer">
          <div class="formBox-total">
            <div class="formBox-title">
              <span class="text-bold">
                 
                Correo electrónico
              </span>
            </div>
            <input class="input-singleLine" id="reset_request_email" maxlength="50" name="reset_request[email]" size="50" type="text" />
          </div>
        </div>
        <span class="text-bold"></span>
      </div>

      <div id="setting-buttons-container">
        <input class="submit-button submit-button-active" id="reset_request_submit" name="commit" onclick="return !Button.block(this)" type="submit" value="Continuar" />
        
      </div>
    </form>
    
  </div>

</div><script type="text/javascript">AskmH.allow = false;</script>
<?php
if($ajax !== true)
// HEADER HTML
include( 'footer.php' );
//
?>