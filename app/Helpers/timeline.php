<?php

    /* Verificar estados */
    function estadoBoletas($estado){

        switch ($estado) {
            case 'GENERADO':
                return "<span class = 'badge badge-primary'>Generado</span>";
            break;
            
            case 'DESCARGADO':
                return "<span class = 'badge badge-success'>Descargado</span>";
            break;

            case 'ANULADO':
                return "<span class = 'badge badge-danger'>Anulado</span>";
            break;
        }

        
        
    }
  