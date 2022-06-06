<?php

namespace Tringuyen\CarForRent\Traits;

trait PasswordTrait
{
    /**
     * @param string $password
     * @param int|string|null $alg
     * @return string
     */
    public function hashPassword(string $password, int | null | string $alg): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
