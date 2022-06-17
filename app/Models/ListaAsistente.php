<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaAsistente extends Model
{
    use HasFactory;
    protected $table = 'acta_mgtic_has_participante';

    public function participantes(){
        return $this->belongsTo(Asistente::class,'participante','persona');
    }
    public function AsistentesComite(){
        return $this->belongsTo(AsistenteComite::class,'asistente_id','id');
    }
    public function actas(){
        return $this->belongsTo(Acta::class,'acta_id','id');
    }
}
