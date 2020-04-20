@extends('admin.layout.app')

@section('title', 'Boleta')

@section('link')

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

    <style>
        
        /* logotipo*/
        .titulo{
            margin-bottom: 0;
            line-height: 24px;
        }

        .subtitulo{
            margin-bottom: 0;
            line-height: 16px;
        }

        /* numero de boleta */
        .boleta{
            color: #FF7D73;
        }

        /*información de contacto*/
        .info strong{
            font-weight: 600;
        }

        /* Tabla de cursos */
        .cabecera-tabla{
            background-color: #61C5D3;
            color: white;
        }

        /* Reporte */

        .reporte{
            background-color: rgba(97,197,211, 0.2);
        }

        .reporte p{
            font-weight: 600;
            color: #17A2B8;
            /* color: #39B2C3; */
        }

        .reporte p span{
            font-weight: normal;
            color: #5E5E5E;
            float: right;
        }
     
        .select2{
            width: 100%!important;
        }

        .error{
            display: none;
        }

        form button {
            background: none;
            border: 0;
            color: inherit;
            /* cursor: default; */
            font: inherit;
            line-height: normal;
            overflow: visible;
            padding: 0;
            -webkit-user-select: none; /* for button */
            -webkit-appearance: button; /* for input */
                -moz-user-select: none;
                -ms-user-select: none;
        }

        form button:hover i{
            color: #C52232!important;
        }

    </style>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                
                <div class="card card-outline card-info">

                    {{-- Cinta, si está anulado --}}
                    @if ($boleta->estado == "ANULADO")
                        <div class="ribbon-wrapper ribbon-xl">
                            <div class="ribbon bg-danger text-lg">
                            Anulado
                            </div>
                        </div>
                    @endif

                    {{-- cabecera --}}
                    <div class="card-header bg-light">
                        
                        {{-- Logotipo y numero de boleta --}}
                        <div class="row mb-2 ">

                            {{-- Logotipo --}}
                            <div class="col">
                                <div class="row">
                                    <div class="col-auto">
                                        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                                        style="opacity: .8" height="60px">
                                    </div>

                                    <div class="col align-self-center">
                                        <h4 class = "titulo text-info" style=""><b>AdminLTE</b>, Inc. </h4>
                                        <p class="subtitulo">
                                            <small class="text-secondary">Lorem ipsum dolor sit, consectetur.</small>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Numero de boleta --}}
                            <div class="col-sm-12 col-md-auto boleta mt-3 ml-2">
                                <b class="">Boleta: {{numero_boleta($boleta->id)}}</b>
                            </div>
                        </div>

                        {{-- Remitente, destinatario y paquete --}}
                        <div class="row px-2 pt-2 info">

                            {{-- Remitente --}}
                            <div class="col-sm-4">
                                De
                                <address class="">
                                    <strong>Admin, Inc.</strong><br>
                                    RUC: 10082734082 <br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    Teléfono: 423-5432<br>
                                </address>
                            </div>

                            {{-- Destinatario --}}
                            <div class="col-sm-4">
                                Para
                                <address class="">
                                    <strong>{{$boleta->cliente->name}}</strong><br>
                                    Distrito: {{$boleta->cliente->distrito}}<br>
                                    Institución: {{$boleta->institucion->name}}<br>
                                    N° Alumnos: {{$boleta->numero_alumnos}}<br>
                                    Alumno(s): {{$boleta->alumno}} <br>
                                </address>
                            </div>

                            {{-- Informe de paquete --}}
                            <div class="col-sm-4">
                                <strong>Paquete: </strong>{{$boleta->paquete->name}}<br><br>
                                <strong>N° Horas:</strong> {{$boleta->horas}}<br>
                                <strong>N° Sesiones:</strong> {{$boleta->sesiones}}<br>
                                <strong>Inicio: </strong>{{$boleta->inicio->format('d/m/Y')}}<br>
                                <strong>Culminación:</strong> {{$boleta->culminacion->format('d/m/Y')}}
                            </div>
                        </div>
                    </div>

                    {{-- Conenido principal --}}
                    <div class="card-body">

                        {{-- Tabla y reporte --}}
                        <div class="row">

                            {{-- Listado de cursos --}}                           
                            <div class="col-12 col-md-7" id="boleta_cursos"> 
                                @include('admin.boletas.partials.mostrarCursos')
                            </div>

                            {{-- Reporte de venta --}}
                            <div class="col-12 col-md-5 col-lg-4 offset-lg-1 align-self-center">
                                <div class="reporte card">
                                    <div class="card-body px-5">
                                        <p class="mb-2">Código de cliente: <span>00{{$boleta->cliente_id}}</span></p>
                                        <p class="mb-2">Categoría: <span>{{$boleta->categoria->name}}</span></p>
                                        <p class="mb-2">Costo: <span>S/ {{$boleta->costo}}</span></p>
                                        <p class="mb-2">A cuenta: <span>S/ {{$boleta->anticipo}}</span></p>
                                        <p class="mb-2">Saldo: <span>S/ {{$boleta->saldo}}</span></p>
                                        <p class="mb-1">Coordinador(a): <span>{{$boleta->admin->name}}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Botones de acción--}}
                        <div class="d-sm-flex justify-content-end">

                            {{-- Agregar nuevo curso --}}
                            
                            <button type="button" class="btn btn-info btn-curso" data-toggle="modal" 
                                data-target="#exampleModal"  @if ($boleta->estado != "GENERADO") disabled="" @endif>

                                <i class="fas fa-chalkboard mr-1"></i>
                                Agregar curso

                            </button>
                            
                            {{-- Descargar pdf --}}
                            <a href="{{route('generar.pdf', $boleta)}}" class="btn btn-success ml-2" target="_blank" id="generarPdf">
                                <i class="fas fa-download mr-1"></i>
                                Descargar PDF
                            </a>

                        
                        </div>

                    </div>
                </div>

                
            </div>
        </div>
    </div>

    <!-- Ventanda modal: Agregar cursos -->
    @include('admin.boletas.partials.agregarCursos')

@endsection


@section('script')

    <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    
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
                var i = 4;
                var patron = /^(0[1-9]|1[0-2]):([0-5]\d)\ (am|pm)$/;
                
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
                
                
                /* Validar Dias */
                
                    if($('#dias').val().length<1){
                        $("#mensajeDias").fadeIn()
                    }else{
                        $("#mensajeDias").fadeOut();
                        i = i - 1;
                    }


                    if(i != 0){
                        return false;
                    }
            
            }


        /* Enviar por ajax */
            $('#formularioaenviar').submit(function (ev) {
                $.ajax({
                    type: $('#formularioaenviar').attr('method'), 
                    url: $('#formularioaenviar').attr('action'),
                    data: $('#formularioaenviar').serialize(),
                    beforeSend: function(){
                        Toast.fire({
                            icon: 'success',
                            title: 'El curso se creó correctamente'
                        });
                    },
                    success: function (datos){
                        $('#boleta_cursos').html(datos);
                    } 
                });
                ev.preventDefault();
            });

        /*Borrar por Ajax*/

            $('#boleta_cursos').on("click", ".eliminar",function(){
                
                form = $(this).parent('.formularioborrar');

                $.ajax({
                    type: form.attr('method'), 
                    url: form.attr('action'),
                    data: form.serialize(),
                    beforeSend: function(){
                        Toast.fire({
                            icon: 'success',
                            title: 'El curso se eliminó correctamente'
                        });
                    },
                    success: function (datos){
                        $('#boleta_cursos').html(datos);
                    }  
                });

                return false;
            });

        /* generar pdf */

            $('#generarPdf').click(function(){
                setTimeout(function(){
                    location.reload();
                },500);
                
            })


        /* Si no se ha imprimido o generado el pdf, abrira el cuadro modal */
            @if ($boleta->estado == 'GENERADO')
                $("#exampleModal").modal("show");
            @endif
        
    </script>
@endsection