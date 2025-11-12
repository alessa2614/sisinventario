@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 18pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/usuarios') }}">Usuarios</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mi perfil</li>
        </ol>
    </nav>
@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card  card-primary">
                <div class="card-header">
                    <h3 class="card-title"> <b>Informacion personal</b></h3>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                    <form action=" {{ route('admin.usuarios.actualizar_perfil') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" value="{{ $usuario->id }}" hidden>

                        <div class="row ">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="rol">Rol del usuario</label>
                                            <select name="rol" id="rol" class="form-control" disabled>
                                                <option value="">Seleccione un rol</option>
                                                @foreach ($roles as $rol)
                                                    <option value="{{ $rol->id }}"
                                                        {{ old('rol', $usuario->roles->pluck('id')->first()) == $rol->id ? 'selected' : '' }}>
                                                        {{ $rol->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('name')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombres">Nombres :</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-box"></i></span>
                                                </div>
                                                <input type="text" value="{{ old('nombres', $usuario->nombres) }}"
                                                    class="form-control" id="nombres" name="nombres"
                                                    placeholder="Ingrese el nombre" required>
                                            </div>
                                            @error('nombres')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="apellidos">Apellidos :</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-box"></i></span>
                                                </div>
                                                <input type="text" value="{{ old('apellidos', $usuario->apellidos) }}"
                                                    class="form-control" id="apellidos" name="apellidos"
                                                    placeholder="Ingrese el nombre" required>
                                            </div>
                                            @error('apellidos')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="email">Correo electronico:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-box"></i></span>
                                                </div>
                                                <input type="text" value="{{ old('email', $usuario->email) }}"
                                                    class="form-control" id="email" name="email"
                                                    placeholder="Ingrese el nombre" required>
                                            </div>
                                            @error('email')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tipo_documento">Tipo de documento:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-box"></i></span>
                                                </div>
                                                <select name="tipo_documento" class="form-control" id="tipo_documento">
                                                    <option value="">Seleccione</option>
                                                    <option value="DNI"
                                                        {{ old('tipo_documento', $usuario->tipo_documento) == 'DNI' ? 'selected' : '' }}>
                                                        DNI</option>
                                                    <option value="Carnet de Extranjeria"
                                                        {{ old('tipo_documento', $usuario->tipo_documento) == 'Carnet de Extranjeria' ? 'selected' : '' }}>
                                                        Carnet de extranjeria</option>
                                                    <option value="Pasaporte"
                                                        {{ old('tipo_documento', $usuario->tipo_documento) == 'Pasaporte' ? 'selected' : '' }}>
                                                        Pasaporte
                                                    </option>
                                                    <option value="Ruc"
                                                        {{ old('tipo_documento', $usuario->tipo_documento) == 'RUC' ? 'selected' : '' }}>
                                                        Ruc</option>
                                                    <option value="CI"
                                                        {{ old('tipo_documento', $usuario->tipo_documento) == 'CI' ? 'selected' : '' }}>
                                                        CI</option>
                                                </select>
                                            </div>
                                            @error('tipo_documento')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="numero_documento">Numero de documento:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-box"></i></span>
                                                </div>
                                                <input type="text"
                                                    value="{{ old('numero_documento', $usuario->numero_documento) }}"
                                                    class="form-control" id="numero_documento" name="numero_documento"
                                                    placeholder="Ingrese el nombre" required>
                                            </div>
                                            @error('numero_documento')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="celular">Numero de celular</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-box"></i></span>
                                                </div>
                                                <input type="text" value="{{ old('celular', $usuario->celular) }}"
                                                    class="form-control" id="celular" name="celular"
                                                    placeholder="Ingrese el nombre" required>
                                            </div>
                                            @error('celular')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-box"></i></span>
                                                </div>
                                                <input type="date"
                                                    value="{{ old('fecha_nacimiento', $usuario->fecha_nacimiento) }}"
                                                    class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                                                    placeholder="Ingrese el nombre" required>
                                            </div>
                                            @error('fecha_nacimiento')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="genero">Genero:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-box"></i></span>
                                                </div>
                                                <select name="genero" class="form-control" id="genero">
                                                    <option value="">Seleccione</option>
                                                    <option value="Masculino"
                                                        {{ old('genero', $usuario->genero) == 'Masculino' ? 'selected' : '' }}>
                                                        Masculino</option>
                                                    <option value="Femenino"
                                                        {{ old('genero', $usuario->genero) == 'Femenino' ? 'selected' : '' }}>
                                                        Femenino</option>
                                                </select>
                                            </div>
                                            @error('genero')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="direccion">Direccion:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-box"></i></span>
                                                </div>
                                                <input type="text" value="{{ old('direccion', $usuario->direccion) }}"
                                                    class="form-control" id="direccion" name="direccion"
                                                    placeholder="Ingrese el nombre" required>
                                            </div>
                                            @error('direccion')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="foto">Fotografia</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-image"></i>
                                                    </span>
                                                </div>
                                                <input type="file" class="form-control" name="foto" id="foto"
                                                    accept="image/*" onchange="mostarImagen(event)">
                                            </div>
                                            <center>
                                                @if (@isset($usuario) && $usuario->foto)
                                                    <img id="preview1"
                                                        src="{{ asset('storage/fotos/' . $usuario->foto) }}"
                                                        class="img-circle img-thumbnail"alt="foto"
                                                        style="width:200px; height:200px; display: block; margin: 0 auto;">
                                                @else
                                                    <img id="preview1" src=""
                                                        class="img-circle img-thumbnail"alt="foto"
                                                        style="width:200px; height:200px; display: block; margin: 0 auto;">
                                                @endif

                                            </center>
                                            @error('foto')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <script>
                                        const mostarImagen = e =>
                                            document.getElementById('preview1').src = URL.createObjectURL(e.target.files[0]);
                                    </script>
                                </div>
                            </div>
                        </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card  card-warning">
                <div class="card-header">
                    <h3 class="card-title"> <b>Seguridad - Cambio de contraseña</b></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password_actual">Contraseña Actual</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control" name="password_actual"
                                        id="password_actual" placeholder="Ingrese su password actual">
                                </div>
                                @error('password_actual')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password_nueva">Nueva Contraseña </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" name="password_nueva"
                                        id="password_nueva" placeholder="Ingrese su password nueva">
                                </div>
                                @error('password_nueva')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password_confirmacion">Confirmar nueva contraseña</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-shield-alt"></i></span>
                                    </div>
                                    <input type="password" class="form-control" name="password_confirmacion"
                                        id="password_confirmacion" placeholder="Confirma tu contraseña">
                                </div>
                                @error('password_confirmacion')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('/admin') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"> Regresar</i></a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar cambios</button>
        </div>
    </div>
    </form>
@stop

@section('css')
    <style>
        .ck.ck-editor {
            width: 100% !important;
        }

        .ck-editor__editable {
            width: 100% !important;
            min-height: 300px;
            box-sizing: border-box;
        }

        .ck.ck-toolbar {
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .ck-editor__editable {
                min-height: 250px;
                padding: 10px;
            }
        }
    </style>

@stop

@section('js')

@stop
