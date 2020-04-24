@extends('admin.layout.app')

@section('title', 'Nuevo Paquete')

@section('link')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    {{-- daterangepicker --}}
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">

    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

    <style>
        .error{
            display: none;
        }
    </style>

@endsection



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">

                    {{-- <div class="card-header">
                        <h1 class="card-title text-secondary">CREAR NUEVO PAQUETE</h1>
                    </div> --}}

                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.paquetes.store', 'autocomplete'=> 'off']) !!}
                            
                        <h6 class="text-secondary">
                            CREAR UN NUEVO PAQUETE
                        </h6>
                        <hr>

                            <div class="form-row">

                                {{-- Boleta --}}
                                <div class="form-group col-md-2">

                                    {!! Form::label('boleta_id', 'Boleta') !!}
                                   {{--  {!! Form::text('boleta_id', null, ['class' => 'form-control' . ( $errors->has('boleta_id') ? ' is-invalid' : '' ), 'autofocus']) !!} --}}
                                    {!! Form::select('boleta_id', $boletas, null, ['class' => 'form-control select2']) !!}

                                    @error('boleta_id')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                                {{-- Hora de inicio --}}
                                <div class="form-group col-md-5">

                                    {!! Form::label('h_inicio', 'Inicio') !!}

                                    <div class="input-group date" id="inicio" data-target-input="nearest">

                                        {!! Form::text("h_inicio", "12:00 pm", ["class" => "form-control datetimepicker-input" . ( $errors->has('h_inicio') ? ' is-invalid' : '' ), "data-target" => "#inicio"]) !!}

                                        <div class="input-group-append" data-target="#inicio" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>

                                    <small class="text-danger error" role="alert" id="mensajeInicio">
                                        *La hora ingresada no es valida
                                    </small>

                                </div>


                                {{-- Final --}}
                                <div class="form-group col-md-5">
                                    {!! Form::label('h_final', 'Final') !!}
                                    <div class="input-group date" id="final" data-target-input="nearest">
                                        {!! Form::text("h_final", "2:00 pm", ["class" => "form-control datetimepicker-input", "data-target" => "#final", "id" => "h_final"]) !!}
                                        <div class="input-group-append" data-target="#final" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>

                                    <small class="text-danger error" role="alert" id="mensajeFinal">
                                        *La hora ingresada no es valida
                                    </small>

                                </div>

                                {{-- Dias --}}
                                <div class="form-group col-7">
                                    {!! Form::label('dias', 'Dias') !!}
                                    {!! Form::select('dias[]', $dias, null, [
                                        "class" => "form-control select2 ". ( $errors->has('dias') ? ' is-invalid' : '' ),
                                        "multiple" => "multiple", 
                                        "data-placeholder" =>"Ingrese uno o más días",
                                        "id" => "dias"
                                    ]) !!}

                                    @error('dias')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>

                                {{-- Fechas --}}
                                <div class="form-group col-5">
                                    {!! Form::label("fecha", "Fecha", ["class"=>"text-secondary"]) !!}
                                    {!! Form::text("fecha", null, ["class" => "form-control" . ( $errors->has('fecha') ? ' is-invalid' : '' )]) !!} 
                                </div>

                               {{-- Asesor --}}
                                <div class="form-group col-7">
                                    {!! Form::label("asesor_id", "Asesor") !!}
                                    {{-- <select class="form-control" id="mySelect2"></select> --}}
                                    {!! Form::select("asesor_id", $asesores, null, ["class" => "form-control select2"]) !!}
                                </div>

                                {{-- Curso --}}
                                <div class="form-group col-5">
                                    {!! Form::label("curso_id", "Cursos") !!}
                                    {!! Form::select("curso_id", $cursos, null, ["class" => "form-control select2"]) !!}
                                </div>

                                
                            </div>

                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-primary px-3" id="agregar">
                                    Registrar
                                </button>
                            </div>

                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>                
    </div>
@endsection


@section('script')
    <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

    {{-- daterangepicker --}}
    <script src="{{asset('plugins/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>

    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/moment.min.js')}}"></script>
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <script>
        /* Select2 */
        $('.select2').select2({  
            theme: 'bootstrap4',
            language: {
                noResults: function() {
                    return "No hay resultado";        
                },
                searching: function() {
                    return "Buscando..";
                }
            }
        });

       
         /* daterangepicker */
         $("#fecha").daterangepicker({
            "locale": {
                "format": "DD/MM/YYYY",
                "applyLabel": "Aplicar",
                "cancelLabel": "Cancelar",
                "daysOfWeek": ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                "monthNames": ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", 
                "Agosto", "Setiembre", "Octumbre", "Noviembre", "Diciembre"],
            }
        });

        /* Tempusdominus Bootstrap 4 */

        $('#inicio').datetimepicker({
            format: 'hh:mm a'
        });

        $('#final').datetimepicker({
            format: 'hh:mm a'
        });

        /* Validar formulario */
        $('#agregar').click(validar_formulario);
        function validar_formulario(){
            
            var patron = /^(0[1-9]|1[0-2]):([0-5]\d)\ (am|pm)$/;
            i = 3;

            /* validar hora de inicio */
            if (patron.test($('#inicio > input').val())){
                $("#mensajeInicio").fadeOut();
                i = i-1;
            }else{
                $("#mensajeInicio").fadeIn()
            }

            /* Validar hora final */
            if (patron.test($('#final > input').val())){
                        $("#mensajeFinal").fadeOut();
                        i = i-1;
                    }else{
                        $("#mensajeFinal").fadeIn()
                    }
            
            /* Validar coherencia de horas */
            if (patron.test($('#inicio > input').val()) && patron.test($('#final > input').val())) {
                var inicio = moment($('#inicio > input').val(), "h:mma");
                var final = moment($('#final > input').val(), "h:mma");
                var diferencia = final.diff(inicio, 'minutes');

                if(diferencia == 0){
                    alert("La hora de inicio no puede ser igual a la hora de finalización");
                }

                if(diferencia < 0){
                    alert("La hora de inicio no puede ser superior a la hora de finalización");
                }

                if(diferencia > 0){
                    i--;
                }
            }

            if(i != 0){
                return false;
            }
        }


    </script>
@endsection