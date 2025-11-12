<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Biene;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = Area::all();
        return view('admin.areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.areas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:areas,nombre',
            'descripcion' => 'nullable|string',
        ]);

        $area = new Area();
        $area->nombre = $request->nombre;
        $area->descripcion = $request->descripcion;
        $area->save();
        return redirect()->route('areas.index')
        ->with('mensaje', 'Area creada exitosamente.')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $area = Area::findOrFail($id);
        return view('admin.areas.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:areas,nombre,'.$id,
            'descripcion' => 'nullable|string',
        ]);

        $area = Area::findOrFail($id);
        $area->nombre = $request->nombre;
        $area->descripcion = $request->descripcion;
        $area->save();
        return redirect()->route('areas.index')
        ->with('mensaje', 'Area actualizada exitosamente.')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $areas_asociadas = Biene::where('area_id', $area->id)->count();

        if ($areas_asociadas > 0) {
            return redirect()->route('areas.index')
            ->with('mensaje', 'No se puede eliminar el area: '.$area->nombre.' porque tiene '. $areas_asociadas.' bienes asociados')
            ->with('icono', 'error');
        }

        $area->delete();
        return redirect()->route('areas.index')
        ->with('mensaje', 'Area eliminada exitosamente.')
        ->with('icono', 'success');
    }
}
