@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 18pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/roles') }}">Roles</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permisos del rol : {{ $rol->name }}</li>
        </ol>
    </nav>
@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card  card-primary">
                <div class="card-header">
                    <h3 class="card-title"> <b>Permisos registrados del sistema</b></h3>


                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">

                    <form action="{{ url('/admin/roles/' . $rol->id . '/update_permisos') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            @foreach ($permisos as $modulo => $grupoPermisos)
                                <div class="col-md-3">
                                    <h4><b>{{ $modulo }}</b></h4>
                                    @foreach ($grupoPermisos as $permiso)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="permisos[]"
                                                value="{{ $permiso->id }}"
                                                {{ $rol->hasPermissionTo($permiso->name) ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                {{ $permiso->name }}
                                            </label>

                                        </div>
                                    @endforeach
                                    <br>
                                </div>
                            @endforeach

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ url('/admin/roles') }}" class="btn btn-secondary"><i class="fas fa-arrow-left">
                                         Cancelar</i></a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar
                                    cambios</button>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
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
