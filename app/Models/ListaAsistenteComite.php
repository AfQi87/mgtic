<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaAsistenteComite extends Model
{
    use HasFactory;
    protected $table = 'acta_comite_has_participante';
    protected $primaryKey = 'participante';

    public function participantes(){
        return $this->belongsTo(AsistenteComite::class,'participante','persona');
    }
}
