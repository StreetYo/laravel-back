<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CurrentUserHasRelation implements InvokableRule
{
    private string $relation;

    /**
     * ExistsWithRelation constructor.
     * @param string $relation
     */
    public function __construct(string $relation)
    {
        $this->relation = $relation;
    }

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $relations = explode('.', $this->relation);

        $value = Validator::validate([
            'value' => $value
        ], [
            'value' => 'required|integer|min:1'
        ])['value'];

        $user = Auth::user();

        if(is_null($user)) {
            $fail("Current user in not authorized.");
        }

        $builder = call_user_func([$user, $relations[0]]);

        unset($relations[0]);

        foreach ($relations as $relation) {
            $builder = $builder->$relation();
        }

        if(is_null($builder->find($value))) {
            $fail("The :attribute doesn't exist.");
        }
    }
}
