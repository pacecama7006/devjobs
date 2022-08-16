<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('vacantes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('vacantes.create');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vacante $vacante)
    {
        //
        // dd($id);
        return view('vacantes.show', [
            'vacante' => $vacante,
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * Gracias al routeModelBindg que definimos en la ruta, podemos subsituir
     * el id que viene como parámetro por defecto y substituirlo por el modelo
     * de vacante
     */
    public function edit(Vacante $vacante)
    {
        //dd($vacante);

        /**Utilizo una policy para que sólo si el usuario que está
         * queriendo editar la información es el usuario que la hizo
         * pueda tener acceso a esta vista. Viene del policy que creamos
         * llamado VacantePolicy en su método update. Llamo al método
         * y también le paso el nombre del método y que vacante estoy
         * queriendo actualizar
         */
        $this->authorize('update', $vacante);

        return view('vacantes.edit', [
            'vacante' => $vacante,
        ]);
    }

    
}
