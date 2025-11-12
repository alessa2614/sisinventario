<?php

namespace App\Exports;

use App\Models\Biene;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BienesBajaExport implements FromCollection, WithHeadings, WithStyles, WithCustomStartCell, WithColumnWidths
{
    public function collection()
    {
        $bienes = Biene::with(['area', 'estado', 'director', 'categoria'])
            ->whereHas('estado', fn($q) => $q->where('nombre', 'Malo'))
            ->orderBy('fecha_adquisicion', 'desc')
            ->get();

        return $bienes->map(function ($bien, $index) {
            return [
                'Nro'                => $index + 1,
                'Código Patrimonial' => $bien->codigo_patrimonial,
                'Descripción del Bien'        => $bien->descripcion,
                'Área-Ubicacion'               => $bien->area?->nombre ?? 'Sin área',
                'Estado'             => $bien->estado?->nombre ?? 'Sin estado',
                'Fecha Adquisición'  => $bien->fecha_adquisicion
                    ? Carbon::parse($bien->fecha_adquisicion)->format('d/m/Y')
                    : '',
                'Nro Documento'          => $bien->numero_doc ?? '-',
                'Tipo Documento'           => $bien->tipo_documento ?? '-',
                'Marca'              => $bien->marca ?? '-',
                'Modelo'             => $bien->modelo ?? '-',
                'Nro de Serie'              => $bien->serial ?? '-',
                'Medidas'            => $bien->medidas ?? '-',
                'Color'              => $bien->color ?? '-',
                'Valor Inicial'      => number_format($bien->valor_inicial, 2),
                'Depreciación'       => $bien->depreciacion ?? '-',
                'Responsable'        => $bien->director
                    ? $bien->director->nombre . ' ' . $bien->director->apellido
                    : 'Sin director',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nro',
            'Código Patrimonial',
            'Descripción del Bien',
            'Área-Ubicacion',
            'Estado',
            'Fecha Adquisición',
            'Nro Documento',
            'Tipo Documento',
            'Marca',
            'Modelo',
            'Nro de Serie',
            'Medidas',
            'Color',
            'Valor Inicial',
            'Depreciación',
            'Responsable',
        ];
    }

    public function startCell(): string
    {
        return 'A6'; // tabla empieza en la fila 6
    }

    public function styles(Worksheet $sheet)
    {
        $lastColumn = 'P';

        // Encabezados institucionales
        $sheet->mergeCells("A1:{$lastColumn}1")->setCellValue("A1", "DIRECCIÓN REGIONAL DE EDUCACIÓN - PUNO");
        $sheet->mergeCells("A2:{$lastColumn}2")->setCellValue("A2", "UGEL - SAN ROMÁN");
        $sheet->mergeCells("A3:{$lastColumn}3")->setCellValue("A3", "📉 REPORTE DE BIENES DADOS DE BAJA");
        $sheet->mergeCells("A4:{$lastColumn}4")->setCellValue("A4", "Generado el " . Carbon::now()->format('d/m/Y H:i'));

        $sheet->getStyle("A1:A4")->applyFromArray([
            'font' => ['bold' => true, 'size' => 14],
            'alignment' => ['horizontal' => 'center']
        ]);

        // Cabecera de la tabla
        $sheet->getStyle("A6:{$lastColumn}6")->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => 'solid', 'color' => ['rgb' => 'DC3545']],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
        ]);

        // Bordes de la tabla
        $sheet->getStyle("A6:{$lastColumn}" . ($sheet->getHighestRow()))
            ->applyFromArray([
                'borders' => ['allBorders' => ['borderStyle' => 'thin', 'color' => ['rgb' => '000000']]]
            ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,   // Nro
            'B' => 18,  // Código Patrimonial
            'C' => 30,  // Descripción
            'D' => 15,  // Área
            'E' => 12,  // Estado
            'F' => 15,  // Fecha
            'G' => 15,  // Documento
            'H' => 12,  // Tipo Doc
            'I' => 15,  // Marca
            'J' => 15,  // Modelo
            'K' => 15,  // Serie
            'L' => 15,  // Medidas
            'M' => 12,  // Color
            'N' => 15,  // Valor Inicial
            'O' => 15,  // Depreciación
            'P' => 25,  // Responsable
        ];
    }
}
