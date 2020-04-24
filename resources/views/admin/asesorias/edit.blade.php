@extends('admin.layout.app')

@section('title', 'Nueva Asesoría')

@section('link')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">

    {{-- Jquery UI --}}
    <link rel="stylesheet" href="{{asset('plugins/jquery-ui/jquery-ui.min.css')}}">

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
                <div class="card card-light shadow">

                    <div class="card-header">
                        <h1 class="card-title text-secondary">EDITAR ASESORÍA</h1>
                    </div>

                    <div class="card-body">
                        
                        {!! Form::open(['route' => ['admin.asesorias.update', $asesoria], "method" => "PUT"]) !!}
                            
                            <div class="form-row">

                                {{-- Boleta --}}
                                <div class="form-group col-md-2">

                                    <label for="">Boleta</label>
                                    <input type="text" value="{{$asesoria->boleta_id}}" class="form-control" disabled>
                                   
                                </div>

                                {{-- Hora de inicio --}}
                                <div class="form-group col-md-5">

                                    <label for="h_inicio">Inicio</label>

                                    <div class="input-group date" id="inicio" data-target-input="nearest">
                                        
                                        <input type="text" name = "h_inicio" id="h_inicio" value="{{$asesoria->h_inicio->format('h:i a')}}" class="form-control datetimepicker-input" data-target = "#inicio">
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
                                    <label for="h_final">Final</label>
                                    <div class="input-group date" id="final" data-target-input="nearest">
                                        <input type="text" id="h_final" name = "h_final" value="{{$asesoria->h_final->format('h:i a')}}" class="form-control datetimepicker-input" data-target = "#final">
                                        <div class="input-group-append" data-target="#final" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>

                                    <small class="text-danger error" role="alert" id="mensajeFinal">
                                        *La hora ingresada no es valida
                                    </small>
                                </div>

                                {{-- Curso --}}
                                <div class="form-group col-md-7">
                                    <label for="">Asesor</label>
                                    <input type="text" value = "{{$asesoria->curso->name}}" class="form-control" disabled>
                                </div>

                                {{-- Fechas --}}
                                <div class="form-group col-md-5">
                                    <label for="fecha">Fecha</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                        </div>
                                        <input type="text" id="fecha" name="fecha" value="{{$asesoria->fecha->format('d/m/Y')}}" class="form-control datepicker">
                                       {{--  {!! Form::text("fecha", null, ["class" => "form-control datepicker" . ( $errors->has('fecha') ? ' is-invalid' : '' )]) !!}  --}}
                                    </div>

                                    @error('fecha')
                                        <small class="text-danger" role="alert">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>

                               {{-- Asesor --}}
                                <div class="form-group col-md-12">
                                    <label for="">Asesor</label>
                                    <input type="text" value="{{$asesoria->asesor->name}}" class="form-control" disabled>
                                    
                                </div>

                                

                                
                            </div>

                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-primary px-3" id="agregar">
                                    Actualizar
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

    <!-- Bootstrap4 Duallistbox -->
    <script src="{{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>

    {{-- Jquery UI --}}
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    {{-- <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script> --}}

    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/moment.min.js')}}"></script>
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <script>
        /* Select2 */
        $('.select2').select2({  
                
            language: {
                noResults: function() {
                    return "No hay resultado";        
                },
                searching: function() {
                    return "Buscando..";
                }
            }
        });

        /* $('.select2bs4').select2({
            theme: 'bootstrap4'
        }) */

       
         /* date picker */
         $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '< Ant',
            nextText: 'Sig >',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['es']);
            $(function () {
            $("#fecha").datepicker();
        });


        $( ".datepicker" ).datepicker();


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