<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocenteEstudio extends Model
{
    use HasFactory;
    protected $table = 'docente_has_estudio';

    protected $primaryKey = 'docente';
    // $table->primary(['estudiante', 'estudio']);

    public function insituciones()
    {
        return $this->belongsTo(Institucion::class, 'institucion', 'id_institucion');
    }
}
