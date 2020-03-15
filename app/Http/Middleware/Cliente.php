<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Cliente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if(auth()->user()->admin == 0) {
                return $next($request);
            }
        } else {
            return redirect()->route('login.cliente');
        }

        return redirect('/')->with('error', "Sem permissão para acessar essa página");
    }
}
