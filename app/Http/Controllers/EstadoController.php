<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Biene;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estados = Estado::all();
        return view('admin.estados.index', compact('estados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.estados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:estados,nombre',
            'descripcion' => 'nullable|string',
        ]);

        $estado = new Estado();
        $estado->nombre = $request->nombre;
        $estado->descripcion = $request->descripcion;
        $estado->save();
        return redirect()->route('estados.index')
        ->with('mensaje', 'Estado creado exitosamente.')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estado $estado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $estado = Estado::findOrFail($id);
        return view('admin.estados.edit', compact('estado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:estados,nombre,'.$id,
            'descripcion' => 'nullable|string',
        ]);

        $estado = Estado::findOrFail($id);
        $estado->nombre = $request->nombre;
        $estado->descripcion = $request->descripcion;
        $estado->save();
        return redirect()->route('estados.index')
        ->with('mensaje', 'Estado actualizado exitosamente.')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $estado = Estado::findOrFail($id);
        $estados_asociados = Biene::where('estado_id', $estado->id)->count();
        if ($estados_asociados > 0) {
            return redirect()->route('estados.index')
            ->with('mensaje', 'No se puede eliminar el estado: '.$estado->nombre.' porque tiene '. $estados_asociados.' bienes asociados')
            ->with('icono', 'error');
        }

        $estado->delete();
        return redirect()->route('estados.index')
        ->with('mensaje', 'Estado eliminado exitosamente.')
        ->with('icono', 'success');
    }
}
