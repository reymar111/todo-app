<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use App\Models\Task;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TasksQuery extends Query
{
    protected $attributes = [
        'name' => 'tasks',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Task'));
    }

    public function args(): array
    {
        return [
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::int(),
                'rules' => ['required'],
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        return Task::where('user_id', $args['user_id'])->get();
    }
}
