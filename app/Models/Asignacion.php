<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    use HasFactory;
    protected $table = 'docente_imparte_materia';
    protected $primaryKey = 'docente';

    public function docentes()
    {
        return $this->belongsTo(Docente::class, 'docente', 'ced_persona');
    }

    public function materias()
    {
        return $this->belongsTo(Materia::class, 'materia', 'id_materia');
    }

    public function cortes()
    {
        return $this->belongsTo(Corte::class, 'cohorte', 'id_cohorte');
    }
}
