<?php

    /* Verificar estados */
    function estadoBoletas($estado){

        switch ($estado) {
            case 'GENERADO':
                return "<strong class = 'text-info'>Generado</strong>";
            break;
            
            case 'DESCARGADO':
                return "<strong class = 'text-success'>Descargado</strong>";
            break;

            case 'ANULADO':
                return "<strong class = 'text-danger'>Anulado</strong>";
            break;
        }

        
        
    }

    function btnBoleta($ver, $editar, $anular, $estado){

        return "
            <div class='d-flex flex-nowrap justify-content-end'>
                <a href='$ver' class='btn btn-info btn-sm ".estadoAnulado($estado)."'>
                    <i class='fas fa-eye'></i>
                </a>

                <a href='$editar' class='btn btn-success btn-sm mx-1 ".estadoAnulado($estado)."'>
                    <i class='fas fa-edit'></i>
                </a>

                <form method='POST' action='$anular' style='display: inline;'>" .

                    method_field('delete') .

                    csrf_field().

                    "<button class='btn btn-danger btn-sm' " . estadoAnulado($estado) . " = ''>
                        <i class='fas fa-eraser'></i>
                    </button>
                </form>

            </div>
        ";
    }

    function estadoAnulado($estado){
        if($estado == "ANULADO"){
            return "disabled";
        }
    }