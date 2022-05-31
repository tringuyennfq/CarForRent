<?php

namespace Tringuyen\CarForRent\Model;



use Tringuyen\CarForRent\Http\Request;

class UserRegisterRequest extends Request
{
    private string $username;
    private string $password;
    private string $confirmPassword;


    public function __construct()
    {
        $this->username = '';
        $this->password = '';
        $this->confirmPassword = '';
    }

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

    /**
     * @return string
     */
    public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }

    /**
     * @param string $confirmPassword
     */
    public function setConfirmPassword(string $confirmPassword): void
    {
        $this->confirmPassword = $confirmPassword;
    }

    public function fromArray(array $params): static
    {
        $this->setUsername($params['username']);
        $this->setPassword($params['password']);
        $this->setConfirmPassword($params['confirmPassword']);
        return $this;
    }
}