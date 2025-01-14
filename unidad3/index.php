<?php

require_once __DIR__ . '/vendor/autoload.php';

use FastRoute\RouteCollector;
use FastRoute\Dispatcher;
//composer require vlucas/phpdotenv
use Dotenv\Dotenv;


// Inicializa dotenv para cargar las variables de entorno
//Se busca un .env en el directorio raiz
$dotenv = Dotenv::createImmutable(__DIR__);
//Cargamos las variables en el entorno
$dotenv->load();

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {

//Con addroute voy añadiendo rutas url por get o por post a las que responderemos
//Las que no esten aquí darán fallo

//Listado de entrenadores
$r->addRoute('GET', '/', ['App\Controlador\EntrenadorController', 'mostrarEntrenadores']);
$r->addRoute('POST', '/', ['App\Controlador\EntrenadorController', 'mostrarEntrenadoresFiltrado']);
//Mostrar detalle de entrenador
$r->addRoute('GET', '/entrenadores/{id:\d+}', ['App\Controlador\EntrenadorController', 'mostrarEntrenador']);
$r->addRoute('GET','/entrenadores/crear',['App\Controlador\EntrenadorController', 'crearEntrenador']);
$r->addRoute('POST','/entrenadores/crear',['App\Controlador\EntrenadorController', 'insertarEntrenador']);
$r->addRoute('GET','/entrenadores/{id:\d+}/eliminar',['App\Controlador\EntrenadorController', 'eliminarEntrenador']);


    //Ejemplo de uso creando una funcion
 /*   $r->addRoute('GET', '/', function () {
       
        $con = Utils::getConnection(Utils::$dsn, Utils::$user, Utils::$password);
    
        $entrenadorM = new Entrenador($con);
        $entrenadores = $entrenadorM->cargarTodoPaginado(1,10);
        include __DIR__ . '/view/index.php';

    });
*/
});

//Dependiendo de la solicitud haremos una cosa u otra 
//recomemos la url y si ha sido get post o cual
// Obtener datos de la solicitud
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Eliminar parámetros de la consulta
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

// Despachar la ruta
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        // Ruta no encontrada
        http_response_code(404);
        echo "404 - Página no encontrada<br>Intentalo de nuevo";
        break;
    
    case Dispatcher::METHOD_NOT_ALLOWED:
        // Método HTTP no permitido
        $allowedMethods = $routeInfo[1];
        http_response_code(405);
        echo "405 - Método no permitido. Métodos permitidos: " . implode(', ', $allowedMethods);
        break;
    
    case Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        //Asignacion doble de variables que se reciben desde un array seria igual a las dos siguientes lineas
        //$class=$handler[0];
        //$method=$handler[1];
        [$class, $method] = $handler;
        //Equivalente a $controller = new App\Controlador\EntrenadorController();
        $controller = new $class();
        //Llamamos a la funcion encargada de despachar la ruta
        $controller->$method($vars);
        break;
}
