<?php

namespace Tringuyen\CarForRent\Model;



use Tringuyen\CarForRent\Http\Request;
use Tringuyen\CarForRent\Traits\PasswordTrait;

class UserRegisterRequest extends Request
{
    private string $username;
    private string $password;
    private string $confirmPassword;
    private string $hashPassword;
    use PasswordTrait;

    public function __construct()
    {
        $this->username = '';
        $this->password = '';
        $this->confirmPassword = '';
    }

    /**
     * @return string
     */
    public function getHashPassword(): string
    {
        return $this->hashPassword;
    }

    /**
     * @param string $hashPassword
     */
    public function setHashPassword(string $hashPassword): void
    {
        $this->hashPassword = $hashPassword;
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
        $this->setHashPassword($this->hashPassword($this->getPassword(),PASSWORD_BCRYPT));
        return $this;
    }

    public function setSelf(string $username, string $password, string $confirmPassword)
    {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setConfirmPassword($confirmPassword);
        $this->setHashPassword($this->hashPassword($this->getPassword(),PASSWORD_BCRYPT));
    }

}
