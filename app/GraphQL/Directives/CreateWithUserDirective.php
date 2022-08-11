<?php

namespace App\GraphQL\Directives;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Nuwave\Lighthouse\Execution\Arguments\SaveModel;
use Nuwave\Lighthouse\Schema\Directives\CreateDirective;

final class CreateWithUserDirective extends CreateDirective
{
    public static function definition(): string
    {
        return /** @lang GraphQL */ <<<'GRAPHQL'
"""
Create a new Eloquent model with the given arguments.
"""
directive @createWithUser(
  """
  Specify the class name of the model to use.
  This is only needed when the default model detection does not work.
  """
  model: String

  """
  Specify the name of the relation on the parent model.
  This is only needed when using this directive as a nested arg
  resolver and if the name of the relation is not the arg name.
  """
  relation: String
) on FIELD_DEFINITION | ARGUMENT_DEFINITION | INPUT_FIELD_DEFINITION
GRAPHQL;
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Model  $parent
     * @param  \Nuwave\Lighthouse\Execution\Arguments\ArgumentSet|array<\Nuwave\Lighthouse\Execution\Arguments\ArgumentSet>  $args
     *
     * @return \Illuminate\Database\Eloquent\Model|array<\Illuminate\Database\Eloquent\Model>
     */
    public function __invoke($parent, $args)
    {
        $relationName = $this->directiveArgValue(
            'relation',
            // Use the name of the argument if no explicit relation name is given
            $this->nodeName()
        );

        $relation = $parent->{$relationName}();
        assert($relation instanceof Relation);

        // @phpstan-ignore-next-line Relation&Builder mixin not recognized
        $related = $relation->make();
        assert($related instanceof Model);

        dd($related);

        return $this->executeMutation($related, $args, $relation);
    }
}
