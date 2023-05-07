<?php 
require_once 'Alumno.php';
use Alumno\Alumno as Alumno;



//$accion = isset($_POST['accion']) ? $_POST['accion'] : 'ninguno';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : 'ninguno';
$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : 'ninguno';
$legajo = isset($_POST['legajo']) ? (int) $_POST['legajo'] : '0';


if (isset($_POST['accion']) && $_POST['accion'] == 'agregar') {
    echo "<h1>Agregando Alumno</h1> <br>";

    echo "datos: $nombre, $apellido , $legajo";

    Alumno::guardar(new Alumno($nombre, $apellido, $legajo));
    
} elseif (isset($_POST['accion']) && $_POST['accion'] == 'modificar') {

    echo "<h1>Editando alumno legajo </h1><br>";
    
    Alumno::editar(new Alumno($nombre, $apellido, $legajo));

} elseif (isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {

    echo "<h1>ELIMINANDO EL ALUMNO LEGAJO</h1><br>";
    Alumno::eliminar(new Alumno("","" , $legajo));

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

    echo "LISTANDO GENTES";
    foreach($lista as $alumno) {

        echo $alumno->toString() . "<br>";
    }
}

?>