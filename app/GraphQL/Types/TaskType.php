<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Task;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class TaskType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Task',
        'description' => 'Collection of Tasks',
        'model' => Task::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of type'
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Description of type'
            ],
            'done' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Status of type'
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Owner of type'
            ],
        ];
    }
}
