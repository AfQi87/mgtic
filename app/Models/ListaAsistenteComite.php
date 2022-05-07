<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaAsistenteComite extends Model
{
    use HasFactory;
    protected $table = 'lista_asistente_comite';
    public function Asistentes(){
        return $this->belongsTo(AsistenteComite::class,'asistente_id','id');
    }
}
