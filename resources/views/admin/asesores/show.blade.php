@extends('admin.layout.app')

@section('title', 'Asesores')

@section('link')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

@endsection

@section('titulo')
    
@endsection

@section('migaja')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Starter Page</li>
    </ol>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">


                {{-- <div class="card shadow">
                    <div class="card-body">
                        
                    </div>
                </div> --}}

                <div class="card shadow">

                    <div class="card-header">
                        <h3 class="card-title text-secondary mt-2">NOMBRE: {{$name}}</h3>
                        {{-- <button class="btn btn-outline-info float-right" type="button">Filtrar por fecha</button> --}}
                        <button type="button" class="btn btn-outline-info float-right" data-toggle="modal" data-target="#exampleModalCentered">
                            Filtrar por fecha
                        </button>
                        {{-- <a href="{{route('admin.asesores.create')}}" class="btn btn-outline-info float-right">Agregar</a> --}}
                    </div>

                    <div class="card-body">
                        <table id="asesores" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width = "10px">&nbsp;</th>
                                    <th width = "10px">C.A</th>
                                    <th>Boleta</th>
                                    <th>Cliente</th>
                                    <th>Categoría</th>
                                    <th>Fecha</th>
                                    <th>Horario</th>
                                    
                                    <th width = "10px">Duración</th>
                                    
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($asesorias as $asesoria)
                                    <tr>
                                        <td>
                                            <a href="#" class="btn bg-danger btn-sm">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </td>
                                        <td class="pl-4">{{$asesoria->boleta->admin_id}}</td>
                                        <td class="pl-4">{{$asesoria->boleta_id}}</td>
                                        <td>{{$asesoria->boleta->cliente->name}}</td>
                                        <td class="pl-4">{{$asesoria->boleta->categoria->name}}</td>
                                        <td>{{$asesoria->fecha->format('d/m/y')}}</td>
                                        <td>{{horario($asesoria->h_inicio, $asesoria->h_final)}}</td>
                                        
                                        <td class="pl-4">{{duracion($asesoria->duracion)}}</td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="exampleModalCentered" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenteredLabel">Filtrar tabla</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-4">
                    {!! Form::open(['route' => ['admin.asesores.show', $id], 'method' => 'get']) !!}

                        {!! Form::label("fechas", 'Filtrar la tabla por rango de fechas', ) !!}
                        
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            {!! Form::text("fechas", null, ['class' => 'form-control']) !!}
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit">Filtrar</button>
                            </div>
                        </div>
                    
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <!-- DataTables -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>


    <script>

        

        $('#asesores').DataTable( {
            "responsive": true,
            "autoWidth": false,

            "language": {
                'info' : "Mostrando del _START_ al _END_ (total de registros _TOTAL_)",
                "infoFiltered":   "",
                "search" : "Buscar:",
                "paginate" : {
                    "next" : "Siguiente",
                    "previous" : "Anterior"
                },
                "lengthMenu": "mostrar <select class='custom-select custom-select-sm form-control form-control-sm'>" + 
                                '<option value = "10">10</option>' +
                                '<option value = "25">25</option>' +
                                '<option value = "50">50</option>' +
                                '<option value = "100">100</option>' +
                                '<option value = "-1">Todos</option>' +
                                '</select> registros',
                "infoEmpty": "Ningún registro coincide con los datos brindados",
                "zeroRecords": "No se encontraron registros coincidentes",
                
                
                "emptyTable": "Actualmente no tiene ningún cliente registrado",

                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
            } 
        } );
    
     
    </script>
@endsection