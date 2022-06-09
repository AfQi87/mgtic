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
    if ($request->ajax()) {
      $persona = Egresado::all();
      return DataTables::of($persona)
        ->addColumn('accion', function ($persona) {
          $acciones = '';
          $acciones .= '<a href="javascript:void(0)" onclick="editarEgresado(' . $persona->ced_persona . ')" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>';
          $acciones .= '&nbsp<button type="button" id="' . $persona->ced_persona . '" name="delete" class="deleteEgresado btn btn-danger"><i class="bi bi-trash"></i></button>';
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
        ->addColumn('nombre', function ($persona) {
          $nombre = $persona->personas->nom_persona;
          return $nombre;
        })
        ->addColumn('correo', function ($persona) {
          $correo = $persona->personas->email_persona;
          return $correo;
        })
        ->addColumn('telefono', function ($persona) {
          $telefono = $persona->personas->tel_persona;
          return $telefono;
        })
        ->rawColumns(['accion', 'institucion', 'programa', 'nombre', 'correo', 'telefono'])
        ->make(true);
    }
    $instituciones = Institucion::all();
    $tipos = TipoDoc::all();
    $cortes = Corte::all();
    $becas = Beca::all();
    $sexos = Sexo::all();
    $sangres = TipoSangre::all();
    $nacimientos = Municipio::all();
    $barrios = Barrio::all();
    $estadosCivil = EstadoCivil::all();
    $niveles = Nivel_Formacion::all();
    return view('pages/egresados/lista_egresados', compact('tipos', 'cortes', 'becas', 'sexos', 'estadosCivil', 'sangres', 'nacimientos', 'barrios', 'niveles', 'instituciones'));
  }

  public function programas($id)
  {
    $programas = Programa::where('institucion', $id)->get();
    return response()->json(['programas' => $programas]);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'tipo_doc' => 'required',
      'documento' => 'required|unique:persona,ced_persona|max:15',
      'nombre' => 'required|max:100',
      'correo' => 'required|unique:persona,email_persona|max:100|email',
      'telefono' => 'required|min:7|max:20',
      'celular' => 'required|min:7|max:20',
      'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
      'sexo' => 'required',
      'estado_civil' => 'required',
      'tipo_sangre' => 'required',
      'nacimiento' => 'required',
      'barrio' => 'required',
      'fecha' => 'required',
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
      $persona->tel_persona = $request->telefono;
      $persona->cel_persona = $request->celular;
      $persona->sexo = $request->sexo;
      $persona->estado_civil = $request->estado_civil;
      $persona->tipo_sangre = $request->tipo_sangre;
      $persona->fecha_nac = $request->fecha;
      $persona->lugar_nac = $request->nacimiento;
      $persona->direccion = $request->direccion;
      $persona->barrio = $request->barrio;
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
      'telefono' => 'required|min:7|max:20',
      'celular' => 'required|min:7|max:20',
      'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
      'sexo' => 'required',
      'estado_civil' => 'required',
      'tipo_sangre' => 'required',
      'nacimiento' => 'required',
      'barrio' => 'required',
      'fecha' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      $persona = Persona::findOrFail($id);
      $persona->ced_persona = $request->documento;
      $persona->tipo_doc = $request->tipo_doc;
      $persona->nom_persona = $request->nombre;
      $persona->email_persona = $request->correo;
      $persona->tel_persona = $request->telefono;
      $persona->cel_persona = $request->celular;
      $persona->sexo = $request->sexo;
      $persona->estado_civil = $request->estado_civil;
      $persona->tipo_sangre = $request->tipo_sangre;
      $persona->fecha_nac = $request->fecha;
      $persona->lugar_nac = $request->nacimiento;
      $persona->direccion = $request->direccion;
      $persona->barrio = $request->barrio;
      $persona->save();

      $egresado = Egresado::findOrFail($id);
      $egresado->programa = $request->programa_id;
      $egresado->save();
      return 0;
    }
  }

  public function destroy($id)
  {
    $egresado = Egresado::findOrFail($id);
    $egresado->delete();

    $persona = Persona::findOrFail($id);
    $persona->delete();
    return 0;
  }
}
