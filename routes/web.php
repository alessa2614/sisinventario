<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BieneController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\BajaController;
use App\Http\Controllers\MovimientoController;

Route::get('/', function () {
    return view('landing');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home')->middleware('auth');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');

//rutas para perfil
Route::get('/perfil', [App\Http\Controllers\UserController::class, 'perfil'])->name('admin.usuarios.perfil')->middleware('auth');
Route::post('/perfil/update', [App\Http\Controllers\UserController::class, 'actualizar_perfil'])->name('admin.usuarios.actualizar_perfil')->middleware('auth');


//rutas para directores
Route::get('/admin/directores', [App\Http\Controllers\DirectorController::class, 'index'])->name('directores.index')->middleware('auth','can:directores.index');
Route::get('/admin/directores/create', [App\Http\Controllers\DirectorController::class, 'create'])->name('directores.create')->middleware('auth','can:directores.create');
Route::post('/admin/directores/create', [App\Http\Controllers\DirectorController::class, 'store'])->name('directores.store')->middleware('auth','can:directores.store');
Route::get('/admin/directores/{id}', [App\Http\Controllers\DirectorController::class, 'show'])->name('directores.show')->middleware('auth','can:directores.show');
Route::get('/admin/directores/{id}/edit', [App\Http\Controllers\DirectorController::class, 'edit'])->name('directores.edit')->middleware('auth','can:directores.edit');     
Route::put('/admin/directores/{id}', [App\Http\Controllers\DirectorController::class, 'update'])->name('directores.update')->middleware('auth','can:directores.update');
Route::delete('/admin/directores/{id}', [App\Http\Controllers\DirectorController::class, 'destroy'])->name('directores.destroy')->middleware('auth','can:directores.destroy');
//rutas para areas
Route::get('/admin/areas', [App\Http\Controllers\AreaController::class, 'index'])->name('areas.index')->middleware('auth','can:areas.index');
Route::get('/admin/areas/create', [App\Http\Controllers\AreaController::class, 'create'])->name('areas.create')->middleware('auth','can:areas.create');
Route::post('/admin/areas/create', [App\Http\Controllers\AreaController::class, 'store'])->name('areas.store')->middleware('auth','can:areas.store');
Route::get('/admin/areas/{id}/edit', [App\Http\Controllers\AreaController::class, 'edit'])->name('areas.edit')->middleware('auth','can:areas.edit');          
Route::put('/admin/areas/{id}', [App\Http\Controllers\AreaController::class, 'update'])->name('areas.update')->middleware('auth','can:areas.update');
Route::delete('/admin/areas/{id}', [App\Http\Controllers\AreaController::class, 'destroy'])->name('areas.destroy')->middleware('auth','can:areas.destroy');
//rutas para estados
Route::get('/admin/estados', [App\Http\Controllers\EstadoController::class, 'index'])->name('estados.index')->middleware('auth','can:estados.index');
Route::get('/admin/estados/create', [App\Http\Controllers\EstadoController::class, 'create'])->name('estados.create')->middleware('auth','can:estados.create');
Route::post('/admin/estados/create', [App\Http\Controllers\EstadoController::class, 'store'])->name('estados.store')->middleware('auth','can:estados.store');
Route::get('/admin/estados/{id}', [App\Http\Controllers\EstadoController::class, 'show'])->name('estados.show')->middleware('auth','can:estados.show');
Route::get('/admin/estados/{id}/edit', [App\Http\Controllers\EstadoController::class, 'edit'])->name('estados.edit')->middleware('auth','can:estados.edit');          
Route::put('/admin/estados/{id}', [App\Http\Controllers\EstadoController::class, 'update'])->name('estados.update')->middleware('auth','can:estados.update');
Route::delete('/admin/estados/{id}', [App\Http\Controllers\EstadoController::class, 'destroy'])->name('estados.destroy')->middleware('auth','can:estados.destroy');
//rutas para bienes
Route::get('/admin/bienes', [App\Http\Controllers\BieneController::class, 'index'])->name('bienes.index')->middleware('auth','can:bienes.index');
Route::get('/admin/bienes/create', [App\Http\Controllers\BieneController::class, 'create'])->name('bienes.create')->middleware('auth','can:bienes.create');
Route::post('/admin/bienes/create', [App\Http\Controllers\BieneController::class, 'store'])->name('bienes.store')->middleware('auth','can:bienes.store');

Route::get('/admin/bienes/{id}/edit', [App\Http\Controllers\BieneController::class, 'edit'])->name('bienes.edit')->middleware('auth','can:bienes.edit');          
Route::put('/admin/bienes/{id}', [App\Http\Controllers\BieneController::class, 'update'])->name('bienes.update')->middleware('auth','can:bienes.update');
Route::delete('/admin/bienes/{id}', [App\Http\Controllers\BieneController::class, 'destroy'])->name('bienes.destroy')->middleware('auth','can:bienes.destroy');
//rutas para roles
Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index')->middleware('auth','can:roles.index');
Route::get('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('roles.create')->middleware('auth','can:roles.create');
Route::post('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store')->middleware('auth','can:roles.store');
Route::get('/admin/roles/{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit')->middleware('auth','can:roles.edit');          
Route::get('/admin/roles/{id}/permisos', [App\Http\Controllers\RoleController::class, 'permisos'])->name('roles.permisos')->middleware('auth','can:roles.permisos');    
Route::post('/admin/roles/{id}/update_permisos', [App\Http\Controllers\RoleController::class, 'update_permisos'])->name('roles.update_permisos')->middleware('auth','can:roles.update_permisos');    
Route::put('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update')->middleware('auth','can:roles.update');
Route::delete('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy')->middleware('auth','can:roles.destroy');

//rutas para usuarios
Route::get('/admin/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('usuarios.index')->middleware('auth','can:usuarios.index');
Route::get('/admin/usuarios/create', [App\Http\Controllers\UserController::class, 'create'])->name('usuarios.create')->middleware('auth','can:usuarios.create');
Route::post('/admin/usuarios/create', [App\Http\Controllers\UserController::class, 'store'])->name('usuarios.store')->middleware('auth','can:usuarios.store');  
Route::post('admin/usuarios/{id}/restaurar', [App\Http\Controllers\UserController::class, 'restore'])->name('usuarios.restore')->middleware('auth','can:usuarios.restore');
Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('usuarios.show')->middleware('auth','can:usuarios.show');
Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('usuarios.edit')->middleware('auth','can:usuarios.edit');          
Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('usuarios.update')->middleware('auth','can:usuarios.update');    
Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('usuarios.destroy')->middleware('auth','can:usuarios.destroy');
  




Route::prefix('admin/categorias')->middleware(['auth', 'can:categorias.porNombre'])->group(function () {
    Route::get('{nombre}', [BieneController::class, 'porCategoria'])
        ->where('nombre', '.*')
        ->name('categorias.porNombre');
});

// ingresos
Route::get('/admin/ingresos/plantilla', [App\Http\Controllers\IngresoController::class, 'plantilla'])->name('ingresos.plantilla')->middleware('auth','can:ingresos.plantilla');
Route::post('/admin/ingresos/importar', [App\Http\Controllers\IngresoController::class, 'importarExcel'])->name('ingresos.importar')->middleware('auth','can:ingresos.importar');
Route::get('/admin/ingresos/guia', [App\Http\Controllers\IngresoController::class, 'descargarGuia'])->name('ingresos.guia')->middleware('auth','can:ingresos.guia');

Route::get('/admin/ingresos/create', [App\Http\Controllers\IngresoController::class, 'create'])->name('ingresos.create')->middleware('auth','can:ingresos.create');
Route::post('/admin/ingresos/create', [App\Http\Controllers\IngresoController::class, 'store'])->name('ingresos.store')->middleware('auth','can:ingresos.store');
Route::resource('/admin/ingresos', App\Http\Controllers\IngresoController::class)->except(['create', 'store'])->middleware('auth','can:ingresos.index');

// Rutas para gestión de bajas de bienes
Route::get('/admin/bajas', [BajaController::class, 'index'])->name('bajas.index')->middleware('auth','can:bajas.index');
Route::get('/admin/bajas/buscar', [BajaController::class, 'buscar'])->name('bajas.buscar')->middleware('auth','can:bajas.buscar');
Route::post('/admin/bajas/{id}/baja', [BajaController::class, 'baja'])->name('bajas.baja')->middleware('auth','can:bajas.baja');
Route::get('/admin/bajas/listado', [BajaController::class, 'listado'])->name('bajas.listado')->middleware('auth','can:bajas.listado');


// Rutas para gestion de movimientos de bienes
Route::get('/admin/movimientos', [MovimientoController::class, 'index'])->name('movimientos.index')->middleware('auth','can:movimientos.index');
Route::get('/admin/movimientos/buscar', [MovimientoController::class, 'buscar'])->name('movimientos.buscar')->middleware('auth','can:movimientos.buscar');
Route::post('admin/movimientos/{id}/store', [MovimientoController::class, 'store'])->name('movimientos.store')->middleware('auth','can:movimientos.store');
Route::get('/admin/movimientos/listado', [MovimientoController::class, 'listado'])->name('movimientos.listado')->middleware('auth','can:movimientos.listado');
Route::get('/admin/movimientos/historial/{id}', [MovimientoController::class, 'historial'])->name('movimientos.historial')->middleware('auth','can:movimientos.historial');


// Rutas para reportes
//bajas
Route::get('admin/reportes/bajas', [App\Http\Controllers\ReporteController::class, 'bienesBaja'])->name('reportes.bajas')->middleware('auth','can:reportes.bajas');
Route::get('admin/reportes/bajas/excel', [App\Http\Controllers\ReporteController::class, 'exportExcelBaja'])->name('reportes.bajas.excel')->middleware('auth','can:reportes.bajas.excel');
Route::get('admin/reportes/bajas/pdf', [App\Http\Controllers\ReporteController::class, 'exportPdfBaja'])->name('reportes.bienes_baja_pdf')->middleware('auth','can:reportes.bienes_baja_pdf');

//Sin codigo patrimonial
Route::get('admin/reportes/sin_codigo', [App\Http\Controllers\ReporteController::class, 'sinCodigoPatrimonial'])->name('reportes.sin_codigo')->middleware('auth','can:reportes.sin_codigo');
Route::get('admin/reportes/sin_codigo/excel', [App\Http\Controllers\ReporteController::class, 'exportExcelSinCodigoPatrimonial'])->name('reportes.sin_codigo.excel')->middleware('auth','can:reportes.sin_codigo.excel');
Route::get('admin/reportes/sin_codigo/pdf', [App\Http\Controllers\ReporteController::class, 'exportPdfSinCodigoPatrimonial'])->name('reportes.sin_codigo_pdf')->middleware('auth','can:reportes.sin_codigo_pdf');

//ingreso

// areas
Route::prefix('admin/reportes/areas')->group(function () {
    Route::get('/', [App\Http\Controllers\ReporteController::class, 'reporteAreas'])->name('reportes.areas')->middleware('auth','can:reportes.areas');
    Route::get('/excel', [App\Http\Controllers\ReporteController::class, 'exportExcelAreas'])->name('reportes.areas.excel')->middleware('auth','can:reportes.areas.excel');
    Route::get('/pdf', [App\Http\Controllers\ReporteController::class, 'exportPdfAreas'])->name('reportes.areas_pdf')->middleware('auth','can:reportes.areas_pdf');
});

Route::prefix('admin/reportes/bienes')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\ReporteController::class, 'reporteGeneral'])->name('reportes.bienes')->middleware('can:reportes.bienes');
    Route::get('/excel', [App\Http\Controllers\ReporteController::class, 'exportExcelGeneral'])->name('reportes.bienes.excel')->middleware('can:reportes.bienes.excel');
    Route::get('/pdf', [App\Http\Controllers\ReporteController::class, 'exportPdfGeneral'])->name('reportes.bienes.pdf')->middleware('can:reportes.bienes.pdf');

    // Por categoría
    Route::get('/categoria/{nombre}/excel', [App\Http\Controllers\ReporteController::class, 'exportExcelPorCategoria'])->name('reportes.bienes.categoria.excel')->middleware('can:reportes.bienes.categoria.excel');

    Route::get('/categoria/{nombre}/pdf', [App\Http\Controllers\ReporteController::class, 'exportPdfPorCategoria'])->name('reportes.bienes.categoria.pdf')->middleware('can:reportes.bienes.categoria.pdf');
});