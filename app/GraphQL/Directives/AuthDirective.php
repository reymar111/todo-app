<?php declare(strict_types=1);

namespace App\GraphQL\Directives;

use Closure;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Nuwave\Lighthouse\Support\Contracts\FieldMiddleware;

class AuthDirective extends BaseDirective
{
    // TODO implement the directive https://lighthouse-php.com/master/custom-directives/getting-started.html

    public static function definition(): string
    {
        return /** @lang GraphQL */ <<<'GRAPHQL'
        directive @guard on FIELD_DEFINITION
        GRAPHQL;
    }

    /**
     * Wrap around the final field resolver.
     *
     * @param  \Nuwave\Lighthouse\Schema\Values\FieldValue  $fieldValue
     * @param  \Closure  $next
     * @return \Nuwave\Lighthouse\Schema\Values\FieldValue
     */
    public function handleField($rootValue, array $args, GraphQLContext $context, Closure $next)
    {
        if (!auth()->check()) {
            throw new \Exception('Unauthorized');
        }
        return $next($rootValue, $args, $context);
    }
}
