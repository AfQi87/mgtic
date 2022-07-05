<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaAsistente extends Model
{
    use HasFactory;
    protected $table = 'acta_mgtic_has_participante';
    protected $primaryKey = 'participante';

    public function participantes(){
        return $this->belongsTo(Asistente::class,'participante','persona');
    }
}
