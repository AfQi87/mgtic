<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrabajoGrado extends Model
{
  use HasFactory;
  protected $table = "trabajo_grado";
  protected $primaryKey = 'id_tg';

  public function estudiantes()
  {
    return $this->belongsTo(Estudiante::class, 'estudiante', 'ced_persona');
  }

  public function asesores()
  {
    return $this->belongsTo(Docente::class, 'asesor', 'ced_persona');
  }

  public function jurados1()
  {
    return $this->belongsTo(Docente::class, 'jurado1', 'ced_persona');
  }

  public function jurados2()
  {
    return $this->belongsTo(Docente::class, 'jurado2', 'ced_persona');
  }

  public function jurados3()
  {
    return $this->belongsTo(Docente::class, 'jurado3', 'ced_persona');
  }
}
