<?php

namespace App\Imports;

use App\Models\Biene;
use App\Models\Categoria;
use App\Models\Area;
use App\Models\Estado;
use App\Models\Director;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Throwable;

class BienesImport implements OnEachRow, WithHeadingRow, SkipsOnError, WithChunkReading
{
    use SkipsErrors;

    public function onRow($row)
    {
        $data = $row->toArray();

        // Evitar filas vacías
        if (empty($data['descripcion']) && empty($data['codigo_patrimonial'])) {
            return;
        }

        try {
            // Buscar relaciones
            $categoria = Categoria::where('nombre', trim($data['categoria'] ?? ''))->first();
            $area = Area::where('nombre', trim($data['area'] ?? ''))->first();
            $estado = Estado::where('nombre', trim($data['estado'] ?? ''))->first();
            $director = Director::where('nombre', trim($data['director'] ?? ''))->first();

            // ✅ Convertir la fecha
            $fecha = $this->parseFecha($data['fecha_adquisicion'] ?? null);

            // Insertar fila individual
            Biene::create([
                'codigo_patrimonial' => $data['codigo_patrimonial'] ?? null,
                'descripcion'        => $data['descripcion'] ?? '',
                'marca'              => $data['marca'] ?? null,
                'modelo'             => $data['modelo'] ?? null,
                'serial'             => $data['serial'] ?? null,
                'color'              => $data['color'] ?? null,
                'medidas'            => $data['medidas'] ?? null,
                'categoria_id'       => $categoria?->id,
                'area_id'            => $area?->id,
                'estado_id'          => $estado?->id,
                'director_id'        => $director?->id,
                'fecha_adquisicion'  => $fecha, // fecha ya validada
                'valor_inicial'      => $data['valor_inicial'] ?? 0,
                'depreciacion'       => $data['depreciacion'] ?? 0,
                'observaciones'      => $data['observaciones'] ?? null,
            ]);

        } catch (Throwable $e) {
            // ⚠️ Registrar error pero continuar
            Log::warning("Error en fila {$row->getIndex()}: " . $e->getMessage());
        }
    }

    /**
     * ✅ Conversión segura de fechas (texto o formato Excel)
     */
    private function parseFecha($valor)
    {
        if (empty($valor)) {
            return null;
        }

        // Si es numérico (fecha Excel)
        if (is_numeric($valor)) {
            try {
                return Date::excelToDateTimeObject($valor)->format('Y-m-d');
            } catch (\Exception $e) {
                return null;
            }
        }

        // Si viene como texto dd/mm/yyyy o dd-mm-yyyy
        $valor = str_replace('-', '/', trim($valor));
        $fechaObj = \DateTime::createFromFormat('d/m/Y', $valor);

        if ($fechaObj && $fechaObj->format('d/m/Y') === $valor) {
            return $fechaObj->format('Y-m-d');
        }

        // Fecha inválida (como 31/09/2016)
        return null;
    }

    /**
     * Procesar por bloques para evitar desbordamiento de memoria
     */
    public function chunkSize(): int
    {
        return 100; // procesa 100 filas por bloque
    }
}
