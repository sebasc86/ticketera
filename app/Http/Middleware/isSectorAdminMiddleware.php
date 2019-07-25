<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Sector;

class isSectorAdminMiddleware
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
        $sectorAdmin = $sector->isAdmin;

        if (Auth::user() &&  ($sectorAdmin == 1 || $sectorAdmin == 2) ) {
            return $next($request);
        }


        return abort(403, 'No puede ingresar a esta pagina');

    }
}
