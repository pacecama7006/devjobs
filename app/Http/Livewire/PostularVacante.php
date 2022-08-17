<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use App\Models\Candidato;
use App\Notifications\NuevoCandidato;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{   
    // Línea necesaria para poder procesar archivos con livewire
    use WithFileUploads;

    // Atributos que vienen de postular-vacante
    public $cv;
    public $vacante;

    // Reglas de validación
    protected $rules = [
        'cv' => 'required|mimes:pdf',
    ];

    // Función que forzosamente se llama mount y que
    /**se ejecuta solo una vez. Me permite tener la vacante
     * en donde estoy
     */
    public function mount(Vacante $vacante)
    {
        // dd($vacante);
        $this->vacante = $vacante;
    }

    // Función que se manda llamar desde la vista postular-vacante
    public function postularme()
    {
        // hago la validación y lo guardo en una variable que llamo datos
        $datos= $this->validate();       
        // dd($datos);

        // Almacenar el cv en el método de livewire store. Obtengo la ubicación
        // Del cv

        $cv = $this->cv->store('public/cv');
        // dd($cv);

        // Obtengo el nombre del cv con la función de php str_replace
        // en el primer parámetro recibe que va a buscar, 2do con que lo
        // voy a reemplazar y 3ero de donde va a tomar la información

        $datos['cv'] = str_replace('public/cv/', '', $cv);
        // dd($nombre_imagen);
        // dd($datos);

        //Crear el candidato. En livewire tenemos acceso a los modelos y a la bd
        /**Lo hacemos mediante la relación creada en vacante.
         * No le paso el vacante id, porque con la relación
         * ya sabe cual es el id de la vacante
         */
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
            'cv' => $datos['cv'],
        ]);

        // Crear notificación y enviar email
        /**En base a la relación creada en vacante (reclutador) es que
         * vamos a crear la notificación al reclutador
         * en el método notify recibe la notificación que quermos utilizar
         */
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id ));

        // Crear un mensaje con un mensaje de session
        session()->flash('mensaje', 'Se envió correctamente tú información. ¡Mucha suerte!');

        //Redireccionar al usuario
        return redirect()->back();


    }
    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
