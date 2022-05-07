<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsistenteComite extends Model
{
    use HasFactory;
    protected $table = 'asistente_comite';
    public function ListaAsistentes(){
        return $this->hasMany(ListaAsistente::class,'id');
    }
    public function Programaciones(){
        return $this->hasMany(Programacion::class,'id');
    }

    public function Tareas(){
        return $this->hasMany(TareaComite::class,'id');
    }
}
