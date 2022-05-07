<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cargo;
use App\Models\Rol;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
  /**
   * Display a listing of the users
   *
   * @param  \App\Models\User  $model
   * @return \Illuminate\View\View
   */
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $user = User::all();
      return DataTables::of($user)
        ->addColumn('accion', function ($user) {
          $acciones = '<a href="javascript:void(0)" onclick="editarUsuario(' . $user->id . ')" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>';
          if ($user->estado_id == 1) {
            $acciones .= '&nbsp<button type="button" id="' . $user->id . '" name="delete" class="desUser btn btn-danger"><i class="bi bi-x-lg"></i></button>';
          } else {
            $acciones .= '&nbsp<button type="button" id="' . $user->id . '" name="delete" class="actUser btn btn-success"><i class="bi bi-check-lg"></i></button>';
          }
          return $acciones;
        })
        ->addColumn('estado', function ($user) {
          $estado = $user->estados->estado;
          return $estado;
        })
        ->addColumn('cargo', function ($user) {
          $cargo = $user->cargos->cargo;
          return $cargo;
        })
        ->addColumn('rol', function ($user) {
          $rol = $user->roles->rol;
          return $rol;
        })
        ->rawColumns(['accion', 'estado', 'cargo', 'rol'])
        ->make(true);
    }
    return view('users.index');
  }

  public function formuser()
  {
    $cargos = Cargo::all();
    $roles = Rol::all();
    return response()->json(['cargos' => $cargos, 'roles' => $roles]);
  }

  public function regusuario(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'nombre' => 'required|max:150',
      'correo' => 'required|unique:users,email|max:150|email',
      'documento' => 'required|min:8',
      'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
      'telefono' => 'required|min:10',
      'cargo' => 'required'
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $extension = $file->getClientOriginalExtension();
        $filename = date('YmdHis') . '.' . $extension;
        $file->move('images/', $filename);
      }else{
        $filename = '';
      }
      $user = User::create([
        'name' => $request->nombre,
        'email' => $request->correo,
        'password' => Hash::make($request->documento),
        'telefono' => $request->telefono,
        'foto' => $filename,
        'cargo_id' => $request->cargo,
        'rol_id' => 1,
        'estado_id' => 1,
      ]);
      event(new Registered($user));
      return 0;
    }
  }

  public function formactualizar($id)
  {
    $user = User::findOrFail($id);
    $cargos = cargo::all();
    $roles = Rol::all();
    return response()->json(['usuario' => $user, 'cargos' => $cargos, 'roles' => $roles]);
  }

  public function actualizar(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'name_act' => 'required|max:150',
      'foto_act' => 'image|mimes:jpeg,png,jpg|max:2048',
      'telefono_act' => 'required|min:10',
      'cargo_id_act' => 'required',
      'rol_id_act' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      $user = User::findOrFail($id);
      if ($request->hasFile('foto_act')) {
        $file = $request->file('foto_act');
        $extension = $file->getClientOriginalExtension();
        $filename = date('YmdHis') . '.' . $extension;
        $file->move('images/', $filename);
      }else{
        $filename = $user->foto;
      }
      $user->name = $request->name_act;
      $user->telefono = $request->telefono_act;
      $user->foto = $filename;
      $user->cargo_id = $request->cargo_id_act;
      $user->rol_id = $request->rol_id_act;
      $user->save();
      return 0;
    }
  }

  public function desactivar($id)
  {
    $user = User::findOrFail($id);
    $user->estado_id = 2;
    $user->save();
    return 0;
  }

  public function activar($id)
  {
    $user = User::findOrFail($id);
    $user->estado_id = 1;
    $user->save();
    return 0;
  }
}