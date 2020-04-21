@extends('admin.layout.app')

@section('title', 'Boletas')

@section('link')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection

@section('migaja')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Legacy User Menu</h1>
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
            <div class="col-md-9">

                <div class="card card-outline card-info shadow">

                    {{-- Cabecera --}}
                    <div class="card-header">
                        <h3 class="card-title mt-2">Boletas</h3>    
                        <a href="{{route('admin.boletas.create')}}" class="btn btn-outline-info float-right">Agregar</a>
                    </div>

                    {{-- Cuerpo --}}
                    <div class="card-body">
                        <table id="boletas" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width = "10px">Boleta</th>
                                    <th>Cliente</th>
                                    <th>Cordinadora</th>
                                    <th>Categoría</th>
                                    <th>Estado</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            
                        </table>
                    </div>
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

        $('#boletas').DataTable( {
            "responsive": true,
            "autoWidth": false,
            "serverSide": true,
            "ajax": "{{url('api/boletas')}}",
            "columns": [
                { "data": 'id'},
                { "data": 'cliente'},
                { "data": 'coordinadora'},
                { "data": 'categoria'},
                { "data": 'estado'},
                { "data": 'btn'}
            ],
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
            },
            "order": [ 0, 'desc' ]
        });
        
        function AlertaAnular(direccion){


            Swal.fire({
                title: '¿Estas seguro de querer anular esta boleta?',
                text: "¡Una vez anulada no hay vuelta atrás!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, anular!'
            }).then((result) => {
                if (result.value) {
                                
                    $.ajax({
                        url: direccion,
                        data: {
                            "_method" : 'delete'
                        },
                        type: 'POST',
                        success: function(data){
                           
                            $('#boletas').dataTable()._fnAjaxUpdate();
                            
                            Swal.fire(
                            '¡Anulado!',
                            'La boleta se anuló con éxito',
                            'success'
                            )
                        }

                    });
                    
                }
            })
        }

    </script>


@endsection