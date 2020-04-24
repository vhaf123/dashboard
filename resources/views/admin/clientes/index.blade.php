@extends('admin.layout.app')

@section('title', 'Clientes')

@section('link')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">

                <div class="card shadow">

                    <div class="card-header">
                        <h3 class="card-title text-secondary mt-2">LISTA TOTAL DE CLIENTES</h3>    
                        <a href="{{route('admin.clientes.create')}}" class="btn btn-outline-info float-right">Nuevo cliente</a>
                        
                    </div>

                    <div class="card-body">
                        <table id="clientes" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>
                                    <th width="10px">&nbsp;</th>
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

        $('#clientes').DataTable( {
            "responsive": true,
            "autoWidth": false,
            
            "serverSide": true,
            "ajax": "{{url('api/clientes')}}",
            "columns": [
                { "data": 'id'},
                { "data": 'name'},
                { "data": 'telefono'},
                { "data": 'direccion'},
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

      
        function AlertaEliminar(direccion){

            Swal.fire({
                title: '¿Estas seguro de querer eliminar este cliente?',
                text: "¡Se borrará también todos los datos relacionados a él!",
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

                            $('#clientes').dataTable()._fnAjaxUpdate();
                            
                            Swal.fire(
                            '¡Eliminado!',
                            'El cliente se eliminó con éxito',
                            'success'
                            )
                        }

                    });
                    
                }
            })
        }

      
     
    </script>


@endsection