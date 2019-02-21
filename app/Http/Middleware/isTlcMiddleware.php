<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Sector;

class isTlcMiddleware
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
        $sectorId = Auth::user()->sector_id;
        $sector =  Sector::find($sectorId);
        $sectorName = $sector->name;
        
        if (Auth::user() &&  $sectorName == 'Telecentro') {
            return $next($request);
        }

        
        return abort(403, 'No puede ingresar a esta pagina');

    }
}
