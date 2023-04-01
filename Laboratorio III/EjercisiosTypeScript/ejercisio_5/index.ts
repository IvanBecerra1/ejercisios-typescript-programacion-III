

let nombre : string = "ivan";
let apellido : string = "becerra";


const primeraLetraGrande = (param : string) : string => {
    return param.charAt(0).toUpperCase() + param.slice(1).toLowerCase();
}

const mostrarNombreApellido = (nombre : string, apellido : string) : string => {
    let mensaje : string = "";
    mensaje = apellido.toUpperCase() + " - " + primeraLetraGrande(nombre);

    return mensaje;
}

console.log("el resultado es: ", mostrarNombreApellido(nombre,apellido));