<?php

namespace App\GraphQL\Mutations\UserPage;

use Illuminate\Support\Facades\Auth;

final class UpdateField
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $field = Auth::user()->fields()->find($args['id']);
        $field->fill($args)->save();
        return $field;
    }
}
