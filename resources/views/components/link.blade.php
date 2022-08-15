
    <!-- An unexamined life is not worth living. - Socrates -->
    @php
        $clases = "text-xs text-gray-500 hover:text-gray-900";
    @endphp
    {{-- Con attributes merge me permite pasarle ya sea desde aqui
        o desde la vista los atributos --}}
<a {{ $attributes->merge(['class' => $clases]) }}>
        {{ $slot }}
</a>