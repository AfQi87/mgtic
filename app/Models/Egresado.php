<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egresado extends Model
{
    use HasFactory;
    protected $table = 'egresado';
    protected $primaryKey = 'ced_persona';

    public function programas()
    {
        return $this->belongsTo(Programa::class, 'programa', 'id_programa');
    }

    public function personas()
    {
        return $this->belongsTo(Persona::class, 'ced_persona', 'ced_persona');
    }
}
