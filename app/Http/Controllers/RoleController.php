<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        $rol = new Role();
        $rol->name = strtoupper($request->name);
        $rol->save();
        return redirect()->route('roles.index')
            ->with('mensaje', 'Rol creado exitosamente.')
            ->with('icono', 'success');
    }

    public function permisos($id)
    {
        $rol = Role::findOrFail($id);

        //return response()->json($permisos);
        $permisos = Permission::all()->groupBy(function ($permiso) {
            if (stripos($permiso->name, 'director') !== false) {
                return 'Directores';
            }
            if (stripos($permiso->name, 'area') !== false) {
                return 'Áreas';
            }
            if (stripos($permiso->name, 'estado') !== false) {
                return 'Estados';
            }
            if (stripos($permiso->name, 'bien') !== false) {
                return 'Bienes';
            }
            if (stripos($permiso->name, 'rol') !== false) {
                return 'Roles';
            }
            if (stripos($permiso->name, 'usuario') !== false) {
                return 'Usuarios';
            }
            if (stripos($permiso->name, 'ingreso') !== false) {
                return 'Ingresos';
            }
            if (stripos($permiso->name, 'baja') !== false) {
                return 'Bajas';
            }
            if (stripos($permiso->name, 'movimiento') !== false) {
                return 'Movimientos';
            }
            if (stripos($permiso->name, 'reporte') !== false) {
                return 'Reportes';
            }
            return 'Otros';
        });

        return view('admin.roles.permisos', compact('rol', 'permisos'));
    }
    public function update_permisos(Request $request, $id)
    {
        $rol = Role::findOrFail($id);
        $rol->permissions()->sync($request->permisos);
        return redirect()->route('roles.index')
            ->with('mensaje', 'Permisos actualizados exitosamente.')
            ->with('icono', 'success');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rol = Role::findOrFail($id);
        return view('admin.roles.edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
        ]);

        $rol = Role::findOrFail($id);
        $rol->name = strtoupper($request->name);
        $rol->save();
        return redirect()->route('roles.index')
            ->with('mensaje', 'Rol actualizado exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rol = Role::findOrFail($id);

        $usuarios_asociados = User::role($rol->name)->count();

        if ($usuarios_asociados > 0) {
            return redirect()->route('roles.index')
                ->with('mensaje', 'No se puede eliminar el rol: '.$rol->name.' porque tiene '. $usuarios_asociados.' usuarios asociados')
                ->with('icono', 'error');
        }

        $rol->delete();
        return redirect()->route('roles.index')
            ->with('mensaje', 'Rol eliminado exitosamente.')
            ->with('icono', 'success');
    }
}
