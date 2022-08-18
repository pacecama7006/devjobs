<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use Livewire\Component;

class FiltrarVacantes extends Component
{
    // Variables que vienen de la vista filtrar-vacantes.blade
    public $termino;
    public $categoria;
    public $salario;

    /**Función que me permite leer los datos del formulario de búsqueda
     * que se encuentra en el wire:submit.prevent que está en el form
     */
    public function leerDatosFormulario()
    {
        // dd('Buscando..');
        // Emitimos un evento y le paso parámetros
        $this->emit('terminosBusqueda', $this->termino, $this->categoria, $this->salario);
    }


    public function render()
    {
        // Consultas a la bd
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.filtrar-vacantes', [
            'salarios' => $salarios,
            'categorias' => $categorias,
        ]);
    }
}
