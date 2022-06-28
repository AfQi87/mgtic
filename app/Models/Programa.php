<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;
    protected $table = 'programa';
    // protected $primaryKey = 'id_programa';
    public function Personas(){
        return $this->hasMany(Personas::class,'id_programa');
    }
    public function instituciones(){
        return $this->belongsTo(Institucion::class,'institucion','id_institucion');
    }
}
