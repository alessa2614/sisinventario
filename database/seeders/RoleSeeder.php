<?php

namespace Database\Seeders;

use Faker\Provider\ar_EG\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create(['name' => 'ADMINISTRADOR']);
        Role::create(['name' => 'COMITE']);
        Role::create(['name' => 'DOCENTE']);

        Permission::create(['name'=>'directores.index'])->syncRoles($superAdmin);
        Permission::create(['name'=>'directores.create'])->syncRoles($superAdmin);
        Permission::create(['name'=>'directores.store'])->syncRoles($superAdmin);
        Permission::create(['name'=>'directores.show'])->syncRoles($superAdmin);
        Permission::create(['name'=>'directores.edit'])->syncRoles($superAdmin);
        Permission::create(['name'=>'directores.update'])->syncRoles($superAdmin);
        Permission::create(['name'=>'directores.destroy'])->syncRoles($superAdmin);

        //para areas
        Permission::create(['name'=>'areas.index'])->syncRoles($superAdmin);
        Permission::create(['name'=>'areas.create'])->syncRoles($superAdmin);   
        Permission::create(['name'=>'areas.store'])->syncRoles($superAdmin);
        Permission::create(['name'=>'areas.show'])->syncRoles($superAdmin);
        Permission::create(['name'=>'areas.edit'])->syncRoles($superAdmin);
        Permission::create(['name'=>'areas.update'])->syncRoles($superAdmin);
        Permission::create(['name'=>'areas.destroy'])->syncRoles($superAdmin);

        //para estados
        Permission::create(['name'=>'estados.index'])->syncRoles($superAdmin);
        Permission::create(['name'=>'estados.create'])->syncRoles($superAdmin);
        Permission::create(['name'=>'estados.store'])->syncRoles($superAdmin);
        Permission::create(['name'=>'estados.show'])->syncRoles($superAdmin);
        Permission::create(['name'=>'estados.edit'])->syncRoles($superAdmin);
        Permission::create(['name'=>'estados.update'])->syncRoles($superAdmin);
        Permission::create(['name'=>'estados.destroy'])->syncRoles($superAdmin);    

        //para bienes
        Permission::create(['name'=>'bienes.index'])->syncRoles($superAdmin);
        Permission::create(['name'=>'bienes.create'])->syncRoles($superAdmin);
        Permission::create(['name'=>'bienes.store'])->syncRoles($superAdmin);
        Permission::create(['name'=>'bienes.show'])->syncRoles($superAdmin);
        Permission::create(['name'=>'bienes.edit'])->syncRoles($superAdmin);
        Permission::create(['name'=>'bienes.update'])->syncRoles($superAdmin);
        Permission::create(['name'=>'bienes.destroy'])->syncRoles($superAdmin);

        //para roles
        Permission::create(['name'=>'roles.index'])->syncRoles($superAdmin);
        Permission::create(['name'=>'roles.create'])->syncRoles($superAdmin);
        Permission::create(['name'=>'roles.store'])->syncRoles($superAdmin);
        Permission::create(['name'=>'roles.show'])->syncRoles($superAdmin);
        Permission::create(['name'=>'roles.edit'])->syncRoles($superAdmin);
        Permission::create(['name'=>'roles.update'])->syncRoles($superAdmin);
        Permission::create(['name'=>'roles.destroy'])->syncRoles($superAdmin);
        Permission::create(['name'=>'roles.permisos'])->syncRoles($superAdmin);
        Permission::create(['name'=>'roles.update_permisos'])->syncRoles($superAdmin);

        //para usuarios
        Permission::create(['name'=>'usuarios.index'])->syncRoles($superAdmin);
        Permission::create(['name'=>'usuarios.create'])->syncRoles($superAdmin);
        Permission::create(['name'=>'usuarios.store'])->syncRoles($superAdmin);
        Permission::create(['name'=>'usuarios.show'])->syncRoles($superAdmin);
        Permission::create(['name'=>'usuarios.edit'])->syncRoles($superAdmin);
        Permission::create(['name'=>'usuarios.update'])->syncRoles($superAdmin);
        Permission::create(['name'=>'usuarios.destroy'])->syncRoles($superAdmin);

        //para ingresos
        Permission::create(['name'=>'ingresos.index'])->syncRoles($superAdmin);
        Permission::create(['name'=>'ingresos.create'])->syncRoles($superAdmin);
        Permission::create(['name'=>'ingresos.store'])->syncRoles($superAdmin);
        Permission::create(['name'=>'ingresos.plantilla'])->syncRoles($superAdmin);
        Permission::create(['name'=>'ingresos.importar'])->syncRoles($superAdmin);
        Permission::create(['name'=>'ingresos.guia'])->syncRoles($superAdmin);


        //para bajas
        Permission::create(['name'=>'bajas.index'])->syncRoles($superAdmin);
        Permission::create(['name'=>'bajas.buscar'])->syncRoles($superAdmin);
        Permission::create(['name'=>'bajas.baja'])->syncRoles($superAdmin);
        Permission::create(['name'=>'bajas.listado'])->syncRoles($superAdmin);

       //para movimientos
        Permission::create(['name'=>'movimientos.index'])->syncRoles($superAdmin);
        Permission::create(['name'=>'movimientos.buscar'])->syncRoles($superAdmin);
        Permission::create(['name'=>'movimientos.store'])->syncRoles($superAdmin);
        Permission::create(['name'=>'movimientos.listado'])->syncRoles($superAdmin);
        Permission::create(['name'=>'movimientos.historial'])->syncRoles($superAdmin);  

        //para reportes
        Permission::create(['name'=>'reportes.bajas'])->syncRoles($superAdmin);
        Permission::create(['name'=>'reportes.bajas.excel'])->syncRoles($superAdmin);
        Permission::create(['name'=>'reportes.bienes_baja_pdf'])->syncRoles($superAdmin);
        Permission::create(['name'=>'reportes.sin_codigo'])->syncRoles($superAdmin);
        Permission::create(['name'=>'reportes.sin_codigo.excel'])->syncRoles($superAdmin);
        Permission::create(['name'=>'reportes.sin_codigo_pdf'])->syncRoles($superAdmin);
        Permission::create(['name'=>'reportes.areas'])->syncRoles($superAdmin);
        Permission::create(['name'=>'reportes.areas.excel'])->syncRoles($superAdmin);
        Permission::create(['name'=>'reportes.areas_pdf'])->syncRoles($superAdmin);

        //para la vista de categorias
        Permission::create(['name'=>'categorias.porNombre'])->syncRoles($superAdmin);

        //reportar en general y por categoria
        Permission::create(['name'=>'reportes.bienes'])->syncRoles($superAdmin);
        Permission::create(['name'=>'reportes.bienes.excel'])->syncRoles($superAdmin);
        Permission::create(['name'=>'reportes.bienes.pdf'])->syncRoles($superAdmin);
        Permission::create(['name'=>'reportes.bienes.categoria.excel'])->syncRoles($superAdmin);
        Permission::create(['name'=>'reportes.bienes.categoria.pdf'])->syncRoles($superAdmin);

    }
}
