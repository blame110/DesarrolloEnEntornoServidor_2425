<?php
namespace utils;

use PDO;

class Utils
{

    static function obtenerTipoParametro($variable)
    {
        // Obtener el tipo de la variable
        $tipo = gettype($variable);

        // Mapear el tipo de PHP al tipo de PDO
        switch ($tipo) {
            case 'boolean':
                return PDO::PARAM_BOOL;
            case 'integer':
                return PDO::PARAM_INT;
            case 'double': // 'double' es el tipo que PHP usa para números flotantes
            case 'float':
                return PDO::PARAM_STR; // Se maneja como un string
            case 'string':
                return PDO::PARAM_STR;
            case 'array':
            case 'object':
                return PDO::PARAM_STR; // PDO no soporta array u object como tipos directos
            case 'NULL':
                return PDO::PARAM_NULL;
            default:
                return PDO::PARAM_STR; // Tipo por defecto en caso de tipo desconocido
        }
    }
}
