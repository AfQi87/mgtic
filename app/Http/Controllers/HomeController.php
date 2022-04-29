<?php

namespace App\Http\Controllers;

use App\Mail\ContactenosMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
  public function inicio()
  {
    return view('inicio.index');
  }

  public function enviar(Request $request)
  {
    $correo = new ContactenosMailable($request->all());
    Mail::to('mtic@udenar.edu.co')->send($correo);
    return 0;
  }
}
