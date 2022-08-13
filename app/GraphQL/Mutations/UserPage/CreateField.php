<?php

namespace App\GraphQL\Mutations\UserPage;

use App\Models\UserPage\Field;
use Illuminate\Support\Facades\Auth;

final class CreateField
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $page = Auth::user()->pages()->find($args['pageId']);
        $field = Field::make($args);
        $page->fields()->save($field);

        return $field;
    }
}
