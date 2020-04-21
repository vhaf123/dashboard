@extends('admin.layout.app')

@section('title', 'Home')

@section('link')
    {{-- daterangepicker --}}
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">

    <style>

        .container{
            min-height: 800px;
        }

        #referencia{
            height: 120px;
        }

        .widget-user-image{
            left: 60px !important;
        }

        .nav-propio a{
            color: #6C757D;
            font-weight: 600;
        }

        .nav-propio a:hover{
            color: #007BFF;
            background-color: #E8F5FE;
            border-bottom-style: solid;
        }

        .nav-propio .active{
            color: #007BFF;
            border-bottom-style: solid;
        }

        /* .card h5{
            color: #007BFF!important;
        } */
        

    </style>
@endsection

@section('content')

    <div class="container pb-5">

        {{-- Muro del perfil --}}
        <div class="row">
            <div class="col">
                <div class="card card-widget widget-user">

                    <div class="widget-user-header text-white"
                        style="background: url('{{asset('dist/img/photo1.png')}}') center center;">
                    <h3 class="widget-user-username text-right">{{$cliente->name}}</h3>
                    <h5 class="widget-user-desc text-right">Activo</h5>
                    </div>

                    <div class="widget-user-image">
                    <img class="img-circle" src="{{asset('dist/img/user3-128x128.jpg')}}" alt="User Avatar">
                    </div>

                    {{-- card-body --}}
                    <div class="card-body mt-4">
                        <h4>{{$cliente->name}}</h4>
                        <span class="text-secondary"><i class="fas fa-calendar-alt mr-1"></i>Registrado {{$cliente->created_at->diffForHumans()}}</span>
                        <br>
                        <span class="text-secondary">
                            <strong class="mr-1">{{$cliente->boletas->count()}}</strong>Boletas contratadas
                        </span>

                        <span class="text-secondary">
                            <strong class="ml-2 mr-1">{{$cliente->boletas->sum('horas')}}</strong>Horas contratadas</span>
                        </span>
                        
                    </div>

                    {{-- tablist --}}
                    <ul class="nav nav-propio" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="timeline-tab" data-toggle="tab" href="#timeline" role="tab" aria-controls="timeline" aria-selected="true">Linea de tiempo</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="informacion-tab" data-toggle="tab" href="#informacion" role="tab" aria-controls="informacion" aria-selected="false">Información</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="boleta-tab" data-toggle="tab" href="#boleta" role="tab" aria-controls="boleta" aria-selected="false">Nueva Boleta</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="pago-tab" data-toggle="tab" href="#pago" role="tab" aria-controls="pago" aria-selected="false">Pago</a>
                        </li>

                        
                    </ul>
                    
                </div>
            </div>
        </div>


        {{-- Contenido principal --}}
        <div class="row mt-3">

            {{-- tab-content --}}
            <div class="col-md-8">
                <div class="tab-content" id="myTabContent">

                    {{-- Timeline --}}
                    <div class="tab-pane fade show active" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
                       
                        @foreach ($timelines as $timeline)
                            
                            @switch($timeline->accion)
                                {{-- Nuevo cliente --}}
                                @case('create_cliente')

                                    <div class="card borde-left borde-success">

                                        <h6 class="card-header">
                                            <small class="text-secondary float-right">{{$timeline->created_at->format('d/m/y - h:i A')}}</small>
                                            <a href="#"><strong>{{$timeline->admin->name}}</strong></a> creó al cliente {{$cliente->name}}
                                        </h6>
                                        
                                    </div>
            
                                @break
            
                                {{-- Actualización de información del cliente --}}
                                @case('update_cliente')
            
                                    <div class="card borde-left borde-warning">

                                        <h6 class="card-header">
                                            <small class="text-secondary float-right">{{$timeline->created_at->format('d/m/y - h:i A')}}</small>
                                            <a href="#"><strong>{{$timeline->admin->name}}</strong></a> actualizó la información del cliente
                                        </h6>
                                        
                                    </div>
            
                                @break

                                {{-- Agregado nueva boleta --}}
                                @case('create_boleta')

                                    <div class="card borde-left borde-primary">
                                        
                                        <h6 class="card-header">
                                            <small class="text-secondary float-right">{{$timeline->created_at->format('d/m/y - h:i A')}}</small>
                                            <a href="#"><strong>{{$timeline->admin->name}}</strong></a> le asignó la boleta {{$timeline->boleta}}
                                        </h6>

                                        <div class="card-body">
                                            <p class="card-text text-secondary">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Illum magnam aut facilis necessitatibus aliquam consectetur nemo provident.</p>
                                        </div>

                                        <div class="card-footer">
                                            <a class="btn btn-primary btn-sm" href="{{route('admin.boletas.show', $timeline->boleta)}}" role="button">Ver boleta</a>
                                            <a class="btn btn-danger btn-sm" href="#" role="button">Anular Boleta</a>
                                        </div>
                                    </div>
                                  
                                @break

                            @endswitch

                        @endforeach
    
                    </div>
    
                    {{-- Información --}}
                    <div class="tab-pane fade" id="informacion" role="tabpanel" aria-labelledby="informacion-tab">
    
                        <div class="card">
                            <div class="card-body">
                                {!! Form::model($cliente, ['route' => ['admin.clientes.update', $cliente->id], 'method' => 'PUT']) !!}
    
                                    {{-- Cabecera --}}
                                    <h6 class="text-secondary">INFORMACIÓN DEL CLIENTE</h6>

                                    <hr>
                                    
                                    @include('admin.clientes.partials.form')
        
                                                                    
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-primary px-3">
                                            Actualizar
                                        </button>
                                    </div>
    
                                {!! Form::close() !!}
                            </div>
                        </div>
    
                    </div>
                    
                    {{-- Nueva Boleta --}}
                    <div class="tab-pane fade" id="boleta" role="tabpanel" aria-labelledby="boleta-tab">
                        
                        <div class="card shadow">
                            <div class="card-body">
                                {!! Form::open(['route' => 'admin.boletas.store', 'autocomplete'=> 'off']) !!}
                                    <h6 class="text-secondary">
                                        CREAR NUEVA BOLETA
                                    </h6>
                                    <hr>
        
                                    @include('admin.clientes.partials.form-boleta')
        
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-md btn-primary">
                                            Registrar
                                        </button>
                                    </div>
        
                                {!! Form::close() !!}
                            </div>
                        </div>   

                    </div>

                    <div class="tab-pane fade" id="pago" role="tabpanel" aria-labelledby="pago-tab">
                        ...
                    </div>
                    
                </div>
            </div>

            {{-- Informacion relevante --}}
            <div class="col-md-4">
            
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Boletas Contratadas</span>
                      <span class="info-box-number">{{$cliente->boletas->count()}}</span>
                    </div>
                </div>


                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-clock"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Horas contratadas</span>
                      <span class="info-box-number">{{$cliente->boletas->sum('horas')}}</span>
                    </div>
                </div>

                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="far fa-money-bill-alt"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Deuda</span>
                      <span class="info-box-number">1,410</span>
                    </div>
                </div>


            </div>
        </div>

    </div>

  
@endsection

@section('script')
    {{-- daterangepicker --}}
    <script src="{{asset('plugins/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>

    <script>
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