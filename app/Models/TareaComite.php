<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TareaComite extends Model
{
    use HasFactory;
    protected $table = 'tarea_comite';
    protected $primaryKey = 'id_tarea';

    public function Asistentes(){
        return $this->belongsTo(AsistenteComite::class,'responsable','persona');
    }
    public $timestamps = false;
}
