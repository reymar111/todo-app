<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use App\Models\Task;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateTaskMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createTask',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('Task');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::id()
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::string(),
            ],
            'done' => [
                'name' => 'done',
                'type' => Type::boolean(),
            ],
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::int(),
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        // $fields = $getSelectFields();
        // $select = $fields->getSelect();
        // $with = $fields->getRelations();

        $task = new Task();
        $task->fill($args);
        $task->save();

        return $task;
    }
}
