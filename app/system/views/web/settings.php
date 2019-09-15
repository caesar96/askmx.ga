<?php
	/* SI EL USUARIO NO ES MIEMBRO MOSTRAMOS LA HOME */
	if(!$user->is_member){
		$page='home';require('home.php');exit();
	}
	/* INCLUIMOS DATOS DE LOS MESES */
	require ( MODELS. 'data.php' );
	/* SI LA NAVEGACION POR AJAX NO ESTA ACTIVADA ENTONCES INCLUIMOS EL HEADER HTML */
	if( !$ajax ) include( 'header.php' );
	$geo = user_geo(getIP());
	$geo = !empty($geo) ? $geo['state'] . ', '.$geo['country'] : '';
?>
<style type="text/css">
    html {
		background-image: <?php if(!empty($data['p_background']) && !empty($data['p_background']['background-image'])): echo $data['p_background']['background-image'];else:?>none<?php endif;?>;
		background-color: <?php if(!empty($data['p_background']) && !empty($data['p_background']['background-color'])): echo '#'.$data['p_background']['background-color'];else:?>#264C67<?php endif;?>;
		background-attachment: <?php if(!empty($data['p_background']) && !empty($data['p_background']['background-attachment'])): echo $data['p_background']['background-attachment'];else:?>fixed<?php endif;?>;
		background-repeat: <?php if(!empty($data['p_background']) && !empty($data['p_background']['background-repeat'])): echo $data['p_background']['background-repeat'];else:?>no-repeat<?php endif;?>;
		background-position: <?php if(!empty($data['p_background']) && !empty($data['p_background']['background-position'])): echo $data['p_background']['background-position'];else:?>left top<?php endif;?>;
    }
</style>
<div id="wrapper" class="wrapper-top">
<div class="container">
	<div class="headline-menu">
		<a href="/account/settings/profile" class="link-headline<?php if($_GET['nav'] == 'profile'):?>-active<?php endif;?>">perfil</a>
		<div class="link-headline-seperator"></div>
		<a href="/account/settings/privacy" class="link-headline<?php if($_GET['nav'] == 'privacy'):?>-active<?php endif;?>">privacidad</a>
		<div class="link-headline-seperator"></div>
		<a href="/account/settings/design" class="link-headline<?php if($_GET['nav'] == 'design'):?>-active<?php endif;?>">diseño</a>
		<div class="link-headline-seperator"></div>
		<a href="/account/settings/services" class="link-headline<?php if($_GET['nav'] == 'services'):?>-active<?php endif;?>">servicios</a>
		<div class="link-headline-seperator"></div>
		<a href="/settings/widget/setup" class="link-headline">miniaplicación</a>
	</div>
<?php
	switch($_GET['nav']){
		case 'profile':include( HTML . 'settings/profile.php' );break;
		case 'privacy':include( HTML . 'settings/privacy.php' );break;
		case 'design':include( HTML . 'settings/design.php' );break;
		case 'services':include( HTML . 'settings/services.php' );break;
	}
?>
</div>
</div>
<?php
// VACIAMOS VARIABLES	
unset($geo, $data, $_GET['nav']);

//MOSTRAMOS FOOTER SI EL AJAX ESTA DESACTIVADO
if($ajax !== true) include( 'footer.php' );
//
?>