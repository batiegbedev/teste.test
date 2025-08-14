<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EditeurMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
<<<<<<< HEAD
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->hasAnyRole(['admin', 'editeur'])) {
            abort(403, 'Accès refusé. Vous devez être administrateur ou éditeur.');
        }

=======
>>>>>>> bf330a648a7b8366453911d006c1fdbba87992c0
        return $next($request);
    }
}
