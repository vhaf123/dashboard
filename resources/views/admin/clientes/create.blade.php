@extends('admin.layout.app')

@section('title', 'Nuevo Cliente')

@section('link')
    <style>
        #referencia{
        height: 120px;
    }
    </style>
@endsection

@section('content')
    <div class="container pb-4">
        
        <div class="row justify-content-center">
            <div class="col-lg-7">

                <div class="card shadow">

                    <div class="card-body">
                        
                        {{-- Formulario --}}
                        {!! Form::open(['route' => 'admin.clientes.store', 'autocomplete'=> 'off']) !!}

                            {{-- Cabecera --}}
                            <h5 class="text-secondary">
                                CREAR UN NUEVO CLIENTE
                            </h5>
                            
                            <hr>
                            
                            <div class="form-row mb-3">

                                {{-- cliente --}}
                                <div class="form-group col-md-12">
                                    
                                    {!! Form::label("name", "Nombre del Cliente") !!}
                                    {!! Form::text("name", null, ["class" => "form-control" . ( $errors->has('telefono') ? ' is-invalid' : '' ), "placeholder" => "Escribe el nombre del cliente ...", 'autofocus']) !!}
                                    
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

                                {{-- Referencia --}}
                                <div class="form-group col-md-12">
                                    {!! Form::label("referencia", "Referencia", ["class"=>"text-secondary"]) !!}
                                    {!! Form::textarea("referencia", null, ["class" => "form-control" . ( $errors->has('referencia') ? ' is-invalid' : '' ), "placeholder" => "Escriba una referencia detallada del domicilio ..."])!!}
                                    @error('referencia')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-primary px-3">
                                    Registrar
                                </button>
                            </div>

                        {!! Form::close() !!}
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
