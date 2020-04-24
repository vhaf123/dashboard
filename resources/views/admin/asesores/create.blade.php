@extends('admin.layout.app')

@section('title', 'Crear Asesor')



@section('content')

    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow">


                    <div class="card-body">

                        <h6 class="text-secondary">NUEVO ASESOR</h6>
                        <hr>
                        
                        {!! Form::open(['route' => 'admin.asesores.store', 'autocomplete'=> 'off']) !!}
                        
                            @include('admin.asesores.partials.form')

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Registrar
                                    </button>
                                </div>
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