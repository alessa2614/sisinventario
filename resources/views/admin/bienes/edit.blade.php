@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 18pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/bienes') }}">Bienes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edicion de Bienes</li>
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
                    <form action="{{ url('/admin/bienes/'.$bienes->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row ">
                            <div class="col-md-12">

                                 <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="descripcion">
                                                Descripcion del bien:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">

                                                </div>
                                                <textarea class="card card-body bg-white shadow-sm" style="border: 1px solid #b3b4b5;" name="descripcion"
                                                    id="descripcion" cols="100" rows="1" placeholder="Ingrese una descripcion" required>{{ $bienes->descripcion }}</textarea>
                                            </div>
                                            @error('descripcion')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="codigo_patrimonial">Codigo Patrimonial:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                                </div>
                                                <input type="text" value="{{ old('codigo_patrimonial',$bienes->codigo_patrimonial) }}"
                                                    class="form-control" id="codigo_patrimonial" name="codigo_patrimonial"
                                                    placeholder="Ingrese el codigo patrimonial">
                                            </div>
                                            @error('codigo_patrimonial')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="marca">Marca:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                                </div>
                                                <input type="text" value="{{ old('marca',$bienes->marca) }}" class="form-control"
                                                    id="marca" name="marca" placeholder="Ingrese la marca">
                                            </div>
                                            @error('marca')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="modelo">Modelo:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-cogs"></i></span>
                                                </div>
                                                <input type="text" value="{{ old('modelo',$bienes->modelo) }}" class="form-control"
                                                    id="modelo" name="modelo" placeholder="Ingrese el modelo">
                                            </div>
                                            @error('modelo')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>


                               
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="numero_doc">Numero de Documento:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-receipt"></i></span>
                                                </div>
                                                <input type="text" value="{{ old('numero_doc',$bienes->numero_doc) }}" class="form-control"
                                                    id="numero_doc" name="numero_doc"
                                                    placeholder="Ingrese el numero de documento">
                                            </div>
                                            @error('numero_doc')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tipo_documento">Tipo de documento fuente:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-book"></i></span>
                                                </div>
                                                <input type="text" value="{{ old('tipo_documento',$bienes->tipo_documento) }}"
                                                    class="form-control" id="tipo_documento" name="tipo_documento"
                                                    placeholder="Ingrese el tipo de documento fuente">
                                            </div>
                                            @error('tipo_documento')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="categoria_id">Categoría del bien:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-layer-group"></i></span>
                                                </div>
                                                <select name="categoria_id" id="categoria_id" class="form-control"
                                                    required>
                                                    <option value="">Seleccionar una categoría ...</option>

                                                    @foreach ($categorias->where('parent_id', null) as $padre)
                                                        {{-- solo los 4 padres --}}
                                                        <optgroup label="{{ $padre->nombre }}">
                                                            @foreach ($padre->children as $hijo)
                                                                {{-- las subcategorías --}}
                                                                <option value="{{ $hijo->id }}"
                                                                    {{ old('categoria_id',$bienes->categoria_id) == $hijo->id ? 'selected' : '' }}>
                                                                    {{ $hijo->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach

                                                </select>
                                            </div>
                                            @error('categoria_id')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>



                                </div>

                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="serial">Numero de serie:</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                                    </div>
                                                    <input type="text" value="{{ old('serial',$bienes->serial) }}" class="form-control"
                                                        id="serial" name="serial" placeholder="Ingrese el serial">
                                                </div>
                                                @error('serial')
                                                    <small style="color: red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="color">Color:</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-palette"></i></span>
                                                        </div>
                                                        <input type="text" value="{{ old('color',$bienes->color) }}"
                                                            class="form-control" id="color" name="color"
                                                            placeholder="Ingrese el color">
                                                    </div>
                                                    @error('color')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="medidas">Medidas:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-ruler"></i></span>
                                                </div>
                                                <input type="text" value="{{ old('medidas',$bienes->medidas) }}" class="form-control"
                                                    id="medidas" name="medidas" placeholder="Ingrese las medidas">
                                            </div>
                                            @error('medidas')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fecha_adquisicion">Fecha de Adquisicion:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="date" value="{{ old('fecha_adquisicion',$bienes->fecha_adquisicion) }}"
                                                    class="form-control" id="fecha_adquisicion" name="fecha_adquisicion"
                                                    placeholder="Ingrese las fecha_adquisicion" >
                                            </div>
                                            @error('fecha_adquisicion')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="valor_inicial">Precio de adquision:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                </div>
                                                <input type="number" step="0.01" min="0" value="{{ old('valor_inicial',$bienes->valor_inicial) }}"
                                                    class="form-control" id="valor_inicial" name="valor_inicial"
                                                    placeholder="Ingrese las valor_inicial">
                                            </div>
                                            @error('valor_inicial')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="depreciacion">Depreciacion:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                                </div>
                                                <input type="number" step="0.01" min="0" value="{{ old('depreciacion',$bienes->depreciacion) }}"
                                                    class="form-control" id="depreciacion" name="depreciacion"
                                                    placeholder="Ingrese las depreciacion">
                                            </div>
                                            @error('depreciacion')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="area_id">Area-Ubicacion del bien:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                                                </div>
                                                <select name="area_id" id="" class="form-control" required>
                                                    
                                                    @foreach ($areas as $area)
                                                        <option value="{{ $area->id }}"
                                                            {{ old('area_id',$bienes->area_id) == $area->id ? 'selected' : '' }}>
                                                            {{ $area->nombre  }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('area_id')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="estado_id">Estado:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                                                </div>
                                                <select name="estado_id" id="" class="form-control" required>
                                                    
                                                    @foreach ($estados as $estado)
                                                        <option value="{{ $estado->id }}"
                                                            {{ old('estado_id',$bienes->estado_id) == $estado->id ? 'selected' : '' }}>
                                                            {{ $estado->nombre  }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('estado_id')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="director_id">Director responsable:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                                </div>
                                                <select name="director_id" id="" class="form-control" required>
                                                    
                                                    @foreach ($directores as $director)
                                                        <option value="{{ $director->id }}"
                                                            {{ old('director_id',$bienes->director_id) == $director->id ? 'selected' : '' }}>
                                                            {{ $director->nombre." ".$director->apellido  }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('director_id')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>


                                </div>

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="observaciones">
                                                Observaciones:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">

                                                </div>
                                                <textarea class="card card-body bg-white shadow-sm" style="border: 1px solid #b4b5b7;" name="observaciones"
                                                    id="observaciones" cols="100" rows="1" placeholder="Ingrese las observaciones" ></textarea>
                                            </div>
                                            @error('observaciones')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('/admin/bienes') }}" class="btn btn-secondary">Volver</a>

                                    <button type="submit" class="btn btn-primary ">Actualizar</button>
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
