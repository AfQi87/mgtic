<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $table = 'materia';
    protected $primaryKey = 'id_materia';

    public function areas()
    {
        return $this->belongsTo(AreaFormacion::class, 'area_form', 'id_area');
    }
}
