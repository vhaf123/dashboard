<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boleta</title>

    {{-- <style>
        
        .boleta{
            color: #FF7D73;
        }

        .titulo{
            margin-bottom: 0;
            line-height: 24px;
        }

        .subtitulo{
            margin-bottom: 0;
            line-height: 16px;
        }

        
        

        .info strong{
            font-weight: 600;
        }
        
        .reporte{
            background-color: rgba(97,197,211, 0.2);
        }

        .reporte p{
            font-weight: 600;
            color: #17A2B8;
        }

        .reporte p span{
            font-weight: normal;
            color: #5E5E5E;
            float: right;
        }


    </style> --}}

    

</head>
<body>
    

    
    <div class="row">
        <div class="col">
            <div class="card card-outline card-info">
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
                            @include('admin.boletas.cursos.index')
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
                </div>
            </div>
        </div>
    </div>
    
    
</body>
</html>