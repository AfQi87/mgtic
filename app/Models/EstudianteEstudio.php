<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudianteEstudio extends Model
{
	use HasFactory;
	protected $table = 'estudiante_has_estudio';

  protected $primaryKey = 'estudiante';
	// $table->primary(['estudiante', 'estudio']);

	public function insituciones()
	{
		return $this->belongsTo(Persona::class, 'institucion', 'id_institucion');
	}
}
