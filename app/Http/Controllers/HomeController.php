<?php

namespace App\Http\Controllers;

use App\Mail\ContactenosMailable;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
  public function index()
  {
    return view('users.index');
  }

  public function inicio()
  {
    $docentes = Docente::all();
    $i = 0;
    return view('inicio.index', compact('docentes', 'i'));
  }

  public function enviar(Request $request)
  {
    $correo = new ContactenosMailable($request->all());
    Mail::to('mgtic@udenar.edu.co')->send($correo);
    return 0;
  }
}
