function docReady(fn) {
    // see if DOM is already available
    if (document.readyState === "complete" || document.readyState === "interactive") {
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}
 
function offset(el) {
    var rect = el.getBoundingClientRect(),
    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
    scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    return { top: rect.top + scrollTop, left: rect.left + scrollLeft }
}
function hiddeContent(){
    let element = document.getElementById("forceregister");
        let elementBlur = document.getElementById("blurCont");
        let mensaje = document.getElementById("contenedor_message");
        

        element.classList.remove("displayNone");
        element.classList.add("forceregister");
        element.classList.add("anuncios");
        let URLactual = ' ' + window.location;
        ga('send', 'event','Plugin_Register', "Vista", URLactual, 1);

        let contElement = document.getElementsByClassName("article-content");
        element.style.width = contElement[0].clientWidth + "px";
        element.style.height = elementBlur.scrollHeight + "px";
        let poElement = element.getBoundingClientRect().top;
        let posContElement = elementBlur.scrollHeight;
        elementBlur.classList.add("blur");
        linkRegister = document.getElementById("clickregister");
        
        //console.log("Posicion de lemento: ",poElement)
        document.onscroll=function(){
            let supportPageOffset = window.pageXOffset !== undefined;
            let isCSS1Compat = ((document.compatMode || "") === "CSS1Compat");
            let y = supportPageOffset ? window.pageYOffset : isCSS1Compat ? document.documentElement.scrollTop : document.body.scrollTop;
            //console.log("Posicion: ",y)
            if(y>poElement && poElement+posContElement>y)
                {
                    mensaje.classList.add("contenedor_message_fixed");

                }
            else
                {
                    mensaje.classList.remove("contenedor_message_fixed");
                }
        }
}

function load(){
    
    let registerUser = localStorage.getItem("RegisterUser");
    let cookitRegister = document.cookie.replace(/(?:(?:^|.*;\s*)RegisterUser\s*\=\s*([^;]*).*$)|^.*$/, "$1");
    //console.log('cookitRegister',cookitRegister);
    let ifloguin = document.getElementById("ifloguin");
    if(ifloguin){
        if(ifloguin.value == 1 ){
            let SesionUser = sessionStorage.getItem("sesionuserpublimotos")
            if(!SesionUser){
                hiddeContent()
            }
        }
        else{
            if(registerUser || cookitRegister) {
            
            }
            else {
                hiddeContent();
            }
        }
    }
}

    docReady(function(){
        setTimeout(function(){
            load();
        },1000)
        
    })
  
