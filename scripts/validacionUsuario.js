// Funciones para validar cada input
function validarNombre(value) { //Jala igual para los apellidos
    return /^[A-Za-zÀ-ÿ\s]{2,}$/.test(value);
}

function validarTelefono(value) {
    return /^[0-9]{10}$/.test(value);
}

function validarCorreo(value) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
}

function validarContrasena(value) {
    return /^(?=.*[A-Z])(?=.*\d).{8,}$/.test(value);
}

function compararContrasenas(pass1, pass2) {
    return pass1 === pass2 && pass1 !== "";
}

// Validación individual de cada campo
function validarCampo(input, validator, errorDiv, errorMessage) {
    const value = input.value.trim();

    if (value === "") {
        input.classList.add("invalid");
        input.classList.remove("valid");
        errorDiv.textContent = "Este campo no puede ir vacío.";
        return false;
    }

    if (!validator(value)) {
        input.classList.add("invalid");
        input.classList.remove("valid");
        errorDiv.textContent = errorMessage;
        return false;
    }

    input.classList.add("valid");
    input.classList.remove("invalid");
    errorDiv.textContent = "";
    return true;
}

// -------------------------------------------------------
// VALIDACIÓN COMPLETA DEL FORMULARIO
// -------------------------------------------------------

window.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("form1");

    const nombre = document.getElementById("nombre");
    const apellido = document.getElementById("apellido");
    const telefono = document.getElementById("telefono");
    const correo = document.getElementById("correo");
    const contrasena = document.getElementById("contrasena");
    const contrasena2 = document.getElementById("contrasena2");

    const errNombre = document.getElementById("nombreError");
    const errApellido = document.getElementById("apellidoError");
    const errTelefono = document.getElementById("telefonoError");
    const errCorreo = document.getElementById("correoError");
    const errPass = document.getElementById("contrasenaError");
    const errPass2 = document.getElementById("contrasena2Error");

    form.addEventListener("submit", function (e) {
        
        const vNombre = validarCampo(nombre, validarNombre, errNombre, "Solo letras, mínimo 2 caracteres.");
        const vApellido = validarCampo(apellido, validarNombre, errApellido, "Solo letras, mínimo 2 caracteres.");
        const vTelefono = validarCampo(telefono, validarTelefono, errTelefono, "Debe contener exactamente 10 dígitos.");
        const vCorreo = validarCampo(correo, validarCorreo, errCorreo, "Correo no válido.");
        const vContrasena = validarCampo(contrasena, validarContrasena, errPass, "Mínimo 8 caracteres, 1 mayúscula y 1 número.");

        let vContrasena2 = true;
        if (!compararContrasenas(contrasena.value, contrasena2.value)) {
            contrasena2.classList.add("invalid");
            contrasena2.classList.remove("valid");
            errPass2.textContent = "Las contraseñas no coinciden.";
            vContrasena2 = false;
        } else {
            contrasena2.classList.add("valid");
            contrasena2.classList.remove("invalid");
            errPass2.textContent = "";
        }

        // Si algo está mal, NO dejar enviar
        if (!vNombre || !vApellido || !vTelefono || !vCorreo || !vContrasena || !vContrasena2) {
            e.preventDefault();
        }
    });
});

