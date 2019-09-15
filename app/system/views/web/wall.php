<?php
if($ajax !== true)
// HEADER HTML
include( 'header.php' );
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
<!--<div id="wrapper" class="wrapper-top">
	<div class="container">
		<div class="headline-menu">
			<a href="/account/wall" class="link-headline-active">respuestas</a>
			<div class="link-headline-seperator"></div>
			<a href="/account/popular" class="link-headline">populares</a>
			<a href="#" class="link-silver-medium-ask_friends link-silver-medium-ask_friends-active" onclick="$.fn.colorbox({onCleanup:MassAsk.cleanup,href:&quot;/account/questions/quick_mass_new&quot;}); return false">
			<img alt="" class="buttonIcon-friends" src="<?php echo $settings['source_url'];?>/images/icons/friends.png">Haz una pregunta a tus amigos</a>
		</div>
		<div id="wall_notice_container">
			<a href="javascript:void(0)" class="link-news" id="wall_notice_content" onclick="Wall.clickNotice(poller)">
			<span class="wall-notice" id="wall_notice_one"><span class="wall-notice-counter"></span>&nbsp;respuesta nueva</span>
			<span class="wall-notice" id="wall_notice_two"><span class="wall-notice-counter"></span>&nbsp;respuestas nuevas</span>
			<span class="wall-notice" id="wall_notice_five"><span class="wall-notice-counter"></span>&nbsp;respuestas nuevas</span>
			<span class="wall-notice" id="wall_notice_more"><span class="wall-notice-counter"></span>&nbsp;respuestas nuevas</span>
			</a>
			<div id="wall_notice_cache" class="hidden-object"></div>
		</div>
		<div id="common_question_container">
			<div class="questionBox" id="wall_answer_55604308708">
				<a href="/dssd" class="stream-flyout-trigger stream-profile-container" data-rlt-aid="str_profile_avatar">
					<img alt="" class="stream-profile" id="face_55604308708" height="60" login="dsd" src="http://i.imgbox.com/abxcalsj.jpg" width="60">
				</a>
				<div class="flyout-ask_follow" id="flyout_wall_answer_55604308708" style="">
					<div class="flyout_people-ask_follow-details">
					<div class="people-name">
					<a href="/dsd" class="link-name"><span dir="ltr">Usuario falso</span></a>
					<span class="username"><span dir="ltr">(Usuariofalse)</span></span>
					</div>
					<div class="flyout-people-buttons">
					<a href="/dsd" class="link-modern-left" onclick="RLTME.rec('fl_ask_click');$.fn.colorbox({title:&quot;\u202aKotex~veintiocho~d\u00edas~con~tigo\u202c&quot;,href:&quot;/Ckott3/questions/quick_new&quot;}); return false">Preguntar</a>
					<div class="people-follow follow_link_ckott3"><a class="link-unfollow" href="javascript:void(0)" onclick="RLTME.rec('fl_fl_click_unfl');if (Follow.lock('ckott3')) return false; $.ajax({data:'_method=delete' + '&amp;authenticity_token=' + encodeURIComponent('8jz1w4f2iiK9niLc20eA8fID4LfDvhugB0/JbNO9eqQ='), dataType:'script', type:'post', url:'/Ckott3/unfollow'}); return false;">- Dejar de seguir</a></div>
					</div>
					</div>
				</div>
				<div class="stream-answer">
					<div class="question" dir="ltr">
						<span class="text-bold"><span dir="ltr">Pregunta false</span></span>
					</div>
					<div class="reportBox">
						<a class="reportPointer" href="javascript:void(0)"></a>
						<a href="/dsds/questions/55604308708/report" class="reportItem" onclick=""><span>Denunciar</span></a>
					</div>
					<div class="answer" dir="ltr">Respuesta Falsa</div>
					<div class="likeCombo" id="like_box_55604308708">
						<div class="likeBox">
							<span class="like-active" style="display:none;"></span>
							<div class=" ghostLink" style="display: none;">
								<a class="like hintable" hint="Me gusta" href="javascript:void(0)" onclick="if (!Profile.likesBlocked()) { Profile.quickLike('#like_box_55604308708'); $.ajax({data:'authenticity_token=' + encodeURIComponent('8jz1w4f2iiK9niLc20eA8fID4LfDvhugB0/JbNO9eqQ='), dataType:'script', type:'post', url:'/likes/Ckott3/question/55604308708/add'}); }; return false;"></a>
							</div>
						</div>
						<div class="likeList you-like-block" style="display:none">A ti y a <a onclick="$.fn.colorbox({title:&quot;Personas a las que les gusta esto&quot;,onComplete:Likes.onPeopleOpening,onCleanup:Likes.onPeopleClosing,href:&quot;/likes/Ckott3/question/55604308708/people&quot;}); return false" class="link-blue" href="/likes/Ckott3/question/55604308708/people">1 persona más</a> os gusta esto</div>
						<div class="likeList people-like-block">A <a onclick="$.fn.colorbox({title:&quot;Personas a las que les gusta esto&quot;,onComplete:Likes.onPeopleOpening,onCleanup:Likes.onPeopleClosing,href:&quot;/likes/Ckott3/question/55604308708/people&quot;}); return false" class="link-blue" href="/likes/Ckott3/question/55604308708/people">1 persona</a> le gusta esto</div>
					</div>
					<div class="time">
						<a href="/dsdsd/answer/55604308708" class="link-time" data-rlt-aid="answer_time">Hace aproximadamente 16 horas</a>‎<span class="author">&nbsp;&nbsp;<a href="/Ckott3" class="link-blue" dir="ltr">Usuario falso</a></span>
					</div>
				</div>
			</div>
			<div class="questionBox" id="wall_answer_55604308708">
				<a href="/dsd" class="stream-flyout-trigger stream-profile-container" data-rlt-aid="str_profile_avatar">
					<img alt="" class="stream-profile" id="face_55604308708" height="60" login="dsd" src="http://i.imgbox.com/abxcalsj.jpg" width="60">
				</a>
				<div class="flyout-ask_follow" id="flyout_wall_answer_55604308708" style="display:block">
					<div class="flyout_people-ask_follow-details">
					<div class="people-name">
					<a href="/dsd" class="link-name"><span dir="ltr">Usuario falso</span></a>
					<span class="username"><span dir="ltr">(Usuariofals)</span></span>
					</div>
					<div class="flyout-people-buttons">
					<a href="/dsdsd" class="link-modern-left" onclick="RLTME.rec('fl_ask_click');$.fn.colorbox({title:&quot;\u202aKotex~veintiocho~d\u00edas~con~tigo\u202c&quot;,href:&quot;/Ckott3/questions/quick_new&quot;}); return false">Preguntar</a>
					<div class="people-follow follow_link_ckott3"><a class="link-unfollow" href="javascript:void(0)" onclick="RLTME.rec('fl_fl_click_unfl');if (Follow.lock('ckott3')) return false; $.ajax({data:'_method=delete' + '&amp;authenticity_token=' + encodeURIComponent('8jz1w4f2iiK9niLc20eA8fID4LfDvhugB0/JbNO9eqQ='), dataType:'script', type:'post', url:'/Ckott3/unfollow'}); return false;">- Dejar de seguir</a></div>
					</div>
					</div>
				</div>
				<div class="stream-answer">
					<div class="question" dir="ltr">
						<span class="text-bold"><span dir="ltr">Pregunta falsa</span></span>
					</div>
					<div class="reportBox">
						<a class="reportPointer" href="javascript:void(0)"></a>
						<a href="/dssdsd/questions/55604308708/report" class="reportItem" onclick=""><span>Denunciar</span></a>
					</div>
					<div class="answer" dir="ltr">Respuesra falsa</div>
					<div class="likeCombo" id="like_box_55604308708">
						<div class="likeBox">
							<span class="like-active" style="display:none;"></span>
							<div class=" ghostLink" style="display: none;">
								<a class="like hintable" hint="Me gusta" href="javascript:void(0)" onclick="if (!Profile.likesBlocked()) { Profile.quickLike('#like_box_55604308708'); $.ajax({data:'authenticity_token=' + encodeURIComponent('8jz1w4f2iiK9niLc20eA8fID4LfDvhugB0/JbNO9eqQ='), dataType:'script', type:'post', url:'/likes/Ckott3/question/55604308708/add'}); }; return false;"></a>
							</div>
						</div>
						<div class="likeList you-like-block" style="display:none">A ti y a <a onclick="$.fn.colorbox({title:&quot;Personas a las que les gusta esto&quot;,onComplete:Likes.onPeopleOpening,onCleanup:Likes.onPeopleClosing,href:&quot;/likes/Ckott3/question/55604308708/people&quot;}); return false" class="link-blue" href="/likes/Ckott3/question/55604308708/people">1 persona más</a> os gusta esto</div>
						<div class="likeList people-like-block">A <a onclick="$.fn.colorbox({title:&quot;Personas a las que les gusta esto&quot;,onComplete:Likes.onPeopleOpening,onCleanup:Likes.onPeopleClosing,href:&quot;/likes/Ckott3/question/55604308708/people&quot;}); return false" class="link-blue" href="/likes/Ckott3/question/55604308708/people">1 persona</a> le gusta esto</div>
					</div>
					<div class="time">
						<a href="/sdsd/answer/55604308708" class="link-time" data-rlt-aid="answer_time">Hace aproximadamente 16 horas</a>‎<span class="author">&nbsp;&nbsp;<a href="/Ckott3" class="link-blue" dir="ltr">Usuario falso</a></span>
					</div>
				</div>
			</div>
		</div>
		<noindex>
			<form action="/account/more_wall" id="more-container" method="get" onsubmit="$.ajax({complete:function(request){More.complete()}, data:$.param($(this).serializeArray()) + '&amp;authenticity_token=' + encodeURIComponent('8jz1w4f2iiK9niLc20eA8fID4LfDvhugB0/JbNO9eqQ='), dataType:'script', type:'post', url:'/account/more_wall'}); Forms.More.afterSubmit(); return false;">
				<input autocomplete="off" id="last_time" name="last_time" type="hidden" value="1374896793">
				<input autocomplete="off" id="page" name="page" type="hidden" value="2">
				<input class="submit-button-more submit-button-more-active" name="commit" onclick="return Forms.More.allowSubmit(this)" type="submit" value="Ver más">
				<img src="<?php echo $settings['source_url'];?>/images/animation/loading.gif" alt="" id="more_loader" style="display:none">
			</form>
		</noindex>
	</div>
</div>-->
<div id="wrapper" class="wrapper-top" style="display:block">
	<div class="container">
		<div class="headline-menu">
			<a href="/account/wall" class="link-headline-active">respuestas</a>
			<div class="link-headline-seperator"></div>
			<a href="/account/popular" class="link-headline">populares</a>
		</div>
		<div id="yourLink">
			<div id="yourLink-headline">Comparte este enlace con tus amigos para recibir más preguntas</div>
			<input name="Search" type="text" id="yourLink-form" value="<?php echo $settings['url'].'/'.$user->nick;?>" readonly="readonly" />
			<div id="wall-shareOptionLine">
			
				<a href="javascript:void(0)" class="link-shareOption" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo urlencode($settings['url'] . '/' . $user->nick);?>','sharer', 'width=500,height=400,top=200,left=400')">
					<div class="wall-shareOption">
						<img alt="" class="wall-shareOption-icon" src="<?php echo $settings['source_url'];?>/images/icons/facebook-mini.jpg">
						<div class="wall-shareOption-label">Facebook</div>
					</div>
				</a>
	
				<a href="javascript:void(0)" class="link-shareOption" onclick="window.open('http://twitter.com/home?status=Hazme+una+pregunta+<?php echo urlencode(str_replace('http://', '', $settings['url']) . '/' . $user->nick);?>','twitter', 'location=1,status=1,scrollbars=1,resizable=1,width=800,height=400,top=200,left=200')">
					<div class="wall-shareOption">
						<img alt="" class="wall-shareOption-icon" src="<?php echo $settings['source_url'];?>/images/icons/twitter-mini.jpg">
						<div class="wall-shareOption-label">Twitter</div>
					</div>
				</a>

				<a href="javascript:void(0)" class="link-shareOption" onclick="window.open('http://www.tumblr.com/share?v=3&u=<?php echo urlencode($settings['url'] . '/' . $user->nick);?>&t=<?php echo urlencode($settings['url'] . '/' . $user->nick);?>&s=Hazme+una+pregunta','tumblr', 'location=1,status=1,scrollbars=1,resizable=1,width=800,height=400,top=200,left=200')">
					<div class="wall-shareOption">
						<img alt="" class="wall-shareOption-icon" src="<?php echo $settings['source_url'];?>/images/icons/tumblr-mini.jpg">
						<div class="wall-shareOption-label">Tumblr</div>
					</div>
				</a>

				<a href="javascript:void(0)" class="link-shareOption" onclick="alert('Próximamente');">
					<div class="wall-shareOption">
						<img alt="" class="wall-shareOption-icon" src="<?php echo $settings['source_url'];?>/images/icons/myspace-mini.jpg">
						<div class="wall-shareOption-label">MySpace</div>
					</div>
				</a>

			</div>
		</div>
		<div id="itsMoreFun">
			<div class="itsMoreFun-text">¡Con amigos es más divertido!</div>
			<a href="/search/name" class="link-fun">Encontrar amigos</a>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	reportBox.start();
});
</script>
<?php
// VACIAMOS VARIABLES	
unset($data);

//MOSTRAMOS FOOTER SI EL AJAX ESTA DESACTIVADO
if($ajax !== true) include( 'footer.php' );
//
?>