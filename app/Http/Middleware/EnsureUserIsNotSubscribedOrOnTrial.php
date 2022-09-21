<?php

namespace App\Http\Middleware;

use Closure;

class EnsureUserIsNotSubscribedOrOnTrial
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
        if ($request->user() && $request->user()->on_trial_or_subscribed) {
            // This user is a paying customer...
            return redirect(route('write'));
        }

        return $next($request);
    }
}
