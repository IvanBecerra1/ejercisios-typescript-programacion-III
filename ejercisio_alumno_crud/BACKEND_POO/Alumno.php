<?php 

namespace Alumno;

class Alumno {
    private string $nombre;
    private string $apellido;
    private int $legajo;

    function __construct($nombre, $apellido, $legajo)
    {

        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->legajo = $legajo;
    }


    function getNombre() : string {
        return $this->nombre;
    }

    function getApellido() : string {
        return $this->apellido;
    }

    function getLegajo() : int {
        return $this->legajo;
    }

    function toString() : string {
        return "$this->nombre-$this->apellido-$this->legajo" . "\r\n";
    }

    function equals(Alumno $alumno) : bool {
        //if (empty($alumno))
       //     return false;

        if ($this->legajo == $alumno->getLegajo()){
            return true;
        }

        return false;
    }


    /*Funciones de crud */

    static string $directorio = "./archivos/alumno.txt";

    static function guardar(Alumno $alumno) : bool {

        var_dump($alumno);
        $abrirArchivo = fopen(Alumno::$directorio, "a");
        $seGuardo = fwrite($abrirArchivo, $alumno->toString());
        fclose($abrirArchivo);

        return $seGuardo;
    }

    static function listar() : array {
        $listaAlumnos = Alumno::obtenerDatos();
        return $listaAlumnos;
    }

    static function editar(Alumno $alumno) : bool
    { 
        $listaAlumnos = Alumno::obtenerDatos();
        $indice = Alumno::buscarIndice($alumno,  $listaAlumnos);

        if ($indice == -1 ) {
            return false;
        }

        array_splice($listaAlumnos, $indice, 1);
        array_push($listaAlumnos, $alumno);

        Alumno::reescribirDatos($listaAlumnos);

        return true;
    }
    static function eliminar(Alumno $alumno) : bool {
        $listaAlumnos = Alumno::obtenerDatos();
        $indice = Alumno::buscarIndice($alumno,  $listaAlumnos);


        if ($indice == -1 ) {
            return false;
        }
        array_splice($listaAlumnos, $indice, 1);

        Alumno::reescribirDatos($listaAlumnos);
        return true;
    }
    static function buscarIndice(Alumno $alumno, array $listaAlumnos) : int
    {
        $indice = -1;
    
        if (empty($listaAlumnos)){
            return $indice;
        }
    
        var_dump($listaAlumnos);


        var_dump($alumno);

        $legajaBuscar= $alumno->getLegajo();

        for ($i = 0; $i < count($listaAlumnos); $i++) {

            echo $listaAlumnos[$i]->getLegajo() . " - Buscar : $legajaBuscar";
            
            if($listaAlumnos[$i]->getLegajo() == $legajaBuscar) {
                echo "se entro al bucle";
                $indice = $i;
                break;
            }

        }

        /*foreach($listaAlumnos as $i => $iteradorAlumno) {
            echo "iterando ...";
            if($iteradorAlumno->getLegajo() == $alumno->getLegajo()) {
                echo "se entro al bucle";
                $indice = $i;
                break;
            }
        }*/
    
        return $indice;
    }
    static function obtenerDatos() : Array { 
        $archivoAbierto = fopen(Alumno::$directorio, "r");
        $listaAlumnos = array();

        while (!feof($archivoAbierto)){
            $linea = fgets($archivoAbierto);
            $lineaFinal = explode("-", $linea);

            $lineaFinal[0] = trim($lineaFinal[0]);

            if($lineaFinal[0] == "") continue;

            $nombre = (string) trim($lineaFinal[0]);
            $apellido = (string) trim($lineaFinal[1]);
            $legajo = (int) trim($lineaFinal[2]);

            $alumno = new Alumno($nombre,$apellido,$legajo);
            array_push($listaAlumnos, $alumno);
        }

        fclose($archivoAbierto);
        return $listaAlumnos;
    }
    static function reescribirDatos(Array $listaAlumnos) : bool {
        $archivoAbierto = fopen(Alumno::$directorio, "w");

        foreach($listaAlumnos as $alumnos) {
            fwrite($archivoAbierto, $alumnos->toString());
        }

        return fclose($archivoAbierto);
    }

    static function buscarPorLegajo(int $legajo) : Alumno
    {
        $listaAlumnos = Alumno::obtenerDatos();
        var_dump($listaAlumnos);
        $alumnoEncontrado = new Alumno("No encontrado", "", 0);

        foreach($listaAlumnos as $alumno) {

            if ($alumno->getLegajo() == $legajo) {
                $alumnoEncontrado = $alumno; 
            }
        };
        return $alumnoEncontrado; 
    }
}

?>