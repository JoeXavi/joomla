/**
 * @package		Register Login Joomla Module
 * @author		JoomDev
 * @copyright	Copyright (C) 2018 Joomdev, Inc. All rights reserved.
 * @license    GNU/GPLv3 https://www.gnu.org/licenses/gpl-3.0.html
 */

jQuery(document).ready(function () {
	function error() {
		jQuery('#error_message1').css("padding", "15px");
		jQuery('#error_message1').css("background", "#f2dede");
		jQuery('#error_message1').css("color", "#a94442");
		jQuery('#error_message1').css("display", "inline-block");
	}

	function success() {
		jQuery('#error_message1').css("padding", "15px");
		jQuery('#error_message1').css("background", "#dff0d8");
		jQuery('#error_message1').css("color", "#3c763d");
		jQuery('#error_message1').css("display", "inline-block");
	}

	function scroll(val){
		
		jQuery('html, body').stop().animate({
            scrollTop: jQuery('#error_message1').offset().top - jQuery('#error_message1').outerHeight()
		}, 1000);

		if(val !== undefined)
		{	setTimeout(function(){
				window.location.href = jQuery('#urlbase').val();
			},5000);}
	}

	jQuery(".view_").change(function () {
		if (jQuery(this).val() == 1) {
			jQuery('#login_form input#openview').val(jQuery(this).val());
		} else if (jQuery(this).val() == 2) {
			jQuery('#registration_ input#openview').val(jQuery(this).val());
		}
	});

	jQuery("#registration_form").validate({
		rules: {
			'terms[]': {
				required: true,
				maxlength: 2
			}
		},
		messages: {
			'terms[]': {
				required: "You must check at least 1 box",
				maxlength: "Check no more than {0} boxes"
			}
		},
		submitHandler: function () {
			
			var submit = jQuery('#register_submit');
			jQuery.ajax({
				url: 'index.php?option=com_ajax&module=registerlogin&method=getUserRegister&Itemid=+itemId+&format=json',
				type: 'POST',
				data: jQuery('#registration_form').serialize(),
				async: true,
				beforeSend: function () {
					submit.attr('disabled', true);
					jQuery('.regload').show();
				},
				success: function (response) {
					jQuery('.regload').hide();
					submit.removeAttr('disabled');
					if (response) {
						jQuery('form#registration_form input#register_submit').val('Register');
						scroll()
						error();
					}
					if (response == "captcha incorrect") {
						jQuery('#error_message1').html("Captcha incorrect , please enter valid value");
						scroll()
						error();
					} else if (response == "The username you entered is not available. Please pick another username.") {
						jQuery('#error_message1').html(response);
						scroll()
						error();
					} else if (response == "This email address is already registered.") {
						jQuery('#error_message1').html(response);
						scroll()
						error();
					} else if (response == "Please enter your name.") {
						jQuery('#error_message1').html("Sorry the credentials you are using are invalid");
						scroll()
						error();
					} else {
						jQuery('form#registration_form input').val('');
						jQuery('#error_message1').html("<b>Excelente :)</b> Estas registrado, se ha enviado un correo de activacion, revisa en spam si no lo vez en bandeja de entrada</br><b>Puedes seguir navegando en los articulos de Publimotos</b> <a href='"+jQuery('#urlbase').val()+"'>>AQUI<</a> ");
						scroll();
						localStorage.setItem("RegisterUser",true);
						document.cookie = "RegisterUser=true;path=/;expires=Thu, 31 Dec 2099 23:59:59 UTC;";
						sessionStorage.setItem("sesionuserpublimotos",true)
						success();
						jQuery('#login_view').click();
					}
				},
				error: function (e) {
					//alert("error");
					jQuery('.regload').hide();
					submit.removeAttr('disabled');
					console.log(e);
				}
			});
			return false;
		}
	});
	
	jQuery("#login-form").validate({
		submitHandler: function(){
			console.log("Login")
			var submit = jQuery('#login_submit');
			let data = {
				username: jQuery('#modlgn-username').val().replace("@",".arroba"),
				password: jQuery('#modlgn_passwd').val()
			}
			
			jQuery.ajax({
				url: 'index.php?option=com_ajax&module=registerlogin&method=getUserLogin&format=json',
				type: 'POST',
				data: data,
				async: true,
				beforeSend: function () {
					submit.attr('disabled', true);
					jQuery('.regload').show();
				},
				success: function (response){
					if(response == 1){
						jQuery('#error_message1').html("<b>Excelente :)</b> Sesion iniciada puedes navegar en nuestros articulos");
						scroll(1)
						success();
						localStorage.setItem("RegisterUser",true);
						document.cookie = "RegisterUser=true;path=/;expires=Thu, 31 Dec 2099 23:59:59 UTC;";
						sessionStorage.setItem("sesionuserpublimotos",true)
					}
					else {
						jQuery('#error_message1').html("Credenciales incorrectas");
						scroll()
						error();
					}
				}
			})
		}
	});

	
});