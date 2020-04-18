@extends('admin.layout.app')

@section('title', 'Home')

@section('link')
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
                                            <small class="text-secondary float-right"><i class="fas fa-clock"></i> {{$timeline->created_at->format('h:i A')}}</small>
                                            <a href="#"><strong>Victor Arana</strong></a> creó al cliente {{$cliente->name}}
                                        </h6>
                                        
                                    </div>
            
                                @break
            
                                {{-- Actualización de información del cliente --}}
                                @case('update_cliente')
            
                                    <div class="card borde-left borde-warning">

                                        <h6 class="card-header">
                                            <small class="text-secondary float-right"><i class="fas fa-clock"></i> {{$timeline->created_at->format('h:i A')}}</small>
                                            <a href="#"><strong>Victor Arana</strong></a> actualizó la información del cliente
                                        </h6>
                                        
                                    </div>
            
                                @break

                                {{-- Agregado nueva boleta --}}
                                @case('create_boleta')

                                    <div class="card borde-left borde-primary">
                                        
                                        <h6 class="card-header">
                                            <small class="text-secondary float-right"><i class="fas fa-clock"></i> {{$timeline->created_at->format('h:i A')}}</small>
                                            <a href="#"><strong>Victor Arana</strong></a> agregó una nueva boleta
                                        </h6>

                                        <div class="card-body">
                                            <p class="card-text text-secondary">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Illum magnam aut facilis necessitatibus aliquam consectetur nemo provident.</p>
                                        </div>

                                        <div class="card-footer">
                                            <a class="btn btn-primary btn-sm" href="#" role="button">Ver boleta</a>
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
                                <h5 class="text-primary">Información del cliente</h5>

                                <hr>
                                
                                <div class="form-row">
    
                                    {{-- cliente --}}
                                    <div class="form-group col-md-12">
                                        
                                        {!! Form::label("name", "Nombre del Cliente") !!}
                                        {{-- <label for="name" class="text-secondary">Nombre del Cliente</label> --}}
                                        {!! Form::text("name", null, ["class" => "form-control" . ( $errors->has('telefono') ? ' is-invalid' : '' ), "placeholder" => "Escribe el nombre del cliente ...", 'autofocus']) !!}
                                        {{-- <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Escribe el nombre del cliente ..." autofocus> --}}
                                        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        
                                    </div>
                                
                                    {{-- Telefono --}}
                                    <div class="form-group col-md-6">
                                        {!! Form::label("telefono", "Teléfono", ["class"=>"text-secondary"]) !!}
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            {!! Form::number("telefono", null, ["class" => "form-control" . ( $errors->has('telefono') ? ' is-invalid' : '' ), "placeholder" => "Teléfono"]) !!}
                                        </div>
                                        @error('telefono')
                                        
                                            <small class="text-danger" role="alert">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
    
                                    {{-- DNI --}}
                                    <div class="form-group col-md-6">
                                        {!! Form::label("dni", "DNI", ["class"=>"text-secondary"]) !!}
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                            </div>
                                            {!! Form::number("dni", null, ["class" => "form-control" . ( $errors->has('dni') ? ' is-invalid' : '' ), "placeholder" => "DNI"]) !!}
                                            @error('dni')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
    
                                    {{-- Direccion --}}
                                    <div class="form-group col-md-6">
                                        {!! Form::label("direccion", "Dirección", ["class"=>"text-secondary"]) !!}
                                        {!! Form::text("direccion", null, ["class" => "form-control" . ( $errors->has('direccion') ? ' is-invalid' : '' ), "placeholder" => "Dirección"]) !!}
                                        @error('direccion')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
    
                                    {{-- Distrito --}}
                                    <div class="form-group col-md-6">
                                        {!! Form::label("distrito", "Distrito", ["class"=>"text-secondary"]) !!}
                                        {!! Form::text("distrito", null, ["class" => "form-control" . ( $errors->has('distrito') ? ' is-invalid' : '' ), "placeholder" => "Distrito"]) !!}
                                        @error('distrito')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                        
                                </div>
    
                                <h5 class="text-primary mt-4 mb-3">
                                    Referencia
                                </h5>
    
                                {{-- Referencia --}}
                                <div class="form-group">
                                    {!! Form::label("referencia", "Referencia", ["class"=>"d-none"]) !!}
                                    {!! Form::textarea("referencia", null, ["class" => "form-control" . ( $errors->has('referencia') ? ' is-invalid' : '' ), "placeholder" => "Escriba una referencia detallada del domicilio ..."])!!}
                                    @error('referencia')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                   
                                <div class="form-group float-right">
                                    <button type="submit" class="btn btn-primary px-3">
                                        Actualizar
                                    </button>
                                </div>
    
                            {!! Form::close() !!}
                            </div>
                        </div>
    
                    </div>
    
                    <div class="tab-pane fade" id="boleta" role="tabpanel" aria-labelledby="boleta-tab">
                        Nueva Boleta
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