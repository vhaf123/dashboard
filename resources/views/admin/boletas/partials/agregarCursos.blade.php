@php
    $dias = [   
                "lun" => "Lunes", 
                "mar" => "Martes", 
                "mier" => "Miercoles", 
                "jue" => "Jueves", 
                "vier" => "Viernes", 
                "sab" => "Sábado", 
                "dom" => "Domingo"
    ];

    $option_dias =  [
                        "class" => "select2",
                        "multiple" => "multiple", 
                        "data-placeholder" =>"Ingrese uno o más días",
                        "id" => "dias"
                    ];
@endphp

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                
                <form action="{{route('agregar.cursos', $boleta)}}" method="POST" autocomplete = 'off' id = "formularioaenviar">
                    @csrf
                
                    <h5 class="text-dark">
                        <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        AGREGAR UN NUEVO CURSO
                    </h5>
                    
                    <hr>

                    <div class="form-row my-3">

                        {{-- Campo oculto --}}
                        <input type="text" name="boleta_id" class="d-none" value="{{$boleta->id}}">
                    
                        {{-- Curso --}}
                        <div class="form-group col-md-12">
                            {!! Form::label('curso_id', 'Curso') !!}
                            {!! Form::select('curso_id', $cursos, null, ['class' => "select2"]) !!}
                        </div>

                        {{-- Nivel --}}
                        <div class="form-group col-md-12">
                            {!! Form::label('nivel_id', 'Nivel') !!}
                            {!! Form::select('nivel_id', $niveles, null, ['class' => "form-control"]) !!}
                        </div>

                        {{-- Inicio --}}
                        <div class="form-group col-md-6">

                            <label for="h_inicio">Inicio</label>

                            <div class="input-group date" id="inicio" data-target-input="nearest">

                                {!! Form::text("h_inicio", "12:00 pm", ["class" => "form-control datetimepicker-input", "data-target" => "#inicio", "id" => "h_inicio"]) !!}

                                <div class="input-group-append" data-target="#inicio" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                </div>
                            </div>

                            
                            <small class="text-danger error" role="alert" id="mensajeInicio">
                                *La hora ingresada no es valida
                            </small>
                            
                            
                        </div>

                        {{-- Final --}}
                        <div class="form-group col-md-6">
                            <label for="h_final">Final</label>
            
                            <div class="input-group date" id="final" data-target-input="nearest">
                                {!! Form::text("h_final", "2:00 pm", ["class" => "form-control datetimepicker-input", "data-target" => "#final", "id" => "h_final"]) !!}
                                {{-- <input name="h_final" value ="2:00 pm" class="form-control datetimepicker-input" data-target="#final"/> --}}
                                <div class="input-group-append" data-target="#final" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                </div>
                            </div>

                            <small class="text-danger error" role="alert" id="mensajeFinal">
                                *La hora ingresada no es valida
                            </small>

                        </div>

                        {{-- Dias --}}
                        <div class="form-group col-md-12">
                            {!! Form::label('dias', 'Dias') !!}
                            {!! Form::select('dias[]', $dias, null, $option_dias) !!}
                            
                            <small class="text-danger error" role="alert" id="mensajeDias">
                                *No ha seleccionado ninguna opción
                            </small>
                        </div>

                    </div>

                    <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="agregar">Agregar</button>
                    </div>

                </form>
            </div>
            
        </div>
    </div>
</div>