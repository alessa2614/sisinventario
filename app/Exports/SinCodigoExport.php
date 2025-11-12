<?php

namespace App\Exports;

use App\Models\Biene;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SinCodigoExport implements FromCollection, WithHeadings, WithStyles, WithCustomStartCell, WithColumnWidths, ShouldAutoSize
{
    public function collection()
    {
        $bienes = Biene::with(['area', 'estado', 'director', 'categoria'])
            ->whereNull('codigo_patrimonial')
            ->orderBy('fecha_adquisicion', 'desc')
            ->get();

        return $bienes->map(function ($bien, $index) {
            return [
                $index + 1,
                $bien->codigo_patrimonial,
                $bien->descripcion,
                $bien->area?->nombre ?? 'Sin área',
                $bien->estado?->nombre ?? 'Sin estado',
                $bien->fecha_adquisicion
                    ? Carbon::parse($bien->fecha_adquisicion)->format('d/m/Y')
                    : '',
                $bien->numero_doc ?? '-',
                $bien->tipo_documento ?? '-',
                $bien->marca ?? '-',
                $bien->modelo ?? '-',
                $bien->serial ?? '-',
                $bien->medidas ?? '-',
                $bien->color ?? '-',
                number_format($bien->valor_inicial, 2),
                $bien->depreciacion ?? '-',
                $bien->director
                    ? $bien->director->nombre . ' ' . $bien->director->apellido
                    : 'Sin responsable',
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
        return 'A6'; // La tabla empieza en fila 6
    }

    public function styles(Worksheet $sheet)
    {
        $lastColumn = 'P';

        // Encabezados institucionales
        $sheet->mergeCells("A1:{$lastColumn}1")->setCellValue("A1", "DIRECCIÓN REGIONAL DE EDUCACIÓN - PUNO");
        $sheet->mergeCells("A2:{$lastColumn}2")->setCellValue("A2", "UGEL - SAN ROMÁN");
        $sheet->mergeCells("A3:{$lastColumn}3")->setCellValue("A3", "📉 REPORTE DE BIENES SIN CÓDIGO PATRIMONIAL 📉");
        $sheet->mergeCells("A4:{$lastColumn}4")->setCellValue("A4", "Generado el " . Carbon::now()->format('d/m/Y H:i'));

        $sheet->getStyle("A1:A4")->applyFromArray([
            'font' => ['bold' => true, 'size' => 14],
            'alignment' => ['horizontal' => 'center']
        ]);

        // Cabecera de la tabla (fila 6)
        $sheet->getStyle("A6:{$lastColumn}6")->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => 'solid', 'color' => ['rgb' => '28A745']], // 👈 VERDE bootstrap success
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
        ]);

        // Bordes de toda la tabla
        $sheet->getStyle("A6:{$lastColumn}" . ($sheet->getHighestRow()))
            ->applyFromArray([
                'borders' => ['allBorders' => ['borderStyle' => 'thin', 'color' => ['rgb' => '000000']]]
            ]);

        // Texto de las filas de datos
        $sheet->getStyle("A7:{$lastColumn}" . $sheet->getHighestRow())
            ->applyFromArray([
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                    'wrapText' => true
                ],
                'font' => ['size' => 10]
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
