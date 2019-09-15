<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=780"/>
    <title>La p&aacute;gina solicitada no fue encontrada | <?php echo $settings['titulo'];?></title>
    <link href="<?php echo $settings['source_url'];?>/stylesheets/ltr/_main.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $settings['source_url'];?>/stylesheets/ltr/_menu.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $settings['source_url'];?>/stylesheets/ltr/profile.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $settings['source_url'];?>/stylesheets/kitten.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        html {
            background-color: #264C67;
        }
        body {
            -webkit-text-size-adjust: none;
            -moz-text-size-adjust: none;
            -ms-text-size-adjust: none;
        }
    </style>
</head>
<body>
    <div id="menu" class="menu-top">
        <div id="menuCenter">
            <a href="/"><div id="logo"></div></a>
        </div>
    </div>

    <div id="wrapper" class="wrapper-top">
      <div class="container">
        <div id="kitten-image-anybody">
            <img src="<?php echo $settings['source_url'];?>/images/kittens/lost.png" class="border-none" alt="" />
        </div>
        <div id="kitten-message">
            <span class="kitten-headline">La p&aacute;gina solicitada no fue encontrada</span>
        </div>
        <div id="kitten-return">
            <a class="link-blue-underline" href="/">P&aacute;gina principal</a>
        </div>
      </div>
    </div>

<?php
//MOSTRAMOS FOOTER SI EL AJAX ESTA DESACTIVADO
if($ajax !== true) include( 'footer.php' );
?>