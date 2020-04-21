{{-- Datos de cliente --}}
<div class="form-row">

    {{-- cliente --}}
    <div class="form-group col-md-7">

        <input type="text" name="cliente_id" value="{{$cliente->id}}" class="d-none">

        <label for="cliente_id" class="text-secondary">Nombre del Cliente</label>
        <input type="text" value="{{$cliente->name}}" class="form-control" disabled>
        
    </div>

    {{-- Categoria --}}
    <div class="form-group col-md-5">
        {!! Form::label('categoria_id', 'Categoría', ['class' => 'text-secondary']) !!}
        {!! Form::select('categoria_id', $categorias, null, ['class' => "form-control"]) !!}
    </div>

    {{-- Numero de alumnos --}}
    <div class="form-group col-md-2">
        {!! Form::label('numero_alumnos', 'N° Alumnos', ['class' => 'text-secondary']) !!}
        {!! Form::number('numero_alumnos', 1, ["class" => "form-control" . ( $errors->has('numero_alumnos') ? ' is-invalid' : '' )]) !!}
    
        @error('numero_alumnos')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    {{-- Nombre de alumnos --}}
    <div class="form-group col-md-5">
        {!! Form::label('alumno', 'Nombre de alumno(s)', ["class" => "text-secondary"]) !!}
        {!! Form::text("alumno", null, ["class" => "form-control" . ( $errors->has('alumno') ? ' is-invalid' : '' )]) !!}

        @error('alumno')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    {{-- Institución --}}
    <div class="form-group col-md-5">
        {!! Form::label('institucion_id', 'Institución', ['class' => 'text-secondary']) !!}
        {!! Form::select('institucion_id', $instituciones, null, ['class' => "form-control select2"]) !!}
    </div>
</div>
    
{{-- Cabecera --}}
<br>
<h6 class="text-secondary">INFORMACIÓN DE CONTRATO</h6>
<hr>

<div class="form-row">
    {{-- Paquete --}}
    <div class="form-group col-md-4">
        {!! Form::label('paquete_id', 'Paquete', ['class' => 'text-secondary']) !!}
        {!! Form::select('paquete_id', $paquetes, null, ['class' => "form-control"]) !!}
    </div>

    {{-- Fecha --}}
    <div class="form-group col-md-4">
        {!! Form::label("fecha", "Fecha", ["class"=>"text-secondary"]) !!}
        {!! Form::text("fecha", null, ["class" => "form-control" . ( $errors->has('fecha') ? ' is-invalid' : '' )]) !!} 
    </div>

    {{-- Numero de horas --}}
    <div class="form-group col-md-4">
        {!! Form::label("horas", "N° Horas", ["class"=>"text-secondary"]) !!}
        {!! Form::number("horas", 2, ["class" => "form-control" . ( $errors->has('horas') ? ' is-invalid' : '' ), "min" => "2"]) !!}
        
        @error('horas')
            <small class="text-danger" role="alert">
                * {{ $message }}
            </small>
        @enderror

    </div>

    {{-- Sesiones --}}
    <div class="form-group col-md-4">
        {!! Form::label("sesiones", "Sesiones", ["class"=>"text-secondary"]) !!}
        {!! Form::number("sesiones", 1, ["class" => "form-control" . ( $errors->has('sesiones') ? ' is-invalid' : '' ), "min" => "1"]) !!}

        @error('sesiones')
            <small class="text-danger" role="alert">
                * {{ $message }}
            </small>
        @enderror
    </div>

    {{-- Anticipo --}}
    <div class="form-group col-md-4">
        {!! Form::label("anticipo", "Anticipo", ["class"=>"text-secondary"]) !!}
        {!! Form::number("anticipo", null, ["class" => "form-control" . ( $errors->has('anticipo') ? ' is-invalid' : '' ), "min" => "0"]) !!}

        @error('anticipo')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    {{-- Coordinador --}}
    <div class="form-group col-md-4">
        {!! Form::label('admin_id', 'Coordinador(a)', ['class' => 'text-secondary']) !!}
        {!! Form::select('admin_id', $admins, null, ['class' => "form-control"]) !!}
    </div>

</div>