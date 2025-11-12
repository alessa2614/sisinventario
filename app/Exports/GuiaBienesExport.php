<?php

namespace App\Exports;

use App\Models\Categoria;
use App\Models\Area;
use App\Models\Estado;
use App\Models\Director;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class GuiaBienesExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new \App\Exports\SimpleSheetExport(
                Categoria::select('id', 'nombre')->get(),
                ['ID', 'Nombre'],
                'Categorías'
            ),
            new \App\Exports\SimpleSheetExport(
                Area::select('id', 'nombre')->get(),
                ['ID', 'Nombre'],
                'Áreas'
            ),
            new \App\Exports\SimpleSheetExport(
                Estado::select('id', 'nombre')->get(),
                ['ID', 'Nombre'],
                'Estados'
            ),
            new \App\Exports\SimpleSheetExport(
                Director::select('id', 'nombre','apellido')->get(),
                ['ID', 'Nombre','Apellido'],
                'Directores'
            ),
        ];
    }
}
