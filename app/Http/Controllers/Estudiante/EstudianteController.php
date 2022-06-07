<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Barrio;
use App\Models\Beca;
use App\Models\Corte;
use App\Models\EstadoCivil;
use App\Models\Estudiante;
use App\Models\EstudianteEstudio;
use App\Models\Estudio;
use App\Models\Institucion;
use App\Models\LugarNacimiento;
use App\Models\Municipio;
use App\Models\Nivel_Formacion;
use App\Models\Persona;
use App\Models\ProfesionEstudiante;
use App\Models\Sexo;
use App\Models\TipoDoc;
use App\Models\TipoSangre;
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
          $acciones .= '<a href="javascript:void(0)" onclick="editarEstudiante(' . $estudiante->ced_persona . ')" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>';
          $acciones .= '&nbsp<button type="button" id="' . $estudiante->ced_persona . '" name="delete" class="deleteEstudiante btn btn-danger"><i class="bi bi-trash"></i></button>';
          return $acciones;
        })
        ->addColumn('fotoD', function ($estudiante) {
          // if ($estudiante->foto != null || $estudiante->foto != '') {
          //   $foto = '<img src="/images/estudiantes/' . $estudiante->foto . '" alt="" class="zoom" width="80" height="80">';
          // } else {
          //   $foto = '<img src="/avatar/avatar.png" alt="" class="zoom" width="80" height="80">';
          // }
          $foto = '<img src="/avatar/avatar.png" alt="" class="zoom" width="80" height="80">';
          return $foto;
        })
        ->addColumn('corte', function ($estudiante) {
          $corte = $estudiante->cortes->desc_cohorte;
          return $corte;
        })
        ->addColumn('nombre', function ($estudiante) {
          $nombre = $estudiante->personas->nom_persona;
          return $nombre;
        })
        ->addColumn('correo', function ($estudiante) {
          $correo = $estudiante->personas->email_persona;
          return $correo;
        })
        ->rawColumns(['accion', 'fotoD', 'campo', 'corte', 'nombre', 'correo'])
        ->make(true);
    }
    $tipos = TipoDoc::all();
    $cortes = Corte::all();
    $becas = Beca::all();
    $sexos = Sexo::all();
    $sangres = TipoSangre::all();
    $nacimientos = Municipio::all();
    $barrios = Barrio::all();
    $estadosCivil = EstadoCivil::all();
    $instituciones = Institucion::all();
    $niveles = Nivel_Formacion::all();
    return view('pages/estudiantes/lista_estudiantes', compact('tipos', 'cortes', 'becas', 'sexos', 'estadosCivil', 'sangres', 'nacimientos', 'barrios', 'niveles', 'instituciones'));
  }

  public function niveles()
  {
    $niveles = Nivel_Formacion::all();
    return response()->json(['niveles' => $niveles]);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'tipo_doc' => 'required',
      'documento' => 'required|max:15',
      'nombre' => 'required|max:100',
      'codigo' => 'required|max:15',
      'correo' => 'required|unique:persona,email_persona|max:100|email',
      'correo' => "required|unique:Persona,email_persona,$request->correo,email_persona|max:100|email",
      'telefono' => 'required|min:7|max:20',
      'celular' => 'required|min:7|max:20',
      'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
      'sexo' => 'required',
      'estado_civil' => 'required',
      'tipo_sangre' => 'required',
      'nacimiento' => 'required',
      'barrio' => 'required',
      'fecha' => 'required',
      'corte' => 'required',
      'beca' => 'required',
      'profesion' => 'required',
      'nivel' => 'required',
      'instituciones' => 'required',
      'semestre' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      if ($request->hasFile('foto')) {
        // $file = $request->file('foto');
        // $extension = $file->getClientOriginalExtension();
        // $filename = date('YmdHis') . '.' . $extension;
        // $file->move('images/estudiantes', $filename);
      } else {
        $filename = '';
      }
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

      $estudiante = new Estudiante();
      $estudiante->ced_persona = $request->documento;
      $estudiante->codigo = $request->codigo;
      $estudiante->semestre = $request->semestre;
      $estudiante->cohorte = $request->corte;
      $estudiante->beca = $request->beca;
      $estudiante->save();

      $cont = count($request->profesion);
      for ($i = 0; $i < $cont; $i++) {
        if ($request->profesion[$i] != NULL) {
          $estudio = new Estudio();
          $estudio->nom_estudio = $request->profesion[$i];
          $estudio->nivel_estudio = $request->nivel[$i];
          $estudio->save();

          $estudios = Estudio::get()->last();

          $est_estudio = new EstudianteEstudio();
          $est_estudio->estudiante = $request->documento;
          $est_estudio->estudio = $estudios->id_estudio;
          $est_estudio->institucion = $request->instituciones[$i];
          $est_estudio->save();
        }
      }


      return 0;
    }
  }

  public function show($id)
  {
    //
  }

  public function edit($id)
  {
    $estudiante = Estudiante::findOrFail($id);
    $estudiante->personas;
    $estudiante->personas->barrios;
    $estudiante->personas->municipios;
    // $profesiones = EstudianteEstudio::where('estudiante', $id)->get();
    $profesiones = EstudianteEstudio::select('id_institucion', 'nom_institucion', 'id_estudio', 'nom_estudio', 'id_nivel', 'desc_nivel')
      ->join('institucion', 'id_institucion', 'like', 'institucion')
      ->join('estudio', 'id_estudio', 'like', 'estudio')
      ->join('nivel', 'nivel_estudio', 'like', 'id_nivel')
      ->where('estudiante', $id)->get();
    // $profesiones->intituciones;
    return response()->json(['estudiante' => $estudiante, 'profesiones' => $profesiones]);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'tipo_doc' => 'required',
      'documento' => "required|unique:persona,ced_persona,$request->documento,ced_persona|max:15",
      'nombre' => 'required|max:100',
      'codigo' => "required|unique:estudiante,codigo,$request->codigo,codigo|max:15",
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
      'corte' => 'required',
      'beca' => 'required',
      'profesion' => 'required',
      'nivel' => 'required',
      'instituciones' => 'required',
      'semestre' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      if ($request->hasFile('foto')) {
        // $file = $request->file('foto');
        // $extension = $file->getClientOriginalExtension();
        // $filename = date('YmdHis') . '.' . $extension;
        // $file->move('images/estudiantes', $filename);
      } else {
        $filename = '';
      }
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

      $estudiante = Estudiante::findOrFail($id);
      $estudiante->ced_persona = $request->documento;
      $estudiante->codigo = $request->codigo;
      $estudiante->semestre = $request->semestre;
      $estudiante->cohorte = $request->corte;
      $estudiante->beca = $request->beca;
      $estudiante->save();

      $cont = count($request->profesionact);
      for ($i = 0; $i < $cont; $i++) {
        if ($request->profesionact[$i] != NULL) {
          $estudio = Estudio::where('id_estudio', $request->profesion[$i])->first();
          if ($estudio == null) {
            $estudio = new Estudio();
            $estudio->nom_estudio = $request->profesionact[$i];
            $estudio->nivel_estudio = $request->nivel[$i];
            $estudio->save();

            $estudios = Estudio::get()->last();

            $est_estudio = new EstudianteEstudio();
            $est_estudio->estudiante = $request->documento;
            $est_estudio->estudio = $estudios->id_estudio;
            $est_estudio->institucion = $request->instituciones[$i];
            $est_estudio->save();
          }else{
            $estudio->nom_estudio = $request->profesionact[$i];
            $estudio->nivel_estudio = $request->nivel[$i];
            $estudio->save();
          }
        }
      }
      return 0;
    }
  }

  public function destroy($id, $est)
  {
    $estudio = EstudianteEstudio::where('estudiante', $est)->where('estudio', $id)->first();
    $estudio->delete();

    $estudio = Estudio::findOrFail($id);
    $estudio->delete();

    return 0;
  }
}
