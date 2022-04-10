<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campo extends Model
{
    use HasFactory;
    protected $table = 'campo';

    public function docentes(){
        return $this->hasMany(Docente::class,'id');
    }
}
