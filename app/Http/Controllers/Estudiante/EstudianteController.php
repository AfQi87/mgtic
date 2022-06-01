<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Corte;
use App\Models\Estudiante;
use App\Models\ProfesionEstudiante;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class EstudianteController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $estudiante = Estudiante::all();
      return DataTables::of($estudiante)
        ->addColumn('accion', function ($estudiante) {
          $acciones = '';
          $acciones .= '<a href="javascript:void(0)" onclick="editarEstudiante(' . $estudiante->id . ')" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>';
          $acciones .= '&nbsp<button type="button" id="' . $estudiante->id . '" name="delete" class="deleteEstudiante btn btn-danger"><i class="bi bi-trash"></i></button>';
          return $acciones;
        })
        ->addColumn('fotoD', function ($estudiante) {
          if ($estudiante->foto != null || $estudiante->foto != '') {
            $foto = '<img src="/images/estudiantes/' . $estudiante->foto . '" alt="" class="zoom" width="80" height="80">';
          } else {
            $foto = '<img src="/avatar/avatar.png" alt="" class="zoom" width="80" height="80">';
          }
          return $foto;
        })
        ->addColumn('corte', function ($estudiante) {
          $corte = $estudiante->cortes->nombre;
          return $corte;
        })
        ->addColumn('estado', function ($docente) {
          $estado = $docente->estados->estado;
          return $estado;
        })
        ->rawColumns(['accion', 'fotoD', 'campo'])
        ->make(true);
    }
    $cortes = Corte::all();
    return view('pages/estudiantes/Lista_estudiantes', compact('cortes'));
  }

  public function create()
  {
    //
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'nombre' => 'required|max:150',
      'codigo' => 'required|max:15',
      'correo' => 'required|unique:Estudiante,correo|max:150|email',
      'telefono' => 'required|min:7|max:20',
      'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
      'corte' => 'required',
      'profesion' => 'required'
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $extension = $file->getClientOriginalExtension();
        $filename = date('YmdHis') . '.' . $extension;
        $file->move('images/estudiantes', $filename);
      } else {
        $filename = '';
      }
      $docente = new Estudiante();
      $docente->nombre = $request->nombre;
      $docente->codigo = $request->codigo;
      $docente->correo = $request->correo;
      $docente->telefono = $request->telefono;
      $docente->foto = $filename;
      $docente->corte_id = $request->corte;
      $docente->estado_id = 1;
      $docente->save();

      $idEst = Estudiante::get()->last();
      $cont = count($request->profesion);
      for ($i = 0; $i < $cont; $i++) {
        if ($request->profesion[$i] == NULL) {
        } else {
          $profesion = new ProfesionEstudiante();
          $profesion->estudiante_id = $idEst->id;
          $profesion->estudios = $request->profesion[$i];
          $profesion->save();
        }
      }
      $corte = Corte::findOrFail($request->corte);
      $corte->numEstudiantes = ($corte->numEstudiantes)+1;
      $corte->save();

      return 0;
    }
  }

  public function show($id)
  {
    //
  }

  public function edit($id)
  {
    //
  }

  public function update(Request $request, $id)
  {
    //
  }

  public function destroy($id)
  {
    $estudiante = Estudiante::findOrFail($id);

    $profesiones = ProfesionEstudiante::where('estudiante_id', $estudiante->id)->get();

		foreach($profesiones as $profesion){
			$profesion->delete();
		}

    $corte = Corte::findOrFail($estudiante->corte_id);
    $corte->numEstudiantes = ($corte->numEstudiantes)-1;
    $corte->save();
    $estudiante->delete();

    return 0;
  }
}
