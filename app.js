const valueUsuario = document.querySelector(".cUSUARIO");
const valuePassword = document.querySelector(".cPASSWORD")
const passEquals = document.querySelectorAll(".cEQUALS");
const submitButon = document.querySelector("#validarFormularioButton");
const allErrorMessage = document.querySelectorAll('div[id$="Error"]');
const valueEmail = document.querySelector(".cEMAIL");
const requiredValues = document.querySelectorAll(".cREQUIRED");

// funcion generica que pinta los errores
function setErrorMessage(item,message) {
    item.style.border = "1px solid red";

    const tpl = document.createElement('template');
    tpl.innerHTML = message;
    fragment= tpl.content;   
    document.querySelector("#" + item.getAttribute("name") + "Error").appendChild(fragment);
}

// ponemos el eventlistener pera eliminar los errores 
 // excluyo los elemento imputs de tipo "radio" , de tipo "checkbox" y de tipo "submit" que no permiten innerHTML
 allInputs.forEach(inputValue => {
    if (inputValue.type !== "radio" && inputValue.type !== "checkbox" && inputValue.type !== "submit" ) {
        inputValue.addEventListener("focus", function () {
            inputValue.style.border = "1px solid black";
            document.querySelector("#" + inputValue.name + "Error").innerHTML = "";
        })
    }
});

submitButon.addEventListener('click', function (e) {
    e.preventDefault();
    quitarMensajesError();
   
// comporbamos todos los elementos y devolvemos true si esta ok y false si no
    let requiredValid= validarRequerido();  
    let soloTextoValid= validarSoloTexto();
    let usaurioValid= comprobarUsuario(valueUsuario);
    let paswordValid= comprobarPassword(valuePassword);
    let equalsValid= validarEquals();
    let emailValid= comprobarEmail(valueEmail);
    // solo sera un formularioCorrecto si todas las validaciones han sido true.
    let formularioCorrecto = requiredValid && soloTextoValid && usaurioValid && paswordValid && equalsValid && emailValid;

   if (formularioCorrecto) {
    mostrarDatos();
    mostrarDatosFormElements() 
   }

});


function validarEquals() {
    let validacionCorrecta = true;

    if (passEquals[0].value !== passEquals[1].value) {
        validacionCorrecta = false;
        setErrorMessage( passEquals[0],"<br> Las contraseñas no coinciden");
        setErrorMessage( passEquals[1],"<br> Las contraseñas no coinciden");
    }
    return validacionCorrecta;
}

function validarSoloTexto() {
    let expresionRegularSoloTexto = /[a-zA-Z]+/; 
    let validacionCorrecta = true;

    textValues.forEach(textValue => {   

        if (!expresionRegularSoloTexto.test(textValue.value)) {  
            validacionCorrecta = false;
            setErrorMessage(textValue,"<br>Este campo solo puede contener letras!")
        }
    });
    return validacionCorrecta;
}

function validarRequerido() {
    let validacionCorrecta = true;
    requiredValues.forEach(requiredValue => {
        if (requiredValue.value === "") {
            setErrorMessage(requiredValue, "<br>Este campo no puede ser nulo");
            validacionCorrecta = false;
        }
    });
    return validacionCorrecta;
}

    function comprobarPassword(password) {
        //Pendiente de saber que condicion hay que comprobar para mostrar el mensaje de error
        let expresionRegularPassword = /[A-Za-z0-9!?-]{8,12}/;
        let validacionCorrecta = true;


        if (!expresionRegularPassword.test(password.value)) {
            setErrorMessage(password, "<br>  Esta contraeña no cumple los requisitos especificados!");
            validacionCorrecta = false;
        }
        
        return validacionCorrecta;
    
    }

    function comprobarEmail(email) {
        //Pendiente de saber que condicion hay que comprobar para mostrar el mensaje de error
        let expresionRegularEmail = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        let validacionCorrecta = true;

        if (!expresionRegularEmail.test(email.value)) {
            setErrorMessage(email, "<br>  Este correo electronico no cumple los requisitos especificados!");
            validacionCorrecta = false;
        } 
        return validacionCorrecta;
    }


    // recuperamos los datos yo lo he echo con un recorrido por todos los inputs 
    // pero hay otras opciones podriamos haber recorrido los elementos cTEXT, cEMAIL, cDNI etc
    function mostrarDatos() {
        let datosAmostrar = "";
        // a nivel global ya tenemos un document.querySelectorAll("input") pero en este punto no nos sirve porque emos
        // añadido y quitado elementos dinamicamente y queySelectro no se refrescan automaticamente. 
        let inputs = document.querySelectorAll("input");
        // el elemento textArea no entralia el el query selectro input
        let textArea = document.querySelector("textarea");
        inputs.forEach (function(input) {
            if (input.type === "radio" || input.type === "checkbox" ) {
                if (input.checked) {
                    datosAmostrar += `<p>${input.getAttribute("name")}: ${input.value}</p>`;
                }
            } else if (input.type !== "submit"  ) {
                let valor = input.getAttribute("name");
                if (valor=== null) {
                    valor = input.id;
                }
               datosAmostrar += `<p>${valor}: ${input.value}</p>`;
            }

        });
        datosAmostrar += `<p>${textArea.getAttribute("name")}: ${textArea.value}</p>`;
        resultadoFinal.innerHTML += "<br><br><br><br><h3>Estos son tus datos:</h3><br><br>" + datosAmostrar ;
    }
 

// elimina los mensajes de error
function quitarMensajesError() {
    allErrorMessage.forEach(divElement => {
        divElement.innerHTML = "";
    });
}

// funcion generica que usamos para pintar los checkbox y radio asociados al select de sistemas operativos.
// como siempre pintamos para todos los sistemas operativos pinto siempre solo que si es linux pinto un elemento adicional.
function setSistemasOperativosData(linux) {
    let templateConocimiento = document.querySelector("#conocimiento").content;
    let templateDistribuciones = document.querySelector("#distribuciones").content;
    
    let cloneConocimiento = templateConocimiento.cloneNode(true);
    fragment.appendChild(cloneConocimiento);
    if (linux) {
        let cloneDistribuciones = templateDistribuciones.cloneNode(true);
        fragment.appendChild(cloneDistribuciones);
    }
    sistemaOperativo.appendChild(fragment);
}


  
