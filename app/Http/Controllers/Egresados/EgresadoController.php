<?php

namespace App\Http\Controllers\Egresados;

use App\Http\Controllers\Controller;
use App\Models\Barrio;
use App\Models\Beca;
use App\Models\Corte;
use App\Models\Egresado;
use App\Models\EstadoCivil;
use App\Models\Institucion;
use App\Models\Municipio;
use App\Models\Nivel_Formacion;
use App\Models\Persona;
use App\Models\Programa;
use App\Models\Sexo;
use App\Models\TipoDoc;
use App\Models\TipoSangre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;


class EgresadoController extends Controller
{
  public function index(Request $request)
  {
    
    $instituciones = Institucion::all();
    $tipos = TipoDoc::all();
    return view('pages/egresados/lista_egresados', compact('tipos', 'instituciones'));
  }

  public function indexDatos()
  {
    $a = Egresado::all();
    return datatables::of($a)
      ->addColumn('btn', function ($a) {
        $acciones = '<a href="javascript:void(0)" onclick="editarEgresado(' . $a->ced_persona . ')" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
        ';
        if ($a->personas->estado_id == 1) {
          $acciones .= '&nbsp<button type="button" id="' . $a->ced_persona . '" name="delete" class="desEgresado btn btn-danger"><i class="bi bi-trash"></i></button>';
        } else {
          $acciones .= '&nbsp<button type="button" id="' . $a->ced_persona . '" name="delete" class="actEgresado btn btn-success"><i class="bi bi-check-lg"></i></button>';
        }
        return $acciones;
      })
      ->addColumn('nombre', function ($a) {
        $nombre = $a->personas->nom_persona;
        return $nombre;
      })
      ->addColumn('correo', function ($a) {
        $nombre = $a->personas->email_persona;
        return $nombre;
      })
      ->addColumn('telefono', function ($a) {
        $nombre = $a->personas->tel_persona;
        return $nombre;
      })
      ->addColumn('institucion', function ($a) {
        $nombre = $a->programas->instituciones->nom_institucion;
        return $nombre;
      })
      ->addColumn('programa', function ($a) {
        $nombre = $a->programas->nom_programa;
        return $nombre;
      })
      ->addColumn('estado', function ($a) {
        $estado = $a->personas->estados->estado;
        return $estado;
      })
      ->rawColumns(['btn'])
      ->make(true);
  }
  public function programas($id)
  {
    $programas = Programa::where('institucion', "$id")->get();
    return response()->json(['programas' => $programas]);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'tipo_doc' => 'required',
      'documento' => 'required|unique:persona,ced_persona|max:15',
      'nombre' => 'required|max:100',
      'correo' => 'required|unique:persona,email_persona|max:100|email',
      'programa' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      $persona = new Persona();
      $persona->ced_persona = $request->documento;
      $persona->tipo_doc = $request->tipo_doc;
      $persona->nom_persona = $request->nombre;
      $persona->email_persona = $request->correo;

      if ($request->telefono == null) {
        $persona->tel_persona = 'NR';
      } else {
        $persona->tel_persona = $request->telefono;
      }

      if ($request->celular == null) {
        $persona->cel_persona = 'NR';
      } else {
        $persona->cel_persona = $request->celular;
      }
      $persona->sexo = null;
      $persona->estado_civil = null;
      $persona->tipo_sangre = null;
      $persona->fecha_nac = null;
      $persona->lugar_nac = null;
      $persona->direccion = null;
      $persona->estado_id = 1;
      $persona->save();

      $persona = new Egresado();
      $persona->ced_persona = $request->documento;
      $persona->programa = $request->programa_id;
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
    $egresado = Egresado::findOrFail($id);
    $egresado->personas;
    $egresado->personas->barrios;
    $egresado->personas->municipios;
    $institucion = $egresado->programas->instituciones->nom_institucion;
    $programa = $egresado->programas->nom_programa;
    $programas = Programa::where('institucion', $egresado->programas->instituciones->id_institucion)->get();

    return response()->json(['egresado' => $egresado, 'institucion' => $institucion, 'programa' => $programa, 'programas' => $programas]);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'tipo_doc' => 'required',
      'documento' => "required|unique:persona,ced_persona,$request->documento,ced_persona|max:15",
      'nombre' => 'required|max:100',
      'correo' => "required|unique:persona,email_persona,$request->correo,email_persona|max:100|email",
      'telefono' => '|min:7|max:20',
      'celular' => 'required|min:7|max:20',
      'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      $persona = Persona::findOrFail($id);
      $persona->ced_persona = $request->documento;
      $persona->tipo_doc = $request->tipo_doc;
      $persona->nom_persona = $request->nombre;
      $persona->email_persona = $request->correo;

      if ($request->telefono == null) {
        $persona->tel_persona = null;
      } else {
        $persona->tel_persona = $request->telefono;
      }

      $persona->cel_persona = $request->celular;
      $persona->sexo = null;
      $persona->estado_civil = null;
      $persona->tipo_sangre = null;
      $persona->fecha_nac = null;
      $persona->lugar_nac = null;
      $persona->direccion = null;
      $persona->save();

      $egresado = Egresado::findOrFail($id);
      $egresado->programa = $request->programa_id;
      $egresado->save();
      return 0;
    }
  }

  public function desactivar($id)
  {
    $persona = Persona::findOrFail($id);
    $persona->estado_id = 2;
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
