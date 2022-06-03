<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corte extends Model
{
    use HasFactory;
    protected $table = 'cohorte';

    
    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'id_cohorte');
    }
}
