<?php
if($user->is_member == false){
	require('home.php');exit();
}
//PREGUNTAS
$quest = (empty($_GET['user']) && empty($_GET['quest_id'])) ? $user->getQuestion($user->id) : $user->getQuestion($user->id, $_GET['quest_id']);
//Leer NOTIFICACIONES AL INGRESAR A LA PAGINA
if($user->notifications['quest'] > 0) $user->readNotify(1);
//
if($ajax !== true) include( 'header.php' );
//
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
	<div class="container-wide">
		<div class="headline-menu" id="inbox_headline_menu">
			<a class="link-headline-active">preguntas</a>
			<a class="link-silver-medium-right link-silver-medium-right-active" href="javascript:void(0)" id="inbox_random_button" onclick="var self = this; if (Inbox.disableRandom(self)) return false; ; $.ajax({complete:function(request){Inbox.enableRandom(self)}, data:'authenticity_token=' + encodeURIComponent('OqFmzhLUK/vz6Z0sULXCgb8PZcWmstjLQ2CDHsdKLgc='), dataType:'script', type:'post', url:'/questions/random'}); return false;" onmouseover="return false">Obtener una pregunta al azar</a>
		</div>
	<?php if(empty($_GET['user']) && empty($_GET['quest_id'])):?>
		<div id="inbox_content_head">
			<div id="wall_notice_container">
				<a href="javascript:void(0)" class="link-news" id="wall_notice_content" onclick="Inbox.clickNotice('/account/questions/append', poller)">
					<span class="wall-notice" id="wall_notice_one"><span class="wall-notice-counter"></span>&nbsp;pregunta nueva</span>
					<span class="wall-notice" id="wall_notice_two"><span class="wall-notice-counter"></span>&nbsp;preguntas nuevas</span>
					<span class="wall-notice" id="wall_notice_five"><span class="wall-notice-counter"></span>&nbsp;preguntas nuevas</span>
					<span class="wall-notice" id="wall_notice_more"><span class="wall-notice-counter"></span>&nbsp;preguntas nuevas</span>
				</a>
			</div>
			<!--<div class="questionBox-daily">
				<div class="question" dir="ltr">
					<span class="text-bold"><span dir="ltr">¿Qué te dice tu intuición en este momento?</span></span>
				</div>
				<div class="deleteBox ghostLink">
					<a class="delete hintable" hint="Eliminar" href="javascript:void(0)" onclick="return false;"></a>
				</div>
				<div class="time-inbox">
					<span class="qofday-label">Pregunta del día</span>
					<img alt="" class="qofday-icon" height="12" src="/images/icons/timer.png" width="12" />
					<span class="qofday-timer">
						21 horas restantes
					</span>
				</div>
				<div class="answer-linkBox">
					<a href="/today/question/reply" class="link-blue text-12">Responder</a>
					<span class="answer-linkBox-seperator">/</span>
					<a href="/today/question/video_reply" class="link-blue text-12">Grabar una respuesta de vídeo</a>
				</div>
			</div>
			<div class="questionBox-sponsored" style="display:block">
				<div class="question" dir="ltr">
					<span class="text-bold"><span dir="ltr">¿Ya tienes la aplicación Ask.fm para iPhone?</span></span>
				</div>
				<div class="deleteBox ghostLink">
					<a class="delete-blue hintable" hint="Eliminar" href="javascript:void(0)" onclick=""></a>
				</div>
				<div class="ticket-boxInbox" dir="ltr"><a href="/go/sponsor_question/260" class="ticket" target="_blank"><span dir="ltr">Aplicación Ask.fm para iPhone</span></a></div>
				<div class="time-inbox">
					<span class="qofday-label">Pregunta patrocinada</span>
				</div>
				<div class="answer-linkBox">
					<a href="/sponsor/question/260/reply" class="link-blue text-12">Responder</a>
					<span class="answer-linkBox-seperator">/</span>
					<a href="/sponsor/question/260/video_reply" class="link-blue text-12">Grabar una respuesta de vídeo</a>
				</div>
			</div>
		</div>-->
		<?php if(!empty($quest)):?>
		<?php foreach($quest as $q):?>
		<div class="questionBox" id="inbox_question_<?php echo $q['q_id'];?>">
			<div class="question" dir="ltr">
				<span class="text-bold"><span dir="ltr"><?php echo $q['q_quest'];?></span></span><?php if(!empty($q['q_username']) && !empty($q['q_user_nick'])):?>‎<span class="author nowrap">&nbsp;&nbsp;<a href="/<?php echo $q['q_user_nick'];?>" class="link-blue" dir="ltr"><?php echo $q['q_username'];?></a></span><?php endif;?>
			</div>
			<div class="deleteBox ghostLink">
				<a onclick="showBox({message: '¿Estás seguro de que quieres eliminar la pregunta <span style=\'color:black;\'>\'<?php echo $q['q_quest'];?>\'</span>?', buttons: {aceptar: true, close:true, event: '__questions.delet(<?php echo $q['q_id'];?>);$.colorbox.close();return false;'} });" class="delete hintable" title="Eliminar" hint="Eliminar" href="javascript:void(0)" onclick=""></a>
			</div>
			<div class="time-inbox"><?php echo $q['time'];?></div>
			<div class="answer-linkBox">
				<div class="blockBox ghostLink" style="display: none;">
					<a href="/questions/26378064640/block" class="inbox-block" onclick="$.colorbox({title:&quot;Bloquear&quot;,href:&quot;/questions/26378064640/block&quot;}); return false">Bloquear</a>
				</div>
				<a href="/<?php echo $user->nick;?>/questions/<?php echo $q['q_id'];?>/reply" class="link-blue text-12">Responder</a>
				<!--<span class="answer-linkBox-seperator">/</span>
				<a href="/taringxd/questions/60076667379/video_reply" class="link-blue text-12">Grabar una respuesta de vídeo</a>-->
			</div>
		</div>
		<?php endforeach;?>
		<?php endif;?>
		<div class="questionBox-borderNone" id="noQuestionBox_inbox" style="display:<?php if(empty($quest)):?>block<?php else:?>none<?php endif;?>">
			En este momento no tienes ninguna pregunta sin responder.
		</div>
		<?php if(!empty($quest)):?>
		<div id="inbox-delete_all" style="display:block">
			<a class="inbox-delete_all" href="javascript:void(0)" onclick="showBox({message: '¿Estás seguro de que quieres eliminar todas las preguntas?', buttons: {aceptar: true, close:true, event: '__questions.delet_all();$.colorbox.close();return false;'} })">Eliminar todas la preguntas (<span id="inbox-delete_all-counter"><?php echo $user->questions;?></span>)</a>
		</div>
		<?php endif;?>
		<div id="motivator_inbox" style="display:none">
			<div id="yourLink">
				<div id="yourLink-headline">Comparte este enlace con tus amigos para recibir más preguntas</div>
				<input name="Search" type="text" id="yourLink-form" value="http://ask.fm/taringxd" readonly="readonly" />
				<div id="wall-shareOptionLine">
					<a href="javascript:void(0)" class="link-shareOption" onclick="window.open('http://www.facebook.com/sharer.php?u=ask.fm%2Ftaringxd','sharer', 'width=500,height=400,top=200,left=400')">
						<div class="wall-shareOption">
							<img alt="" class="wall-shareOption-icon" src="/images/icons/facebook-mini.jpg">
							<div class="wall-shareOption-label">Facebook</div>
						</div>
					</a>

					<a href="javascript:void(0)" class="link-shareOption" onclick="window.open('http://twitter.com/home?status=Hazme+una+pregunta+ask.fm%2Ftaringxd','twitter', 'location=1,status=1,scrollbars=1,resizable=1,width=800,height=400,top=200,left=200')">
						<div class="wall-shareOption">
							<img alt="" class="wall-shareOption-icon" src="/images/icons/twitter-mini.jpg">
							<div class="wall-shareOption-label">Twitter</div>
						</div>
					</a>

					<a href="javascript:void(0)" class="link-shareOption" onclick="window.open('http://www.tumblr.com/share?v=3&u=ask.fm%2Ftaringxd&t=ask.fm%2Ftaringxd&s=Hazme+una+pregunta','tumblr', 'location=1,status=1,scrollbars=1,resizable=1,width=800,height=400,top=200,left=200')">
						<div class="wall-shareOption">
							<img alt="" class="wall-shareOption-icon" src="/images/icons/tumblr-mini.jpg">
							<div class="wall-shareOption-label">Tumblr</div>
						</div>
					</a>
					<a href="javascript:void(0)" class="link-shareOption" onclick="window.open('http://vk.com/share.php?url=ask.fm%2Ftaringxd&title=Hazme+una+pregunta+%7C+ask.fm%2Ftaringxd&image=http%3A%2F%2Fask.fm%2Fimages%2F75x75.gif','vkontakt', 'location=1,status=1,scrollbars=1,resizable=1,width=800,height=400,top=200,left=200')">
						<div class="wall-shareOption">
							<img alt="" class="wall-shareOption-icon" src="/images/icons/vkontakte-mini.jpg">
							<div class="wall-shareOption-label">Vkontakte</div>
						</div>
					</a>
				</div>
			</div>
			<div id="itsMoreFun">
				<div class="itsMoreFun-text">¡Con amigos es más divertido!</div>
				<a href="/search/name" class="link-fun">Encontrar amigos</a>
			</div>
		</div>
	<?php elseif(!empty($quest)):?>
		<div style="display:none">
			<form method="post" enctype="multipart/form-data" onsubmit="return false;" id="wrapper-upload-container" style="width:370px">
				<div class="formBox-long">
					<input class="uploadFile" id="question_attach_photo-input" name="file" onchange="PhotoAnswer.toggleMessageBlock(true)" onclick="return !PhotoAnswer.uploadBlocked" style="margin-bottom:5px;" type="file" />
					<div id="fileField-subline">
						<span class="text-grey" id="attach_photo_hint">Tamaño máximo 8 Mb. JPG, PNG</span>
						<span style="color:red;display:none" id="attach_photo_error">
						Ha surgido un problema al cargar tu imagen<br/>
						Tamaño máximo 8 Mb. JPG, PNG
					</span>
					</div>
				</div>
				<div id="login-buttonContainer">
					<input class="submit-button submit-button-active" id="attach_photo_submit" onclick="PhotoAnswer.submit(this, 'http://upload1.ask.fm:80/upload/photo-answer', 'question_attach_photo-input', 'question_attach_data-input', 'photo_request_id')" type="button" value="Cargar" />
					<input class="submit-button submit-button-active" onclick="$.fn.colorbox.close()" type="button" value="Cancelar" />
					<img src="<?php echo $settings['source_url'];?>/images/animation/loading.gif" class="loading" alt="" id="photo_answer_loader" style="display:none"/>
				</div>
			</form>
		</div>

		<form action="" id="question_form_<?php echo $quest['q_id'];?>" method="post">
			<div class="questionBox questionBox-last">
				<div class="question" dir="ltr">
					<span class="text-bold"><span dir="ltr"><?php echo $quest['q_quest'];?></span></span><?php if(!empty($quest['q_username']) && !empty($quest['q_user_nick'])):?>‎<span class="author nowrap">&nbsp;&nbsp;<a href="/<?php echo $quest['q_user_nick'];?>" class="link-blue" dir="ltr"><?php echo $quest['q_username'];?></a></span><?php endif;?>
				</div>
				<div class="time-reply"><?php echo $quest['time'];?></div>
				<div id="postLoaderTerritory">
					<input type="hidden" name="id_quest" value="<?php echo $quest['q_id'];?>" />
					<textarea class="growable-textarea" cols="0" id="post-input-pre" name="question[answer_text]" rows="0"></textarea>
					<div id="postLoader"></div>
				</div>
				<div id="post_options-border">
					<div id="post_options">
						<a class="attachment_remove hintable" hint="Eliminar" href="#" id="remove_photo_button" onclick="" style="display:none"></a>
						<a class="camera hintable inverse" hint="Agregar una imagen" href="#" id="select_photo_button" onclick=""></a>
						<input id="photo_request_id" name="photo_request_id" type="hidden" />
						<input class="submitBlue submitBlue-active" id="question_submit" name="commit" onclick="__questions.response();return false;" type="submit" value="Responder" />
						<input id="question_submit_stream" name="question[submit_stream]" type="hidden" value="1" />

						<label for="question_submit_twitter">
						<div class="shareService"><b>Twitter</b></div>
						<input name="question[submit_twitter]" type="hidden" value="0" /><input autocomplete="off" class="shareCheckbox" id="question_submit_twitter" name="question[submit_twitter]" type="checkbox" value="1" />
						</label>

						<label for="question_submit_facebook">
						<div class="shareService"><b>Facebook</b></div>
						<input name="question[submit_facebook]" type="hidden" value="0" /><input autocomplete="off" class="shareCheckbox" id="question_submit_facebook" name="question[submit_facebook]" type="checkbox" value="1" />
						</label>

						<div class="shareService">Compartir:</div>
					</div>
				</div>
			</div>
		</form>
		<script type="text/javascript" src="<?php echo $settings['source_url'];?>/js/resize.js"></script>
		<script type="text/javascript">$(document).ready(function(){$("#postLoaderTerritory textarea").autoResize()});</script>
	<?php else:?><script type="text/javascript">window.location.href="/";</script><?php endif;?>
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
// VACIAMOS VARIABLES	
unset($quest, $data);

//FOOTER SI EL AJAX ESTA DESACTIVADO
if($ajax !== true) include( 'footer.php' );
?>