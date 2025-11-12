@extends('adminlte::page')

@section('title', 'Reporte de Bienes por Áreas')

@section('content_header')
    <h1 class="text-center">📊 Reporte de Bienes por Áreas</h1>
@stop

@section('content')
    <div class="row">
        @foreach($areas as $area)
            <div class="col-md-12">
                <div class="card card-success card-outline mb-4 collapsed-card">
    <div class="card-header">
        <div class="row w-100 align-items-center">
            <!-- Columna: Nombre del área -->
            <div class="col-md-6 col-sm-12">
                <h3 class="card-title mb-0"><b>Área: {{ $area->nombre }}</b></h3>
            </div>

            <!-- Columna: Botones -->
            <div class="col-md-5 col-sm-12 d-flex justify-content-end align-items-center">
                <!-- Botones generados por DataTables -->
                <div id="dt-btns-{{ $area->id }}" class="mr-3 dt-btns-container"></div>

                <!-- Botones de exportación -->
                <div class="btn-group btn-group-sm" role="group" aria-label="Exportar">
                    <button type="button" class="btn btn-success export-excel" data-area="{{ $area->id }}">
                        <i class="fas fa-file-excel"></i> Excel
                    </button>
                    <button type="button" class="btn btn-danger export-pdf" data-area="{{ $area->id }}">
                        <i class="fas fa-file-pdf"></i> PDF
                    </button>
                    <button type="button" class="btn btn-warning print-area" data-area="{{ $area->id }}">
                        <i class="fas fa-print"></i> Imprimir
                    </button>
                </div>
            </div>

            <!-- Columna: Botón colapsar -->
            <div class="col-md-1 col-sm-12 text-right">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>



                    <div class="card-body table-responsive">
                        <div class="reporte-encabezado text-center mb-4">
                            <h2>DIRECCIÓN REGIONAL DE EDUCACIÓN - PUNO</h2>
                            <h4>UGEL - SAN ROMÁN</h4>
                            <h3><b>📊 REPORTE DE BIENES DEL ÁREA: {{ $area->nombre }}</b></h3>
                            <p><i>Generado el {{ \Carbon\Carbon::now()->format('d/m/Y') }}</i></p>
                        </div>

                        <table id="tabla-area-{{ $area->id }}" class="table table-bordered table-hover datatable-area" style="width:100%;">
                            <thead class="bg-primary text-center">
                                <tr>
                                    <th style="width:40px">Nro</th>
                                    <th style="width:120px">Código Patrimonial</th>
                                    <th style="min-width:200px">Descripción del Bien</th>
                                    <th style="min-width:100px">Área</th>
                                    <th style="width:100px">Estado</th>
                                    <th style="width:90px">Fecha Adquisición</th>
                                    <th style="width:90px">N° Documento</th>
                                    <th style="width:110px">Tipo Documento</th>
                                    <th style="width:90px">Marca</th>
                                    <th style="min-width:100px">Modelo</th>
                                    <th style="width:100px">N° Serie</th>
                                    <th style="width:90px">Medidas</th>
                                    <th style="width:80px">Color</th>
                                    <th style="width:110px">Valor Adquisición</th>
                                    <th style="width:90px">Depreciación</th>
                                    <th style="width:160px">Responsable</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // Filtramos la colección de bienes pasados desde el controlador
                                    $bienesArea = $bienes->where('area_id', $area->id);
                                @endphp

                                @forelse ($bienesArea as $bien)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $bien->codigo_patrimonial ?? '-' }}</td>
                                        <td >{{ $bien->descripcion }}</td>
                                        <td>{{ $area->nombre }}</td>
                                        <td>{{ $bien->estado?->nombre ?? '-' }}</td>
                                        <td>{{ $bien->fecha_adquisicion ? \Carbon\Carbon::parse($bien->fecha_adquisicion)->format('d/m/Y') : '-' }}</td>
                                        <td>{{ $bien->numero_doc ?? '-' }}</td>
                                        <td>{{ $bien->tipo_documento ?? '-' }}</td>
                                        <td>{{ $bien->marca ?? '-' }}</td>
                                        <td>{{ $bien->modelo ?? '-' }}</td>
                                        <td>{{ $bien->serial ?? '-' }}</td>
                                        <td>{{ $bien->medidas ?? '-' }}</td>
                                        <td>{{ $bien->color ?? '-' }}</td>
                                        <td class="text-right">S/. {{ number_format($bien->valor_inicial ?? 0, 2) }}</td>
                                        <td class="text-center">{{ $bien->depreciacion ?? '-' }}</td>
                                        <td>{{ $bien->director?->nombre . ' ' . $bien->director?->apellido ?? 'Sin director' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="16" class="text-center text-muted">No hay bienes en esta área</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
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
document.addEventListener('DOMContentLoaded', function () {
    // Rutas del servidor (ajusta si tus nombres de rutas son distintos)
    const excelRouteBase = "{{ route('reportes.areas.excel') }}"; // recibirá ?area_id=...
    const pdfRouteBase   = "{{ route('reportes.areas_pdf') }}";  // recibirá ?area_id=...

    // Inicializa cada tabla con clase .datatable-area
    document.querySelectorAll('.datatable-area').forEach(function(tableElem) {
        try {
            const $table = $(tableElem);
            // Asegura ID único
            const id = $table.attr('id') || ('tabla-area-' + Math.floor(Math.random() * 99999));
            $table.attr('id', id);
            const areaId = id.replace('tabla-area-', '');

            // Si ya estaba inicializada, destrúyela (evita inicializaciones dobles)
            if ( $.fn.dataTable.isDataTable('#' + id) ) {
                $('#' + id).DataTable().clear().destroy();
            }

            // Opciones DataTables: forzamos paginación, length, etc.
            const dt = $table.DataTable({
                paging: true,
                pageLength: 5,
                lengthChange: true,
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true,
                deferRender: true,
                dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" + "Brtip", // coloca length + filter arriba, buttons antes de table
                buttons: [
                    
                ],
                language: {
                    search: "Buscar:",
                    lengthMenu: "Mostrar _MENU_",
                    info: "Mostrando _START_ a _END_ de _TOTAL_",
                    paginate: { previous: "Anterior", next: "Siguiente", first: "Primero", last: "Último" },
                    zeroRecords: "Sin resultados",
                    infoEmpty: "Mostrando 0 a 0 de 0",
                    infoFiltered: "(filtrado de _MAX_)"
                },
                initComplete: function() {
                    // Mover boton copy (solo el copy de DataTables) al header específico del card
                    try {
                        const containerId = '#dt-btns-' + areaId;
                        const $target = $(containerId);
                        if ($target.length) {
                            dt.buttons().container().appendTo($target);
                        } else {
                            // si no existe dt-btns-<areaId>, intenta ponerlo al header del card
                            $table.closest('.card').find('.card-header .dt-btns-container').append(dt.buttons().container());
                        }
                    } catch(e) {
                        console.warn('No se pudo mover los botones DT para area ' + areaId, e);
                    }
                }
            });

            // DEBUG: escribe en consola (puedes quitar luego)
            console.log('DataTable inicializado para:', id, 'rows:', dt.rows().count());

        } catch (err) {
            // Si falla una tabla no rompas las demás
            console.error('Error inicializando tabla', tableElem, err);
        }
    });

    // Export Excel por área (botón del card) - va a la ruta definida, pasando area_id
    document.querySelectorAll('.export-excel').forEach(function(btn){
        btn.addEventListener('click', function(){
            const area = this.dataset.area;
            // Redirige a la ruta Excel con el parámetro
            window.location.href = excelRouteBase + '?area_id=' + encodeURIComponent(area);
        });
    });

    // Export PDF por área (botón del card) - redirige con parámetro
    document.querySelectorAll('.export-pdf').forEach(function(btn){
        btn.addEventListener('click', function(){
            const area = this.dataset.area;
            window.location.href = pdfRouteBase + '?area_id=' + encodeURIComponent(area);
        });
    });

    // Imprimir por área: monta la tabla completa (ignora paginación, muestra todo)
document.querySelectorAll('.print-area').forEach(function(btn){
    btn.addEventListener('click', function(){
        const areaId = this.dataset.area;
        const selector = '#tabla-area-' + areaId;
        if (!$.fn.dataTable.isDataTable(selector)) {
            alert('La tabla de esta área no está inicializada aún.');
            return;
        }
        const dt = $(selector).DataTable();

        // Clonamos la tabla completa directamente desde el DOM original
        const $clonedTable = $(selector).clone();

        // Quitamos clases de DataTables que rompen el formato
        $clonedTable.removeClass('dataTable no-footer dtr-inline collapsed');

        // OPCIONAL: Definir anchos de columnas con colgroup
        // Ajusta los valores (%) o px según tu tabla
        const colgroup = `
            <colgroup>
                <col style="width:5%;">    <!-- Columna N° -->
                <col style="width:15%;">   <!-- Código Patrimonial -->
                <col style="width:25%;">   <!-- Descripción -->
                <col style="width:10%;">   <!-- Estado -->
                <col style="width:10%;">   <!-- Categoría -->
                <col style="width:10%;">   <!-- Área -->
                <col style="width:10%;">   <!-- Director -->
                <col style="width:10%;">    <!-- Columna N° -->
                <col style="width:10%;">   <!-- Código Patrimonial -->
                <col style="width:10%;">   <!-- Descripción -->
                <col style="width:10%;">   <!-- Estado -->
                <col style="width:10%;">   <!-- Categoría -->
                <col style="width:10%;">   <!-- Área -->
                <col style="width:10%;">   <!-- Director -->
                <col style="width:5%;">   <!-- Área -->
                <col style="width:15%;">   <!-- Director -->
            </colgroup>
        `;
        $clonedTable.prepend(colgroup);

        // Header personalizado
        const title = $('#tabla-area-' + areaId).closest('.card').find('.card-title').text().trim();
        const headerHTML = `
            <div style="text-align:center; margin-bottom:8px;">
                <img src="{{ asset('images/logo.png') }}" width="60" alt="Logo" style="display:block;margin:0 auto 4px;">
                <h2 style="margin:0; font-size:14px;">DIRECCIÓN REGIONAL DE EDUCACIÓN - PUNO</h2>
                <h4 style="margin:0; font-size:12px;">UGEL - SAN ROMÁN</h4>
                <h3 style="margin:6px 0; font-size:13px;"><b>${escapeHtml(title)}</b></h3>
                <p style="margin:0; font-size:10px;"><i>Generado: ${new Date().toLocaleString('es-PE')}</i></p>
            </div>
        `;

        // Ventana de impresión
        const w = window.open('', '_blank', 'width=1200,height=900,scrollbars=yes');
        w.document.write('<html><head><title>Imprimir</title>');
        w.document.write(`
            <style>
                body { font-family: Arial, sans-serif; font-size: 9px; }
                table { width:100%; border-collapse: collapse; font-size: 7px; table-layout: fixed; }
                th, td { border: 1px solid #000; padding: 2px; text-align: center; vertical-align: middle; word-wrap: break-word; }
                th { background: #f2f2f2; -webkit-print-color-adjust: exact; }
                img { margin-bottom: 6px; }
            </style>
        `);
        w.document.write('</head><body>');
        w.document.write(headerHTML);
        w.document.write($clonedTable.prop('outerHTML'));
        w.document.write('</body></html>');
        w.document.close();
        w.focus();
        w.print();
    });


});


    // Helper
    function escapeHtml(text) {
        return $('<div>').text(text).html();
    }

});
</script>

@stop
