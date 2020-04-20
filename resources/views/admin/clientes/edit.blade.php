@extends('admin.layout.app')

@section('title', 'Editar')

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
            <div class="col-md-9 col-lg-6">

                <div class="card card-outline card-info shadow">

                    <div class="card-body">
                        
                        {{-- Formulario --}}
                        {!! Form::model($cliente, ['route' => ['admin.clientes.update', $cliente->id], 'method' => 'PUT']) !!}

                            {{-- Cabecera --}}
                            <h5 class="text-secondary">
                                EDITAR INFORMACIÓN DEL CLIENTE
                            </h5>
                            
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


@section('script')
	
@endsection