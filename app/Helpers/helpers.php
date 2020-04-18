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