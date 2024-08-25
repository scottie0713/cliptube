<?php

namespace App\DTOs;

use App\Models\User;

class UserGetResponse
{
    public string $provider;

    public string $hash;

    public string $providerName;

    public string $name;

    public static function create(User $user): UserGetResponse
    {
        $instance = new self();
        $instance->provider = self::makeProvider($user->provider);
        $instance->hash = $user->hash;
        $instance->name = $user->name;
        $instance->providerName = $user->provider_name;

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
