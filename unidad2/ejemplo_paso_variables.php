<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
   
    /**
     * powertotalis
     * La funcion recibe un numero y una potencia y devuelve el número elevado a esa potencia
     * @param  mixed $numero
     * @param  mixed $potencia
     * @return void
     */
    function powertotalis($numero,$potencia)
    {
        $numero = $numero**$potencia;
        echo $numero."<br/>";;
    }

    //Para pasar por valor una variable a una funcion hay que poner delante el &
    //Esto hace que yo pueda modificar el valor de esa variable y se queda modificado
    //despues de la ejecucion de funcion
    function powertotalis_ref(&$numero,$potencia)
    {
        $numero = $numero**$potencia;
        echo $numero."<br/>";
    }

    $valor=3;
    powertotalis($valor,3);

    echo $valor."<br/>";

    powertotalis_ref($valor,3);

    echo $valor."<br/>";


    ?>
</body>
</html>