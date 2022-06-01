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
          $acciones .= '<a href="javascript:void(0)" onclick="editarCorte(' . $corte->id . ')" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>';
          if ($corte->estado_id == 1) {
            $acciones .= '&nbsp<button type="button" id="' . $corte->id . '" name="delete" class="desCorte btn btn-danger"><i class="bi bi-x-lg"></i></button>';
          } else {
            $acciones .= '&nbsp<button type="button" id="' . $corte->id . '" name="delete" class="actCorte btn btn-success"><i class="bi bi-check-lg"></i></button>';
          }
          return $acciones;
        })
        
        ->addColumn('estado', function ($corte) {
          $estado = $corte->estados->estado;
          return $estado;
        })
        ->rawColumns(['accion', 'estado'])
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
      'nombre' => 'required|unique:Corte,nombre|max:100',
      'fecha_inicio' => 'required',
      'fecha_finalizacion' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      $corte = new Corte();
      $corte->nombre = $request->nombre;
      $corte->numEstudiantes = 0;
      $corte->fecha_ini = $request->fecha_inicio;
      $corte->fecha_fin = $request->fecha_finalizacion;
      $corte->estado_id = 1;
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
      'nombre' => "required|unique:Corte,nombre,$request->nombre,nombre|max:100",
      'fecha_inicio' => 'required',
      'fecha_finalizacion' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      $corte = Corte::findOrFail($id);
      $corte->nombre = $request->nombre;
      $corte->fecha_ini = $request->fecha_inicio;
      $corte->fecha_fin = $request->fecha_finalizacion;
      $corte->save();
      return 0;
    }
  }

  public function destroy($id)
  {
    //
  }

  public function desactivar($id)
  {
    $corte = Corte::findOrFail($id);
    $corte->estado_id = 2;
    $corte->save();
    return 0;
  }

  public function activar($id)
  {
    $corte = Corte::findOrFail($id);
    $corte->estado_id = 1;
    $corte->save();
    return 0;
  }
}
