<?php

namespace Tringuyen\CarForRent\Service;

use Tringuyen\CarForRent\Model\Session;
use Tringuyen\CarForRent\Repository\SessionRepository;
use Tringuyen\CarForRent\Repository\UserRepository;

class SessionService
{
    /**
     * @var string
     */
    public string $userId;
    /**
     * @var CookieService
     */
    private CookieService $cookieService;
    /**
     * @var SessionRepository
     */
    protected SessionRepository $sessionRepository;
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    public function __construct(SessionRepository $sessionRepository, UserRepository $userRepository, CookieService $cookieService)
    {
        $this->userId = 'user_ID';
        $this->sessionRepository = $sessionRepository;
        $this->userRepository = $userRepository;
        $this->cookieService = $cookieService;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        $sessionId = $_COOKIE[$this->userId] ?? '';
        $session = $this->sessionRepository->findById($sessionId);
        if ($session->getSessID() == null) {
            return null;
        }
        return $this->userRepository->findById($session->getUserID())->getId();
    }

    /**
     * @param int $userId
     * @return bool
     */
    public function setUserId(int $userId): bool
    {
        $session = new Session();
        $session->setSessID(uniqid());
        $session->setUserID($userId);
        $lifetime = time() + (60 * 60 * 24);
        $session->setSessLifetime($lifetime);

        $sessionSaved = $this->sessionRepository->save($session);
        if (!$sessionSaved) {
            return false;
        }
        $this->cookieService->set($this->userId, $session->getSessID(), $lifetime, '/');
        $_SESSION[$this->userId] = $session->getSessID();
        $_SESSION['username'] = $this->userRepository->findById($session->getUserID())->getUsername();
        return true;
    }

    /**
     * @return bool
     */
    public function destroyUser(): bool
    {
        $sessionId = $_COOKIE[$this->userId] ?? '';
        $checkDeleteSession = $this->sessionRepository->deleteById($sessionId);
        if (!$checkDeleteSession) {
            return false;
        }
        $this->cookieService->set($this->userId, '', 1, '/');
        unset($_SESSION[$this->userId]);
        unset($_SESSION['username']);
        return true;
    }

    /**
     * @return bool
     */
    public function isLogin(): bool
    {
        return $this->getUserId() != null;
    }
}
