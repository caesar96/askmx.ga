
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=780"/>
<title>Bienvenido a <?php echo $settings['titulo'];?></title>
<style type="text/css">
html /*.maintenance-body*/ {
    background-color: #19314A;
    background-image: url(http://s3.amazonaws.com/askfm-static/maintenance/maintenance.png);
    background-position: center top;
    background-repeat: repeat-x;
}
body {
    /*background:#264C67 none repeat-x fixed center bottom;*/
    color: #000000;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 14px;
    margin: 52px 0 0;
    padding: 0;
    text-align: left;
}
#maintenance-box {
    color: #FFFFFF;
    display: block;
    height: 240px;
    left: 50%;
    margin: -120px 0 0 -320px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    text-align: center;
    top: 43%;
    width: 640px;
}
.maintenance-logo {
    border: medium none;
    display: block;
    height: 84px;
    margin: 0 auto;
    padding: 0;
    width: 238px;
}
.maintenance-loader {
    background-color: #041723;
    border: none;
    display: block;
    height: 15px;
    margin: 8px auto 20px;
    padding: 10px;
    width: 128px;
}
.maintenance-row {
    border: none;
    display: block;
    margin-top: 8px;
    padding: 0;
}
.maintenance-headline {
    background-color: #041723;
    border: none;
    display: inline;
    font-size: 20px;
    margin: 0 auto 20px;
    padding: 8px;
}
.maintenance-subline {
    background-color: #041723;
    border: none;
    display: inline;
    font-size: 12px;
    margin: 0 auto;
    padding: 8px;
}
.maintenance-subsubline {
    background-color: #041723;
    border: none;
    display: inline;
    font-size: 12px;
    margin: 0 auto;
    padding: 0 8px;
}
.maintenance-timer {
    background-color: #041723;
    border: none;
    color: #4A5861;
    display: block;
    font-size: 12px;
    margin: 0 auto;
    padding: 8px;
    width: 355px;
}
#socicons {
	display:block;
	overflow:hidden;
	width:115px;
	height:50px;
	margin-left:-53px;
	margin-right:0px;
	margin-bottom:0px;
	margin-top:0px;
	padding:0px;
	position:absolute;
	bottom:50px;
	left:50%;
}
#socicons a.socicon_Twitter {
	display:block;
	overflow:hidden;
	width:50px;
	height:50px;
	float:left;
	margin:0px;
	padding:0px;
	border:none;
	text-decoration:none;
	background:url(http://s3.amazonaws.com/askfm-static/maintenance/maintenance_Twitter.png) no-repeat;
	background-position:top center;
}
#socicons a.socicon_Twitter:hover {
	background-position:bottom center;
}
#socicons a.socicon_Facebook {
	display:block;
	overflow:hidden;
	width:50px;
	height:50px;
	float:right;
	margin:0px;
	padding:0px;
	border:none;
	text-decoration:none;
	background:url(http://s3.amazonaws.com/askfm-static/maintenance/maintenance_Facebook.png) no-repeat;
	background-position:top center;
}
#socicons a.socicon_Facebook:hover {
	background-position:bottom center;
}
body {
    -webkit-text-size-adjust: none;
}
</style>
<script type="text/javascript">
//<![CDATA[
function display(){if(milisec<=0){milisec=9;seconds-=1}if(seconds<=-1){milisec=0;seconds+=1}else milisec-=1;document.getElementById("seconds").innerHTML=seconds;if(seconds==0){window.location="/"}else{setTimeout("display()",100)}}var milisec=0;var seconds=60
//]]>
</script>
</head>

<body class="maintenance-body" onload="display()">

    <div id="maintenance-box">
    	<img title="<?php echo $settings['titulo'];?>" src="http://i.imgur.com/09KPdTF.png" class="maintenance-logo" alt="" />
        <img src="http://s3.amazonaws.com/askfm-static/maintenance/loader-dark.gif" class="maintenance-loader" alt="" />

        <div class="maintenance-row"><span class="maintenance-headline">MANTENIMIENTO DEL SISTEMA</span></div>
        <div class="maintenance-row"><span class="maintenance-subline">ESTAMOS HACIENDO MEJORAS AL SISTEMA.</span><br />
        <span class="maintenance-subsubline">POR FAVOR INTENTA EN UNOS MOMENTOS.</span></div>
        <div class="maintenance-timer">ESTA PÁGINA SERÁ ACTUALIZADA EN <span id="seconds"></span>&nbsp;SEGUNDOS</div>

    </div>
    <div id="socicons">
    	<a href="http://twitter.com/ask_fm" class="socicon_Twitter" target="_blank"></a>
        <a href="http://www.facebook.com/askfmpage" class="socicon_Facebook" target="_blank"></a>
    </div>

</body>
</html>
