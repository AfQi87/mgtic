<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistente extends Model
{
    use HasFactory;
    protected $table = 'asistente';
    public function ListaAsistentes(){
        return $this->hasMany(ListaAsistente::class,'id');
    }
    public function Programaciones(){
        return $this->hasMany(Programacion::class,'id');
    }
}
