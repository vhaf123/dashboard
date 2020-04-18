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

    /* Formato hora para guardarlo en la base de datos */
    function formatearHora ($string) {
        
        $delimiters = array(":", " ");

        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        
        if($launch[2] == "am"){
            if($launch[0] == "12"){
                $launch[0] = 0;
            }
        }

        if($launch[2] == "pm"){
            if($launch[0] != "12"){
                $launch[0] = $launch[0] + 12;
            }
        }

        return Carbon::createFromTime($launch[0], $launch[1], 0, 'GMT');

    }
