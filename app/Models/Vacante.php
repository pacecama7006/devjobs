<?php

namespace App\Models;

use App\Models\Salario;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacante extends Model
{
    use HasFactory;

    // Variable que me va a permitir que ultimo_dia, sí sea considerada fecha
    // y no un string
    
    protected $dates = ['ultimo_dia'];
    protected $fillable = [
        'titulo',
        'salario_id',
        'categoria_id',
        'empresa',
        'ultimo_dia',
        'descripcion',
        'imagen',
        'publicado',
        'user_id',
    ];

    // Relaciones
    // Una vacante pertenece una categoria. Una categoria pertenece a una o muchas vacantes
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Una vacante pertenece un salario. Un salario pertenece a una o muchas vacantes
    public function salario()
    {
        return $this->belongsTo(Salario::class);
    }
}
