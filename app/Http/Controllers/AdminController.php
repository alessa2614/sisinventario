<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biene;
use App\Models\Ingreso;
use App\Models\Baja;
use App\Models\Movimiento;
use App\Models\User;
// use App\Models\Role;
use App\Models\Area;
use App\Models\Estado;
use App\Models\Director;
use App\Models\Categoria;

class AdminController extends Controller
{
    public function index()
    {
        $total_bienes = Biene::count();
        $total_bajas = Baja::count();
        $total_movimientos = Movimiento::count();
        $total_usuarios = User::count();
        //        $total_roles = Role::count();
        $total_areas = Area::count();
        $total_estados = Estado::count();
        $total_directores = Director::count();
        $total_categorias = Categoria::count();
        $total_estado_bueno = Biene::where('estado_id', 1)->count();
        $total_estado_regular = Biene::where('estado_id', 2)->count();
        $total_estado_malo = Biene::where('estado_id', 3)->count();
        $total_estado_no_habido = Biene::where('estado_id', 4)->count();


        return view('admin.index', compact('total_bienes',  'total_bajas',
         'total_movimientos', 'total_usuarios', 'total_areas', 'total_estados', 'total_directores',
          'total_categorias', 'total_estado_bueno', 'total_estado_regular', 'total_estado_malo', 'total_estado_no_habido'));
    }
}
