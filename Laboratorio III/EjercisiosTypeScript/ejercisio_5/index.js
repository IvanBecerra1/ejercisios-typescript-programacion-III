"use strict";
let nombre = "ivan";
let apellido = "becerra";
const primeraLetraGrande = (param) => {
    return param.charAt(0).toUpperCase() + param.slice(1).toLowerCase();
};
const mostrarNombreApellido = (nombre, apellido) => {
    let mensaje = "";
    mensaje = apellido.toUpperCase() + " - " + primeraLetraGrande(nombre);
    return mensaje;
};
console.log("el resultado es: ", mostrarNombreApellido(nombre, apellido));
//# sourceMappingURL=index.js.map