@php
    $clases = ['Primer Curso', 'Segundo Curso', 'Tercer Curso', 'Cuarto Curso', 'Quinto Curso', 'Sexto Curso',
    'Septimo Curso', 'Octavo Curso', 'Noveno Curso', 'Decimo Curso'];

    $n = 0;
@endphp

<div class="table-responsive-md">
    <table class="table table-striped">
        <thead class="thead cabecera-tabla">
            <tr>
                @if ($boleta->estado == 'GENERADO')
                    <th width = "10px">&nbsp;</th>                    
                @endif
                
                <th width = "140px">&nbsp;</th>
                <th>Curso</th>
                <th>Nivel</th>
                <th>Día(s)</th>
                <th>Horario</th>
                                       

            </tr>
            </thead>

            <tbody>
                @foreach ($boleta->contratados as $contratado)
                    <tr>

                        @if ($boleta->estado == 'GENERADO')
                            <td>
                                <form method="POST" action="{{route('borrar.cursos', $contratado)}}" class="formularioborrar">

                                    @method('DELETE')
                                    @csrf
                            
                                    <button class="{{-- btn btn-danger btn-sm --}} eliminar">
                                        <i class="fas fa-times text-danger"></i>
                                    </button>
                                </form>
                            </td>                   
                        @endif
                        
                        <td>{{$clases[$n++]}}</td>
                        <td>{{$contratado->curso->name}}</td>
                        <td>{{$contratado->nivel->name}}</td>
                        <td>{{$contratado->dias}}</td>
                        <td>{{horario($contratado->h_inicio, $contratado->h_final)}}</td>
                        
                    </tr>
                @endforeach


                @if ($boleta->contratados->count() < 4)
                    @for ($i = 0; $i < 4 - $boleta->contratados->count(); $i++)

                        @if ($boleta->estado == 'GENERADO')
                            <tr>
                                <td colspan="6">&nbsp;</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="5">&nbsp;</td>
                            </tr>
                        @endif

                        
                    @endfor
                @endif

            </tbody>
    </table>

</div>