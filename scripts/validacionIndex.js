// ------------ VALIDADORES -------------------

function validarNombre(v) {
    return /^[A-Za-zÀ-ÿ\s]{2,}$/.test(v);
}

function validarTelefono(v) {
    return /^[0-9]{10}$/.test(v);
}

function validarCorreo(v) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
}

function validarMensaje(v) {
    return v.length >= 5;
}

// ------------ FUNCIÓN GENERAL -------------------

function validarCampo(input, validator, errorMessage) {
    const value = input.value.trim();
    const errorDiv = input.parentElement.querySelector(".error");

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

// ------------ MANEJO DEL FORMULARIO -------------------

document.addEventListener("DOMContentLoaded", () => {
    
    const form = document.querySelector("form.formulario");

    const nombre = form.querySelector("input[name='nombre']");
    const telefono = form.querySelector("input[name='telefono']");
    const correo = form.querySelector("input[name='correo']");
    const mensaje = form.querySelector("textarea[name='mensaje']");

    form.addEventListener("submit", (e) => {

        const vNombre = validarCampo(nombre, validarNombre, "Solo letras, mínimo 2 caracteres.");
        const vTelefono = validarCampo(telefono, validarTelefono, "Debe tener exactamente 10 dígitos.");
        const vCorreo = validarCampo(correo, validarCorreo, "Correo no válido.");
        const vMensaje = validarCampo(mensaje, validarMensaje, "Debe contener al menos 5 caracteres.");

        if (!vNombre || !vTelefono || !vCorreo || !vMensaje) {
            e.preventDefault(); // evita recarga
        }
    });

});
