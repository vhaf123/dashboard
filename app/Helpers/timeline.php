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