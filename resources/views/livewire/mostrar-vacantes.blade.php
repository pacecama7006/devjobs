<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        @forelse ($vacantes as $vacante) 
        <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
            <div class="space-y-3">
                <a href="{{ route('vacantes.show', $vacante->id) }}" class="text-xl font-bold">
                    {{ $vacante->titulo }}
                </a>
                <p class="text-sm text-gray-600 font-b">
                    {{ $vacante->empresa }}
                </p>
                <p class="text-sm text-gray-500">
                    {{-- Tuve que meter un campo $dates en el modelo Vacante 
                    para que ultimo_dia me lo tome como fecha y no como string--}}
                    Último día: {{$vacante->ultimo_dia->format('d/m/Y') }}
                </p>
            </div>
            <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
                <a href="{{ route('candidatos.index', $vacante) }}" class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                    {{ $vacante->candidatos->count() }}
                    Candidatos
                </a>
                <a href="{{ route('vacantes.edit', $vacante->id) }}" class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                    Editar
                </a>
                {{-- Esta es una forma de pasarle eventos al componente MostrarVacantes
                    donde el evento click tiene que tener la función emit donde le
                    podemos pasar el nombre del método que utilizaremos en el componente
                    así como los parámetros que le estaremos enviando --}}
                {{-- <button wire:click="$emit('prueba', {{ $vacante->id }})" class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                    Eliminar
                </button> --}}

                {{-- Esta es otra forma de llamar eventos en livewire, donde abajo
                    donde está el script llamo a livewire --}}
                <button wire:click="$emit('mostrarAlerta', {{ $vacante->id }})" class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                    Eliminar
                </button>
            </div>
        </div>
            
        @empty
    
        <p class="p-3 text-center text-sm text-gray-600">
            No hay vacantes que mostrar
        </p> 
    
        @endforelse
    </div>
    {{-- Creo la paginación --}}
    <div class="mt-10">
        {{ $vacantes->links() }}
    </div>
</div>
@push('scripts')
    {{--Script que puedo meter aquí porque en app.blade.php puse @stack(scripts)  --}}
    {{-- Script que utiliza sweetalert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('mostrarAlerta', vacanteId =>{
            // alert('Desde el código de javascript')

            //El siguiente código es el Alert utilizado
            Swal.fire({
                title: '¿Eliminar vacante?',
                text: "Una vacante eliminada, no se puede recuperar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, ¡Eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                // Eliminamos la vacante, mandando evento al componente MostraVacante
                Livewire.emit('eliminarVacante', vacanteId)
                Swal.fire(
                'Se eliminó la vacante.',
                'El registro ha sido eliminado correctamente.',
                'succes'
                )
            }
            })
        })

        
    </script>
@endpush