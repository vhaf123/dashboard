@extends('admin.layout.app')

@section('title', 'Home')

@section('breadcrumbs')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Editar Cliente</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.clientes.index')}}">Clientes</a></li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
	//    
@endsection


@section('script')
	//    
@endsection