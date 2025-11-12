<?php

namespace App\Http\Controllers;

use App\Mail\RegistroUsuarioMail;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;




class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::withTrashed()->get();

        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rol' => 'required',
            'email' => 'required|email|unique:users,email',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'tipo_documento' => 'required|in:DNI,Carnet de Extranjeria,Pasaporte,RUC,CI',
            'numero_documento' => 'required|string|max:20|unique:users',
            'celular' => 'required|string|max:20',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino',
            'direccion' => 'required|string',

        ]);

        $passwordTemporal = Str::random(8);

        $usuario = new User();
        $usuario->name = $request->nombres . ' ' . $request->apellidos;
        $usuario->email = $request->email;
        $usuario->password = $passwordTemporal;
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->tipo_documento = $request->tipo_documento;
        $usuario->numero_documento = $request->numero_documento;
        $usuario->celular = $request->celular;
        $usuario->fecha_nacimiento = $request->fecha_nacimiento;
        $usuario->genero = $request->genero;
        $usuario->direccion = $request->direccion;

        $usuario->save();

        Mail::to($usuario->email)->send(new RegistroUsuarioMail($usuario, $passwordTemporal));

        $rol = Role::findOrFail($request->rol);
        $usuario->assignRole($rol);

        return redirect()->route('usuarios.index')
            ->with('mensaje', 'Usuario creado exitosamente y contraseña enviado al correo del usuario.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $usuario = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $request->validate([
            'rol' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'tipo_documento' => 'required|in:DNI,Carnet de Extranjeria,Pasaporte,RUC,CI',
            'numero_documento' => 'required|string|max:20|unique:users,numero_documento,' . $id,
            'celular' => 'required|string|max:20',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino',
            'direccion' => 'required|string',

        ]);

        $usuario->name = $request->nombres . ' ' . $request->apellidos;
        $usuario->email = $request->email;
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->tipo_documento = $request->tipo_documento;
        $usuario->numero_documento = $request->numero_documento;
        $usuario->celular = $request->celular;
        $usuario->fecha_nacimiento = $request->fecha_nacimiento;
        $usuario->genero = $request->genero;
        $usuario->direccion = $request->direccion;

        $usuario->save();

        $rol = Role::findOrFail($request->rol);
        $usuario->syncRoles($rol->name);

        return redirect()->route('usuarios.index')
            ->with('mensaje', 'Usuario actualizado exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);


        //verificar que no sea el mismo usuario logeado
        if ($usuario->id == Auth::id()) {
            return redirect()->back()
                ->with('mensaje', 'No puedes eliminar tu propia cuenta')
                ->with('icono', 'error');
        } else {
            $usuario->delete();
            $usuario->estado = false;
            $usuario->save();
            return redirect()->route('usuarios.index')
                ->with('mensaje', 'Usuario eliminado exitosamente')
                ->with('icono', 'success');
        }
    }
    public function restore($id)
    {
        $usuario = User::withTrashed()->findOrFail($id);
        $usuario->estado = true;
        $usuario->save();
        $usuario->restore();
        return redirect()->route('usuarios.index')
            ->with('mensaje', 'Usuario restaurado exitosamente')
            ->with('icono', 'success');
    }

    public function perfil()
    {
        $roles = Role::all();
        $usuario = User::findOrFail(Auth::user()->id);
        return view('admin.usuarios.perfil', compact('roles', 'usuario'));
    }
    public function actualizar_perfil(Request $request)
    {
        //return response()->json($request->all());
        $usuario = User::findOrFail($request->id);
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $request->id,
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'tipo_documento' => 'required|in:DNI,Carnet de Extranjeria,Pasaporte,RUC,CI',
            'numero_documento' => 'required|string|max:20|unique:users,numero_documento,' . $request->id,
            'celular' => 'required|string|max:20',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino',
            'direccion' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'password_actual' => 'nullable|string',
            'password_nueva' => 'nullable|string|min:8|required_with:password_actual',
            'password_confirmacion' => 'nullable|string|same:password_nueva|required_with:password_actual',

        ]);

        if ($request->hasFile('foto')) {
            if ($usuario->foto && Storage::disk('public')->exists('fotos/' . $usuario->foto)) {
                Storage::disk('public')->delete('fotos/' . $usuario->foto);
            }
            $fotoPath = $request->file('foto')->store('fotos', 'public');
            $usuario->foto = basename($fotoPath);
        }

        if ($request->filled('password_actual')) {
            if (!password_verify($request->password_actual, $usuario->password)) {
                return redirect()->back()
                    ->with('mensaje', 'Contraseña actual incorrecta')
                    ->with('icono', 'error');
            } else {
                $usuario->password = $request->password_nueva;
            }
        }



        $usuario->name = $request->nombres . ' ' . $request->apellidos;
        $usuario->email = $request->email;
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->tipo_documento = $request->tipo_documento;
        $usuario->numero_documento = $request->numero_documento;
        $usuario->celular = $request->celular;
        $usuario->fecha_nacimiento = $request->fecha_nacimiento;
        $usuario->genero = $request->genero;
        $usuario->direccion = $request->direccion;

        $usuario->save();


        return redirect()->back()
            ->with('mensaje', 'Perfil actualizado exitosamente')
            ->with('icono', 'success');
    }
    

}
