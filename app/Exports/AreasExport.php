<?php

namespace App\Exports;

use App\Models\Biene;
use App\Models\Area;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AreasExport implements FromCollection, WithHeadings, WithStyles, WithCustomStartCell, WithColumnWidths, ShouldAutoSize
{
    protected $areaId;

    public function __construct($areaId = null)
    {
        $this->areaId = $areaId;
    }

    public function collection()
    {
        $query = Biene::with(['area', 'estado', 'director', 'categoria'])
            ->orderBy('fecha_adquisicion', 'desc');

        if ($this->areaId) {
            $query->where('area_id', $this->areaId);
        }

        $bienes = $query->get();

        return $bienes->map(function ($bien, $index) {
            return [
                $index + 1,
                $bien->codigo_patrimonial ,
                $bien->descripcion ,
                $bien->area?->nombre ?? 'Sin área',
                $bien->categoria?->nombre ?? 'Sin categoría',
                $bien->estado?->nombre ?? 'Sin estado',
                $bien->fecha_adquisicion
                    ? Carbon::parse($bien->fecha_adquisicion)->format('d/m/Y')
                    : '',
                $bien->numero_doc ,
                $bien->tipo_documento ,
                $bien->marca ,
                $bien->modelo ,
                $bien->serial ,
                $bien->medidas ,
                $bien->color ,
                number_format($bien->valor_inicial, 2),
                $bien->depreciacion ,
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
            'Área-Ubicación',
            'Categoría',
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
        return 'A6'; // Los encabezados empiezan en fila 6
    }

    public function styles(Worksheet $sheet)
    {
        $lastColumn = 'Q'; // hasta la columna "Responsable"

        // Títulos institucionales
        $sheet->mergeCells("A1:{$lastColumn}1")->setCellValue("A1", "DIRECCIÓN REGIONAL DE EDUCACIÓN - PUNO");
        $sheet->mergeCells("A2:{$lastColumn}2")->setCellValue("A2", "UGEL - SAN ROMÁN");

        $titulo = "📊 REPORTE DE BIENES POR ÁREA ";
        if ($this->areaId) {
            $area = Area::find($this->areaId);
            if ($area) {
                $titulo .= " - Área: " . $area->nombre;
            }
        }

        $sheet->mergeCells("A3:{$lastColumn}3")->setCellValue("A3", $titulo);
        $sheet->mergeCells("A4:{$lastColumn}4")->setCellValue("A4", "Generado el " . Carbon::now()->format('d/m/Y H:i'));

        $sheet->getStyle("A1:A4")->applyFromArray([
            'font' => ['bold' => true, 'size' => 14],
            'alignment' => ['horizontal' => 'center']
        ]);

        // Cabecera de la tabla
        $sheet->getStyle("A6:{$lastColumn}6")->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => 'solid', 'color' => ['rgb' => '007BFF']], // 👈 Azul bootstrap primary
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
        ]);

        // Bordes de toda la tabla
        $sheet->getStyle("A6:{$lastColumn}" . ($sheet->getHighestRow()))
            ->applyFromArray([
                'borders' => ['allBorders' => ['borderStyle' => 'thin', 'color' => ['rgb' => '000000']]]
            ]);

        // Estilo de datos
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
            'D' => 20,  // Área
            'E' => 20,  // Categoría
            'F' => 15,  // Estado
            'G' => 15,  // Fecha
            'H' => 15,  // Documento
            'I' => 12,  // Tipo Doc
            'J' => 15,  // Marca
            'K' => 15,  // Modelo
            'L' => 15,  // Serie
            'M' => 15,  // Medidas
            'N' => 12,  // Color
            'O' => 15,  // Valor Inicial
            'P' => 15,  // Depreciación
            'Q' => 25,  // Responsable
        ];
    }
}
