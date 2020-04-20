@extends('admin.layout.app')

@section('title', 'Editar Asesor')

@section('breadcrumbs')
    <div class="row mb-2">
        <div class="col-sm-6">
            
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Admin</a></li>
            <li class="breadcrumb-item active">Legacy User Menu</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow">


                    <div class="card-body">

                        <h6 class="text-secondary">ACTUALIZAR DATOS DEL ASESOR</h6>
                        <hr>

                        {!! Form::model($asesor, ['route' => ['admin.asesores.update', $asesor], 'method' => 'PUT']) !!}
                        
                            @include('admin.asesores.partials.form-edit')

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Actualizar
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