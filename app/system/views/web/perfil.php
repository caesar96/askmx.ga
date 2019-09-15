<?php
/* SI EL USUARIO NO EXISTE MOSTRAMOS ERROR 404 */
if( empty( $data ) ){
	$page = '404';require(HTML. '404.php');exit();
}
/* CONFIGURAMOS LAS RESPUESTAS */
$respuestas = array();
$respuestas['query'] = !empty($_GET['answerid']) ? $user->getAnswers($data['u_id'], $_GET['answerid']) : false;
$respuestas['loop'] = empty($_GET['answerid']) || empty($respuestas['query']) ? $user->getAnswers($data['u_id']) : false;
/* TITULO DE LA PAGINA */
$domain_nick = str_replace(array('http://', 'www.'), '', $settings['url']) . '/' . $data['u_nick'];
$title = empty($respuestas['query']) ? $data['p_name'] . ' | ' . $domain_nick : $respuestas['query']['q_quest'] . ' | ' . $domain_nick;
/* META TAGS PARA EL PERFIL */
$meta_tags = array();
$meta_tags['title'] = 'Hazme una pregunta | ' . $domain_nick;
$meta_tags['description'] = empty($data['p_about_me']) ? 'Fuck!' : $data['p_about_me'];

/* SI LA NAVEGACION POR AJAX NO ESTA ACTIVADA ENTONCES INCLUIMOS EL HEADER HTML */
if( !$ajax ) include( 'header.php' );
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
	<div id="profile-head">
		<img alt="" <?php if($data['p_avatar']['a'] !== 'http://i.imgur.com/HSmdSGH.jpg'):?> style="cursor:pointer;" onclick="$.colorbox({opacity:.4,href: '<?php echo $data['p_avatar']['a'];?>'});"<?php endif;?> id="profile-head-picture" src="<?php echo $data['p_avatar']['t'];?>" />
		<div id="profile-info">
			<div id="profile-name">
				<div id="profile-name-container">
					<a href="/<?php if($data['u_nick']): echo $data['u_nick'];endif;?>" class="link-profile-name" data-rlt-aid="profile_prof_name"><span dir="ltr"><?php if($data['p_name']): echo $data['p_name'];endif;?></span></a>
					<span class="username"><span dir="ltr">@<?php if($data['u_nick']): echo $data['u_nick'];endif;?></span></span>
				</div>
				<div id="profile-bio">
				<?php if($data['p_geo']):?>
					<div><span dir="ltr"> <?php echo $data['p_geo'];?></span></div>
				<?php endif;?>
				<?php if($data['p_about_me']):?>
					<div class="text-grey-dark text-italic" dir="ltr"><span dir="ltr"><?php echo $data['p_about_me'];?></span></div>
				<?php endif;?>
				<?php if($data['p_website']):?>
					<div class="text-italic" dir="ltr"><?php echo parseURL($data['p_website']);?><!--<a class="link-blue" target="_blank" rel="nofollow" href="http://link.ask.fm/goto/50aiCb_tfbeICH48hHfm_YYyplSB_enHmgvmrKKYwjHDJFFSJ8BBO16y-xBtJDhoEgnGId8g_zC-9MZi">http://www.facebook.com/Juli0Cesar.M</a><br/><a class="link-blue" target="_blank" rel="nofollow" href="http://link.ask.fm/goto/50aiCb_tfbeICH4pinfq-o08qReavOeHvVDrt87jlXubYUgpJ68WYBTsuENtS28zWFeFcg,,">http://www.sociedadmx.com.ar</a>--></div>
				<?php endif;?>
				</div>
			</div>
			<div id="statistics">
				<a href="/<?php if($data['u_nick']): echo $data['u_nick'];endif;?>/gifts" class="stasis-box" data-rlt-aid="profile_prof_gifts">
					<span class="stasis-digit" id="profile_gifts_counter">0</span>
					<span class="stasis-label">regalos </span>
				</a>
				<div class="statistics-seperator"></div>
				<a href="/<?php if($data['u_nick']): echo $data['u_nick'];endif;?>/best" class="stasis-box" data-rlt-aid="profile_prof_likes">
					<span class="stasis-digit" id="profile_liked_counter">0</span>
					<span class="stasis-label">les gusta</span>
				</a>
				<div class="statistics-seperator"></div>
				<a href="/<?php if($data['u_nick']): echo $data['u_nick'];endif;?>" class="stasis-box" data-rlt-aid="profile_prof_answers">
					<span class="stasis-digit" id="profile_answer_counter"><?php echo $data['t_answer'];?></span>
					<span class="stasis-label">respuestas</span>
				</a>
			</div>
			<div id="profile-button">
				<?php if($user->nick != $data['u_nick']):?>
				<div class="people-follow follow_link_vanioconnor"><a class="link-green" href="javascript:void(0)" onclick="RLTLogger.execute(&quot;ProfilePageReferrer&quot;, &quot;handleActivity&quot;, &quot;fl_profile_fl&quot;);if (Follow.lock('vanioconnor')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('QOJnqBD21mQ6UwhyCUo41OfWdMggDPwOKQXU09BikQs='), dataType:'script', type:'post', url:'/VaniOconnor/follow'}); return false;">+ Seguir</a></div>
				<?php endif;?>
			</div>
			<a href="/JCMMXLP/gifts/select" class="giftButton" data-rlt-aid="btn_make_gift" onclick="$.colorbox({title:&quot;Hacer un regalo&quot;,href:&quot;/JCMMXLP/gifts/select&quot;}); return false">Hacer un regalo</a>
		</div>
	</div>
	<?php if(!empty($_GET['answerid']) && !empty($respuestas['query'])):?>
	<div class="container-profile-promo" id="common_question_container">
		<div class="questionBox">
			<div class="question" dir="ltr">
				<span class="text-bold"><span dir="ltr"><?php echo $respuestas['query']['q_quest'];?></span></span>
				<?php if(!empty($respuestas['query']['q_user']) && !empty($respuestas['query']['q_user_nick'])):?>
				<span data-id="<?php if($respuestas['query']['q_uid']) echo $respuestas['query']['q_uid'];?>" class="author nowrap">&nbsp;&nbsp;<a href="/<?php echo $respuestas['query']['q_user_nick'];?>" class="link-blue" dir="ltr"><?php echo $respuestas['query']['q_user']?></a></span>
				<?php endif;?>
			</div>
				<?php if($user->nick == $data['u_nick']):?>
				<div class="deleteBox ghostLink" style="display: none;">
					<a onclick="showBox({message: '¿Estás seguro de que quires eliminar tu respuesta?<br /> Esta pregunta volverá a tu sección \&quot;Preguntas\&quot;.', buttons: {aceptar: true, close:true, event: '__questions.delet(<?php echo $respuestas['query']['a_id'];?>, true, true);$.colorbox.close();return false;'} });" class="delete hintable" hint="Eliminar respuesta" href="javascript:void(0)" ></a>
				</div>
				<?php endif;?>
				<?php if($user->nick != $data['u_nick']):?>
				<div class="reportBox">
					<a class="reportPointer" href="javascript:void(0)"></a>
					<a href="/sdsdsd/questions/55604308708/report" class="reportItem" onclick=""><span>Denunciar</span></a>
				</div>
				<?php endif;?>
			<div class="answer" dir="ltr"><?php echo $respuestas['query']['a_content'];?></div>
			<div class="time"><a href="/<?php echo $data['u_nick'];?>/answer/<?php echo $respuestas['query']['a_id'];?>" class="link-time"><?php echo $respuestas['query']['a_date'];?></a></div>
			<div class="likeCombo" id="like_box_<?php echo $respuestas['query']['a_id'];?>">
				<div class="likeBox">
					<span class="like-active" style="display:none;"></span>
					<div class="ghostLink">
						<?php if($user->is_member == true && $user->nick != $data['u_nick']):?>
						<a class="like hintable" title="Me gusta" href="#" onclick="likes(<?php echo $respuestas['query']['a_id'];?>, <?php echo $data['u_id'];?>, this);return false;"></a>						
						<?php endif;?>
					</div>
				</div>
				
			</div>
		</div>
		<div class="questionBox-borderNone" id="noQuestionBox_profile" style="display:none">La respuesta ha sido eliminada</div>
	</div>
	<?php else:?>
    <div class="container-profile">
		<div id="profile_form_container">
			<?php if($user->is_member == false && $data['anon_quest'] == 0):?>
			<div id="reMotivation_box" class="reMotivation_box-simple">
				<h1>Para hacer una pregunta a este usuario tienes que iniciar sesión.</h1>
				<div id="choiceContainer">
					<a href="/signup" class="choiceRegister">Crear una cuenta</a>
					<a style="cursor:pointer;" class="choiceAsk" onclick="showBox({type:1});return false;">Entrar</a>
				</div>
			</div>
			<?php else:?>
			<form autocomplete="off" id="question_form" method="post" style="display:block">
				<div id="profile-title">
					<div class="profile-title-text">
						<span class="text-headline" dir="ltr"><span dir="ltr"><?php if($data['p_title_page']): echo $data['p_title_page'];else:?>Hazme una pregunta :D<?php endif;?></span></span>
					</div>
				</div>
				<div id="postLoaderTerritory">
					<textarea class="composeQuestion-form growable-textarea" id="profile-input" name="question[question_text]" style="overflow: hidden; line-height: 18px; height: 36px;"></textarea>
					<div id="postLoader" style="display:block"></div>
				</div>
				<div id="post_options-border">
					<div id="post_options">
						<div id="generalLevel">
							<div class="profile-title-counter" id="question_counter_span" style="">300</div>
							<input type="hidden" name="touser" value="<?php echo $data['u_id'];?>" />
							<input onclick="__questions.send();" class="submitBlue submitBlue-active" id="question_submit" name="commit" type="button" value="Preguntar" />
							<?php if($user->is_member == true):?>
							<div class="questionType_box">
								<label class="typeCheckbox_text<?php if($data['anon_quest'] == 0):?> strikeout text-grey<?php endif;?>" for="quest_anon">Pregunta anónimamente</label>
								<input <?php if($data['anon_quest'] == 0):?> disabled="disabled"<?php endif;?> class="typeCheckbox" id="quest_anon" name="quest_anon" type="checkbox" value="force_anonymous">
							</div>
							<?php endif;?>
						</div>
					</div>
				</div>
			</form>
			<?php if($user->is_member):?>
			<div id="reMotivation_box" class="reMotivation_box-simple" style="display:none">
			  <h1>Tu pregunta ha sido enviada.</h1>
			  <div id="choiceContainer">
				<a href="javascript:void(0)" class="choiceAsk-logged" onclick="$('#reMotivation_box').hide();$('#question_form').show();$('#postLoaderTerritory textarea').val('').focus(); return false">Hacer otra pregunta</a>
			  </div>
			</div>
			<?php else:?>
			<div id="reMotivation_box" class="reMotivation_box-complex" style="display:none">
				<h1>Tu pregunta ha sido enviada.</h1>
				<div id="choiceContainer">
					<a href="/signup" class="choiceRegister">Crear una cuenta</a>
					<a href="javascript:void(0)" class="choiceAsk" onclick="$('#reMotivation_box').hide();$('#question_form').show();$('#postLoaderTerritory textarea').val('').focus(); return false">Hacer otra pregunta</a>
				</div>
				<h2>
				¡Únete a <?php echo $settings['titulo'];?> ahora! Recibirás notificaciones cada vez que tu pregunta haya sido respondida.<br>
				Podrás seguir a gente interesante y responder a sus preguntas
				</h2>
			</div>
			<?php endif;?>
			<?php endif;?>
		</div>
		<div class="infoBox" id="profile_headline_menu">
			<a href="http://ask.fm/feed/profile/JCMMXLP.rss" class="RSS_button">
				<span>RSS</span>
			</a>
			<?php if($user->nick != $data['u_nick']):?>
			<a href="/VaniOconnor/report" class="reportProfile_button" onclick="$.fn.colorbox({title:&quot;Denunciar&quot;,href:&quot;/VaniOconnor/report&quot;}); return false"><span>Denunciar</span></a>			
			<?php endif;?>
			<span class="text-headline">respuestas</span>
		</div>
		<div id="profile_subhead"></div>
		<?php if(!empty($respuestas['loop'])):?>
		<div id="common_question_container">
			<?php foreach($respuestas['loop'] as $r):?>
			<div class="questionBox" id="question_box_<?php echo $r['q_id'];?>">
				<div class="question" dir="ltr">
					<span class="text-bold"><span dir="ltr"><?php echo $r['q_quest'];?></span></span>&lrm;
					<?php if(!empty($r['q_user']) && !empty($r['q_user_nick'])):?>
					<span data-id="<?php if($r['q_uid']) echo $r['q_uid'];?>" class="author nowrap">&nbsp;&nbsp;<a href="/<?php echo $r['q_user_nick'];?>" class="link-blue" dir="ltr"><?php echo $r['q_user'];?></a></span>
					<?php endif;?>
				</div>
				<?php if($user->nick == $data['u_nick']):?>
				<div class="deleteBox ghostLink" style="display: none;">
					<a onclick="showBox({message: '¿Estás seguro de que quires eliminar tu respuesta?<br /> Esta pregunta volverá a tu sección \&quot;Preguntas\&quot;.', buttons: {aceptar: true, close:true, event: '__questions.delet(<?php echo $r['a_id'];?>, true);$.colorbox.close();return false;'} });" class="delete hintable" hint="Eliminar respuesta" href="javascript:void(0)" ></a>
				</div>
				<?php endif;?>
				<?php if($user->nick != $data['u_nick']):?>
				<div class="reportBox">
					<a class="reportPointer" href="javascript:void(0)"></a>
					<a href="/sdsdsd/questions/55604308708/report" class="reportItem" onclick=""><span>Denunciar</span></a>
				</div>
				<?php endif;?>
				<div class="answer" dir="ltr"><?php echo $r['a_content'];?></div>
				<div class="time"><a href="/<?php echo $data['u_nick'];?>/answer/<?php echo $r['a_id'];?>" class="link-time" data-rlt-aid="answer_time"><?php echo $r['a_date'];?></a></div>
				<div class="likeCombo" id="like_box_<?php echo $r['a_id'];?>">
					<div class="likeBox">
						<span class="like-active" style="display:none;"></span>
						<div class="ghostLink">
							<?php if($user->is_member == true && $user->nick != $data['u_nick']):?>
							<a class="like hintable" title="Me gusta" href="#" onclick="likes(<?php echo $r['a_id'];?>, <?php echo $data['u_id'];?>, this);return false;"></a>						
							<?php endif;?>
						</div>
					</div>
					<div style="display:block" class="likeList people-like-block">A <a href="/sdsdsds" class="link-blue" dir="ltr">asasasas(:</a> le gusta esto</div>
				</div>
			</div>
			<?php endforeach;?>
		</div>
		<div class="questionBox-borderNone" id="noQuestionBox_profile" style="display:none">Todavía no has respondido a ninguna pregunta</div>
		<?php else:?>
		<div class="questionBox-borderNone" id="noQuestionBox_profile" style="display:block"><?php if($user->nick == $data['u_nick']):?>Todavía no has respondido a ninguna pregunta<?php else:?>El usuario aún no ha respondido ninguna pregunta<?php endif;?></div>
		<?php endif;?>
		<?php if($user->is_member == true && $user->nick != $data['u_nick']):?>
		<div id="inbox-delete_all">
			<a href="/<?php echo $data['u_nick'];?>/block" class="profile-block" onclick="$.fn.colorbox({title:&quot;Bloquear&quot;,href:&quot;/VaniOconnor/block&quot;}); return false">Bloquear a <span dir="ltr">@<?php echo $data['u_nick'];?></span></a>
		</div>
		<?php endif;?>
		<noindex>
		<form style="display:none;" action="/JCMMXLP/more" id="more-container" method="get" onsubmit="$.ajax({complete:function(request){More.complete()}, data:$.param($(this).serializeArray()) + '&amp;authenticity_token=' + encodeURIComponent('h2zLdlYbAmBOQr6cofk5hE4Vehx72PSy4XIVy/EWZv8='), dataType:'script', type:'post', url:'/JCMMXLP/more'}); Forms.More.afterSubmit(); return false;">
			<input autocomplete="off" id="time" name="time" type="hidden" value="Wed Jul 17 20:34:29 UTC 2013" />
			<input autocomplete="off" id="questions_page" name="page" type="hidden" value="1" />
			<input class="submit-button-more submit-button-more-active" name="commit" onclick="return Forms.More.allowSubmit(this)" type="submit" value="Ver más" />
			<img src="<?php echo $settings['source_url'];?>/images/animation/loading.gif" alt="" id="more_loader" style="display:none"/>
		</form>
		</noindex>
	</div>
	<?php endif;?>
</div>
<script type="text/javascript" src="<?php echo $settings['source_url'];?>/js/resize.js"></script>
<script type="text/javascript">$(document).ready(function(){$("body").attr("class", "body-content");$("#postLoaderTerritory").on("keyup","textarea",l_text);$("#postLoaderTerritory textarea").autoResize()});function l_text(){l=300;if(l-$(this).val().length<0)$(this).val($(this).val().substr(0,l));if($(this).val().length>=300)$(".profile-title-counter").css("color","red");else $(".profile-title-counter").css("color","green");$(".profile-title-counter").html(l-$(this).val().length)}</script>
<script type="text/javascript">
$(document).ready(function(){
	$(".questionBox").mouseenter(function() {
		$(this).find(".ghostLink").show()
	}).mouseleave(function() {
		$(this).find(".ghostLink").hide()
	});
	reportBox.start();
	$(".author").tooltip({ content: hoverCardProfile});
});

function hoverCardProfile(o){
	//Cache
	//ID del usuario
	var uid = $(o).attr("data-id");
		uid = parseInt(uid);
	//Plantilla inicial
	template = '<img src="https://i.imgur.com/6j65bNI.gif" style="width:54px;height:55px;margin-left: 88px;"></div>';
	//Si no existe una caché guardada con el ID del usuario creamos una
	if(!cache[uid]){
		$.post('/ajax/acciones', "type=mentions&id="+uid, function(d){
			if(typeof d.id != 'undefined') template = templates.homeCard(d, {pointer:false});else template = "<h4>El usuario no existe</h4>";
			cache[uid] = template;
			$("#face_"+uid+"_user").html(template);
			tooltipOffSet.update();
		}, 'json');
	} else {
		template = cache[uid];
	}
	return '<div id="face_'+uid+'_user" class="flyout_people-wrapper">' + template + '<div class="flyout_people-pointer" style="left: 120px;"></div>';
}
</script>
<?php
// VACIAMOS VARIABLES	
unset($respuestas, $title, $data);

//MOSTRAMOS FOOTER SI EL AJAX ESTA DESACTIVADO
if($ajax !== true) include( 'footer.php' );
//
?>