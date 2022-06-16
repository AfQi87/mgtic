<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistente extends Model
{
    use HasFactory;
    protected $table = 'participante_mgtic';
    public function ListaAsistentes()
    {
        return $this->hasMany(ListaAsistente::class, 'id');
    }
    public function Programaciones()
    {
        return $this->hasMany(Programacion::class, 'id');
    }

    public function Tareas()
    {
        return $this->hasMany(Tarea::class, 'id');
    }

    public function personas()
    {
        return $this->belongsTo(Persona::class, 'persona', 'ced_persona');
    }

    public function cargos()
    {
        return $this->belongsTo(CargoMGTIC::class, 'cargo', 'id_cargo');
    }
}
