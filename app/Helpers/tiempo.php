<?php
    use Carbon\Carbon;

    function horario($h_inicio, $h_final){

        $h_inicio = carbon::parse($h_inicio);
        $h_final = carbon::parse($h_final);

        if($h_inicio->format('a') == $h_final->format('a')){
        
            if($h_inicio->format('i') == "00"){
                $inicio = $h_inicio->format('h');
            }else{
                $inicio = $h_inicio->format('h:i');

            }

            if($h_final->format('i') == "00"){
                $final = $h_final->format('h a');
            }else{
                $final = $h_final->format('h:i a');
            }

        }else{

            if($h_inicio->format('i') == "00"){
                $inicio = $h_inicio->format('h a');

            }else{
                $inicio = $h_inicio->format('h:i a');
            }


            if($h_final->format('i') == "00"){
                $final = $h_final->format('h a');
            }else{
                $final = $h_final->format('h:i a');
            }
        }

        if($inicio[0] == 0){
            $inicio = substr($inicio, 1);
        }

        if($final[0] == 0){
            $final = substr($final, 1);
        }

        return $inicio . " - " . $final;
    }

 
    function duracion($tiempo){

        $hor = intval($tiempo/60);
        $min = $tiempo%60;

        if($min == 0){
            return $hor . " horas";
        }else{
            return $hor . " h " . $min . " m";
        }

    }

    /* Calcula el primer y último día del paquete */
    function primerDia($dias, $inicio, $culminacion){

        $dias = explode(", ", $dias);
        $respuesta = carbon::parse($culminacion);

        foreach($dias as $dia){
            $dia = diasIngles($dia);
            $fecha = carbon::parse($inicio)->subDay()->modify("next $dia");

            if(strtotime($fecha) < strtotime($respuesta)){
                $respuesta = $fecha;
            }
        }

        return $respuesta;
        
    }

    function ultimoDia($dias, $inicio, $culminacion){
        
        $dias = explode(", ", $dias);
        $respuesta = carbon::parse($inicio);

        foreach ($dias as $dia) {
            $dia = diasIngles($dia);
            $fecha = carbon::parse($culminacion)->addDay()->modify("last $dia");

            if(strtotime($fecha) > strtotime($respuesta)){
                $respuesta = $fecha;
            }
        }

        return $respuesta;
    }    