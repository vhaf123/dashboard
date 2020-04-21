@extends('admin.layout.app')

@section('title', 'Paquetas pendientes')

@section('link')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

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
    
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card card-outline card-info shadow">

                {{-- Cabecera --}}
                <div class="card-header">
                    <h3 class="card-title mt-2">Paquetes Pendientes</h3>    
                    <a href="{{route('admin.asesorias.nuevoPaquete')}}" class="btn btn-outline-info float-right">Agregar</a>
                </div>

                {{-- Cuerpo --}}
                <div class="card-body">
                    <table id="pendientes" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width = "10px">Boleta</th>
                                <th>Cliente</th>
                                <th>Curso</th>
                                <th>Nivel</th>
                                <th>Inicio</th>
                                <th>Culminación</th>
                                <th>Días</th>
                                <th>Horario</th>
                                <th></th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                {!! Form::open(['route' => 'admin.asignar.paquete', 'autocomplete'=> 'off', 'id' => 'formularioaenviar']) !!}

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">ASIGNAR PAQUETE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="contratado" name="contratado">
                        {!! Form::select('asesor_id', $asesores, null, ["class" => "select2"]) !!}
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Asignar</button>
                    </div>
                    
                {!! Form::close() !!}
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

    <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

    <script>

        /* Datatable */
        $('#pendientes').DataTable( {
            "responsive": true,
            "autoWidth": false,
            "serverSide": true,
            "ajax": "{{url('api/asesorias/pendientes')}}",
            "columns": [
                /* { "data": 'id'}, */
                { "data": 'boleta'},
                { "data": 'cliente'},
                { "data": 'curso'},
                { "data": 'nivel'},
                { "data": 'inicio'},
                { "data": 'culminacion'},
                { "data": 'dias'},
                { "data": 'horario'},
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
                
                
                "emptyTable": "Actualmente no existe ningún paquete pendiente.",

                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
            },
            "order": [ 0, 'desc' ]
        });

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


        function asignarAsesoria(id){
            $("#contratado").val(id);

            $('#exampleModalCenter').modal('show');
        }


        $('#formularioaenviar').submit(function (ev) {

            /* Cerrar el modal */
            $("#exampleModalCenter").modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

            /* Enviar por ajax */
            $.ajax({
                type: $('#formularioaenviar').attr('method'), 
                url: $('#formularioaenviar').attr('action'),
                data: $('#formularioaenviar').serialize(),
                
                success: function (datos){

                    $('#pendientes').dataTable()._fnAjaxUpdate();

                    Swal.fire(
                        '¡Asignado!',
                        'El paquete se asignó correctamente',
                        'success'
                        )
                } 
            });

            ev.preventDefault();
        });

        
        function AlertaAnular(direccion){

            Swal.fire({
                title: '¿Estas seguro de querer eliminar este paquete?',
                text: "¡Una vez eliminado no hay vuelta atrás!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!'
            }).then((result) => {
                if (result.value) {
                                
                    $.ajax({
                        url: direccion,
                        data: {
                            "_method" : 'delete'
                        },
                        type: 'POST',
                        success: function(data){
                           
                            $('#pendientes').dataTable()._fnAjaxUpdate();
                            
                            Swal.fire(
                            '¡Eliminado!',
                            'El paquete se elimino correctamente',
                            'success'
                            )
                        }

                    });
                    
                }
            })
        }

        

    </script>


@endsection