<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class BienesTemplateExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'Codigo Patrimonial',
            'Descripcion',
            'Ubicacion-Area',
            'Estado',
            'Fecha Adquisicion',
            'Nro Documento',
            'Tipo Documento',
            'Marca',
            'Modelo',
            'Nro de Serie',
            'Medidas',
            'Color',
            'Categoria',
            'Valor Inicial',
            'Depreciacion',
            'Responsable',
            'Observaciones',
        ];
    }

    public function collection()
    {
        return new Collection([
            [
                'CP-001',                 // codigo_patrimonial
                'Laptop HP 14"',          // descripcion
                1,                        // area_id
                1,                        // estado_id
                '2024-10-10',             // fecha_adquisicion
                'DOC-2024-001',           // numero_doc
                'Factura',                // tipo_documento
                'HP',                     // marca
                '14s-dk2000la',           // modelo
                'SN12345',                // serial
                '14 pulgadas',            // medidas
                'Gris',                   // color
                1,                        // categoria_id
                2500,                     // valor_inicial
                10,                       // depreciacion
                1,                        // director_id
                'Equipo nuevo',           // observaciones
            ],
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        
        $sheet->getStyle('A1:R1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'], 
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '5BC0DE'], 
            ],
        ]);

        //bordes
        $lastRow = $sheet->getHighestRow();
        $lastCol = $sheet->getHighestColumn();

        $sheet->getStyle("A1:{$lastCol}{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        
        $sheet->getStyle('A1:R' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        
        $sheet->getRowDimension(1)->setRowHeight(25);

        return [];
    }
}
