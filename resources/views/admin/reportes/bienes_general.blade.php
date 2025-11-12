<!-- resources/views/admin/reportes/bienes_general.blade.php -->

@extends('layouts.app')

@section('content')
<h1>Reporte General de Bienes</h1>

@if(session('error'))
    <div style="color:red;">{{ session('error') }}</div>
@endif

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
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
        @foreach($bienes as $b)
        <tr>
            <td>{{ $b->id }}</td>
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
        @endforeach
    </tbody>
</table>
@endsection
