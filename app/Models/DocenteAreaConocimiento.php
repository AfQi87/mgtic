<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocenteAreaConocimiento extends Model
{
    use HasFactory;
    protected $table = 'docente_has_area_conocimiento';

    protected $primaryKey = 'docente';
    public function areasC()
    {
        return $this->belongsTo(AreaConocimiento::class, 'area_con', 'id_area');
    }
}
