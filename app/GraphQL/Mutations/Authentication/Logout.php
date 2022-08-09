<?php

namespace App\GraphQL\Mutations\Authentication;

use Illuminate\Support\Facades\Auth;

final class Logout
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $guard = Auth::guard('web');

        $user = $guard->user();
        $guard->logout();

        return $user;
    }
}
