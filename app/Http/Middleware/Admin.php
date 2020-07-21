<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use Auth;


class Admin
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
            if ($user->type !== 'admin'){
                \Session::put('red', true);
                return redirect('logout');
            }

            View::share(['user' => $user]);
            View::share(['admin' => $user->admin()]);
        }else{
            \Session::put('red', true);
            return redirect()->guest('login');
        }
        return $next($request);
    }
}
