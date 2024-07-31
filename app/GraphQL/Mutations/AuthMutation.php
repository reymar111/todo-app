<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;

final readonly class AuthMutation
{
    public function login($root, array $args)
    {
        if (Auth::attempt($args)) {
            $user = Auth::user();
            return $user->createToken('auth_token')->plainTextToken;
        }
        throw new \Exception('Unauthorized');
    }

    public function logout($root, array $args)
    {
        Auth::user()->tokens()->delete();
        return true;
    }
}
