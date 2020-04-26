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

                    <div class="card-header py-3">
                        {{-- Cabecera --}}
                        <h1 class="card-title text-secondary">
                            CREAR NUEVO CLIENTE
                        </h1>
                    </div>

                    <div class="card-body">
                        
                        {{-- Formulario --}}
                        {!! Form::open(['route' => 'admin.clientes.store', 'autocomplete'=> 'off']) !!}
                            
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
