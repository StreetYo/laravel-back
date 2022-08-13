<?php

namespace App\GraphQL\Validators\Field;

use App\Rules\CurrentUserHasRelation;
use Nuwave\Lighthouse\Validation\Validator;

final class CreateFieldInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'pageId' => ['required', 'int', 'min:1', new CurrentUserHasRelation('pages')],
            'type' => ['required', 'string'],
            'order' => ['integer'],
            'enabled' => ['required', 'boolean'],
            'meta' => ['required'],
        ];
    }
}
