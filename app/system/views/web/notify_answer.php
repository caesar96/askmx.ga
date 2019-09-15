<?php
/* No es usuario */
if($user->is_member == false){
	require('home.php');exit();
}
/* Obtener array de notificaciones */
$notifications = $user->getNotify(2, true);

/* Incluir header html si el ajax no esta activado */
if($ajax !== true) include( 'header.php' );
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
			<a class="link-headline-active">respuestas</a>
		</div>
	<?php if(!empty($notifications)):?>
		<?php foreach($notifications as $n):?>
		<div class="questionBox" id="q_a_<?php echo $n['id'];?>">
			<a href="/<?php echo $n['nick'];?>"><img alt="" class="notification-profile" src="<?php echo $n['avatar'];?>" /></a>
			<div class="notification-infoBlock">
				<div class="question">
					<span class="text-12">
						<a href="/<?php echo $n['nick'];?>" class="link-blue"><span dir="ltr"><?php echo $n['name'];?></span></a> respondió a tu <a href="/<?php echo $n['nick'];?>/answer/<?php echo $n['id'];?>" class="link-blue">pregunta</a><br/>
					</span>
				</div>
				<div class="deleteBox ghostLink">
					<a class="delete hintable" title="Eliminar" href="#" onclick="__questions.delet_al(<?php echo $n['id'];?>);return false;"></a>
				</div>
				<div class="time">
					<?php echo $n['date'];?>
				</div>
			</div>
		</div>
		<?php endforeach;?>
	<?php endif;?>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$(".questionBox, .questionBox-daily, .questionBox-sponsored").mouseenter(function() {
		$(this).find(".ghostLink").show()
	}).mouseleave(function() {
		$(this).find(".ghostLink").hide()
	});
});
</script>
<?php
/* Incluir footer html si el ajax no esta activado */
if($ajax !== true)include( 'footer.php' );
?>