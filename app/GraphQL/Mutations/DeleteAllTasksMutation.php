<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Task;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class DeleteAllTasksMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteAllTasks',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return Type::listOf(Type::string());
    }

    public function args(): array
    {
        return [
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::int(),
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        Task::where('user_id', $args['user_id'])->delete();

    }
}
