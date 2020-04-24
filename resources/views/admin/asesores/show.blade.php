@extends('admin.layout.app')

@section('title', 'Asesores')

@section('link')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

  {{-- daterangepicker --}}
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">

@endsection




@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card shadow">

                    <div class="card-header">
                        <h3 class="card-title text-secondary mt-2">NOMBRE: {{$datos['name']}}</h3>
                       

                        <button type="button" class="btn btn-outline-info float-right" data-toggle="modal" data-target="#exampleModal">
                            Filtrar por fecha
                        </button>
                    </div>

                    <div class="card-body">

                        

                        <table id="asesores" class="table table-striped table-hover">
                            <thead>
                                <tr>

                                    <th width = "10px">C.A</th>
                                    {{-- <th>Boleta</th> --}}
                                    <th>Cliente</th>
                                    <th>Categoría</th>
                                    <th>Curso</th>
                                    <th>Fecha</th>
                                    <th>Horario</th>
                                    <th width = "10px">Duración</th>
                                    <th>&nbsp</th>
                                </tr>
                            </thead>

                            {{-- <tbody>
                                <tr>
                                    <td>C.A</td>
                                    <td>Boleta</td>
                                    <td>Cliente</td>
                                    <td>Categoría</td>
                                    <td>06/03/1993</td>
                                    <td>Horario</td>
                                    <td>Duración</td>
                                    <td>&nbsp</td>
                                </tr>

                                <tr>
                                    <td>C.A</td>
                                    <td>Boleta</td>
                                    <td>Cliente</td>
                                    <td>Categoría</td>
                                    <td>24/11/1989</td>
                                    <td>Horario</td>
                                    <td>Duración</td>
                                    <td>&nbsp</td>
                                </tr>

                                <tr>
                                    <td>C.A</td>
                                    <td>Boleta</td>
                                    <td>Cliente</td>
                                    <td>Categoría</td>
                                    <td>28/07/1991</td>
                                    <td>Horario</td>
                                    <td>Duración</td>
                                    <td>&nbsp</td>
                                </tr>

                                <tr>
                                    <td>C.A</td>
                                    <td>Boleta</td>
                                    <td>Cliente</td>
                                    <td>Categoría</td>
                                    <td>27/11/1955</td>
                                    <td>Horario</td>
                                    <td>Duración</td>
                                    <td>&nbsp</td>
                                </tr>
                            </tbody> --}}

                            <tbody>
                                @foreach ($asesorias as $asesoria)
                                    <tr>
                                        
                                        <td>
                                            {{$asesoria->boleta->admin_id}}
                                        </td>
                                        {{-- <td>
                                            {{$asesoria->boleta_id}}
                                        </td> --}}
                                        <td>
                                            {{$asesoria->boleta->cliente->name}}
                                        </td>


                                        <td>
                                            {{$asesoria->boleta->categoria->name}}
                                        </td>

                                        <td>
                                            {{$asesoria->curso->name}}
                                        </td>

                                        
                                        <td>
                                            {{$asesoria->fecha->format('d/m/Y')}}
                                        </td>
                                        <td>
                                            {{horario($asesoria->h_inicio, $asesoria->h_final)}}
                                        </td>
                                        <td>
                                            {{duracion($asesoria->duracion)}}
                                        </td>
                                        <td>
                                            <div class="d-flex flex-nowrap justify-content-end">
    
                                                <a href="{{route('admin.asesorias.edit', $asesoria)}}" class="btn btn-success btn-sm mr-1" role="button">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            
                                                @php
                                                    $ruta = route('admin.asesorias.destroy', $asesoria);
                                                @endphp
                                            
                                                <button class="btn btn-danger btn-sm" onclick="AlertaEliminar('{{$ruta}}')">
                                                    <i class="fas fa-eraser"></i>
                                                </button>
                                                
                                            </div>
                                        </td>
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
    <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Filtrar tabla</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body pb-4">
                    {!! Form::open(['route' => ['admin.asesores.show', $datos['id']], 'method' => 'get', "autocomplete" => "off"]) !!}


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

    <!-- DataTables responsive-->
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>


    {{-- Moment --}}
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/moment/datetime-moment.js')}}"></script>

    {{-- daterangepicker --}}
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>

    
    


    <script>

        $.fn.dataTable.moment( 'DD/MM/YYYY' );

        $('#asesores').dataTable({
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
                
                
                "emptyTable": "No se encontró ninguna asesoría",

                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
            },
            "order": [[ 4, "asc" ]]
        });

        function AlertaEliminar(direccion){

            Swal.fire({
                title: '¿Estas seguro de esta acción?',
                text: "¡Se borrará la asesoría seleccionada!",
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
                            Swal.fire(
                            '¡Eliminado!',
                            'La asesoría se eliminó con éxito',
                            'success'
                            )

                            location.reload();
                        }

                    });
                    
                }
            })
        }

        /* daterangepicker */
        $("#fechas").daterangepicker({
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

