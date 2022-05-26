<?php

namespace Tringuyen\CarForRent\Model;

use Tringuyen\CarForRent\Bootstrap\Request;

class UserLoginRequest extends Request
{
    /**
     * @var string
     */
    protected string $username;
    /**
     * @var string
     */
    protected string $password;

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }


    public function __construct()
    {
        $this->username = '';
        $this->password = '';
    }

    /**
     * @param array $params
     * @return $this
     */
    public function fromArray(array $params): static
    {
        $this->username = $params['username'] ?? '';
        $this->password = $params['password'] ?? '';
        return $this;
    }
}
