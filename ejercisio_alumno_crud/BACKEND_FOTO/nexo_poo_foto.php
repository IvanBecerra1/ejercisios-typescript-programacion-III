<?php 
session_start();

require_once 'AlumnoFoto.php';
use AlumnoFoto\AlumnoFoto as Alumno;

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : 'ninguno';
$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : 'ninguno';
$legajo = isset($_POST['legajo']) ? (int) $_POST['legajo'] : '0';


if (isset($_POST['accion']) && $_POST['accion'] == 'agregar') {
    echo "<h1>Agregando Alumno</h1> <br>";

    $foto = "./fotos/" . $_FILES["foto"]["name"];
    echo "datos: $nombre, $apellido , $legajo";

    Alumno::guardar(new Alumno($nombre, $apellido, $legajo, $foto));
    
} elseif (isset($_POST['accion']) && $_POST['accion'] == 'modificar') {

    echo "<h1>Editando alumno legajo </h1><br>";
    
    Alumno::editar(new Alumno($nombre, $apellido, $legajo, ""));

} elseif (isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {

    echo "<h1>ELIMINANDO EL ALUMNO LEGAJO</h1><br>";
    Alumno::eliminar(new Alumno("","" , $legajo, ""));

} elseif (isset($_POST['accion']) && $_POST['accion'] == 'verificar') {
    $alumnoObtenido = Alumno::buscarPorLegajo($legajo);

    if (empty($alumnoObtenido)){
        echo "No se encontro el alumno";
    }
    else {
        echo "Alumno: ". $alumnoObtenido->toString();
    }    

}elseif (isset($_GET['accion']) && $_GET['accion'] == 'listar') {
    $lista = Alumno::listar();

    var_dump($lista);

    echo "LISTANDO GENTES<br>";
    foreach($lista as $alumno) {

        echo $alumno->toString() . "<br>";
    }
}
elseif (isset($_POST['accion']) && $_POST['accion'] == 'dirigir') {

    echo "OPCION DIRIGIR";
    $alumnoObtenido = Alumno::buscarPorLegajo($legajo); 
    var_dump($alumnoObtenido);
    
    if (empty($alumnoObtenido)){
        echo "<h1>El alumno con legajo $legajo no se encuentra en el listado</h1>";
    }
    else {
        $_SESSION['nombre'] = $alumnoObtenido->getNombre();
        $_SESSION['apellido'] = $alumnoObtenido->getApellido();
        $_SESSION['legajo'] = $alumnoObtenido->getLegajo();
        $_SESSION['foto'] = $alumnoObtenido->getFoto();
        $_SESSION['listado'] = Alumno::listar();

        header("location:./principal.php");
    }  

}
elseif (isset($_POST['accion']) && $_POST['accion'] == 'obtener') {

    echo "OPCION obtener";
    $alumnoObtenido = Alumno::buscarPorLegajo($legajo); 
  
    if (empty($alumnoObtenido)){
        echo "<h1>El alumno con legajo $legajo no se encuentra en el listado</h1>";
    }
    else {
        var_dump($alumnoObtenido);
    }  

}

?>