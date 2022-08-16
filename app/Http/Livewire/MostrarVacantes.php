<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class MostrarVacantes extends Component
{
    /*Si tengo funciones en las vistas de livewire que se produzcan por un
    evento, tengo que notificar al componente que esté pendiente de dichos
    eventos, por lo que creo un arreglo llamado listeners */
    protected $listeners = ['eliminarVacante'];

    /*Está función viene de la página mostrar-vacantes.blade.php, en 
    el botón que me permite eliminar una vacante wire:click="$emit('prueba')" */
    // public function prueba($vacante_id)
    // {
    //     
    // }

    public function eliminarVacante(Vacante $vacante)
    {
        // dd('Eliminando....');
        // dd($vacante->titulo);

        // Elimino la vacante
        $vacante->delete();
    }

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
