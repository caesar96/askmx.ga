//
$(document).ready(function(){
	//AUTO EJECUTAMOS LA FUNCION
	$(function() {
		//COMPROBAMOS QUE EXISTA EL OBJETO "history" y "history.pushstate"
		if( (typeof window.history != 'undefined' && typeof history.pushState != 'undefined') && AskmH.allow ){
			/*
			 * Manejamos el evento "click", al hacer click en algun enlace que contengan la etiqueta "a".
			*/
			$("#allContent, #menuCenter").on('click', 'a', function(e) {
				$(".flyout_people-holder").each(function(){
					$(this).remove();
				});
				if($(this).attr("allow") == "false") return false;
				if($(this).attr("class") == "link-menu"){
					$("a[class=link-menu-active]").attr("class", "link-menu");
					$(this).attr("class", "link-menu-active");
				}
				if(AskmH.load == false)
					AskmH.load = true;
				//Almacenamos el path url en una variable
				var href = typeof ($(this).attr("href")) != 'undefined' ? $(this).attr("href") : '';
				href = href.replace("#", '');
				if (href && ( href.indexOf(document.domain) >= -1 || href.indexOf(':') === -1) )
				{
					//Cargamos contenido
					AskmH.getHTML(href);
					//Cambiamos el estado del Historico con "history.pushState"
					history.pushState('', 'New URL: '+href, href);
					hide_all(document);
				}
				e.preventDefault();
				return false;
			});
			/*
			 * eventState(event);
			 * Manejamos el estado del historico cuando se active los botones de back amd forward
			*/
			window.onpopstate = function(event) {
				//Obtener plantilla
				AskmH.getHTML(location.pathname);
				//PERMITIMOS LA CARGA
				if(AskmH.load == false) AskmH.load = true;
				hide_all(document);
			};
		}
	});
	$(document).click(function(a){
		hide_all(a);
	});
	$("#logBox_form").submit(function(){
		login.submit();return false;
	});
});
function hide_all(a){
	login.popup_hide(a);
	__questions.popup_hide(a);
}
//GLOBALS
var tooltipOffSet = {};
var cache = {};
var template;
var templates = {
	homeCard: function(data){
		if(typeof data == 'undefined') return "Empty data";
		//HTML CONTENT
		var html;
		//EXCEPTIONS
		data.avatar = (data.avatar) ? data.avatar : 'https://i.imgur.com/HSmdSGH.jpg';
		data.geo = (data.geo) ? data.geo : '';
		//CONCATENATE HTML
		html = '<a href="/{nick}" class="stream-profile-container"><img alt="" class="stream-profile" src="{avatar}"></a>';
		html +=	'<div class="flyout_people-details">';
		html +=	'<div class="flyout-people-name">';
		html +=	'<a href="/{nick}" class="link-name" dir="ltr">{name} </a>';
		html +=	'<span class="username">@{nick}</span><br>'
		html +=	'</div>';
		html +=	'<div class="flyout-bio">';
		html +=	'Respuestas: {answers}<br>';
		html += '{geo}';
		html +=	'</div>';
		html +=	'<div class="flyout-people-buttons">';
		html +=	'<a class="link-modern-left" onclick="showBox({type: 3, id: \'{id}\',title: \'{name}\'})">Preguntar</a>';
		html +=	'</div>';
		html += '</div>';
		//COMPILATE HTML STRING
		return thtml(html, data);
	},
	wallCard: function(){

	}

};
/**** FUNCIONES */
//
function hoverCard(o){
	//Cache
	//ID del usuario
	var uid = $(o).attr("id");
	uid = uid.split("_");
	uid = uid[1];
	//Plantilla inicial
	template = '<img src="https://i.imgur.com/6j65bNI.gif" style="width:54px;height:55px;margin-left: 88px;"></div>';
	//Si no existe una caché guardada con el ID del usuario creamos una
	if(!cache[uid]){
		$.post('/ajax/acciones', "type=mentions&id="+uid, function(d){
			if(typeof d.id != 'undefined') template = templates.homeCard(d);else template = "<h4>El usuario no existe</h4>";
			cache[uid] = template;
			$("#face_"+uid+"_user").html(template);
			tooltipOffSet.update();
		}, 'json');
	} else {
		template = cache[uid];
	}
	return '<div id="face_'+uid+'_user" class="flyout_people-wrapper">' + template + '<div class="flyout_people-pointer" style="left: 120px;"></div>';
}
//
/*
 * @ showMsg(message)
 * @ Show messages from the system to user
 * @ params message
 * @ return html
*/
function showBox(e) {
    var t;
    var n;
    var r = new Array;
    var i;
    var s;
    if (typeof e != "undefined") {
        if (typeof e.message != "undefined") {
            if (typeof e.error != "undefined")
                n = "color:red;font-weight:bold;";
            else
                n = "color:green;font-weight:bold;";
            t = '<div style="margin: 20px;10px;40px;10px;padding-bottom:10px;"><span style="' + n + '">' + e.message + "</span></div>"
        } else if (typeof e.type != "undefined") {
            var o;
            var u = e.type;
            switch (u) {
                case 1:
                    title = "Entrar";
                    o = "login";
                    break;
                case 2:
                    title = "Contáctanos";
                    o = "contact";
                    break;
				case 3:
					if(typeof e.title !== "undefined")
					title = e.title;
					else title = "Hazme una pregunta";
					o = "answer_ajax";
					break;
				case 4:
					title = "Cargar imagen";
                    o = "upload_avatar";
					break;
                default:
                    break
            }
			if(typeof e.id != 'undefined'){
				o += "&id="+e.id;
			}
			var load;
			if(typeof e.load != 'undefined' && e.load == true){
				 load = true;
			} else load = false;
            $.colorbox({speed: 100, fadeOut: 100, transition: 'none', href: "/templates?template=" + o,title: title,opacity: .3,fixed: true, preloading: load})
			return false;
        }
        if (typeof e.message != "undefined" && typeof e.buttons != "undefined") {
            if (typeof e.buttons.event !== "undefined") {
                var i = 'onclick="' + e.buttons.event + '" '
            } else {
                i = 'onclick="$.colorbox.close();"'
            }
            r["content"] = "";
            r["aceptar"] = '<input class="submit-button submit-button-active" id="acpetar" ' + i + ' type="button" value="Aceptar">';
            r["close"] = '<input class="submit-button submit-button-active" onclick="$.colorbox.close()" type="button" value="Cancelar">';
            if (typeof e.buttons.aceptar != "undefined" && e.buttons.aceptar == true) {
                r["content"] = r["aceptar"];
                if (typeof e.buttons.close != "undefined" && e.buttons.close == true)
                    r["content"] = r["content"] + r["close"]
            } else if (typeof e.buttons.close != "undefined" && e.buttons.close == true) {
                r["content"] = r["close"]
            }
            r["html"] = '<div style="border-top:1px solid #ccc;padding:10px;">' + r["content"] + "</div>";
            t = t + r["html"]
        }
    }
    if (t) {
		s = '<div id="popup-content">' + t + "</div>";
        $.colorbox({fixed: true,transition: 'none', html: s, title: "Aviso",opacity: .3,overlayClose: false,closeButton: false})
    }
    return false
}
function upload_avatar(e){
	//CERRAR CUADRO DE DIALOGO
	var id = $(e).attr("id");
	//MOSTRAR LOADING
	$("#profile_avatar_loader").show();
	$("#profile_updated").hide();
	$("#profile_image_errors").hide();
	//PETICION AJAX
	$.colorbox.close();
	$.ajaxFileUpload({
		url:"/ajax/acciones",
		fileElementId: id,
		dataType: "json",
		data: { type: "upload_avatar" },
		success:function(data){
			//MOSTRAR LOADING
			$("#profile_avatar_loader").hide();
			if ( typeof data != 'undefined' ) {
				if(typeof data.error != 'undefined' && data.error != ''){
					$("#profile_image_errors").show().html(data.error);
					return false;
				}
				if(typeof data.a_thumb != 'undefined' && data.a_thumb && typeof data.avatar != 'undefined' && data.avatar) {
					$("#profile_updated").show();
					$("#remove_picture").show();
					$("#profile-picture").attr("src", data.a_thumb + "?" + mt_rand()).css("cursor", "pointer");;
					$("#profile-picture").attr("onclick", "$.colorbox({opacity:.4, href: '"+ data.avatar +"?" + mt_rand() +"'})");
					return false;
				}
			}
		},
		error:function(a,b,c){
			alert(c)
		}
	});
	return false;
}
function remove_avatar(){
	//OCULTAR MENSAJE
	$("#profile_updated").hide()
	//avatar por default
	var defualt_avatar = 'https://i.imgur.com/HSmdSGH.jpg';
	$.post('/ajax/acciones', {type: 'delet_avatar'}, function(r){
		if(typeof r != 'undefined' && r){
			$("#profile_updated").show().text("Avatar eliminado, sube otra si quieres :D");
			$("#remove_picture").hide();
			$("#profile-picture").attr("src", defualt_avatar).css("cursor", "default");
			$("#profile-picture").attr("onclick", "return false");
		}
	});
	return false;
}
/*
 * Funcion con la cual se podrá subir una imagen al servidor
 * y utilizarla como background junto con su imagen en miniatura
*/
function upload_background(e){
	//OBJETO / ELEMENTO
	var element = $(e);
	//ID UPLOAD
	var id = element.attr("name");
	//ESCONDER FORMULARIO
	element.hide();
	//MOSTRAR
	$("#skin-uploadContainer-full").show();
	//OCULTAR MENSAJE DE ERROR
	$(".info").hide();
	//PETICION AJAX
	$.ajaxFileUpload({
		url:"/ajax/acciones",
		fileElementId: id,
		dataType: "json",
		data: { type: "upload-background" },
		success:function(data){
			$("#file_input_box").show();
			if(typeof data != 'undefined'){
				if(typeof data.error != 'undefined' && data.error != ''){
					$(".info").show();
					$(".info-error").html(data.error);
					$("#skin-uploadContainer-full").hide();
					return false;
				}
				if(typeof data.background != 'undefined' && typeof data.thumb != 'undefined' && data.background != '' && data.thumb != '' ){
					//DESMARCAMOS
					$(".skinBox-active, .skinBox").attr("class", "skinBox");
					//MOSTRAR ELMENTO
					$("html").css("background-image", "url("+ data.background + "?" + mt_rand() +")");
					$("html").css("background-color", "#264C67");
					$("html").css("background-repeat", "no-repeat");
					$("html").css("background-attachment", "fixed");
					$("html").css("background-position", "left top");
					$("#skin_preview").css("background-image", "url("+ data.thumb + "?" + mt_rand() +")");
					//
					$("#skin_preview input[id=background_repeat]").val("no-repeat");
					$("#skin_preview input[id=background_wallpaper]").val(data.background + "?" + mt_rand());
					//
					$("#custom_controls").show();
					change_background($("#skin_preview"), true);
					$("input:checkbox").prop("checked", "");
					//SELECCIONAMOS
					$("#skin_preview").attr("class", "skinBox-upload-active");
					return false;
				}
			}
		},
		error:function(a,b,c){
			alert(c)
		}
	});
	return false;
}
// ELIMINAR EL BACKGROUND SUBIDO
function delet_background(){
	if($("#skin_preview").attr("class") == 'skinBox-upload-active')
		$("#design_87").attr("class", "skinBox-active");
	$.post('/ajax/acciones', {type: 'delet_background'}, function(r){
		if(typeof r != 'undefined' && r){
			//OCULTAMOS
			$("#skin-uploadContainer-full").hide();
			$("#custom_controls").hide();
			if($("#skin_preview").attr("class") == 'skinBox-upload-active')
				change_background($("#design_87"));
		}
	});
	return false;
}
//CAMBIAR IMAGEN DE FONDO
function change_background(e, type){
	//DECLARE
	var url;
	var style = {};
	var data;
	//BACKGROUND URL
	url = $("#" + $(e).attr("id") + " input[id=background_wallpaper]").val();
	//ARRAY DE PROPIEDADES CSS
	style['background-image'] = (url) ? "url("+url+")" : 'none';
	style['background-color'] = $("#" + $(e).attr("id") + " input[id=background_color]").val();
	style['background-attachment'] = $("#" + $(e).attr("id") + " input[id=background_placement]").val();
	style['background-position'] = $("#" + $(e).attr("id") + " input[id=background_position]").val();
	style['background-repeat'] = $("#" + $(e).attr("id") + " input[id=background_repeat]").val();
	style['id'] = $(e).attr("id");
	style['thumb'] = $("#" + $(e).attr("id") + " input[id=background_thumb]").val();
	style['upload'] = $("#skin_preview input[id=design_upload]").val();
	//HACK
	style['background-color'] = style['background-color'].replace("#", "");
	//DATOS A ENVIAR
	data = "background-image=" + style['background-image'] + "&";
	data += "background-color=" + style['background-color'] + "&";
	data += "background-attachment=" + style['background-attachment'] + "&";
	data += "background-position=" + style['background-position'] + "&";
	data += "background-repeat=" + style['background-repeat'] + "&";
	data += "upload=" + style['upload'] + "&";
	if(typeof type != 'undefined' && type == true){
		data += "b_id=uploaded&";
	} else {
		data += "b_id=" + style['id'];
	}
	//URL ENCODE
	data = encodeURI(data);
	//SHOW LOADING
	$("#" + $(e).attr("id") + " img[class=skinBox-smallLoader]").css("display", "inline");
	//PETICION AJAX POST
	$.post('/ajax/acciones', "type=background&" + data, function(r){
		//HIDE LOADING
		$("#" + $(e).attr("id") + " img[class=skinBox-smallLoader]").fadeOut(200);
		//MANEJAMOS RESULTADOS
		if(r.success){
			//ADERIMOS " # " AL BACKGROUND COLOR
			style['background-color'] = "#"+style['background-color'];
			//APLICAMOS ESTILO A LA PAGINA
			$.each(style, function(k, v){
				$("html").css(k, style[k]);
			});
		} else if(r.error){
			//MOSTRAMOS MENSAJE DE ERROR MEDIANTE COLORBOX
			showBox( { message:r.msg, error:true, buttons: {aceptar: true} } );
		}
	}, 'json');
}
function thtml(d,e){return d.replace(/\{([\w\.]*)\}/g,function(a,b){var c=b.split("."),v=e[c.shift()];for(var i=0,l=c.length;i<l;i++)v=v[c[i]];return(typeof v!=="undefined"&&v!==null)?v:""})}
/*** CLASES */
function likes(id_answer, id_user, element){
	$("#like_box_" + id_answer).append('<div class="likeList you-like-block" style="">Te gusta esto</div>');
	$(element).remove();
	$("#like_box_" + id_answer + ".ghostLink").show();
	$("#like_box_" + id_answer + " .likeBox .like-active").show();
}
/*
 *
*/
var login = {
	popup_hide: function(obj, force){
		var click_login = $(".link-login");
		var popup_obj = $("#popup-login-container");
		if(typeof force != 'undefined'){
			popup_obj.hide();return false;
		}
		var popup_visible = popup_obj.is(":visible") ? true : false;
		if(popup_visible && (obj.target !== click_login && 0 === $(obj.target).closest("#popup-login-container").length)){
			popup_obj.hide();
		}
	},
	show: function(){
		var display = $("#popup-login-container").css("display");
		if(display == 'block'){
			$("#popup-login-container").hide();
		} else {
			$("#popup-login-container").fadeIn(600);
		}
	},
	submit: function(){
		var continuar = false;
		var form = $('form input[name=username], input[name=password]');
		$.each(form,function(e,t){if($(t).val().length<1){$(t).focus();continuar=false;return false;}else{continuar=true}})
		if(continuar == false) return false;
		var data = form.serialize();
		data = encodeURI(data);
		$("#logBox_form-alert").hide();
		$("#logBox_submit").hide();
		$("#logBox_submit-spinner").show();
		$("form input[type=submit]").hide().attr("disabled", "disabled");
		$.get("/ajax/registro", 'type=login&'+data, this.callback, 'json');
	},
	callback: function(r){
		$("#logBox_submit").show();
		$("#logBox_submit-spinner").hide();
		$("form input[type=submit]").show().removeAttr("disabled");
		if(r.error == 1){
			$("#logBox_form-alert").show().text(r.data);
		} else if(r.error == 2){
			$("input[name="+r.data+"]").focus();
		} else if(r.error == 0){
			window.location.href="/";
		}
	},
	salir: function(t){
		if(typeof t == 'undefined'){
			showBox( { message:"<span style='color:black;'>¿Estás seguro que quieres salir?</span>", error:true, buttons: {aceptar: true, close: true, event: 'login.salir(1);return true;'} } );
			return false;
		}
		$.get('/ajax/registro', {type: 'salir',salir: true, path_url: location.pathname}, function(r){
			if(r){
				window.location.href = r;
			} else {
				window.location.reload();
			}
		});
	}
}
/*
 * Objeto AskM History
*/
var AskmH = {
	url: '',
	allow: true,
	cache: null,
	load: false,
	success: false,
	body: null,
	getHTML: function(url){
		if(this.load == false) return false;
		var self = this;
		var success = false;
		url = (typeof( url ) == 'undefined') ? location.pathname : url;
		//Realizar acciones determinadas al "body"
		self.body = ((url == '/' || url == 'home') && !u.is_member)? "welcome" : "content";
		$.post(url, {ajax:1}, function(r){
			self.callBack(r);
		}).fail(function(r){
			if(r.status == 404){
				alert("Pagina no encontrada");
			}
		});
	},
	callBack: function(r){
		var body=this.body;var uril=location.pathname;uril=uril.split("/");uril=uril.reverse();uril=uril[0];switch(uril){case"signup":case"popular":case"wall":case"privacy":case"tos":case"safety":case"logos":body="content";break;case"profile":case"design":case"services":default:body=!u.is_member?"welcome":"content";break}
		//COMPROBAMOS QUE EXISTAN DATOS
		if(!empty(r)){
			$("body").attr("class", "body-" + body);
			$("#mContent").html(r);
			this.menu();
		}
	},
	title: function(){
		var page = location.pathname;page = page.split("/");page=page.reverse();page=page[0];
	},
	menu: function(){
		if(location.pathname !== '/signup' && location.pathname != '/'){
			$("#already_registered_label").hide();
			$("#create_account_link").show();
		} else {
			$("#create_account_link").hide();
			$("#already_registered_label").show();
		}
	}
}
//ENVIAR PREGUNTAS
var __questions = {
	cache: {},
	read_q: function(e){
		var o = $(e);
		var id = o.attr('id');
		var notifications = $("#"+id+ " #notification-q-digit").text();notifications = parseInt(notifications);
		if(notifications == 0){
			window.location.href = o.attr('href');
			return false;
		}
		if(typeof o.attr('n') != 'undefined'){
			var q = o.attr('n');q = parseInt(q);
			$.post("/ajax/acciones", {type: 'read-quest', type_q: q}, function(r){
				if(typeof r != 'undefined' && r == 1){
					//ACTUALIZAMOS TITULO
					update_title();
					window.location.href = o.attr('href');
					return true;
				} else {
					return false;
				}
			});
		}
		return false;
	},
	popup_hide: function(obj, force){
		var click_element = this.cache.link_notify;
		var popup_obj = $("#flyout-replies-wrapper");
		if(typeof force != 'undefined'){
			$(click_element).attr("class", "notification-answer");
			popup_obj.hide();return false;
		}
		var popup_visible = popup_obj.is(":visible") ? true : false;
		if(popup_visible && (obj.target !== click_element && 0 === $(obj.target).closest("#flyout-replies-wrapper").length)){
			$(click_element).attr("class", "notification-answer");
			popup_obj.hide();
		}
	},
	read: function(e){
		var o = $(e);
		this.cache['link_notify'] = e;
		var template = '';
		var id = o.attr('id');
		var q = o.attr('n');q = parseInt(q);
		//OBJETO DEL CONTADOR
		var number = $("#"+id+ " #notification-answer-digit");
		if($("#flyout-replies-wrapper").css("display") == "none"){
			//SELECCIONADO
			o.attr("class", "notification-answer-selected");
			//MOSTRAR CONTENEDOR
			$("#flyout-replies-wrapper").show();
			//
			if(!cache['modal']){
				//PONEMOS EN CERO EL CONTADOR Y OCULTAMOS
				number.text(0).hide();
				//ENVIAMOS SOLICITUD AJAX
				$.post("/ajax/acciones", {type: "notify_answer"}, function(r){
					if(typeof r != 'undefined' && !$.isEmptyObject(r) ){
						$.each(r, function(k, v){
							template += '<a href="/'+v['nick']+'/answer/'+v['id']+'" class="link-flyout-section"><div class="flyout-picture"><img alt="" style="width:48px;height:48px;" class="border-none" src="'+v['avatar']+'"></div><div class="flyout-message"><span class="text-blue"><span dir="ltr">'+v['name']+'</span></span> respondió a tu pregunta<br><span class="text-time">'+v['date']+'</span></div></a>';
						});
						//LEEMOS
						$.post("/ajax/acciones", {type: 'read-quest', type_q: q});
						//ALMACENAMOS EN CACHE
						cache['modal'] = template;
						//ESTABLECEMOS LOS NUEVOS VALORES
						$("#flyout-answer-loader").hide();
						$("#flyout-answer-content").html(cache['modal']).show();
						//ACTUALIZAMOS TITULO
						update_title();
					}
					else {
						$("#flyout-answer-loader").hide();
						$("#flyout-answer-content").html("<div><span style=\"margin-left: 90px;\">No hay datos</span></div>").show();
					}

				}, 'json');
			} else {
				$("#flyout-answer-loader").hide();
				$("#flyout-answer-content").html(cache['modal']).show();
			}
		} else {
			o.attr("class", "notification-answer");
			//OCULTAR CONTENEDOR
			$("#flyout-replies-wrapper").hide();
		}
	},
	valid: function(){
		var question = $("#profile-input, #popup-ask-textarea").val();
		if(question.length == 0 || (/^\s+$/).test(question) ){
			$("#profile-input, #popup-ask-textarea").focus();
			return false;
		}
		else if(question.length > 300){
			showBox( { message: "La pregunta no debe ser mayor a 300 caracteres", error:true, buttons: {aceptar: true} } );
			return false;
		}
		return true;
	},
	send: function(){
		var question = $("#profile-input, #popup-ask-textarea").val();
		var anonymous;
		var userid;
		//SI TODO HA SALIDO BIEN, ENVIAMOS PREGUNTA
		if(this.valid()){
			//PREGUNTA ANONIMA
			anonymous = ($("#quest_anon").is(":checked")) ? 1 : 0;
			//ID DEL USUARIO A ENVIAR
			touser = $("input[name=touser]").val();
			//ENVIAR POR AJAX
			$.post("/ajax/acciones", {type: 'submit-quest', question: question, anon: anonymous, id: touser}, function(r){
					//
					if(typeof r.error != 'undefiend' && r.error){

						showBox( { message:r.error, error:true, buttons: {aceptar: true} } );
						return false;
					}
					if(typeof r.success != 'undefined' && r.success){
						$("#reMotivation_box").show();
						$("#question_form").hide();
						return false;
					}
			}, 'json');
		}
		return false;
	},
	response: function(){
		//RESPUESTA
		var answer = $("#postLoaderTerritory textarea").val();
		if( answer.length == 0  || (/^\s+$/).test(answer) ){
			$("#postLoaderTerritory textarea").focus();
			return false;
		}
		else if(answer.length >= 300){
			showBox( { message: "La respuesta no debe ser mayor a 300 caracteres<br />Utilizaste: "+answer.length+ " caracteres.", error:true, buttons: {aceptar: true} } );
			return false;
		}
		//ID DE LA PREGUNTA A RESPONDER
		var id_quest = $("input[name=id_quest]").val();
		//ENVIAR POR AJAX
		$.post("/ajax/acciones/", {type: 'submit-answer', content: answer, quest_id: id_quest}, function(r){
			//
			if(typeof r.error != 'undefiend' && r.error){

				showBox( { message:r.error, error:true, buttons: {aceptar: true} } );
				return false;
			}
			if(typeof r.success != 'undefined' && r.success){
				window.location.href = '/account/questions';
				return false;
			}
		}, 'json');

	},
	callBack: function(){


	},
	delet: function(id, answer, solo){
		//TIPO DE SOLICITUD
		var type;
		//ID DEL OBJETO A ELIMINAR
		var questid = id;
		//TOTAL DE PREGUNTAS
		var total_quests = $("#inbox_menu_counter").text();total_quests = parseInt(total_quests);
		//TOTAL DE RESPUESTAS
		var total_answers = $("#profile_answer_counter").text();total_answers = parseInt(total_answers);
		//SI NO EXISTE EL ID RETORNAMOS FALSO
		if(typeof id == 'undefined') return false;
		//SI NO ESTA DEFINIDO "ANSWER"
		if(typeof answer == 'undefined'){
			type = 'delet-quest';
		} else
		{
			type = 'delet-answer';
		}
		//ENVIAR POR AJAX
		$.post("/ajax/acciones", {type: type, quest_id: questid}, function(r){
			//
			if(typeof r.error != 'undefiend' && r.error){

				showBox( { message:r.error, error:true, buttons: {aceptar: true} } );
				return false;
			}
			if(typeof r.success != 'undefined' && r.success){
				//SI NO ESTA DEFINIDO "ANSWER"
				if(typeof answer == 'undefined'){
					total_quests = (total_quests - 1);
					//ELIMINAMOS LA CAPA
					$("#inbox_question_"+r.success).remove();
					//DECREMENTAMOS EL CONTADOR DE PREGUNTAS
					$("#inbox_menu_counter").text(total_quests);
					if(total_quests == 0){
						$("#noQuestionBox_inbox").show();
						$("#inbox-delete_all").remove();
					}
				} else
				{
					if(typeof solo != 'undefined'){
						location.href="/account/questions";
						return false;
					}
					total_answers = (total_answers - 1);
					//ELIMINAMOS LA CAPA
					$("#question_box_"+r.success).remove();
					//DECREMENTAMOS CONTADOR
					$("#profile_answer_counter").text(total_answers);
					//AUMENTAMOS EL NUMERO DE PREGUNTAS
					$("#inbox_menu_counter").text(total_quests + 1);
					//
					if(total_answers == 0){
						$("#noQuestionBox_profile").show();
					}
				}

				return false;
			}
		}, 'json');
	},
	delet_all: function(){
		var questions = {};
		$(".questionBox").each(function(){
			//ID DE LAS PREGUNTAS
			var id = $(this).attr("id");
			id = id.replace('inbox_question_', '');
			id = parseInt(id);
			//ALMACENAMOS TODO EN UN ARRAY
			questions[id] = id;
		});
		$.post("/ajax/acciones", {type: 'delet-all', id: questions}, function(r){
			//
			if(typeof r.error != 'undefiend' && r.error){
				showBox( { message:r.error, error:true, buttons: {aceptar: true} } );
				return false;
			}
			if(typeof r.success != 'undefined' && r.success){
				$(".questionBox").each(function(){
					$(this).remove();
				});
				$("#inbox_menu_counter").text(0);
				$("#noQuestionBox_inbox").show();
				$("#inbox-delete_all").remove();
				return false;
			}
		}, 'JSON');
	},
	delet_al: function(id_al){
		if(typeof id_al == 'undefined') return false;
		id_al = parseInt(id_al);
		$.post("/ajax/acciones", {type: 'delet_al', id_al: id_al}, function(r){
			if(typeof r.success != 'undefined'){
				$("#q_a_"+id_al).remove();
				return false;
			}
			alert("Ha ocurrido un error");return false;
		}, 'json');
	}
}
function update_title(){
	//PATRON DE BUSQUEDA
	var pattern = (/(([0-9]+))/i);
	//title
	var title = document.title;
	//CONTADOR
	var counter = 0;
	//NOTIFICACIONES
	var notifications_quest = parseInt($("#notification-q-digit").text());
	var notifications_answer = parseInt($("#notification-answer-digit").text());
	var notifications_like = parseInt($("#notification-like-digit").text());
	//SUMAMOS
	if(notifications_quest != 0){
		counter = notifications_quest;
	}
	if(notifications_answer != 0){
		counter += notifications_answer;
	}
	if(notifications_like != 0){
		counter += notifications_like;
	}
	//SET
	if(counter != 0){
		if( pattern.test(title) ){
			document.title = title.replace(pattern, counter);
		} else {
			document.title = "("+counter+") " + title;
		}
	} else {
		if( pattern.test(title) ){
			title = title.replace(pattern, '');
			document.title = title.replace('()', '');
		} else {
			document.title = title;
		}
	}
	return false;
}
//CONFIGURACIONES DEL USUARIO
var __settings = {
	url: '/ajax/acciones',
	profile: function(optional){
		var data = $("#settings_form input, textarea, select").serialize();
		$("body, input[type=submit]").css("cursor", "wait");
		if(typeof optional != 'undefined') this.sender('save-profile', data, optional);
		else this.sender('save-profile', data);
	},
	privacy: function(){
		var data = $("#settings_form input[type=radio]").serialize();
		if($("#settings_form input[name=mail_questions]").is(":checked")){
			data += "&mail_questions=1";
		}
		if($("#settings_form input[name=mail_gifts]").is(":checked")){
			data += "&mail_gifts=1";
		}
		if($("#settings_form input[name=mail_birthdays]").is(":checked")){
			data += "&mail_birthdays=1";
		}
		if($("#settings_form input[name=mail_digests]").is(":checked")){
			data += "&mail_digests=1";
		}
		if($("#settings_form input[name=d_show_answers]").is(":checked")){
			data += "&d_show_answers=1";
		}
		$.post(this.url, 'type=save-privacy&' + data, function(r){
			if(typeof r != 'undefined'){
				if(typeof r.success != 'undefined' && r.success){
					window.location.reload();
					return false;
				}
				if(typeof r.error != 'undefined' && r.error){
					showBox( { message:r.error, error:true, buttons: {aceptar: true} } );
				}

			}
		}, 'json');
	},
	design: function(){

	},
	services: function(){

	},
	sender: function(type, data, optional){
		if(typeof optional != 'undefined'){
			optional = 1;
		} else {
			optional = 0;
		}
		$.post(this.url, 'optional='+optional+'&type=save-profile&'+data, function(r){
			$("body").css("cursor", "default");
			$("input[type=submit]").css("cursor", "pointer");
			if(r.success == true){
				$("#profile_updated").show();
				$("html, body").animate({scrollTop: 0}, 1000);
			} else {
				if(r.fail){
					alert(r.fail);
				}
				if(r.fail_message){
					showBox( { message:r.fail_message, error:true, buttons: {aceptar: true} } );
				}
				if (r.field) $("input[name="+r.field+"] ,textarea[name="+r.field+"]").focus().select();
			}
		}, 'json');
	}
}
/*
 * REGISTER
*/
var Register = {
	url: location.hostname + '/ajax/',
	continuar: false,
	time: null,
	setTime: function(element,type){
		self = this;
		if(typeof type == 'undefined'){
			return false;
		}
		//Loading
		if(type == 'nick')
			this.lGraphic(element,1);
		if(!this.continuar){
			this.continuar = true;
			this.time = setTimeout(function(){
				self.validData(element,type);
			},1500);
		}
	},
	lGraphic: function(e,startend,success,message){
		var prefix = "username";
		var result;
		var user = $(e).val();
		if(user.length == 0){result = prefix;}
		else{result = prefix + 'Loading';}
		if(typeof startend !== 'undefined'){
			if(startend == '1'){
				$("#usernameFailMessage").hide();
				$("#usernameCheck").attr("class", result);
				$("#subdomain_field_pri").text('https://'+location.hostname+'/'+user);
			} else if(startend == '2'){
				if(typeof success !== 'undefined'){
					result = (success == true) ? prefix + 'Pass' : prefix + 'Fail';
					$("#usernameCheck").attr("class", result);
					if(typeof message != 'undefined'){
						$("#usernameFailMessage").show(function(){
							$("#usernameFailMessage span").text(message);
						});
					}
				}
				this.continuar = false;
			}
		}

	},
	validData: function(e,type){
		//Almacenamos el valor del input
		var data = $(e).val();
		//
		this.continuar = (data) ? true : false;
		//Objeto
		var self = this;
		//Si el valor del input no esta definido no hacemos nada
		if(!data) return false;
		// Hacemos la peticion por AJAX
		$.get(
			'/ajax/registro',
			{
				type: type,
				data: data
			},
			//SI HAY EXITO, EJECUTAMOS SENTENCIAS
			function(r){
				//
				self.continuar = false;
				//DATOS NO VALIDOS
				if(r.error){
					if(type == 'nick'){
						self.lGraphic(e,2,false, r.message);
					} else {
						if(type == 'email'){
							$("#messagee").text(' ( '+r.message+' )');
						}
						$(e).removeClass("fieldWell");
						$(e).addClass("fieldWithErrors");
					}
					return false;
				}
				// DATOS VALIDOS
				else {
					if(type == 'nick'){
						self.lGraphic(e,2,true);
					} else {
						if(type == 'email'){
							$("#messagee").text('');
						}
						$(e).removeClass("fieldWithErrors");
						$(e).addClass("fieldWell");
					}
					return true;
				}
			},
			//STRING JSON
			'json'
		);
		//
	},
	captcha: function(data){
		//Load recaptcha
		$.getScript("https://www.google.com/recaptcha/api/js/recaptcha_ajax.js", function(){
			//showBox();
			Recaptcha.create('6LfIZuQSAAAAAOsVURb-R8kynsuuFeDJZv4RQ2Zu', 'captcha', {
				theme:'custom', callback: Recaptcha.focus_response_field
			});
			alert(Recaptcha.focus_response_field);
		});
	},
	fields: function(f){
		if(typeof f == 'undefined' || typeof f != 'string') return 'Undefined';
		var success = false;
		var field = {};
		field['username'] = 'Nombre de usuario';
		field['name'] = 'Nombre y apellidos';
		field['pass1'] = 'Repetir contraseña'
		field['pass'] = 'Contraseña';
		field['email'] = 'Correo electrónico';
		field['day'] = 'Día';
		field['month'] =  'Mes';
		field['year'] = 'Año';
		field['lang'] = 'Idioma';
		$.each(field, function(k, v){f = f.replace(k, v);success = true;});
		if(typeof f == 'string' && success)
			return f;
		else
			return 'undefined';
	},
	submit: function(){
		var form = $("form input, select");
		//QUERY GET
		var data = form.serialize();data = encodeURI(data);
		//OBJETO
		self = this;
		//PETICION AJAX
		$.get(
			'/ajax/registro',
			'type=submit&'+data,
			function(r)
			{
				if(r.error){
					showBox( { message:r.error, error:true, buttons: {aceptar: true} } );
					$("input[name="+r.field+"]").removeClass("fieldWell");
					$("input[name="+r.field+"]").addClass("fieldWithErrors");
					$("input[name="+r.field+"]").focus();
					return false;
				}
				if(r.captcha){
					self.captcha(r.captcha)
					return false;
				}
				//showBox({message: "Has sido registrado exitosamente", buttons: {aceptar: true,close:true, event: "location.href='/signup/optional'"} });
				location.href='/signup/optional?f=true';
			},
			'json'
		)
	}
};


/* jquery tooltip beta */
(function( e )
{
    e.fn.tooltip = function( t )
    {
        t = e.extend({
            className: "flyout_people-holder",
            content: "title",
            mousein: function(){},
            mouseout: function(){},
            align: "center",
            offset: [0,0],
            inDelay: 100,
            outDelay: 100
        }, t||{} );
        var n = function(n){
            var r = e.data(n, "tooltip");
            if( r && !e.data( r[0], "hover" ) )
            {
                t.mouseout(n);
                //r.fadeOut(300);
                r.remove();
            }
        };
        this.on("mouseenter", function(){
            var r = this;
            setTimeout(function(){
                var i;
                if ( typeof t.content == "string" && e(r).attr( t.content ) != "undefined" && e(r).attr( t.content) != "" )
                    i = e( r ).attr( t.content )
                else if ( typeof t.content == "function" )
                    i = t.content(r)
                var s = e( '<div class="' + t.className + '">' +i+ "</div>" ).appendTo( document.body );
                e.data(r, "tooltip", s);
                s.hover(
                    function(){
                        e.data( this, "hover", true )
                    },
                    function(){
                        e.removeData(this,"hover");
                        setTimeout(function(){
                            n(r)
                        },
                        t.outDelay);
                    }
                );
                s.css({
                    display: "block",
                    position: "absolute",
                    zIndex: 99999
                });
                var o = e.extend(
                    {},
                    e(r).offset(),
                    {
                        width: r.offsetWidth,
                        height: r.offsetHeight
                    }
                );
                //console.log(o);
                //console.log(e("body").height());
                //alert(e("body").height()-o.top+t.offset[1]);
                if ( t.align == "left" ){
                    left = o.left
                }
                else if ( t.align == "center" ){
                    left = o.left + o.width/2-s[0].offsetWidth/2
                }
                else if ( t.align == "right" ){
                    left = o.left + o.width-s[0].offsetWidth
                }
                left += t.offset[0];
                tooltipOffSet = {
                	element: s,
                	data: function (_tooltip_) {
	                	return {
		                    top: o.top - (_tooltip_[0].offsetHeight + t.offset[1]),//e("body").height()-o.top+t.offset[1],
		                    left:left                		
	                	}
                	},
                	update: function () {
                		this.element.css(this.data(this.element));
                	}

                };
                s.css(tooltipOffSet.data(s));
                //console.log(tooltípOffSet);
                t.mousein ( r )
            },
            t.inDelay);
        }).on( "mouseleave", function(){
            var e = this;
            setTimeout( function() {
                n( e );
            }, t.outDelay);
        });
    };
})(jQuery);
function empty(e){var t,n,r,i;var s=[t,null,false,0,"","0"];for(r=0,i=s.length;r<i;r++){if(e===s[r]){return true}}if(typeof e==="object"){for(n in e){return false}return true}return false}
function mt_rand(e,t){var n=arguments.length;if(n===0){e=0;t=2147483647}else if(n===1){throw new Error("Warning: mt_rand() expects exactly 2 parameters, 1 given")}else{e=parseInt(e,10);t=parseInt(t,10)}return Math.floor(Math.random()*(t-e+1))+e}
var reportBox={pressed:null,pressClass:"qPress",blurClick:function(e){if(reportBox.pressed&&e!=reportBox.pressed){$(reportBox.pressed).removeClass(reportBox.pressClass);reportBox.pressed=null}},start:function(){$("#common_question_container").delegate("div.questionBox","mouseenter",function(){var e=$(this),t=e.position();e.find("div.reportBox:first").css("top",t.top-2).css("right",t.left-2)}).delegate("a.reportPointer","click",function(){var e=$(this).closest("div.reportBox"),t=e.get(0);reportBox.blurClick(t);e.hasClass(reportBox.pressClass)?(e.removeClass(reportBox.pressClass),$(this).blur()):(e.addClass(reportBox.pressClass),reportBox.pressed=t);return!1})}}