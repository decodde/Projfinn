<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\View;

class UserAccess
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
        if(Auth::check()) {
            $user = Auth::user();

            View::share(['user' => $user]);
        } else {
            \Session::put('red', true);
            return redirect('login')->withErrors('You must be logged in first');
        }
        return $next($request);
    }
}
