@extends('admin.layout.app')

@section('title', 'Asesores')

@section('link')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card card-outline card-info shadow">

                    <div class="card-header">
                        <h3 class="card-title mt-2">Lista de Asesores</h3>    
                        <a href="{{route('admin.asesores.create')}}" class="btn btn-outline-info float-right">Agregar</a>
                    </div>

                    <div class="card-body">
                        <table id="asesores" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width = "10px">ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>&nbsp</th>
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

        $('#asesores').DataTable( {
            "responsive": true,
            "autoWidth": false,
            
            "serverSide": true,
            "ajax": "{{url('api/asesores')}}",
            "columns": [
                { "data": 'id'},
                { "data": 'name'},
                { "data": 'email'},
                { "data": 'btn'}
            ],
            "language": {
                'info' : "Del _START_ al _END_ (total _TOTAL_)",
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

     
        function AlertaEliminar(direccion){

            Swal.fire({
                title: '¿Estas seguro de esta acción?',
                text: "¡Se borrará todos los datos relacionados al asesor!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
                
                if (result.value) {
                                
                    $.ajax({
                        url: direccion,
                        data: {
                            "_method" : 'delete'
                        },
                        type: 'POST',
                        success: function(data){

                            $('#asesores').dataTable()._fnAjaxUpdate();
                            
                            Swal.fire(
                            '¡Eliminado!',
                            'El asesor se eliminó con éxito',
                            'success'
                            )
                        }

                    });
                    
                }
            })
        }
    
    </script>
@endsection