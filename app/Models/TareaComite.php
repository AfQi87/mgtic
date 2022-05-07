<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TareaComite extends Model
{
    use HasFactory;
    protected $table = 'tarea_comite';
    public function Asistentes(){
        return $this->belongsTo(AsistenteComite::class,'asistente_id','id');
    }
    public $timestamps = false;
}
