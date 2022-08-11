<?php

namespace App\GraphQL\Mutations\Authentication;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class Register
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = User::make(collect($args)->except('password')->toArray());
        $user->password = Hash::make($args['password']);
        $user->save();

        return $user;
    }
}
