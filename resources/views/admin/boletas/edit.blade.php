@extends('admin.layout.app')

@section('title', 'Editarr Boleta')

@section('link')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    {{-- daterangepicker --}}
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    
                    <div class="card-body">
                        {!! Form::model($boleta, ['route' => ['admin.boletas.update', $boleta->id], 'method' => 'PUT']) !!}

                            <h6 class="text-secondary">
                                <a href="{{route('admin.clientes.create')}}" class="btn btn-sm btn-info float-right">
                                    <i class="fas fa-user-plus"></i>
                                    Nuevo Cliente
                                </a>
                                EDITAR BOLETA
                            </h6>
                            <hr>

                            @include('admin.boletas.partials.form')

                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-md btn-primary">
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


    </script>
@endsection