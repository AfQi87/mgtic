<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = 'Persona';
    protected $primaryKey = 'ced_persona';

    public function programas()
    {
        return $this->belongsTo(Programa::class, 'programa', 'id_programa');
    }

    public function estados()
    {
        return $this->belongsTo(Estado::class, 'estado_id', 'id');
    }
}
