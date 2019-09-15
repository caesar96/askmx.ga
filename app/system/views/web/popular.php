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
<div id="wrapper" class="wrapper-top">
<div class="container">

<div class="headline-menu">

<a href="/account/wall" class="link-headline">respuestas</a>



<div class="link-headline-seperator"></div>
<a href="/account/popular" class="link-headline-active">populares</a>



</div>




<div class="result-all">
<a href="/account/popular" class="link-inviteLine">Mostrar otros usuarios</a>
</div>

<div id="populars">
<div class="populars-column populars-left">

<div class="popular">
<div class="popular-headSet">
<a href="/Fuckingfeelings" class="border-none"><img alt="" class="popular-pic" src="http://img0.ask.fm/assets/104/132/293/thumb/tuenti_1359571919599.jpg"></a>

<div class="popular-name">
<a href="/Fuckingfeelings" class="link-profile-name"><span dir="ltr">   Posdata, te quiero.</span></a><br>
<span dir="ltr">(Fuckingfeelings)</span>
</div>

<div class="statistics">
<a href="/Fuckingfeelings" class="stasis-box">
<span class="stasis-digit">9719</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/Fuckingfeelings/best" class="stasis-box">
<span class="stasis-digit">49066</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/Fuckingfeelings/gifts" class="stasis-box">
<span class="stasis-digit">4</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/Fuckingfeelings/answer/7327552990" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">como murio tu padre</span></span>

<span dir="ltr"><span dir="ltr">[SIGO AQUÍ] Mi vecina, la cual estaba allí en aquel momento me vio, me tomo y me llevo a su casa. Yo no quería, me cabree, me cabree mucho, quería irme con mi padre, pero mi madre no me dejó, algo lógico. Esa fue la última vez que vi a mi padre. Esa noche murió en el hospital. No me dejaron ir al entierro, ni al tanatorio, ni nada de nada. En 9 años, solo he ido a ver a mi padre unas 7 veces al cementerio. No porque no quiera, sino porque no me gusta llorar delante de mi familia. Por todo esto, ahora odio el tabaco, el alcohol, y las drogas y me dan pánico los hospitales. No he dicho esto por dar lástima ni mierdas de esas. Agradecería que no me lo recordarais más.</span></span>


</a>
<div class="people-follow follow_link_fuckingfeelings"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('fuckingfeelings')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/Fuckingfeelings/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


<div class="popular">
<div class="popular-headSet">
<a href="/LoudFridayCmon" class="border-none"><img alt="" class="popular-pic" src="http://img1.ask.fm/assets/156/473/044/thumb/hamster_justin_bieber.jpg"></a>

<div class="popular-name">
<a href="/LoudFridayCmon" class="link-profile-name"><span dir="ltr">Guarroso Minaj.</span></a><br>
<span dir="ltr">(LoudFridayCmon)</span>
</div>

<div class="statistics">
<a href="/LoudFridayCmon" class="stasis-box">
<span class="stasis-digit">6666</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/LoudFridayCmon/best" class="stasis-box">
<span class="stasis-digit">2803</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/LoudFridayCmon/gifts" class="stasis-box">
<span class="stasis-digit">2</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/LoudFridayCmon/answer/7700610193" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">Si te dieran la oportunidad de conocer a un famoso, ¿a cual eligirias?  
Un beso ♥ Pasate por mi Ask :)</span></span>

<span dir="ltr"><span dir="ltr">J U S T I N B I E B E R</span></span>


</a>
<div class="people-follow follow_link_loudfridaycmon"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('loudfridaycmon')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/LoudFridayCmon/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


<div class="popular">
<div class="popular-headSet">
<a href="/JuliSerrano77" class="border-none"><img alt="" class="popular-pic" src="http://img0.ask.fm/assets/041/605/631/thumb/facc.jpg"></a>

<div class="popular-name">
<a href="/JuliSerrano77" class="link-profile-name"><span dir="ltr">Julian Serrano</span></a><br>
<span dir="ltr">(JuliSerrano77)</span>
</div>

<div class="statistics">
<a href="/JuliSerrano77" class="stasis-box">
<span class="stasis-digit">1548</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/JuliSerrano77/best" class="stasis-box">
<span class="stasis-digit">53693</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/JuliSerrano77/gifts" class="stasis-box">
<span class="stasis-digit">117</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/JuliSerrano77/answer/2930318035" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">LE FIRMAS EL ASK Y LE PONES 10 MG A LOS QE DEN MG ACAAAAA :$ ?</span></span>

<span dir="ltr"><span dir="ltr">- - -- - -- - -- - -- - -- - -- - -- - -- - -- - -- - -- - -- - -- - -- - -- - -- - -- - -- - - PONE MG Y HAGO ESO.</span></span>


</a>
<div class="people-follow follow_link_juliserrano77"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('juliserrano77')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/JuliSerrano77/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


<div class="popular">
<div class="popular-headSet">
<a href="/micaarevalo01" class="border-none"><img alt="" class="popular-pic" src="http://img2.ask.fm/assets/118/271/401/thumb/539784_156927564463451_1847114678_n_1_.jpg"></a>

<div class="popular-name">
<a href="/micaarevalo01" class="link-profile-name"><span dir="ltr">Mica Arévalo</span></a><br>
<span dir="ltr">(micaarevalo01)</span>
</div>

<div class="statistics">
<a href="/micaarevalo01" class="stasis-box">
<span class="stasis-digit">14555</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/micaarevalo01/best" class="stasis-box">
<span class="stasis-digit">27032</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/micaarevalo01/gifts" class="stasis-box">
<span class="stasis-digit">28</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/micaarevalo01/answer/10714135553" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">puta.</span></span>

<span dir="ltr"><span dir="ltr">PUTAAAAAAAAAAAAAAAAA -¿ESTAN LISTOS CHICOS?! ¡Si capitán, estamos listos! -¡NO LOS ESCUCHOOOO! +¡SI CAPITAAAAAAN ESTAMOS LISTOS! -¡¡¡UHHHHHHHHHHHHHHHHHHHH!!! -¡Vive tras una pantalla y no tiene vida social! +¡EL A NÓ NI MO! -¡Su cobardía lo absorbe y sin estallar! +¡EL A NÓ NI MO! -¡El mejor cobarde que podrías desear! +¡EL A NÓ NI MO! -¡Y como a un idiota le es fácil insultar! +¡EL A NÓ NI MO! -¡TOOOOODOS! + ¡EL A NÓ NI MO, EL A NÓ NI MO, EL A NÓ NI MO! - EL EEEEEEEEES EEEEEEEEL ANÓNIMO</span></span>


</a>
<div class="people-follow follow_link_micaarevalo01"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('micaarevalo01')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/micaarevalo01/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


<div class="popular">
<div class="popular-headSet">
<a href="/quierosonreirte" class="border-none"><img alt="" class="popular-pic" src="http://img1.ask.fm/assets/181/692/621/thumb/bipoj7dcqaeb0ig.jpg"></a>

<div class="popular-name">
<a href="/quierosonreirte" class="link-profile-name"><span dir="ltr">Hogar, dulce calle.</span></a><br>
<span dir="ltr">(quierosonreirte)</span>
</div>

<div class="statistics">
<a href="/quierosonreirte" class="stasis-box">
<span class="stasis-digit">25084</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/quierosonreirte/best" class="stasis-box">
<span class="stasis-digit">48258</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/quierosonreirte/gifts" class="stasis-box">
<span class="stasis-digit">1</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/quierosonreirte/answer/34136071178" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">puta gorda</span></span>


<img alt="Picmonkeycollage" class="photoAnswer-XL" src="http://photo2.ask.fm/360/883/546/1650003023-1q4ds74-1b7b7fiqdbnohf0/preview/PicMonkeyCollage.jpg">

</a>
<div class="people-follow follow_link_quierosonreirte"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('quierosonreirte')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/quierosonreirte/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


<div class="popular">
<div class="popular-headSet">
<a href="/marioPC2" class="border-none"><img alt="" class="popular-pic" src="http://img6.ask.fm/assets/072/531/934/thumb/dsc_0053.jpg"></a>

<div class="popular-name">
<a href="/marioPC2" class="link-profile-name"><span dir="ltr">marioperez!</span></a><br>
<span dir="ltr">(marioPC2)</span>
</div>

<div class="statistics">
<a href="/marioPC2" class="stasis-box">
<span class="stasis-digit">7025</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/marioPC2/best" class="stasis-box">
<span class="stasis-digit">10691</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/marioPC2/gifts" class="stasis-box">
<span class="stasis-digit">1</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/marioPC2/answer/7274153222" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">P.C       Que piensas de la nueva opcion de los regalos deberiia ser gratis verdad porQue estamos en crisis?</span></span>

<span dir="ltr"><span dir="ltr">En este país somos muy tontos, estamos todo el dia quejandonos de la crisis, pero cada vez que voy a un centro comercial está lleno y ademas todos con bolsas, además ayer vi en un programa de juicios en la tele un caso muy particular que me dejo impresionado y o voy a contar : Una madre le regala a su hija de CASI 14 años, unos implantes de pecho para cuando cumpla los 16 *_* Que madre está tan enferma en este país para convertir a tu hija de 16 años en un objeto sexual, solo poque no tenga unas buenas tetas? además con 13 año te estas empezando a desarrollar *_* Estás obligando a tu hija a ser una superficial, le estás enseñando que lo unico que importa es el físico, estás haciendo que tu hija no tengo autoestima ninguna, que su soporte de la felicidad sea so...</span></span>


</a>
<div class="people-follow follow_link_mariopc2"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('mariopc2')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/marioPC2/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


<div class="popular">
<div class="popular-headSet">
<a href="/xColibritany" class="border-none"><img alt="" class="popular-pic" src="http://img3.ask.fm/assets/176/393/569/thumb/untitled_1.png"></a>

<div class="popular-name">
<a href="/xColibritany" class="link-profile-name"><span dir="ltr">Colibritany Oficial</span></a><br>
<span dir="ltr">(xColibritany)</span>
</div>

<div class="statistics">
<a href="/xColibritany" class="stasis-box">
<span class="stasis-digit">4406</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/xColibritany/best" class="stasis-box">
<span class="stasis-digit">78309</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/xColibritany/gifts" class="stasis-box">
<span class="stasis-digit">24</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/xColibritany/answer/3812919039" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">Hola setsiiiiiiiiis</span></span>

<span dir="ltr"><span dir="ltr">Si quieren que los siga en ask dale like a esta respuesta y ya !</span></span>


</a>
<div class="people-follow follow_link_xcolibritany"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('xcolibritany')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/xColibritany/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


<div class="popular">
<div class="popular-headSet">
<a href="/lauraa8" class="border-none"><img alt="" class="popular-pic" src="http://img6.ask.fm/assets/147/880/579/thumb/tuenti_1366145930088.jpg"></a>

<div class="popular-name">
<a href="/lauraa8" class="link-profile-name"><span dir="ltr">Lauurita(:</span></a><br>
<span dir="ltr">(lauraa8)</span>
</div>

<div class="statistics">
<a href="/lauraa8" class="stasis-box">
<span class="stasis-digit">8089</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/lauraa8/best" class="stasis-box">
<span class="stasis-digit">3012</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/lauraa8/gifts" class="stasis-box">
<span class="stasis-digit">1</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/lauraa8/answer/7396586586" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">RETO COLECTIVO; SI ESTA PREGUNTA LLEGA A 100 ME GUSTA, HACES UNA VIDEORRESPUESTA EN LA QUE TE ESCRIBES EN LOS ABDOMINALES: AMO A MIS FANS DEL ASK
QUE ME DICES?</span></span>

<span dir="ltr"><span dir="ltr">jajajaj ok ! xD</span></span>


</a>
<div class="people-follow follow_link_lauraa8"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('lauraa8')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/lauraa8/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


<div class="popular">
<div class="popular-headSet">
<a href="/Juuldelchivo" class="border-none"><img alt="" class="popular-pic" src="http://img5.ask.fm/assets/147/972/515/thumb/yo1.jpg"></a>

<div class="popular-name">
<a href="/Juuldelchivo" class="link-profile-name"><span dir="ltr">Julian iurchuk -</span></a><br>
<span dir="ltr">(Juuldelchivo)</span>
</div>

<div class="statistics">
<a href="/Juuldelchivo" class="stasis-box">
<span class="stasis-digit">1986</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/Juuldelchivo/best" class="stasis-box">
<span class="stasis-digit">180651</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/Juuldelchivo/gifts" class="stasis-box">
<span class="stasis-digit">37</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/Juuldelchivo/answer/8752004988" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">Sos un capo!</span></span>

<span dir="ltr"><span dir="ltr">Eu lean los que me van a seguir, deje de seguir una banda porque me di cuenta que ya casi no me sigue nadie, asique ahora voy a seguir a los que le den Mg a esta respuesta, pero siganme tambien!!!!!! PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp; TE SIGO PONE MG &amp;...</span></span>


</a>
<div class="people-follow follow_link_juuldelchivo"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('juuldelchivo')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/Juuldelchivo/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


<div class="popular">
<div class="popular-headSet">
<a href="/Losmendezk9" class="border-none"><img alt="" class="popular-pic" src="http://img2.ask.fm/assets/050/681/429/thumb/292697_450140825031687_1312542127_n.jpg"></a>

<div class="popular-name">
<a href="/Losmendezk9" class="link-profile-name"><span dir="ltr">Leo Mendez  (✔)</span></a><br>
<span dir="ltr">(Losmendezk9)</span>
</div>

<div class="statistics">
<a href="/Losmendezk9" class="stasis-box">
<span class="stasis-digit">153</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/Losmendezk9/best" class="stasis-box">
<span class="stasis-digit">33130</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/Losmendezk9/gifts" class="stasis-box">
<span class="stasis-digit">21</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/Losmendezk9/answer/2754998930" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">A TODAS LAS QUE PONGAN MG LE FIRMARAS EL ASK-.-</span></span>

<span dir="ltr"><span dir="ltr">a la ultima que ponga me gusta le firmo su ask sin el anonimo ;)</span></span>


</a>
<div class="people-follow follow_link_losmendezk9"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('losmendezk9')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/Losmendezk9/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


</div>

<div class="populars-column populars-right">

<div class="popular">
<div class="popular-headSet">
<a href="/lldaniexll" class="border-none"><img alt="" class="popular-pic" src="http://img2.ask.fm/assets/003/206/095/thumb/dsc08333.jpg"></a>

<div class="popular-name">
<a href="/lldaniexll" class="link-profile-name"><span dir="ltr">JoseDaniel♥</span></a><br>
<span dir="ltr">(lldaniexll)</span>
</div>

<div class="statistics">
<a href="/lldaniexll" class="stasis-box">
<span class="stasis-digit">8472</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/lldaniexll/best" class="stasis-box">
<span class="stasis-digit">2232</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/lldaniexll/gifts" class="stasis-box">
<span class="stasis-digit">2</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/lldaniexll/answer/8018614366" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">Y Si qiero q me Hagas tuya Cm Hacemos?</span></span>

<span dir="ltr"><span dir="ltr">ujummm! 0800 jose daniel y tal?</span></span>


</a>
<div class="people-follow follow_link_lldaniexll"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('lldaniexll')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/lldaniexll/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


<div class="popular">
<div class="popular-headSet">
<a href="/MartinErnest" class="border-none"><img alt="" class="popular-pic" src="http://img1.ask.fm/assets/023/307/087/thumb/caiu01.jpg"></a>

<div class="popular-name">
<a href="/MartinErnest" class="link-profile-name"><span dir="ltr">Martin</span></a><br>
<span dir="ltr">(MartinErnest)</span>
</div>

<div class="statistics">
<a href="/MartinErnest" class="stasis-box">
<span class="stasis-digit">795</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/MartinErnest/best" class="stasis-box">
<span class="stasis-digit">31530</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/MartinErnest/gifts" class="stasis-box">
<span class="stasis-digit">2</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/MartinErnest/answer/860952649" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">conoces algun truco de ask?</span></span>

<span dir="ltr"><span dir="ltr">Ajam, ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒▓▓█D░ ▒...</span></span>


</a>
<div class="people-follow follow_link_martinernest"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('martinernest')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/MartinErnest/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


<div class="popular">
<div class="popular-headSet">
<a href="/CarmenMw3" class="border-none"><img alt="" class="popular-pic" src="http://img0.ask.fm/assets/195/448/911/thumb/img_20130629_01533.jpg"></a>

<div class="popular-name">
<a href="/CarmenMw3" class="link-profile-name"><span dir="ltr">CARMELA</span></a><br>
<span dir="ltr">(CarmenMw3)</span>
</div>

<div class="statistics">
<a href="/CarmenMw3" class="stasis-box">
<span class="stasis-digit">21529</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/CarmenMw3/best" class="stasis-box">
<span class="stasis-digit">15707</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/CarmenMw3/gifts" class="stasis-box">
<span class="stasis-digit">1</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/CarmenMw3/answer/7306423401" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">Cuentame tu vida, porfavor :)</span></span>

<span dir="ltr"><span dir="ltr">Pues naci el 21 de octubre de 1997 en el puerto de santa maria, tengo una hermana mayor de un año mas y un apequeña de 4 años menos, siempre he sido una niña muy feliz, he viajado mucho por españa con mis padres, vivia en un piso y despues en un chalet( el actual) nos mudamos por mi hermana chica, me cambie de colegio y me fue muchisimo mejor, hasta hace 1 año empece a recordar a mis antiguos amigos, en 2006 hice mi primer viaje a disney, el avion me encanto, despues fui en 2007 y en 2009 2 veces :) hace 3 años a mi madre le encontraton un quiste en la garganta, se lo quitarony se fui recuperando despues de millones de pruebas, le descubrieron el cancer, un cancer sin cura, ese cancer era unico, tras estudiarlo le pusieron una quimio experimental, mientras que...</span></span>


</a>
<div class="people-follow follow_link_carmenmw3"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('carmenmw3')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/CarmenMw3/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


<div class="popular">
<div class="popular-headSet">
<a href="/FeFFFe" class="border-none"><img alt="" class="popular-pic" src="http://img4.ask.fm/assets/016/431/256/thumb/chico_linf.jpg"></a>

<div class="popular-name">
<a href="/FeFFFe" class="link-profile-name"><span dir="ltr">FeFFe♥</span></a><br>
<span dir="ltr">(FeFFFe)</span>
</div>

<div class="statistics">
<a href="/FeFFFe" class="stasis-box">
<span class="stasis-digit">159</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/FeFFFe/best" class="stasis-box">
<span class="stasis-digit">76003</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/FeFFFe/gifts" class="stasis-box">
<span class="stasis-digit">17</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/FeFFFe/answer/1688906428" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">Lei la historia de tu papa y la verdad que es un angel , dio la vida por vos y debes de estar re orgulloso de el,  y vos sos un capo por aver querido contar tu historia sin ningun proble , PD : ESTAR RICO :$ we.</span></span>

<span dir="ltr"><span dir="ltr">Estoy muy orgulloso de el, La cuento porque me hace bien que sepan lo que mi padre hizo por nosotros :)</span></span>


</a>
<div class="people-follow follow_link_fefffe"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('fefffe')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/FeFFFe/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


<div class="popular">
<div class="popular-headSet">
<a href="/MrCrujidores" class="border-none"><img alt="" class="popular-pic" src="http://img3.ask.fm/assets/032/586/916/thumb/uiuiyiu.jpg"></a>

<div class="popular-name">
<a href="/MrCrujidores" class="link-profile-name"><span dir="ltr">Mr.Crujidores 4.0</span></a><br>
<span dir="ltr">(MrCrujidores)</span>
</div>

<div class="statistics">
<a href="/MrCrujidores" class="stasis-box">
<span class="stasis-digit">7079</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/MrCrujidores/best" class="stasis-box">
<span class="stasis-digit">52769</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/MrCrujidores/gifts" class="stasis-box">
<span class="stasis-digit">5</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/MrCrujidores/answer/7687591891" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">No eres capaz de decir hfdhancjswghsjdhqw xjdfjsjcdiof*-* en un video:$!</span></span>

<span class="popular-video_answer" style="position:relative"><img alt="" class="video-preview" height="98" src="http://s3.amazonaws.com/ask-videos/000/378/234/p_video_answer_378234.jpg" width="130"><span class="video-play-button video-play-button-green"></span></span>

</a>
<div class="people-follow follow_link_mrcrujidores"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('mrcrujidores')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/MrCrujidores/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


<div class="popular">
<div class="popular-headSet">
<a href="/ArcangelPrrra1" class="border-none"><img alt="" class="popular-pic" src="http://img6.ask.fm/assets/067/350/026/thumb/343931379.jpg"></a>

<div class="popular-name">
<a href="/ArcangelPrrra1" class="link-profile-name"><span dir="ltr">AUSTIN A.SANTOS</span></a><br>
<span dir="ltr">(ArcangelPrrra1)</span>
</div>

<div class="statistics">
<a href="/ArcangelPrrra1" class="stasis-box">
<span class="stasis-digit">272</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/ArcangelPrrra1/best" class="stasis-box">
<span class="stasis-digit">165368</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/ArcangelPrrra1/gifts" class="stasis-box">
<span class="stasis-digit">197</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/ArcangelPrrra1/answer/9772211374" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">YA TIENES TUS 2 MIL 'ME GUSTA' HAGA EL VIDEO ACAPELA DE 'ME PREFIERES A MI'</span></span>

<span class="popular-video_answer" style="position:relative"><img alt="" class="video-preview" height="98" src="http://s3.amazonaws.com/ask-videos/036/859/742/p_video_answer_36859742.jpg" width="130"><span class="video-play-button video-play-button-green"></span></span>

</a>
<div class="people-follow follow_link_arcangelprrra1"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('arcangelprrra1')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/ArcangelPrrra1/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


<div class="popular">
<div class="popular-headSet">
<a href="/juanmartin77" class="border-none"><img alt="" class="popular-pic" src="http://img1.ask.fm/assets/093/780/953/thumb/62112_140975959387790_933595054_n1.jpg"></a>

<div class="popular-name">
<a href="/juanmartin77" class="link-profile-name"><span dir="ltr">Juan Martin</span></a><br>
<span dir="ltr">(juanmartin77)</span>
</div>

<div class="statistics">
<a href="/juanmartin77" class="stasis-box">
<span class="stasis-digit">4651</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/juanmartin77/best" class="stasis-box">
<span class="stasis-digit">93581</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/juanmartin77/gifts" class="stasis-box">
<span class="stasis-digit">13</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/juanmartin77/answer/2537459081" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">HOLA TENGO QUE ACLARAR VARIAS COSAS</span></span>

<span dir="ltr"><span dir="ltr">Hola quiero que antes de preguntar leas esto, se que sos buena onda y lo vas a leer, es para que te ahorres preguntas chotas: -tengo 17 años -soy de cordoba -no tengo face, no me gusta porque siempre me lo hackean -no me gusta que me pidan hacer videos en boxer :| -si, soy adoptado y que tiene? -amo a mis padres verdaderos y a los de ahora tambien -mis ojos son saltones y digas lo que digas no voy a cambiar de opinion -me caen bien las chicas inteligentes - teta o culo? cerebro Creo que nada mas, porfa trata de leer esto antes de preguntarme algo :)</span></span>


</a>
<div class="people-follow follow_link_juanmartin77"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('juanmartin77')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/juanmartin77/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


<div class="popular">
<div class="popular-headSet">
<a href="/EitanViera" class="border-none"><img alt="" class="popular-pic" src="http://img1.ask.fm/assets/140/430/706/thumb/165419_523254171050009_396207590_n.jpg"></a>

<div class="popular-name">
<a href="/EitanViera" class="link-profile-name"><span dir="ltr">Eitan Viera</span></a><br>
<span dir="ltr">(EitanViera)</span>
</div>

<div class="statistics">
<a href="/EitanViera" class="stasis-box">
<span class="stasis-digit">2128</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/EitanViera/best" class="stasis-box">
<span class="stasis-digit">122967</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/EitanViera/gifts" class="stasis-box">
<span class="stasis-digit">148</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/EitanViera/answer/2109702958" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">si queres que me pase por tu ask:</span></span>

<span dir="ltr"><span dir="ltr">dale MG a esta respuesta si queres que me pase por tu ask, asi se ahorran las preguntas de pasate y eso :P</span></span>


</a>
<div class="people-follow follow_link_eitanviera"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('eitanviera')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/EitanViera/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


<div class="popular">
<div class="popular-headSet">
<a href="/CokiElArgento" class="border-none"><img alt="" class="popular-pic" src="http://img3.ask.fm/assets/039/122/953/thumb/dario_lopilato_coqui_argento.jpg"></a>

<div class="popular-name">
<a href="/CokiElArgento" class="link-profile-name"><span dir="ltr">Coki Argento</span></a><br>
<span dir="ltr">(CokiElArgento)</span>
</div>

<div class="statistics">
<a href="/CokiElArgento" class="stasis-box">
<span class="stasis-digit">227</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/CokiElArgento/best" class="stasis-box">
<span class="stasis-digit">6276</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/CokiElArgento/gifts" class="stasis-box">
<span class="stasis-digit">1</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/CokiElArgento/answer/3263346731" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">nunca le tuviste ganas a paola?</span></span>

<span dir="ltr"><span dir="ltr">Es mi hermana flaco, que decís.. VIOLIN</span></span>


</a>
<div class="people-follow follow_link_cokielargento"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('cokielargento')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/CokiElArgento/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


<div class="popular">
<div class="popular-headSet">
<a href="/idiaquez" class="border-none"><img alt="" class="popular-pic" src="http://img7.ask.fm/assets/099/931/711/thumb/img_0040.jpg"></a>

<div class="popular-name">
<a href="/idiaquez" class="link-profile-name"><span dir="ltr">Néstor Idiaquez</span></a><br>
<span dir="ltr">(idiaquez)</span>
</div>

<div class="statistics">
<a href="/idiaquez" class="stasis-box">
<span class="stasis-digit">22758</span>
<span class="stasis-label">respuestas</span>
</a>
<div class="statistics-seperator"></div>

<a href="/idiaquez/best" class="stasis-box">
<span class="stasis-digit">33763</span>
<span class="stasis-label">les gusta</span>
</a>
<div class="statistics-seperator"></div>

<a href="/idiaquez/gifts" class="stasis-box">
<span class="stasis-digit">7</span>
<span class="stasis-label">regalos </span>
</a>
</div>
</div>

<div class="popular-bottom">
<a href="/idiaquez/answer/7452714076" class="topAnswer ">
<span class="topQuestion"><span dir="ltr">¿Eres de los que piensas que las chicas nacimos solo para servirles y que somos inferiores a los hombres ? ( Yo no lo pienso así) Bsts pasate por mi ask y pregunta :$</span></span>

<span dir="ltr"><span dir="ltr">¡Já! Para nada... No pienso así. Es más, apoyo antes los derechos de la mujer que los del hombre, puesto que la mujer durante la historia, ha dado más por la vida que el hombre. Y siempre se le ha infravalorado en la sociedad, siendo la mujer por las etapas de su vida las cuales son muy fuertes, pero eso, no se ve. Solo se le ve a la mujer, como una "chacha" (ama de casa). Un hombre, no sabe que es, que te baje la regla, será duro. Un hombre, nunca sabrá el dolor y esfuerzo por la salud en un embarazo. Un hombre, no sabe lo que sufre una mujer, y lo que puede vivir, porque no todo es malo. Pero desgraciadamente, a las mujeres les ocurre esto: Se les rebaja el sueldo. Antes, no había juez (jueza, mal dicho)&nbsp; La mujer en casa, el hombre en el trabajo. ¿Por qué?...</span></span>


</a>
<div class="people-follow follow_link_idiaquez"><a class="link-green" href="javascript:void(0)" onclick="if (Follow.lock('idiaquez')) return false; $.ajax({data:'authenticity_token=' + encodeURIComponent('Bze59i953Il9XZRawyIw28EB/p6kngLohaechRVO9gY='), dataType:'script', type:'post', url:'/idiaquez/follow'}); return false;">+ Seguir</a></div>
</div>
</div>


</div>
</div>

<div class="result-all" style="padding:0">
<a href="/account/popular" class="link-inviteLine">Mostrar otros usuarios</a>
</div>


</div>
</div>
<?php
if($ajax !== true)
// HEADER HTML
include( 'footer.php' );
//
?>