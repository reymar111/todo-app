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

class UpdateTaskMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateTask',
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
                'type' =>  Type::int(),
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $task = Task::findOrFail($args['id']);
        $task->done = !$task->done;
        $task->update();

        return $task;
    }
}
