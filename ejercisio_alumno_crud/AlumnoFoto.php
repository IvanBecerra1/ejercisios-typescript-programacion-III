<?php 

namespace AlumnoFoto;

require_once "AccesoDatos.php";

use AlumnoFoto\AlumnoFoto as AlumnoFotoAlumnoFoto;
use PDO;
use Poo\AccesoDatos;

class AlumnoFoto {
    public int $id;
    public int $legajo;
    public string $apellido;
    public string $nombre;
    public string $foto;

    function __construct($nombre="", $apellido="", $legajo="", $foto="")
    {

        $this->id=0;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->legajo = intval($legajo);
        $this->foto = $foto;
    }


    function getId() : int {
        return $this->id;
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

    function getfoto() : string {
        return $this->foto;
    }
    function setId($id) {
        $this->id = $id;
    }

    function setfoto($foto) {
        $this->foto = $foto;
    }
    function toString() : string {
        return "$this->nombre-$this->apellido-$this->legajo-$this->foto" . "\r\n";
    }

    function equals(AlumnoFoto $alumno) : bool {
        //if (empty($alumno))
       //     return false;

        if ($this->legajo == $alumno->getLegajo()){
            return true;
        }

        return false;
    }


    /*Funciones de crud */

    static string $directorio = "./archivos/alumno_foto.txt";

    static function guardar(AlumnoFoto $alumno) : bool {

        var_dump($alumno);
        $abrirArchivo = fopen(AlumnoFoto::$directorio, "a");
        $seGuardo = fwrite($abrirArchivo, $alumno->toString());
        fclose($abrirArchivo);
        AlumnoFoto::subirFoto($alumno);

        return $seGuardo;
    }

    static function listar() : array {
        $listaAlumnos = AlumnoFoto::obtenerDatos();
        return $listaAlumnos;
    }

    static function editar(AlumnoFoto $alumno) : bool
    { 
        $listaAlumnos = AlumnoFoto::obtenerDatos();
        $indice = AlumnoFoto::buscarIndice($alumno,  $listaAlumnos);

        if ($indice == -1 ) {
            return false;
        }

       /* foreach($listaAlumnos as $alumnoIterar){

            if ($alumnoIterar->getLegajo() == $alumno->getLegajo()){

                $alumno->setFoto($alumno->getfoto());
                break;
            }
        }*/
        array_splice($listaAlumnos, $indice, 1);
        array_push($listaAlumnos, $alumno);
        AlumnoFoto::subirFoto($alumno);
        AlumnoFoto::reescribirDatos($listaAlumnos);

        return true;
    }
    static function eliminar(AlumnoFoto $alumno) : bool {
        $listaAlumnos = AlumnoFoto::obtenerDatos();
        $indice = AlumnoFoto::buscarIndice($alumno,  $listaAlumnos);


        if ($indice == -1 ) {
            return false;
        }
        array_splice($listaAlumnos, $indice, 1);

        AlumnoFoto::reescribirDatos($listaAlumnos);
        return true;
    }
    static function buscarIndice(AlumnoFoto $alumno, array $listaAlumnos) : int
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
        $archivoAbierto = fopen(AlumnoFoto::$directorio, "r");
        $listaAlumnos = array();

        while (!feof($archivoAbierto)){
            $linea = fgets($archivoAbierto);
            $lineaFinal = explode("-", $linea);

            $lineaFinal[0] = trim($lineaFinal[0]);

            if($lineaFinal[0] == "") continue;

            $nombre = (string) trim($lineaFinal[0]);
            $apellido = (string) trim($lineaFinal[1]);
            $legajo = (int) trim($lineaFinal[2]);
            $foto = (string) trim($lineaFinal[3]);


            $alumno = new AlumnoFoto($nombre,$apellido,$legajo,$foto);
            array_push($listaAlumnos, $alumno);
        }

        fclose($archivoAbierto);
        return $listaAlumnos;
    }
    static function reescribirDatos(Array $listaAlumnos) : bool {
        $archivoAbierto = fopen(AlumnoFoto::$directorio, "w");

        foreach($listaAlumnos as $alumnos) {
            fwrite($archivoAbierto, $alumnos->toString());
        }

        return fclose($archivoAbierto);
    }

    static function buscarPorLegajo(int $legajo) : AlumnoFoto | null
    {
        $listaAlumnos = AlumnoFoto::obtenerDatos();
        var_dump($listaAlumnos);
        $alumnoEncontrado = new AlumnoFoto("No encontrado", "", -999, "");

        $encontrado = false;
        foreach($listaAlumnos as $alumno) {

            if ($alumno->getLegajo() == $legajo) {
                $alumnoEncontrado = $alumno; 
                $encontrado = true;
                break;
            }
        };

        return ($encontrado == false ) ? null : $alumnoEncontrado; 
    }

    /**
     * Funcion de foto
     * 
     */

     
    static function subirFoto(AlumnoFoto $alumno) : bool {
        // Ruta de destino del archivo
        $destino = "./fotos/" . $alumno->getLegajo().".jpg";

        // Verificar si el archivo ya existe
        if (file_exists($destino)){
            echo "La foto ya existe, se procede a actualizarlo";

            if (unlink($destino)) {
                echo 'Archivo actualizado correctamente';
            } else {
                echo 'Error al actualizar archivo';
            }
        }
    
        /*// Verificar si el tamaño del archivo es válido
        define('MAX_FOTO', 500000000); // constante
        if ($_FILES["foto"]["size"] > MAX_FOTO){
            echo "La foto es muy grande. ";
            return false;
        }*/
    
        // Verificar si el archivo es una imagen
        $esImagen = getimagesize($_FILES["foto"]["tmp_name"]);
        if (!$esImagen) {
            echo "Solo se permite subir imágenes";
            return false;
        }
    
        // Verificar si la extensión es válida
        /*$extensionesPermitidas = array("jpg", "jpeg", "gif", "png");
        $tipoArchivo = pathinfo($destino, PATHINFO_EXTENSION);
        if (!in_array($tipoArchivo, $extensionesPermitidas)) {
            echo "Solo se permiten imágenes con extensión JPG, JPEG, PNG o GIF.";
            return false;
        }*/
    
        // Mover el archivo al destino
        $archivoSubido = move_uploaded_file($_FILES["foto"]["tmp_name"], $destino);
        if (!$archivoSubido) {
            echo "Ocurrió un error en la subida de archivo.";
            return false;
        }
    
        // Verificar si el archivo se movió correctamente
        if (!file_exists($destino)) {
            echo "Ocurrió un error en la subida de archivo.";
            return false;
        }
    
        echo "El archivo se subió con éxito: " . basename($_FILES["foto"]["name"]);
        return true;
    }



    public static function listarPDO()
    {
        $objetoAcceso = AccesoDatos::accesoPDO();

        $consulta = $objetoAcceso->consultaPDO("SELECT id, legajo, apellido, nombre, foto "
        . "FROM alumnos");        

        $consulta->execute();

        $consulta->setFetchMode(PDO::FETCH_INTO, new AlumnoFoto);                                                

        return $consulta; 
    }

    public function guardarPDO(){
        $objetoAccesoDato = AccesoDatos::accesoPDO();
        
        $consulta =$objetoAccesoDato->consultaPDO("INSERT INTO alumnos (id, legajo, apellido, nombre, foto)"
                                                    . "VALUES(:id, :legajo, :apellido, :nombre, :foto)");
        
        $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
        $consulta->bindValue(':legajo', $this->legajo, PDO::PARAM_INT);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);

        $exito = $consulta->execute() ;
        echo "La consulta fue: $exito";   
    }


    public static function modificarPDO(AlumnoFoto $alumno)
    {
        $objetoAccesoDato = AccesoDatos::accesoPDO();
        
        $consulta =$objetoAccesoDato->consultaPDO("UPDATE alumnos SET nombre = :nombre, apellido = :apellido, 
                                                        foto = :foto WHERE legajo = :legajo");
        
        $consulta->bindValue(':legajo', $alumno->getLegajo(), PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $alumno->getNombre(), PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $alumno->getApellido(), PDO::PARAM_STR);
        $consulta->bindValue(':foto', $alumno->getfoto(), PDO::PARAM_STR);

        return $consulta->execute();
    }

    public static function eliminarPDO(AlumnoFoto $alumno)
    {
        $objetoAccesoDato = AccesoDatos::accesoPDO();
        
        $consulta =$objetoAccesoDato->consultaPDO("DELETE FROM alumnos WHERE legajo = :legajo");
        
        $consulta->bindValue(':legajo', $alumno->getLegajo(), PDO::PARAM_INT);

        return $consulta->execute();
    }
    
}

?>