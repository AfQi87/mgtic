<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
  use HasFactory;
  protected $table = 'estudiante';

  public function estados()
  {
    return $this->belongsTo(Estado::class, 'estado_id', 'id');
  }
  public function cortes()
  {
    return $this->belongsTo(Corte::class, 'corte_id', 'id');
  }
}
