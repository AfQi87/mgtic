<?php

namespace App\Http\Controllers\Cortes;

use App\Http\Controllers\Controller;
use App\Models\Corte;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CorteController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $corte = Corte::all();
      return DataTables::of($corte)
        ->addColumn('accion', function ($corte) {
          $acciones = '';
          $acciones .= '<a href="javascript:void(0)" onclick="editarCorte(' . $corte->id_cohorte . ')" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>';
          $acciones .= '&nbsp<button type="button" id="' . $corte->id_cohorte . '" name="delete" class="desCorte btn btn-danger"><i class="bi bi-trash"></i></button>';
          return $acciones;
        })
        ->rawColumns(['accion'])
        ->make(true);
    }
    return view('pages/cortes/lista_cortes');
  }
  public function create()
  {
    //
  }
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'nombre' => 'required|unique:cohorte,desc_cohorte|max:100',
      'fecha_inicio' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      $corte = new Corte();
      $corte->desc_cohorte = $request->nombre;
      $corte->fecha_inicio = $request->fecha_inicio;
      $corte->fecha_fin = $request->fecha_finalizacion;
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
    $corte = Corte::findOrFail($id);
    return response()->json(['corte' => $corte]);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'nombre' => "required|unique:cohorte,desc_cohorte,$request->nombre,desc_cohorte|max:100",
      'fecha_inicio' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      $corte = Corte::findOrFail($id);
      $corte->desc_cohorte = $request->nombre;
      $corte->fecha_inicio = $request->fecha_inicio;
      $corte->fecha_fin = $request->fecha_finalizacion;
      $corte->save();
      return 0;
    }
  }

  public function destroy($id)
  {
    $corte = Corte::findOrFail($id);
    $corte->delete();
    return 0;
  }

}
