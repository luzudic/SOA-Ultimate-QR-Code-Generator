<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsUser
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
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user();

        if ($user->user_type != '2') {
            return redirect('/');
        }

        return $next($request);
    }
}
