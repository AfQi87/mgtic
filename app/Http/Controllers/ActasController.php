<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistente;
use App\Models\Acta;
use App\Models\ActaComite;
use App\Models\AsistenteComite;
use App\Models\Conclusion;
use App\Models\ConclusionComite;
use App\Models\ListaAsistente;
use App\Models\ListaAsistenteComite;
use App\Models\Programacion;
use App\Models\ProgramacionComite;
use App\Models\Tarea;
use App\Models\TareaComite;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Carbon;

class ActasController extends Controller
{
	//
	public function index()
	{
		$actas = Acta::all();
		return view('pages/actas/lista_actas', compact('actas'));
	}

	public function descargarPDF($id)
	{
		$cont = 0;
		$acta = Acta::findOrFail($id);
		$listaAsistentes = ListaAsistente::where('acta_mgtic', $id)->get();
		$asistentes = $listaAsistentes->count();
		if ($asistentes == 0) {
			$listaAsistentes = ListaAsistenteComite::where('acta_comite', $id)->get();
		}
		$programaciones = Programacion::where('acta', $id)->get();
		$conclusiones = conclusion::where('acta', $id)->get();
		$tareas = Tarea::where('acta', $id)->get();
		$cTarea = $tareas->count();
		if ($cTarea == 0) {
			$tareas = TareaComite::where('acta', $id)->get();
		}
		$fecha = Carbon::create($acta->fecha);
		$horaIni = Carbon::create($acta->hora_inicio);
		$horaFin = Carbon::create($acta->hora_fin);
		$horaIni = $horaIni->format('h:i A');
		$horaFin = $horaFin->format('h:i A');
		$pdf = PDF::loadView('pages/actas/pdfActas', compact('cont', 'acta', 'listaAsistentes', 'asistentes', 'programaciones', 'conclusiones', 'tareas', 'fecha', 'horaIni', 'horaFin'));
		return $pdf->download('Acta' . $acta->id . '.pdf');
		// return view('pages/actas/pdfActas', compact('cont', 'acta', 'listaAsistentes', 'asistentes', 'programaciones', 'conclusiones', 'tareas', 'fecha', 'horaIni', 'horaFin'));
	}

	public function formActa()
	{
		$asistentes = Asistente::all();
		$acta = Acta::latest()->first();
		return view('pages/actas/actas', compact('asistentes', 'acta'));
	}

	public function formActaComite()
	{
		$asistentes = AsistenteComite::all();
		$acta = Acta::latest()->first();
		return view('pages/actas/actas_comite', compact('asistentes', 'acta'));
	}

	public function guardarActa(Request $request)
	{
		$acta = new Acta();
		$acta->tipo  = $request->input('reunion');
		$acta->proceso = $request->input('proceso');
		$acta->lugar = $request->input('lugar');
		$acta->hora_inicio = $request->input('hora_ini');
		$acta->fecha = $request->input('fecha');
		$acta->hora_fin = $request->input('hora_fin');
		$acta->save();

		$cont = count($request->asistente);
		$acta = Acta::latest()->first();
		for ($i = 0; $i < $cont; $i++) {
			if ($request->asistente[$i] == NULL) {
			} else {
				$lit_asis = new ListaAsistente();
				$lit_asis->acta_mgtic = $acta->id_acta;
				$lit_asis->participante = $request->asistente[$i];
				$lit_asis->save();
			}
		}

		$cont = count($request->tematica);
		for ($i = 0; $i < $cont; $i++) {
			if ($request->tematica[$i] == NULL) {
			} else {
				$tematica = new Programacion();
				$tematica->tematica = $request->tematica[$i];
				$tematica->acta = $acta->id_acta;
				$tematica->save();
			}
		}

		$cont = count($request->conclusion);
		for ($i = 0; $i < $cont; $i++) {
			if ($request->conclusion[$i] == NULL) {
			} else {
				$conclusion = new Conclusion();
				$conclusion->conclusion = $request->conclusion[$i];
				$conclusion->acta = $acta->id_acta;
				$conclusion->save();
			}
		}

		$cont = count($request->tarea);
		for ($i = 0; $i < $cont; $i++) {
			if ($request->tarea[$i] == NULL) {
			} else {
				$tarea = new Tarea();
				$tarea->tarea = $request->tarea[$i];
				$tarea->participante = $request->responsable[$i];
				$tarea->acta = $acta->id_acta;
				$tarea->save();
			}
		}
		return redirect('acta');
	}

	public function guardarActaComite(Request $request)
	{
		$acta = new Acta();
		$acta->tipo  = $request->input('reunion');
		$acta->proceso = $request->input('proceso');
		$acta->lugar = $request->input('lugar');
		$acta->hora_inicio = $request->input('hora_ini');
		$acta->fecha = $request->input('fecha');
		$acta->hora_fin = $request->input('hora_fin');
		$acta->save();

		$total = 0;
		$cont = count($request->asistente);
		$acta = Acta::latest()->first();
		for ($i = 0; $i < $cont; $i++) {
			if ($request->asistente[$i] == NULL) {
			} else {
				$lit_asis = new ListaAsistenteComite();
				$lit_asis->acta_comite = $acta->id_acta;
				$lit_asis->participante = $request->asistente[$i];
				$lit_asis->save();
			}
		}

		$cont = count($request->tematica);
		for ($i = 0; $i < $cont; $i++) {
			if ($request->tematica[$i] == NULL) {
			} else {
				$tematica = new Programacion();
				$tematica->tematica = $request->tematica[$i];
				$tematica->acta = $acta->id_acta;
				$tematica->save();
			}
		}

		$cont = count($request->conclusion);
		for ($i = 0; $i < $cont; $i++) {
			if ($request->conclusion[$i] == NULL) {
			} else {
				$conclusion = new Conclusion();
				$conclusion->conclusion = $request->conclusion[$i];
				$conclusion->acta = $acta->id_acta;
				$conclusion->save();
			}
		}

		$cont = count($request->tarea);
		for ($i = 0; $i < $cont; $i++) {
			if ($request->tarea[$i] == NULL) {
			} else {
				$tarea = new TareaComite();
				$tarea->tarea = $request->tarea[$i];
				$tarea->responsable = $request->responsable[$i];
				$tarea->acta = $acta->id_acta;
				$tarea->save();
			}
		}
		return redirect('acta');
	}

	public function responsables()
	{
		// $responsables = Asistente::all();
		// $responsables->cargos;

		$responsables = Asistente::select('persona', 'nom_persona', 'cargo', 'desc_cargo')
			->join('cargo', 'cargo', '=', 'id_cargo')
			->join('persona', 'persona', '=', 'ced_persona')
			->get();

		return response()->json(['responsables' => $responsables]);
	}

	public function responsablesComite()
	{
		// $responsables = AsistenteComite::all();
		$responsables = AsistenteComite::select('persona', 'nom_persona', 'cargo', 'desc_cargo')
			->join('cargo', 'cargo', '=', 'id_cargo')
			->join('persona', 'persona', '=', 'ced_persona')
			->get();
		return response()->json(['responsables' => $responsables]);
	}

	public function eliminar($id)
	{
		$acta = Acta::findOrFail($id);
		$listaAsistentes = ListaAsistente::where('acta_mgtic', $id)->get();
		$listaAsistentesC = ListaAsistenteComite::where('acta_comite', $id)->get();
		$programaciones = Programacion::where('acta', $id)->get();
		$conclusiones = Conclusion::where('acta', $id)->get();
		$tareas = Tarea::where('acta', $id)->get();
		$tareasComite = TareaComite::where('acta', $id)->get();
		foreach ($tareas as $tarea) {
			$tarea->delete();
		}
		foreach ($tareasComite as $tarea) {
			$tarea->delete();
		}
		foreach ($listaAsistentes as $asistente) {
			$asistente->delete();
		}
		foreach ($listaAsistentesC as $asistente) {
			$asistente->delete();
		}
		foreach ($programaciones as $programacion) {
			$programacion->delete();
		}
		foreach ($conclusiones as $conclusion) {
			$conclusion->delete();
		}


		$acta->delete();
		return back()->withStatus(__('Acta eliminada correctamente'));
	}
}
