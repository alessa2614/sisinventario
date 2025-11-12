@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 18pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/usuarios') }}">Usuarios</a></li>
            <li class="breadcrumb-item active" aria-current="page">Datos del usuario</li>
        </ol>
    </nav>
@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card  card-primary">
                <div class="card-header">
                    <h3 class="card-title"> <b><i class="fas fa-user"></i> Informacion personal</b></h3>

                </div>

                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4">
                            <b><i class="fas fa-user"></i> Nombre completo</b>
                            <p>{{ $usuario->name }}</p>
                        </div>

                        <div class="col-md-4">
                            <b><i class="fas fa-envelope"></i> Correo</b>
                            <p>{{ $usuario->email }}</p>
                        </div>

                        <div class="col-md-4">
                            <b><i class="fas fa-id-card"></i> Documento</b>
                            <p>{{ $usuario->tipo_documento }} - {{ $usuario->numero_documento }}</p>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <b><i class="fas fa-mobile-alt"></i> Celular</b>
                            <p>{{ $usuario->celular }}</p>
                        </div>

                        <div class="col-md-4">
                            <b><i class="fas fa-birthday-cake"></i> Fecha de nacimiento</b>
                            <p>{{ $usuario->fecha_nacimiento }}</p>
                        </div>

                        <div class="col-md-4">
                            <b><i class="fas fa-venus-mars"></i> Genero</b>
                            <p>{{ $usuario->genero }}</p>
                        </div>




                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <b><i class="fas fa-map-marker-alt"></i> Direccion</b>
                            <p>{{ $usuario->direccion }}</p>
                        </div>
                    </div>


                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <div class="col-md-3">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title"> <b><i class="fas fa-user"> </i>Perfil</h3>

                </div>
                <div class="card-body">
                    <div class="row  text-center">
                        <div class="col-md-12">
                            @if ($usuario->foto)
                                 <img src="{{ asset('storage/fotos/' . $usuario->foto) }}" class="img-circle img-thumbnail" alt="foto" 
                                 style="width:200px; height:200px; display: block; margin: 0 auto;">
                            @else
                                <img src="{{ url('images/user.png') }}" class="img-circle img-thumbnail" alt="foto"
                                    style="width:200px; height:200px; display: block; margin: 0 auto;">
                            @endif

                            <h5 class="h5rofile-username">{{ $usuario->name }}</h5>

                            <button class="btn btn-warning">{{ $usuario->roles->pluck('name')->implode(',') }}</button>

                            <br>
                            @if ($usuario->estado == 1)
                                <span class="badge badge-success">Activo</span>
                            @else
                                <span class="badge badge-danger">Inactivo</span>
                            @endif
                            <hr>
                            <small><b>Hora y fecha de creacion:</b> <br>{{ $usuario->created_at }}</small>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

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
