<?php

namespace App\Http\Controllers\Docentes;

use App\Http\Controllers\Controller;
use App\Models\Campo;
use App\Models\Docente;
use App\Models\Profesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Return_;

use Yajra\DataTables\Facades\DataTables;

class DocenteController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $docente = Docente::all();
      return DataTables::of($docente)
        ->addColumn('accion', function ($docente) {
          $acciones = '<a href="javascript:void(0)" onclick="editarDocente(' . $docente->id . ')" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>';
          if ($docente->estado_id == 1) {
            $acciones .= '&nbsp<button type="button" id="' . $docente->id . '" name="delete" class="desDocente btn btn-danger"><i class="bi bi-x-lg"></i></button>';
          } else {
            $acciones .= '&nbsp<button type="button" id="' . $docente->id . '" name="delete" class="actDocente btn btn-success"><i class="bi bi-check-lg"></i></button>';
          }
          return $acciones;
        })
        ->addColumn('fotoD', function ($docente) {
          $foto = '<img src="/images/docentes/' . $docente->foto . '" alt="" class="zoom" width="80" height="80">';
          return $foto;
        })
        ->addColumn('estado', function ($docente) {
          $estado = $docente->estados->estado;
          return $estado;
        })
        ->addColumn('campo', function ($docente) {
          $campo = $docente->campos->campo;
          return $campo;
        })
        ->rawColumns(['accion', 'fotoD', 'estado', 'campo'])
        ->make(true);
    }
    return view('pages/docentes/ListaDocentes');
  }

  public function create()
  {
    $campos = Campo::all();
    return response()->json(['campos' => $campos]);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'nombre' => 'required|max:150',
      'correo' => 'required|unique:docente,correo|max:150|email',
      'telefono' => 'required|min:10',
      'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
      'campo' => 'required',
      'profesion' => 'required'
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $extension = $file->getClientOriginalExtension();
        $filename = date('YmdHis') . '.' . $extension;
        $file->move('images/docentes', $filename);
      } else {
        $filename = '';
      }
      $docente = new Docente();
      $docente->nombre = $request->nombre;
      $docente->correo = $request->correo;
      $docente->telefono = $request->telefono;
      $docente->foto = $filename;
      $docente->campo_id = $request->campo;
      $docente->estado_id = 1;
      $docente->save();

      $idDocente = Docente::get()->last();
      $cont = count($request->profesion);
      for ($i = 0; $i < $cont; $i++) {
        if ($request->profesion[$i] == NULL) {
        } else {
          $profesion = new Profesion();
          $profesion->docente_id = $idDocente->id;
          $profesion->estudios = $request->profesion[$i];
          $profesion->save();
        }
      }
      return 0;
    }
  }

  public function show($id)
  {
    $docente = Docente::findOrFail($id);
    $profesion = Profesion::where('docente_id', $docente->id)->get();
    return response()->json(['docente' => $docente, 'profesiones' => $profesion]);
  }

  public function edit($id)
  {
    $docente = Docente::findOrFail($id);
    $campos = Campo::all();
    $profesion = Profesion::where('docente_id', $docente->id)->get();
    return response()->json(['docente' => $docente, 'campos' => $campos, 'profesiones' => $profesion]);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'nombre_act' => 'required|max:150',
      'correo_act' => "required|unique:docente,correo,$request->id,id|max:150|email",
      'telefono_act' => 'required|min:10',
      'foto_act' => 'image|mimes:jpeg,png,jpg|max:2048',
      'campo_act' => 'required',
      'profesionact' => 'required'
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      $docente = Docente::findOrFail($id);
      if ($request->hasFile('foto_act')) {
        $file = $request->file('foto_act');
        $extension = $file->getClientOriginalExtension();
        $filename = date('YmdHis') . '.' . $extension;
        $file->move('images/docentes', $filename);
      } else {
        $filename = $docente->foto;
      }
      $docente->nombre = $request->nombre_act;
      $docente->correo = $request->correo_act;
      $docente->telefono = $request->telefono_act;
      $docente->foto = $filename;
      $docente->campo_id = $request->campo_act;
      $docente->save();

      $cont = count($request->profesionact);
      for ($i = 0; $i < $cont; $i++) {
        if ($request->profesionact[$i] == NULL) {
        } else {
          $profesion = Profesion::where('docente_id', $id)->where('id', $request->profesion_id[$i])->first();
          if ($profesion == null) {
            $profesion = new Profesion();
            $profesion->docente_id = $id;
            $profesion->estudios = $request->profesionact[$i];
            $profesion->save();
          } else {
            $profesion = Profesion::findOrFail($request->profesion_id[$i]);
            $profesion->estudios = $request->profesionact[$i];
            $profesion->save();
          }
        }
      }
      return 0;
    }
  }

  public function delete($id)
  {
    $profesion = Profesion::findOrFail($id);
    $profesion->delete();
    return 0;
  }

  public function desactivar($id)
  {
    $docente = Docente::findOrFail($id);
    $docente->estado_id = 0;
    $docente->save();
    return 0;
  }

  public function activar($id)
  {
    $docente = Docente::findOrFail($id);
    $docente->estado_id = 1;
    $docente->save();
    return 0;
  }
}
