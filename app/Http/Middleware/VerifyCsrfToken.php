<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/os/encontrar/*',
        '/os/produtos',
        '/search/clientes',
        '/search/produtos',
        '/search/maquinas',
        '/search/os',
    ];
}
