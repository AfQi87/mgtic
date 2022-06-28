<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = 'persona';
    protected $primaryKey = 'ced_persona';

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'ced_persona');
    }

    public function egresados()
    {
        return $this->hasMany(Egresado::class, 'ced_persona');
    }
    public function docentes()
    {
        return $this->hasMany(Docente::class, 'ced_persona');
    }

    public function municipios()
    {
        return $this->belongsTo(Municipio::class, 'lugar_nac', 'id_municipio');
    }

    public function tipodocs()
    {
        return $this->belongsTo(TipoDoc::class, 'tipo_doc', 'id_tipo');
    }
    public function sexos()
    {
        return $this->belongsTo(Sexo::class, 'sexo', 'id_sexo');
    }
    public function tiposangre()
    {
        return $this->belongsTo(TipoSangre::class, 'tipo_sangre', 'id_tipo');
    }
    public function estadocivil()
    {
        return $this->belongsTo(EstadoCivil::class, 'estado_civil', 'id_estado');
    }
    public function estados(){
        return $this->belongsTo(Estado::class,'estado_id','id');
    }
}
