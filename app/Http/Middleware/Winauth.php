<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class Winauth
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $winauth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $winauth)
    {
        $this->winauth = $winauth;
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
        if ($request->server('AUTH_USER') && ($user = User::where('name', $request->server('AUTH_USER'))->first()))
        {
            $this->auth->login($user);
        }
        else
        {
            return redirect()->guest('home');
        }

        return $next($request);
    }
}
