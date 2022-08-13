<?php

namespace App\GraphQL\Mutations\UserPage;

use Illuminate\Support\Facades\Auth;

final class UpdatePage
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $id = $args['id'];
        $page = Auth::user()->pages()->findOrFail($id);

        $data = collect($args)->except('id')->toArray();
        $page->fill($data);
        $page->save();

        return $page;
    }
}
