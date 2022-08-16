{{-- Comunico el formulario con liveWire con wire:submit.prevent con la
    función editarVacante que está en el compontente EditarVacante --}}
    <form action="" class="md:w-1/2 space-y-5" wire:submit.prevent='editarVacante' enctype="multipart/form-data">
        {{-- Título de la vacante --}}
        <div>
            <x-label for="titulo" :value="__('Título vacante')" />
    
            {{-- Como voy a conectar con livewire, el name le pongo wire:model --}}
            <x-input id="titulo" class="block mt-1 w-full" type="text" wire:model="titulo" :value="old('titulo')" placeholder="Título vacante"/>
        </div>
        {{-- Valido los errores. Message es variable de livewire --}}
        @error('titulo')
            {{-- Llamada al componente liveWire mostrar-alerta --}}
            <livewire:mostrar-alerta :message="$message"/>   
        @enderror
    
        {{-- Salario --}}
        <div>
            <x-label for="salario" :value="__('Salario mensual')" />
            {{-- Como voy a conectar con livewire, el name le pongo wire:model --}}
            <select wire:model="salario" id="salario" class='rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full'>
                <option value="">---Selecciona ---</option>
                @foreach ($salarios as $salario)
                    <option value="{{ $salario->id }}">{{ $salario->salario }}</option>
                @endforeach
            </select>
        </div>
        {{-- Valido los errores. Message es variable de livewire --}}
        @error('salario')
            {{-- Llamada al componente liveWire mostrar-alerta --}}
            <livewire:mostrar-alerta :message="$message"/>   
        @enderror
    
        {{-- Categoría --}}
        <div>
            <x-label for="categoria" :value="__('Categoría')" />
            {{-- Como voy a conectar con livewire, el name le pongo wire:model --}}
            <select wire:model="categoria" id="categoria" class='rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full'>
                <option value="">---Selecciona una categoría---</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                @endforeach
            </select>
        </div>
        {{-- Valido los errores. Message es variable de livewire --}}
        @error('categoria')
            {{-- Llamada al componente liveWire mostrar-alerta --}}
            <livewire:mostrar-alerta :message="$message"/>   
        @enderror
    
        {{-- Empresa --}}
        <div>
            <x-label for="empresa" :value="__('Empresa')" />
            {{-- Como voy a conectar con livewire, el name le pongo wire:model --}}
            <x-input id="empresa" class="block mt-1 w-full" type="text" wire:model="empresa" :value="old('empresa')" placeholder="Empresa: ej: Uber, Netflix"/>
        </div>
        {{-- Valido los errores. Message es variable de livewire --}}
        @error('empresa')
            {{-- Llamada al componente liveWire mostrar-alerta --}}
            <livewire:mostrar-alerta :message="$message"/>   
        @enderror
    
        {{-- Fecha postulación --}}
        <div>
            <x-label for="ultimo_dia" :value="__('Último día para postularse')" />
            {{-- Como voy a conectar con livewire, el name le pongo wire:model --}}
            <x-input id="ultimo_dia" class="block mt-1 w-full" type="date" wire:model="ultimo_dia" :value="old('ultimo_dia')"/>
        </div>
        {{-- Valido los errores. Message es variable de livewire --}}
        @error('ultimo_dia')
            {{-- Llamada al componente liveWire mostrar-alerta --}}
            <livewire:mostrar-alerta :message="$message"/>   
        @enderror
    
        {{-- Descripción trabajo --}}
        <div>
            <x-label for="descripcion" :value="__('Descripción puesto')" />
            {{-- Como voy a conectar con livewire, el name le pongo wire:model --}}
            <textarea wire:model="descripcion" id="descripcion" placeholder="Descripción general del puesto, experiencia" class='rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full h-72'></textarea>
        </div>
        {{-- Valido los errores. Message es variable de livewire --}}
        @error('descripcion')
            {{-- Llamada al componente liveWire mostrar-alerta --}}
            <livewire:mostrar-alerta :message="$message"/>   
        @enderror
        {{-- Imagen --}}
        <div>
            <x-label for="imagen" :value="__('Imagen')" />
            {{-- Como voy a conectar con livewire, el name le pongo wire:model --}}
            <x-input id="imagen" class="block mt-1 w-full" type="file" wire:model="imagen_nueva" accept="image/*"/>
        </div>
    
        {{-- Muestro un preview de la imagen gracias a livewire, utilizando
            el wire:model de imagen, que es una variable que puedo utilizar --}}
        <div class="my-5 w-80">
            <x-label for="imagen" :value="__('Imagen actual')" />
            <img src="{{ asset('storage/vacantes/' . $imagen) }}" alt="{{ 'Imagen vacante' . $titulo }}">
        </div>
        <div class="my-5 w-80">
            @if ($imagen_nueva)
                Imagen nueva:
                <img src="{{ $imagen_nueva->temporaryUrl() }}"/>
            @endif
        </div>
        {{-- Valido los errores. Message es variable de livewire --}}
        @error('imagen_nueva')
            {{-- Llamada al componente liveWire mostrar-alerta --}}
            <livewire:mostrar-alerta :message="$message"/>   
        @enderror
    
        {{-- Botón de envío --}}
        <x-button>
            Editar vacante
        </x-button>
    </form>
    
