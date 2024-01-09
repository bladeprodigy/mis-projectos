<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
<<<<<<< HEAD
     * @var array
     */
    protected $except = [
        'user/register',
        'user/login',
        'projects/*',
=======
     * @var array<int, string>
     */
    protected $except = [
        //
>>>>>>> parent of 6a5f8084 (Delete Backend directory in main zeby nie bylo konfliktow)
    ];
}
