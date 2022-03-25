<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acta extends Model
{
    use HasFactory;
    protected $table = 'acta';
    public function reuniones(){
        return $this->belongsTo(Reunion::class,'reunion_id','id');
    }
}
