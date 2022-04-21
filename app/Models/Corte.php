<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corte extends Model
{
    use HasFactory;
    protected $table = 'Corte';

    public function estados()
    {
        return $this->belongsTo(Estado::class, 'estado_id', 'id');
    }
}
