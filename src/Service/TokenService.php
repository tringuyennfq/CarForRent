<?php

namespace Tringuyen\CarForRent\Service;

use Dotenv\Dotenv;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Tringuyen\CarForRent\Model\User;

class TokenService
{
    protected static $dotenv;
    public function create(User $user)
    {
        $dotenv = Dotenv::createImmutable(__DIR__.'/../');
        self::$dotenv = $dotenv->load();
        $key = $_ENV['JWTKEY'];
        $payload = [
            'user_id' => $user->getId(),
            'username' => $user->getUsername(),
        ];
        return JWT::encode($payload, $key, 'HS256');
    }
}