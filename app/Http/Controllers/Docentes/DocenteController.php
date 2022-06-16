<?php

namespace App\Http\Controllers\Docentes;

use App\Http\Controllers\Controller;
use App\Models\AreaConocimiento;
use App\Models\Asignacion;
use App\Models\Barrio;
use App\Models\Beca;
use App\Models\Campo;
use App\Models\Corte;
use App\Models\Docente;
use App\Models\DocenteAreaConocimiento;
use App\Models\DocenteEstudio;
use App\Models\EstadoCivil;
use App\Models\Estudio;
use App\Models\Institucion;
use App\Models\Materia;
use App\Models\Municipio;
use App\Models\Nivel_Formacion;
use App\Models\Persona;
use App\Models\Profesion;
use App\Models\Sexo;
use App\Models\Tipo;
use App\Models\TipoDoc;
use App\Models\TipoSangre;
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
          $acciones = '<a href="javascript:void(0)" onclick="editarDocente(' . $docente->ced_persona . ')" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>';
          $acciones .= '&nbsp<button type="button" id="' . $docente->ced_persona . '" name="delete" class="deleteDocente btn btn-danger"><i class="bi bi-trash"></i></button>';
          return $acciones;
        })
        ->addColumn('fotoD', function ($docente) {
          if ($docente->foto != null || $docente->foto != '') {
            $foto = '<img src="/images/docentes/' . $docente->foto . '" alt="" class="zoom" width="80" height="80">';
          } else {
            $foto = '<img src="/avatar/avatar.png" alt="" class="zoom" width="80" height="80">';
          }
          return $foto;
        })
        ->addColumn('nombre', function ($docente) {
          $nombre = $docente->personas->nom_persona;
          return $nombre;
        })
        ->addColumn('correo', function ($docente) {
          $correo = $docente->personas->email_persona;
          return $correo;
        })
        ->addColumn('telefono', function ($docente) {
          $telefono = $docente->personas->tel_persona;
          return $telefono;
        })
        ->addColumn('tipos', function ($docente) {
          $tipo = $docente->tipos->tipo;
          return $tipo;
        })
        ->rawColumns(['accion', 'fotoD', 'nombre', 'correo', 'telefono', 'tipos'])
        ->make(true);
    }
    $tipoDocs = TipoDoc::all();
    $tipos = Tipo::all();
    $becas = Beca::all();
    $sexos = Sexo::all();
    $sangres = TipoSangre::all();
    $nacimientos = Municipio::all();
    $barrios = Barrio::all();
    $estadosCivil = EstadoCivil::all();
    $instituciones = Institucion::all();
    $niveles = Nivel_Formacion::all();
    return view('pages/docentes/ListaDocentes', compact('tipoDocs', 'tipos', 'becas', 'sexos', 'estadosCivil', 'sangres', 'nacimientos', 'barrios', 'niveles', 'instituciones'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'tipo_doc' => 'required',
      'documento' => 'required|max:15',
      'nombre' => "required|unique:persona,ced_persona,$request->documento,ced_persona|max:100",
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
      'profesion' => 'required',
      'nivel' => 'required',
      'instituciones' => 'required',
      'area_conocimiento' => 'required'
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $extension = $file->getClientOriginalExtension();
        $filename = $request->documento . '.' . $extension;
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
      $persona->barrio = $request->barrio;
      $persona->save();

      $estudiante = new Docente();
      $estudiante->ced_persona = $request->documento;
      $estudiante->descripcion = $request->descripcion;
      $estudiante->cvlac = $request->cvlac;
      $estudiante->tipo = $request->tipo;
      $estudiante->save();

      $cont = count($request->profesion);
      for ($i = 0; $i < $cont; $i++) {
        if ($request->profesion[$i] != NULL) {
          $estudio = new Estudio();
          $estudio->nom_estudio = $request->profesion[$i];
          $estudio->nivel_estudio = $request->nivel[$i];
          $estudio->save();
          $estudios = Estudio::get()->last();
          $est_estudio = new DocenteEstudio();
          $est_estudio->docente = $request->documento;
          $est_estudio->estudio = $estudios->id_estudio;
          $est_estudio->institucion = $request->instituciones[$i];
          $est_estudio->save();
        }
      }

      $cont = count($request->area_conocimiento);
      for ($i = 0; $i < $cont; $i++) {
        if ($request->area_conocimiento[$i] != NULL) {
          $estudio = new AreaConocimiento();
          $estudio->nom_area_con = $request->area_conocimiento[$i];
          $estudio->save();
          $estudios = AreaConocimiento::get()->last();
          $est_estudio = new DocenteAreaConocimiento();
          $est_estudio->docente = $request->documento;
          $est_estudio->area_con = $estudios->id_area;
          $est_estudio->save();
        }
      }
      return 0;
    }
  }

  public function edit($id)
  {
    $estudiante = Docente::findOrFail($id);
    $estudiante->personas;
    $estudiante->personas->barrios;
    $estudiante->personas->municipios;
    // $profesiones = EstudianteEstudio::where('estudiante', $id)->get();
    $profesiones = DocenteEstudio::select('id_institucion', 'nom_institucion', 'id_estudio', 'nom_estudio', 'id_nivel', 'desc_nivel')
      ->join('institucion', 'id_institucion', 'like', 'institucion')
      ->join('estudio', 'id_estudio', 'like', 'estudio')
      ->join('nivel', 'nivel_estudio', 'like', 'id_nivel')
      ->where('docente', $id)->get();

    $areas = DocenteAreaConocimiento::select('docente', 'area_con', 'nom_area_con')
      ->join('area_conocimiento', 'area_con', 'like', 'id_area')
      ->where('docente', $id)->get();
    return response()->json(['docente' => $estudiante, 'profesiones' => $profesiones, 'areas' => $areas]);
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
      'profesion' => 'required',
      'nivel' => 'required',
      'instituciones' => 'required',
    ]);
    if ($validator->fails()) {
      return ($validator->errors());
    } else {
      $persona = Persona::findOrFail($id);

      if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $extension = $file->getClientOriginalExtension();
        $filename = date('YmdHis') . '.' . $extension;
        $file->move('images/docentes', $filename);
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
      $persona->barrio = $request->barrio;
      $persona->save();

      $estudiante = Docente::findOrFail($id);
      $estudiante->ced_persona = $request->documento;
      $estudiante->descripcion = $request->descripcion;
      $estudiante->cvlac = $request->cvlac;
      $estudiante->tipo = $request->tipo;
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

            $est_estudio = new DocenteEstudio();
            $est_estudio->docente = $request->documento;
            $est_estudio->estudio = $estudios->id_estudio;
            $est_estudio->institucion = $request->instituciones[$i];
            $est_estudio->save();
          } else {
            $estudio->nom_estudio = $request->profesionact[$i];
            $estudio->nivel_estudio = $request->nivel[$i];
            $estudio->save();
          }
        }
      }
      $cont = count($request->area_conocimiento);

      for ($i = 0; $i < $cont; $i++) {
        if ($request->area_conocimiento[$i] != NULL) {
          $estudio = AreaConocimiento::where('id_area', $request->area_conocimientoact[$i])->first();
          if ($estudio == null) {
            $estudio = new AreaConocimiento();
            $estudio->nom_area_con = $request->area_conocimiento[$i];
            $estudio->save();
            $estudios = AreaConocimiento::get()->last();
            $est_estudio = new DocenteAreaConocimiento();
            $est_estudio->docente = $request->documento;
            $est_estudio->area_con = $estudios->id_area;
            $est_estudio->save();
          } else {
            $estudio->nom_area_con = $request->area_conocimiento[$i];
            $estudio->save();
          }
        }
      }
      return 0;
    }
  }

  public function delete($id)
  {
    $destudio = DocenteEstudio::where('estudio', 'like', $id);
    $destudio->delete();

    $estudio = Estudio::findOrFail($id);
    $estudio->delete();

    return 0;
  }

  public function destroy($id)
  {
    $estudiosEst = DocenteEstudio::where('docente', $id)->get();

    foreach ($estudiosEst as $estudioEst) {
      $estudio = Estudio::findOrFail($estudioEst->estudio);
      $estudioEst->delete();
      $estudio->delete();
    }

    $areaCono = DocenteAreaConocimiento::where('docente', $id)->get();
    foreach ($areaCono as $area) {
      $estudio = AreaConocimiento::findOrFail($area->area_con);
      $estudio->delete();
      $area->delete();
    }

    $asignaciones = Asignacion::where('docente', $id)->get();
    foreach ($asignaciones as $asignacion) {
      $asignacion->delete();
    }

    $estudiante = Docente::findOrFail($id);
    $estudiante->delete();

    $persona = Persona::findOrFail($id);
    $persona->delete();
    return 0;
  }

}
