/*
const btnAgregar = document.getElementById("btn-agregar") as HTMLInputElement
const btnModificar = document.getElementById("btn-modificar") as HTMLInputElement;
const btnEliminar = document.getElementById("btn-eliminar") as HTMLInputElement;
const btnVerificar = document.getElementById("btn-verificar") as HTMLInputElement;
const btnLista = document.getElementById("btn-lista") as HTMLInputElement;
const url = "./BACKEND/nexo_poo.php";

const comunicar = new XMLHttpRequest();
const formData : FormData = new FormData();
/*



function agregarPost(){

    let nombre = document.getElementById("id-nombre") as HTMLInputElement;
    let apellido = document.getElementById("id-apellido") as HTMLInputElement;
    let legajo = document.getElementById("id-legajo") as HTMLInputElement;
    
    comunicar.addEventListener("readystatechange", () =>{
        if (comunicar.readyState != 4){
            return;
        }

        if (comunicar.status != 200){
            return;
        }

        console.log(comunicar.responseText);
    });
    formData.append('accion', "agregar");
    formData.append('legajo', legajo.value.toString());
    formData.append('apellido', apellido.value);
    formData.append('nombre', nombre.value);


    comunicar.open("POST", url, true);
    //comunicar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    //let cadena : string = "nombre=" + nombre.value + "&apellido=" + apellido.value + "&legajo="+legajo.value + "&accion=agregar";
    comunicar.send(formData);
}


btnAgregar.addEventListener("click", () =>{
    console.log("Se envio la peticion en el POST - Agregar");
    agregarPost();
});

function modificarPost(){
    let nombre = document.getElementById("id-nombre-m") as HTMLInputElement;
    let apellido = document.getElementById("id-apellido-m") as HTMLInputElement;
    let legajo= document.getElementById("id-legajo-m") as HTMLInputElement;

    formData.append('accion', "modificar");
    formData.append('legajo', legajo.value.toString());
    formData.append('apellido', apellido.value);
    formData.append('nombre', nombre.value);


    comunicar.addEventListener("readystatechange", () =>{
        if (comunicar.readyState != 4){
            return;
        }
        
        if (comunicar.status != 200){
            return;
        }
        console.log(comunicar.responseText);
    });

    comunicar.open("POST", url, true);
    comunicar.send(formData);
}

btnModificar.addEventListener("click", () =>{
    console.log("Se envio la peticion Post modificar");
    modificarPost();
});

function eliminarPost(){
    let legajo= document.getElementById("id-legajo-b") as HTMLInputElement;

    formData.append('accion', "eliminar");
    formData.append('legajo', legajo.value.toString());

    comunicar.addEventListener("readystatechange", () =>{
        if (comunicar.readyState != 4){
            return;
        }
        
        if (comunicar.status != 200){
            return;
        }
        console.log(comunicar.responseText);
    });

    comunicar.open("POST", url, true);
    comunicar.send(formData);
}
btnEliminar.addEventListener("click", () =>{
    console.log("Se envio la peticion Post eliminar");
    eliminarPost();
});


function verificarPost(){
    let legajo= document.getElementById("id-legajo-v") as HTMLInputElement;

    formData.append('accion', "verificar");
    formData.append('legajo', legajo.value.toString());

    comunicar.addEventListener("readystatechange", () =>{
        if (comunicar.readyState != 4){
            return;
        }
        
        if (comunicar.status != 200){
            return;
        }
        console.log(comunicar.responseText);
    });

    comunicar.open("POST", url, true);
    comunicar.send(formData);
}
btnVerificar.addEventListener("click", () =>{
    console.log("Se envio la peticion Post verificar");
    verificarPost();
});


function listaGet(){

    comunicar.addEventListener("readystatechange", () =>{
        if (comunicar.readyState != 4){
            return;
        }
        
        if (comunicar.status != 200){
            return;
        }
        console.log(comunicar.responseText);
        (<HTMLDivElement> document.getElementById("id-lista")).innerHTML = comunicar.responseText;
    });

    comunicar.open("GET", url + "?accion=listar", true);
    comunicar.send();
}
btnLista.addEventListener("click", () =>{
    console.log("Se envio la peticion Post lista");
    listaGet();
});
*/