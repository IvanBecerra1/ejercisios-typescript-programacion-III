"use strict";
const btnAgregar = document.getElementById("btn-agregar");
const btnModificar = document.getElementById("btn-modificar");
const btnEliminar = document.getElementById("btn-eliminar");
const btnVerificar = document.getElementById("btn-verificar");
const btnLista = document.getElementById("btn-lista");
const url = "./nexo_poo_foto.php";
const comunicar = new XMLHttpRequest();
const formData = new FormData();
/*

*/
function agregarPost() {
    let nombre = document.getElementById("id-nombre");
    let apellido = document.getElementById("id-apellido");
    let legajo = document.getElementById("id-legajo");
    let foto = document.getElementById("id-foto");
    comunicar.addEventListener("readystatechange", () => {
        if (comunicar.readyState != 4) {
            return;
        }
        if (comunicar.status != 200) {
            return;
        }
        console.log(comunicar.responseText);
        alert("Se agrego el alumno");
    });
    formData.append('accion', "agregar");
    formData.append('legajo', legajo.value.toString());
    formData.append('apellido', apellido.value);
    formData.append('nombre', nombre.value);
    if (foto.files && foto.files.length > 0) {
        formData.append('foto', foto.files[0]);
    }
    comunicar.open("POST", url, true);
    //comunicar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    //let cadena : string = "nombre=" + nombre.value + "&apellido=" + apellido.value + "&legajo="+legajo.value + "&accion=agregar";
    comunicar.send(formData);
}
btnAgregar.addEventListener("click", () => {
    console.log("Se envio la peticion en el POST - Agregar");
    agregarPost();
});
function modificarPost() {
    let nombre = document.getElementById("id-nombre-m");
    let apellido = document.getElementById("id-apellido-m");
    let legajo = document.getElementById("id-legajo-m");
    let foto = document.getElementById("id-foto-m");
    formData.append('accion', "modificar");
    formData.append('legajo', legajo.value.toString());
    formData.append('apellido', apellido.value);
    formData.append('nombre', nombre.value);
    if (foto.files && foto.files.length > 0) {
        formData.append('foto', foto.files[0]);
    }
    comunicar.addEventListener("readystatechange", () => {
        if (comunicar.readyState != 4) {
            return;
        }
        if (comunicar.status != 200) {
            return;
        }
        console.log(comunicar.responseText);
        alert("Se modifico el alumno");
    });
    comunicar.open("POST", url, true);
    comunicar.send(formData);
}
btnModificar.addEventListener("click", () => {
    console.log("Se envio la peticion Post modificar");
    modificarPost();
});
function eliminarPost() {
    let legajo = document.getElementById("id-legajo-b");
    formData.append('accion', "eliminar");
    formData.append('legajo', legajo.value.toString());
    comunicar.addEventListener("readystatechange", () => {
        if (comunicar.readyState != 4) {
            return;
        }
        if (comunicar.status != 200) {
            return;
        }
        console.log(comunicar.responseText);
    });
    comunicar.open("POST", url, true);
    comunicar.send(formData);
}
btnEliminar.addEventListener("click", () => {
    console.log("Se envio la peticion Post eliminar");
    eliminarPost();
});
function verificarPost() {
    let legajo = document.getElementById("id-legajo-v");
    formData.append('accion', "verificar");
    formData.append('legajo', legajo.value.toString());
    comunicar.addEventListener("readystatechange", () => {
        if (comunicar.readyState != 4) {
            return;
        }
        if (comunicar.status != 200) {
            return;
        }
        console.log(comunicar.responseText);
    });
    comunicar.open("POST", url, true);
    comunicar.send(formData);
}
btnVerificar.addEventListener("click", () => {
    console.log("Se envio la peticion Post verificar");
    verificarPost();
});
function listaGet() {
    comunicar.addEventListener("readystatechange", () => {
        if (comunicar.readyState != 4) {
            return;
        }
        if (comunicar.status != 200) {
            return;
        }
        console.log(comunicar.responseText);
        document.getElementById("id-lista").innerHTML = comunicar.responseText;
    });
    comunicar.open("GET", url + "?accion=listar", true);
    comunicar.send();
}
btnLista.addEventListener("click", () => {
    console.log("Se envio la peticion Post lista");
    listaGet();
});
//# sourceMappingURL=funciones.js.map