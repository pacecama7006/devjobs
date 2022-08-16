<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MostrarVacante extends Component
{
    // Variable que viene de la vista show.blade
    public $vacante;
    
    public function render()
    {
        return view('livewire.mostrar-vacante');
    }
}
