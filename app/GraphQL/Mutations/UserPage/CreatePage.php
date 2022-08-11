<?php

namespace App\GraphQL\Mutations\UserPage;

use App\Models\UserPage\Page;
use Illuminate\Support\Facades\Auth;

final class CreatePage
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $page = Page::make($args);

        Auth::user()->pages()->save($page);

        return $page;
    }
}
