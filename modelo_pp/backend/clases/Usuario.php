<?php 

namespace User;

require_once "AccesoDatos.php";

use stdClass;
use PDO;
use Poo\AccesoDatos;

class Usuario {
    public int $id;
    public string $nombre;
    public string $correo;
    public string $clave;
    public int $id_perfil;
    public string $perfil;


    function __construct($nombre="", $correo="", $clave="", $id_perfil="", $perfil="")
    {

        $this->id=0;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->clave = $clave;
        $this->id_perfil = intval($id_perfil);
        $this->perfil = $perfil;

      //  $this->legajo = intval($legajo);
       // $this->foto = $foto;
    }


    function getId() : int {
        return $this->id;
    }
    function getNombre() : string {
        return $this->nombre;
    }

    function getClave() : string {
        return $this->clave;
    }

    function getIdPerfil() : int {
        return $this->id_perfil;
    }

    function getPerfil() : string {
        return $this->foto;
    }
    function setId($id) {
        $this->id = $id;
    }

    function setIdPerfil($idPerfil) {
        $this->id_perfil = $idPerfil;
    }
    function toJSON() : string {

        // testear dps
        //$datos = json_encode(slef::);

     //   return "{ ""nombre"": $this->nombre, ""correo"" : $this->correo, ""clave"" : $this->clave, ""id_perfil"" : $this->id_perfil, ""perfil"" : $this->perfil" . "}";
        
       return json_encode(get_object_vars($this));
    }

    /*
    function equals(AlumnoFoto $alumno) : bool {
        //if (empty($alumno))
       //     return false;

        if ($this->legajo == $alumno->getLegajo()){
            return true;
        }

        return false;
    }*/


    /*Funciones de crud */

    static string $directorio = "./archivos/usuarios.json";

    function guardarEnArchivo() : string {;
        $abrirArchivo = fopen(Usuario::$directorio, "a");
        
        $seGuardo = fwrite($abrirArchivo, $this->toJSON() . "\r\n");
        
        fclose($abrirArchivo);
    
        $objeto = new stdClass();

        $objeto->exito = $seGuardo == 1 ? true : false;
        $objeto->mensaje = "Se guardo el usuario";

        return json_encode($objeto);
    }

    static function traerTodoLosDatosJSON() : array {
        $listaAlumnos = Usuario::obtenerDatos();

      /*  $archivoAbierto = fopen($this->$directorio, "r");

		while(!feof($archivoAbierto))
		{
			$clase  = json_decode(fgets($archivoAbierto));		

            array_push($clase);
		}
		fclose($archivoAbierto);
*/
        return $listaAlumnos;
    }
    
    static function obtenerDatos() : ?array
     { 

        $archivoAbierto = fopen(Usuario::$directorio, "r");
        $listaUsuarios = array();

        while (!feof($archivoAbierto)){
            $linea = fgets($archivoAbierto);
            $linea = trim($linea);

           // $lineaFinal = explode("-", $linea);

         //   $lineaFinal[0] = trim($lineaFinal[0]);

           /* $nombre = (string) trim($lineaFinal[0]);
            $apellido = (string) trim($lineaFinal[1]);
            $legajo = (int) trim($lineaFinal[2]);
            $foto = (string) trim($lineaFinal[3]);*/

            $usuario  = json_decode(fgets($archivoAbierto));		
          //  $alumno = new AlumnoFoto($nombre,$apellido,$legajo,$foto);

          if ($linea != ""){
            $usuario = new Usuario($linea[0], $linea[1], $linea[2]);
            array_push($listaUsuarios, $usuario);
          }
        }

        fclose($archivoAbierto);
        return $listaUsuarios;
    }
  
    public static function traerTodos()
    {
        $objetoAcceso = AccesoDatos::accesoPDO();

        $consulta = $objetoAcceso->
        consultaPDO("SELECT * ". "FROM usuarios");        

        $consulta->execute();

        $consulta->setFetchMode(PDO::FETCH_INTO, new Alumno);                                                

        return $consulta; 
    }

    // MYSQL
    public function Agregar() : bool{
        $objetoAccesoDato = AccesoDatos::accesoPDO();
        
        // (id,nombre, correo, clave e id_perfil),
        $consulta =$objetoAccesoDato->consultaPDO
        ("INSERT INTO usuarios (id, nombre, correo, clave, id_perfil)"
        . "VALUES(:id, :nombre, :correo, :clave, :id_perfil)");
        
        $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':correo', $this->correo, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->bindValue(':id_perfil', $this->id_perfil, PDO::PARAM_INT);

        $exito = $consulta->execute() ;
        //echo "La consulta fue: $exito"; 
        
        return $exito ? true : false;
    }


   /* public static function traerUno(StdClass $claseSTD) {


        $accesoDatos = AccesoDatos::accesoPDO();

        $consulta = $accesoDatos -> consultaPDO("SELECT * FROM usuarios WHERE correo = :correo AND clave = :clave");

        $consulta->bindValue(":correo", $claseSTD->correo);
        $consulta->bindValue(":clave", $claseSTD->clave);
        
        $consulta->execute();

        $usuarioClase = new Usuario();

        $usuarioClase = $consulta->setFetchMode(PDO::FETCH_INTO, new Alumno);   
        return $usuarioClase;

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
    }*/
    
}

?>