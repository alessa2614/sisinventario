@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 18pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/bienes') }}">Bienes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ingreso de Bienes</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-file-excel"></i> Subir Archivo Excel para Actualizar o Registrar Bienes</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('ingresos.importar') }}" method="POST" enctype="multipart/form-data"
                class="row align-items-center">
                @csrf

                <div class="col-md-6 mb-3">
                    <label for="archivo_excel" class="form-label fw-bold">Seleccionar archivo Excel:</label>
                    <input type="file" name="archivo_excel" id="archivo_excel" accept=".xlsx, .xls" class="form-control"
                        required>
                    <small class="text-muted">El archivo debe contener los encabezados correctos según la plantilla
                        guía.</small>
                    @error('archivo_excel')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 text-end mt-4">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-upload"></i> Subir y Procesar
                    </button>
                    <a href="{{ route('ingresos.plantilla') }}" class="btn btn-success">
                        <i class="fas fa-file-excel"></i> Descargar plantilla
                    </a>

                    <a href="{{ route('ingresos.guia') }}" class="btn btn-info">
                        <i class="fas fa-book"></i> Descargar guía de IDs
                    </a>
                </div>
            </form>

            {{-- Mensajes de éxito o error --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-times-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>
    </div>


    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Ingreso de Bienes</b></h3>

                </div>
                <div class="card-body">
                    <form action="{{ route('ingresos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')


                        <!-- SECCIÓN 1: Datos del Bien -->
                        <div class="card mb-3 shadow-sm">
                            <div class="card-header bg-info text-white">
                                <b>Sección 1: Datos del Bien</b>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="descripcion">Descripción del Bien:</label>
                                            <textarea class="form-control" name="descripcion" id="descripcion" rows="2" placeholder="Ingrese una descripción"
                                                required>{{ old('descripcion') }}</textarea>
                                            @error('descripcion')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="codigo_patrimonial">Código Patrimonial:</label>
                                            <div class="input-group mb-3">

                                                <input type="text" value="{{ old('codigo_patrimonial') }}"
                                                    class="form-control" id="codigo_patrimonial" name="codigo_patrimonial"
                                                    placeholder="Ingrese el código patrimonial">
                                            </div>
                                            @error('codigo_patrimonial')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="marca">Marca:</label>
                                        <input type="text" name="marca" id="marca" class="form-control"
                                            value="{{ old('marca') }}" placeholder="Ingrese la marca">
                                        @error('marca')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="modelo">Modelo:</label>
                                        <input type="text" name="modelo" id="modelo" class="form-control"
                                            value="{{ old('modelo') }}" placeholder="Ingrese el modelo">
                                        @error('modelo')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="serial">Número de serie del bien:</label>
                                        <input type="text" name="serial" id="serial" class="form-control"
                                            value="{{ old('serial') }}" placeholder="Ingrese el número de  serie">
                                        @error('serial')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <label for="color">Color:</label>
                                        <input type="text" name="color" id="color" class="form-control"
                                            value="{{ old('color') }}" placeholder="Ingrese el color">
                                        @error('color')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="medidas">Medidas:</label>
                                        <input type="text" name="medidas" id="medidas" class="form-control"
                                            value="{{ old('medidas') }}" placeholder="Ingrese las medidas">
                                        @error('medidas')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
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
                                                                    {{ old('categoria_id') == $hijo->id ? 'selected' : '' }}>
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

                                <!-- SECCIÓN 2: Datos de Ingreso / Patrimonio -->
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-header bg-warning text-dark">
                                        <b>Sección 2: Datos de Ingreso / Patrimonio</b>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="numero_doc">Número de Documento:</label>
                                                <input type="text" name="numero_doc" id="numero_doc"
                                                    class="form-control" value="{{ old('numero_doc') }}"
                                                    placeholder="Ingrese número de documento">
                                                @error('numero_doc')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <label for="tipo_documento">Tipo de Documento:</label>
                                                <input type="text" name="tipo_documento" id="tipo_documento"
                                                    class="form-control" value="{{ old('tipo_documento') }}"
                                                    placeholder="Ingrese tipo de documento">
                                                @error('tipo_documento')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <label for="fecha_adquisicion">Fecha de Adquisición:</label>
                                                <input type="date" name="fecha_adquisicion" id="fecha_adquisicion"
                                                    class="form-control" value="{{ old('fecha_adquisicion') }}" required>
                                                @error('fecha_adquisicion')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <label for="valor_inicial">Valor:</label>
                                                <input type="number" step="0.01" min="0" name="valor_inicial"
                                                    id="valor_inicial" class="form-control"
                                                    value="{{ old('valor_inicial') }}" placeholder="Ingrese valor">
                                                @error('valor_inicial')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <label for="depreciacion">Depreciación (%):</label>
                                                <input type="number" step="0.01" min="0" name="depreciacion"
                                                    id="depreciacion" class="form-control"
                                                    value="{{ old('depreciacion') }}" placeholder="Ingrese depreciación">
                                                @error('depreciacion')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <label for="area_id">Área / Ubicación:</label>
                                                <select name="area_id" class="form-control" required>
                                                    <option value="">Seleccionar área ...</option>
                                                    @foreach ($areas as $area)
                                                        <option value="{{ $area->id }}"
                                                            {{ old('area_id') == $area->id ? 'selected' : '' }}>
                                                            {{ $area->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('area_id')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <label for="estado_id">Estado:</label>
                                                <select name="estado_id" class="form-control" required>
                                                    <option value="">Seleccionar estado ...</option>
                                                    @foreach ($estados as $estado)
                                                        <option value="{{ $estado->id }}"
                                                            {{ old('estado_id') == $estado->id ? 'selected' : '' }}>
                                                            {{ $estado->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('estado_id')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <label for="director_id">Director Responsable:</label>
                                                <select name="director_id" class="form-control" required>
                                                    <option value="">Seleccionar director ...</option>
                                                    @foreach ($directores as $director)
                                                        <option value="{{ $director->id }}"
                                                            {{ old('director_id') == $director->id ? 'selected' : '' }}>
                                                            {{ $director->nombre . ' ' . $director->apellido }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('director_id')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <label for="observaciones">Observaciones:</label>
                                                <textarea name="observaciones" id="observaciones" class="form-control" rows="2"
                                                    placeholder="Ingrese observaciones">{{ old('observaciones') }}</textarea>
                                                @error('observaciones')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cantidad">Cantidad:</label>
                                        <input type="number" name="cantidad" id="cantidad" class="form-control"
                                            value="{{ old('cantidad', 1) }}" min="1" required>
                                        @error('cantidad')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>

                                <!-- Botones -->
                                <div class="form-group text-right">
                                    <a href="{{ url('/admin/ingresos') }}" class="btn btn-danger">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Historial de Bienes</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('ingresos.index') }}" class="row g-2 mb-3">
                <div class="col-md-3">
                    <select name="anio" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Seleccionar Año --</option>
                        @foreach ($anios as $anio)
                            <option value="{{ $anio }}" {{ $anioSeleccionado == $anio ? 'selected' : '' }}>
                                {{ $anio }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sin_codigo" value="1"
                            id="sin_codigo" onchange="this.form.submit()" {{ $filtroSinCodigo ? 'checked' : '' }}>
                        <label class="form-check-label" for="sin_codigo">
                            Solo sin código patrimonial
                        </label>
                    </div>
                </div>

                <div class="col-md-3 d-flex align-items-center">
                    @if (isset($totalBienes))
                        <h3 class="badge bg-primary px-4 py-3 rounded-pill fs-3 fw-bold">
                            Total bienes: {{ $totalBienes }}
                        </h3>
                    @endif
                </div>

            </form>


            <!-- Tabla de Bienes -->
            @if ($bienes->count())
                <table id="tabla-bienes" class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nro</th>
                            <th>Codigo patrimonial</th>
                            <th>Descripcion del Bien</th>
                            <th>Area-Ubicacion del Bien</th>
                            <th>Estado</th>
                            <th>Fecha de adquisicion</th>
                            <th>Nro de Documento</th>
                            <th>Tipo de Documento</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Nro de serie</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bienes as $bien)
                            <tr>
                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                <td>{{ $bien->codigo_patrimonial }}</td>
                                <td>{{ $bien->descripcion }}</td>
                                <td>{{ $bien->area?->nombre ?? 'Sin área' }}</td>
                                <td>{{ $bien->estado?->nombre ?? 'Sin estado' }}</td>
                                <td>{{ \Carbon\Carbon::parse($bien->fecha_adquisicion)->format('d/m/Y') }}</td>
                                <td>{{ $bien->numero_doc }}</td>
                                <td>{{ $bien->tipo_documento }}</td>
                                <td>{{ $bien->marca }}</td>
                                <td>{{ $bien->modelo }}</td>
                                <td>{{ $bien->serial }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">No hay bienes registrados para este año.</p>
            @endif
        </div>
    </div>


@stop

@section('css')
    <style>
        .card-header b {
            font-size: 16pt;
        }
    </style>
@stop

@section('js')
    <script>
        var tablaBienes = $('#tabla-bienes').DataTable({
            "pageLength": 5,
            "lengthMenu": [5, 10, 25],
            "language": {
                "search": "Buscar:",
                "emptyTable": "No hay bienes registrados",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    </script>
@stop
