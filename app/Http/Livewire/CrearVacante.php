<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Vacante;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{   
    // Propiedades del formulario
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:1024',

    ];

    // Línea necesaria para poder procesar imágenes con livewire
    use WithFileUploads;

    // Función que se comunica con el formulario que está en crear-vacante.blade
    public function crearVacante()
    {
        $datos = $this->validate();
        // dd($datos);

        // Almacenar la imagen en el método de livewire store. Obtengo la ubicación
        // De la imagen
        $imagen = $this->imagen->store('public/vacantes');
        // dd($imagen);

        // Obtengo el nombre de la imagen con la función de php str_replace
        // en el primer parámetro recibe que va a buscar, 2do con que lo
        // voy a reemplazar y 3ero de donde va a tomar la información
        $datos['imagen'] = str_replace('public/vacantes/', '', $imagen);
        // dd($nombre_imagen);

        //Crear la vacante. En livewire tenemos acceso a los modelos y a la bd
        Vacante::create([
            'titulo' => $datos['titulo'],
            'salario_id' => $datos['salario'],
            'categoria_id' => $datos['categoria'],
            'empresa' => $datos['empresa'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen' => $datos['imagen'],
            'user_id' => auth()->user()->id,
        ]);

        // Crear un mensaje con un mensaje de session
        session()->flash('mensaje', 'La vacante se publicó correctamente');

        //Redireccionar al usuario
        return redirect()->route('vacantes.index');
    }

    public function render()
    {
        // Consultar la BD
        // Me traigo todos los registros
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.crear-vacante', [
            'salarios' => $salarios,
            'categorias' => $categorias,
        ]);
    }
}
