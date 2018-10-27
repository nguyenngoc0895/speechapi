<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class isBlocked
{
    /**
     * The Guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;


    /**
     * @param \Illuminate\Contracts\Auth\Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $this->auth->user();
        if ($user && $user->status !== 1) {
            \Session::flush();
            return redirect('login');
        }
        return $next($request);

        // if (Auth::guard($guard)->check()) {
        //     // dd(Auth::user());
        //     if(Auth::user()->level !== 1) {
        //         return redirect('/home');
        //     }
        //     return $next($request);
        // }
    }
}
