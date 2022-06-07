<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudio extends Model
{
    use HasFactory;
    protected $table = 'estudio';

    protected $primaryKey = 'id_estudio';


    public function Estudiantes()
    {
        return $this->hasMany(EstudianteEstudio::class, 'id_estudio');
    }
}
