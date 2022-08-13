<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CurrentUserHasField extends CurrentUserHasRelation
{
    public function __construct()
    {
        parent::__construct('fields');
    }
}
