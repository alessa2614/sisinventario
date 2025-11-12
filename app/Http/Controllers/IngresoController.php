<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Biene;
use App\Models\Director;
use App\Models\Estado;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BienesImport;
use App\Exports\BienesTemplateExport;
use App\Exports\GuiaBienesExport;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Log;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $areas = Area::all();
        $estados = Estado::all();
        $directores = Director::all();
        $categorias = Categoria::all();


        // obtener lista de años disponibles
        $anios = Biene::selectRaw('YEAR(fecha_adquisicion) as anio')
            ->distinct()
            ->orderBy('anio', 'desc')
            ->pluck('anio');

        // capturar filtros
        $anioSeleccionado = $request->get('anio');
        $filtroSinCodigo = $request->get('sin_codigo'); // checkbox

        // aplicar filtros
        $bienes = Biene::when($anioSeleccionado, function ($query) use ($anioSeleccionado) {
            return $query->whereYear('fecha_adquisicion', $anioSeleccionado);
        })
            ->when($filtroSinCodigo, function ($query) {
                return $query->whereNull('codigo_patrimonial')->orWhere('codigo_patrimonial', '');
            })
            ->orderBy('fecha_adquisicion', 'desc')
            ->get();

        $totalBienes = $bienes->count();
        return view('admin.ingresos.create', compact('areas', 'estados', 'directores', 'categorias', 'anios', 'anioSeleccionado', 'filtroSinCodigo',  'bienes', 'totalBienes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = Area::all();
        $estados = Estado::all();
        $directores = Director::all();
        $categorias = Categoria::all();

        $anios = Biene::selectRaw('YEAR(fecha_adquisicion) as anio')
            ->distinct()
            ->orderBy('anio', 'desc')
            ->pluck('anio');

        $anioSeleccionado = null;
        $filtroSinCodigo = null;
        $bienes = Biene::orderBy('fecha_adquisicion', 'desc')->get();
        $totalBienes = $bienes->count();

        return view('admin.ingresos.create', compact(
            'areas',
            'estados',
            'directores',
            'categorias',
            'anios',
            'anioSeleccionado',
            'filtroSinCodigo',
            'bienes',
            'totalBienes'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required',
            'area_id' => 'required|exists:areas,id',
            'estado_id' => 'required|exists:estados,id',
            'director_id' => 'required|exists:directors,id',
            'categoria_id' => 'required|exists:categorias,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        if (($request->filled('codigo_patrimonial') || $request->filled('serial')) && $request->cantidad > 1) {
            return back()
                ->withInput()
                ->with('mensaje', 'No puedes duplicar el código patrimonial o el número de serie.')
                ->with('icono', 'error');
        }

        DB::transaction(function () use ($request) {
            for ($i = 0; $i < $request->cantidad; $i++) {
                Biene::create([
                    'codigo_patrimonial' => $request->codigo_patrimonial ?: null,
                    'descripcion' => $request->descripcion,
                    'marca' => $request->marca,
                    'modelo' => $request->modelo,
                    'serial' => $request->serial,
                    'color' => $request->color,
                    'medidas' => $request->medidas,
                    'fecha_adquisicion' => $request->fecha_adquisicion,
                    'valor_inicial' => $request->valor_inicial,
                    'area_id' => $request->area_id,
                    'estado_id' => $request->estado_id,
                    'director_id' => $request->director_id,
                    'observaciones' => $request->observaciones,
                    'categoria_id' => $request->categoria_id,
                    'numero_doc' => $request->numero_doc,
                    'tipo_documento' => $request->tipo_documento,
                ]);
            }
        });

        return redirect()->route('ingresos.create')
            ->with('mensaje', 'Bien(es) registrado(s) exitosamente.')
            ->with('icono', 'success');
    }
    /**
     * Display the specified resource.
     */
    public function show($ingreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($ingreso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $ingreso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ingreso)
    {
        //
    }
public function importarExcel(Request $request)
{
    if (!$request->hasFile('archivo_excel')) {
        return back()->with('error', 'No se seleccionó ningún archivo.');
    }

    $file = $request->file('archivo_excel');

    try {
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray(null, true, true, false);

        if (count($data) <= 1) {
            return back()->with('error', 'El archivo Excel está vacío.');
        }

        // Encabezados
        $headers = array_map(fn($h) => strtolower(trim($h)), $data[0]);

        $nuevos = 0;
        $errores = [];

        for ($i = 1; $i < count($data); $i++) {
            $filaData = $data[$i];

            // Saltar filas vacías
            if (!array_filter($filaData)) continue;

            $fila = [];
            foreach ($headers as $index => $key) {
                $fila[strtolower($key)] = isset($filaData[$index]) ? trim($filaData[$index]) : null;
            }

            // Solo validar descripcion
            if (empty($fila['descripcion'])) {
                $errores[] = ['fila' => $i + 1, 'error' => 'Descripción vacía'];
                continue;
            }

            // Normalizar fecha a YYYY-MM-DD
            $fecha = null;
            if (!empty($fila['fecha adquisicion'])) {
                $fechaTemp = \DateTime::createFromFormat('d/m/Y', $fila['fecha adquisicion']);
                if ($fechaTemp) {
                    $fecha = $fechaTemp->format('Y-m-d');
                } else {
                    $fecha = null;
                }
            }

            // Normalizar números
            $valor_inicial = isset($fila['valor inicial']) ? floatval(str_replace(',', '.', $fila['valor inicial'])) : 0;
            $depreciacion = isset($fila['depreciacion']) ? floatval(str_replace(',', '.', $fila['depreciacion'])) : 0;

            try {
                Biene::create([
                    'codigo_patrimonial' => $fila['codigo patrimonial'] ?? null,
                    'descripcion'        => $fila['descripcion'],
                    'area_id'            => $fila['ubicacion-area'] ?: null,
                    'estado_id'          => $fila['estado'] ?: null,
                    'fecha_adquisicion'  => $fecha,
                    'numero_doc'         => $fila['nro documento'] ?? null,
                    'tipo_documento'     => $fila['tipo documento'] ?? null,
                    'marca'              => $fila['marca'] ?? null,
                    'modelo'             => $fila['modelo'] ?? null,
                    'serial'             => $fila['nro de serie'] ?? null,
                    'medidas'            => $fila['medidas'] ?? null,
                    'color'              => $fila['color'] ?? null,
                    'categoria_id'       => $fila['categoria'] ?: null,
                    'valor_inicial'      => $valor_inicial,
                    'depreciacion'       => $depreciacion,
                    'director_id'        => $fila['responsable'] ?: null,
                    'observaciones'      => $fila['observaciones'] ?? null,
                ]);
                $nuevos++;
            } catch (\Exception $e) {
                $errores[] = ['fila' => $i + 1, 'error' => $e->getMessage()];
            }
        }

        // Guardar errores en log
        if (!empty($errores)) {
            foreach ($errores as $err) {
                Log::error("Fila {$err['fila']}: {$err['error']}");
            }
        }

        return back()->with('success', "✅ Bienes importados correctamente: {$nuevos}. Filas con errores: " . count($errores) . ". Revisa el log.");

    } catch (\Exception $e) {
        Log::error('Error al importar Excel: ' . $e->getMessage());
        return back()->with('error', '❌ Error al procesar el archivo: ' . $e->getMessage());
    }
}


    public function plantilla()
    {
        return Excel::download(new BienesTemplateExport, 'plantilla_bienes.xlsx');
    }
    public function descargarGuia()
    {
        return Excel::download(new GuiaBienesExport, 'guia_bienes.xlsx');
    }
}
