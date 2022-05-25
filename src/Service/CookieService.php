<?php

namespace Tringuyen\CarForRent\Service;

class CookieService
{
    public function set(string $name,
                        string $value = "",
                        int $expires_or_options = 0,
                        string $path = "",
                        string $domain = "",
                        bool $secure = false,
                        bool $httponly = false): bool
    {
        return setcookie($name, $value,$expires_or_options,$path,$domain,$secure,$httponly );
    }
}