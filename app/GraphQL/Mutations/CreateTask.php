<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Task;

final readonly class CreateTask
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $args['user_id'] = auth()->id();
        return Task::create($args);
    }
}
