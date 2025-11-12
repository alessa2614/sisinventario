<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Biene;
use App\Models\Director;
use App\Models\Estado;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\BienesExport;

class BieneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $bienes = Biene::all();

        return view('admin.bienes.index', compact('bienes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $areas = Area::all();
        $estados = Estado::all();
        $directores = Director::all();
        $categorias = Categoria::all();
        return view('admin.bienes.create', compact('areas', 'estados', 'directores', 'categorias'));

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
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        $bienes = new Biene();
        $bienes->codigo_patrimonial = $request->codigo_patrimonial;
        $bienes->descripcion = $request->descripcion;
        $bienes->marca = $request->marca;
        $bienes->modelo = $request->modelo;
        $bienes->serial = $request->serial;
        $bienes->color = $request->color;
        $bienes->medidas = $request->medidas;
        $bienes->fecha_adquisicion = $request->fecha_adquisicion;
        $bienes->valor_inicial = $request->valor_inicial;
        $bienes->area_id = $request->area_id;
        $bienes->estado_id = $request->estado_id;
        $bienes->director_id = $request->director_id;
        $bienes->observaciones = $request->observaciones;
        $bienes->categoria_id = $request->categoria_id;
        $bienes->numero_doc = $request->numero_doc;
        $bienes->tipo_documento = $request->tipo_documento;
        $bienes->save();

        return redirect()->route('bienes.index')
            ->with('mensaje', 'Bien creado exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Biene $biene)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bienes = Biene::findOrFail($id);
        $areas = Area::all();
        $estados = Estado::all();
        $directores = Director::all();
        $categorias = Categoria::all();
        return view('admin.bienes.edit', compact('bienes', 'areas', 'estados', 'directores', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required',
            'area_id' => 'required|exists:areas,id',
            'estado_id' => 'required|exists:estados,id',
            'director_id' => 'required|exists:directors,id',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        $bienes = Biene::findOrFail($id);
        $bienes->codigo_patrimonial = $request->codigo_patrimonial;
        $bienes->descripcion = $request->descripcion;
        $bienes->marca = $request->marca;
        $bienes->modelo = $request->modelo;
        $bienes->serial = $request->serial;
        $bienes->color = $request->color;
        $bienes->medidas = $request->medidas;
        $bienes->fecha_adquisicion = $request->fecha_adquisicion;
        $bienes->valor_inicial = $request->valor_inicial;
        $bienes->area_id = $request->area_id;
        $bienes->estado_id = $request->estado_id;
        $bienes->director_id = $request->director_id;
        $bienes->observaciones = $request->observaciones;
        $bienes->categoria_id = $request->categoria_id;
        $bienes->numero_doc = $request->numero_doc;
        $bienes->tipo_documento = $request->tipo_documento;
        $bienes->save();

        return redirect()->route('bienes.index')
            ->with('mensaje', 'Bien actualizado exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bienes = Biene::findOrFail($id);
        DB::table('bajas')->where('bien_id', $bienes->id)->delete();
        $bienes->delete();
        return redirect()->route('bienes.index')
            ->with('mensaje', 'Bien eliminado exitosamente')
            ->with('icono', 'success');
    }


    public function porCategoria($nombre)
    {
        // Decodificar URL
        $nombre = urldecode($nombre);

        // Normalizar espacios al inicio/final y buscar insensible a mayúsculas y acentos
        $categoriaEncontrada = \App\Models\Categoria::where(function ($query) use ($nombre) {
            $query->whereRaw('LOWER(TRIM(nombre)) LIKE ?', ['%' . strtolower(trim($nombre)) . '%']);
        })->first();

        if (!$categoriaEncontrada) {
            return redirect()->route('bienes.index')
                ->with('error', "La categoría '{$nombre}' no existe.");
        }

        $bienes = $categoriaEncontrada->bienes;

        $areas = \App\Models\Area::all();
    $estados = \App\Models\Estado::all();
    $anios = range(date('Y'), 2020);
    $anioSeleccionado = null;
    $movimientosFiltrados = [];
    $totalMovimientos = 0;

    return view('admin.bienes.index', compact(
        'categoriaEncontrada',
        'bienes',
        'areas',
        'estados',
        'anios',
        'anioSeleccionado',
        'movimientosFiltrados',
        'totalMovimientos'
    ));
    }





}
