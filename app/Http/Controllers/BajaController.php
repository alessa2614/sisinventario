<?php

namespace App\Http\Controllers;

use App\Models\Baja;
use App\Models\Biene;
use App\Models\Area;
use App\Models\Estado;
use App\Models\Director;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BajaController extends Controller
{
    // Página principal
    public function index(Request $request)
    {
        $areas = Area::all();
        $estados = Estado::all();
        $directores = Director::all();
        $categorias = Categoria::all();

        $anioSeleccionado = $request->get('anio');

        // Obtener todos los bienes con relaciones
        $bienes = Biene::with(['area', 'estado', 'director', 'bajas.director'])->get();

        // Filtrar solo los bienes que están en estado "Malo" o tienen baja, según año
        $bajas = $bienes->map(function ($bien) use ($anioSeleccionado) {
            $baja = $bien->bajas->first();

            $mostrar = false;

            if ($baja) {
                if ($anioSeleccionado) {
                    if (date('Y', strtotime($baja->fecha)) == $anioSeleccionado) {
                        $mostrar = true;
                    }
                } else {
                    $mostrar = true;
                }
            } elseif ($bien->estado?->nombre === 'Malo') {
                if (!$anioSeleccionado) {
                    $mostrar = true;
                } else {
                    $mostrar = false;
                }
            }

            if (!$mostrar) return null;

            return (object)[
                'id' => $bien->id,
                'codigo_patrimonial' => $bien->codigo_patrimonial ?? '',
                'descripcion' => $bien->descripcion ?? '',
                'serial' => $bien->serial ?? '',
                'area' => $bien->area?->nombre ?? 'Sin área',
                'estado' => $bien->estado?->nombre ?? 'Malo',
                'director' => ($bien->director?->nombre ?? '') . ' ' . ($bien->director?->apellido ?? ''),
                'fecha_baja' => $baja?->fecha ?? '',
                'motivo_baja' => $baja?->motivo ?? '',
                'observaciones' => $baja?->observaciones ?? '',
                'director_baja' => $baja?->director?->nombre . ' ' . $baja?->director?->apellido ?? '',
            ];
        })->filter();

        $totalBienes = $bajas->count();

        $anios = Baja::selectRaw('YEAR(fecha) as anio')
            ->distinct()
            ->orderBy('anio', 'desc')
            ->pluck('anio');

        return view('admin.bajas.index', compact(
            'areas',
            'estados',
            'directores',
            'categorias',
            'bienes',
            'anios',
            'anioSeleccionado',
            'totalBienes',
            'bajas'
        ));
    }

    // Buscador en tiempo real
    public function buscar(Request $request)
    {
        $query = trim($request->input('q'));
        if (empty($query)) {
            return response()->json(['status' => 'error', 'mensaje' => 'Ingrese un término de búsqueda.']);
        }

        $bienes = Biene::with(['area', 'estado', 'categoria', 'director', 'bajas.director'])
            ->where(function ($q) use ($query) {
                $q->where('codigo_patrimonial', 'like', "%$query%")
                    ->orWhere('serial', 'like', "%$query%")
                    ->orWhere('descripcion', 'like', "%$query%");
            })->get();

        if ($bienes->isEmpty()) {
            return response()->json(['status' => 'error', 'mensaje' => 'No se encontraron bienes.']);
        }

        $bienes->transform(function ($bien) {
            $baja = $bien->bajas->first();

            return [
                'id' => $bien->id,
                'codigo_patrimonial' => $bien->codigo_patrimonial ?? '',
                'descripcion' => $bien->descripcion ?? '',
                'area' => $bien->area?->nombre ?? 'Sin área',
                'estado' => $bien->estado?->nombre ?? 'Sin estado',
                'marca' => $bien->marca ?? '',
                'modelo' => $bien->modelo ?? '',
                'serial' => $bien->serial ?? '',
                'color' => $bien->color ?? '',
                'director' => ($bien->director?->nombre ?? '') . ' ' . ($bien->director?->apellido ?? ''),
                'ya_baja' => $baja || ($bien->estado?->nombre === 'Malo'),
                'fecha_baja' => $baja?->fecha ?? '',
                'motivo_baja' => $baja?->motivo ?? '',
                'observaciones' => $baja?->observaciones ?? '',
                'director_baja' => $baja?->director?->nombre . ' ' . $baja?->director?->apellido ?? '',
            ];
        });


        return response()->json(['status' => 'ok', 'bienes' => $bienes]);
    }

    // Dar de baja un bien
    public function baja(Request $request, $id)
    {
        $request->validate([
            'motivo' => 'required|string',
            'director_id' => 'required|exists:directors,id'
        ]);

        DB::beginTransaction();
        try {
            $bien = Biene::findOrFail($id);

            $baja = new Baja();
            $baja->bien_id = $bien->id;
            $baja->fecha = Carbon::now()->format('Y-m-d');
            $baja->motivo = $request->motivo;
            // CORRECCIÓN: evitar null en observaciones
            $baja->observaciones = $request->observaciones ?? '';
            $baja->director_id = $request->director_id;
            $baja->save();

            $estadoMalo = Estado::where('nombre', 'Malo')->first();
            if (!$estadoMalo) throw new \Exception("No existe el estado 'Malo'");
            $bien->estado_id = $estadoMalo->id;
            $bien->save();

            DB::commit();
            return redirect()->route('bajas.index')
                ->with('mensaje', 'El bien fue dado de baja exitosamente.')
                ->with('icono', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('bajas.index')
                ->with('mensaje', 'Error al dar de baja: ' . $e->getMessage())
                ->with('icono', 'error');
        }
    }

    // Listado AJAX para tabla y filtros
    public function listado(Request $request)
    {
        $bienes = Biene::with(['area', 'estado', 'director', 'bajas.director'])->get();
        $anioFiltro = $request->get('anio');

        $bajas = $bienes->filter(function ($bien) {
            return ($bien->estado?->nombre === 'Malo') || ($bien->bajas->count() > 0);
        })->map(function ($bien) use ($anioFiltro) {
            $baja = $bien->bajas->first();

            if ($anioFiltro && $baja && date('Y', strtotime($baja->fecha)) != $anioFiltro) {
                $baja = null;
            }

            return [
                'id' => $bien->id,
                'codigo_patrimonial' => $bien->codigo_patrimonial ?? '',
                'descripcion' => $bien->descripcion ?? '',
                'area' => $bien->area?->nombre ?? 'Sin área',
                'estado' => $bien->estado?->nombre ?? 'Malo',
                'marca' => $bien->marca ?? '',
                'modelo' => $bien->modelo ?? '',
                'serial' => $bien->serial ?? '',
                'color' => $bien->color ?? '',
                'director' => ($bien->director?->nombre ?? '') . ' ' . ($bien->director?->apellido ?? ''),
                'fecha_baja' => $baja?->fecha ?? '',
                'motivo_baja' => $baja?->motivo ?? '',
                'serial' => $bien->serial ?? '',
                'observaciones' => $baja?->observaciones ?? '',
                'director_baja' => $baja?->director?->nombre . ' ' . $baja?->director?->apellido ?? '',
                'ya_baja' => $baja || ($bien->estado?->nombre === 'Malo')
            ];
        });

        $anios = Biene::selectRaw('YEAR(fecha_adquisicion) as anio')->distinct()->orderBy('anio', 'desc')->pluck('anio');

        return response()->json([
            'status' => 'ok',
            'total' => $bajas->count(),
            'bajas' => $bajas,
            'anios' => $anios
        ]);
    }
}
