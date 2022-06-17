<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;
    protected $table = 'tarea_mgtic';
    protected $primaryKey = 'id_tarea';

    public function Asistentes(){
        return $this->belongsTo(Asistente::class,'participante','persona');
    }
}
