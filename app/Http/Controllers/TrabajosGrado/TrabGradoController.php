<?php

namespace App\Http\Controllers\TrabajosGrado;

use App\Http\Controllers\Controller;
use App\Models\Asignacion;
use App\Models\Corte;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Materia;
use App\Models\TrabajoGrado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TrabGradoController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $trabGrado = TrabajoGrado::all();
      return DataTables::of($trabGrado)
        ->addColumn('accion', function ($trabGrado) {
          $acciones = '';
          $acciones .= '<a href="javascript:void(0)" onclick="editarTrabGrado(' . $trabGrado->id_tg . ')" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>';
          $acciones .= '&nbsp<button type="button" id="' . $trabGrado->id_tg . '" name="delete" class="destgrado btn btn-danger"><i class="bi bi-trash"></i></button>';
          return $acciones;
        })
        ->addColumn('estudiante', function ($trabGrado) {
          $estudiante = $trabGrado->estudiantes->personas->ced_persona;
          return $estudiante;
        })
        ->addColumn('asesor', function ($trabGrado) {
          $asesor = $trabGrado->asesores->personas->nom_persona;
          return $asesor;
        })
        ->addColumn('jurado1', function ($trabGrado) {
          $jurado1 = $trabGrado->jurados1->personas->nom_persona;
          return $jurado1;
        })
        ->addColumn('jurado2', function ($trabGrado) {
          $jurado2 = $trabGrado->jurados2->personas->nom_persona;
          return $jurado2;
        })
        ->addColumn('jurado3', function ($trabGrado) {
          $jurado3 = $trabGrado->jurados3->personas->nom_persona;
          return $jurado3;
        })
        ->rawColumns(['accion', 'estudainte', 'asesor', 'jurado1', 'jurado2', 'jurado3'])
        ->make(true);
    }
    $docentes = Docente::all();
    $estudiantes = Estudiante::all();
    return view('pages/trabajosGrado/lista_trabajosGrado', compact('docentes', 'estudiantes'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'nombre' => 'required',
      'numero_acuerdo' => 'required',
      'fecha_inscripcion' => 'required',
      'estado' => 'required',
      'estudiante' => 'required',
      'asesor' => 'required',
      'jurado_1' => 'required',
      'jurado_2' => 'required',
      'jurado_3' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      if ($request->hasFile('acuerdo')) {
        $file = $request->file('acuerdo');
        $extension = $file->getClientOriginalExtension();
        $acuerdo = $request->estudiante . '.' . $extension;
        $file->move('documentos/trabajosGrado', $acuerdo);
      } else {
        $acuerdo = '';
      }
      if ($request->hasFile('acuerdo_inicio')) {
        $file = $request->file('acuerdo_inicio');
        $extension = $file->getClientOriginalExtension();
        $acuerdo_inicio = $request->estudiante . '.' . $extension;
        $file->move('documentos/trabajosGrado', $acuerdo_inicio);
      } else {
        $acuerdo_inicio = '';
      }
      $materia = new TrabajoGrado();
      $materia->nom_tg = $request->nombre;
      $materia->num_acuerdo_jr = $request->numero_acuerdo;
      $materia->acuerdo_js = $acuerdo;
      $materia->fecha_ins = $request->fecha_inscripcion;
      $materia->num_acuerdo_apb = $request->numero_acuerdo_inicio;
      $materia->acuerdo_apb = $acuerdo_inicio;
      $materia->fecha_apb = $request->fecha_aprobacion;
      $materia->fecha_ent = $request->fecha_entrega;
      $materia->puntuacion = $request->puntuacion;
      $materia->calificacion = $request->calificacion;
      $materia->estado = $request->estado;
      $materia->estudiante = $request->estudiante;
      $materia->asesor = $request->asesor;
      $materia->jurado1 = $request->jurado_1;
      $materia->jurado2 = $request->jurado_2;
      $materia->jurado3 = $request->jurado_3;

      $materia->save();
      return 0;
    }
  }

  public function show($id)
  {
    //
  }

  public function edit($id)
  {
    $trabajoGrado = TrabajoGrado::findOrFail($id);
    $estudiante = $trabajoGrado->estudiantes->personas->nom_persona;
    $asesor = $trabajoGrado->asesores->personas->nom_persona;
    $jurado1 = $trabajoGrado->jurados1->personas->nom_persona;
    $jurado2 = $trabajoGrado->jurados2->personas->nom_persona;
    $jurado3 = $trabajoGrado->jurados3->personas->nom_persona;
    return response()->json(['trabajos' => $trabajoGrado]);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'nombre' => 'required',
      'numero_acuerdo' => 'required',
      'fecha_inscripcion' => 'required',
      'estado' => 'required',
      'estudiante' => 'required',
      'asesor' => 'required',
      'jurado_1' => 'required',
      'jurado_2' => 'required',
      'jurado_3' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      $trabGrado = TrabajoGrado::findOrFail($id);
      if ($request->hasFile('acuerdo')) {
        $file = $request->file('acuerdo');
        $extension = $file->getClientOriginalExtension();
        $acuerdo = $request->estudiante . '.' . $extension;
        $file->move('documentos/trabajosGrado', $acuerdo);
      } else {
        $acuerdo = $trabGrado->acuerdo_js;
      }
      if ($request->hasFile('acuerdo_inicio')) {
        $file = $request->file('acuerdo_inicio');
        $extension = $file->getClientOriginalExtension();
        $acuerdo_inicio = $request->estudiante . '.' . $extension;
        $file->move('documentos/trabajosGrado', $acuerdo_inicio);
      } else {
        $acuerdo_inicio = $trabGrado->acuerdo_apb;
      }
      $trabGrado->nom_tg = $request->nombre;
      $trabGrado->num_acuerdo_jr = $request->numero_acuerdo;
      $trabGrado->acuerdo_js = $acuerdo;
      $trabGrado->fecha_ins = $request->fecha_inscripcion;
      $trabGrado->num_acuerdo_apb = $request->numero_acuerdo_inicio;
      $trabGrado->acuerdo_apb = $acuerdo_inicio;
      $trabGrado->fecha_apb = $request->fecha_aprobacion;
      $trabGrado->fecha_ent = $request->fecha_entrega;
      $trabGrado->puntuacion = $request->puntuacion;
      $trabGrado->calificacion = $request->calificacion;
      $trabGrado->estado = $request->estado;
      $trabGrado->estudiante = $request->estudiante;
      $trabGrado->asesor = $request->asesor;
      $trabGrado->jurado1 = $request->jurado_1;
      $trabGrado->jurado2 = $request->jurado_2;
      $trabGrado->jurado3 = $request->jurado_3;

      $trabGrado->save();
      return 0;
    }
  }

  public function destroy($id)
  {
    $trabGrado = TrabajoGrado::findOrFail($id);
    $trabGrado->delete();
    return 0;
  }
}
