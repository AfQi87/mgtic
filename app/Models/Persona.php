<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = 'persona';
    protected $primaryKey = 'ced_persona';

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'ced_persona');
    }

    public function egresados()
    {
        return $this->hasMany(Egresado::class, 'ced_persona');
    }
    public function docentes()
    {
        return $this->hasMany(Docente::class, 'ced_persona');
    }

    public function municipios()
    {
        return $this->belongsTo(Municipio::class, 'lugar_nac', 'id_municipio');
    }

    public function barrios()
    {
        return $this->belongsTo(Barrio::class, 'barrio', 'id_barrio');
    }

    
}
