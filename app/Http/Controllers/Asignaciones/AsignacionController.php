<?php

namespace App\Http\Controllers\Asignaciones;

use App\Http\Controllers\Controller;
use App\Models\Asignacion;
use App\Models\Corte;
use App\Models\Docente;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AsignacionController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $asignacion = Asignacion::all();
      return DataTables::of($asignacion)
        ->addColumn('accion', function ($asignacion) {
          $acciones = '';
          $acciones .= '<a href="javascript:void(0)" onclick="editarAsignacion(' . $asignacion->docente . ', ' . $asignacion->materia . ')" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>';
          $acciones .= '&nbsp<button type="button" id="' . $asignacion->docente . '" mat="' . $asignacion->materia . '" name="delete" class="desAsignacion btn btn-danger"><i class="bi bi-trash"></i></button>';
          return $acciones;
        })
        ->addColumn('docente', function ($asignacion) {
          $docente = $asignacion->docentes->personas->nom_persona;
          return $docente;
        })
        ->addColumn('materia', function ($asignacion) {
          $materia = $asignacion->materias->nom_materia;
          return $materia;
        })
        ->addColumn('corte', function ($asignacion) {
          $corte = $asignacion->cortes->desc_cohorte;
          return $corte;
        })
        ->rawColumns(['accion', 'docente', 'materia', 'corte'])
        ->make(true);
    }
    $docentes = Docente::all();
    $materias = Materia::all();
    $cortes = Corte::all();
    return view('pages/asignaciones/lista_asignacion', compact('docentes', 'materias', 'cortes'));
  }

  public function create()
  {
    //
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'docente' => 'required',
      'materia' => 'required',
      'corte' => 'required',
      'fecha_inicio' => 'required',
      'fecha_fin' => 'required',
      'numero_resolucion' => 'required',
      'fecha_resolucion' => 'required',
      'resolucion' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      if ($request->hasFile('resolucion')) {
        $file = $request->file('resolucion');
        $extension = $file->getClientOriginalExtension();
        $filename = $request->docente . '.' . $extension;
        $file->move('documentos/asigaciones', $filename);
      } else {
        $filename = '';
      }
      $materia = new Asignacion();
      $materia->docente = $request->docente;
      $materia->materia = $request->materia;
      $materia->cohorte = $request->corte;
      $materia->fecha_inicio = $request->fecha_inicio;
      $materia->fecha_fin = $request->fecha_fin;
      $materia->num_resolucion = $request->numero_resolucion;
      $materia->fecha_resolucion = $request->fecha_resolucion;
      $materia->resolucion = $filename;
      $materia->save();
      return 0;
    }
  }

  public function show($id)
  {
    //
  }

  public function edit($id, $mat)
  {
    // $asignacion = Asignacion::findOrFail($id);

    $asignacion = Asignacion::select('nom_persona', 'docente.ced_persona', 'nom_materia', 'id_materia', 'id_cohorte', 'desc_cohorte', 'docente_imparte_materia.fecha_inicio', 'docente_imparte_materia.fecha_fin', 'num_resolucion', 'fecha_resolucion')
      ->join('docente', 'docente', 'docente.ced_persona')
      ->join('persona', 'docente.ced_persona', 'persona.ced_persona')
      ->join('materia', 'materia', 'id_materia')
      ->join('cohorte', 'cohorte', 'id_cohorte')
      ->where('docente', $id)->where('materia', $mat)->get();


    return response()->json(['asignacion' => $asignacion]);
  }

  public function update(Request $request, $id, $mat)
  {
    $validator = Validator::make($request->all(), [
      'docente' => 'required',
      'materia' => 'required',
      'corte' => 'required',
      'fecha_inicio' => 'required',
      'fecha_fin' => 'required',
      'numero_resolucion' => 'required',
      'fecha_resolucion' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      $materia = Asignacion::where('docente', $id)->where('materia', $mat)->first();
      if ($request->hasFile('resolucion')) {
        $file = $request->file('resolucion');
        $extension = $file->getClientOriginalExtension();
        $filename = $request->docente . '.' . $extension;
        $file->move('documentos/asigaciones', $filename);
      } else {
        $filename = $materia->resolucion;
      }
      $materia->docente = $request->docente;
      $materia->materia = $request->materia;
      $materia->cohorte = $request->corte;
      $materia->fecha_inicio = $request->fecha_inicio;
      $materia->fecha_fin = $request->fecha_fin;
      $materia->num_resolucion = $request->numero_resolucion;
      $materia->fecha_resolucion = $request->fecha_resolucion;
      $materia->resolucion = $filename;
      $materia->save();
      return 0;
    }
  }

  public function destroy($id, $mat)
  {
    $materia = Asignacion::where('docente', $id)->where('materia', $mat)->first();
    $materia->delete();
  }
}
