<?php

namespace Tringuyen\CarForRent\Service;

use Tringuyen\CarForRent\Model\Session;
use Tringuyen\CarForRent\Repository\SessionRepository;
use Tringuyen\CarForRent\Repository\UserRepository;

class SessionService
{
    public string $userId;
    protected SessionRepository $sessionRepository;
    private UserRepository $userRepository;

    public function __construct(SessionRepository $sessionRepository, UserRepository $userRepository)
    {
        $this->userId = '';
        $this->sessionRepository = $sessionRepository;
        $this->userRepository = $userRepository;
    }

    public function getUserId(): ?int
    {
        $sessionId = $_COOKIE[$this->userId] ?? '';
        $session = $this->sessionRepository->findById($sessionId);
        if ($session->getSessID() == null) {
            return null;
        }
        return $this->userRepository->findById($session->getUserID())->getId();
    }

    public function setUserId(int $userId): bool
    {
        $session = new Session();
        $session->setSessID(uniqid());
        $session->setUserID($userId);
        $lifetime = time() + (60 * 60 * 24);
        $session->setSessLifetime($lifetime);

        $sessionSaved = $this->sessionRepository->save($session);
        if (getType($sessionSaved) == 'boolean' && !$sessionSaved) {
            return false;
        }
        setcookie($this->userId, $session->getSessID(), $lifetime, '/');
        $_SESSION[$this->userId] = $userId;
        return true;
    }

    public function destroyUser(): bool
    {
        $sessionId = $_COOKIE[$this->userId] ?? '';
        $checkDeleteSession = $this->sessionRepository->deleteById($sessionId);
        if (!$checkDeleteSession) {
            return false;
        }
        setcookie($this->userId, '', 1, '/');
        unset($_SESSION[$this->userId]);
        return true;
    }

    public function isLogin(): bool
    {
        return $this->getUserId() != null;
    }
}