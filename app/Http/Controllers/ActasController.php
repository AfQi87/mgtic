<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistente;
use App\Models\Acta;
use App\Models\Conclusion;
use App\Models\ListaAsistente;
use App\Models\Programacion;
use Illuminate\Support\Facades\Validator;

class ActasController extends Controller
{
	//
	public function index()
	{
		$actas = Acta::all();
		return view('pages/lista_actas', compact('actas'));
	}

	public function pdf()
	{
		$actas = Acta::all();
		$listaAsistentes = ListaAsistente::all();
		$programacion = Programacion::all();
		$conclusiones = conclusion::all();
		return view('pages/actas', compact('acta', 'asistentes', 'programacion', 'conclusiones'));
	}

	public function formActa()
	{
		$asistentes = Asistente::all();
		$acta = Acta::latest()->first();
		return view('pages/actas', compact('asistentes', 'acta'));
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
		return redirect('table-list');
	}

	public function responsables()
	{
		$responsables = Asistente::all();
		return response()->json(['responsables' => $responsables]);
	}

	public function eliminar($id)
	{
		$acta = Acta::findOrFail($id);
		
		$acta->delete();
		return back()->withStatus(__('Acta eliminada correctamente'));
	}
}
