<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Vacante;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;

class EditarVacante extends Component
{
    // Atributo que se obtiene del VacanteController en su método edit
    /**Importante si pongo $id no funciona porque está reservado para
     * livewire, entonces le llamamos vacante_id
     */
    public $vacante_id;
    // Variables que hago en base a los wire-model que (son como los name),
    // que vienen de editar-vacante.blade
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    // Atributo por si el usuario cambia de imagen
    public $imagen_nueva;

    // Si manejo archivos tengo que poner esto que es de livewire
    use WithFileUploads;

    /**Reglas de validación. Forzosamente la variable tiene que llamarse
     * rules en livewire
     */
    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen_nueva' => 'nullable|image|max:1024',
    ];


    /**Hook o método de livewire que se corre en el momento en que
     * el componente es instanciado. Se ejecuta una vez
     * Recibe la variable que está mandando la vista edit.blade
     * por lo que debo importar el modelo
     */
    public function mount(Vacante $vacante)
    {
        // Asigno variables a como vienen las variables de la bd
        $this->vacante_id = $vacante->id;
        $this->titulo = $vacante->titulo;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        $this->empresa = $vacante->empresa;
        // Modifico con carbon el formato de la fecha, tal como está en la bd
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d');
        $this->descripcion = $vacante->descripcion;
        $this->imagen = $vacante->imagen;

    }

    /* Función que me permite editar una vacante*/
    public function editarVacante()
    {
        // hago la validación y lo guardo en una variable que llamo datos
        $datos = $this->validate();
        // dd($datos);
        // Se revisa si hay una nueva imagen
        if ($this->imagen_nueva) {
            # Almaceno la imagen en vacantes
            $imagen = $this->imagen_nueva->store('public/vacantes');
            // Creo un campo en el array datos para reescribir la imagen
            $datos['imagen'] = str_replace('public/vacantes/', '', $imagen);

        } 

        // Encontramos la vacante a editar
        $vacante = Vacante::find($this->vacante_id);
        // Asignamos los valores que vienen del array $datos
        $vacante->titulo = $datos['titulo'];
        $vacante->salario_id = $datos['salario'];
        $vacante->categoria_id = $datos['categoria'];
        $vacante->empresa = $datos['empresa'];
        $vacante->ultimo_dia = $datos['ultimo_dia'];
        $vacante->descripcion = $datos['descripcion'];
        $vacante->imagen = $datos['imagen'] ?? $vacante->imagen;

        // Guardamos información en la BD
        $vacante->save();

        // Redireccionamos al muro del creador de la vacante
        session()->flash('mensaje', 'La vacante se actualizó correctamente');
        return redirect()->route('vacantes.index');
    }
    
    public function render()
    {
        // Consultar la BD
        // Me traigo todos los registros
        $salarios = Salario::all();
        $categorias = Categoria::all();
        
        return view('livewire.editar-vacante', [
            'salarios' => $salarios,
            'categorias' => $categorias,
        ]);
    }
}
