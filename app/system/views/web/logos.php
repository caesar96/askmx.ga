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
<link href="<?php echo $settings['source_url'];?>/stylesheets/logos_buttons.css?1372314840" media="screen" rel="stylesheet" type="text/css" />
<div class="wrapper-top ltr-layout" id="wrapper">
  <div class="container">
    <div class="headline-menu">
      <span class="text-headline">logos y botones</span>
    </div>

    <div class="logos-level">
      <div class="logos-itemLine">
        <a href="<?php echo $settings['source_url'];?>/images/download/ask_fm-logo-512x185.png" class="logos-item">
            <img alt="" class="logos-item-logo" src="<?php echo $settings['source_url'];?>/images/promote/logos_buttons-512x185.png?1372314840" /><br/>
            <span class="text-bold">PNG</span> 512x185px
        </a>
        <a href="<?php echo $settings['source_url'];?>/images/download/ask_fm-logo-512x185.eps" class="logos-item">
            <img alt="" class="logos-item-logo" src="<?php echo $settings['source_url'];?>/images/promote/logos_buttons-512x185.png?1372314840" /><br/>
            Vector <span class="text-bold">EPS</span>
        </a>
      </div>
    </div>

    <div class="logos-level">
      <div class="logos-itemLine">
        <a href="<?php echo $settings['source_url'];?>/images/download/ask_fm-logo-200x200.png" class="buttons-item-megamonster">
            <img alt="" class="icon-200x200" src="<?php echo $settings['source_url'];?>/images/promote/logos_buttons-200x200.png?1372314840" /><br/>
            <span class="text-bold">PNG</span> 200x200px
        </a>
        <a href="<?php echo $settings['source_url'];?>/images/download/ask_fm-logo-75x75.png" class="buttons-item-mega">
            <img alt="" class="icon-75x75" src="<?php echo $settings['source_url'];?>/images/promote/logos_buttons-75x75.png?1372314840" /><br/>
            <span class="text-bold">PNG</span> 75x75px
        </a>
        <a href="<?php echo $settings['source_url'];?>/images/download/ask_fm-logo-50x50.png" class="buttons-item-mega">
            <img alt="" class="icon-50x50" src="<?php echo $settings['source_url'];?>/images/promote/logos_buttons-50x50.png?1372314840" /><br/>
            <span class="text-bold">PNG</span> 50x50px
        </a>
      </div>
    </div>

    <div class="logos-level">
      <div class="logos-itemLine">
        <a href="<?php echo $settings['source_url'];?>/images/download/ask_fm-button-36x36.png" class="buttons-item">
            <img alt="" class="icon-36x36" src="<?php echo $settings['source_url'];?>/images/promote/logos_buttons-36x36.png?1372314840" /><br/>
            <span class="text-bold">PNG</span> 36x36px
        </a>
        <a href="<?php echo $settings['source_url'];?>/images/download/ask_fm-button-24x24.png" class="buttons-item">
            <img alt="" class="icon-24x24" src="<?php echo $settings['source_url'];?>/images/promote/logos_buttons-24x24.png?1372314840" /><br/>
            <span class="text-bold">PNG</span> 24x24px
        </a>
        <a href="<?php echo $settings['source_url'];?>/images/download/ask_fm-button-16x16.png" class="buttons-item">
            <img alt="" class="icon-16x16" src="<?php echo $settings['source_url'];?>/images/promote/logos_buttons-16x16.png?1372314840" /><br/>
            <span class="text-bold">PNG</span> 16x16px
        </a>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">AskmH.allow = false;</script>
<?php
//MOSTRAMOS FOOTER SI EL AJAX ESTA DESACTIVADO
if($ajax !== true) include( 'footer.php' );
?>