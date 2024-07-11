<?php

namespace App\DTOs;

use App\Models\User;

class UserGetResponse
{
    public string $provider;

    public static function create(User $user): UserGetResponse
    {
        $instance = new self();
        $instance->provider = self::makeProvider($user->provider);
        return $instance;
    }

    private static function makeProvider($provider)
    {
        switch ($provider) {
            case 'twitter':
                return 'X';
            case 'google':
                return 'Google';
            default:
                return '????';
        }
    }
}
