<div class="form-group row">

    {!! Form::label("name", "Nombre", ["class"=>"col-md-4 col-form-label text-md-right text-secondary"]) !!}

    <div class="col-md-6">
        {!! Form::text("name", null, ["class" => "form-control" . ( $errors->has('name') ? ' is-invalid' : '' ), 'autofocus']) !!}

        @error('name')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    {!! Form::label("email", "Correo Electrónico", ["class"=>"col-md-4 col-form-label text-md-right text-secondary"]) !!}

    <div class="col-md-6">
        
        {!! Form::email("email", null, ["class" => "form-control", "readonly", "tabindex" => "-1"]) !!}

        @error('email')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    
    <label for="password" class="col-md-4 col-form-label text-md-right text-secondary">Contraseña</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="password-confirm" class="col-md-4 col-form-label text-md-right text-secondary">Confirmar contraseña</label>

    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
    </div>
</div>