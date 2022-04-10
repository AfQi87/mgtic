<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistente;
use App\Models\Acta;
use App\Models\Conclusion;
use App\Models\ListaAsistente;
use App\Models\Programacion;
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
		$listaAsistentes = ListaAsistente::where('acta_id', $id)->get();
		$programaciones = Programacion::where('acta_id', $id)->get();
		$conclusiones = conclusion::where('acta_id', $id)->get();
		$fecha = Carbon::create($acta->fecha);
		$horaIni = Carbon::create($acta->hora_inicio);
		$horaFin = Carbon::create($acta->hora_fin);
		$horaIni = $horaIni->format('h:i A');
		$horaFin = $horaFin->format('h:i A');
		$pdf = PDF::loadView('pages/actas/pdfActas', compact('cont', 'acta', 'listaAsistentes', 'programaciones', 'conclusiones', 'fecha', 'horaIni', 'horaFin'));
		return $pdf->download('Acta.pdf');
		// return view('pages/pdfActas', compact('cont', 'acta', 'listaAsistentes', 'programaciones', 'conclusiones', 'fecha', 'horaIni', 'horaFin'));
	}

	public function formActa()
	{
		$asistentes = Asistente::all();
		$acta = Acta::latest()->first();
		return view('pages/actas/actas', compact('asistentes', 'acta'));
	}

	public function guardarActa(Request $request)
	{
		$acta = new Acta();
		$acta->reunion_id  = $request->input('reunion');
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
				$lit_asis = new ListaAsistente();
				$lit_asis->acta_id = $acta->id;
				$lit_asis->asistente_id = $request->asistente[$i];
				$lit_asis->save();
			}
		}

		$cont = count($request->tematica);
		for ($i = 0; $i < $cont; $i++) {
			if ($request->tematica[$i] == NULL) {
			} else {
				$conclusion = new Programacion();
				$conclusion->tematica = $request->tematica[$i];
				$conclusion->asistente_id = $request->responsable[$i];
				$conclusion->acta_id = $acta->id;
				$conclusion->save();
			}
		}

		$cont = count($request->conclusion);
		for ($i = 0; $i < $cont; $i++) {
			if ($request->conclusion[$i] == NULL) {
			} else {
				$conclusion = new Conclusion();
				$conclusion->conclusion = $request->conclusion[$i];
				$conclusion->acta_id = $acta->id;
				$conclusion->save();
			}
		}
		return redirect('acta');
	}

	public function responsables()
	{
		$responsables = Asistente::all();
		return response()->json(['responsables' => $responsables]);
	}

	public function eliminar($id)
	{
		$acta = Acta::findOrFail($id);
		$listaAsistentes = ListaAsistente::where('acta_id', $id)->get();
		$programaciones = Programacion::where('acta_id', $id)->get();
		$conclusiones = conclusion::where('acta_id', $id)->get();
		foreach($listaAsistentes as $asistente){
			$asistente->delete();
		}
		foreach($programaciones as $programacion){
			$programacion->delete();
		}
		foreach($conclusiones as $conclusion){
			$conclusion->delete();
		}
		$acta->delete();
		return back()->withStatus(__('Acta eliminada correctamente'));
	}
}
