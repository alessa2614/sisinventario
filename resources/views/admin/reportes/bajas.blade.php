@extends('adminlte::page')

@section('title', 'Reporte de Bienes Dados de Baja')

@section('content_header')
    <h1 class="text-center">📉 Reporte de Bienes Dados de Baja</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card  card-danger">
                <div class="card-header">
                    <h3 class="card-title"><b>Bienes Dados de Baja</b></h3>
                </div>

                <div class="card-body table-responsive">
                    <div class="reporte-encabezado text-center mb-4">
                        <h2>DIRECCIÓN REGIONAL DE EDUCACIÓN - PUNO</h2>
                        <h4>UGEL - SAN ROMÁN</h4>
                        <h3><b>📉 REPORTE DE BIENES DADOS DE BAJA</b></h3>
                        <p><i>Generado el {{ \Carbon\Carbon::now()->format('d/m/Y ') }}</i></p>
                    </div>

                    <table id="example1" class="table table-head-fixed text-nowrap table-bordered table-hover">
                        <thead class="bg-danger ">
                            <tr style="color:rgb(11, 11, 11)">
                                <th>Nro</th>
                                <th>Código Patrimonial</th>
                                <th>Descripción del Bien</th>
                                <th>Área - Ubicación</th>
                                <th>Estado</th>
                                <th>Fecha de Adquisición</th>
                                <th>N° Documento</th>
                                <th>Tipo Documento</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>N° Serie</th>
                                <th>Medidas</th>
                                <th>Color</th>
                                <th>Valor de Adquisición</th>
                                <th>Depreciación</th>
                                <th>Responsable</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bienes as $bien)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $bien->codigo_patrimonial ?? 'Sin código' }}</td>
                                    <td>{{ $bien->descripcion }}</td>
                                    <td>{{ $bien->area?->nombre ?? 'Sin área' }}</td>
                                    <td><span class="badge bg-danger">{{ $bien->estado?->nombre ?? 'Sin estado' }}</span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($bien->fecha_adquisicion)->format('d/m/Y') }}</td>
                                    <td>{{ $bien->numero_doc ?? '-' }}</td>
                                    <td>{{ $bien->tipo_documento ?? '-' }}</td>
                                    <td>{{ $bien->marca ?? '-' }}</td>
                                    <td>{{ $bien->modelo ?? '-' }}</td>
                                    <td>{{ $bien->serial ?? '-' }}</td>
                                    <td>{{ $bien->medidas ?? '-' }}</td>
                                    <td>{{ $bien->color ?? '-' }}</td>
                                    <td>S/. {{ number_format($bien->valor_inicial, 2) }}</td>
                                    <td>{{ $bien->depreciacion ?? '-' }}</td>
                                    <td>{{ $bien->director?->nombre . ' ' . $bien->director?->apellido ?? 'Sin director' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="16" class="text-center text-muted">No hay bienes dados de baja</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@stop

@section('css')
    <style>
        @media print {
            body {
                font-family: Arial, sans-serif;
                font-size: 12pt;
            }

            .reporte-encabezado {
                text-align: center;
                margin-bottom: 20px;
            }

            .reporte-encabezado img {
                margin-bottom: 10px;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            table,
            th,
            td {
                border: 1px solid black;
            }

            th {
                background: #f2f2f2 !important;
                -webkit-print-color-adjust: exact;
                /* Para mantener color en PDF */
            }

            .btn,
            .card-header,
            .no-print {
                display: none !important;
                /* Ocultar botones al imprimir */
            }
        }
  /* Estilo personalizado para los botones */
        #example1_wrapper .btn {
            color: #fff;
            /* Color del texto en blanco */
            border-radius: 4px;
            /* Bordes redondeados */
            padding: 5px 15px;
            /* Espaciado interno */
            font-size: 14px;
            /* TamaÃ±o de fuente */
        }

        /* Colores por tipo de botÃ³n */
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #212529;
            border: none;
        }

        .btn-default {
            background-color: #6e7176;
            color: #212529;
            border: none;
        }

        #example1 th {
            white-space: normal !important;
            /* Permite salto de línea */
            word-wrap: break-word;
            /* Ajusta palabras largas */
            max-width: 120px;
            /* Controla el ancho máximo de cada columna */
            text-align: center;
            /* Centra el texto */
            vertical-align: middle;
            /* Centra verticalmente */
        }
    </style>

@stop

@section('js')
<script>
$(function() {
    let now = new Date();
    let fecha = now.toLocaleDateString("es-PE") + " " + now.toLocaleTimeString("es-PE");

    $("#example1").DataTable({
        "pageLength": 10,
        "language": {
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros",
            "infoFiltered": "(Filtrado de _MAX_ registros en total)",
            "lengthMenu": "Mostrar _MENU_ registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscador:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        dom: 'Bfrtip',
        buttons: [
            {
                text: '<i class="fas fa-copy"></i> COPIAR',
                extend: 'copy',
                className: 'btn btn-default',
                exportOptions: { columns: ':visible', modifier: { page: 'all' } }
            },
            {
                text: '<i class="fas fa-file-excel"></i> EXCEL',
                className: 'btn btn-success',
                action: function() {
                    window.location.href = "{{ route('reportes.bajas.excel') }}";
                }
            },
            {
                text: '<i class="fas fa-file-pdf"></i> PDF',
                className: 'btn btn-danger',
                action: function() {
                    window.location.href = "{{ route('reportes.bienes_baja_pdf') }}";
                }
            },
            {
                text: '<i class="fas fa-print"></i> IMPRIMIR',
                extend: 'print',
                className: 'btn btn-warning',
                exportOptions: { columns: ':visible', modifier: { page: 'all' } },
                customize: function (win) {
                    $(win.document.body).css('font-size','12px').prepend(`
                        <div style="text-align:center; margin-bottom:20px;">
                            <img src="{{ asset('images/logo.png') }}" width="80"><br>
                            <h2 style="margin:0;">DIRECCIÓN REGIONAL DE EDUCACIÓN - PUNO</h2>
                            <h4 style="margin:0;">UGEL - SAN ROMÁN</h4>
                            <h3 style="margin:10px 0;"><b>📉 REPORTE DE BIENES DADOS DE BAJA</b></h3>
                            <p><i>Generado el: ${fecha}</i></p>
                        </div>
                    `);

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size','12px')
                        .css('border','1px solid black')
                        .css('border-collapse','collapse')
                        .css('width','100%');

                    $(win.document.body).find('table th, table td')
                        .css('border','1px solid black')
                        .css('padding','4px');
                }
            }
        ]
    }).buttons().container().appendTo('#example1_wrapper .row:eq(0)');
});
</script>
@stop
