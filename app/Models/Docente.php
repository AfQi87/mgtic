<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
  use HasFactory;

  protected $table = 'docente';

  protected $primaryKey = 'ced_persona';
  public function personas()
  {
    return $this->belongsTo(Persona::class, 'ced_persona', 'ced_persona');
  }
  public function tipos()
  {
    return $this->belongsTo(Tipo::class, 'tipo', 'id_tipo');
  }

  public function Areas()
    {
        return $this->hasMany(DocenteAreaConocimiento::class, 'docente');
    }
}
