namespace App\GraphQL\Directives;

use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;

class AuthDirective extends BaseDirective
{
    public function handleField($rootValue, array $args, GraphQLContext $context, \Closure $next)
    {
        if (!auth()->check()) {
            throw new \Exception('Unauthorized');
        }
        return $next($rootValue, $args, $context);
    }
}
