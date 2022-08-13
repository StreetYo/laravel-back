<?php

namespace App\GraphQL\Validators\Field;

use App\Rules\CurrentUserHasField;
use App\Rules\CurrentUserHasRelation;
use Nuwave\Lighthouse\Validation\Validator;

final class UpdateFieldInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'int', 'min:1', new CurrentUserHasField],
            'order' => ['integer'],
            'enabled' => ['boolean'],
//            'meta' => 'required',
        ];
    }
}
