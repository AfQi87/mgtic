<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programacion extends Model
{
    use HasFactory;
    protected $table = 'tematica_mgtic';
    protected $primaryKey = 'id_tematica';

    public function Asistentes(){
        return $this->belongsTo(Asistente::class,'asistente_id','id');
    }
}
