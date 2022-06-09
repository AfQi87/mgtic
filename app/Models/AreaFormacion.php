<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaFormacion extends Model
{
    use HasFactory;
    protected $table = 'area_formacion';
    protected $primaryKey = 'id_area';

    public function materias(){
        return $this->hasMany(Materia::class,'id_area');
    }
}
