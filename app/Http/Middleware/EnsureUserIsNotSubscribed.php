<?php

namespace App\Http\Middleware;

use Closure;

class EnsureUserIsNotSubscribed
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
        if ($request->user() && $request->user()->subscribed()) {
            // This user is a paying customer...
            return redirect(route('write'));
        }

        return $next($request);
    }
}
