<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActaComite extends Model
{
    use HasFactory;
    protected $table = 'acta_comite';
    public function reuniones(){
        return $this->belongsTo(Reunion::class,'tipo','id_tipo');
    }
}
