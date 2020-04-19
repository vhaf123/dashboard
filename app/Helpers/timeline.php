<?php

    /* Verificar estados */
    function estadoBoletas($estado){

        switch ($estado) {
            case 'GENERADO':
                return "<span class = 'text-info'>Generado</span>";
            break;
            
            case 'DESCARGADO':
                return "<span class = 'text-success'>Descargado</span>";
            break;

            case 'ANULADO':
                return "<span class = 'text-danger'>Anulado</span>";
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