<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
  use HasFactory;
  protected $table = 'estudiante';
  protected $primaryKey = 'ced_persona';


  public function estados()
  {
    return $this->belongsTo(Estado::class, 'estado_id', 'id');
  }
  public function cortes()
  {
    return $this->belongsTo(Corte::class, 'cohorte', 'id_cohorte');
  }
  public function becas()
  {
    return $this->belongsTo(Beca::class, 'beca', 'id_beca');
  }
  public function personas()
  {
    return $this->belongsTo(Persona::class, 'ced_persona', 'ced_persona');
  }
}
