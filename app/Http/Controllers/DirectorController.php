<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Models\Biene;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $directores = Director::all();
        return view('admin.directores.index', compact('directores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.directores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|unique:directors,dni',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'observaciones' => 'nullable|string',
            'estado' => 'required|boolean',
        ]);

        $director = new Director();
        $director->nombre = $request->nombre;
        $director->apellido = $request->apellido;
        $director->dni = $request->dni;
        $director->fecha_inicio = $request->fecha_inicio;
        $director->fecha_fin = $request->fecha_fin;
        $director->observaciones = $request->observaciones;
        $director->estado = $request->estado;
        $director->save();
        return redirect()->route('directores.index')
        ->with('mensaje', 'Director creado exitosamente.')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Director $director)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $director = Director::findOrFail($id);
        return view('admin.directores.edit', compact('director'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|unique:directors,dni,'.$id,
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'observaciones' => 'nullable|string',
            'estado' => 'required|boolean',
        ]);

        $director = Director::findOrFail($id);
        $director->nombre = $request->nombre;
        $director->apellido = $request->apellido;
        $director->dni = $request->dni;
        $director->fecha_inicio = $request->fecha_inicio;
        $director->fecha_fin = $request->fecha_fin;
        $director->observaciones = $request->observaciones;
        $director->estado = $request->estado;
        $director->save();
        return redirect()->route('directores.index')
        ->with('mensaje', 'Director actualizado exitosamente.')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $director = Director::findOrFail($id);
        $directores_asociados = Biene::where('director_id', $director->id)->count();
        if ($directores_asociados > 0) {
            return redirect()->route('directores.index')
            ->with('mensaje', 'No se puede eliminar el director: '.$director->nombre.' '.$director->apellido.' porque tiene '. $directores_asociados )
            ->with('icono', 'error');
        }
        $director->delete();
        return redirect()->route('directores.index')
        ->with('mensaje', 'Director eliminado exitosamente.')
        ->with('icono', 'success');
    }
}
