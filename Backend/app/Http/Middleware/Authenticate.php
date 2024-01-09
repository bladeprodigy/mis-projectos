<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Closure;
class Authenticate extends Middleware
{

=======

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
>>>>>>> parent of 6a5f8084 (Delete Backend directory in main zeby nie bylo konfliktow)
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
<<<<<<< HEAD
    public function handle($request, Closure $next, ...$guards)
    {
    if (auth()->guest()) {
        return redirect('/login');
    }

    return $next($request);
    }
=======
>>>>>>> parent of 6a5f8084 (Delete Backend directory in main zeby nie bylo konfliktow)
}
