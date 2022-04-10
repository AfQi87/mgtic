<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $table = 'docente';

    public function estados(){
        return $this->belongsTo(Estado::class,'estado_id','id');
    }
    public function profesiones(){
        return $this->belongsTo(Profesion::class,'profesion_id','id');
    }
    public function campos(){
        return $this->belongsTo(Campo::class,'campo_id','id');
    }
}
