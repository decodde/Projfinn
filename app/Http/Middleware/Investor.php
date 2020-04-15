<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class Investor
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

            if($user->type === "investor"){
                return $next($request);

            } else {
                \Session::put('red', true);
                return redirect('/')->withErrors('Sorry you are not allowed here');
            }
        } else {
            \Session::put('red', true);
            return redirect('login')->withErrors('You must be logged in first');
        }
    }
}
