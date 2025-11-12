<?php

namespace App\Http\Controllers;

use App\Models\Biene;
use App\Models\Area;
use App\Models\Estado;
use App\Models\Director;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Exports\BienesBajaExport;
use App\Exports\SinCodigoExport;
use App\Exports\AreasExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\BienesPorCategoriaExport;
use App\Exports\BienesExport;



class ReporteController extends Controller
{
    /**
     * Reporte de bienes dados de baja
     */
    public function bienesBaja()
{
    $areas = Area::all();
    $estados = Estado::all();
    $directores = Director::all();
    $categorias = Categoria::all();

    $bienes = Biene::with(['area','estado','director','categoria'])
        ->whereHas('estado', function($q){
            $q->where('nombre', 'Malo'); // 👈 aquí va "Malo"
        })
        ->orderBy('fecha_adquisicion', 'desc')
        ->get();

    return view('admin.reportes.bajas', compact('bienes', 'areas', 'estados', 'directores', 'categorias'));
}
public function exportExcelBaja()
{
    return Excel::download(new BienesBajaExport, 'bienes_baja.xlsx');
}
 public function exportPdfBaja()
    {
        $bienes = Biene::with(['area','estado','director','categoria'])
            ->whereHas('estado', fn($q) => $q->where('nombre', 'Malo'))
            ->orderBy('fecha_adquisicion', 'desc')
            ->get();

        $pdf = Pdf::loadView('admin.reportes.bienes_baja_pdf', compact('bienes'))
            ->setPaper('A4', 'landscape');

        return $pdf->download('Bienes_Baja.pdf');
    }
    public function sinCodigoPatrimonial(){
    $areas = Area::all();
    $estados = Estado::all();
    $directores = Director::all();
    $categorias = Categoria::all();

    $bienes = Biene::with(['area','estado','director','categoria'])
        
        ->whereNull('codigo_patrimonial')
        ->orderBy('fecha_adquisicion', 'desc')
        ->get();

    return view('admin.reportes.sin_codigo', compact('bienes', 'areas', 'estados', 'directores', 'categorias'));
    }
    public function exportExcelSinCodigoPatrimonial()
    {
        return Excel::download(new SinCodigoExport, 'sin_codigo_patrimonial.xlsx');
    }
    public function exportPdfSinCodigoPatrimonial(){
        $bienes = Biene::with(['area','estado','director','categoria'])
            ->whereNull('codigo_patrimonial')
            ->orderBy('fecha_adquisicion', 'desc')
            ->get();

        $pdf = Pdf::loadView('admin.reportes.sin_codigo_pdf', compact('bienes'))
            ->setPaper('A4', 'landscape');

        return $pdf->download('Bienes_Sin_Codigo.pdf');
    }

  public function reporteAreas()
{
    $areas      = Area::all();
    $estados    = Estado::all();
    $directores = Director::all();
    $categorias = Categoria::all();

    $query = Biene::with(['area','estado','director','categoria'])
                  ->orderBy('fecha_adquisicion', 'desc');

    if (request()->filled('area_id')) {
        $query->where('area_id', request('area_id'));
    }

    $bienes = $query->get(); // 👈 trae todos

    return view('admin.reportes.areas', compact('bienes', 'areas', 'estados', 'directores', 'categorias'));
}

public function exportExcelAreas()
{
    $areaId = request('area_id'); // null si no se pasa
    $fileName = 'bienes_por_area.xlsx'; // nombre por defecto

    if ($areaId) {
        $area = Area::find($areaId);
        if ($area) {
            // Reemplazamos espacios por guiones bajos para el nombre de archivo
            $nombreArea = str_replace(' ', '_', strtolower($area->nombre));
            $fileName = 'bienes_por_area_' . $nombreArea . '.xlsx';
        }
    }

    return Excel::download(new AreasExport($areaId), $fileName);
}

public function exportPdfAreas()
{
    $query = Biene::with(['area','estado','director','categoria'])
                  ->orderBy('fecha_adquisicion', 'desc');

    $areaSeleccionada = null;
    if (request()->filled('area_id')) {
        $query->where('area_id', request('area_id'));
        $areaSeleccionada = Area::find(request('area_id'));
    }

    $bienes = $query->get();

    $pdf = Pdf::loadView('admin.reportes.areas_pdf', compact('bienes', 'areaSeleccionada'))
              ->setPaper('A4', 'landscape');

    // Si es un área, nombra el archivo con esa área
    $fileName = $areaSeleccionada
        ? 'bienes_area_' . str_replace(' ', '_', strtolower($areaSeleccionada->nombre)) . '.pdf'
        : 'bienes_por_area.pdf';

    return $pdf->download($fileName);
}













 public function reporteGeneral()
    {
        $bienes = Biene::with(['area','estado','director','categoria'])
                       ->orderBy('fecha_adquisicion', 'desc')
                       ->get();

        return view('admin.reportes.bienes_general', compact('bienes'));
    }

    public function exportExcelGeneral()
    {
        return Excel::download(new BienesExport(), 'bienes_general.xlsx');
    }

    public function exportPdfGeneral()
    {
        $bienes = Biene::with(['area','estado','director','categoria'])
                       ->orderBy('fecha_adquisicion', 'desc')
                       ->get();

        return Pdf::loadView('admin.reportes.bienes_general_pdf', compact('bienes'))
                  ->setPaper('A4', 'landscape')
                  ->download('bienes_general.pdf');
    }

    // Reporte por categoría usando ID
   public function exportExcelPorCategoria($nombre)
{
    $nombre = urldecode($nombre);

    $categoria = Categoria::whereRaw('LOWER(TRIM(nombre)) = ?', [strtolower(trim($nombre))])->first();

    if (!$categoria) {
        return redirect()->route('reportes.bienes')
                         ->with('error', "La categoría '{$nombre}' no existe.");
    }

    // Pasamos el ID al export para filtrar
     return \Maatwebsite\Excel\Facades\Excel::download(
        new BienesPorCategoriaExport($nombre),
        'bienes_categoria_'.$nombre.'.xlsx'
    );
}

public function exportPdfPorCategoria($nombre)
{
    $nombre = urldecode($nombre);

    $categoria = Categoria::whereRaw('LOWER(TRIM(nombre)) = ?', [strtolower(trim($nombre))])->first();

    if (!$categoria) {
        return redirect()->route('reportes.bienes')
                         ->with('error', "La categoría '{$nombre}' no existe.");
    }

    $bienes = Biene::with(['area','estado','director','categoria'])
                   ->whereHas('categoria', function($q) use ($categoria) {
                       $q->where('id', $categoria->id);
                   })
                   ->orderBy('fecha_adquisicion', 'desc')
                   ->get();

    $pdf = Pdf::loadView('admin.reportes.bienes_categoria_pdf', compact('bienes','categoria'))
              ->setPaper('A4', 'landscape');

    return $pdf->download('bienes_'.$categoria->nombre.'.pdf');
}
}