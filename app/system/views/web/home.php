<?php
	//NO NECESITAREMOS DATOS DEL PERFIL EN ESTA PAGINA, VACIAMOS VARIABLE
	unset($data);
	//MOSTRAR "QUIEN ESTA AQUI"
	$home = $user->getUserHome();
	//SI LA PAGINA NO SE SOLICITA POR AJAX, CARGAMOS EL HEADER
	if($ajax !== true)include( 'header.php' );
	//
?>
	<div id="screen">
		<div id="welcome_flop">
			<div id="slogan">Preguntar y responder</div>
			<div class="joinBlock">
			<a href="/signup" class="link-join">Crear una cuenta</a>
			</div>
			<?php if( !empty($home) ):?><div id="here">
			Mira quién está aquí <a href="http://twitter.com/ask_fm" class="follow_us" target="_blank"></a>
			</div><?php endif;?>
		</div>
	</div>
	<?php if( !empty($home) ):?>
	<div id="heads">
		<?php foreach($home as $u):?>
		<a href="/<?php echo $u['u_nick'];?>"><img alt="" class="head" id="face_<?php echo $u['u_id'];?>" src="<?php echo $u['p_avatar'];?>" /></a>
		<?php endforeach;?>
	</div>
	<?php unset($home, $u);endif;?>
	<div id="language">
		<a href="/lang/en" class="link-blue">English</a>
		&#xB7;
		<span class="text-black text-bold">Español</span>
	</div>
<script type="text/javascript">
	$(document).ready(function(){$(".head").tooltip({content: hoverCard})});
	$("body").attr("class", "body-welcome");
</script>
<?php
// VACIAMOS VARIABLES	
unset($home);

//MOSTRAMOS FOOTER SI EL AJAX ESTA DESACTIVADO
if($ajax !== true) include( 'footer.php' );
//
?>