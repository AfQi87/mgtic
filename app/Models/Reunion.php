<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
    use HasFactory;
    protected $table = 'tipo_reunion';
    public function Actas(){
        return $this->hasMany(Acta::class,'id_tip');
    }
}
