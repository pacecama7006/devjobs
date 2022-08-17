<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
        // dd('Desde notificación controller');

        /**
         * Como las notificaciones, son propias de cada usuario
         * accedemos a ellas mediante el usuario autenticado, y al método
         * de laravel  unreadNotifications. Con éste método accedo
         * a las notificaciones no leídas
         */
        $notificaciones = auth()->user()->unreadNotifications;

        // 
        /**
         * Accedemos al método markAsRead para que una vez
         * que el usuario que recibe las notificaiones (reclutador)
         * y las lee, limpiar las notificaciones
         */
        auth()->user()->unreadNotifications->markAsRead();

        return view('notificaciones.index', [
            'notificaciones' => $notificaciones,
        ]);
    }
}
