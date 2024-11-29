<?php 
//Importamos el código con la clase entrenador
require_once('./model/entrenador.php');

//Utilizamos la clase entrenador en este fichero
//use Entrenador;


echo "La base de datos que utilizamos es: ". Entrenador::$nombreBD. "<br>";

//CONEXION
require_once("config.php");

//Conexion a la BD
try {
    $con = new PDO($dsn, $user, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    //Si ha habido un fallo al conectarse a BD
    //Salta una excepcion, con getMEssage sacamos la descripcion del error
    echo 'Falló la conexión: ' . $e->getMessage();
}

//Creamos un objeto de tipo entrenador y le prestamos nuestra conexion
$entrenadoM = new Entrenador($con);

echo "Borramos un entrenador<br>";
$entrenadoM->borrar(9);

$datos = $entrenadoM->cargarTodoPaginado(2,5);

//$entrenadoM->insertar(['nif'=>'11111111a','nombre'=>'Jairo','edad'=>23,'altura'=>185]);

//$entrenadoM->modificarTodo(['idEntrenador'=>'21','nif'=>'11111111a','nombre'=>'Patricia','edad'=>20,'altura'=>195]);

//$datos = $entrenadoM->cargarTodoPaginado(2,10);

var_dump($datos);

?>