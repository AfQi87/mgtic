<?php

namespace App\Http\Controllers\Egresados;

use App\Http\Controllers\Controller;
use App\Models\Institucion;
use App\Models\Persona;
use App\Models\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;


class EgresadoController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $persona = Persona::all();
      return DataTables::of($persona)
        ->addColumn('accion', function ($persona) {
          $acciones = '';
          $acciones .= '<a href="javascript:void(0)" onclick="editarEgresado(' . $persona->ced_persona . ')" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>';
          if ($persona->estado_id == 1) {
            $acciones .= '&nbsp<button type="button" id="' . $persona->ced_persona . '" name="delete" class="desEgresado btn btn-danger"><i class="bi bi-x-lg"></i></button>';
          } else {
            $acciones .= '&nbsp<button type="button" id="' . $persona->ced_persona . '" name="delete" class="actEgresado btn btn-success"><i class="bi bi-check-lg"></i></button>';
          }
          return $acciones;
        })
        ->addColumn('institucion', function ($persona) {
          $institucion = $persona->programas->instituciones->nom_institucion;
          return $institucion;
        })
        ->addColumn('programa', function ($persona) {
          $programa = $persona->programas->nom_programa;
          return $programa;
        })
        ->addColumn('estado', function ($persona) {
          $estado = $persona->estados->estado;
          return $estado;
        })
        ->rawColumns(['accion', 'institucion', 'programa', 'estado'])
        ->make(true);
    }
    $instituciones = Institucion::all();
    return view('pages/egresados/lista_egresados', compact('instituciones'));
  }

  public function programas($id)
  {
    $programas = Programa::where('institucion', $id)->get();
    return response()->json(['programas' => $programas]);
  }

  public function create()
  {
    //
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'cedula' => 'required|unique:Persona,ced_persona|max:15',
      'nombre' => 'required|max:100',
      'correo' => 'required|unique:Persona,email_persona|max:100|email',
      'telefono' => 'required|min:10',
      'programa' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      $persona = new Persona();
      $persona->ced_persona = $request->cedula;
      $persona->nom_persona = $request->nombre;
      $persona->email_persona = $request->correo;
      $persona->tel_persona = $request->telefono;
      $persona->programa = $request->programa;
      $persona->estado_id = 1;
      $persona->save();
      return 0;
    }
  }

  public function show($id)
  {
    //
  }

  public function edit($id)
  {
    $persona = Persona::findOrFail($id);
    $institucion = $persona->programas->instituciones->nom_institucion;
    $programa = $persona->programas->nom_programa;
    $programas = Programa::where('institucion', $persona->programas->instituciones->id_institucion)->get();

    return response()->json(['persona' => $persona, 'institucion' => $institucion, 'programa' => $programa, 'programas' => $programas]);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'cedula' => "required|unique:Persona,ced_persona,$request->cedula,ced_persona|max:15",
      'nombre' => 'required|max:100',
      'correo' => "required|unique:Persona,email_persona,$request->correo,email_persona|max:100|email",
      'telefono' => 'required|min:10',
      'programa' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      $persona = Persona::findOrFail($id);
      $persona->ced_persona = $request->cedula;
      $persona->nom_persona = $request->nombre;
      $persona->email_persona = $request->correo;
      $persona->tel_persona = $request->telefono;
      $persona->programa = $request->programa;
      $persona->save();
      return 0;
    }
  }

  public function destroy($id)
  {
    //
  }

  public function desactivar($id)
  {
    $persona = Persona::findOrFail($id);
    $persona->estado_id = 0;
    $persona->save();
    return 0;
  }

  public function activar($id)
  {
    $persona = Persona::findOrFail($id);
    $persona->estado_id = 1;
    $persona->save();
    return 0;
  }
}
