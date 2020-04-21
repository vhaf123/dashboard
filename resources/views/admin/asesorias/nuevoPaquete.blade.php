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

@endsection

@section('breadcrumbs')
    <div class="row mb-2">
        <div class="col-sm-6">
           
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Admin</a></li>
            <li class="breadcrumb-item active">Legacy User Menu</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-outline card-info shadow">

                    <div class="card-header">
                        <h1 class="card-title text-secondary">CREAR NUEVO PAQUETE</h1>
                    </div>

                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.boletas.store', 'autocomplete'=> 'off']) !!}
                            
                            {{-- Boleta --}}
                            <div class="form-row">
                                <div class="form-group col-2">
                                    <label for="">Boleta</label>
                                    <input type="text" class="form-control">
                                </div>

                                {{-- Hora de inicio --}}
                                <div class="form-group col-md-5">

                                    <label for="h_inicio">Inicio</label>

                                    <div class="input-group date" id="inicio" data-target-input="nearest">

                                        {!! Form::text("h_inicio", "12:00 pm", ["class" => "form-control datetimepicker-input", "data-target" => "#inicio", "id" => "h_inicio"]) !!}

                                        <div class="input-group-append" data-target="#inicio" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>

                                </div>


                                {{-- Final --}}
                                <div class="form-group col-md-5">
                                    <label for="h_final">Final</label>
                                    <div class="input-group date" id="final" data-target-input="nearest">
                                        {!! Form::text("h_final", "2:00 pm", ["class" => "form-control datetimepicker-input", "data-target" => "#final", "id" => "h_final"]) !!}
                                        <div class="input-group-append" data-target="#final" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>

                                </div>

                                {{-- Dias --}}
                                <div class="form-group col-7">
                                    {!! Form::label('dias', 'Dias') !!}
                                    {!! Form::select('dias[]', $dias, null, [
                                        "class" => "form-control select2",
                                        "multiple" => "multiple", 
                                        "data-placeholder" =>"Ingrese uno o más días",
                                        "id" => "dias"
                                    ]) !!}
                                </div>

                                {{-- Fechas --}}
                                <div class="form-group col-5">
                                    {!! Form::label("fecha", "Fecha", ["class"=>"text-secondary"]) !!}
                                    {!! Form::text("fecha", null, ["class" => "form-control" . ( $errors->has('fecha') ? ' is-invalid' : '' )]) !!} 
                                </div>

                               {{-- Asesor --}}
                                <div class="form-group col-7">
                                    {!! Form::label("asesor_id", "Asesor") !!}
                                    {!! Form::select("asesor_id", $asesores, null, ["class" => "form-control select2"]) !!}
                                </div>

                                {{-- Curso --}}
                                <div class="form-group col-5">
                                    {!! Form::label("curso_id", "Cursos") !!}
                                    {!! Form::select("curso_id", $cursos, null, ["class" => "form-control select2"]) !!}
                                </div>

                                
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

    </script>
@endsection