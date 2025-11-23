// ----------------------------------------------
// VALIDADORES INDIVIDUALES
// ----------------------------------------------

function validarTexto(value) {
    return /^[A-Za-zÀ-ÿ0-9\s]{2,}$/.test(value);
}

function validarNumeroEntero(value) {
    return /^[0-9]+$/.test(value) && Number(value) > 0;
}

function validarNumeroDecimal(value) {
    return !isNaN(value) && Number(value) > 0;
}

function validarFecha(value) {
    if (!value) return false;
    const hoy = new Date();
    const fechaUser = new Date(value);
    return fechaUser > hoy;
}

function validarDescripcion(value) {
    return value.length >= 5;
}

function validarURL(value) {
    // Url opcional
    if (value.trim() === "") return true;

    try {
        new URL(value);
        return true;
    } catch {
        return false;
    }
}

// ----------------------------------------------
// VALIDACIÓN DE CAMPO URL (opcional)
// ----------------------------------------------
function validarCampoURL(input, errorDiv, errorMessage) {
    const value = input.value.trim();

    if (!validarURL(value)) {
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

// ----------------------------------------------
// VALIDACIÓN DE CAMPO GENÉRICA
// ----------------------------------------------
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

// ----------------------------------------------
// VALIDACIÓN COMPLETA DEL FORMULARIO
// ----------------------------------------------
window.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("form1");

    const nombre = document.querySelector("[name='nombreSorteo']");
    const organizador = document.querySelector("[name='organizador']");
    const boletos = document.querySelector("[name='boletosRestantes']");
    const precio = document.querySelector("[name='precioBoleto']");
    const fecha = document.querySelector("[name='fechaJuego']");
    const descripcion = document.querySelector("[name='descripcion']");
    const imagen = document.querySelector("[name='enlaceImagen']");

    // Recuperar los <div> de errores ya existentes en el HTML
    const errNombre = document.getElementById("nombreSorteoError");
    const errOrganizador = document.getElementById("organizadorError");
    const errBoletos = document.getElementById("boletosRestantesError");
    const errPrecio = document.getElementById("precioBoletoError");
    const errFecha = document.getElementById("fechaJuegoError");
    const errDescripcion = document.getElementById("descripcionError");
    const errImagen = document.getElementById("enlaceImagenError");

    form.addEventListener("submit", function (e) {

        const vNombre = validarCampo(nombre, validarTexto, errNombre, "Mínimo 2 caracteres.");
        const vOrganizador = validarCampo(organizador, validarTexto, errOrganizador, "Mínimo 2 caracteres.");
        const vBoletos = validarCampo(boletos, validarNumeroEntero, errBoletos, "Debe ser un número entero mayor a 0.");
        const vPrecio = validarCampo(precio, validarNumeroDecimal, errPrecio, "Debe ser un número mayor a 0.");
        const vFecha = validarCampo(fecha, validarFecha, errFecha, "Debe ser una fecha futura.");
        const vDescripcion = validarCampo(descripcion, validarDescripcion, errDescripcion, "Mínimo 5 caracteres.");

        const vImagen = validarCampoURL(imagen, errImagen, "Ingrese una URL válida.");

        if (!vNombre || !vOrganizador || !vBoletos || !vPrecio || !vFecha || !vDescripcion || !vImagen) {
            e.preventDefault();
        }
    });
});
