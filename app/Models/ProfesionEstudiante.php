<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfesionEstudiante extends Model
{
    use HasFactory;
    protected $table = 'profesion_estudiante';

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'id');
    }
}
