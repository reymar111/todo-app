namespace App\GraphQL\Mutations;

use App\Models\Task;

class TaskMutations
{
    public function createTask($root, array $args)
    {
        $args['user_id'] = auth()->id();
        return Task::create($args);
    }

    public function updateTask($root, array $args)
    {
        $task = Task::where('id', $args['id'])->where('user_id', auth()->id())->firstOrFail();
        $task->update($args);
        return $task;
    }

    public function deleteTask($root, array $args)
    {
        $task = Task::where('id', $args['id'])->where('user_id', auth()->id())->firstOrFail();
        return $task->delete();
    }
}
