<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifySpecialist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if($user?->hasRole('specialist')) {
            return $next($request);
        }

        return redirect('home')->withErrors(['no_permissions' => 'Вы не обладаете привилегиями для этого действия']);

    }
}
