<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class HomeVacantes extends Component
{
    // Variables que vienen del componente FiltrarVacantes
    public $termino;
    public $categoria;
    public $salario;

    /**Generamos listeners para que este componente padre, escuche
     * los eventos que se generan en FiltrarVacante (terminosBusqueda), 
     * que busque la función buscar
     */
    protected $listeners = ['terminosBusqueda' => 'buscar'];

    /**Me permite obtener los términos de búsqueda desde el componente
     * FiltrarVacantes
     */
    public function buscar($termino, $categoria, $salario)
    {
        // dd('Desde componente padre..');
        $this->termino = $termino;
        $this->categoria = $categoria;
        $this->salario = $salario;
        // dd($this->termino);
    }

    public function render()
    {
        // Hago consultas a la bd
        // Me traigo todas las vacantes
        // $vacantes = Vacante::all();

        /**Hago búsqueda cuando exista algo en la variable y se
         * hace un callback
         */
        $vacantes = Vacante::when($this->termino, function($query){
            $query->where('titulo', 'LIKE', "%" . $this->termino . "%");
        })
        ->when($this->termino, function($query){
            $query->orWhere('empresa', 'LIKE', "%" . $this->termino . "%");
        })
        ->when($this->categoria, function($query){
            $query->where('categoria_id', $this->categoria);
        })
        ->when($this->salario, function($query){
            $query->where('salario_id', $this->salario);
        })
        ->paginate(10);

        return view('livewire.home-vacantes', [
            'vacantes' => $vacantes,
        ]);
    }
}
