<?php

namespace Tringuyen\CarForRent\Model;

use Tringuyen\CarForRent\Bootstrap\Request;

class UserLoginRequest extends Request
{
    protected $username;
    protected $password;

    /**
     * @return mixed
     */
    public function getUsername(): mixed
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername(mixed $username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword(): mixed
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }


    public function __construct()
    {
        $this->username = '';
        $this->password = '';
    }

    public function fromArray(array $params): static
    {
        $this->username = $params['username'] ?? '';
        $this->password = $params['password'] ?? '';
        return $this;
    }
}
