<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class MostrarVacantes extends Component
{
    public function render()
    {   
        // Busco en la bd las vacantes creadas por el usuario autenticado
        $vacantes = Vacante::where('user_id', auth()->user()->id)->paginate(10);
        
        // Paso a la vista la variable vacantes
        return view('livewire.mostrar-vacantes', [
            'vacantes' => $vacantes,
        ]);
    }
}
