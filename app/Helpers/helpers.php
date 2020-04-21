<?php
    /* Verifica si está abierto un submenú */
    function setOpen($routeName){
        if(request()->routeIs($routeName)){
            return 'menu-open';
        }else{
            return '';
        }
    }

    /* Verifica si se encuentra en la página activa */
    function setActive($routeName){
        if(request()->routeIs($routeName)){
            return 'active';
        }else{
            return '';
        }
    }

    /* Agrega ceros a las boletas */
    function numero_boleta($boleta){

        $i = 1;
        $num = $boleta;

        do {
            $num = $num/10;

            if($num >= 1){
                $i++;
            }

        } while ($num >= 1);

        $n_ceros = 7 - $i;
        $ceros = "";

        for ($i=0; $i < $n_ceros; $i++) { 
            $ceros = $ceros . "0";
        }

        return "#" . $ceros . $boleta;

    }

    /* Ordenar arreglo */
    function ordenar_arreglo($array){

        $n= count($array);

        for ($i=0; $i < $n-1 ; $i++) { 
            if($array[$i] > $array[$i+1]){
                $aux = $array[$i];
                $array[$i] = $array[$i + 1];
                $array[$i+1] = $aux;
            }
        }

        return $array;

    }