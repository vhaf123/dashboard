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
            <div class="col-md-9 col-lg-7">

                <div class="card shadow">

                    <div class="card-body">
                        
                        {{-- Formulario --}}
                        {!! Form::open(['route' => 'admin.clientes.store', 'autocomplete'=> 'off']) !!}

                            {{-- Cabecera --}}
                            <h6 class="text-secondary">
                                AGREGAR UN NUEVO CLIENTE
                            </h6>
                            
                            <hr>
                            
                            @include('admin.clientes.partials.form')

                            
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
