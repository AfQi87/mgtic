<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaAsistente extends Model
{
    use HasFactory;
    protected $table = 'lista_asistente';
    public function Asistentes(){
        return $this->belongsTo(Asistente::class,'asistente_id','id');
    }
}
