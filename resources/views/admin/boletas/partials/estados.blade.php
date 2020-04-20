@switch($estado)
    @case('GENERADO')

        <span class = 'badge badge-primary'>Generado</span>

        @break
    @case('DESCARGADO')
        
        <span class = 'badge badge-success'>Descargado</span>

        @break
    @case('ANULADO')

        <span class = 'badge badge-danger'>Anulado</span>

        @break
    @default
        
@endswitch