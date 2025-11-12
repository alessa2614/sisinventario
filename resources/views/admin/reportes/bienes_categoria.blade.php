@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Reporte de Bienes - Categoría: {{ $categoria->nombre }}</h1>

    {{-- Botones de exportación --}}
    <div class="mb-3">
        <a href="{{ route('reportes.bienes.categoria.excel', $categoria->id) }}" class="btn btn-success">
            <i class="fas fa-file-excel"></i> Exportar Excel
        </a>
        <a href="{{ route('reportes.bienes.categoria.pdf', $categoria->id) }}" class="btn btn-danger">
            <i class="fas fa-file-pdf"></i> Exportar PDF
        </a>
        <a href="{{ route('reportes.bienes') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver al reporte general
        </a>
    </div>

    {{-- Tabla de bienes --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Serial</th>
                    <th>Color</th>
                    <th>Medidas</th>
                    <th>Fecha Adquisición</th>
                    <th>Valor Inicial</th>
                    <th>Área</th>
                    <th>Estado</th>
                    <th>Director</th>
                    <th>Categoría</th>
                    <th>Observaciones</th>
                    <th>Número Documento</th>
                    <th>Tipo Documento</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bienes as $b)
                <tr>
                    <td>{{ $b->marca }}</td>
                    <td>{{ $b->modelo }}</td>
                    <td>{{ $b->serial }}</td>
                    <td>{{ $b->color }}</td>
                    <td>{{ $b->medidas }}</td>
                    <td>{{ $b->fecha_adquisicion ? \Carbon\Carbon::parse($b->fecha_adquisicion)->format('d/m/Y') : '' }}</td>
                    <td>{{ $b->valor_inicial }}</td>
                    <td>{{ $b->area->nombre ?? '' }}</td>
                    <td>{{ $b->estado->nombre ?? '' }}</td>
                    <td>{{ $b->director->nombre ?? '' }}</td>
                    <td>{{ $b->categoria->nombre ?? '' }}</td>
                    <td>{{ $b->observaciones }}</td>
                    <td>{{ $b->numero_doc }}</td>
                    <td>{{ $b->tipo_documento }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="14" class="text-center">No se encontraron bienes en esta categoría.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
