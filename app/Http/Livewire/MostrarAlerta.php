<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MostrarAlerta extends Component
{
    //Variable que recibirá el componente mostrar-alerta
    public $message;
    
    public function render()
    {
        return view('livewire.mostrar-alerta');
    }
}
