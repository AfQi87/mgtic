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
          $acciones = '&nbsp<button type="button" onclick="verEstudiante(' . $estudiante->ced_persona . ')" name="verEstudiante" class="verEstudiante btn btn-info"><i class="bi bi-aspect-ratio"></i></i></button>';
          $acciones .= '<a href="javascript:void(0)" onclick="editarEstudiante(' . $estudiante->ced_persona . ')" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>';
          if ($estudiante->personas->estado_id == 1) {
            $acciones .= '&nbsp<button type="button" id="' . $estudiante->ced_persona . '" name="delete" class="desEstudiante btn btn-danger"><i class="bi bi-trash"></i></button>';
          } else {
            $acciones .= '&nbsp<button type="button" id="' . $estudiante->ced_persona . '" name="delete" class="actEstudiante btn btn-success"><i class="bi bi-check-lg"></i></button>';
          }
          return $acciones;
        })
        ->addColumn('fotoD', function ($estudiante) {
          if ($estudiante->personas->foto != null || $estudiante->personas->foto != '') {
            $foto = '<img src="/images/estudiantes/' . $estudiante->personas->foto . '" alt="" class="zoom" width="80" height="80">';
          } else {
            $foto = '<img src="/avatar/avatar.png" alt="" class="zoom" width="80" height="80">';
          }
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
    $estadosCivil = EstadoCivil::all();
    $instituciones = Institucion::all();
    $niveles = Nivel_Formacion::all();
    $profesiones = Estudio::all();
    return view('pages/estudiantes/lista_estudiantes', compact('tipos', 'profesiones', 'cortes', 'becas', 'sexos', 'estadosCivil', 'sangres', 'nacimientos', 'niveles', 'instituciones'));
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
      'documento' => 'required|unique:persona,ced_persona|max:15',
      'nombre' => 'required|max:100',
      'codigo' => 'required|max:15',
      'correo' => 'required|unique:persona,email_persona|max:100|email',
      'telefono' => 'required|min:7|max:20',
      'celular' => 'required|min:7|max:20',
      'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
      'corte' => 'required',
      'profesion' => 'required',
      'nivel' => 'required',
      'instituciones' => 'required',
      'semestre' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $extension = $file->getClientOriginalExtension();
        $filename = $request->ced_persona . '.' . $extension;
        $file->move('images/estudiantes', $filename);
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
      $persona->estado_id = 1;
      $persona->foto = $filename;
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
          $estudios = Estudio::findOrFail($request->profesiones[$i]);
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
    $estudiante->becas;
    $estudiante->cortes;
    $estudiante->personas->tipodocs;
    $estudiante->personas->tiposangre;
    $estudiante->personas->estadocivil;
    $estudiante->personas->sexos;
    $estudiante->personas->municipios;
    $profesiones = EstudianteEstudio::select('id_institucion', 'nom_institucion', 'id_estudio', 'nom_estudio', 'id_nivel', 'desc_nivel')
      ->join('institucion', 'id_institucion', '=', 'institucion')
      ->join('estudio', 'id_estudio', '=', 'estudio')
      ->join('nivel', 'nivel_estudio', '=', 'id_nivel')
      ->where('estudiante', "$id")->get();
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
      'telefono' => 'min:7|max:20',
      'celular' => 'min:7|max:20',
      'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
      'corte' => 'required',
      'profesion' => 'required',
      'nivel' => 'required',
      'instituciones' => 'required',
      'semestre' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      $persona = Persona::findOrFail($id);
      if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $extension = $file->getClientOriginalExtension();
        $filename = $request->documento . '.' . $extension;
        $file->move('images/estudiantes', $filename);
      } else {
        $filename = $persona->foto;
      }
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
      $persona->foto = $filename;
      $persona->save();

      $estudiante = Estudiante::findOrFail($id);
      $estudiante->ced_persona = $request->documento;
      $estudiante->codigo = $request->codigo;
      $estudiante->semestre = $request->semestre;
      $estudiante->cohorte = $request->corte;
      $estudiante->beca = $request->beca;
      $estudiante->save();

      $destudios = EstudianteEstudio::where('estudiante', $request->documento)->get();
      foreach ($destudios as $destudio) {
        $destudio->delete();
      }

      $cont = count($request->profesionact);
      for ($i = 0; $i < $cont; $i++) {
        if ($request->profesionact[$i] != NULL) {
          $est_estudio = new EstudianteEstudio();
          $est_estudio->estudiante = $request->documento;
          $est_estudio->estudio = $request->profesiones[$i];
          $est_estudio->institucion = $request->instituciones[$i];
          $est_estudio->save();
        }
      }
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

  public function delete($id)
  {
    $destudio = EstudianteEstudio::where('estudio', 'like', $id);
    $destudio->delete();

    return 0;
  }
}
