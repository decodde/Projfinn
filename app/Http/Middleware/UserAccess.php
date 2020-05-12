<?php

namespace App\Http\Middleware;

use App\Http\Helpers\partials as Partials;
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

    private $partials;
    public function __construct(Partials $partials) {
        $this->partials = $partials;
    }

    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if($user == null) {
            \Session::put('red', true);
            return redirect()->guest('login')->withErrors('You must be logged in first');
        } else {
            View::share(['user' => $user]);
        }
        return $next($request);
    }
}
