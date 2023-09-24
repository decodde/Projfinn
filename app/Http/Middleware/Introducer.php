<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class Introducer
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

            if($user->type === "introducer"){
                return $next($request);

            } else {
                \Session::put('red', true);
                return redirect('/')->withErrors('Sorry you are not allowed here');
            }
        } else {
            \Session::put('red', true);
            return redirect()->guest('login')->withErrors('You must be logged in first');
        }
    }
}