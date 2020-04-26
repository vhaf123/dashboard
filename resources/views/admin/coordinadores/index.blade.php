@extends('admin.layout.app')

@section('title', 'Coordinadores')

@section('link')
      <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow">

                     {{-- Cabecera --}}
                     <div class="card-header">
                        <h3 class="card-title text-secondary mt-2">COORDINADORES</h3>
                        <a href="{{route('admin.coordinadores.create')}}" class="btn btn-outline-info float-right">Crear Nuevo</a>
                    </div>

                    {{-- Cuerpo --}}
                    <div class="card-body">
                        <table id="coordinadores" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width = "10px">ID</th>
                                    <th>Coordinador</th>
                                    <th width = "10px">&nbsp;</th>
                                </tr>
                            </thead>
                            
                            {{-- <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>
                                            {{$admin->id}}
                                        </td>

                                        <td>
                                            {{$admin->name}}
                                        </td>
                                            
                                        <td>
                                            <div class="d-flex flex-nowrap justify-content-end">
    
                                                <a href="#" class="btn btn-primary btn-sm mr-2" role="button">
                                                    Editar
                                                </a>
                                            
                                                @php
                                                    $ruta = route('admin.coordinadores.destroy', $admin->id);
                                                @endphp

                                                <button class="btn btn-danger btn-sm" onclick="AlertaAnular('{{$ruta}}')">
                                                    Eliminar
                                                </button>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody> --}}

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

<!-- DataTables responsive-->
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script>

    $('#coordinadores').dataTable({
        "responsive": true,
        "autoWidth": false,
        "serverSide": true,
        "ajax": {
            "url" : "{{url('api/coordinadores')}}"
        },
        "columns": [
            { "data": 'id'},
            { "data": 'name'},
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
            
            
            "emptyTable": "No se encontró ninguna asesoría",

            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
        }
    });

    function AlertaAnular(direccion){

        Swal.fire({
            title: '¿Estas seguro de quieres eliminar a este coordinador?',
            text: "¡Se eliminará todos los datos asociados a este coordinador!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, eliminar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.value) {
                            
                $.ajax({
                    url: direccion,
                    data: {
                        "_method" : 'delete'
                    },
                    type: 'POST',
                    success: function(data){

                        $('#coordinadores').dataTable()._fnAjaxUpdate();
                        
                        Swal.fire(
                        '¡Eliminado!',
                        'El coordinador se eliminó con éxito',
                        'success'
                        )
                    }

                });
                
            }
        })
    }
 
</script>


@endsection