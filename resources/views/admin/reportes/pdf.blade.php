<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Bienes por Categoría</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header img {
            width: 60px;
            margin-bottom: 3px;
        }
        .header h2, .header h3, .header h4, .header p {
            margin: 1px 0;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 0.1px solid rgb(230, 230, 230);
            padding: 2px;
            text-align: center;
            font-size: 6px;
            word-wrap: break-word;
        }
        th {
            background-color: #1768e3; /* azul profesional */
            color: white;
            font-weight: bold;
        }
        .footer {
            margin-top: 10px;
            font-size: 7px;
            text-align: right;
        }
    </style>
</head>
<body>
    <!-- ENCABEZADO -->
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo"><br>
        <h2>DIRECCIÓN REGIONAL DE EDUCACIÓN - PUNO</h2>
        <h4>UGEL - SAN ROMÁN</h4>
        <h3><b>📊 REPORTE DE BIENES POR CATEGORÍA</b></h3>

        @if(isset($categoria))
            <h4>Categoría: {{ $categoria->nombre }}</h4>
        @else
            <h4>Todas las Categorías</h4>
        @endif

        <p><i>Generado el {{ \Carbon\Carbon::now()->format('d/m/Y') }}</i></p>
    </div>

    <!-- TABLA DE BIENES -->
    <table>
        <thead>
            <tr>
                <th style="width: 20px;">N°</th>
                <th style="width: 65px;">Código Patrimonial</th>
                <th style="width: 110px;">Descripción del Bien</th>
                <th style="width: 80px;">Área-Ubicación</th>
                <th style="width: 50px;">Estado</th>
                <th style="width: 55px;">Fecha Adquisición</th>
                <th style="width: 40px;">Nro Doc.</th>
                <th style="width: 40px;">Tipo Doc.</th>
                <th style="width: 50px;">Marca</th>
                <th style="width: 50px;">Modelo</th>
                <th style="width: 60px;">Nro Serie</th>
                <th style="width: 55px;">Medidas</th>
                <th style="width: 45px;">Color</th>
                <th style="width: 50px;">Precio Inicial</th>
                <th style="width: 110px;">Responsable</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bienes as $index => $bien)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $bien->codigo_patrimonial }}</td>
                    <td>{{ $bien->descripcion }}</td>
                    <td>{{ $bien->area?->nombre ?? 'Sin área' }}</td>
                    <td>{{ $bien->estado?->nombre ?? 'Sin estado' }}</td>
                    <td>{{ $bien->fecha_adquisicion ? \Carbon\Carbon::parse($bien->fecha_adquisicion)->format('d/m/Y') : '-' }}</td>
                    <td>{{ $bien->numero_doc ?? '-' }}</td>
                    <td>{{ $bien->tipo_documento ?? '-' }}</td>
                    <td>{{ $bien->marca ?? '-' }}</td>
                    <td>{{ $bien->modelo ?? '-' }}</td>
                    <td>{{ $bien->serial ?? '-' }}</td>
                    <td>{{ $bien->medidas ?? '-' }}</td>
                    <td>{{ $bien->color ?? '-' }}</td>
                    <td>S/.{{ number_format($bien->valor_inicial, 2) }}</td>
                    <td>{{ $bien->director ? $bien->director->nombre.' '.$bien->director->apellido : 'Sin responsable' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- PIE DE PÁGINA -->
    <div class="footer">
        <p>Reporte generado automáticamente por el Sistema de Inventario - {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
    </div>
</body>
</html>
