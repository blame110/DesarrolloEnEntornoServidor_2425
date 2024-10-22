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


?>