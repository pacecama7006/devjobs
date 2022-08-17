<?php

namespace App\Models;

use App\Models\Vacante;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidato extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vacante_id',
        'cv',
    ];

    // Relaciones
    // Relación con vacantes
    // Un candidato tiene o pertenece a una vacante. Una vacante tiene a muchos
    // candidatos
    public function vacante ()
    {
        return $this->belongsTo(Vacante::class);
    }
}
