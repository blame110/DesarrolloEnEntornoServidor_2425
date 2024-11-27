<?php
/*
funcion insertar($con, $entrenador)
funcion borrar($con, $idEntrenador)
funcion modificarTodo($con, $entrenador)
funcion modificar($con, $entrenador)
funcion cargarTodos($con)
funcion cargarTodosPaginado($con,$num_pag,$elem_pag)
funcion cargarTodosFiltrado($con, $filtro, $orden)
funcion cargarTodosFiltradoPaginado($con, $filtro,$orden,$num_pag,$elem_pag)
*/
class Entrenador
{
    //Conexion que usaremos para todas las acciones
    private $con;

    //Todos los entrenadores usan la misma bd
    public static $nombreBD = "puertoBaloncesto";

    function __construct($con)
    {
        //asignamos la conexion activa
        if ($con != null) $this->con = $con;
    }
    
    /**
     * borrar
     *
     * @param  mixed $idEntrenador
     * @return el resultado de la operacion 0 si hay fallo 1 si ha ido bien (true o false)
     */
    static function borrar($idEntrenador)
    {

        try {

            //Vamos a hacer un ejemplo en el cual borramos el entrenador numero 4
            $sql = "delete from entrenador where idEntrenador = ?";

            //Utilizamos la conexion activa de nuestro objeto
            //Para crear la sentencia sql
            $stmt = $this->con->prepare($sql);

            //Ejecutamos la sentencia substituyendo las interrogacions por los valores
            //Que metemos dentro del array que le pasamos a execute
            $resultado = $stmt->execute([$idEntrenador]);

            //Devolvemos el resultado de la ejecucion de la sentencia
            return $resultado;

        } catch (PDOException $e) {
            //Hubo un problema al eliminar el registro
            echo 'Hubo un problema al eliminar el registro: ' . $e->getMessage();
            return false;
        }
    }
}
