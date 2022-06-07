<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    use HasFactory;
    protected $table = 'institucion';

    protected $primaryKey = 'id_institucion';

    public function programas()
    {
        return $this->hasMany(Programa::class, 'id_institucion');
    }

    public function Estudiantes()
    {
        return $this->hasMany(EstudianteEstudio::class, 'id_institucion');
    }
}
