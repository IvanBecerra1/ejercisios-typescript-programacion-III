<?php
require_once 'AlumnoFoto.php';
use AlumnoFoto\AlumnoFoto as Alumno;

session_start();

$legajo = $_SESSION['legajo'] ?? '';
$apellido = $_SESSION['apellido'] ?? '';
$nombre = $_SESSION['nombre'] ?? '';
$foto = $_SESSION['foto'] ?? '';


$listaArray = $_SESSION['listado'] ?? '';

var_dump($listaArray);
$cadena = "";

foreach($listaArray as $alumno){
    $cadena .= $alumno->toString() . " --- <br>";
}

$lista = $cadena;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>

    <!-- bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <table class="table table-light">
        <thead class="thead-dark">
            <tr>
                <th colspan="2">DATOS - ALUMNOS</th>
            </tr>
        </thead>
        <tbody>
            <form action="./principal.php" method="get" enctype="multipart/form-data">
                <tr>
                    <td>LEGAJO</td>
                    <td><input type="number" name="legajo" id="" value="<?= $legajo ?>" readonly></td>
                </tr>
                <tr>
                    <td>APELLIDO</td>
                    <td><input type="text" name="apellido" id="" value="<?= $apellido ?>" readonly></td>
                </tr>
                <tr>
                    <td>NOMBRE</td>
                    <td><input type="text" name="nombre" id="" value="<?= $nombre ?>" readonly></td>
                </tr>
                <tr>
                    <td>FOTO</td>
                    <td><input type="text" name="foto" id="" value="<?= $foto ?>" readonly></td>
                </tr>
            </form>
        </tbody>
    </table>
    <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>LISTAR - ALUMNOS </th>
                </tr>
            <tbody>
                <form action="./principal.php" method="GET" enctype="multipart/form-data">
                
                    <tr>
                        <td>
                            <fieldset >
                                <legend >Listado de alumnos</legend>
                                <div id="divListado">
                                    <?php echo $lista; ?>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
</body>
</html>