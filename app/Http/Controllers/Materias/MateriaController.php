<?php

namespace App\Http\Controllers\Materias;

use App\Http\Controllers\Controller;
use App\Models\AreaFormacion;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MateriaController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $materia = Materia::all();
      return DataTables::of($materia)
        ->addColumn('accion', function ($materia) {
          $acciones = '';
          $acciones .= '<a href="javascript:void(0)" onclick="editarMateria(' . $materia->id_materia . ')" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>';
          $acciones .= '&nbsp<button type="button" id="' . $materia->id_materia . '" name="delete" class="desMateria btn btn-danger"><i class="bi bi-trash"></i></button>';
          return $acciones;
        })
        ->addColumn('area', function ($materia) {
          $area = $materia->areas->nom_area_form;
          return $area;
        })
        ->rawColumns(['accion', 'area'])
        ->make(true);
    }
    $areas = AreaFormacion::all();
    return view('pages/materias/lista_materias', compact('areas'));
  }

  public function create()
  {
    //
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'nombre' => 'required|unique:materia,nom_materia|max:200',
      'creditos' => 'required',
      'semestre' => 'required',
      'area' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      if ($request->hasFile('foa')) {
        $file = $request->file('foa');
        $extension = $file->getClientOriginalExtension();
        $filename = date('YmdHis') . '.' . $extension;
        $file->move('documentos/materias', $filename);
      } else {
        $filename = '';
      }
      $materia = new Materia();
      $materia->nom_materia = $request->nombre;
      $materia->num_creditos = $request->creditos;
      $materia->semestre = $request->semestre;
      $materia->foa = $filename;
      $materia->area_form = $request->area;
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
    $materia = Materia::findOrFail($id);
    $materia->areas;
    return response()->json(['materia' => $materia]);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'nombre' => "required|unique:materia,nom_materia,$request->nombre,nom_materia|max:200",
      'creditos' => 'required',
      'semestre' => 'required',
      'area' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      if ($request->hasFile('foa')) {
        $file = $request->file('foa');
        $extension = $file->getClientOriginalExtension();
        $filename = date('YmdHis') . '.' . $extension;
        $file->move('documentos/materias', $filename);
      } else {
        $mat = Materia::findOrFail($id);
        $filename = $mat->foa;;
      }
      $corte = Materia::findOrFail($id);
      $corte->nom_materia = $request->nombre;
      $corte->num_creditos = $request->creditos;
      $corte->semestre = $request->semestre;
      $corte->foa = $filename;
      $corte->area_form = $request->area;
      $corte->save();
      return 0;
    }
  }

  public function destroy($id)
  {
    $materia = Materia::findOrFail($id);
    $materia->delete();
    return 0;
  }
}
