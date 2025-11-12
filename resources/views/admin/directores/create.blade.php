@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 18pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/directores') }}">Directores</a></li>
            <li class="breadcrumb-item active" aria-current="page">Creacion de lista de Directores</li>
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
                    <form action="{{ url('/admin/directores/create') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row ">
                            <div class="col-md-12">
                                <div class="row">
                                    

                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="nombre">Nombre:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text" value="{{ old('nombre') }}" class="form-control"
                                                    id="nombre" name="nombre" placeholder="Ingrese el nombre" required>
                                            </div>
                                            @error('nombre')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-1">

                                    </div>

                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="apellido">Apellidos:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text" value="{{ old('apellido') }}" class="form-control"
                                                    id="apellido" name="apellido" placeholder="Ingrese el apellido" required>
                                            </div>
                                            @error('nombre')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                        
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dni">DNI:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-id-card"></i></span>
                                                </div>
                                                <input type="number" value="{{ old('dni') }}"
                                                    class="form-control" id="dni" name="dni" required>
                                            </div>
                                            @error('dni')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fecha_inicio">Fecha de inicio:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="date" value="{{ old('fecha_inicio') }}"
                                                    class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                                            </div>
                                            @error('fecha_inicio')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fecha_fin">Fecha de fin:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="date" value="{{ old('fecha_fin') }}"
                                                    class="form-control" id="fecha_fin" name="fecha_fin" >
                                            </div>
                                            @error('fecha_fin')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="observaciones">Observaciones:</label>
                                                <div class="editor-wrapper">
                                                    <textarea id="observaciones" name="observaciones"></textarea>
                                                </div>
                                                @error('observaciones')
                                                    <small style="color: red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="estado">Estado:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-check-circle"></i></span>
                                                </div>
                                                <select name="estado" id="estado" class="form-control" required>
                                                    <option value="">Seleccionar una opcion</option>
                                                    <option value="1"{{ old('estado') == '1' ? 'selected' : '' }}>
                                                        Activo</option>
                                                    <option value="0"{{ old('estado') == '0' ? 'selected' : '' }}>
                                                        Inactivo</option>
                                                </select>
                                            </div>
                                            @error('estado')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                



              
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="{{ url('/admin/directores') }}" class="btn btn-danger">Cancelar</a>
                            
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
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#observaciones'), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', '|',
                        'link', 'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'alignment', '|',
                        'blockQuote', 'insertTable', 'mediaEmbed', '|',
                        'undo', 'redo', '|',
                        'fontBackgroundColor', 'fontColor', 'fontSize', 'fontFamily', '|',
                        'code', 'codeBlock', 'htmlEmbed', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                language: 'es'
            })
            .then(editor => {
                // Forzar responsive después de crear el editor
                const editorEl = editor.ui.view.element;
                editorEl.style.width = '100%';
                editorEl.querySelector('.ck-editor__editable').style.width = '100%';
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@stop
