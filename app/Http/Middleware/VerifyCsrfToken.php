<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Support\Str;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];

    protected function inExceptArray($request)
    {
        if(
            env('APP_ENV') == 'local' &&
            $request->hasHeader('Referer') &&
            Str::endsWith($request->header('Referer'), '/graphql-playground')
        ) {
            return true;
        }

        return parent::inExceptArray($request);
    }
}
