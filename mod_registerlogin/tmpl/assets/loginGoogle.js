let googleUser = {};
let startApp = function() {
            gapi.load('auth2', function(){  
            auth2 = gapi.auth2.init({
                client_id: '292053978628-dinmjr4ovqosig46qllndl7p6pahdae3.apps.googleusercontent.com',
                cookiepolicy: 'single_host_origin',
                // Request scopes in addition to 'profile' and 'email'
                //scope: 'additional_scope'
            });
            attachSignin(document.getElementById('customBtn'));
            });
        };

        function attachSignin(element) {
            auth2.attachClickHandler(element, {},
                function(googleUser) {
                    let profile = googleUser.getBasicProfile();

                    let data = {
                        user: profile.getEmail().replace("@",".arroba"),
                        pass: profile.getId()
                    }
                    
                    console.log("Data send", data);
                    jQuery.ajax({
                        url: 'index.php?option=com_ajax&module=registerlogin&method=seeUserLogin&format=json',
                        type: 'POST',
                        data: data,
                        async: true,
                        success: function (response){
                            console.log("Data received",response);
                            if(response == 1){
                                jQuery('#error_message1').html("Excelente :) Sesion iniciada puedes navegar en nuestros articulos");
                                success();
                                jQuery('#error_message1').focus();
                                localStorage.setItem("RegisterUser",true);
                                sessionStorage.setItem("sesionuserpublimotos",true)
                                }
                            else if(response === "register"){
                                $("#register_view").prop("checked", true);
                                let element = document.getElementById("endRegisterGoogle");
                                let email1 = document.getElementById("jform_email2");
                                email1.value = profile.getEmail();
                                let email2 = document.getElementById("jform_email1");
                                email2.value =  profile.getEmail();
                                let nombre = document.getElementById("jform_name");
                                nombre.value =  profile.getGivenName();
                                let error1 = document.getElementById("error_message1");
                                error1.innerHTML = "<span style='padding:3px; '>Solo falta unos datos y listo</span>";
                                let username = document.getElementById("jform_username");
                                username.value = profile.getGivenName().replace(/ /g, "");
                                let pass1 = document.getElementById("jform_password1");
                                pass1.value = profile.getId()
                                let pass2 = document.getElementById("jform_password2");
                                pass2.value = profile.getId()
                                let campTel = document.getElementById("jform_profile_phone");
                                campTel.focus();                               
                            }
                            else {
                                jQuery('#error_message1').html("Credenciales incorrectas");
                                error();
                            }

                        }
                    })

                }, function(error) {
                console.error(JSON.stringify(error, undefined, 2));
                });
        }

        window.onload = function(){
          startApp()
        };

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
        
        
        
        