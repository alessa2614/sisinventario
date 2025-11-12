@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 18pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/roles') }}">Roles</a></li>
            <li class="breadcrumb-item active" aria-current="page">Reguistro de un nuevo rol</li>
        </ol>
    </nav>
@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card  card-primary">
                <div class="card-header">
                    <h3 class="card-title"> <b>Llene los datos del formulario</b></h3>


                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                    <form action="{{ url('/admin/roles/create') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row ">
                            <div class="col-md-12">
                                <div class="row">
                                    

                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="name">Nombre del rol:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-box"></i></span>
                                                </div>
                                                <input type="text" value="{{ old('name') }}" class="form-control"
                                                    id="name" name="name" placeholder="Ingrese el nombre" required>
                                            </div>
                                            @error('name')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                   
                                
                                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="{{ url('/admin/roles') }}" class="btn btn-danger">Cancelar</a>
                            
                            <button type="submit" class="btn btn-primary ">Guardar</button>
                        </div>
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
