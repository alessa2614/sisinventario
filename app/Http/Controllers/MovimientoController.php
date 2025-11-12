<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use App\Models\Biene;
use App\Models\Area;
use App\Models\Estado;
use App\Models\Director;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MovimientoController extends Controller
{
    // Página principal
    public function index(Request $request)
    {
        $areas = Area::all();
        $estados = Estado::all();
        $directores = Director::all();
        $categorias = Categoria::all();

        $anioSeleccionado = $request->get('anio');

        // Obtener todos los bienes con sus movimientos
        $bienes = Biene::with(['area', 'estado', 'director', 'movimientos.areaAnterior', 'movimientos.areaNueva'])->get();

        $movimientosFiltrados = $bienes->flatMap(function ($bien) use ($anioSeleccionado) {
            return $bien->movimientos()
                ->when($anioSeleccionado, function ($q) use ($anioSeleccionado) {
                    $q->whereYear('fecha', $anioSeleccionado);
                })
                ->orderBy('fecha', 'desc')
                ->get()
                ->map(function ($mov) use ($bien) {
                    return (object)[
                        'id' => $mov->id,
                        'bien_id' => $bien->id,
                        'codigo_patrimonial' => $bien->codigo_patrimonial ?? '',
                        'descripcion' => $bien->descripcion ?? '',
                        'serial' => $bien->serial ?? '',
                        'area_anterior' => $mov->areaAnterior?->nombre ?? 'Sin área',
                        'area_nueva' => $mov->areaNueva?->nombre ?? 'Sin área',
                        'director' => ($bien->director?->nombre ?? '') . ' ' . ($bien->director?->apellido ?? ''),
                        'fecha' => $mov->fecha ?? '',
                        'observaciones' => $mov->observaciones ?? '',
                    ];
                });
        });


        $totalMovimientos = $movimientosFiltrados->count();

        $anios = Movimiento::selectRaw('YEAR(fecha) as anio')
            ->distinct()
            ->orderBy('anio', 'desc')
            ->pluck('anio');

        return view('admin.movimientos.index', compact('areas','estados','directores','categorias',
            'bienes','anios','anioSeleccionado','totalMovimientos','movimientosFiltrados'));
    }

    // Buscador en tiempo real
    public function buscar(Request $request)
    {
        $query = trim($request->input('q'));
        if (empty($query)) {
            return response()->json(['status' => 'error', 'mensaje' => 'Ingrese un término de búsqueda.']);
        }

        $bienes = Biene::with(['area', 'estado', 'director'])
            ->where(function ($q) use ($query) {
                $q->where('codigo_patrimonial', 'like', "%$query%")
                    ->orWhere('serial', 'like', "%$query%")
                    ->orWhere('descripcion', 'like', "%$query%");
            })->get();

        if ($bienes->isEmpty()) {
            return response()->json(['status' => 'error', 'mensaje' => 'No se encontraron bienes.']);
        }

        // Transformar para que el JS solo reciba strings
        $bienes->transform(function ($bien) {
            return [
                'id' => $bien->id,
                'codigo_patrimonial' => $bien->codigo_patrimonial,
                'descripcion' => $bien->descripcion,
                'area' => $bien->area?->nombre ?? 'Sin área',
                'estado' => $bien->estado?->nombre ?? 'Sin estado',
                'marca' => $bien->marca ?? '',
                'modelo' => $bien->modelo ?? '',
                'serial' => $bien->serial ?? '',
                'color' => $bien->color ?? '',
                'director' => ($bien->director?->nombre ?? '') . ' ' . ($bien->director?->apellido ?? ''),
            ];
        });

        return response()->json(['status' => 'ok', 'bienes' => $bienes]);
    }

    // Registrar un nuevo movimiento
    public function store(Request $request, $bien_id)
    {
        $request->validate([
            'area_nueva' => 'required|exists:areas,id',
            'observaciones' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $bien = Biene::findOrFail($bien_id);

            // Obtener el último movimiento del bien
            $ultimoMovimiento = $bien->movimientos()->latest()->first();
            $areaAnterior = $ultimoMovimiento ? $ultimoMovimiento->area_nueva : $bien->area_id;

            // Crear nuevo movimiento
            $mov = new Movimiento();
            $mov->bien_id = $bien->id;
            $mov->fecha = Carbon::now()->format('Y-m-d');
            $mov->area_anterior = $areaAnterior; 
            $mov->area_nueva = $request->area_nueva;
            $mov->observaciones = $request->observaciones ?? '';
            $mov->save();

            // Actualizar área actual del bien
            $bien->area_id = $request->area_nueva;
            $bien->save();

            DB::commit();
            return redirect()->route('movimientos.index')
                ->with('mensaje', 'Movimiento registrado correctamente.')
                ->with('icono', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('movimientos.index')
                ->with('mensaje', 'Error al registrar movimiento: ' . $e->getMessage())
                ->with('icono', 'error');
        }
    }


    public function historial($bien_id)
    {
        $movimientos = Movimiento::with(['areaAnterior', 'areaNueva'])
            ->where('bien_id', $bien_id)
            ->orderBy('fecha', 'desc')
            ->get();

        return view('admin.movimientos.historial', compact('movimientos', 'bien_id'));
    }
}
